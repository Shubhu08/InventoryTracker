<script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyDPT5gUiLp6yy4BK4PEImpLZNpXmF3PbRk'></script>
<script type="text/javascript">

function getState(tid,lat,lng)
{
	var geocoder;
geocoder = new google.maps.Geocoder();
var latlng = new google.maps.LatLng(parseFloat(lat), parseFloat(lng));

geocoder.geocode(
    {'latLng': latlng}, 
    function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                    var add= results[0].formatted_address ;
                    var  value=add.split(",");

                    count=value.length;
                    city=value[count-3];
                    var xhttp;
                    if (window.XMLHttpRequest) {
				          // code for modern browsers
				          xhttp = new XMLHttpRequest();
				       } else {
				          // code for old IE browsers
				          xhttp = new ActiveXObject("Microsoft.XMLHTTP");
				      }
				    xhttp.open("GET", "map.php?q="+tid+"&attr="+city, false);
        			xhttp.send();
                }
                else  {
                    alert("address not found");
                }
        }
        
    }
);
}
</script>

<?php

	require("map.php");
	ini_set('max_execution_time',900);

	# get base location points from database and compare where does this point lies and calculate status
	$pdo=connect();

	$SQL = "SELECT tid, AsText(location) FROM `trolley-location`;";
	$RES = runqueryall($pdo,$SQL);

	foreach ($RES as $ROW) {
		# code...
		$tid = $ROW['tid'];
		$lnglat = lnglat($ROW['AsText(location)']);
		$Lat=$lnglat['Lat'];
		$Lng = $lnglat['Lng'];
		
	$sql = "SELECT * FROM `trolley-location` WHERE tid='".$tid."';";
	$res = runqueryrow($pdo,$sql);
	if($res==null)
	{
		$sql = "INSERT INTO `trolley-location` values('".$tid."',GeomFromText('POINT(".$Lng." ".$Lat.")')); ";
		$res = runupdate($pdo,$sql);
	}

	else
	{
		$sql="UPDATE `trolley-location` SET location= GeomFromText('POINT(".$Lng." ".$Lat.")') WHERE `tid`='".$tid."';" ;
		$res=runupdate($pdo,$sql);	
	}


#	$sql="SELECT AsText(location) as loc FROM `trolley-location` WHERE `tid`='".$tid."';" ;
#	$res=runqueryrow($pdo,$sql);
#	echo $res['loc']."\n";

	#calculate current-status
	$sql1 = "SET @p = GeomFromText('POINT(".$Lng." ".$Lat.")');";
	runupdate($pdo, $sql1);

	$sql = "SELECT AsText(boundary),baseid FROM base";
	$res = runqueryall($pdo,$sql);

	$status = "MIS";
	foreach( $res as $row)
	{
		$sql2 = "SET @boundary = GeomFromText('".$row['AsText(boundary)']."');";
		runupdate($pdo,$sql2);
		$sql3 = "SELECT MBRContains(@boundary,@p);";
		$r = runqueryrow($pdo,$sql3);
		if($r['MBRContains(@boundary,@p)'])
			$status = $row['baseid'];
	}


		$sql = "SELECT `current-status` FROM `trolley` where tid='".$tid."';";
		$res = runqueryrow($pdo,$sql);
		

		if($res['current-status']==null)
		{
			$sql = "UPDATE `trolley` SET `current-status`='".$status."' WHERE `tid`='".$tid.";"; 
		}

		if($res['current-status']=='MIS')
		{
			$sql = "DELETE FROM `missing` WHERE tid='".$tid."';";
			$r = runupdate($pdo,$sql);
		}

	# if status = missing -> add to missing table
		if($status == 'MIS')
		{
			$sql ="INSERT INTO `missing`(tid,location) values('".$tid."',GeomFromText('POINT(".$Lng." ".$Lat.")'));";
			$r = runupdate($pdo,$sql);
			echo "<script> getState(".$tid.",".$Lat.",".$Lng.");</script>";

		}
			$sql ="UPDATE `trolley`  SET `current-status` = '".$status."' WHERE tid='".$tid."';";	

		$r = runupdate($pdo,$sql);

}
?>
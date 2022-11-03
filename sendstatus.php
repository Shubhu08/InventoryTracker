<?php
	$tid = $_REQUEST['tid'];
	$Lat = $_REQUEST['Lat'];
	$Lng = $_REQUEST['Lng'];
	require("cc.php");
	# get base location points from database and compare where does this point lies and calculate status
	$pdo=connect();

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
			$sql = "DELETE FROM 'missing' WHERE tid='".$tid."';";
			$r = runupdate($pdo,$sql);
		}
		
		$sql ="UPDATE `trolley`  SET `current-status` = '".$status."' WHERE tid='".$tid."';";	
		$r = runupdate($pdo,$sql);
	
	# if status = missing -> add to missing table
		if($status == 'MIS')
		{
			$sql ="INSERT INTO `missing`(tid,location) values('".$tid."',GeomFromText('POINT(".$Lng." ".$Lat.")'));";
			runupdate($pdo,$sql);
			header("Location:getState.php?tid=".$tid."&Lat=".$Lat."&Lng=".$Lng);
		}
		
		echo $r;

?>


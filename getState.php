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
                    alert(city);
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
         else {
            alert("Geocoder failed due to: " + status);
        }
    }
);
}
</script>
<?php
$tid = $_REQUEST['tid'];
$Lat = $_REQUEST['Lat'];
$Lng = $_REQUEST['Lng'];
echo "<script> getState(".$tid.",".$Lat.",".$Lng.");</script>";
?>
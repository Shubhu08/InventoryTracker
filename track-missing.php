<?php require('auth.php');

 if(!authen())
    header("Location:index.html");
?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Food Cart Inventory</title>

    <meta name="description" content="">
    <meta name="author" content="">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    
    <script>
    function myMap(i) { 

      var lat,lng, xhttp;
      if (window.XMLHttpRequest) {
          // code for modern browsers
          xhttp = new XMLHttpRequest();
       } else {
          // code for old IE browsers
          xhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }

        document.getElementById("googleMap"+i).style.width='100%';
        document.getElementById("googleMap"+i).style.height='400px';
        xhttp.open("GET", "map.php?q="+i+"&attr=Lat", false);
        xhttp.send();
        lat = xhttp.responseText;
        xhttp.open("GET", "map.php?q="+i+"&attr=Lng", false);
        xhttp.send();
        lng = xhttp.responseText; 
 
            var mapProp= {
            center:new google.maps.LatLng(parseFloat(lat),parseFloat(lng)),
            zoom:18,
            };
            var map=new google.maps.Map(document.getElementById("googleMap"+i),mapProp);
            var marker = new google.maps.Marker({position:mapProp.center});
            marker.setMap(map);
  }

function init()
{
   //window.alert("Google Map Api Loaded");
}
</script>
  </head>

  <header>
  <div class="logohead">
    <img style="height: 100%; width: auto;" src="img/logo.jpg" alt="Vistara">
  </div>

	<div class="row" style="width: 101vw;">
  		<nav>
      <div class="col-md-12 nav-bar">
        <ul class="nav navbar-nav navbar-left "> 
          <a href="inventory.php"> <li> Inventory </li> </a>
          <a href="track-missing.php"> <li class="active"> Track Missing </li> </a>
        </ul>
        <ul class="nav navbar-nav navbar-right">
        <a href="logout.php"> <li> Logout </li> </a>
        </ul>
      </div>
      </nav>
	</div>
  <div class="row" style="padding: 0px 0px 0px 100px">
    <h2 class="nav-title">TRACK MISSING</h2>
  </div>  
  </header>

  <body>
  
  <div class="main" style="padding: 0px 0px 0px 100px">
    
<?php 
  require("invent-details.php");
  $count = countnum("MIS"); 
  $id = getmissingid();
  $i=0;
  foreach ($id as $res)          
  {    
   echo 
    " <div class='row'>
        <div class='col-md-2' id='logo1'>
        </div>
      
        <div class='col-md-8 inventory-disp'>
          <div class='row'>
            <div class='col-md-4'>
              <h4>ID : ".$res['tid']."</h4>
            </div>
            <div class='col-md-4'>
              <h4 id='in".$i."'>IN : ".$res['instate']."</h4>
            </div>
            <div class='col-md-4'>
              <button onclick='myMap(".$res['tid'].");' class='btn btn-block'>
                Show on map
              </button>
            </div>
          </div>
          <div class='row'>
            <div class='col-md-12'>
              <div id='googleMap".$res['tid']."' ></div>
            </div>
          </div>
        </div>
        <div class='col-md-2'>
        </div>
      </div>";
      $i++;
  }     
  
  echo "";
?>
  
  </div>
    <script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyDPT5gUiLp6yy4BK4PEImpLZNpXmF3PbRk&callback=init'></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>


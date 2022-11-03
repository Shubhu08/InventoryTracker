<!DOCTYPE html>
<html lang="en"> 
<?php  
require('auth.php');
 if(!authen())
    header("Location:index.php");
?>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Food Cart Inventory</title>

    <meta name="description" content="">
    <meta name="author" content="">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

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
					<a href="track-missing.php"> <li> Track Missing </li> </a>
        </ul>
        <ul class="nav navbar-nav navbar-right">
        <a href="logout.php"> <li> Logout </li> </a>
        </ul>
		  </div>
      </nav>
	</div>  
  </header>

  <body style="background-image: url('img/background.jpg');" >
  <div class="main">
	<div class="row">
	</div>
  </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>
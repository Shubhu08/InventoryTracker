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


<?php 
  require('invent-details.php');
?>
  </head>

  <header>
  <div class="logohead">
  	<img style="height: 100%; width: auto;" src="img/logo.jpg" alt="Vistara">
  </div>
	<div class="row" style="width: 100%;">
  		<nav>
      <div class="col-md-12 nav-bar">
        <ul class="nav navbar-nav navbar-left "> 
          <a href="inventory.php"> <li class="active"> Inventory </li> </a>
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
  
  <div class="main" style="padding: 0px 0px 0px 100px">
  <div class="row">
    <h2 class="nav-title">INVENTORY</h2>
  </div>  
	<div class="row">
      <div class="col-md-2">
      </div>
      <div class="col-md-8 inventory-disp" align="center">
          <table>
            <tr>
              <th>Station</th>
              <th>Number of carts</th>
            </tr>
            <tr>
              <td id="delhi">Delhi</td>
              <td>
              <?php echo countnum("DEL"); ?> 
              </td>
            </tr>
            <tr>
              <td>Mumbai</td>
              <td> 
                <?php echo countnum("BOM"); ?>
              </td>
            </tr>
            <tr>
              <td>Bangalore</td>
              <td>
                <?php echo countnum("BLR"); ?>
              </td>
            </tr>
            <tr>
              <td>Kolkata</td>
              <td>
                <?php echo countnum("CCU"); ?>
              </td>
            </tr>
            <tr>
              <td>Cochin</td>
              <td>
                <?php echo countnum("COK"); ?>
              </td>
            </tr>
            <tr>
              <td>Missing</td>
              <td>
                <?php echo countnum("MIS"); ?>
              </td>
            </tr>
          </table>
          <form action="getinventory.php">
          <button type="submit" class="btn btn-block">
            Get complete inventory
          </button>
          </form>
      </div>
      <div class="col-md-2">
          
      </div>
	</div>
  </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>

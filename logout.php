<?php @session_start(); ?>
<?php 
	$_SESSION["auth"]="No";
	session_destroy();
    header("Location:index.html");
	?>
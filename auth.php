<?php @session_start();?>
<?php 
function authen()
{
    if($_SESSION["auth"]!="YES")
		{
		 return 0;
		}
	  else return 1;
}
?>

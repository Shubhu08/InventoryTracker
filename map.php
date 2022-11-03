<?php
    require('cc.php');
	$pdo=connect();
	$sql="SELECT AsText(location) FROM `missing` WHERE tid='".$_REQUEST['q']."';" ;
	$res=runqueryrow($pdo,$sql);

	$a=0;
	if($_REQUEST['attr']=='Lat'||$_REQUEST['attr']=='Lng')
				{				
					$str = $res['AsText(location)'];
					$map=lnglat($str);
				echo $map[$_REQUEST['attr']];
				unset($lat,$lng,$str);
				}
	else
	{
		$sql="UPDATE `missing` SET instate = '".$_REQUEST['attr']."' WHERE tid='".$_REQUEST['q']."';" ;
		$res=runupdate($pdo,$sql);

	}
		#$map[$i]['Lng']=
		#echo $row['loc'];     
      #$GLOBALS["map"][$_REQUEST["i"]]["Lat"]

	function lnglat($str)
	{
		$i=0;
					while($str[$i]!='(')
					{
						$i++;
					}
					$i++;
					while($str[$i]!=' ')
					{
						$lng.= $str[$i];
						$i++;
					}
					$i++;
					while($str[$i]!=')')
					{
						$lat.= $str[$i];
						$i++;
					}
				
				$map['Lng']=$lng;
				$map['Lat']=$lat;
				return $map;
	}
?>


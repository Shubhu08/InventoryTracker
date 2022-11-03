<?php
	require('cc.php');
	function countnum($stat)
	{
		$pdo=connect();
		$sql="SELECT COUNT(*) as num FROM `trolley` WHERE `current-status`='".$stat."';"  ;
		$count=runqueryrow($pdo,$sql);
		return $count['num'];
	}

	function complete()
	{

	}

	function getmissingid()
	{

		$pdo=connect();
		$sql="SELECT tid, instate FROM `missing` ;"  ;
		$res=runqueryall($pdo,$sql);
		return $res;
	}

	if($_REQUEST['count'])
	{
		echo countnum("MIS");
	}
?>
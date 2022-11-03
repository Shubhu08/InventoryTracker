<?php
    require("invent-details.php");

    $filename ="trolley-inventory".date(dmY).".xls";
    header('Content-type: application/ms-excel');
    header('Content-Disposition: attachment; filename='.$filename);
    $pdo = connect();
    $sql = "SELECT baseid,name From base";
    $res= runqueryall($pdo,$sql);
    unset($stuff);

    foreach ($res as $row) {
        # code...
        $stuff=$stuff.$row['name']."\t".$row['baseid']."\t".countnum($row['baseid'])."\n";
        $sql1 = "SELECT tid FROM `trolley` WHERE `current-status`='".$row['baseid']."';";
        $res1 = runqueryall($pdo,$sql1);
        foreach ($res1 as $row1) {
            # code...
              $stuff=$stuff.$row1['tid']."\t\n";
        }
    }
    $stuff=$stuff."MISSING\t\n";
    $sql = "SELECT tid,instate From missing";
    $res= runqueryall($pdo,$sql);
    foreach ($res as $row) {
        # code...
        $stuff=$stuff.$row['tid']."\t".$row['instate']."\t\n";
    }

    echo $stuff;


?>
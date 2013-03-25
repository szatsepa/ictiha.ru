<?php
include '../main/qry_connect.php';

$query = "DELETE FROM `private_messages` WHERE `id` = {$_POST['id']}";

mysql_query($query);

$out = array('ok'=>NULL);

if(mysql_affected_rows()>0){
    $out['ok'] = 1;
}

echo json_encode($out);

mysql_close();
?>

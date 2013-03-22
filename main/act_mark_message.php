<?php

include 'qry_connect.php';

$out = array('ok'=> NULL);

$query = "UPDATE `private_messages` SET `status` = 1 WHERE `id` = {$_POST['msg']}";

mysql_query($query);

if(mysql_affected_rows()>0){
    $out['ok'] = 1;
}

echo json_encode($out);

mysql_close();
?>

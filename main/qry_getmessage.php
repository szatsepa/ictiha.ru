<?php
include 'qry_connect.php';

$query = "SELECT `message`
            FROM `private_messages`
            WHERE `id` = {$_POST['id']}";
            
$result = mysql_query($query);

$msg = mysql_result($result,0);

echo json_encode(array('msg'=>$msg));

mysql_close();
?>

<?php
include 'qry_connect.php';

$uid = intval($_POST['uid']);

$query = "SELECT CONCAT(u.name,' ',u.surname) AS sender, m.message, m.id FROM `private_messages` AS m, `users` AS u WHERE m.`recipient` = $uid AND m.`status` = 0 AND u.id = m.sender";

$result = mysql_query($query);

$messages = array();

if($result){
    
    while($row = mysql_fetch_assoc($result)){
        array_push($messages, $row);
    }
}

echo json_encode($messages);

mysql_close();
?>

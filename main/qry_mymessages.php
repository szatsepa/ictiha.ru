<?php

$uid = $user['id'];

$query = "SELECT u.`id` AS uid, CONCAT(u.name,' ',u.surname) AS sender, m.message, m.id FROM `private_messages` AS m, `users` AS u WHERE m.`recipient` = $uid AND m.`status` = 0 AND u.id = m.sender";

$result = mysql_query($query);

$messages = array();

if($result){
    
    while($row = mysql_fetch_assoc($result)){

        array_push($messages, $row);
    }
}
?>

<?php

$uid = $user['id'];

$status = 0;

if($attributes['act'] == 'archmsg')$status = 1;

$query = "SELECT u.`id` AS uid, CONCAT(u.name,' ',u.surname) AS sender, m.message, m.id FROM `private_messages` AS m, `users` AS u WHERE m.`recipient` = $uid AND m.`status` = $status AND u.id = m.sender";

$result = mysql_query($query);

$messages = array();

if($result){
    
    while($row = mysql_fetch_assoc($result)){

        array_push($messages, $row);
    }
}
?>

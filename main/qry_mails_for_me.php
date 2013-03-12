<?php
include 'qry_connect.php';

$uid = intval($_POST['uid']);

$Y = date("Y");
$m = date("m");
$d = date("d");

$query = "SELECT CONCAT(u.name,' ',u.surname) AS sender, m.message, m.id FROM `private_messages` AS m, `users` AS u WHERE m.`recipient` = $uid AND m.`status` = 0 AND u.id = m.sender AND (`read` = '$Y-$m-$d' OR `read` = '0000-00-00')";

$result = mysql_query($query);

$messages = array();

if($result){
    
    while($row = mysql_fetch_assoc($result)){
        
//        $row['now'] = date("Y-m-d");
//        $row['query'] = $query;
        array_push($messages, $row);
    }
}

$date_now = date("Y-m-d");

mysql_query("UPDATE `private_messages` SET `read` = '$date_now' WHERE `read` = '0000-00-00'" );

echo json_encode($messages);

mysql_close();
?>

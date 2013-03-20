<?php
header('Content-Type: text/html; charset=utf-8'); 

include 'qry_connect.php';

$query = "SELECT u.`id` , Concat(u.`surname` ,' ', u.`name`) AS name, c.`name` AS com
            FROM `users` AS u, `companies` AS c
            WHERE u.`role` =2 AND u.`company_id` = c.`id`
            ORDER BY com";

$result = mysql_query($query);

$out_string = "";

while ($row = mysql_fetch_assoc($result)){
    $out_string .= "<option value='{$row['id']}'>{$row['name']}- {$row['com']}</option>";
}

echo $out_string;

mysql_close();
?>

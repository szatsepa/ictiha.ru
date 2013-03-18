<?php
$uid = $user['id'];

$order_id = intval($attributes['oid']);

$query = "UPDATE `arch_zakaz` SET `tags` = '' WHERE `id` = $order_id";

mysql_query($query) or die($query);

?>

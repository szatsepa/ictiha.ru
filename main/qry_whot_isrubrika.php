<?php
include 'qry_connect.php';

$query = "SELECT r.name FROM rubrikator AS r, price AS p WHERE r.id = p.rubrika AND p.id = '{$_POST['pid']}'";

$result = mysql_query($query);

$name = mysql_result($result,0);

$name = ucfirst($name);

echo json_encode(array('data'=>$name));

mysql_close();
?>

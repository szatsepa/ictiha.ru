<?php

include("../main/qry_connect.php");

$status = intval($_POST['status']);
        
$id = intval($_POST['company_id']);

$query = "UPDATE `advert_company` SET `status` = $status WHERE `id` = $id";

mysql_query($query);

$out = array('ok'=>NULL, 'query'=>$query);

if(mysql_affected_rows()>0) $out['ok'] = 1;

echo json_encode($out);

mysql_close();
?>

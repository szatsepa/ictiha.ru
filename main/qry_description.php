<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include 'qry_connect.php'; 

$barcode = $_POST[barcode];

$aid = intval($_POST[aid]); 
  
$result = mysql_query("SELECT CONCAT(id,'.',extention) AS img FROM goods_pic WHERE pictype = 1 AND barcode = '$barcode'");

$imgs = mysql_fetch_assoc($result);

$out = array('img'=>$imgs[img]);

$result = mysql_query("SELECT CONCAT(gp.id,'.',gp.extention) AS img FROM goods_pic AS gp WHERE gp.barcode = (SELECT str_barcode FROM pricelist WHERE id = $aid)");

$tmp_array = array(); 

while ($var = mysql_fetch_assoc($result)){
    array_push($tmp_array, $var[img]);
}

$out['images'] = $tmp_array; 

echo json_encode($out);

mysql_close();
?>

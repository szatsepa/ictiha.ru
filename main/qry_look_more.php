<?php
include 'qry_connect.php';

$pid = intval($_POST['pid']);

$result = mysql_query("SELECT p.id,p.str_code1,p.str_barcode,p.str_name, CONCAT(g.id,'.',g.extention) AS img
                        FROM pricelist AS p, goods_pic AS g
                        WHERE p.pricelist_id=$pid AND num_amount > 0 AND p.str_barcode = g.barcode AND g.pictype = 1");

$tmp_arr = array();

while($var = mysql_fetch_assoc($result)){
    
    array_push($tmp_arr, $var);
}

$out = array();

$skoka = 4;

if(count($tmp_arr)<4) $skoka = count ($tmp_arr);

while(count($out) < $skoka){
     
    $num_art = rand(0, count ($tmp_arr));
    
    if($tmp_arr[$num_art]){
        
            array_push($out, $tmp_arr[$num_art]); 
            
            array_unique($out);
        }    
}



echo json_encode($out);

mysql_close();
?>

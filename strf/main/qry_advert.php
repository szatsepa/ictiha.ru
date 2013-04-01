<?php

/*
 * created by arcady.1254@gmail.com
 */
$stid = intval($attributes[stid]);

$advert_array = array();


$res = mysql_query("SELECT c.id FROM advert_company AS c,  storefront_reklama AS s WHERE c.status = 1 AND c.id = s.company_id AND s.storefront_id = $stid ORDER BY c.id");

while ($row = mysql_fetch_assoc($res)){ 
    
    $tmp_arr = array();
    
    $query = "SELECT `name`, `where_from`  FROM storefront_reklama WHERE storefront_id = $stid AND company_id = {$row['id']} ORDER BY company_id";

    $result = mysql_query($query) or die($query);

    while ($var = mysql_fetch_assoc($result)){

    
        array_push($tmp_arr, $var);
    
    }
    
    array_push($advert_array, $tmp_arr);
    
    unset ($tmp_arr);    

   mysql_free_result($result); 
}

mysql_free_result($res);

?>

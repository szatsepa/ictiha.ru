<?php

/*
 * created by arcady.1254@gmail.com
 */
//
//if(!isset ($_SERVER['SERVER_NAME'])){} 
// 
// if(isset ($attributes[stid])){
//        $st_id = $attributes[stid];     
//     }  else {
//         
//         $st_id = 26;
//     } 


$query = "SELECT domen, where_res FROM storefront WHERE id = 26";

$result = mysql_query($query) or die($query);

$row = mysql_fetch_assoc($result);

$domen = $row[domen];

$resurs = $row[where_res];

$_SERVER['SERVER_NAME'] = $domen;

$_SESSION[resurs] = $resurs;

//echo $query;

unset ($domen);

mysql_free_result($result);
?>

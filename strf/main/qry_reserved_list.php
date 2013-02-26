<?php 
// Получаем споисок всех корзин (прайсов с заказами) для текущего пользователя


$user_id = $_SESSION[user]->data[id];

if($_SESSION[auth] == 1){
    
    $who = "user_id";
    
}  else {
    
    $who = "customer";
    
}

$stid = intval($_SESSION[stid]);

$query = "SELECT DISTINCT c.price_id 
         FROM  reserved_items  AS c, storefront_data AS std
         WHERE c.$who=$user_id AND c.price_id = std.price_id AND std.storefront_id = $stid
         ORDER BY c.price_id";


$qry_reservedlist = mysql_query($query) or die($query);

?>
<?php

if (isset($attributes['pricelist_id']) and $attributes['pricelist_id'] > 0) {

    $pricelist_id = intval($attributes['pricelist_id']);
    
}

if (isset($pricelist_id)) {

	$query = "DELETE FROM cart WHERE user_id=".$user["id"]." AND price_id=".$pricelist_id;
        
	mysql_query($query) or die($query);
	
} 


//заодно удалим из корзины просроченые това ры если таковые имеються

$query = "DELETE cart FROM cart, price WHERE price.id = cart.price_id AND price.expiration < Now() AND  price.expiration > '0000-00-00'";

mysql_query($query);
?>
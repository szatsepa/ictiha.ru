<?php 

//$query2 = "SELECT * FROM cart ORDER BY Id";
//$qry_cart = mysql_query($query2) or die($query2);

// Для демо-режима разрешим только один прайс-лист
/*if (isset(user["role"]) and user["role"] == 2) {
	$attributes[pricelist_id] = 1;
}*/

if($attributes['act'] == 'step1' or $attributes['act'] == 'step2'){
   $attributes[pricelist_id] = 0;
}

if(isset($attributes['border']) and $attributes['border'] == "max") {
	$query = "SELECT p.id,p.str_code1,p.str_barcode,CONCAT(g.id,'.',g.extention) AS img,p.str_name,p.str_state,p.str_volume,p.str_package,p.num_price_single,p.num_price_pack,p.num_amount,
                     p.expiration,p.pricelist_id
                    FROM pricelist AS p, goods_pic AS g  
                    WHERE p.str_barcode = g.barcode AND p.pricelist_id={$attributes['pricelist_id']} AND  p.num_amount > 0 AND (p.expiration > Now() OR  p.expiration = '0000-00-00') AND g.pictype = 1 AND g.pictype = 1 ORDER BY p.num_amount DESC";
}

if(isset($attributes['border']) and $attributes['border'] == "min") {
	$query = "SELECT p.id,p.str_code1,p.str_barcode,CONCAT(g.id,'.',g.extention) AS img,p.str_name,p.str_state,p.str_volume,p.str_package,p.num_price_single,p.num_price_pack,p.num_amount,
                     p.expiration,p.pricelist_id
                    FROM pricelist AS p, goods_pic AS g  
                    WHERE p.str_barcode = g.barcode AND p.pricelist_id={$attributes['pricelist_id']} AND  p.num_amount > 0 AND (p.expiration > Now() OR  p.expiration = '0000-00-00') AND g.pictype = 1 ORDER BY p.num_amount";
}

if(isset($attributes['group']) and $attributes['group'] != "") {
	$query = "SELECT p.id,p.str_code1,p.str_barcode,CONCAT(g.id,'.',g.extention) AS img,p.str_name,p.str_state,p.str_volume,p.str_package,p.num_price_single,p.num_price_pack,p.num_amount,
                     p.expiration,p.pricelist_id
                    FROM pricelist AS p, goods_pic AS g 
                    WHERE p.str_barcode = g.barcode AND p.pricelist_id={$attributes['pricelist_id']} AND p.str_group = '{$attributes['group']}' AND  p.num_amount > 0 AND (p.expiration > Now() OR  p.expiration = '0000-00-00') AND g.pictype = 1";
}

if(isset($attributes['pricelist_id']) and isset($attributes['artikul']) and $attributes['act'] !='add_cart'){
	$query = "SELECT p.id,p.str_code1,p.str_barcode,CONCAT(g.id,'.',g.extention) AS img,p.str_name,p.str_state,p.str_volume,p.str_package,p.num_price_single,p.num_price_pack,p.num_amount,p.pricelist_id
                FROM pricelist AS p, goods_pic AS g 
                WHERE p.str_barcode = g.barcode AND p.pricelist_id={$attributes['pricelist_id']} AND p.str_code1='{$attributes['artikul']}' AND  p.num_amount > 0 AND (p.expiration > Now() OR  p.expiration = '0000-00-00') AND g.pictype = 1";
}


if (isset($attributes['group']) and $attributes['group'] == ''){
    unset($attributes['group']);
    unset($attributes['border']);
}

if (isset($attributes['border']) and $attributes['border'] == ''){
    unset($attributes['group']);
    unset($attributes['border']);
}

// Выборка по умолчанию
// --Здесь убрано num_amount > 0
if(!isset($attributes['group']) and !isset($attributes['border'])) {

	if ($attributes[act] =='single_price' or $attributes[act] =='add_cart' or $attributes[act] == 'add_favprice' or $attributes[act] == 'edit_price') {
   
		$query = "SELECT p.id,
                                p.str_code1,
                                p.str_barcode,
                                CONCAT(g.id,'.',g.extention) AS img,
                                p.str_name,
                                p.str_state,
                                p.str_volume,
                                p.str_package,
                                p.num_price_single,
                                p.num_price_pack,
                                p.num_amount,
                                p.expiration,
                                p.pricelist_id
                                
	              FROM   pricelist AS p LEFT JOIN goods_pic AS g ON p.str_barcode = g.barcode
	              WHERE  p.pricelist_id={$attributes['pricelist_id']} AND
				  		 p.str_code2 <> 'X' AND 
						 p.num_amount > 0 AND (p.expiration > Now() OR  p.expiration = '0000-00-00') AND g.pictype = 1
	              ORDER  BY p.id";
	}
		
}

if(isset($attributes['find']) and isset($attributes['pricelist_id'])){
    $query = "SELECT p.id,
                                p.str_code1,
                                p.str_barcode,
                                CONCAT(g.id,'.',g.extention) AS img,
                                p.str_name,
                                p.str_state,
                                p.str_volume,
                                p.str_package,
                                p.num_price_single,
                                p.num_price_pack,
                                p.num_amount,
                                p.expiration,
                                p.pricelist_id
                                
	              FROM   pricelist AS p LEFT JOIN goods_pic AS g ON p.str_barcode = g.barcode
               
              WHERE  p.pricelist_id={$attributes['pricelist_id']} AND
			  		 p.str_code2 <> 'X' AND (p.expiration > Now() OR  p.expiration = '0000-00-00') AND g.pictype = 1 AND
    MATCH (p.`str_name`) 
                            AGAINST ('{$attributes['word']}') 
              ORDER  BY p.id";
}

$qry_price = mysql_query($query) or die($query);


    $query3 = "SELECT DISTINCT str_group FROM pricelist WHERE pricelist_id={$attributes['pricelist_id']} AND (expiration > Now() OR  expiration = '0000-00-00') ORDER BY str_group";
    $qry_group = mysql_query($query3) or die($query3);
    
    
    if ($authentication == "yes") {
    $user_for_select = $attributes['user_id'];
    } else {
        $user_for_select = 0;
    }
    
    $query4 = "SELECT user_id FROM kabinet 
              WHERE price_id={$attributes['pricelist_id']}
              AND user_id=$user_for_select";
    $qry_favorite = mysql_query($query4) or die($query4);
    
    $query5 = "SELECT p.id,
                      p.comment price_name,
                      c.id company_id,
                      c.name company_name,
                      p.status,
		      p.type,
		      p.zakaz_limit
               FROM price AS p, companies AS c
               WHERE p.company_id = c.id AND
                     p.id = {$attributes['pricelist_id']}";
    
    $qry_aboutprice = mysql_query($query5) or die($query5);
    
?>

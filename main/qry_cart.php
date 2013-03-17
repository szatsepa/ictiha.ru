<?php 

if (!isset($user["id"])) {
    $current_user = 0;
} else {
    $current_user = $user["id"];
}

if (!isset($attributes['pricelist_id'])) {
	$pricelist_id = 0;
} else {
	$pricelist_id = $attributes['pricelist_id'];
}

if($price_id){
    $pricelist_id = $price_id;
}

// Это Торговый?
if (isset($_SESSION['torg']) and $_SESSION['torg'] > 0) {
	
	if (intval($customer_zakaz) == 0) {
	
		$customer_zakaz = $_SESSION['torg'];
	
	}
	
	// Выберем по Заказчику и Торговому
	$curr_condition = " AND b.torg=".$user["id"]." AND b.user_id=".$customer_zakaz." ";
	
	
} else {
	
	// Обычный заказчик
	$curr_condition = " AND b.user_id=".$current_user;
	
}

$query = "DELETE `cart` 
            FROM `cart`, `pricelist`,`price` 
            WHERE `pricelist`.`pricelist_id` = $pricelist_id 
            AND `cart`.`price_id` = `price`.`id` 
            AND (`pricelist`.`expiration` > '0000-00-00' AND `pricelist`.`expiration`< Now())
            AND `cart`.`artikul` = `pricelist`.`str_code1`";

mysql_query($query);

$query = "SELECT a.str_code1,
                a.str_barcode,
                a.str_code2,
                a.str_name, 
                a.str_state,
                a.str_volume, 
                a.str_package,
                a.num_price_single,
                a.num_price_pack,
                b.num_amount,
                b.num_discount,
                b.user_id,
                b.torg,
                a.id,
                a.pricelist_id,
                p.company_id,
                c.name AS company_name,
                b.parent_zakaz,
                p.type,
                p.zakaz_limit,
                IF(a.expiration < Now(), '#E3F5BF', '#F5BFE6') AS exp
          FROM pricelist a, cart b, price p,companies c
         WHERE a.str_code1 = b.artikul
           AND a.pricelist_id = b.price_id
           AND a.pricelist_id = p.id
           AND p.company_id=c.id
           $curr_condition
           AND a.pricelist_id=$pricelist_id AND
               a.str_code2 <> 'X'
      ORDER BY a.id";

//echo $query."<br>"; 
//exit;

$qry_cart = mysql_query($query) or die($query);


if (mysql_num_rows($qry_cart) > 0) {
	
	$price_id = mysql_result($qry_cart,0,"pricelist_id");

	// Id Торгового, который возможно делал заказ
	$torgovy_id = intval(mysql_result($qry_cart,0,"torg"));
	
	// id компании, которой принадлежит прайс
	$price_company_id = mysql_result($qry_cart,0,"company_id");
	
	$query_i = "SELECT inn,
                        contragent
                    FROM companies
                    WHERE id = $price_company_id";
	
	$qry_inn = mysql_query($query_i) or die($query_i);
	
	$attributes[contragent_id]   = mysql_result($qry_inn,0,"inn");
	$attributes[contragent_name] = htmlspecialchars(mysql_result($qry_inn,0,"contragent"));
		
	mysql_data_seek($qry_cart,0);

} else {
	$price_id = '';
}
 

$query = "SELECT MAX(id) FROM cart";

$qry_id = mysql_query($query) or die($query);

$num_rows	=	mysql_numrows($qry_cart);

$num_fields	=	mysql_num_fields($qry_cart);
?>

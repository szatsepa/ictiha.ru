<?php

// Соберем статистику о пользователе
$ip         = $_SERVER["REMOTE_ADDR"];
$resolution = quote_smart($attributes['scr_width']."x".$attributes['scr_height']);
$agent      = quote_smart($_SERVER["HTTP_USER_AGENT"]);

// Время отсроченного заказа
// Проверок здесь нет из-за демонстрационных целей
$exe_time = '';

if ($attributes['day'] != '' and $attributes['mon'] != '' and $attributes['year'] != '') {

	$exe_time = $attributes['year']."-".$attributes['mon']."-".$attributes['day'];
	
	if ($attributes['hh'] != '' and $attributes['mm'] != '') {
	
		$exe_time .= " ".$attributes['hh'].":".$attributes['mm'].":00"; 
	
	} else {
	
		$exe_time .= " 00:00:00";
	
	}
	
}

// Определимся со статусом заказа
if(isset($demo)) {
    $status = 4;
} else {
    $status = 1;
}


$query = "INSERT INTO arch_zakaz 
          (user_id,
           time,
           exe_time,
           contragent_id,
           contragent_name,
           email,
           phone,
           shipment,
           comments,
           status,
           ip,
           resolution,
           agent,
           tags) 
          VALUES 
          ($user[id],
           now(),
           NULLIF('$exe_time',''),
          '{$attributes['contragent_id']}',
          '{$attributes['contragent_name']}',
          '{$attributes['email']}',
          '{$attributes['phone']}',
          '{$attributes['shipment']}',
          '{$attributes['comments']}',
           $status,
          '$ip',
           $resolution,
           $agent,
          '{$attributes['tags']}')";

$qry_add = mysql_query($query) or die($query);

//echo $query."<br>";

$zakaz = mysql_insert_id();

$query = "INSERT INTO arch_goods 
          (zakaz,
           user_id,
           artikul,
           price_id,
           amount,
           discount,
           name,
           price_single)
          SELECT $zakaz,
                 {$user['id']} AS id,
                 c.artikul,
                 c.price_id,
                 c.num_amount,
                 c.num_discount,
                 p.str_name,
                 p.num_price_single 
          FROM cart c, pricelist p, price pr 
          WHERE p.str_code1    = c.artikul 
            AND p.pricelist_id = c.price_id 
            AND p.pricelist_id = pr.id 
            AND (pr.expiration > Now() OR  pr.expiration = '0000-00-00')
            AND c.price_id     = $pricelist_id  
            AND c.user_id      = {$user['id']} AND 
			p.str_code2 <> 'X'";

$qry_add = mysql_query($query) or die($query);

//echo $query."<br>";

if(mysql_affected_rows() == 0){
    
//    как ежели товари все просрочены и с заказом не ассоциируеться ни одна строка в arch_goods удалим заказ из таблицы вообще
    
    mysql_query("DELETE FROM `arch_zakaz` WHERE `id` = $zakaz");
    
    ?>
<script type="text/javascript">
    alert("Заказ состоял из просроченных товаров и анулирован!");
    document.location = "index.php";
</script>
<?php
    
}else{
    // Внесем информацию и в историю заказа
    $query2 = "INSERT INTO zakaz_history 
                            (id,
                            time,
                            status,
                            user_id)
                        VALUES 
                                ($zakaz,
                            now(),
                            $status,
                            {$user['id']})";

    $qry_zakazhistory = mysql_query($query2) or die($query2);

}

?>
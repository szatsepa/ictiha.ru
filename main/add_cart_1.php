<?php

// Определимся с Заказчиком, для которого добавляем товар.
// Торговый делает заказ для клиента?

include 'qry_connect.php';

////include 'act_quotesmart.php';

$out = array('ok'=>"1");

$aid = intval($_POST[aid]);

$mobile = $_POST[mobile];

if (isset($_SESSION['torg']) and $_SESSION['torg'] > 0) {

	$customer = $_SESSION['torg'];
	
	// Для "запоминания" Торгового в корзине
	$set_torg = ",torg = ".$_POST["uid"];

} else {
	
	// Обычный заказчик
	$customer = intval($_POST["uid"]);
	$set_torg = '';
}

if ($mobile == 'false') {

	// Избавимся от "неправильных" значений
	if (!is_numeric($_POST[amount])) {
		$_POST[amount] = 1;
	}
			
	$_POST[amount] = intval($_POST[amount]);
	
	if ($_POST[amount] <= 0) {
		$_POST[amount] = 1;
	}
	
	
		
	$add_message = '0';
	
	if (isset($_POST[package])) {
	
	    $add_message = " Возможен заказ только полных упаковок.";
	    
	    // Сколько полных упаковок?
	    $packages = ceil ($_POST[amount] / $_POST[package]);
	    
	    // Новое количество товара с учетом полных упаковок
	    $_POST[amount] = $packages * $_POST[package];
	}
	
	// Попытаемся обновить существующие записи в корзине
	$query   = "UPDATE cart 
                       SET num_amount   = (num_amount + $_POST[amount]),
                           num_discount = '$_POST[discount]',
                           time         = now() 
                     WHERE user_id    = $customer AND
                           artikul    = (SELECT str_code1 FROM pricelist WHERE id = $aid) AND
                           price_id   = '$_POST[pid]'";
				   
	$query_try = mysql_query($query) or die($query);
	
	// Таких записей нет, делаем простой INSERT
	if (mysql_affected_rows() == 0) {
		$query = "INSERT INTO cart 
		          (num_amount,
		           num_discount,
		           user_id,
		           artikul,
		           price_id,
		           time) 
		          VALUES 
		          ($_POST[amount],
		          '$_POST[discount]',
		           $customer,
		          (SELECT str_code1 FROM pricelist WHERE id = $aid),
		          '$_POST[pid]',
		           now())";
		           
		$qry_add = mysql_query($query) or die($query);
	}
        
//        $out['query'] = $query;
	
	$query = "SELECT num_amount,pricelist_id 
	          FROM   pricelist 
	          WHERE  id    = $aid AND 
	                 pricelist_id = $_POST[pid] AND 
					 str_code2 <> 'X'";
					 
	$qry_row = mysql_query($query) or die($query);
	$current_amount = mysql_result($qry_row,0,'num_amount');
	$pid = mysql_result($qry_row,0,'pricelist_id');
	
	if ($current_amount != 999999999 and !isset($demo)) {
	    $query = "UPDATE pricelist 
	             SET num_amount = ($current_amount - $_POST[amount]) 
	             WHERE id    = $aid AND 
	                   pricelist_id = $_POST[pid] AND 
					   str_code2 <> 'X'";
	    $qry_row = mysql_query($query) or die($query);
	}
	
	// Обновим время укладки в корзину для всех товаров текущего пользователя
	// Это необходимо для корректной чистки корзины от "устаревших" товаров
	// Также, добавим торгового, елси нужно
	
	$query = "UPDATE cart SET time = now() ".$set_torg." 
                   WHERE user_id  = $customer AND 
			 price_id = $_POST[pid]";
	
	$qry_row = mysql_query($query) or die($query);
	
	
	// Пропишем в корзине id заказа, из которого создан данный заказ
	if (isset($parent_zakaz) and $parent_zakaz > 0) {
	
		$query = "UPDATE cart SET parent_zakaz = $parent_zakaz  
			   WHERE user_id  = $customer AND 
			         price_id = $_POST[pid]";
		
		$qry_parent_zakaz = mysql_query($query) or die($query);
	
	}
	
	//print_r ($_POST);
	

} else {
// Мобильная версия добавления в корзину
	//print_r ($_POST);
	
	$artikul  = array();
	$amount   = array();
	$discount = array();
	$package  = array();
	
	if(isset($_POST[goods]) and $_POST[goods] > 0) {
		$goods_recieved = $_POST[goods];
	} else {
		//break;
	}
	
	$goods_added  = 0;
	
	for ($i=0;$i < $goods_recieved; ++$i){
	
		$cur_artikul  = "artikul".$i;
		$cur_amount   = "amount".$i;
		$cur_discount = "discount".$i;
		$cur_exist    = "exist".$i;
		$cur_package  = "package".$i;
		
		if ($_POST[$cur_amount] != '' and is_numeric($_POST[$cur_amount]) and $_POST[$cur_amount] >= 0) {
			// Есть предыдущий заказанный товар?
			if (isset($_POST[$cur_exist]) and is_numeric($_POST[$cur_exist]) and $_POST[$cur_exist] > 0) {
				$amount[$goods_added] = $_POST[$cur_amount] - $_POST[$cur_exist];
			} else {
				$amount[$goods_added] = $_POST[$cur_amount];
			}
			
			// Товар заказывается упаковками?
			if (isset($_POST[$cur_package]) and is_numeric($_POST[$cur_package]) and $_POST[$cur_package] > 0) {
				$package[$goods_added] = $_POST[$cur_package];
			}
			
			// To do берем значения без проверки!!!
			$artikul[$goods_added]  = $_POST[$cur_artikul];
			$discount[$goods_added] = $_POST[$cur_discount];		
			
			++$goods_added;
		}
	}
	
	$add_message = '';
	
	// Укладываем заказ в базу
	for ($j=0;$j < $goods_added; ++$j){
		
		// Есть "упаковки"?
		if (isset($package[$j]) and $package[$j] > 0) {	
		    $add_message = " Возможен заказ только полных упаковок.";
		    
		    // Сколько полных упаковок?
		    $packages = ceil ($amount[$j] / $package[$j]);
		    
		    // Новое количество товара с учетом полных упаковок
		    $amount[$j] = $packages * $package[$j];
		}
		
		// Попытаемся обновить существующие записи в корзине
		$query   = "UPDATE cart 
                                SET num_amount   = (num_amount + ".$amount[$j]."),
                                    num_discount = '".$discount[$j]."',
                                    time         = now() 
                                WHERE user_id    = $customer AND
                                    artikul    = '".$artikul[$j]."' AND
                                    price_id   = ".$_POST[pid];
		//echo $query;			   
		$query_try = mysql_query($query) or die($query);
		
		// Таких записей нет, делаем простой INSERT
		if (mysql_affected_rows() == 0) {
			$query = "INSERT INTO cart 
			          (num_amount,
			           num_discount,
			           user_id,
			           artikul,
			           price_id,
			           time) 
			          VALUES 
			          (".$amount[$j].",
			          '".$discount[$j]."',
			           $customer,
			          '".$artikul[$j]."',
			           $_POST[pid],
			           now())";
			           
			$qry_add = mysql_query($query) or die($query);
		}
		
		$query = "SELECT num_amount,pricelist_id 
                        FROM   pricelist 
                        WHERE  str_code1    = '".$artikul[$j]."' AND 
                                pricelist_id = $_POST[pid] AND 
					 str_code2 <> 'X'";
		$qry_row = mysql_query($query) or die($query);
		$current_amount = mysql_result($qry_row,0,'num_amount');
		$pid = mysql_result($qry_row,0,'pricelist_id');
		
		if ($current_amount != 999999999 and !isset($demo)) {
		    $query = "UPDATE pricelist 
                                 SET num_amount = ($current_amount - ".$amount[$j].") 
                                 WHERE str_code1    = '".$artikul[$j]."' AND 
		                   pricelist_id = $_POST[pid] AND 
					 	   str_code2 <> 'X'";
		    $qry_row = mysql_query($query) or die($query);
		}
	
		// Обновим время укладки в корзину для всех товаров текущего пользователя
		// Это необходимо для корректной чистки корзины от "устаревших" товаров
		// Добавим тогового, если нужно
		
		$query = "UPDATE cart SET time = now() ".$set_torg." 
                            WHERE user_id  = $customer AND 
                                price_id = $_POST[pid]";
		$qry_row = mysql_query($query) or die($query);
	
	
	}
	
	// Подчищаем нулевые значения остатка в корзине
	$query2 = "DELETE FROM cart 
                    WHERE user_id  = $customer AND 
                        price_id = $_POST[pid] AND 
                        num_amount = 0";
	$qry_del = mysql_query($query2) or die($query2);
	//print_r ($artikul);
	//print_r ($amount);
	//print_r ($discount);
}



echo json_encode($out); 

mysql_close();
?>

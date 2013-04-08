<div>
<?php

$field_count	=	0;

$array_fields = array();

while ($field_count < $num_fields) {

	$array_fields[$field_count] = mysql_field_name($qry_cart, $field_count);
        
	++$field_count;
}

if($qry_cart)mysql_data_seek($qry_cart, 0);

$fields = array ("Артикул","Штрих-код","&nbsp;","Наименование","Страна","Емкость","Фасовка","Цена ед.","Цена кор.","Кол-во (шт.)","Скидка");

 echo "<table class='cart' id='my_cart_$price_id'><thead><tr>";
 
 // Выводим заголовок таблицы
$th = 0;
while ($th < count($fields)) {
    
    if($mobile = 'false'){
       

        if ($attributes['act'] == 'step2' or $attributes['act'] == 'step1' or $attributes['act'] == 'kabinet') {
            echo "<th class='cart'>".$fields[$th]."</th>";
        }

    }else{
         if (($th == 3 or $th == 9 or $th == 10)) {
            echo "<th class='cart'>".$fields[$th]."</th>";
        }
    }
    
    
    
	++$th;
}

// Место под кнопку
if ($attributes['act'] == 'step1' or $attributes['act'] == 'kabinet') {
    echo "<th class='cart' colspan='2'>&nbsp;</th>";
}
 
 echo "</tr><thead><tbody>";
 
$row_count = 0;

$total = 0;

while ($row_count < $num_rows) {
    
    echo "<tr id='".$row_count."'>";
    
    $field_count = 0;
    
    while ($field_count < $num_fields) {
        
        $dat = mysql_result($qry_cart,$row_count,$array_fields[$field_count]);
        
        if($mobile == 'false'){
            if($field_count<11){
                   echo "<td class='cart'>".$dat."</td>";
                    
                    
            }

            if ($field_count == 11 and ($attributes['act'] == 'step1' or $attributes['act'] == 'kabinet')) {
                $artikul = mysql_result($qry_cart,$row_count,$array_fields[0]);
                echo "<td class='cart' style='border:none'><form action='index.php?act=delcart' method='post'><input type='hidden' name='artikul' value='".$artikul."'><input type='hidden' name='query_str' value='".$_SERVER['QUERY_STRING']."'><input class='submit3' type='submit' value='X'></form></td>";
            }
        }else{
            if($field_count==3 or $field_count == 9 or $field_count==10){
                echo "<td class='cart'>".$dat."</td>";
            }
            if ($field_count == 11 and ($attributes['act'] == 'step1' or $attributes['act'] == 'kabinet')) {
                $artikul = mysql_result($qry_cart,$row_count,$array_fields[0]);
                echo "<td class='cart' style='border:none'><form action='index.php?act=delcart' method='post'><input type='hidden' name='artikul' value='".$artikul."'><input type='hidden' name='query_str' value='".$_SERVER['QUERY_STRING']."'><input class='submit3' type='submit' value='X'></form></td>";
            }
        }
        
        
            
        $field_count++;
    }   
    
    echo "</tr>";
    
    $single_price = mysql_result($qry_cart,$row_count,$array_fields[7]);
    $amount       = mysql_result($qry_cart,$row_count,$array_fields[9]);
    $price_id     = mysql_result($qry_cart,$row_count,$array_fields[12]);
    $zakaz_limit  = mysql_result($qry_cart,$row_count,$array_fields[16]);
    
    $total += $single_price*$amount;
    
    $row_count++;
}
$colspan = 9;
if ($mobile == 'true' and $attributes['act'] == 'step1') $colspan = 2;
if ($attributes['act'] == 'step2') $colspan = 7;
if ($total == 0) {
    echo"<tr><td id='no_items' colspan='".$colspan."'>В корзине нет товаров</td><td colspan='2' align='right'>&nbsp;</td></tr>";
}else{
    echo"<tr><td colspan='".$colspan."' style='text-align:right;'><strong>Итого:</strong></td><td id='how_meny' colspan='3' align='left'><strong>$total руб.</strong></td></tr>";
}
 
 echo "</tbody></table>";
?>  
</div>
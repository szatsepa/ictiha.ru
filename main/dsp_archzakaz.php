<?php 

$status = array('1'=>"рассматривается поставщиком",'2'=>"подтвержден поставщиком",'3'=>"отменен",'4'=>"демо-заказ",'5'=>"отгружен поставщиком",'6'=>"выполнен");
//print_r($archorder);
//echo "<br>";
?>

<br />
<div style="margin-left:10px;">
   <?php if($user['role'] == 2){
       ?>
    <p>
        <strong>
            <?php echo $customer;?>
        </strong>
    </p>   
    <?php
   }
?>
<p><strong>Статус заказа:</strong> <?php
    echo $status[$archorder["status"]];
   echo "</p>";
    
    if($archorder["decline_comment"] != "") { ?>
<p><strong>Причина:</strong>&nbsp;&nbsp;<?php echo $archorder["decline_comment"]."</p>";
    
     }  ?> 
<br />
<table>
    <tr>
	<td>N заказа:&nbsp;</td>
	<td><?php echo $attributes['id']; ?></td>
</tr>
<tr>
	<td>Дата, время:&nbsp;</td>
	<td><?php echo $archorder["zakaz_date"]; ?></td>
</tr>
<tr>
	<td>E-mail менеджера:&nbsp;</td>
	<td><?php echo $archorder["email"]; ?></td>
</tr>
<tr>
	<td>ИНН:</td>
	<td><?php echo $archorder["contragent_id"]; ?></td>
</tr>
	<td>Наименование контрагента:</td>
	<td><?php echo $archorder["contragent_name"]; ?></td>
</tr>
<tr>
	<td>Адрес доставки:</td>
	<td><?php echo $archorder["shipment"]; ?></td>
</tr>
<tr>
	<td>Пожелания заказчика:</td>
	<td><?php echo $archorder["comments"]; ?></td>
</tr>
<tr>
	<td>Отсрочить до:&nbsp;</td>
	<td><?php echo $archorder["exe_date"]; ?></td>
</tr>
<?php if(isset ($attributes['store']))
{
    echo "<tr>
   
    <td>Заказчик:&nbsp;</td>
        
    <td>".$archorder["surname"]." ".$archorder["name"]."</td>
</tr>";
}
?>

</table>

<br />
<?php
// Выводим корзину архивного заказа

$num_rows	=	mysql_numrows($qry_archgoods);
$num_fields	=	mysql_num_fields($qry_archgoods);

$field_count	=	0;

$array_fields = array();

while ($field_count < $num_fields) {

	$array_fields[$field_count] = mysql_field_name($qry_archgoods, $field_count);
	++$field_count;
}

$fields = array ("Наименование","Цена ед.","Кол-во (шт.)","Скидка");
echo "<table class='cart'>";

// Выводим заголовок таблицы
$th = 0;
while ($th < count($fields)) {
    echo "<th class='cart'>".$fields[$th]."</th>";
	++$th;
}

while ($row_count < $num_rows) {
	echo "<tr>";	
	$field_count 	= 	0;	
	while ($field_count < $num_fields) {
        $dat = mysql_result($qry_archgoods,$row_count,$array_fields[$field_count]);
	    echo "<td class='cart'>".$dat."</td>";        			
		++$field_count;
	} 
	echo "</tr>";
    
    $single_price = mysql_result($qry_archgoods,$row_count,$array_fields[1]);
    $amount       = mysql_result($qry_archgoods,$row_count,$array_fields[2]);
    
	if ($amount == 0) {
	
		echo "<tr><td colspan='4'><strong>Внимание, позиция была удалена поставщиком!</strong></td></tr>";
	
	}
	
    $total += $single_price*$amount;
       
	++$row_count;
}

echo"<tr><td colspan='3'>&nbsp;</td><td align='right'>Итого: ".$total."руб. </td></tr>";
echo "</table>";

if (!isset($attributes['zakaz'])) {
?>
<br />
<?php if ($total > 0 and $user['role'] != 2) {?>
<form action="index.php?act=create_similar&amp;id=<?php echo $attributes['id'].$urladd; ?>" method="post"><input type="Submit" value="Сформировать похожий заказ сейчас" ></form><?php } ?>&nbsp;<?php 
    if ($attributes['dsp'] == 'decline') include ("main/dsp_declinezakaz.php");
} 
if (isset($attributes['dsp']) and $attributes['dsp'] == 'accept') {?>
<br /><form action="index.php?act=zakaz_accept&amp;id=<?php echo $attributes['id'].$urladd; ?>" method="post"><input type="Submit" value="Подтвердить заказ" ><input type='hidden' name='status' value='2'></form>&nbsp;<?php include ("main/dsp_declinezakaz.php"); ?>
<?php } 
if (isset($attributes['dsp']) and $attributes['dsp'] == 'accepted') {?>
<br /><form action="index.php?act=zakaz_accept&amp;id=<?php echo $attributes['id'].$urladd; ?>" method="post"><input type="Submit" value="Заказ отгружен" ><input type='hidden' name='status' value='5'></form>&nbsp;<?php include ("main/dsp_declinezakaz.php"); ?>
<?php }
if (isset($attributes['dsp']) and $attributes['dsp'] == 'fin') {?>
&nbsp;<form action="index.php?act=zakaz_accept&amp;id=<?php echo $attributes['id'].$urladd; ?>" method="post"><input type="Submit" value="Заказ выполнен" ><input type='hidden' name='status' value='6'><input type='hidden' name='dsp' value='kabinet'></form>
<?php }
if (isset($attributes['dsp']) and $attributes['dsp'] == 'shipped' and $user['role'] == 3) {?>
<br /><?php include ("main/dsp_declinezakaz.php"); ?>
<?php } ?>
</div>
<?php
	// Выясним текущий минимальный заказ для прайса
	mysql_data_seek($qry_aboutprice,0);
	$row = mysql_fetch_assoc($qry_aboutprice);
	$zakaz_limit = $row["zakaz_limit"];
?>

<script type="text/javascript">
	$(document).ready(function(){
            
        
    $('#addrecord_btn').click(function() {
            /*
            o_ced = $(this).parent().prev().prev().prev();
            o_kor = $(this).parent().prev().prev();
            o_am  = $(this).parent().prev();
            
            num_price_single = o_ced.children().val();
            num_price_pack   = o_kor.children().val();
            num_amount       = o_am.children().val();
            
             $("#edit").load('index.php',{'act':'updsingleitem',
                                                'num_price_single':num_price_single,
                                                'num_price_pack':num_price_pack,
                                                'num_amount':num_amount,
                                                'butt_id':$(this).attr("id")}); 
            
            alert (num_price_single + ' ' + num_price_pack + ' ' + num_amount);
            */
            
            $("#addrecord_msg").text(" Идет запись информации...");
            
            $("#addrecord_msg").load('index.php',{'act':'addrecord',
                                                'str_code1':$("#str_code1").val(),
                                                'str_barcode':$("#str_barcode").val(),
                                                'str_name':$("#str_name").val(),
                                                'str_state':$("#str_state").val(),
                                                'str_volume':$("#str_volume").val(),
                                                'str_package':$("#str_package").val(),
                                                'num_price_single':$("#num_price_single").val(),
                                                'num_price_pack':$("#num_price_pack").val(),
                                                'num_amount':$("#num_amount").val(),
                                                'str_group1':$("#str_group1").val(),
                                                'str_group2':$("#str_group2").val(),
                                                'expiration':$("#expiration").val(),
                                                'pricelist_id':<?php echo $attributes[pricelist_id];?>
                                            }); 
            
            return false;
        });
 
	$('#expiration_btn').click(function() {
            
			$("#addrecord_msg").append("");
			
            $("#addrecord_msg").load('index.php',{'act':'addexpiration',
                                                'expiration':$("#expiration").val(),
                                                'pricelist_id':<?php echo $attributes[pricelist_id];?>}); 
            
            return false;
        });
     });
    
</script>

<div class="box" id="nostyle_table">

	<p id="addrecord_msg">&nbsp;</p>

	<div class="boxContent">
		<table>
		<?php 
		
		if ($price_type == 1) {  
			$fields2 = array ("Арт.","Ш-код","Наименование","Страна","Срок годности","Емк.","Фасов.","Цена ед.","Цена кор.","Ост. (шт.)"," ");
		}
		
		if ($price_type == 2) {  
			$fields2 = array ("Арт.","Ш-код","Наименование","Страна","Срок годности","Разм.","Уп.","Цена шт.","Цена уп.","Остаток"," ");
		}
		
		if ($price_type == 3) {  
			$fields2 = array ("Арт.","Ш-код","Наименование","Страна","Срок годности","Формат","Усл.","Тариф","Спец.цена","Остаток"," ");
		}
		
		$th = 0;
		while ($th < count($fields2)) {
			echo "<th class='dat'>".$fields2[$th]."</th>";
			++$th;
		}    

		?>
			<form action="#" name="add_record" id="add_record">
			<tr>
				<td><input type="text" name="str_code1" id="str_code1" value="" size="6" maxlength="10" class="required"></td>
				<td><input type="text" name="str_barcode" id="str_barcode" value="" size="8" maxlength="30"></td>
				<td><input type="text" name="str_name" id="str_name" value="" size="24" maxlength="255"></td>
				<td><input type="text" name="str_state" id="str_state" value="" size="8" maxlength="255"></td>
                                <td><input type="text" name="num_price_pack" id="expiration" value="" size="12" maxlength="12" class="required"></td>
				<td><input type="text" name="str_volume" id="str_volume" value="" size="4" maxlength="10"></td>
				<td><input type="text" name="str_package" id="str_package" value="" size="6" maxlength="255"></td>
				<td><input type="text" name="num_price_single" id="num_price_single" value="" size="5" maxlength="8" class="required"></td>
				<td><input type="text" name="num_price_pack" id="num_price_pack" value="" size="5" maxlength="8" class="required"></td>
                                <td><input type="text" name="num_amount" id="num_amount" value="" size="5" maxlength="6" class="digits required"></td>
<!--				<td><input type="text" name="num_price_pack" id="expiration" value="" size="5" maxlength="8" class="required"></td>-->
			 </tr>
                         <tr><td colspan="10">&nbsp;</td></tr>
			 <tr>
				<td colspan="2" style="text-align:right">Текущая группа:</td>
				<td id="current_group"><?php 
							// Определимся с текущей группой
							if ($current_group == '') {
								
								echo "<strong>не выбрана</strong>";
							
							} else {
							
								echo $current_group;
								
							}
				
				?></td>
				<input type="hidden" name="str_group1" id="str_group1" value="<?php echo $current_group; ?>">
				<td style="text-align:right" colspan="2">Или введите новую группу:</td>
				<td colspan="2"><input type="text" name="str_group2" id="str_group2" value="" size="16" maxlength="255"></td>
				
				<td colspan="2" style="text-align:right"><button id="addrecord_btn">Добавить позицию</button></td>
 			 </tr>  
			</form>
			<form action="#" name="add_limit" id="add_limit">
 				<tr>
					<td colspan="6">&nbsp;</td>
 				</tr>
 				<tr>
<!--				<td>&nbsp;</td>
                                <td><div align="right">&nbsp;Срок&nbsp;годности&nbsp;до&nbsp;ДАТА:<br><small>(по истечении срока годности товар<br> не отображается в прайсах и в витринах)</small></div></td>
				<td><div align="left"><input type="text" name="expiration" id="expiration" value="<?php echo $expiration;?>" size="12" maxlength="12" placeholder="гггг-мм-дд">&nbsp;<button id="expiration_btn">Сохранить</button></div></td>
				<td><small>0 - нет ограничений</small></td>
				<td colspan="2">&nbsp;</td>-->
			 </tr>
</form>
		</table>
	
	</div>

</div>


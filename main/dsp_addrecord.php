<?php

	// Выясним текущий минимальный заказ для прайса
	mysql_data_seek($qry_aboutprice,0);
	$row = mysql_fetch_assoc($qry_aboutprice);
	$zakaz_limit = $row["zakaz_limit"];

 ?>
<script type="text/javascript">
    <!--
	$(document).ready(function(){
            
        $("#addrecord_tbl").css({'width':'1062px'});
        
        $("input.required").focus(function(){
            
            var input_obj = {'str_code1':'6','str_barcode':'8','str_name':'24','str_state':'8','expiration':'12','str_volume':'4','str_package':'6','num_price_single':'5','num_price_pack':'5','num_amount':'5'};
            
            var id = this.id;
            
            $(this).attr('size', input_obj[id]);
            
        }).blur(function(){
            
            $(this).attr('size', 1);
            
        });
            
        $('#addrecord_btn').click(function() {

            $("#addrecord_msg").append("");

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
                                                'pricelist_id':$("#pid").val()
                                            }); 

            return false;
        }); 

		
        $('#addlimit_btn').click(function() {

            $("#addrecord_msg").append("");

            $("#addrecord_msg").load('index.php',{'act':'addlimit',
                                                'zakaz_limit':$("#zakaz_limit").val(),
                                                'pricelist_id':$("#pid").val()}); 

            return false;
        });
        
        $("#group").mouseup(function(){
            $("#str_group1").val($("#group option:selected").val());
            $("#current_group").text($("#group option:selected").val());
        });
        
     });
  -->  
</script>

<p id="addrecord_msg">&nbsp;</p>
<table class='dat' id='addrecord_tbl' width="1062">
    <thead>
        <tr>
<?php 

$fields2 = array ("Арт.","Ш-код","Наименование","Страна","Срок годности","Емк.","Фасов.","Цена ед.","Цена кор.","Ост. (шт.)"," ");

$th = 0;
while ($th < count($fields2)) {
	echo "<th class='dat'>".$fields2[$th]."</th>";
	++$th;
}    

?>
            </tr>
        </thead>
<form action="#" name="add_record" id="add_record">
			<tr>
				<td><input type="text" name="str_code1" id="str_code1" value="" size="1" maxlength="10" class="required"></td>
				<td><input type="text" name="str_barcode" id="str_barcode" value="" size="1" maxlength="30" class="required"></td>
				<td><input type="text" name="str_name" id="str_name" value="" size="1" maxlength="255" class="required"></td>
				<td><input type="text" name="str_state" id="str_state" value="" size="1" maxlength="255" class="required"></td>
                                <td><input type="text" name="expiration" id="expiration" value="" size="1" maxlength="12" class="required"></td>
				<td><input type="text" name="str_volume" id="str_volume" value="" size="1" maxlength="10" class="required"></td>
				<td><input type="text" name="str_package" id="str_package" value="" size="1" maxlength="255" class="required"></td>
				<td><input type="text" name="num_price_single" id="num_price_single" value="" size="1" maxlength="8" class="required"></td>
				<td><input type="text" name="num_price_pack" id="num_price_pack" value="" size="1" maxlength="8" class="required"></td>
                                <td><input type="text" name="num_amount" id="num_amount" value="" size="1" maxlength="6" class="digits required"></td>
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

 <tr>
	<td colspan="6">&nbsp;</td>
 </tr>

 <tr> <form action="#" name="add_limit" id="add_limit">
	
	<td colspan="2" ><div align="right">&nbsp;Мин.&nbsp;заказ&nbsp;для&nbsp;прайса:</div></td>
	<td><div align="left"><input type="text" name="zakaz_limit" id="zakaz_limit" value="<?php echo $zakaz_limit;?>" size="5" maxlength="5">&nbsp;<button id="addlimit_btn">Сохранить</button></div></td>
	<td><small>0 - нет ограничений</small></td>
	<td colspan="2">&nbsp;</td>
</form> </tr>

</table>

<p>&nbsp;</p>
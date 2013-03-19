<?php
include 'dsp_uniselect_class.php';

$my_select = new DateSelect();

//if ($price_id > 0 and ($total - $zakaz_limit) >= 0) {
//	
	if (isset($attributes['contragent_id'])) {
		$contragent_id   = $attributes['contragent_id'];
	} else {
		$contragent_id   = '';
	}
	
	if (isset($attributes[contragent_name])) {
		$contragent_name = $attributes['contragent_name'];
	} else {
		$contragent_name = '';
	}
	
	if (isset($attributes[shipment])) {
		$shipment        = $attributes['shipment'];
	} else {
		$shipment        = '';
	}
	
	if (isset($attributes[comments])) {
		$comments        = $attributes['comments'];
	} else {
		$comments        = '';
	}
	
	if (isset($attributes[tags])) {
		$tags		     = $attributes['tags'];
	} else {
		$tags  		     = '';
	}
	
	
	if (isset ($attributes['id'])) {
	    $row             = mysql_result($qry_archzakaz, 0);
	    $contragent_id   = $row["contragent_id"];
	    $contragent_name = $row["contragent_name"];
	    $shipment        = $row["shipment"];
	    $comments        = $row["comments"];
            $tags	     = $row["tags"]; 
            $mphone          = $row['phone'];
	}
    
    if (isset($demo)) {
        $comments .= 'Демо-заказ';
    }
    
//		
//    // To do Для демо-заказа не высылать сообщение для заключения договора
?>    

<br />


<br />
<div>
    
    <form  method="post" id="save_order" name="addform" enctype="multipart/form-data">
        <table id="torder">
            <thead>
<!--             action="index.php?act=step2&amp;pricelist_id=<"   -->
            </thead>
            <tbody>
                <tr>
                        <td>ИНН:</td>
                        <td>
                            <input type="hidden" name="pricelist_id" id="pid" value="<?php echo $attributes['pricelist_id'];?>"/>
                            <input type="text" maxlength="12" size="12" name="contragent_id" value="<?php echo $contragent_id; ?>"  class="step1">
                        </td>
                </tr>
                <tr>
                        <td>Наименование контрагента:</td>
                        <td><input type="text" maxlength="500" size="24" name="contragent_name" value="<?php echo $contragent_name; ?>" class="step1"></td>
                </tr>
                <tr>
                        <td>E-mail:</td>
                        <td><input type="text" maxlength="500" size="24" name="email" value="<?php echo $user["email"]?>" class="step1"></td>
                </tr>
                <tr>
                        <td>Условия доставки:</td>
                        <td><input type="text" maxlength="500" size="24" name="shipment" class="step1" value="<?php echo $shipment; ?>"></td>
                </tr>
                <tr>
                        <td>Номер контактного телефона:</td>
                        <td><input type="text" maxlength="24" size="24" name="phone" class="step1" value="<?php echo $mphone; ?>"></td>
                </tr>
                <tr>
                        <td>Примечания:</td>
                    <?php
                    if ($mobile == 'false') {


                ?>
                        <td><textarea cols="24" rows="4" wrap="soft" name="comments"><?php echo $comments; ?></textarea></td>
                        <?php 

                        } else { 


                        ?>
                    <td><input type="text" maxlength="500" size="24" name="comments" value="<?php echo $comments; ?>" class="step1"></td>
                        <?php
                        }
                        ?>
                </tr>
                <tr>
                        <td>Метка:</td>
                        <td><input type="text" maxlength="255" size="24" name="tags" class="step1" value=""><br />
                <?php 
                if ($tags != "") echo 'Заказ сформирован по метке "'.$tags.'"'; 
                ?>
                        </td>
                </tr>
                <tr>
                        <td>Отсрочить до:</td>
                        <td>
                            <p>
                                &nbsp;&nbsp;дд &nbsp;&nbsp;- &nbsp;&nbsp;мм &nbsp;&nbsp;- &nbsp;&nbsp;гггг&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;чч &nbsp;&nbsp;- &nbsp;&nbsp;мм
                            </p>
                            <p>
                                <?php echo $my_select->_getDey("day", 'd');?>
                                -
                                <?php echo $my_select->_getMonth('mon', 'm'); ?>
                                -
                                <?php echo $my_select->_getYear("year", 'y', 1);?>

                                &nbsp;&nbsp;&nbsp;
                                
                                <?php echo $my_select->_getHoars('hh', 'h');?>
                                -
                                <?php echo $my_select->_getMinits('mm', 'm');?> 
                            </p>

<!--                            <br />-->

                        </td>
                </tr>
                <tr>	
                        <td colspan='2'><br /><input type="button" id="send_order" value="Отправить заказ оператору" disabled></td>
                </tr>
            </tbody>
        </table>
    </form>
</div>
<script language="JavaScript" type="text/javascript">
        $(document).ready(function(){
            $("#send_order").attr('disabled', false).css('cursor','pointer');
            var str_input = '<tr><td colspan="2"><input type="hidden" name=scr_width  value="' + screen.width  +'"><input type="hidden" name=scr_height value="' + screen.height +'"></td></tr>';
            $("#torder tbody").append(str_input);
            if($("#no_items").text() == 'В корзине нет товаров'){
                $("#send_order").attr('disabled', true).css('cursor','default');
                alert($("#no_items").text()+" кнопка не активна!");
                
            }
            
            $("#send_order").click(function(){
                
                var mydate = new Date();
                
                var input_date = new Date($("#y option:selected").val(), ($("#m option:selected").val()-1), $("#d option:selected").val(), $("#h option:selected").val(), $("#m option:selected").val()-5);
                
                if(input_date < mydate){
                    alert("Дата \"Отсрочить\" не может быть раньше СЕЙЧАС!");
                }else{
                    $("#save_order").attr('action', "index.php?act=step2").submit();
                }
            });
            
        });
</script>


<br>
<br>

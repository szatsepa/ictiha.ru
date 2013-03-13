<script type="text/javascript">
	$(document).ready(function(){
            
            look_more($("#pid").val());
            
                $("#name_center").css({'width':'480px'});
	     
         $('.cart').live("click", function() {
             
            var o_ced = $(this).parent().prev().prev().prev().prev().prev();
            var o_kor = $(this).parent().prev().prev().prev().prev();
            var o_am  = $(this).parent().prev().prev().prev();
            var o_ex  = $(this).parent().prev().prev();
            
            var cena_ed  = o_ced.text();
            var cena_kor = o_kor.text();
            var amount   = o_am.text();
            var expiration = o_ex.text();
            
            o_ced.text("");
            o_kor.text("");
            o_am.text("");
            o_ex.text("");
            
            $("<input maxlength='8' size='8' id='num_price_single' type='Text'>").appendTo(o_ced);
            $("<input maxlength='8' size='8' id='num_price_pack' type='Text'>").appendTo(o_kor);
            $("<input maxlength='6' size='6' id='num_amount' type='Text'>").appendTo(o_am);
            $("<input maxlength='12' size='12' id='expiration' type='Text'>").appendTo(o_ex);
            
            o_ced.children().val(cena_ed);
            o_kor.children().val(cena_kor);
            o_am.children().val(amount);
            o_ex.children().val(expiration);
           
           
//          console.log ($(this).attr("id") + " price " + cena_ed + " price box " + cena_kor + " count " + amount+" EXP "+expiration);
            
            $(this).hide();
            $(this).next().show();
            $(this).next().next().hide();
            $(this).next().next().next().hide();
            $(this).next().next().next().next().hide();
            $(this).next().next().next().next().next().hide();
            //$(this).addClass("cart2");
            
            return false;
        }); 
        
        
        $('.cart2').live("click", function() {

            
            var o_ced = $(this).parent().prev().prev().prev().prev().prev();
            var o_kor = $(this).parent().prev().prev().prev().prev();
            var o_am  = $(this).parent().prev().prev().prev();
            var o_ex  = $(this).parent().prev().prev();
//            
            var num_price_single = o_ced.children().val();
            var num_price_pack   = o_kor.children().val();
            var num_amount       = o_am.children().val();
            var expiration       = o_ex.children().val();
            
//            console.log($(this).attr("id")+" ps "+num_price_single+" pb "+num_price_pack+" cnt "+num_amount+" EXP "+expiration);
            
             $("#edit").load('index.php',{'act':'updsingleitem',
                                                'num_price_single':num_price_single,
                                                'num_price_pack':num_price_pack,
                                                'num_amount':num_amount,
                                                'expiration':expiration,'butt_id':$(this).attr("id")
                                                }); 
            
            return false;
        }); 
	    
         $('.cloud').live("click", function() {
            
             if (confirm("Вы уверены, что хотите удалить эту позицию?\nЭто может привести к изменению истории покупок.")) {			
					           
            	 $("#edit").load('index.php',{'act':'delsingleitem',
                	                                'butt_id':$(this).attr("id")}); 
                     
			 }
			
			return false;
        });
        
        $.ajax({
            url:'main/qry_whot_isrubrika.php',
            type:'post',
            dataType:'json',
            data:{'pid':$("#pid").val()},
            success:function(data){
                var first = data['data'].substr(0,1);
                var second = data['data'].substr(1);
                first = first.toUpperCase();
                $("#rubrika").text(first+second).css({'font-size':'1.4em','font-weight':'bold'});
            },
            error:function(data){
                console.log(data['responseText']);
            }
        });
        
                
                
        var out = {'barcode':$("#it_barcode").val(),'aid':$("#it_id").val(),'pid':$("#pid").val()};
        
        var images = new Array();
        
        var position = 0;
        
        $.ajax({
            url:'main/qry_description.php',
            type:'post',
            dataType:'json',
            data:out,
            success:function(data){
                images = data['images'];
                
                if(images.length < 2){
//                    console.log(images.length);
                    $("#prewiev").css({'cursor':'default','background':'none'});
                    $("#next").css({'cursor':'default','background':'none'});
                }
                $("#item_image").attr('src', '../main/act_prewiew.php?src=http://'+document.location.hostname+'/images/goods/'+data['img']+'&width=163&height=376');
                
                $("#description").css('visibility', 'visible');
            },
            error:function(data){
                document.write(data['responseText']);
            }
        });
        $("#add_cart").mousedown(function(){
            var out = {'uid':$("#uid").val(),'pid':$("#pid").val(),'mobile':$("#mobile").val(),'amount':1,'discount':0,'aid':$("#it_id").val()};
            $.ajax({
                url:'../main/add_cart_1.php',
                type:'post',
                dataType:'json',
                data:out,
                success:function(data){
                    alert("Товар в количестве 1шт. добавлен в корзину!");
                    document.location.href = "index.php?act=single_price&pricelist_id="+$("#pid").val();
                },
                error:function(data){
                    document.write(data['responseText']);
                }
            });
            return false;
        }).css('cursor','pointer');
        
        $("#prewiev").mousedown(function(){
            position--; 
            if(position < 0)position = 0;
            $("#item_image").attr('src', '../main/act_prewiew.php?src=http://'+document.location.hostname+'/images/goods/'+images[position]);
        });
        
        $("#next").mousedown(function(){
            position++;
            if(position > images.length-1)position = (images.length-1);
            $("#item_image").attr('src', '../main/act_prewiew.php?src=http://'+document.location.hostname+'/images/goods/'+images[position]);
        });
        
        $(".look_more").mousedown(function(){
            var id = this.id;
            document.location = $("#"+id).val();
         });
        
        function look_more(){
            $.ajax({
                url:'main/qry_look_more.php',
                type:'post',
                dataType:'json',
                data:{'pid':$("#pid").val()},
                success:function(data){
                    buildLookMore(data);
                },
                error:function(data){
                    console.log(data['responseText']);
                }
            });
            return false;
         }
         
         function buildLookMore(arr){
            
            var this_array = arr;
            
            
                for(var i=0;i<this_array.length;i++){
                    if(this_array[i]['img']){
                        $("#more_"+i).attr('title',this_array[i]['str_name']).attr({'src':'../main/act_prewiew.php?src=http://'+document.location.hostname+'/images/goods/'+this_array[i]['img']+'&width=102&height=226'}).val("index.php?act=single_item&pricelist_id="+$("#pid").val()+"&artikul="+this_array[i]['str_code1']);
                }
            } 
        }
        return false;        
    });
        
</script>

<?php

//echo $query;

// Защита от прямого набора 
if (!isset($qry_price)) exit();

$num_rows	 =	mysql_numrows($qry_price);
$num_fields	 =	mysql_num_fields($qry_price);
$images_root =  $document_root . '/images/goods/';

// Заполним массив корзины текущими заказами (артикул--кол-во)
// disc -- скидка
$cart = array();
$disc = array();

while ($row_cart = mysql_fetch_assoc($qry_cart)){
	$artikul        = $row_cart["str_code1"];
	$amount         = $row_cart["num_amount"];
	$cart[$artikul] = $amount;
	$disc[$artikul] = $row_cart["num_discount"];
}

// Количество строк прайса на странице
if ($mobile == 'true') {
    $per_page	=	25;
} else {
    $per_page	=	25;
}
if($qry_aboutprice){
$row3         = mysql_fetch_assoc($qry_aboutprice);
$company_id   = $row3["company_id"];
$company_name = $row3["company_name"];
$price_name   = $row3["price_name"];
$status       = $row3["status"];

//Блокировка для незарегистрированных пользователей
$disabled = '';
//$dat = mysql_result($qry_price,$row_count,"num_amount");
if ($authentication == "no" or (in_array("add_cart",$rights))) {
    $disabled = 'disabled';
}

?>
<div>
    <input type="hidden" id="pid" value="<? echo $attributes['pricelist_id']; ?>" />
    
</div>
<div class="prname">
    <p id="rubrika"></p>    
    <p>
        <a href="index.php?act=company_prices&amp;company_id=<?php echo $company_id.$urladd; ?>"><?php echo $company_name; ?></a>
        &nbsp;/&nbsp;
        <a href="index.php?act=single_price&amp;pricelist_id=<?php echo $attributes['pricelist_id'].$urladd; ?>"><?php echo $price_name; ?></a>
    </p>
    <div style="position:relative;float: right; font-size: 8px; display: none;">
    </div>
</div>
<br/>
<div>
    <?php 

// Панель выбора параметров для отображения прайса


$act_select = 'single_price';

// Текущая выбранная группа
$current_group = '';

// Сделаем поправку для страницы редактирования
if ($attributes['act'] == 'edit_price') $act_select = 'edit_price';

if ($attributes['act'] == 'add_cart' or $attributes['act'] == 'single_price' or $attributes['act'] == 'add_favprice' or $attributes['act'] == 'edit_price'){?>
<form action="index.php?act=<?php echo $act_select; ?>&amp;pricelist_id=<?php echo $attributes['pricelist_id'].$urladd; ?>" method="post">
	<select name="border" class="common">
		<option value="">Выбор по остатку</option>
		<option value="max" <?php if (isset($attributes['border']) and $attributes['border'] == 'max') echo "selected"; ?>>Макс. остаток</option>
		<option value="min" <?php if (isset($attributes['border']) and $attributes['border'] == 'min') echo "selected"; ?>>Мин. остаток</option>
	</select>
	<input type='submit' value='&gt;&gt;' class='button'></form>&nbsp;

	<form action="index.php?act=<?php echo $act_select; ?>&amp;pricelist_id=<?php echo $attributes['pricelist_id'].$urladd; ?>" method="post">
		<select name="group" id="group" class="common">
			<option value="">Выбор по группе</option><?php
				$num_group	=	mysql_numrows($qry_group);
				$counter = 0;
				//$silver = "style='background-color:ThreedFace;'";
				while ($counter < $num_group) {
					$dat = mysql_result($qry_group,$counter,$str_group);
					$selected = '';
					if (isset($attributes['group']) and $attributes['group'] == $dat){
					
						$selected = 'selected';
						$current_group = $dat;
					}
		            
		            // Подрежем названия групп для селектора
		            $show_dat = $dat;
		            $output_lengts = 40;
		            if ($mobile == 'true') $output_lengts = 20;              
		            if (strlen($show_dat) > $output_lengts) {
		                $show_dat = substr($show_dat,0,$output_lengts)."...";
		            }
		            
		            // Выводим группы
					echo "<option value='".$dat."' ".$selected.">".$show_dat."</option>";	
					++$counter;
					
		            /* To do Раскраска селектора временно вырублена, переделать на стили!!!
					if ($silver == "style='background-color:ThreedFace;'") {
						$silver = "";
					} else {
						$silver = "style='background-color:ThreedFace;'";
					}*/
				}
		?>
		</select>
		<input type='Submit' value='&gt;&gt;' class='button'>
	</form>&nbsp;
<?php } // if ($attributes['act'] == 'add_cart' or $attributes['act'] == 'single_price' or $attributes['act'] == 'add_favprice')
	
    if (isset($qry_cart) and $attributes['act'] != 'step1' and $attributes['act'] != 'step2' and  (!in_array("step1",$rights))) {
        $num_cart	=	mysql_numrows($qry_cart);
    	if ($num_cart > 0) {
		
			$row = mysql_fetch_assoc($qry_cart);
			
			// Найдем id заказа, из которого мог быть сформирован текущий заказ (для контактных данных)
			$parent_zakaz = $row["parent_zakaz"];
			
			if ($parent_zakaz > 0) {
			
				$parent_zakaz_id = "&amp;id=".$parent_zakaz;
			
			} else {
			
				$parent_zakaz_id = "";
			
			}
			
		?>
	<form action="index.php?act=step1&amp;pricelist_id=<?php echo $attributes['pricelist_id'].$parent_zakaz_id.$urladd; ?>" method="post">
		<input type="hidden" name="pricelist_id" value="<? echo $attributes['pricelist_id']; ?>" />
		<input type='submit' value='Оформить заказ' class='button' />
	</form>&nbsp;
<?php }
    }

// Кнопка добавления прайса "В избранное"
if (isset($attributes['pricelist_id']) and $authentication == "yes" and (mysql_numrows($qry_favorite) == 0) and $mobile == 'false' and $attributes['act'] != 'step1' and $attributes['act'] != 'step2' and $attributes['act'] != 'single_item') { ?>
	<form action="index.php?act=add_favprice<?php echo $urladd; ?>" method="post">
		<input type="hidden" name="pricelist_id" value="<? echo $attributes['pricelist_id']; ?>" />
		<input type='submit' value='В избранное' class='button' />
	</form>
<?php } ?>
</div>
<?php
if ($attributes['act'] == 'single_item') {
    if(mysql_num_rows($qry_price)==0) exit (); 
        $barcode        = mysql_result($qry_price,0,"str_barcode");
	$item_name_head = mysql_result($qry_price,0,"str_name");
        $item_id = mysql_result($qry_price,0,"id");
        $price_item = mysql_result($qry_price,0,"num_price_single");
        $volume = mysql_result($qry_price,0,"str_volume");
	echo "<h2>$item_name_head<br />{$attributes['artikul']}#$barcode</h2>";

}
	
	
$num_pages	= 	ceil($num_rows / $per_page); // Количество страниц прайса

if(!isset($attributes['page']) || $attributes['page'] > $num_pages) {
	$attributes['page'] = 1;
} 

if (isset($attributes['next_page']) and $attributes['next_page'] > 0) {
    $attributes['page'] = $attributes['next_page'];
}

$current_page = $attributes['page'];
$act = "act=".$attributes['act']."&amp;pricelist_id=".$attributes['pricelist_id']."&amp;";
/*if (isset($attributes['act'])) {
	$act = "act=".$attributes['act']."&";
}*/

// Устанавливаем границы вывода страниц
$pages = $attributes['page'] - 1;
if ($pages <= 1) {
    $pages = 1;
    $left_dots = '';
} else {
    $left_dots = '...';
}

$pages_end = $attributes['page'] + 1;
if ($pages_end >= $num_pages) {
    $pages_end = $num_pages;
    $right_dots = '';
} else {
    $right_dots = '...';
}

$border = "";
$pages_display = '';
if (isset($attributes['border'])) $border = "&amp;border=".$attributes['border'];

if ($num_rows > $per_page){
	$pages_display .= "<div align='right'>Стр. ".$left_dots;    
	while ($pages <= $pages_end) {		
		if ($pages == $current_page) {
			$pages_display .= $pages."&nbsp;";
		} else {
			$pages_display .= "<a href='index.php?".$act."page=".$pages.$border.$urladd."'>".$pages."</a>&nbsp;";
		}	
		++$pages;
	}
	$pages_display .= $right_dots;
    $pages_display .= "&nbsp;<form action='index.php?".$urladd."' method='get'>";  
    
    if (isset($attributes['border'])){
        $pages_display .= "<input type='hidden' name='border' value='{$attributes['border']}'>";
    }
    if(isset ($attributes['search'])){
        $pages_display .= "<input type='hidden' name='search' value='1'>";
        $pages_display .= "<input type='hidden' name='word' value='{$attributes['word']}'>";
    }
    $pages_display .= "<input type='hidden' name='act' value='{$attributes['act']}'>";
    $pages_display .= "<input type='hidden' name='pricelist_id' value='{$attributes['pricelist_id']}'>";
    
    
    $pages_display .= "<select name='page' class='common' onchange='javascript:this.form.submit();'>";
        
    for ($i = 1;$i <= $num_pages; ++$i){
        if ($i == $current_page){
            $selected_page = ' selected ';
        } else {
            $selected_page = '';
        }
        $pages_display .= "<option value=".$i.$selected_page.">".$i;
    }    
    $pages_display .= "</option>"; 
    $pages_display .= "</select></form>";
    $pages_display .= "</div>";
    echo $pages_display;
} else {
	echo "<p align='right'>&nbsp;</p>";
}


$row_count 		=	($current_page - 1) * $per_page;
$row_end		=	$row_count + $per_page;
if ($row_end > $num_rows) {
	$row_end	=	$num_rows;
}

$field_count	=	0;

$array_fields = array();

while ($field_count < $num_fields - 1) {

	$array_fields[$field_count] = mysql_field_name($qry_price, $field_count);
	++$field_count;
}
//print_r ($array_fields);
//echo mysql_num_rows($qry_price)." => ROWS <br>";
// Вывод прайс-листа"Срок годности","Кол-во(шт.)",

    

if ($attributes['act'] <> 'edit_price') {     
    
    $fields = array ("Артикул","Ш-код","&nbsp;","Наименование","Страна","Емкость","Фасовка","Цена ед.","Цена кор.","Остаток(шт.)","Кол-во(шт.)","Скидка","&nbsp;");
    
} 

if($attributes['act']== 'single_price'){
    
    $fields = array ("Артикул","Ш-код","&nbsp;","Наименование","Страна","Емкость","Фасовка","Цена ед.","Цена кор.","Остаток(шт.)","Срок годности","Кол-во(шт.)","Скидка","&nbsp;");
    
}

if($attributes['act'] == 'edit_price'){
    
    $fields = array ("Арт.","Ш-код","&nbsp;","Наим.","Страна","Емк.","Фас.","Цена ед.","Цена кор.","Ост.(шт.)","Срок годности","","Дейст.");
    
}

// Выводим блокированные только для редактирования
if ($mobile == 'false' and ($status == 1 or ($status == 2 and $attributes['act'] == 'edit_price'))) {

    echo "<br><table class='dat' id='ssylki'><thead><tr>";
    $th = 0;
    while ($th < count($fields)) {
    	echo "<th class='dat'>".$fields[$th]."</th>";
    	++$th;
    }
    echo "</tr></thead><tbody>";
    $silver = "style='background-color:ThreedFace;'";
    while ($row_count < $row_end) {
        
        $ostatok = mysql_result($qry_price,$row_count,$array_fields[10]);
        
        // Отображаем нулевые остатки только в редактировании прайса
        if ($attributes['act'] <> 'edit_price') {         
            if ($ostatok == 0) {
                ++$row_count;
                continue; 
            } 
        }
        
    	if ($silver == "style='background-color:ThreedFace;'") {
    				$silver = "";
    	} else {
    		$silver = "style='background-color:ThreedFace;'";
    	}
    	echo "<tr ".$silver.">";
    	$id = 	mysql_result($qry_price,$row_count,$array_fields[0]);
    	$field_count = 1;
        
        if ($attributes['act'] <> 'edit_price') {
        
        	echo "<form action='index.php?act=add_cart&amp;page=".$current_page.$urladd."' method=post>";
        	echo "<input type='Hidden' name='id' value=".$id.">";
                echo "<input type='Hidden' name='pricelist_id' value=".$attributes['pricelist_id'].">";
    		
        }
        
		$bold    = '';
		$ordered = '';
		$skidka  = "0%";
		
        while ($field_count < $num_fields - 1) {	
    		$dat = mysql_result($qry_price,$row_count,$array_fields[$field_count]);
                
            // Артикул?
            if ($field_count == 1) {
                $artikul = $dat;
                
                if (array_key_exists($artikul,$cart)) {
                        $bold    = "style='background-color:#ccffcc;'";
                        $ordered = $cart[$artikul];
                        $skidka  = '';
                } else {
                        $ordered = 1;
                }
            }
            
            if($field_count == 2){
                $str_barcode = $dat;
            }
            
            // Служебное поле str_code2?
            if ($field_count == 3) {
//                $str_code2 = $dat;
                // Разберемся, какую картинку выводить
                $picture = $images_root.$dat;
                if (file_exists($picture)) {
                    $pic_name = $dat;
                } else {
                    $pic_name = "no_pic.jpg";
                }
                $str_code2 = "<img src='../images/goods/$pic_name' alt='$pic_name' width='37'>";
            }
            
             // Фасовка?
            if ($field_count == 7) {
                $package = $dat;
            }
            
            // Наименование товара?
            if ($field_count == 4) {
            
                ?>
    <td <?php echo $bold; ?>>
        <a href="index.php?act=single_item&amp;pricelist_id=<?php echo $attributes['pricelist_id'];?>&amp;artikul=<?php echo $artikul.$urladd; ?>" id="<?php echo $artikul; ?>">
        <?php echo $dat."</a></td>";
    		}else {	
                // Не показываем остаток незалогиненым пользователям	
                    if ($authentication == "no" and $field_count == 10) {
                            echo "<td $bold>&nbsp;</td>";
                        }else if($field_count == 3){	
//               	выводим иконку товара
                   
                                    echo "<td $bold>$str_code2</td>";

                        } else {
                            if ($dat == 999999999){
                                echo "<td style='text-align:center;' $bold>&amp;</td>";
                            } else {
                                echo "<td $bold>".$dat."</td>";
                            }
                        }
    		}
                
    		++$field_count;
    	}
    	
    	if ($attributes['act'] <> 'edit_price') {   	
        	echo "<td><input type='Text' maxlength='3' size='3' name='amount' value='$ordered' " . $disabled . " $bold></td>";
        	echo "<td style='text-align:center;'> $skidka</td>";
        	echo "<td><input type='Submit' value='&gt;&gt;' " . $disabled . " $bold></td>";
        	if (isset($attributes['border'])) echo "<input type='Hidden' name='border' value='".$attributes['border']."'>";
        	if (isset($attributes['group'])) echo "<input type='Hidden' name='group' value='".$attributes['group']."'>";
                echo "<input type='Hidden' name='artikul' value=".$artikul.">";
            
            // Выводим количество шт. в упаковке, чтобы товар принудительно был заказан упаковками 
            if ($str_code2 == '') {
                echo "<input type='Hidden' name='package' value='".$package."'>";
            }
        	
            echo "</form>";        
        
        } else {
            
			// Удаленные через редактирование позиции -- не показываем управление
            if ($str_code2 == 'X') {
			
				echo "<td>&nbsp;</td>";
			
			} else {
			// Здесь выводятся иконки действий
            	echo "<td></td><td width='100'><button class='cart' id='e".$id."'>Ред.</button><button class='cart2' id='s".$id."' style='display:none;'>Сохранить</button>&nbsp;<a href='#' class='cloud' id='d".$id."' title='Удалить'>x</a></td>";
			}
        
        }
        
        echo "</tr>";
    
    	++$row_count;
    }
    
    if ($num_rows == 0) echo "<tr><td colspan='12'>&nbsp;</td></tr><tr><td colspan='12'><strong id='no_goods'>Нет товаров для отображения</strong></td></tr><tr><td colspan='12'>&nbsp;</td></tr>";    
    echo "</tbody>"; 
    echo "</table>";
    
    
    echo $pages_display;
?>  

<?php // Специфическая информация для одиночного товара
if ($attributes['act'] == "single_item") {

	// Показывем котировку зарегистрированному пользовтелю
    if ($authentication == "yes") {
    
        //kotirovka($barcode,$user[id],$attributes['pricelist_id'],'button');
    
    }
    
    echo "<input type='hidden' id='pid' value='{$attributes['pricelist_id']}'/>
    <input type='hidden' id='it_id' value='$item_id'/>
    <input type='hidden' id='it_barcode' value='$barcode'/>
    <input type='hidden' id='uid' value='{$user['id']}'/>
    <input type='hidden' id='art' value='$artikul'/>
    <input type='hidden' id='mobile' value='$mobile'/>";
	
	// Выводим описание товара и картинку если есть штрих-код
//	tovar($barcode);
//	
//	tovar_pic($barcode,"");
        
        $about = about_item($barcode);
        
//        print_r($about);
        
        include 'dsp_description.php';
	

 } // End if ($attributes['act'] == "single_item") 
 ?>     
    <!-- br />&nbsp;&nbsp;<a href='flash/index.html'>Галерея товаров</a -->

    <div id="edit"></div>
    
	
<?php } // End if ($mobile == 'false')

// To do сделать обработку str_code2 для мобильной версии

// Выводим список товаров в мобильном прайсе
if ($mobile == 'true' and ($attributes['act'] == 'single_price' or $attributes['act'] == 'add_cart')  and $status == 1) {
    
    echo "<br><table border='1' cellspacing='0' cellpadding='2' width='100%'>";
    echo "<th>Товар</th><th>Скид.</th><th>Кол.</th>";
    echo "<form action='index.php?act=add_cart&amp;page=".$current_page.$urladd."' method='post'>";	
    echo "<input type='hidden' name='pricelist_id' value='".$attributes['pricelist_id']."'>";
    if (isset($attributes['border'])) echo "<input type='hidden' name='border' value='".$attributes['border']."'>";
  	if (isset($attributes['group'])) echo "<input type='hidden' name='group' value='".$attributes['group']."'>";
    
   $amount = '';
    
   while ($row_count < $row_end) {
    	
    	$id 			= 	mysql_result($qry_price,$row_count,"id");
    	$artikul        =   mysql_result($qry_price,$row_count,"str_code1");
        $str_code2      =   mysql_result($qry_price,$row_count,"str_code2");
        $name           =   mysql_result($qry_price,$row_count,"str_name");
        $volume         =   mysql_result($qry_price,$row_count,"str_volume");
        $package        =   mysql_result($qry_price,$row_count,"str_package");
        $price_single   =   mysql_result($qry_price,$row_count,"num_price_single");
        
        if ($authentication == "yes") {
            $amount  =   "(".mysql_result($qry_price,$row_count,"num_amount").")";    
        }  
        
 		if (array_key_exists($artikul,$cart)) {
        	$bold    = " class='marked'";
        	$ordered = $cart[$artikul];
        	$skidka  = $disc[$artikul]."%";
        } else {
            $bold    = '';
        	$ordered = '';
            $skidka  = '';
        }

        
        echo "<tr>";    
		echo "<input type='hidden' name='artikul$row_count' value='".$artikul."'>";
		if ($ordered != '') {
			echo "<input type='hidden' name='exist$row_count' value='".$ordered."'>";
		}
        // Выводим количество шт. в упаковке, чтобы товар принудительно был заказан упаковками 
        if ($str_code2 == '') {
            echo "<input type='hidden' name='package$row_count' value='".$package."'>";
        }
        echo "<td$bold>$name; Ост. - $amount<br>Емк.$volume; Фас.$package; Цена $price_single</td>";
        echo "<td$bold><input type='text' maxlength='6' size='3' name='discount$row_count' value='$skidka' " . $disabled . "  class='pr'></td>";
        echo "<td$bold><input type='text' maxlength='4' size='3' name='amount$row_count' value='$ordered' " . $disabled . " class='pr'></td>";
        echo "</tr>";

    	++$row_count;
    } // Закончили вывод таблицы товаров
	echo "<tr><td colspan='3' align='right'><input type='submit' value='Добавить в корзину' ".$disabled.">";
    if ($current_page < $num_pages){
        echo "<br><input type='checkbox' name='next_page' value='".($current_page + 1)."'> и перейти на след. страницу";
    }
    echo "</td></tr>";
    
    // Здесь сообщается, сколько товаров на странице
	echo "<input type='hidden' name='goods' value='".$row_count."'>";
	
    echo "</form>";
    echo "</table>";
    
    if ($num_rows == 0) echo "<p>Нет товаров для отображения</p>";
    
    echo $pages_display;
    
} // End if ($mobile == 'true' and $attributes['act'] == 'single_price')




// Выводим единичный товар для мобилки

if ($mobile == 'true' and $attributes['act'] == 'single_item'  and  $status == 1) {
    while ($row_count < $row_end) {
    	
    	$id 			= 	mysql_result($qry_price,$row_count,$array_fields[0]);
    	$field_count 	= 	1;
    	echo "<form action=index.php?act=add_cart&page=".$current_page.$urladd." method=post>";
    	echo "<input type='Hidden' name='id' value=".$id.">";
        echo "<input type='Hidden' name='pricelist_id' value=".$attributes['pricelist_id'].">";
        while ($field_count < $num_fields - 1) {	
    		$dat = mysql_result($qry_price,$row_count,$array_fields[$field_count]);
            
			// To do Здесь внимательно проверить на мобиле!!!!!
         	if ($field_count != 2) {
    			echo "<b>".$fields[$field_count - 1].":</b> ".$dat."<br />";
    		}
    		++$field_count;
    	}
    	
    	$disabled = '';
    	//$dat = mysql_result($qry_price,$row_count,"num_amount");
    	if ($authentication == "no") {
    		$disabled = 'disabled="disabled"';
    	}
    	
        echo "<div class='head'>Заказ:</div>";
    	echo "<table border=0><tr><td>Кол-во(шт.)</td><td><input type='Text' maxlength='4' size='4' name='amount' value='1' " . $disabled . " ><td/></tr>";
    	echo "<tr><td>Скидка</td><td><input type='Text' maxlength='2' size='2' name='discount' value='0' " . $disabled . " ><td/></tr></table>";
    	echo "<input type='Submit' value='Заказать' " . $disabled . " ><br />";
    	if (isset($attributes['border'])) echo "<input type='Hidden' name='border' value='".$attributes['border']."'>";
    	if (isset($attributes['group'])) echo "<input type='Hidden' name='group' value='".$attributes['group']."'>";
    	echo "</tr></form>";
    
    	++$row_count;
    }
    if ($num_rows == 0) echo "<br />Нет товаров для отображения<br />";
}


if ($status == 0 and $attributes['act'] != "edit_price") {
    echo "<p>&nbsp;&nbsp;<b>Прайс-лист удален.</b></p>";
}

if ($status == 2 and $attributes['act'] != "edit_price") {
    echo "<p>&nbsp;&nbsp;<b>Прайс-лист заблокирован и будет доступен через некоторое время.</b></p>";
}
}
 ?>
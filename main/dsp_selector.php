<!--<div id="main_menu"> 
    
        <?php
        if($_SESSION[auth] == 1){
            if (($user["role"] == 1 or $user["role"] == 3) and $attributes[act] != 'kabinet' and (!in_array("kabinet",$rights)) and $mobile == 'false') { ?>
            <a href="index.php?act=kabinet<?php echo $urladd; ?>" title="Личный кабинет">Личный&nbsp;кабинет</a>&nbsp;&nbsp;&nbsp;
            <?php } 
                    if (($user["role"] == 1 or $user["role"] == 2) and $attributes[act] != 'supplier' and (!in_array("supplier",$rights)) and $mobile == 'false') {?>
            <a href="index.php?act=supplier<?php echo $urladd; ?>" title="Кабинет&nbsp;поставщика">Кабинет поставщика</a>&nbsp;&nbsp;&nbsp;
            <?php }
            if (($user["role"] == 1 or $user["role"] == 5) and $attributes[act] != 'torg' and (!in_array("torg",$rights)) and $mobile == 'false') {?>	
            <a href="index.php?act=torg<?php echo $urladd; ?>" title="Кабинет торгового">Кабинет&nbsp;торгового</a>&nbsp;&nbsp;&nbsp;	
            <?php } 
            if ($attributes[act] == 'kabinet') { ?> 					
                    <a href="index.php?act=kotirovka<?php echo $urladd; ?>" title="Сравнительные котировки">Сравнительные котировки</a>&nbsp;&nbsp;&nbsp;
                    <a href="index.php?act=arch_zakazuser<?php echo $urladd; ?>" title="Архив заказов">Архив&nbsp;заказов</a>&nbsp;&nbsp;&nbsp;
                    <a href="index.php?act=otchet<?php echo $urladd; ?>" title="Отчеты">Отчеты</a>&nbsp;&nbsp;&nbsp;
            <?php } 						
            if ($attributes[act] == 'supplier') { ?> 					
                    <a href="index.php?act=arch_done<?php echo $urladd; ?>" title="Архив поставок">Архив&nbsp;поставок</a>&nbsp;&nbsp;&nbsp;
                    <a href="index.php?act=arch_decline<?php echo $urladd; ?>" title="Отменённые заказы">Отменённые&nbsp;заказы</a>&nbsp;&nbsp;&nbsp;
                    <a href="index.php?act=otchet<?php echo $urladd; ?>" title="Отчеты">Отчеты</a>&nbsp;&nbsp;&nbsp;
            <?php } 

            if (isset($attributes[act])) {
            ?>
            <a href="index.php?act=complist<?php echo $urladd; ?>" title="Обратная связь">Список&nbsp;компаний</a>&nbsp;&nbsp;&nbsp;
            <?php } ?>
            <a href="index.php?act=mailform<?php echo $urladd; ?>" title="Обратная связь">Обратная&nbsp;связь</a>&nbsp;&nbsp;&nbsp;
        <?php }?>
    <ul></ul>
</div>-->
<?php 

// Панель выбора параметров для отображения прайса


$act_select = 'single_price';

// Текущая выбранная группа
$current_group = '';

// Сделаем поправку для страницы редактирования
if ($attributes[act] == 'edit_price') $act_select = 'edit_price';

if ($attributes[act] == 'add_cart' or $attributes[act] == 'single_price' or $attributes[act] == 'add_favprice' or $attributes[act] == 'edit_price'){?>
<form action="index.php?act=<?php echo $act_select; ?>&amp;pricelist_id=<?php echo $attributes[pricelist_id].$urladd; ?>" method="post">
	<select name="border" class="common">
		<option value="">Выбор по остатку</option>
		<option value="max" <?php if (isset($attributes[border]) and $attributes[border] == 'max') echo "selected"; ?>>Макс. остаток</option>
		<option value="min" <?php if (isset($attributes[border]) and $attributes[border] == 'min') echo "selected"; ?>>Мин. остаток</option>
	</select>
	<input type='submit' value='&gt;&gt;' class='button'></form>&nbsp;

	<form action="index.php?act=<?php echo $act_select; ?>&amp;pricelist_id=<?php echo $attributes[pricelist_id].$urladd; ?>" method="post">
		<select name="group" id="group" class="common">
			<option value="">Выбор по группе</option><?php
				$num_group	=	mysql_numrows($qry_group);
				$counter = 0;
				//$silver = "style='background-color:ThreedFace;'";
				while ($counter < $num_group) {
					$dat = mysql_result($qry_group,$counter,$str_group);
					$selected = '';
					if (isset($attributes[group]) and $attributes[group] == $dat){
					
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
<?php } // if ($attributes[act] == 'add_cart' or $attributes[act] == 'single_price' or $attributes[act] == 'add_favprice')
	
    if (isset($qry_cart) and $attributes[act] != 'step1' and $attributes[act] != 'step2' and  (!in_array("step1",$rights))) {
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
	<form action="index.php?act=step1&amp;pricelist_id=<?php echo $attributes[pricelist_id].$parent_zakaz_id.$urladd; ?>" method="post">
		<input type="hidden" name="pricelist_id" value="<? echo $attributes[pricelist_id]; ?>" />
		<input type='submit' value='Оформить заказ' class='button' />
	</form>&nbsp;
<?php }
    }

// Кнопка добавления прайса "В избранное"
if (isset($attributes[pricelist_id]) and $authentication == "yes" and (mysql_numrows($qry_favorite) == 0) and $mobile == 'false' and $attributes[act] != 'step1' and $attributes[act] != 'step2' and $attributes[act] != 'single_item') { ?>
	<form action="index.php?act=add_favprice<?php echo $urladd; ?>" method="post">
		<input type="hidden" name="pricelist_id" value="<? echo $attributes[pricelist_id]; ?>" />
		<input type='submit' value='В избранное' class='button' />
	</form>
<?php } ?>
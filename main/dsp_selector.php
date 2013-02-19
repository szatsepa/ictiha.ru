<div id="main_menu"> 
    
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
<!--    <ul></ul>-->
</div>
<div>
<?php

$days = array('Пн','Вт','Ср','Чт','Пт','Сб','Вс');

$zakaz = array('','','','','','','');

// Счетчик количества заказов по дням недели
$order_count = array(0,0,0,0,0,0,0);

while ($row = mysql_fetch_assoc($qry_zakazweek)) { 
    
    // Ограничим вывод
    $counter = $order_count[$row["weekday"]];
    if ($counter >= 9) continue;
    
    $dsp = '';
    
    if($row["status"] == 1) {
        $status = "<span class='edit2'>Новый</span>";
        $dsp    = "&amp;dsp=decline";
    }
    if($row["status"] == 2) {
        $status = "<span class='edit'>Рассмотрен</span>";
        $dsp    = "&amp;dsp=decline";
    }
    if($row["status"] == 3){
        continue;
        $status = "<span class='edit4'>Отменен</span>";        
    }
    if($row["status"] == 4) $status = "<span class='edit2'>Демо</span>";
    if($row["status"] == 5) {
        $status = "<span class='edit3'>Отгружен</span>";
        $dsp    = "&amp;dsp=fin";
    }
    if($row["status"] == 6) $status = "<span class='edit5'>Выполнен</span>";
    
    $dat = $zakaz[$row["weekday"]]."<p style='margin-left:5px;margin-top:5px;margin-bottom:10px;margin-right:3px;'><a href='index.php?act=view_archzakaz&id=".$row["id"].$dsp.$urladd."'>N".$row["id"]."&nbsp;".$row["zakaz_date"]."<br />".$row["price_name"]."</a><br />".$status."</p>";

    $zakaz[$row["weekday"]] = $dat;
    
    // Посчитаем количество заказов на один день
    ++$counter;
    $order_count[$row["weekday"]] = $counter;
    
}

?>                    
<!-- p align="right"><a href="index.php?act=kotirovka" class="help" style="text-decoration:underline;">Сравнительные котировки</a>&nbsp;&nbsp;</p -->
</div>
<div style="margin-left:5px;">
    <h2>Заказы по дням недели:</h2>
    <br>
    <table class='cart'>
        <thead>
            <tr>
                <?php
                foreach ($days as $day) {
                ?>
                <th  class='cart' style="width:10em;"><?php echo $day;?></th>
                <?php } ?>

            </tr> 
        </thead>
        <tbody>
            <tr>
                <?php
                foreach ($zakaz as $dat) {
                ?>
                <td class='cart' style="text-align:left;" valign="top">
                   <p> <?php echo $dat;?></p>
                </td>
                <?php } ?>
            </tr>
        </tbody>
    </table>
</div>
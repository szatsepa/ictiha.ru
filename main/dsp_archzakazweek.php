<div>
<?php
if($attributes['act']=='arch_decline'){
    $num_status = 3;
}
if($attributes['act']=='arch_zakazuser'){
    $num_status = 6;
}
$days = array('Пн','Вт','Ср','Чт','Пт','Сб','Вс');

$zakaz = array('','','','','','','');

// Счетчик количества заказов по дням недели
$order_count = array(0,0,0,0,0,0,0);

while ($row = mysql_fetch_assoc($qry_zakazweek)) { 
    
    if($row['status'] == $num_status){
        
        $dat = $zakaz[$row["weekday"]]."<p style='margin-left:5px;margin-top:5px;margin-bottom:10px;margin-right:3px;'><a href='index.php?act=view_archzakaz&id=".$row["id"].$dsp.$urladd."'>N".$row["id"]."&nbsp;".$row["zakaz_date"]."<br />".$row["price_name"]."</a><br /></p>";

        $zakaz[$row["weekday"]] = $dat;
    }
       
}

?> 
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
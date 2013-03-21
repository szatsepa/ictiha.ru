<?php

array_multisort($arhorder_array,SORT_DESC);

$cell = 0;

$tmp_array = array();

foreach ($arhorder_array as $value) {
    
    if ($attributes['act'] == 'arch_done' and $value["status"] == 6) {
        array_push($tmp_array, $value);
    }else if ($attributes[act] == 'arch_decline' and $value["status"] == 3) {
        array_push($tmp_array, $value);
    }
}


$cnt = count($tmp_array);

$num_rows = ceil($cnt/3);

// Количество строк прайса на странице

$per_page	=	32;

$num_pages	= 	ceil($num_rows / $per_page); // Количество страниц прайса

if(!isset($attributes['page']) || $attributes['page'] > $num_pages) {
	$attributes['page'] = 1;
} 

if (isset($attributes['next_page']) and $attributes['next_page'] > 0) {
    $attributes['page'] = $attributes['next_page'];
}

$current_page = $attributes['page'];

$act = "act=".$attributes['act']."&amp;";

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

?>
<div align="center">
    <table class="arch_list" cellpadding="5" cellspacing="10">
        <thead></thead>
        <tbody>
<?php
while($row_count < $row_end){
//for($i=0;$i < $rows; $i++){
    echo "<tr id='r_$i'>";
    for($ii = 0;$ii < 3;$ii++){
         
           echo "<td id='t_$cell'><a href='index.php?act=view_archzakaz&id=".$tmp_array[$cell]["id"]."'>N".$tmp_array[$cell]["id"]." от ".$tmp_array[$cell]["zakaz_date"]."&nbsp;-&nbsp;".$tmp_array[$cell]["price_name"]."</a></td>"; 
           
           $cell++; 
        
          if($cell == $cnt) break;
    }
    $row_count++;
    echo "</tr>";
}

if($cnt == 0 && $attributes[act] == 'arch_done' ){
    ?>
    <script language="javascript">
     alert("Архив заказов пуст.")
    window.location.href = "index.php?act=supplier";
       </script> 
    <?php
}
if($cnt == 0 && $attributes[act] == 'arch_decline' ){
    ?>
    <script language="javascript">
     alert("Архив отмененых заказов пуст.")
    window.location.href = "index.php?act=supplier";
       </script> 
    <?php
}

?>
       </tbody>
    </table>
</div>
<?php 
header('Content-Type: text/html; charset=utf-8'); 
// Обновление информации по ценам и остатку для одной позиции прайса

$id = substr($attributes[butt_id],1);
$new_button = "e".$id;
$del_button = "d".$id;

$ced = trim($attributes[num_price_single]);
//number_format($number, 2, '.', '')
$ced = number_format($ced, 2, '.', '');

$kor = trim($attributes[num_price_pack]);
$kor = number_format($kor, 2, '.', '');

$ex = trim($attributes[expiration]);

$am = intval(trim($attributes[num_amount]));

$query = "UPDATE pricelist
             SET num_price_single = $ced,
                 num_price_pack   = $kor,
                 num_amount       = $am,
                 expiration       = '$ex'
           WHERE id=$id";
        
        
$qry_update = mysql_query($query) or die($query);

?>
<script language="JavaScript">
 
 o_ced = $("#<?php echo $attributes[butt_id];?>").parent().prev().prev().prev().prev().prev().children();
 o_kor = $("#<?php echo $attributes[butt_id];?>").parent().prev().prev().prev().prev().children();
 o_am = $("#<?php echo $attributes[butt_id];?>").parent().prev().prev().prev().children();
 o_ex  = $("#<?php echo $attributes[butt_id];?>").parent().prev().prev().children();
 
 o_ced.replaceWith("<?php echo $ced;?>");
 o_kor.replaceWith("<?php echo $kor;?>");
 o_am.replaceWith("<?php echo $am;?>");
 o_ex.replaceWith("<?php echo $ex;?>");
 
 $("#<?php echo $attributes[butt_id];?>").hide();
 $("#<?php echo $new_button;?>").show();
 $("#<?php echo $del_button;?>").show();

</script>
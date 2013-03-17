<?php

$msg = quote_smart($attributes['comments']);

if(isset($_SESSION['id']) and $_SESSION['id']){
    
    $uid = intval($_SESSION['id']);

    $query = "SELECT MAX(`id`) FROM `cart` WHERE `user_id` = $uid";

    $result = mysql_query($query);

    $cart = mysql_result($result,0);

    $query = "SELECT u.id FROM `users` AS u, `price` AS p, `cart` AS c WHERE c.price_id = p.id AND p.company_id = u.company_id AND c.id = $cart AND u.role = 2";

    $result = mysql_query($query);
    
}else{
    $uid = 0;
}

if(!$result){
    
    $supplier = 0;
    
}else{
    
    $supplier = mysql_result($result,0);
    
    $query = "INSERT INTO `private_messages` (`sender`,`recipient`,`message`) VALUES ($uid, $supplier, $msg)";

    mysql_query($query);
}
if(mysql_affected_rows()>0){
    ?>
<script type="text/javascript">
    alert("Ваше сообщение отправлено оператору.");
</script>

<?php
}
?>
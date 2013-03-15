<?php
// To do сделать проверку полученных данных перед отправкой письма.


//$to  = 'operator@shop.animals-food.ru';
//
//// subject
//$subject = 'Сообщение от пользователя '.$user["surname"]." ".$user["name"];
//
//// message
//$message = $attributes[comments];
//
//$headers  = 'MIME-Version: 1.0' . "\r\n";
//$headers .= 'Content-type: text/plain; charset=utf-8' . "\r\n";
//
//// Additional headers
//$headers .= 'From: '. $user["email"] . "\r\n";
//$headers .= 'Bcc: djv57@yandex.ru, 7905415@mail.ru' . "\r\n";
//
//// Mail it
//mail($to, $subject, $message, $headers);
//
//$javascript = "javascript:alert('Письмо отправлено.');";

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

?>
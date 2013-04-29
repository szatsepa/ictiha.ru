<?php 

$status = array('1'=>"рассматривается поставщиком",'2'=>"подтвержден поставщиком",'3'=>"отменен",'4'=>"демо-заказ",'5'=>"отгружен поставщиком",'6'=>"выполнен");

if (isset($attributes['id']) and $attributes['id'] > 0 and isset($attributes['status']) and $attributes['status'] > 0) {
    
	$attributes['status'] = intval($attributes['status']);
	
    $and = '';
    
    // Добавим причину отмены заказа
    if (isset($attributes['decline_comment'])){
        
        $attributes['decline_comment'] = quote_smart($attributes['decline_comment']);
        
        $and = ",decline_comment = ".$attributes['decline_comment']." ";
    }
    
    
	
	$query = "UPDATE arch_zakaz 
              SET status  = {$attributes['status']}"
                  .$and." 
              WHERE id = {$attributes['id']}";	
	
	$qry_updzakazstatus = mysql_query($query) or die($query); 
    
        $query2 = "INSERT INTO zakaz_history 
		                   (id,
                            time,
                            status,
                            user_id)
		              VALUES 
		                    ({$attributes['id']},
                             now(),
                             {$attributes['status']},
                             {$user['id']})";
                             
     $qry_zakazhistory = mysql_query($query2) or die($query2);
     
    if(mysql_affected_rows()>0){
        
        $query = "SELECT Concat(u.`name`,' ', u.`surname`) AS name, u.`email` FROM `arch_zakaz` AS z, `users` AS u  WHERE z.id = {$attributes['id']} AND z.`user_id` = u.`id`";
        
        $result = mysql_query($query) or die(mysql_errno()." - ".$query);
        
        $name = mysql_result($result, 0, 'name');
        
        $email = mysql_result($result, 0, 'email');
        
        $query = "SELECT Concat(u.name,' ',u.surname) AS name, u.email FROM `arch_zakaz` AS z,`arch_goods` AS g, `users` AS u, `price` AS p  WHERE z.id = {$attributes['id']} AND z.id = g.zakaz AND g.price_id = p.id AND p.company_id = u.company_id AND u.role = 2";
        
        $result = mysql_query($query) or die(mysql_errno()." ".$query);
        
        $to  = $name."<".$email.">";
        
        while ($row = mysql_fetch_assoc($result)){
            
            $to .= ", {$row['name']} <{$row['email']}>";
        }
        // subject
        $subject = "Статус заказа.";
// message
        $message = "<html><head><STYLE TYPE='text/css'>BODY {font-family:sans-serif;} TABLE {border:solid 1px gray;} TH {border:solid 1px gray;} TD {border:solid 1px gray;}</STYLE></head><body>";
        $message .= "<p>$name </p><p>Вашему заказу № {$attributes['id']} присвоен статус <strong>{$status[$attributes['status']]}</strong></p>";
        if($attributes['decline_comment']){
            $message  .= "<p>Отказался по причине - <strong>{$attributes['decline_comment']}</strong></p>";
        }
        $message  .= "<p>С уважением администрация {$_SERVER['HOST_NAME']}.</p>";
        $message .=" </body></html>";

        // To send HTML mail, the Content-type header must be set
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

        // To do $attributes[email]!!! Подумать о безопасности

        // Additional headers
        $headers .= "To: $email\r\n";
        $headers .= "From: noreply@{$_SERVER['HOST_NAME']}" . "\r\n";
        $headers .= "Bcc: operator@{$_SERVER['HOST_NAME']}\r\n";
		
                // Mail it
        mail($to, $subject, $message, $headers);
        
//        echo "$to";

    }
}                             
?>
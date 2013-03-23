<?php

include 'qry_connect.php';

$out = array();

$query = "SELECT Concat(name,' ',surname) AS name, email FROM users WHERE id = {$_POST['recipient']}";

$result = mysql_query($query);

$name = mysql_result($result, 0, 'name');

$email = mysql_result($result, 0, 'email');

$to  = $email.", arcady.1254@gmail.com, crazylag@mail.ru";

// subject
$subject = "На ваше сообщение";
	
	// message
$message = "Вы писали - '{$_POST['in_msg']}':\r\n\n\t{$_POST['out_msg']}\r\n";

$headers  = 'MIME-Version: 1.0' . "\r\n";

$headers .= 'Content-type: text/plain; charset=utf-8' . "\r\n";
			
	// Additional headers
$headers .= 'From: noreply@shop.po-mera.ru \r\n';
	
$out['post'] = $to."; ".$subject."; ".$message."; ".$headers;		
	// Mail it
if(mail($to, $subject, $message, $headers)){
    
    $query = "UPDATE `private_messages` SET `status` = 1 WHERE `id` = {$_POST['msg_id']}";

    mysql_query($query);

    if(mysql_affected_rows()>0){
        
        $out['ok'] = 1;
        
        $out['row'] = "r{$_POST['msg_id']}";
    }
}

echo json_encode($out);

mysql_close();
?>

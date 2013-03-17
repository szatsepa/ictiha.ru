<?php
$query_str = str_replace ('out=1','',$attributes['query_str']);

if (mysql_num_rows($qry_userauth)) { 
    
    $id = mysql_result($qry_userauth,0, 'id');
    
    $role = mysql_result($qry_userauth, 0, 'role');
    
        $_SESSION['auth'] = 1;
        
	$_SESSION['id']   = $id;
        
        if($role == 2){
              header ("location:index.php?act=supplier");
        }else{
              header ("location:index.php?$query_str");  
        }
        
	
        
	// В мобильной версии установим куку (неделя) для аутентификации
	if ($mobile == 'true') setcookie("di", $id, time()+680400);

} else {
    header ("location:index.php?{$attributes['query_str']}&err=auth");
}
    ?> 
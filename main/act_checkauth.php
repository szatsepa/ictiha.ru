<?php
// Проверка аутентификации

$authentication = "no";

if (isset($_SESSION['auth']) and !isset($attributes['out'])) {
	
	// В мобильной версии запишем куку (неделя) для аутентификации
	if ($mobile == 'true') setcookie("di", $_SESSION['id'], time()+680400);
    
	$authentication = "yes";
    
        $attributes[user_id] = $_SESSION['id'];
    
	// To do переделать пользователя в объект (ООП)
	$user = query_user($attributes['user_id']); 

//        print_r($user);
//        echo "<br>";
                
    $_SESSION['user'] = $user;
    
    // Создаем массив запрещенных страниц
    $rights = explode(",", $user["rights"]);
    
    // Убиваем пустое значение, если есть
    if ($rights[0] == ''){
        array_shift($rights);
    }
    
    if ($user["role"] == 4) {
        $demo = "demo";
    }
    
    // To do сделать невозможным вход на запрещенную страницу по прямой ссылке из строки URL браузера
    //   
	// Не пускаем обычных пользователей в административную область
	if (eregi('/as/',$_SERVER['PHP_SELF'])) {
		if ($user['role'] == 2 OR $user['role'] == 3 OR $user['role'] == 4 OR $user['role'] == 5 OR $user['role'] > 6) {  
			header ("location:index.php?act=logout");
		}
	}else{
            if($user['role']==1 OR $user['role']==6){
                header ("location:/as/index.php");
            }
        }
        
        if($user['role']==2 and !isset($attributes['act'])){
            header ("location:index.php?act=supplier");
        }
        
        if($user['role']==5 and !isset($attributes['act'])){
            header ("location:index.php?act=logout");
        }
	
} else {
        
		    // Здесь обрабатывать разрегистрированного пользователя!!!!
			
			// Разберемся с мобильным пользователем, у него особые привелегии
			if ($mobile == 'true' and isset($attributes['di']) and $attributes[di] > 0) {
			
				
			    
			    $attributes[user_id] = $attributes['di'];
			    //include ("as/qry_user.php");
			    
				// To do переделать пользователя в объект (ООП)
				$user = query_user($attributes['user_id']); 
			    
				// Пускаем только заказчика!!!
				if ($user["role"] == 3) {				
				    // Создаем массив запрещенных страниц
				    $rights = explode(",", $user["rights"]);
				    
				    // Убиваем пустое значение, если есть
				    if ($rights[0] == ''){
				        array_shift($rights);
				    }
					
				    $_SESSION['auth'] = 1;
					$_SESSION['id']   = $attributes['user_id'];
					$authentication   = "yes";
					
				} else {
					$authentication = "no";
				    // To do попробовать сделать это через базу
				    $rights = array("kabinet","add_cart","supplier","step1","step2");
				}				
			} else {	
				// Здесь все отстальные незарегистрированные пользователи
				$authentication = "no";
			    // To do попробовать сделать это через базу
			    $rights = array("kabinet","add_cart","supplier","step1","step2");
			}
}

if (in_array($attributes['act'],$rights)) {
    header ("location:index.php");
}

?>
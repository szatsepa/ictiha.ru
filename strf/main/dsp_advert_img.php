<?php

/*
 * created by arcady.1254@gmail.com 10/1/2012
 */
function get_Advert($width, $height, $advert_array, $pos){
    
    $com = rand(0, (count($advert_array)-1));
    
    $str = '<form action="'.$advert_array[$com][$pos]['where_from'].'" method="post"  target="_blank">
            <input type="image" src="http://shop.po-mera.ru'.$advert_array[$com][$pos]['name'].'" width="'.$width.'" height="'.$height.'" alt="'.$advert_array[$com][$pos]['name'].'"/>        
        </form>';
    
    
    return "$str";
}
?>


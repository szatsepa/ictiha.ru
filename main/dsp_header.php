<?php 
header('Content-Type: text/html; charset=utf-8'); 
?>
    
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru">

<head>
    <meta http-equiv="Last-Modified" value="<?php echo date("r",(time() - 60));?>" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <?php   $title_header = $title;
        if ($attributes[act] == "single_item" AND mysql_num_rows($qry_price)>0) $title_header = mysql_result($qry_price,0,"str_name");?>
        <title><?php echo $title_header; ?></title>
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
	<link rel="icon" href="/favicon.ico" type="image/x-icon" />
<!-- таблицы стилей -->
        <link rel="STYLESHEET" type="text/css" href="css/<?php echo $css_style; ?>">
        <link rel="stylesheet" media="screen,projection" type="text/css" href="css/slimbox2.css" />	
        <link rel="stylesheet" type="text/css" href="css/mystyle.css" />
        <link rel="stylesheet" type="text/css" href="css/default.css" />
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.1.min.js"></script>
	<script type="text/javascript" src="js/jquery.slimbox2.js"></script>
	<script type="text/javascript" src="js/jquery.switcher.js"></script>
        <script type="text/javascript" src="js/jquery.validate.js"></script>
        <script type="text/javascript" src="js/jquery.cookie.js"></script>
	<script type="text/javascript" src="js/toggle.js"></script>
	<script type="text/javascript" src="js/ui.core.js"></script>
	<script type="text/javascript" src="js/ui.tabs.js"></script>
        <script type="text/javascript" src="js/jquery-scroller-v1.min.js"></script>   
</head>
   
<?php 
if (isset($attributes[err])) {
    if ($attributes[err] == 'auth' and $authentication == "no") $javascript = "javascript:alert('Ошибка авторизации. Введите правильный ключ.');";
}
?>
<body onload="<?php if (isset($javascript) and $mobile == 'false') echo $javascript; ?>">
<div id="wrapper">
<div id="content">
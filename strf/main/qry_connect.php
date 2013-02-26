<?php 

setlocale(LC_ALL, 'ru_RU.utf8');

	$environment = "pro";
	$link = mysql_connect("localhost:/tmp/mysqld.sock","shopmera", "mufloshomer") or die (mysql_errno());
	mysql_select_db("shopmera_ru");
    mysql_query ("SET NAMES utf8");
    $document_root = $_SERVER["DOCUMENT_ROOT"];
	$host          = $_SERVER["HTTP_HOST"];
	
	
	if (mysql_errno() <> 0) exit(mysql_errno());
?>
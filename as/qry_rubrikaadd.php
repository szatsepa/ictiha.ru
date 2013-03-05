<?php 

$name = quote_smart($attributes['name']);

$sinonim  = quote_smart($attributes['sinonim']);

$query = "INSERT INTO rubrikator 
			(id,
			 name,
                         sinonim,
			 creation,
			 time,
			 user_id,
			 status) 
		   SELECT MAX(id)+1,
		         $name,
                         $sinonim
                         now(),
                         now(),".
                         $user['id'].",
                         1 
		    FROM rubrikator";
			
$qry_rubrikaadd = mysql_query($query) or die($query);

?>
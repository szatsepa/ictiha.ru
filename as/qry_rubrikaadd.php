<?php 

$name = quote_smart($attributes['name']);

$sinonim  = quote_smart($attributes['sinonim']);

$result = mysql_query("SELECT MAX(id)+1 FROM rubrikator");

$new_id = mysql_result($result, 0);

$query = "INSERT INTO rubrikator 
			(id,
			 name,
                         sinonim,
			 creation,
			 time,
			 user_id,
			 status)
                    VALUES
                       ($new_id,
		         $name,
                         $sinonim,
                         now(),
                         now(),".
                         $user['id'].",
                         1)";
			
$qry_rubrikaadd = mysql_query($query) or die($query);

?>
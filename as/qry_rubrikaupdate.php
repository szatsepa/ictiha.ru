<?php

$attributes['name'] = quote_smart($attributes['name']);
$attributes['sinonim'] = quote_smart($attributes['sinonim']);
$attributes['id'] = intval($attributes['id']);

$query = "UPDATE rubrikator 
			SET name={$attributes['name']},
                        sinonim = {$attributes['sinonim']},
			time=now(),
			user_id=".$user['id']." 
			WHERE id={$attributes['id']}";

$qry_rubrikaupdate = mysql_query($query) or die($query);

?>
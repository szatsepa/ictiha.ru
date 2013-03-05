<?php

if (isset($attributes['rubrika_id'])) {

	$rubrika_id = intval($attributes['rubrika_id']);
        
        $query = "SELECT `sinonim` FROM `rubrikator` WHERE `id` = $rubrika_id";
        
        $result = mysql_query($query);
        
        $sinonim = mysql_result($result, 0);
        
        $fullname = $sinonim.'.jpg';
	
	$fullname = $document_root . '/images/' . $filename;
	
	// Убьем старый файл
	if (file_exists($fullname)) {
		unlink ($fullname);
		$error = "&error=img_del_ok";
	} else {
		$error = "&error=img_no_del";
	}
}
?>

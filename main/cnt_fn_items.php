<?php
function about_item($barcode) {
    
    if ($barcode == '') return;
	
    $query = "SELECT barcode, 
					 name,
					 short_description,
					 ingridients, 
					 specification, 
					 gost
                FROM goods
               WHERE barcode='$barcode'";

    $qry_exist = mysql_query($query) or die($query);
    
    //Нет описания
    if (mysql_numrows($qry_exist) == 0) { 
	
		return;
	
    } else {
    // Есть описание
        
        $row_count = 1;
        
        while ($row = mysql_fetch_assoc($qry_exist)) {
            
            $about = array('sd'=>trim($row["short_description"]),'ingr'=>trim($row["ingridients"]),'spec'=>trim($row["specification"]),'name'=>$row["name"],'gost'=>$row["gost"]);
            
        }    
     } 
return $about;
}
?>
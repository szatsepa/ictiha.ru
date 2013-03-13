<?php
function about_item($barcode) {
    
    if ($barcode == '') return;
	
    $query = "SELECT g.barcode, 
                    g.name,
                    g.short_description,
                    g.ingridients, 
                    g.specification, 
                    g.gost,
                    p.expiration
                FROM goods AS g, pricelist AS p
               WHERE g.barcode='$barcode' AND g.barcode = p.str_barcode";

    $qry_exist = mysql_query($query) or die($query);
    
    //Нет описания
    if (mysql_numrows($qry_exist) == 0) { 
	
		return;
	
    } else {
    // Есть описание
        
        $row_count = 1;
        
        while ($row = mysql_fetch_assoc($qry_exist)) {
            
            $about = array('sd'=>trim($row["short_description"]),'ingr'=>trim($row["ingridients"]),'spec'=>trim($row["specification"]),'name'=>$row["name"],'gost'=>$row["gost"],'expiration'=>$row['expiration']);
            
        }    
     } 
return $about;
}
?>
<?php
function groupInPrice($id, $gid){
    
    $group_arr = array();
       
    $qry_prices = mysql_query("SELECT price_id FROM storefront_data WHERE storefront_id = $id");
    
    while ($rows = mysql_fetch_assoc($qry_prices)){
        
        
            $query = "SELECT pl.str_group 
                        FROM pricelist AS pl, 
                            storefront_data AS std,
                            price AS p, rubrikator AS r
                        WHERE std.price_id = $rows[price_id] 
                        AND std.price_id = pl.pricelist_id
                        AND pl.pricelist_id = p.id
                        AND p.rubrika = r.id
                        AND pl.str_code2 <> 'X' 
                        AND p.status <> 2 
                        GROUP BY pl.str_group 
                        ORDER BY pl.str_group";
        if($gid != 0){
            $query = "SELECT pl.str_group 
                        FROM pricelist AS pl, 
                            storefront_data AS std,
                            price AS p, rubrikator AS r
                        WHERE std.price_id = $rows[price_id] 
                        AND std.price_id = pl.pricelist_id
                        AND pl.pricelist_id = p.id
                        AND p.rubrika = r.id
                        AND r.id = $gid
                        AND pl.str_code2 <> 'X' 
                        AND p.status <> 2 
                        GROUP BY pl.str_group 
                        ORDER BY pl.str_group";
        }
        
         
    
    $qry_group = mysql_query($query) or die($query);
    
    while($row = mysql_fetch_assoc($qry_group)){
        
       if($row[str_group] != '') array_push($group_arr, $row[str_group]);

    }
        
    }
    
    
    return $group_arr; 
}


?>

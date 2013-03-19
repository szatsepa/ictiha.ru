<?php

if (!isset($user["id"])) {
    $user_for_select = 0;
} else {
    $user_for_select = $user["id"];
}

//$user_for_select = $user["id"];

$query = "SELECT pl.str_name, pl.id, pl.str_code1, pl.num_amount, pl.pricelist_id, c.id AS com_id 
            FROM pricelist AS pl, price AS p, companies AS c
            WHERE (pl.str_code1, pl.pricelist_id)
            IN
            (SELECT b.artikul,b.price_id FROM 
            (SELECT a.artikul,a.price_id,a.user_id,COUNT(a.artikul) AS quantity 
            FROM arch_goods a
            GROUP BY a.artikul 
            HAVING a.user_id = $user_for_select AND COUNT(a.artikul)>1 
            ORDER BY quantity DESC) b
            ) AND pl.pricelist_id = p.id AND p.company_id = c.id";

$qry_userfavgoods = mysql_query($query) or die($query);

 ?>
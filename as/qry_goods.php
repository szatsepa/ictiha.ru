<?php 
// Список товаров (штрих-коды)

if (isset($attributes['barcode'])) {

	$condition = "WHERE barcode='{$attributes['barcode']}'";

} else {

	$condition = "";

}
if(!isset($attributes['search'])){
    $query = "SELECT barcode, 
				 name,
				 short_description,
				 ingridients, 
				 specification, 
				 gost,
                                 nds
			FROM goods ".
			$condition.
	"	ORDER BY up_date";
}else{
    $query = "SELECT barcode, 
				 name,
				 short_description,
				 ingridients, 
				 specification, 
				 gost,
                                 nds
                            FROM `goods`
                            WHERE MATCH (`name`, `short_description`) 
                            AGAINST ('{$attributes['search']}') ORDER BY up_date DESC";
}

//echo $query; 

$qry_goods = mysql_query($query) or die($query);

?>
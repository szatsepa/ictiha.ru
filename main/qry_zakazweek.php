<?php 

if ($user['role'] == 2) {
    $user_for_select = '';
} else {
    $user_for_select = "a.user_id={$user['id']} AND";
}
$status = "AND a.status < 6";

if($attributes['act']=='arch_zakazuser') $status = "AND a.status = 6";

//$user_for_select = $user["id"];

$query = "SELECT DISTINCT a.id, 
                          a.time, 
                          weekday(a.time) as weekday, 
                          DATE_FORMAT(a.time, '%d.%m.%y') zakaz_date,
                          g.price_id,
                          p.comment price_name,
                          a.status
          FROM arch_zakaz AS a,
               arch_goods AS g,
               price AS p
          WHERE  $user_for_select 
                a.id=g.zakaz AND 
                p.id=g.price_id
                $status
          ORDER BY weekday,
                   a.id DESC";

$qry_zakazweek = mysql_query($query) or die($query);

?>

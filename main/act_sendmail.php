<?php
if($user['role']!=2){
    
        $msg = $attributes['comments'];

        if(isset($_SESSION['id']) and $_SESSION['id']){

        //    ищем администратора компании по последней корзине

                $uid = intval($_SESSION['id']);

                $query = "SELECT MAX(`id`) FROM `cart` WHERE `user_id` = $uid";

                $result = mysql_query($query);

                $cart = mysql_result($result,0);

                $query = "SELECT u.id FROM `users` AS u, `price` AS p, `cart` AS c WHERE c.price_id = p.id AND p.company_id = u.company_id AND c.id = $cart AND u.role = 2";

                $result = mysql_query($query);

                if($result){
                    $supplier = mysql_result($result,0);
                }
        }else{
            $uid = 0;
        }

        if(!$supplier){

        //    ищем ежели корзина пуста по оформленым заказам учитывая компанию - прайс лист которой смотрит клиент или же последний заказ

            if(!isset($_SESSION['company_id'])){

                $cid = intval($_SESSION['company_id']);

        //        echo "{$_SESSION['company_id']}<br>";

                $query = "SELECT u.id FROM `users` AS u, `companies` AS c WHERE c.id = u.company_id AND c.id = $cid AND u.role =2";

        //        echo "$query<br>";

                $result = mysql_query($query) or die($query);

                if($result){

                    $supplier = mysql_result($result, 0);
                }

            }else{

                $query = "SELECT u.id FROM `users` AS u, `companies` AS c WHERE c.id = u.company_id AND c.id = (SELECT c.id FROM `arch_zakaz` AS a, `companies` AS c WHERE a.contragent_name = c.name AND a.user_id = $uid GROUP BY c.id ORDER BY c.id) AND u.role =2";

        //        echo "$query<br>";

                $result = mysql_query($query) or die($query);

                $supplier = mysql_result($result, 0, 'id');
            }

        }

        if($supplier){   

            $query = "INSERT INTO `private_messages` (`sender`,`recipient`,`message`) VALUES ($uid, $supplier, '$msg')";

            mysql_query($query);
            }
    
}
if(mysql_affected_rows()>0 and $user['role'] != 2){
    ?>
<script type="text/javascript">
    alert("Ваше сообщение отправлено оператору.");
</script>

<?php
}else{
    ?>
<script type="text/javascript">
    alert("К сожалению адресата не удалось определить. Сообщение не отправлено!");
</script>
<?php
}
?>
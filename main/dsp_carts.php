<?php if(mysql_num_rows($qry_cartlist)) { ?>
<div id="carts" style="position: relative;float: left;">
    <h3>Незавершенные заказы</h3>

    <?php 
    // Выводим все корзины для текущего пользователя

    $cart_count = 1;

    while ($row = mysql_fetch_assoc($qry_cartlist)) {

            $price_id = $row["price_id"];
            
            include ("qry_cart.php");
            
            include ("dsp_backtoprice.php");

            include ("dsp_cart.php");
            
            ++$cart_count;
    }
echo"</div>";
    }?>

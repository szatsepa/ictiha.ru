<div class="container">
    <div class="lb-1">
        <a href="http://po-mera.ru/cabinet/">
            <img src="http://po-mera.ru/image_db/theme/1931528/03_1_02_01.png">
        </a>
        <img src="http://po-mera.ru/image_db/theme/1931528/03_1_02_02.png">
        <img src="http://po-mera.ru/image_db/theme/1931528/03_1_02_03.png">
        <a href="/mail/">
            <img src="http://po-mera.ru/image_db/theme/1931528/03_1_02_04.png">
        </a>
        <a href="http://org.po-mera.ru" alt="Сообщества">
            <img src="http://po-mera.ru/image_db/theme/1931528/03_1_02_05.png">
        </a>
        <a href="http://idea.po-mera.ru/" alt="Идеи">
            <img src="http://po-mera.ru/image_db/theme/1931528/03_1_02_07.png">
        </a>
        <a href="http://shop.po-mera.ru/" alt="Магазин">
            <img src="http://po-mera.ru/image_db/theme/1931528/03_1_02_08.png">
        </a>
        <a href="http://blog.po-mera.ru/" alt="Блог">
            <img src="http://po-mera.ru/image_db/theme/1931528/03_1_02_06.png">
        </a>

        <div class="searchwindow">
            <div class="searchpole">
                <div id="apple" <?php if($authentication == 'yes')  echo "style='visibility:hidden'"; ?>>
                    <?php
                        if(!isset($attributes[act]) && $authentication == 'no'){
                            ?>
                        <form id="search" action="index.php?act=authentication" method="post">
                            <input type="hidden" name="find" value="1"/>
                            <input class="sendsubmit" type="submit" value="Н">
                            <input type="text" placeholder="Войти..." value="" name="code" maxlength="40" size="40">
                        </form>
                     <?php   }else{
                    ?>
                    <form id="search" action="#" method="post">
                        <input type="hidden" name="find" value="1"/>
                        <input class="sendsubmit" type="button" value="Н" id="find_btn">
                        <input type="text" placeholder="Искать..." value="" name="word" maxlength="40" size="40">
                    </form>
                    <?php
                        }
                    ?>
                </div>
            </div>
            <div class="exitbutton">
                <a href="index.php?act=logout">
                    <img src="http://po-mera.ru/image_db/theme/1931528/03_1_02_10.png">
                </a>
            </div>
        </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#find_button").click(function(){
                var str = $("#search input:text").val();
                if(str.length > 0 && str.length < 4){
                    alert("Слишком короткое слово для поиска!");
                }else if(str.length == 0){
                    return false;
                }else{
                    $("#search").submit();
                }
            });
        });
    </script>

    </div>
</div>
<div id="main_menu"> 
    <br><br><p style="text-align: center">
        <?php
        if($_SESSION[auth] == 1){
            if (($user["role"] == 1 or $user["role"] == 3) and $attributes[act] != 'kabinet' and (!in_array("kabinet",$rights)) and $mobile == 'false') { ?>
            <a href="index.php?act=kabinet<?php echo $urladd; ?>" title="Личный кабинет">Личный&nbsp;кабинет</a>&nbsp;&nbsp;&nbsp;
            <?php } 
                    if (($user["role"] == 1 or $user["role"] == 2) and $attributes[act] != 'supplier' and (!in_array("supplier",$rights)) and $mobile == 'false') {?>
            <a href="index.php?act=supplier<?php echo $urladd; ?>" title="Кабинет&nbsp;поставщика">Кабинет поставщика</a>&nbsp;&nbsp;&nbsp;
            <?php }
            if (($user["role"] == 1 or $user["role"] == 5) and $attributes[act] != 'torg' and (!in_array("torg",$rights)) and $mobile == 'false') {?>	
            <a href="index.php?act=torg<?php echo $urladd; ?>" title="Кабинет торгового">Кабинет&nbsp;торгового</a>&nbsp;&nbsp;&nbsp;	
            <?php } 
            if ($attributes[act] == 'kabinet') { ?> 					
                    <a href="index.php?act=kotirovka<?php echo $urladd; ?>" title="Сравнительные котировки">Сравнительные котировки</a>&nbsp;&nbsp;&nbsp;
                    <a href="index.php?act=arch_zakazuser<?php echo $urladd; ?>" title="Архив заказов">Архив&nbsp;заказов</a>&nbsp;&nbsp;&nbsp;
                    <a href="index.php?act=otchet<?php echo $urladd; ?>" title="Отчеты">Отчеты</a>&nbsp;&nbsp;&nbsp;
            <?php } 						
            if ($attributes[act] == 'supplier') { ?> 					
                    <a href="index.php?act=arch_done<?php echo $urladd; ?>" title="Архив поставок">Архив&nbsp;поставок</a>&nbsp;&nbsp;&nbsp;
                    <a href="index.php?act=arch_decline<?php echo $urladd; ?>" title="Отменённые заказы">Отменённые&nbsp;заказы</a>&nbsp;&nbsp;&nbsp;
                    <a href="index.php?act=otchet<?php echo $urladd; ?>" title="Отчеты">Отчеты</a>&nbsp;&nbsp;&nbsp;
            <?php } 

            if (isset($attributes[act])) {
            ?>
            <a href="index.php?act=complist<?php echo $urladd; ?>" title="Обратная связь">Список&nbsp;компаний</a>&nbsp;&nbsp;&nbsp;
            <?php } ?>
            <a href="index.php?act=mailform<?php echo $urladd; ?>" title="Обратная связь">Обратная&nbsp;связь</a>&nbsp;&nbsp;&nbsp;
        <?php }?></p>
            <br><br>
<!--    <ul></ul>-->
</div>
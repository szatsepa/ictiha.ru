<script type="text/javascript">
        $(document).ready(function(){
            
            if($("#search").attr('action') != '#'){
                $("input#entry.sendsubmit input#entry.sendsubmit:hover").css({"background": 'url("http://shop.po-mera.ru/design/search-none.png") no-repeat scroll center top transparent")'});
            }
            
            $("#main_menu input:image").css({'top':'8px'});
            
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
            
            
            
            $("button.btn_main").click(function(){
                var query = this.id;
                query = query.substr(4);
                document.location = "index.php?act="+query+"<?php echo $urladd; ?>";
            }).css({'border':'none','padding-left':'12px'});
            
        });
</script>
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
                            <input class="sendsubmit" id="entry" type="submit" value="Н">
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
    </div>
</div>
<div id="main_menu"> 
    <br><br><p style="text-align: left">&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn_main" id="first_btn">Кнопка 1</button>&nbsp;&nbsp;<button class="btn_main" id="second_btn">Кнопка 2</button>&nbsp;
        <?php
        if($_SESSION[auth] == 1){
            if (($user["role"] == 1 or $user["role"] == 3) and $attributes[act] != 'kabinet' and (!in_array("kabinet",$rights)) and $mobile == 'false') { ?>
            <button class="btn_main" id="btn_kabinet">Личный&nbsp;кабинет</button>&nbsp;
            <?php } 
                    if (($user["role"] == 1 or $user["role"] == 2) and $attributes[act] != 'supplier' and (!in_array("supplier",$rights)) and $mobile == 'false') {?>
            <button class="btn_main" id="btn_supplier">Кабинет&nbsp;поставщика</button>&nbsp;
            <?php }
            if (($user["role"] == 1 or $user["role"] == 5) and $attributes[act] != 'torg' and (!in_array("torg",$rights)) and $mobile == 'false') {?>
            <button class="btn_main" id="btn_torg">Кабинет&nbsp;торгового</button>&nbsp;
            <?php } 
            if ($attributes[act] == 'kabinet') { ?> 
            <button class="btn_main" id="btn_rch_zakazuser">Архив&nbsp;заказов</button>&nbsp;
            <button class="btn_main" id="btn_otchet">Отчеты</button>&nbsp;
            <?php } 						
            if ($attributes[act] == 'supplier') { ?> 
            <button class="btn_main" id="btn_arch_done">Архив&nbsp;поставок</button>&nbsp;
            <button class="btn_main" id="btn_arch_decline">Отменённые&nbsp;заказы</button>&nbsp;
            <button class="btn_main" id="btn_otchet">Отчеты</button>&nbsp;
            <?php } 

            if (isset($attributes[act])) {
            ?>
            <button class="btn_main" id="btn_complist">Список&nbsp;компаний</button>&nbsp;
            <?php } ?>
            <button class="btn_main" id="btn_mailform">Обратная&nbsp;связь</button>&nbsp;
        <?php }?></p>
            <br><br>
</div>
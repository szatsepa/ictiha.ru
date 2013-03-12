<script type="text/javascript">
<!--
        $(document).ready(function(){
            
//            var snd;
            var dt = new Date();
            
//            console.log(Date.parse(dt));
            
             function getMessage(){
                    $.ajax({
                   url:'main/qry_mails_for_me.php',
                   type:'post',
                   dataType:'json',
                   data:{'uid':$("#uid").val(),'dt':Date.parse(dt)},
                   cache:false,
                   success:function(data){
                       console.log(data);
                       var str_messages = '';
                       $.each(data, function(index){
//                           console.log(this['now']);
                           str_messages += this['sender']+' пишет - "'+this['message']+'";  -\t\t';
                       });
                       
                        $("div.scrollingtext").text(str_messages);
                   },
                   error:function(data){
                       console.log(data['responseText']);
                   }
                });
                return false;
             }
            
            var role = $("#role").val();
            
            
            if($("#auth").val()=='yes' && $("#act").val()!='single_price'){
                
                 $("#apple").empty().append('<p>'+'<?php echo "{$user['name']} {$user['surname']}";?>'+'</p>');
                 
            }else if($("#auth").val()=='yes' && $("#act").val()=='single_price'){ 
                
                $("#apple").empty().append('<form id="search" action="#" method="post"><input type="hidden" name="find" value="1"/><input class="sendsubmit" id="find_btn" type="button" value="Н"><input type="text" placeholder="Искать..." value="" name="word" maxlength="40" size="40"></form>');
                    
            }else if($("#auth").val()=='no'){
                console.log("PIZDETS");
                $("#apple").empty().append('<form id="search" action="index.php?act=authentication" method="post"><input type="hidden" name="find" value="1"/><input class="sendsubmit" id="entry" type="submit" value="Н"><input type="text" placeholder="Войти..." value="" name="code" maxlength="40" size="40"></form>');
            }
            
//            var win = {'authentication':'no','add_cart':'no','step1':'no','step2':'no','company_prices':'no','single_price':'no','single_item':'no','add_favprice':'no','kabinet':'no','supplier':'no','customers_list':'no','customer_delete':'no','customer_update':'no','customer_edit':'no','edit_price':'no','kotirovka':'no','view_archzakaz':'no','mailform':'no','sendmail':'no','complist':'no','arch_zakazuser':'no','otchet':'no','arch_done':'no','rubrika':'no','alltags':'no'}
            
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
            }).css({'border':'none','padding-left':'12px','cursor':'pointer'});            

            $("#second_btn").click(function(){
                document.location = "http://coop.po-mera.ru/";
            });

     if(role == 2){
         
            getMessage();
            
            var intID = setInterval(function(){$.ajax({
                   url:'main/qry_mails_for_me.php',
                   type:'post',
                   dataType:'json',
                   data:{'uid':$("#uid").val(),'dt':Date.parse(dt)},
                   cache:false,
                   success:function(data){
                       console.log(data);
                       var str_messages = '';
                       $.each(data, function(){
                           str_messages += '\t - '+this['sender']+' пишет - "'+this['message']+'";\t\t';
                       });
                       
                        $("div.scrollingtext").text(str_messages);
                   },
                   error:function(data){
                       console.log(data['responseText']);
                   }
                });}, 1000*60*10);
            
            //create scroller for each element with "horizontal_scroller" class...	
            $('.horizontal_scroller').SetScroller({velocity: 	 80,
                                                    direction: 	 'horizontal',
                                                    startfrom: 	 'right',
                                                    loop:	 'infinite',
                                                    movetype: 	 'linear',
                                                    onmouseover: 'pause',
                                                    onmouseout:  'play',
                                                    onstartup: 	 'play',
                                                    cursor: 	 'pointer'
                                            });
            /*
                    All possible values for options...

                    velocity: 		from 1 to 99 								[default is 50]						
                    direction: 		'horizontal' or 'vertical' 					[default is 'horizontal']
                    startfrom: 		'left' or 'right' for horizontal direction 	[default is 'right']
                                                    'top' or 'bottom' for vertical direction	[default is 'bottom']
                    loop:			from 1 to n+, or set 'infinite'				[default is 'infinite']
                    movetype:		'linear' or 'pingpong'						[default is 'linear']
                    onmouseover:	'play' or 'pause'							[default is 'pause']
                    onmouseout:		'play' or 'pause'							[default is 'play']
                    onstartup: 		'play' or 'pause'							[default is 'play']
                    cursor: 		'pointer' or any other CSS style			[default is 'pointer']
            */		
        }

});
-->
</script>
<div class="container">
    <input type="hidden" id="act" value="<?php echo $attributes['act'];?>">
    <input type="hidden" id="auth" value="<?php echo $authentication;?>">
    <input type="hidden" id="role" value="<?php echo $user['role'];?>">
    <input type="hidden" id="uid" value="<?php echo $user['id'];?>">
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
                <div id="apple">
                  
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
    <br><br><p style="text-align: left">&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn_main" id="first_btn">Кнопка 1</button>&nbsp;&nbsp;<button class="btn_main" id="second_btn">Совместные закупки</button>&nbsp;
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
    <?php if($user['role'] == 2){?>
        <div class="horizontal_scroller">
            <div class="scrollingtext">
            </div>
        </div>
    <?php }?>
</div>
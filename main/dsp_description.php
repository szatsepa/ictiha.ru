<div id="description">
<!--content -->
	<div class="cont">        
	<input type="hidden" id="role" value="<?php echo $user['role'];?>">
<!--left_side модуль изображения товара -->
		<div class="left_side">
                    <div id = "prewiev">
                    </div>
                    <div id = "img_bg">
                        <p style="text-align: center;"><img id="item_image" src="" alt="Изображение товара"/></p> 
                    </div>
                    <div id = "next">
                    </div>
                    
		</div>
		
<!--center модуль описания товара сюда вставить даные о литраже -->

		<div class= "center_side">
			<div id = "name_center"><?php echo $item_name_head;?><br/><br/></div>
                        <div><p>&nbsp;<br/></p></div>
                        <div id = "prise_txt">цена :<strong> <?php echo $price_item;?> р.</strong></div>
			<div id = "obem_txt">объем:<strong>  <?php echo $volume;?></strong></div>
                        <div id = "price_center">&nbsp;&nbsp;</div> 
                         
                         
                <!-- END -->

                <div id = "v_korzinu"> 
                    <input type="hidden" id="auth" value="<?php echo $authentication;?>"/>                    
                    <a id="add_cart">В корзину</a>
                </div>
                
                
                <div id = "opisanie_center" style="position: relative;width: 100%;height: 218px;float: left;">
                            <br/><br/>
                            <p class="description_1">
                                Описание:  <?php 
			if(!$about['sd']){
                            echo "Описание товара отсутствует.";  	
                        }else{
                            echo $about['sd'];
                            ?>
                               <br/>
                                   <?php 
                        }
                         ?>
                            </p>                        
                        
			<p id = "ingr_title">
                            Ингридиенты:          <?php 
			if(!$about['ingr']){
                            echo "Информация отсутствует.";	
                        }else{
                            echo $about['ingr'];
                        }

                    ?>
                        </p>
			<p id = "p_expiration">
                           Срок годности: <?php echo $about['expiration'];?>
                        </p>
                        <p id = "p_expiration" style="width: 366px;">
                           Cайт поддержки: <a href="<?php echo $about['gost'];?>" target="_blank"><?php echo $about['gost'];?></a>
                        </p>
                        </div>
		</div>
		


		

		
		
<!--Смотрят еще -->
	
<div class = "smotrjat_sche">
    <div class = "all_see" style="padding-top: 5px; margin-left: 36px;">
        <p>Вместе с этим товаром смотрят:</p>
    </div>
                    
                    <?php 
                    for($i=0;$i<4;$i++){
                        ?>
                   
                        <div class = "small_kard_2">
                            <div id = "imag_right" align="center">
                                <input class="look_more" id="more_<?php echo $i;?>" type="image" src=" " title=" " value=" "/> 
                            </div>
                        </div>
                    
                                          
                    
                   <?php } ?>

</div> 
</div>
</div>

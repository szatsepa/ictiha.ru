<div id="description">
<!--content -->
	<div class="cont">        
	
<!--left_side модуль изображения товара -->
		<div class="left_side">
                    <div id = "prewiev">
                    </div>
                    <div id = "img_bg">
                        <img id="item_image" src="" alt="Изображение товара"/> 
                    </div>
                    <div id = "next">
                    </div>
<!--                    <div class = "img_small">
                <?php // $str = get_Advert(469, 91, $advert_array,2); echo $str;?>
                </div>-->
		</div>
		
<!--center модуль описания товара сюда вставить даные о литраже -->

		<div class= "center_side">
			<div id = "name_center"><?php echo $item_name_head;?><br/><br/></div>
                        <div><p>&nbsp;<br/></p></div>
                        <div id = "prise_txt">цена :<strong> <?php echo $price_item;?> р.</strong></div>
			<div id = "obem_txt">объем:<strong>  <?php echo $volume;?></strong></div>
                        <div id = "price_center">&nbsp;&nbsp;</div> 
                        <!--
			
                        <div id = "obem_blok"></div>-->

             
                         
                <!-- END -->
                
                <?php
                if($authentication == 'yes'){
                ?>
                <div id = "v_korzinu"> 
                    
                    <a id="add_cart">В корзину</a>
                </div>
                <?php 
                }
                ?>
<!--                <div id = "otlozit">
                    <a href="index.php?act=to_reserved&amp;stid=<?php echo $attributes[stid];?>&amp;artikul=<?php echo $attributes[artikul];?>&amp;pricelist_id=<?php echo $name_artikul->pricelist;?>&amp;amount=1&amp;type=1&amp;cod=<?php echo $attributes[cod];?>&amp;up=1">Отложить</a>
                </div>-->
			<div id = "opisanie_center" style="position: relative;width: 100%;height: 218px;float: left;">
                            <br/><br/>
                            <p class="description_1">
                                Описание:  <?php 
			if(!$about[sd]){
                            echo "Описание товара отсутствует.";  	
                        }else{
                            echo $about[sd];
                            ?>
                               <br/>
<!--                               <a href='index.php?act=view_descr&amp;artikul=<?php echo $attributes[artikul];?>&amp;stid=<?php echo $attributes[stid];if(isset ($attributes[cod]))echo "&cod=".$attributes[cod];?>&price_id=<?php echo $attributes[price_id];?>' target='_blank' style="font-family: Arial;font-size: 12px;color: #990033;" onmouseover="this.style.color='#878787'" onmouseout="this.style.color='#990033'" > &nbsp;Подробно...</a>-->
                                <?php 
                        }
                         ?>
                            </p>
<!--                            <p class="description_2"> -->
                   
<!--                            </p>-->
                        
                        
			<p id = "ingr_title">
                            Ингридиенты:          <?php 
			if(!$about[ingr]){
                            echo "Информация отсутствует.";	
                        }else{
                            echo $about[ingr];
                        }

                    ?>
                        </p>
<!--			<p id = "ingr_txt"p>
                   
                        </p>-->
                        </div>
<!--                        <div id = "vopros_txt">
                            <a href="http://<?php echo $description[gost];?>" target="_blank"><?php echo $description[gost];?></a>
                        </div>-->
		</div>
		
		
<!--right_side -->
<!--		<div class = "right_side">

		</div>-->

		

		
		
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
<!--                                <a class="look_escho">
                                    <img src="" id="more_<?php echo $i;?>" alt="Изображение товара" title="" value=""/>
                                </a>-->
                            </div>
                        </div>
                    
                                          
                    
                   <?php } ?>
                
<!-- <div class = "smotrjat_sche_1">                 
                      <?php 
                       
                      for($i=0;$i<4;$i++){
                          
                       $str_name = $tmp_arr[$i][str_name];
                       
                       if(strlen($str_name) > 127)$str_name = substr($str_name, 0,128)."...";
                       
                        }?> 
 </div>                 -->
</div> 
</div>
</div>

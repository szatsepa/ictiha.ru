<?php

/*
 * created by arcady.1254@gmail.com
 */

$text_array = array("200X270 или с соотношением сторон 2:3","200X540 или с соотношением сторон 2:5","470X100 или с соотношением сторон 5:1","700X100 или с соотношением сторон 7:1","200X270 или с соотношением сторон 2:3");

$role = intval($_SESSION['user']['role']);

$com_id = intval($_SESSION['user']['company_id']);

$stores = qry_select_storefront($role, $com_id);

$companies_array = array();

//print_r($attributes);
//echo "<br>";
//print_r($img_array);
//echo "<br>";

?>

<table border="1" width="100%">
    
    <tr>
        <td>
            <table border="1">
                <tr>
                
                    <td align="center">
                        <?php
                        if(!isset($attributes['stid'])){ ?>
                        &nbsp;&nbsp;&nbsp;
                        <form action="#" method="post">
                 <?php
include("dsp_storefront_select.php");
?>
                            <input type="hidden" name="st_select" value="select"/>
                            <input type="submit" value="Выбрать"/>
                        </form>
                        &nbsp;&nbsp;&nbsp;
                        <?php }else{
                            echo "<p>";
 foreach ($stores as $value) {
     if($attributes['stid'] == $value['id'])         echo $value['name'];
 }
                            echo "</p>"; }?>
                    </td>
        
    <?php   
//    если выбрана витрина то делаем выборку привязаних к ней компаний из таблицы рекламодателей
    
        if(isset ($attributes['stid'])){
            
            if(!isset($attributes['company_id'])){
            
            include 'qry_companies_advert.php';        

            while ($var = mysql_fetch_assoc($qry_companies)){

                array_push($companies_array, $var);    
            }

            $is_com = count($companies_array);

            if($is_com > 0){

            mysql_data_seek($qry_companies, 0);

    ?>
            <td>
                <form action="#" method="post">
                    <?php 
                    include 'dsp_companyselect.php';
                    ?>
                    <input type="hidden" name="stid" value="<?php echo $attributes['stid'];?>"/>
                    <input type="submit" value="Выбрать"/>
                </form>
                &nbsp;&nbsp;&nbsp;
            </td>
            <?php }
            ?>
            <td>Добавить компанию:
                <form action="index.php?act=advcom" method="post">
                    <input type="hidden" name="company_id" value="<?php echo $attributes['company_id'];?>"/>
                    <input type="checkbox" name="status" value="1" <?php echo $com_check;?>/>
                    <input required type="text" name="name" value="<?php echo $company_name;?>"/>
                    <input type="hidden" name="stid" value="<?php echo $attributes['stid'];?>"/>
                    <input type="submit" value="Добавить"/> 
            </form>
            </td>
            <?php
            }else{ ?>
        <td>
            <p>Компания: <?php echo $company_name;?></p>
            
            <p>
              <form action="index.php?act=ddcom" method="post">
                    <input type="hidden" name="stid" value="<?php echo $attributes['stid'];?>"/>
                    <input type="hidden" name="company_id" value="<?php echo $attributes['company_id'];?>"/>
                    <input type="submit" value="&nbspУдалить"/> 
                </form>  
            </p>
        </td>   
        <?php } ?>
</tr>
        </table>
        </td>
    </tr>
     
    
   <?php
   
   if(isset ($attributes['company_id'])){
   include 'qry_baners_st.php';    
       ?>
    <tr>
        <td>
            &nbsp;&nbsp;&nbsp;&nbsp;Для показа рекламных баннеров компании на сайте витрины поставте галочку в чекбоксе. <br/>
            &nbsp;&nbsp;&nbsp;&nbsp;Размеры загружаемых файлов не должены превышать 64К.
        </td>
    </tr>
    <?php
       
       for($i = 0; $i < 5; $i++){  
           
         if($img_array[$i]['status'] == 1){
             
             $checked = 'checked="checked"';
             $st = 1;
             
         } else {
             
             $checked = '';
             $st = 0;
         } 
                    
       ?>
   
   
     
    <tr>
        
        <td>
            <table border="0">
                
                <tr valign="bottom">
           <?php if(!$img_array[$i]){?>         
                      <td valign="bottom">
                          <h5> &nbsp;&nbsp;&nbsp; Баннер <?php echo ($i+1);?></h5> &nbsp;&nbsp;
                         <form enctype="multipart/form-data"  action="index.php?act=add_baner" method="post"> 
<!--                           <input type="checkbox" name="status" value="1"/>-->
                              <input required type="file"  size="18" accept="image/jpeg,image/png,image/gif,video/swf" name="imgfile" />   
                           <input type="text" size="36" name="where"/>
                          </td>
                        <td>
                            <table border="0">
                                <tr>
                                    <td>
                                        
                                    </td>
                                </tr>
                                <tr> 
                                    <td>
                            <input type="hidden" name="MAX_FILE_SIZE" value="64000"/>
                            <input type="hidden" name="make" value="insert"/>
                            <input type="hidden" name="num_baner" value="<?php echo $i;?>"/>
                            <input type="hidden" name="company_id" value="<?php echo $attributes['company_id'];?>"/>
                            <input type="hidden" name="stid" value="<?php echo $attributes['stid'];?>"/>
                            <input type="submit" value="Загрузить баннер" id="knob" />
                       </td>
                     </form>
                </tr>
                     </table>
                        </td>
                        
                        <?php }else{?> 
                    <td valign="bottom">
                        <form enctype="multipart/form-data"  action="index.php?act=add_baner" method="post">
                             <h5> &nbsp;&nbsp;&nbsp; Баннер <?php echo ($i+1);?></h5> &nbsp;&nbsp;
                            <input type="hidden" name="MAX_FILE_SIZE" value="64000"/>
                            <input type="hidden" name="num_baner" value="<?php echo $i;?>"/>
                            <input type="hidden" name="make" value="change"/>
                            <input type="hidden" name="id" value="<?php echo $img_array[$i]['id'];?>"/>
                            <input type="hidden" name="stid" value="<?php echo $attributes['stid'];?>"/>
                            <input type="hidden" name="company_id" value="<?php echo $attributes['company_id'];?>"/>
<!--                            <input type="checkbox" name="status" value="1" <?php echo $checked;?> />-->
                            <input type="file" required size="18" accept="image*" name="imgfile"/>   
                            <input type="text" size="36" name="where" value="<?php echo $img_array[$i]['where_from'];?>"/>
                            <br/>
                            &nbsp;
                            <br/>
                            &nbsp
                        </td>
                        
                       
                        <td>
                            <table>
                        <tr valign="bottom">
                                   <td valign="bottom">
                                        <input type="submit" value="Изменить банер" id="knob" <?php if(!$img_array[$i]['id']) echo "disabled";?>/>
                                    </td>
                                    </form>
                         
                                </tr>
                                <tr>
                                   <form action="index.php?act=deladv" method="post">
                            <td valign="bottom">
                                <input type="hidden" name="name" value="<?php echo $img_array[$i]['name'];?>"/>
                                <input type="hidden" name="id" value="<?php echo $img_array[$i]['id'];?>"/>
                                <input type="hidden" name="stid" value="<?php echo $attributes['stid'];?>"/>
                                <input type="hidden" name="company_id" value="<?php echo $attributes['company_id'];?>"/>
                                <input type="submit" value="&nbsp;Удалить банер&nbsp;" id="knob" <?php if(!$img_array[$i]['id']) echo "disabled";?>/> 
                            </td>
                            
                        </form> 
                                </tr>
                            </table>
                       </td> 
                    <?php }?>
                    <td>
                        <img src="<?php echo $img_array[$i]['name'];?>" width="120" alt="image"/>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
     <tr>
        <td>
            &nbsp;&nbsp;&nbsp;&nbsp;Размер изображения "Баннер <?php $b = ($i+1); echo $b;?>" должен быть в пределах <?php echo $text_array[$i];?>
        </td>
    </tr>
    
    <?php
    
       }
   }
   
}
   ?>
<tr>
        <td>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </td>
    </tr>
<?php if(count($img_array) != 0){ ?>

<!--    <tr align="center" valign="bottom">
        <td>
            <table>
                <tr align="center" valign="bottom">
                    <td>
                       <form action="index.php?act=view_adv" method="post">
                <input type="hidden" name="company_id" value="<?php echo $attributes['company_id'];?>"/>
                <input type="hidden" name="stid" value="<?php echo $attributes['stid'];?>"/>
                <input type="submit" value="Посмотреть рекламу"/>
            </form>
                    </td>
                </tr>
            
                </table>
        </td>
    </tr>-->


<?php } ?>

 </table>     


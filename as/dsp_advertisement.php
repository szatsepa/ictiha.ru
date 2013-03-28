<script type="text/javascript">
    $(document).ready(function(){
        
        $("#advert_tab").css({'font-size':'1.0em'});
        $("#advert_tab tr").css({'border-bottom':'1px solid #ccc','border-top':'1px solid #ccc'});
        var st = 0;
        
        $("#select_st").mouseup(function(){
            if(st == 1){
                $("#st_select").attr('action', 'index.php?act=advert').submit();
            }
            
            st++;
            
            if(st == 2) st = 0;
            
        });
        
        var com = 0;
        
        $("#select_com").mouseup(function(){
            if(com == 1){
                $("#com_select").attr('action', 'index.php?act=advert').submit();
            }
            
            com++;
            
            if(com == 2) com = 0;
            
        });
        
         $("#back_btn").click(function(){
             
             document.location = "index.php?act=advert";
         });
        
        $("#status").change(function(){
            
            var check = 0;
            if($("#status").attr('checked')) check = 1;
            
            $.ajax({
                url:'add_check_com.php',
                type:'post',
                dataType:'json',
                data:{'status':check,'company_id':$("#cid").val()},
                error:function(data){
                    console.log(data['responseText']);
                }
            });
            
        });
    });
</script>
<?php
$text_array = array("200X270 или с соотношением сторон 2:3","200X540 или с соотношением сторон 2:5","470X100 или с соотношением сторон 5:1","700X100 или с соотношением сторон 7:1","200X270 или с соотношением сторон 2:3");

$role = intval($_SESSION['user']['role']);

$com_id = intval($_SESSION['user']['company_id']);

$stores = qry_select_storefront($role, $com_id);

//print_r($attributes);
//echo "<br>";
?>
<table id="advert_tab" border="0" width="100%">
    <thead></thead>
    <tbody>
        <tr>
<?php
if(!isset($attributes['stid'])){
?>          <td>
                <form id="st_select" method="post">
                 <?php
include("dsp_storefront_select.php");
?>
                    <input type="hidden" name="st_select" value="select"/>
<!--                    <input type="submit" value="Выбрать"/>-->
                </form>
            </td>
            
<?php }else{
                            echo "<td><p id='st_name'><strong>";
 foreach ($stores as $value) {
     if($attributes['stid'] == $value['id'])         echo $value['name'];
 }
                            echo "</strong></p></td>";
     
     include 'qry_companies_advert.php';
     
     $companies = array();
     
     while ($row = mysql_fetch_assoc($qry_companies)){
         array_push($companies, $row);
     }


    $is_com = count($companies);
     
    if(count($companies)>0) mysql_data_seek($qry_companies, 0);
    
//print_r($companies);
//echo "<br>";
                            
                            }
                            
 if(isset($attributes['stid']) && !isset($attributes['company_id'])){
             
        if($is_com > 0){

                
                ?>
            <td>
                <form id="com_select" method="post">
                    <select name="company_id" id="select_com" class="common">
                        <?php
                        echo "<option value='0'>Выберите компанию</option>";
                        while ($row_select = mysql_fetch_assoc($qry_companies)) {
                            
                            $name = $row_select['name'];

                            $name = substr($name, 0, 28);

                            if ($row_select["id"] == $attributes['company_id']){ ?>
                                <option value="<?php echo $row_select["id"];?>" selected><?php echo $name;?></option>";        
                        <?php }else{?>
                                <option value="<?php echo $row_select['id'];?>"><?php echo $name;?></option> 
                            <?php }
                        }
                    ?>
                    </select>
                    <input type="hidden" name="stid" id="stid" value="<?php echo $attributes['stid'];?>"/>
                    
                </form>                
            </td>
            <td>
                <form action="index.php?act=advcom" method="post">
                    Или добавте компанию:
                    
                        <input type="hidden" name="company_id" id="cid" value="<?php echo $attributes['company_id'];?>"/>                        
                        <input required type="text" name="name" value=""/>
                        <input type="hidden" name="stid" value="<?php echo $attributes['stid'];?>"/>
                        <input type="submit" value="Добавить"/> 
                
              </form>
            </td>
            <?php
     
            }
 } else if(isset ($attributes['company_id'])){
     if($check == 1) $checked = 'checked';
                echo '<input type="hidden" id="cid" value="'.$attributes['company_id'].'"/> ';
                            echo "<td><p id='st_name'><small>Активировать:</small><input type='checkbox' id='status' value='1' $checked>&nbsp;&nbsp;<strong>";
 foreach ($companies as $value) {
     if($attributes['company_id'] == $value['id'])         echo $value['name'];
 }
                            echo "</strong></p></td>"; 
                            
                            }
                            ?>
            <td align="center">
                <input type="button" id="back_btn" value="Вернутся">
            </td>
            <?php
                            
 if(isset($attributes['stid']) && isset($attributes['company_id'])){
     include 'qry_baners_st.php'; 
     ?>
     <tr>
        <td colspan="3">
            &nbsp;&nbsp;&nbsp;&nbsp;Для показа рекламных баннеров компании на сайте витрины в чекбоксе должна стоять галочка. <br/>
            &nbsp;&nbsp;&nbsp;&nbsp;Размеры загружаемых файлов не должены превышать 64К.
        </td>
    </tr>
     <?php
    for($i = 0; $i < 5; $i++){  
                            
       ?>
   
   
     
    <tr>
        
        <td colspan="3">
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
        <td colspan="3">
            &nbsp;&nbsp;&nbsp;&nbsp;Размер изображения "Баннер <?php $b = ($i+1); echo $b;?>" должен быть в пределах <?php echo $text_array[$i];?>
        </td>
    </tr>
    
    <?php
    
       }
 }                           
                            ?>
            
        </tr>        
    </tbody>
</table>
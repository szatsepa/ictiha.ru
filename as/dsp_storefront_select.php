<?php

/*
 * created by arcady 6.11.2011
 */
$cnt = count($stores);

if($cnt != 0){

echo '<select name="stid" id="select_st" class="common">';
echo  "<option size='32' value='0'>Выберите витрину</option>";  

foreach ($stores as  $value) {

          
        $name = $value['name'];
            
        $name = substr($name, 0, 46); 
        
        if(isset ($attributes['st_select']) && $attributes['st_select'] == "select" && $attributes['stid'] == $value['id']){
         echo  "<option size='32' value='".$value["id"]."' selected>".$name."</option>";
        }else {
           echo  "<option size='32' value='".$value["id"]."' >".$name."</option>";  
        }
    }
 ?>
</select>  
 <?php 
  
 } 

?>
<?php
//if($attributes[select]=='R' && isset($attributes[group]))$gid = $attributes[group];
$group_a = groupInPrice($attributes[stid]);
 $groups = array_unique($group_a);  
 unset($group_a);
?>

<select id="selector" class="common" name="group" onchange="document.location='index.php?act=look&select=group&group='+this.options[this.selectedIndex].value+'&stid=<?php echo $attributes[stid];?>&cod=<?php echo $attributes[cod];?>'">
        
        <option value="default">Выбрать группу</option>
        
    <?php 
    
         
    
    foreach ($groups as $key => $value) {
          if(isset($attributes[group]) and $attributes[group] == $value){ ?>
              <option value="<?php echo $value;?>" selected><?php echo $value;?></option>
         <?php 
    
         }else{
                  
         ?>
              <option value="<?php echo $value;?>"><?php echo $value;?></option>
                <?php }
         
                     
    }
    ?> 
    </select>
 
<?php

class DateSelect{
       
    function DateSelect(){
        
        
 
    }
    
    function _getYear($name, $id, $up){
        
        $out_string = "<select class='common' name='$name' id='$id'> ";
                        
                            $yy = date(Y);
                            
                            if($up){
                                
                                $lowyear = ($yy + 3);
                                
                                while($yy < $lowyear){
                                    
                                   if(date(Y)==$yy){
                                       $out_string .= "<option value='$yy' selected>$yy</option>";
                                   }else{
                                       $out_string .= "<option value='$yy'>$yy</option>";
                                   }
                                
                                    $yy++;
                                
                                }
                            }else{
                                
                                $lowyear = ($yy - 5);
                                
                                
                                while($yy > $lowyear){
                                    
                                    if(date(Y)==$yy){
                                       $out_string .= "<option value='$yy' selected>$yy</option>";
                                   }else{
                                       $out_string .= "<option value='$yy'>$yy</option>";
                                   }

                                    $yy--;

                                }
                            }
                            
                        
	$out_string .= 	"</select>";
        
        return $out_string; 
    }
    
    function _getMonth($name, $id){
                
        $out_string = "<select class='common' name='$name' id='$id'> ";  
        
        for ($i=1;$i<13;++$i) {
            
            if(date(m)==$i){
                $out_string .= "<option value='".sprintf("%02d",$i)."' selected>".sprintf("%02d",$i)."</option>";
            }else{
                $out_string .= "<option value='".sprintf("%02d",$i)."'>".sprintf("%02d",$i)."</option>";
            }
        }
        
        $out_string .= "</select>";
        
        return $out_string;
    }
    
    function _getDey($name, $id){    								
            
        $out_string = "<select class='common' name='$name' id='$id'> "; 
                
                for ($i=1;$i<32;++$i) { 
                    if(date(d)==$i){
                        $out_string .= " <option value='".sprintf("%02d",$i)."' selected>".sprintf("%02d",$i)."</option>";
                    }else{
                        $out_string .= " <option value='".sprintf("%02d",$i)."'>".sprintf("%02d",$i)."</option>";
                    }
                   
                }
              
        $out_string .= "</select>";
        
        return $out_string;
    }
    
    function _getHoars($name, $id){
        
        $out_string = "<select class='common' name='$name' id='$id'> "; 
                
                for ($i=1;$i<24;++$i) { 
                    if(date(H)==$i){
                        $out_string .= " <option value='".sprintf("%02d",$i)."' selected>".sprintf("%02d",$i)."</option>";
                    }else{
                        $out_string .= " <option value='".sprintf("%02d",$i)."'>".sprintf("%02d",$i)."</option>";
                    }
                   
                }
              
        $out_string .= "</select>";
        
        return $out_string;
    }
    
    function _getMinits($name, $id){
        
        $out_string = "<select class='common' name='$name' id='$id'> "; 
                
                for ($i=1;$i<60;++$i) { 
                    if(date(i)==$i){
                        $out_string .= " <option value='".sprintf("%02d",$i)."' selected>".sprintf("%02d",$i)."</option>";
                    }else{
                        $out_string .= " <option value='".sprintf("%02d",$i)."'>".sprintf("%02d",$i)."</option>";
                    }
                   
                }
              
        $out_string .= "</select>";
        
        return $out_string;
    }   
    
    function _dateValidation($str_date){
        
    }
}
?>

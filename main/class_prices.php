<?php
class Prices{
    
    
    private $artikles = array();
    
    private $str_block;


    function Prices(){
        
        $rubrikator = array();
        
        $prices = array();
        
        $query = "SELECT `id`,`name` AS rubrika FROM `rubrikator`";
        
        $result = mysql_query($query);
        
        while ($var = mysql_fetch_assoc($result)){
            $rubrikator[$var[id]] = $var[rubrika];
        }
        
        foreach ($rubrikator as $key => $value) {
            
            $query = "SELECT `id` FROM `price` WHERE `rubrika` = '$key' LIMIT 0 , 1";
            
            $result = mysql_query($query);
            
            if(mysql_num_rows($result) > 0){
                $row = mysql_fetch_row($result);
                array_push($prices, $row[0]);
            }
        }
// p.`str_code2` = 'v' AND        
        foreach ($prices as $value) {
            
            $query = "SELECT p.`Id`, p.`str_code1`, p.`str_barcode`, p.`str_name` AS name, p.`str_volume`, p.`num_price_single` AS price, CONCAT(gp.`id`,'.',gp.`extention`) AS img FROM `pricelist` AS p LEFT JOIN `goods_pic` AS gp ON p.`str_barcode` = gp.`barcode` WHERE p.`pricelist_id` = '$value' AND gp.`pictype`=1 LIMIT 0,1";
            
            $result = mysql_query($query);
            
            if(mysql_num_rows($result) > 0){
                $row = mysql_fetch_assoc($result);
                $row[price_id] = $value;
                array_push($this->artikles, $row);
            }
        }
    }
    
    function _getArtikles(){
        return $this->artikles;
    }
    
    function _getBlock(){
        
        $this->str_block = "<table id='art_block'><tbody>";
        
        foreach ($this->artikles as $value){
            if($value[img]){
                $image = $value[img];
            }else{
                $image = "no_pic.jpg";
            }
//            echo $value[price_id]."<br>";
            
            $this->str_block .= "<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td><a href='index.php?act=single_price&amp;pricelist_id=$value[price_id]'><img src='images/goods/$image' alt='$value[name]' width='128'></a></td><td><a href='index.php?act=single_price&pricelist_id=$value[price_id]'>$value[name] - $value[price] руб.</a></td></tr>";
        }
        
        $this->str_block .= "</tbody></table>";
        
        return $this->str_block;
    }
    
} 

class Companies{
    
    private $companies = array();
    
    private $str_block;


    function Companies(){
        
        $query = "SELECT id, `name`,`full_about` FROM `companies`";
        
        $result = mysql_query($query);
        
        if(mysql_num_rows($result)>0){
            while($row = mysql_fetch_assoc($result)){
                array_push($this->companies, $row);
            }
        }
    }
    
    function _getCompanies(){
        return $this->companies;
    }
    
    function _getBlock(){
        
        $tmp = array();
        
        for($i=0;$i<4;$i++){
            
            $rand = rand(0, (count($this->companies)));
            array_push($tmp, $this->companies[$rand]);
        }
        
        $this->str_block = "<table id='art_block'><tbody>";
        
        foreach ($tmp as $value){
            if($value[img]){
                $image = $value[img];
            }else{
                $image = "no_pic.jpg";
            }
//            echo $value[price_id]."<br>";
            
            $this->str_block .= "<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td><a href='index.php?act=act=company_prices&company_id=$value[id]'>$value[name]</a></td><td>$value[full_about]</td></tr>";
        }
        
        $this->str_block .= "</tbody></table>";
        
        
        
        return $this->str_block;
    }
}
?>

<?php
class Prices{
    
    private $prices = array();


    private $artikles = array();
    
    private $str_block;


    function Prices(){
        
        $rubrikator = array();
        
        $query = "SELECT `id`,`name` AS rubrika FROM `rubrikator`";
        
        $result = mysql_query($query);
        
        while ($var = mysql_fetch_assoc($result)){
            $rubrikator[$var[id]] = $var[rubrika];
        }
        
        foreach ($rubrikator as $key => $value) {
            
            $query = "SELECT p.`id`, p.`tags` FROM `price` AS p LEFT JOIN `companies` AS c ON p.`company_id` = c.`id` WHERE `rubrika` = '$key' LIMIT 0 , 1";
            
            $result = mysql_query($query);
            
            if(mysql_num_rows($result) > 0){
                $row = mysql_fetch_row($result);
                array_push($this->prices, $row[0]);
            }
        }
        
        foreach ($this->prices as $value) {
            
            $query = "SELECT p.`Id`, p.`str_code1`, p.`str_barcode`, p.`str_name` AS name, p.`str_volume`, p.`num_price_single` AS price, CONCAT(gp.`id`,'.',gp.`extention`) AS img FROM `pricelist` AS p LEFT JOIN `goods_pic` AS gp ON p.`str_barcode` = gp.`barcode` WHERE p.`pricelist_id` = '$value' AND gp.`pictype`=1 LIMIT 0,1";
            
            $result = mysql_query($query);
            
            if(mysql_num_rows($result) > 0){
                $row = mysql_fetch_assoc($result);
                $row[price_id] = $value;
                array_push($this->artikles, $row);
            }
        }
    }
    
     function _getAlphabet(){
        
        $bukvar     = array('А','Б','В','Г','Д','Е','Ж','З','И','К','Л','М','Н','О','П','Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Э','Ю','Я');
        
        $bukvar_act = array();
        
        // Обнулим массив, нет компаний с такой буквой
        foreach ($bukvar as $key) {
                $bukvar_act[$key] = 0;
        }
        
        $query = "SELECT c.`name` FROM `price` AS p LEFT JOIN `companies` AS c ON p.`company_id` = c.`id`";
            
        $result = mysql_query($query);
        
        while ($row = mysql_fetch_assoc($result)){
            
            $row[name] = utf8_to_cp1251($row[name]);
            $company_letter = iconv_substr($row[name], 0,1);
            $company_letter = cp1251_to_utf8($company_letter);
            
            // Учитываем только русские буквы
            if (in_array($company_letter,$bukvar)){
                $bukvar_act[$company_letter] = 1;
            }
        }
       
        $str_alphabet = "<table id='abc_table' width='100%'><tbody><tr>";
        
        foreach ($bukvar_act as $key => $value) {
            if ($value == 1) {
                    $str_alphabet .= "<td><div align='center' class='alphabet'><a href='index.php?act=bukva&amp;id=$key$urladd'>$key</a></div></td>";
            } else {
                    $str_alphabet .= "<td><div align='center' class='alphabet_b'>$key</div></td>";
            }
        }
        
        $str_alphabet .= "</tr></tbody></table>";
        
        return $str_alphabet;
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
            
            $this->str_block .= "<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td><a href='index.php?act=company_prices&company_id=$value[id]'>$value[name]</a></td><td>$value[full_about]</td></tr>";
        }
        
        $this->str_block .= "</tbody></table>";
        
        
        
        return $this->str_block;
    }
}
?>

<?php
class Prices{
    
    private $prices = array();


    private $artikles = array();
    
    private $str_block;


    function Prices(){
        
        $rubrikator = array();
        
        $query = "SELECT `id`,`name` AS rubrika FROM `rubrikator` WHERE status = 1";
        
        $result = mysql_query($query);
        
        while ($var = mysql_fetch_assoc($result)){
            $rubrikator[$var[id]] = $var[rubrika];
        }
        
        foreach ($rubrikator as $key => $value) {
            
            $query = "SELECT p.`id`, p.`comment` AS pricename, p.`tags` FROM `price` AS p LEFT JOIN `companies` AS c ON p.`company_id` = c.`id` WHERE `rubrika` = '$key' LIMIT 0 , 1";
            
            $result = mysql_query($query);
            
            if(mysql_num_rows($result) > 0){
                $pid = mysql_result($result,0,'id');
                $tmp = array('id'=>$pid, 'pricename'=>  mysql_result($result, 0,'pricename'));
                array_push($this->prices, $tmp);
            }
        }
        
        foreach ($this->prices as $value) {
            
            $query = "SELECT p.`Id`, p.`str_code1`, p.`str_barcode`, p.`str_name` AS name, p.`str_volume`, p.`num_price_single` AS price, CONCAT(gp.`id`,'.',gp.`extention`) AS img FROM `pricelist` AS p LEFT JOIN `goods_pic` AS gp ON p.`str_barcode` = gp.`barcode` WHERE p.`pricelist_id` = '{$value['id']}' AND gp.`pictype`=1 LIMIT 0,1";
            
            $result = mysql_query($query);
            
            if(mysql_num_rows($result) > 0){
                $row = mysql_fetch_assoc($result);
                $row['price_id'] = $value['id'];
                $row['pricename'] = $value['pricename'];
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
            
            $row['name'] = utf8_to_cp1251($row['name']);
            $company_letter = iconv_substr($row['name'], 0,1);
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
    
    function _getBlockArticles(){
        
        $this->str_block = "<table id='art_block'><tbody>";
        
        $rows = ceil(count($this->artikles)/3);
        
        $cell = 0;
                
        for($i=0;$i<$rows;$i++){
            
            $this->str_block .= "<tr>";
            
            for($c = 0;$c < 3; $c++){
                
                $image = $this->artikles[$cell]['img'];
            
                if(!$image)$image="no_pic.jpg";           

                $this->str_block .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td><p><a href='index.php?act=single_price&pricelist_id={$this->artikles[$cell]['price_id']}'><img src='images/goods/$image' alt='{$this->artikles[$cell]['pricename']}' width='128'></a></p><p><a href='index.php?act=single_price&pricelist_id={$this->artikles[$cell]['price_id']}'>{$this->artikles[$cell]['pricename']} - {$this->artikles[$cell]['price']} руб.</a></p></td>";            
            
                $cell++;
                
                if($cell == count($this->artikles))                    break;
            }
            
            
            
            $this->str_block .= "</tr>";
           
        }
        
        $this->str_block .= "</tbody></table>";
        
        return $this->str_block;
    }
    
}  

class Companies{
    
    private $companies = array();
    
    private $str_block;


    function Companies(){
        
        $query = "SELECT id, `name`,`full_about`, CONCAT('logo_',`id`,'.jpg') AS logo FROM `companies` WHERE `status` = 1 ORDER BY `name`";
        
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
    
    function _getBlockCompanies(){
        
        $this->str_block = '<fieldset class="fs"><table cellpadding="2" cellsapcing="1"><thead></thead><tbody>';
        
        $num_cells = count($this->companies);
        
        $num_rows = ceil($num_cells/5);
        
        $cell = 0;
        
        for($i = 0; $i < $num_rows;$i++){
            $this->str_block .= "<tr>";
            
            for($ii = 0;$ii < 5; $ii++){
                if(!file_exists($_SERVER["DOCUMENT_ROOT"]."/images/logos/".$this->companies[$cell]['logo'])){
                    $this->str_block .= "<td><a href='index.php?act=company_prices&company_id={$this->companies[$cell]['id']}'>{$this->companies[$cell]['name']}</a></td>"; 
                }else{
                    $this->str_block .= "<td><a href='index.php?act=company_prices&company_id={$this->companies[$cell]['id']}'><img src='../main/act_prewiew.php?src=http://{$_SERVER['HTTP_HOST']}/images/logos/{$this->companies[$cell]['logo']}&width=42&height=42'/>{$this->companies[$cell]['name']}</a></td>";
                }
                
                $cell++;
                if($cell == $num_cells)                    break;
            }
            
            $this->str_block .= "</tr>";
        }

        
        $this->str_block .= '</tbody></table></fieldset>';
               
        return $this->str_block;
    }
}

class Chapters{
    
    private $rubrikator = array();
    
    function Chapters(){
        
        $query = "SELECT * FROM `rubrikator` WHERE status = 1";
        
        $result = mysql_query($query);
        
        while ($row = mysql_fetch_assoc($result)){
            array_push($this->rubrikator, $row);
        }
        
    }
    
    function _getBlockChapters(){
        $block = '<fieldset class="fs"><table border="0" cellpadding="2" cellsapcing="1"><thead></thead><tbody>';
        
        $num_cells = count($this->rubrikator);
        
        $num_rows = ceil($num_cells/5);
        
        $cell = 0;
        
        for($i = 0; $i < $num_rows;$i++){
            $block .= "<tr>";
            
            for($ii = 0;$ii < 5; $ii++){
                $block .= '<td valign="top" class="rubrik_link"><a href="index.php?act=rubrika&amp;id='.$this->rubrikator[$cell]['id'].'"><img src="../main/act_prewiew.php?src=http://'.$_SERVER['HTTP_HOST'].'/images/'.$this->rubrikator[$cell]['sinonim'].'.jpg&width=48&height=48"/></a><a href="index.php?act=rubrika&amp;id='.$this->rubrikator[$cell]['id'].'">'.$this->rubrikator[$cell]['name'].'</a></td>';
                $cell++;
                if($cell == $num_cells)                    break;
            }
            
            $block .= "</tr>";
        }

        
        $block .= '</tbody></table></fieldset>';
        
        return $block;
    }
    
}
?>

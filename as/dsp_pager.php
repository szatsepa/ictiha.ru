<?php

if(!isset($search_form))$search_form = 0;

if($pages > 1){
?>
<!--<table class="dat" border="1">
<tr align="center">
<td align="center">
</td>
</tr>
</table>-->
<p align="center">
 <?php 
   
 if($page > 0)echo "<a href='index.php?act=goods&page=0'><<&nbsp;Первая &nbsp;</a><a href='index.php?act=goods&page=".($page-1)."'>Предыдущая&nbsp;</a>";      
  ?>      
        
        
<?php

for($i=($page);$i<($page+4);$i++){

    if($i == $pages)break;
    
	$p = $i+1;
        
        ?>

        
        <a href="<?php echo "index.php?act=goods&page=$p";?>"><?php echo $p;?></a>
    



<?php 

    }
  
    
    if($page < $pages) echo "<a href='index.php?act=goods&page=".($page+1)."'>&nbsp;Следующая</a><a href='index.php?act=goods&page=".$pages."'>&nbsp;Последняя&nbsp;>> </a>";
  
 $end = $start + 36; 
?>
</p>
<p align="center">Строки <?php echo ($start+1)." - ".$end." из ".$cnt;?>&nbsp;&nbsp;</p>

            
<?php
    }
if($search_form === 0){
?>
<div id="goods_search">
    <p style="text-align: right;">
        <input type="text" id="search_string" value="" size="32"/>
        <input type="button" id="go_search" value="Поиск товаров"/>
    </p>    
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $("#go_search").mousedown(function(){
            _search();
        }).keyup(function(e){
            if(e.whith == 13){
              _search();  
            }
        });
        
    });
    function _search(){
        var search = $("#search_string").val();
        if(search.lenght < 5 || !search){
            alert("Слишком короткая строка поиска!");
        }else{
            document.location = "index.php?act=goods&search="+search;
        }
        return false;
    }
</script>
<?php 
}

$search_form++;
?>
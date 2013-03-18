<script language="JavaScript">
	
    $(document).ready(function(){
        
        var cnt = 0;
        
        var rows = 0;
        
        $.each($(".cart tbody tr td input.expir"), function(index){
            
            console.log(index);
            
            var bg_color = $(this).val(); 
            
            $(this).parent().parent().css({'background-color':bg_color}).attr('id',bg_color);
            
            if(bg_color == "#F5BFE6"){
                $(this).parent().parent().parent().parent().parent().empty();
            }
            
         });
         
         $.each($(".cart tbody tr td"), function(index){
             
                 var id = this.id;
             
                if(id){
//                    console.log(id+" -> "+$(this).text());
                    
                    var obj = $("#"+id);

                    if($(this).cellIndex == 7 && $(this).parent().attr('id')=='#E3F5BF'){

                        cnt += parseInt($(obj).text());
                        
//                         console.log(cnt);

                    }
                    rows++;
              }
              
         });
//         console.log(rows);
         if(cnt != 0){
             $("#how_meny").text("Итого: "+cnt+"руб.");
         } 
         
        $(".cloud").click(function(){
            
            var pid = this.id;
            
            var simbl = pid.substr(0,2);
            
            pid = pid.substr(3);
            
            if(simbl == 'cl'){
                if (confirm("Вы уверены, что хотите удалить этот прайс из \"Избранного\"?")) {
			URL = "http://"+document.location.hostname+"/index.php?act=del_favprice&id=" + pid;
			document.location = URL;
		}
            }else{
                if (confirm("Вы уверены, что хотите удалить тег из \"Меток\"?")) {
			URL = "http://"+document.location.hostname+"/index.php?act=del_tag&oid=" + pid;
			document.location = URL;
		}
            }
           
            
		return false;
        });
       
    });
</script>
<?php include "main/dsp_message.php"; ?>
<div align="center" style="padding-top:10px;">
    <input type="hidden" id="uadd" value="<?php echo $urladd;?>"/>
    <table border="0" cellpaddin="0" cellspacing="0">
        <tr>
    <?php //include("dsp_advert.php"); ?>
        <td valign="top" class="kab">
            <table border="0" cellpadding="5" cellspacing="5" width="230">
                <tr>
                    <td>
                        <div class="kab">Избранные компании</div>
                    </td>
                </tr>
<?php 

$rowcount = 1;
while ($row = mysql_fetch_assoc($qry_userfavcompanies)) { 
        echo "<tr><td><a href='index.php?act=company_prices&company_id=".$row["id"].$urladd."'>".$row["name"]."</a></td></tr>";
        
    ++$rowcount;
	// Ограничим вывод любимых компаний
    if ($rowcount == 8) break;
}
if (mysql_numrows($qry_userfavcompanies) == 0){
echo "<tr><td class='smallmessage'>Нет компаний для отображения. Для добавления используйте кнопку &quot;Добавить в избранное&quot; в прайс-листе.</td></tr>";
}

if (mysql_numrows($qry_userfavcompanies) > 7){
	echo "<tr><td>&nbsp;<a href=''>Все компании&gt;&gt;<a></td></tr>";
} ?>                        
            </table>
        </td>
        <td valign="top" class="kab">
            <table border="0" cellpadding="5" cellspacing="5" width="230">
                <tr>
                    <td>
                        <div class="kab">Избранные прайс-листы</div>
                    </td>
                </tr>                
<?php 

$rowcount = 1;
// To do Буквенный параметр для JS-функции?
while ($row = mysql_fetch_assoc($qry_userfavprices)) { 
        echo "<tr><td><a href='index.php?act=single_price&pricelist_id=".$row["id"].$urladd."'>".$row["comment"]."</a>&nbsp;&nbsp;<a href='#' class='cloud' id='cl_{$row['id']}' title='Удалить'>x</a></td></tr>";
        
    ++$rowcount;
	 
	 // Ограничим вывод любимых прайсов
     if ($rowcount == 8) break;
}
if (mysql_numrows($qry_userfavprices) == 0){
	echo "<tr><td class='smallmessage'>Нет прайс-листов для отображения. Для добавления прайс-листа используйте кнопку &quot;Добавить в избранное&quot;.</td></tr>";
}

if (mysql_numrows($qry_userfavprices) > 7){
	echo "<tr><td>&nbsp;<a href=''>Все прайсы&nbsp;&gt;&gt;<a></td></tr>";
} ?>                       
            </table>
        </td>        
    <td valign="top" class="kab">
        <table border="0" cellpadding="5" cellspacing="5" width="230">
                <tr>
                    <td>
                        <div class="kab">Любимые товары</div>
                    </td>
                </tr>
                <?php 
                // str_name,id,str_code1,num_amount,pricelist_id
                $rowcount = 1;
                while ($row = mysql_fetch_assoc($qry_userfavgoods)) { 
                    if ($row["num_amount"] == 999999999) {
                            echo "<tr><td><a href='index.php?act=single_item&pricelist_id=".$row["pricelist_id"]."&artikul=".$row["str_code1"].$urladd."'>".$row["str_name"]."</a></td></tr>";
                        } else {
                            echo "<tr><td><a href='index.php?act=single_item&pricelist_id=".$row["pricelist_id"]."&artikul=".$row["str_code1"].$urladd."'>".$row["str_name"]."</a>&nbsp;<small>(".$row["num_amount"].")</small></td></tr>";
                        }
                    ++$rowcount;
                    
                    // Ограничим вывод любимых товаров
                    if ($rowcount == 8) break;
                }
                
                if (mysql_numrows($qry_userfavgoods) == 0){
                echo "<tr><td class='smallmessage'>Нет товаров</td></tr>";
                }
                
                if (mysql_numrows($qry_userfavgoods) > 7){
                echo "<tr><td>&nbsp;<a href=''>Все товары&nbsp;&gt;&gt;<a></td></tr>";
                }
            ?>
                    
            </table>
        </td>
    
	<td valign="top"><table border="0" cellpadding="5" cellspacing="5" width="230">
                <tr>
                    <td>
                        <div class="kab">Метки</div>
                    </td>
                </tr>
                <?php 
				if (mysql_numrows($qry_archzakazlist) > 0) mysql_data_seek($qry_archzakazlist,0);
                
				 while ($row = mysql_fetch_assoc($qry_archzakazlist)) { 
				 
					 if ($row["tags"] != '') {
					 
					 	echo "<tr><td><a href='index.php?act=view_archzakaz&id=".$row["id"].$urladd."'>".$row["tags"]."</a>&nbsp;&nbsp;<a href='#' class='cloud' id='mk_{$row['id']}' title='Удалить'>x</a></td></tr>";
					 
					 }
				 
				 }
				?>
            </table>
        </td>	
    </tr>
</table>
</div>
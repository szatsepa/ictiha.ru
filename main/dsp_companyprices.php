<?php 
if ($mobile == 'false') {
    $company_inf = mysql_fetch_assoc($qry_company);
   
    $logos_root =  $document_root . '/images/logos/';
    $picture    =  $logos_root."logo_".$attributes['company_id'].".gif";
   
?>
<div align="center"><br />
<table border="0" cellpadding="15" cellspacing="0">
    <tr>
        <td valign="top"><?php if (file_exists($picture)) { ?><img src="images/logos/logo_<?php echo $attributes['company_id']; ?>.gif" border="0" alt=""><?php } ?></td>
        <td valign="top" width="300"><strong id="t_name" style="font-size:12pt;"><?php echo $company_inf['name'];?></strong><br /><br />
                                                                         
                                                                         <?php
                                                                         if ($authentication == "yes"){
                                                                             ?>
                                                                         <strong>О компании:</strong><br /><br />       
                                                                         <div align="justify"><?php echo $company_inf['full_about'];?></div><br /><br /><br />
                                                                         <?php
                                                                         
                                                                                echo "<strong>Визитка компании:</strong><br /><br />";
                                                                                echo string2html($company_inf['about']);
                                                                         }
                                                                         ?>
                </td>
        <td valign="top" style="border-left:thin dotted gray;"><table border="0" cellpadding="0" cellspacing="0" width="250">
                        <tr>
                            <td><strong style="font-size:12pt;">Актуальные прайс-листы:</strong><br /><br /><br /><br />
                            <?php $rowcount = 1;
                           
                          $price_arr = array();
                        while ($row = mysql_fetch_assoc($qry_companyprices)) {
                    // Пропускаем заблокированные прайсы
                    if ($row["status"] == 0 or $row['actual'] == 0) continue;
                               
                    echo $rowcount.".<a href='index.php?act=single_price&pricelist_id=".$row["id"].$urladd."'>".$row["comment"]."</a>";
                                if ($row["id"] == $row["price_id"]) echo "<img src='images/heart.gif' width='12' height='12' border='0' hspace='3' alt='Любимый прайс'>";
                   if($row['expiration'] != '0000-00-00') echo "&nbsp;&nbsp;Актуален до - {$row['expiration']}";
                                echo "<br /><br />";
                               
                               array_push($price_arr, $row);
                               
                            ++$rowcount;
                        }?>
                            </td>
                        <tr>
                        <!-- tr>
                            <td><small><?php //echo $row[2];?></small><br>
                            <br>
                            </td>
                        </tr -->
                       
                       
                        <?php
                        /*
                        $rowcount = 1;
                        while ($row = mysql_fetch_assoc($qry_companyprices)) {
                                echo "<tr><td>".$rowcount.".<a href='index.php?act=single_price&pricelist_id=".$row["id"].$urladd."'>".$row["comment"]."</a>";
                                if ($row["id"] == $row["price_id"]) echo "<img src='images/heart.gif' width='12' height='12' border='0' hspace='3' alt='Любимый прайс'>";
                                echo "</td></tr>";
                            ++$rowcount;
                        } */
                        ?>
                        <tr>
                                <td><strong style="font-size:12pt;">&nbsp;Актуальные витрины:</strong><br /><br /><br /><br />
                        <?php
                       
                        $rowcount = 1;
                     
                 
    foreach ($store_arr as $key => $value) {
                                         
                        echo (1+$key).".<a href='http://".$value['where_res']."/index.php?stid={$value['storefront_id']}' target='_blank'>".$value['name']."</a>";

                      echo "<br /><br />";
                            ++$rowcount;
                        }
                       ?>
                       
                       </td>
                        </tr>
            </table></td>
</tr></table></div>
<br /><br /><br />

<?php } else {
// Mobile content
$company_inf = mysql_fetch_row($qry_company);
?>
<div class="head"><?php echo $company_inf[1];?><br />Актуальные прайс-листы:</div>
<br />
<?php
    $rowcount = 1;
    while ($row = mysql_fetch_assoc($qry_companyprices)) {
        // Пропускаем заблокированные прайсы
        if ($row["status"] == 0) continue;
        echo $rowcount.".<a href='index.php?act=single_price&pricelist_id=".$row["id"].$urladd."'>".$row["comment"]."</a><br />";
        ++$rowcount;
    }

 } ?>
<script type="text/javascript">
    $(document).ready(function(){
        $("head title").text($("#t_name").text());
        console.log($("#t_name").text());
    });
</script>

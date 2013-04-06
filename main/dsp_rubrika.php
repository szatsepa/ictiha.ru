<?php

if (mysql_num_rows($qry_rubrikaprices) > 0) {
    $rubrika_name =  mysql_result($qry_rubrikaprices,0,"name");
    mysql_data_seek($qry_rubrikaprices, 0);
}
 ?>
<h2><?php echo $rubrika_name; ?></h2>

<table border="0" cellspacing="0" cellpadding="7">
<tr>    
	<td width="200" valign="top" style="border-right:1px dashed #a7a7a7;padding-right:20px;border-bottom:1px dashed #a7a7a7;padding-bottom:10px;padding-left:20px;text-align:justify;">
<?php include "main/dsp_tagscloud.php"; ?>
        </td>

	<td valign="top" style="padding-left:40px;">
            <table border="0" cellspacing="0" cellpadding="10"><?php 
            
			while ($row = mysql_fetch_assoc($qry_rubrikaprices)) { 
					echo "<tr><td>";
					echo "<a href='index.php?act=company_prices&amp;company_id=".$row["company_id"].$urladd."'>";
					dsp_logo($row["company_id"],$row["company_name"],$document_root,128); 
					echo "</a></td><td valign='top'>";
			        echo $rowcount."<a href='index.php?act=single_price&amp;pricelist_id=".$row["id"].$urladd."'>".$row["comment"]."</a>";
			        echo "</td></tr>";
			}

?>
            </table>
        </td>
</tr>
</table>
<!--</div>-->
<br />
<br />

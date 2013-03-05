<?php 
while ($row = mysql_fetch_assoc($qry_prices)) { 

	$price_id   	= $row["id"];
    $rubrika_id 	= $row["rubrika"];
    $comment    	= $row["comment"];
	$tags       	= $row["tags"];
	$company_name	= $row["name"];
	$creation		= $row["creation"];
	$zakaz_limit	= $row["zakaz_limit"];
        $expiration     = $row['expiration'];
	
	if (isset($attributes[price_id]) and intval($attributes[price_id]) > 0) {
	
		if ($price_id != $attributes[price_id]) continue;
	
	}
	
?>

<br />

<div align="center">
    <form action="index.php?act=price_delete&price_id=<?php echo $price_id; ?>" method="post" name="price_delete" id="price_delete">
        <table class="dat" border="0" width="950" >
            <tr>
                <td colspan="6">&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="Удалить прайс" style="font-weight:bold;color:red;">
                </td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>Компания: <strong><?php echo $company_name;?></strong></td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>Дата последней загрузки: </td>
                <td>
                    <?php 
                    if ($creation == '') {
                        echo "<div style='color:red;font-weight:bold;'>загрузите прайс-лист</div>";
                    } else {
                        echo $creation;
                    }
                ?>
                </td>
            </tr>
            <tr>
                    <td colspan="6">&nbsp;</td>
            </tr>
        </table>
    </form>
<br />
<br />
<form enctype="multipart/form-data" action="index.php?act=upload_price" method="post" name="price_upload" id="price_upload">
    <table class="dat" border="0" width="950" >
        <tr>
            <td colspan="4">&nbsp;</td>
        </tr>
        <tr>

            <td>
                <input type="hidden" name="MAX_FILE_SIZE" value="1048575">
                <input type="hidden" name="price_id" value="<?php echo $price_id; ?>">
                <input name="userfile" type="file" size="62"/>
            </td>
            <td>
                <input type="checkbox" name="limit" value="1" id="limit"><label for="limit">Безлимитный</label>
            </td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>
                <input type="submit" value="Загрузить прайс">
            </td>
        </tr>
        <tr>
            <td colspan="4">&nbsp;</td>
        </tr>
    </table>
</form>
<br />
<br />
<form action="index.php?act=price_info_update&price_id=<?php echo $price_id; ?>" method="post" name="price_info_update" id="price_info_update">
    <table class="dat" border="0" width="950" >
        <thead></thead>
        <tbody>
            <tr>
                    <td colspan="2">&nbsp;</td>
            </tr>

            <tr>
<!--                    <form action="index.php?act=price_delete&price_id=<?php echo $price_id; ?>" method="post" name="price_delete" id="price_delete">-->
                    <td>Описание:</td>
                    <td><input type="text" name="comment" maxlength="255" size="92" value="<?php echo  str_replace ('"','&quot;',$comment); ?>"></td>
            </tr>
            <tr>
                    <td>Теги:</td>
                    <td><input type="text" name="tags" maxlength="255" size="92" value="<?php echo $tags; ?>"></td>
            </tr>
            <tr>
                    <td>Рубрика:</td>
                    <td><br /><?php include("dsp_selectrubrika.php"); ?></td>
            </tr>
            <tr>
                    <td>Минимальный заказ:</td>
                    <td><input type="text" name="zakaz_limit" maxlength="5" size="15" value="<?php echo $zakaz_limit; ?>"></td>
            </tr>
            <tr>
                    <td>Срок годности:</td>
                    <td><input type="text" name="expiration" maxlength="12" size="15" value="<?php echo $expiration; ?>"></td>
            </tr>
            <tr>
                    <td colspan="2"><div align="center"><input type="submit" value="Сохранить изменения"></a></td>
            </tr>   


            <tr>
                    <td colspan="2">&nbsp;</td>
            </tr>
        </tbody>
    </table>
</form>
</div>

<?php } ?>
                        <script type="text/javascript">
                            $(document).ready(function(){
                                $("#s_rubrika").css('font-size', '1.2em');
                            });
                        </script>
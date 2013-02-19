<?php if ($mobile == 'false') { ?>
<div id="primaryContentContainer">
	<div id="primaryContent">
		<div class="box" style="margin-top: -1em;">

			<table border="0" cellpadding="0" cellspacing="0" id="nostyle_table">
			<tr><?php //include("dsp_advert.php"); ?>
<!--			 <td width="50" align="center" valign="top"><div align="center" style="margin-top:5px;" class="alphabet"><a href="index.php?act=complist<?php echo $urladd; ?>">все</a></div>
			<div style="margin-top:12px;"><?php include("dsp_alphabet.php"); ?></div>
			 </td>-->
			<td valign="top"><table border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td>
                                    
                                    <table border="0" cellpadding="2" cellsapcing="1">
                                        <tr>
                                                <td valign="top" class="rubrik_link"><a href="index.php?act=rubrika&amp;id=1">Алкоголь и напитки</a></td>
                                                <td valign="top" class="rubrik_link"><a href="index.php?act=rubrika&amp;id=2">Фрукты и овощи</a></td>
                                                <td valign="top" class="rubrik_link"><a href="index.php?act=rubrika&amp;id=3">Бакалея</a>&nbsp;&nbsp;</td>
                                                <td valign="top" class="rubrik_link"><a href="index.php?act=rubrika&amp;id=4">Молочная продукция</a></td>
                                                <td valign="top" class="rubrik_link"><a href="index.php?act=rubrika&amp;id=5">Мясо и рыба</a></td>
                                                <td valign="top" class="rubrik_link"><a href="index.php?act=rubrika&amp;id=6">Хлеб и кондитерские изделия</a></td>
                                                <td valign="top" class="rubrik_link"><a href="index.php?act=rubrika&amp;id=7">Посуда оборудование инвентарь</a></td>
                                                <td valign="top" class="rubrik_link"><a href="index.php?act=rubrika&amp;id=8">Одежда и мебель</a></td>
                                                <td valign="top" class="rubrik_link"><a href="index.php?act=rubrika&amp;id=9">Бытовая химия</a></td>
        <!--                                        <td valign="top"><a href="http://www.ru2b.ru" class="help" target="_blank">?</a></td>-->
                                        </tr>
                                    </table>
                                </td>
			</tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td>
                                <fieldset>
                                <?php
                                    $companies = new Companies();

                                    echo $companies->_getBlock();
                                ?>
                                </fieldset>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>
			<tr>
				<!-- td colspan=2 align="center"><strong>Компании:</strong></td -->
                            <td>
                                <fieldset>
                                <?php
                                $prices = new Prices(); 
                                echo $prices->_getBlock();
                            ?>
                                </fieldset>
                            </td>
			</tr>

			</table>
			</td>

			
			</tr>
			</table>
		</div>
	</div>
</div>
<?php } ?>

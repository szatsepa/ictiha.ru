<?php if ($mobile == 'false') { ?>
<div id="primaryContentContainer">
    <div id="primaryContent">
        <div class="box" style="margin-top: -1em;">
            <table border="0" cellpadding="0" cellspacing="0" id="nostyle_table">
                <tr>
			<td valign="top">
                            <table border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td>
                                    <?php
                                    $rubrikator = new Chapters();
                                    
                                    echo $rubrikator->_getBlock();
                                    
                                    ?>
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
			</tr>
                <tr>
                    <td>
                        <fieldset>
                        <?php
                            echo $prices->_getAlphabet();
                        ?>
                        </fieldset>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<?php } ?>
<script type="text/javascript">
    $(document).ready(function(){
        
        $("td.rubrik_link").css({'font-size':'1.0em'});
    });
</script>
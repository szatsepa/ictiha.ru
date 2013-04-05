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
                                    
                                    echo $rubrikator->_getBlockChapters();
                                    
                                    ?>
                                </td>
			</tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td>
                                <?php
                                    $companies = new Companies();

                                    echo $companies->_getBlockCompanies();
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>
			<tr>
                            <td>
                                
                                <?php
                                $prices = new Prices(); 
                                echo $prices->_getBlockArticles();
                            ?>
                                
                            </td>
			</tr>

			</table>
                        </td>
                    </tr>
                <tr>
                    <td>
                        
                        <?php
                            echo $prices->_getAlphabet();
                        ?>
                        
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
//        $("table tbody tr td").css({'border':'1px solid red'});
        $("td.rubrik_link").css({'font-size':'1.0em'});
    });
</script>
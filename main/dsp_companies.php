<?php if ($mobile == 'false') { ?>
<div class="content">
<?php if ( $authentication == "yes") { ?>
    
<!--                <div id="all">
                     <a href="index.php?act=complist<?php echo $urladd; ?>">все</a> 
                 </div>-->
<!--    <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr><?php //include("dsp_advert.php"); ?>
             <td align="center" valign="top">
                 
                 <div style="margin-top:12px;">
                     
                 </div>
             </td>
             <td valign="top">
                 <table border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td>
                        </td>
                   </tr>
                    <tr>
                        <td>
                        </td>
                    </tr>
                </table>
            </td>
            <td valign="top">               
            </td>
        </tr>
    </table>-->
<?php } ?>
</div>
<?php } else { 
   
     if ( $authentication == "yes") {
	 	echo "<div class='head'>Компании:</div>";	
		echo "<div class='otstup'>";
		while ($row = mysql_fetch_assoc($qry_actualcompanies)) { 
	 		echo "<a  href='index.php?act=company_prices&amp;company_id=".$row["id"].$urladd."'>".$row["name"]."</a>";
        	echo "<div class='about'>".string2html($row["about"])."</div>"; 
     	}
	 	echo "</div>";	
	 }
} 

?>

<script language="JavaScript" type="text/javascript">
    $(document).ready(function(){
        
//        $("div.content, div#all").css({'position':'relative'});
//        $("div").css('outline', '1px solid grey');
        
        function showAbout(){
		window.open ('index.php?act=about', 'newWin', 'scrollbars=yes,status=no,location=no,menubar=no,width=600,height=300')
        return false;
	}	
    });
	
</script>
<script type="text/javascript">
    $(document).ready(function(){
        
        var dt = new Date();
        
        var month_array = new Array('01','02','03','04','05','06','07','08','09','10','11','12');
        
        firstSelect();
        
               function buildSelect(ydt,deys){
           
           var yy = dt.getFullYear();
           var syy = ydt.getFullYear();
                      
           for(var i = yy;i<(yy+3);i++){
               if(syy == i){
                   $("#year").append("<option value='"+i+"' selected>"+i+"</option>");
               }else{
                   $("#year").append("<option value='"+i+"'>"+i+"</option>");
               }
           }
           buildMonthSelect(ydt,deys);
       }
       
       function buildMonthSelect(dt,deys){
           
           var mm = dt.getMonth();
           
          for(var i=0;i<12;i++){ 
               if(mm == i){
                   $("#month").append("<option value='"+month_array[i]+"' selected>"+month_array[i]+"</option>");
               }else{
                   $("#month").append("<option value='"+month_array[i]+"'>"+month_array[i]+"</option>");
               }
           }
           buildDeySellect(dt,deys);
       }
       function buildDeySellect(dt, deys){
          
           var dd = dt.getDate();
           var hh = dt.getHours();
           var minits = dt.getMinutes();
           for(var i=0;i<(31);i++){
               var n = i+1;
               if(n<10){n = "0"+n;}
               if(dd == (i+1)){
                   $("#dey").append("<option value='"+n+"' selected>"+n+"</option>");
               }else{
                   $("#dey").append("<option value='"+n+"'>"+n+"</option>");
               }
           }
           for(i=0;i<24;i++){
               var n = i;
               if(n<10){n = "0"+n;}
               if(hh == i){
                   $("#hh").append("<option value='"+n+"' selected>"+n+"</option>");
               }else{
                   $("#hh").append("<option value='"+n+"'>"+n+"</option>");
               }
           }
           for(i=0;i<60;i+=5){ 
               var n = i;
               if(n<10){n = "0"+n;} 
               if(minits > (i-4) && minits < (i+4)){ 
                   $("#mm").append("<option value='"+n+"' selected>"+n+"</option>");
               }else{
                   $("#mm").append("<option value='"+n+"'>"+n+"</option>");
               }
           }
       }
       function firstSelect(){
           var now = new Date();
           var YY = now.getFullYear();
           var MM = now.getMonth();
           var dayofmonth = 32 - new Date(YY, MM, 32).getDate();
           clearSelect(now,dayofmonth);
       }
       function clearSelect(mdt,mn){ 
           $("#year, #month, #dey").empty();
           buildSelect(mdt,mn);
       }
    });
</script>
<table class='cart'>
    <tr>
        <td class='cart' style="font-size: 18px; font-weight: bold">
<?php

/*
 * created by arcady.1254@gmail.com
 */
if ($title != '') echo "<br/><h2>".$title."</h2><br/>";

?>
                  </td>
    </tr>
</table>
<!--<br/>&nbsp;-->
<!--width="100"-->
<table class="btp" border="0" >
     
    <tbody>
        <tr>
            <td class="btp">
                <form action="index.php?act=look" method="post">
                    <input type="hidden" name="cod" value="<?php echo $attributes[cod];?>"/>
                    <input type="hidden" name="select" value="prices"/>
                    <input type="hidden" name="stid" value="<?php echo $attributes[stid];?>"/>
                    <input type="hidden" name="group" value="<?php echo $price_id; ?>"/>
                    <input type="submit" onmouseover="this.style.color='#CCCCCC'" onmouseout="this.style.color='#FFFFFF'" value="Прайс заказа<?php echo $message; ?>" class="submit2"/>
                </form>
            </td>
            <td class="btp">
                <form action="index.php?act=del_order" method="post">
                    <input type="hidden" name="stid" value="<?php echo $attributes[stid]; ?>"/>
                    <input type="hidden" name="price_id" value="<?php echo $price_id; ?>"/> 
                    <input type='Submit' onmouseover="this.style.color='#CCCCCC'" onmouseout="this.style.color='#FFFFFF'" value='Удалить заказ<?php echo $message; ?>'  class="submit2" />
                </form>
            </td>
        </tr>
    </tbody>
</table>
<br />

<?php 

$price = $price_id;

include 'dsp_cart.php';

$contragent_name = $_SESSION[user]->data[name]." ".$_SESSION[user]->data[surname];
?>

<br />
<div class = "cont_reg">
            
<form action="index.php?act=create_order" method="post" name="addform" enctype="multipart/form-data"> 
    <input type="hidden" name="stid" value="<?php echo $attributes[stid];?>"/>
    <input type="hidden" name="price_id" value="<?php echo $price; ?>"/>
    <input type="hidden" name="contragent_id" value="<?php echo $_SESSION[user]->data[id];?>"/> 
    <div id = "cont_reg_left">
                    <br/>
                    <br/>
                    <br/>

                    <div id = "cont_reg_left_3">E-mail: </div>
                    <div id = "cont_reg_left_4"><input type="text" required id="eml"  onblur="return isEmailCorrect()" name="e_mail" size="30" value="<?php echo $_SESSION[user]->data[email];?>"/></div>
                    <div id = "cont_reg_left_3">Адрес доставки: </div>
                    <div id = "cont_reg_left_66"><textarea rows="3" cols="29" name="adress"><?php echo $_SESSION[user]->data[shipping_address];?></textarea></div>
                    <div id = "cont_reg_left_3">Пожелания заказчика: </div>
                    <div id = "cont_reg_left_66"><textarea rows="3" cols="29" name="desire"></textarea></div>
                    <div id = "cont_reg_left_3">Метка: </div>
                    <div id = "cont_reg_left_4"><input type="text" name="mark" size="30"/></div>
                    <div id = "cont_reg_left_3">Отсрочить до: </div>
                    <div id = "cont_reg_left_4">
            
                            <select class="date_select" id="dey" name="day"></select>
                            -
                            <select class="date_select" id="month" name="mon"></select>
                            -
                            <select class="date_select" id="year" name="year"></select>

                            &nbsp;дд-мм-гггг&nbsp;&nbsp;
                            <select class="date_select" id="hh" name="hh"></select>
                            -
                            <select class="date_select" id="mm" name="mm"></select>
                            &nbsp;чч-мм
                            <br /> 
        
                    </div>
    
    </div>
    <div id = "cont_reg_right" >
        <div id = "cont_reg_order_btn">
                        
                        <input type="submit"  onmouseover="this.style.color='#CCCCCC'" onmouseout="this.style.color='#FFFFFF'" value="Отправить заказ"   class="submit2"/>
                        </div>
        
    </div>
  </form>  
</div>
<script language="JavaScript" type="text/javascript">
	document.write('<input type="hidden" name=scr_width  value="' + screen.width  +'">');
	document.write('<input type="hidden" name=scr_height value="' + screen.height +'">');
</script>

</form>
<br>

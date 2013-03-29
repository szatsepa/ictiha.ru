<script type="text/javascript">
    $(document).ready(function(){
        
        $("#msg").focus();
        
         $.ajax({
             url:'main/qry_suppliers.php',
             type:'post',
             dataType:'text',
             success:function(data){
                 
                 $("#select_supplier").append(data).css('font-size', '12pt');
             },
             error:function(data){
                 console.log(data['responseText']);
             }
         });
         
        $("#send_msg").click(function(){
            if($("#select_supplier option:selected").val()==0){
               alert("Поставщик не выбран");
               return false;
            }
            if($("#msg").val().length>0){
                    $("#send_form").submit();
                }else{
                    alert("Поле сообщеня не заполнено.");
                }
        });
    });
</script>
<br />
<div align="center">
    <form action="index.php?act=sendmail" method="post" name="addform" id="send_form" enctype="multipart/form-data">
        <span id="sp_msg">
            <p>
                <textarea  cols="148" rows="12" wrap="soft"  id="msg" name="comments"></textarea>
            </p>
            <p>
                <select class='common' name='supplier' id='select_supplier'>
                    <option value='0'>Выберите поставщика</option>
                </select>
                &nbsp;&nbsp;&nbsp;
                <input type="button" id="send_msg" value="Отправить письмо оператору" >
            </p>
            <input type="hidden" id="uid" value="<?php echo $user['id'];?>">
        </span>
    </form>    
</div>
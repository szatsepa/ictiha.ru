<script type="text/javascript">
    $(document).ready(function(){
        
        $("#msg").focus();
        
         $.ajax({
             url:'main/qry_suppliers.php',
             type:'post',
             dataType:'text',
             success:function(data){
//                 console.log(data);
                 $("#select_supplier").append(data).css('font-size', '12pt');
//                 $("#select_supplier");
             },
             error:function(data){
                 document.write(data['responseText']);
             }
         });
         
        $("#send_msg").click(function(){
            var str_form = '<form action="index.php?act=sendmail" method="post" name="addform" id="send_form" enctype="multipart/form-data">';
            str_form += '<input type="hidden" name="comments" value="'+$("#msg").val()+'">';
            str_form += '<input type="hidden" name="supplier" value="'+$("#select_supplier option:selected").val()+'">';
            str_form += '</form>'
            document.write(str_form);
            $("#send_form").submit();
        });
    });
</script>
<br />
<div align="center">
        <div>
        <textarea cols="122" rows="12" wrap="soft" id="msg" name="comments">
            <?php echo $msg;?>
        </textarea>
        </div>
        <div>
        <br>
        <p id="btn_p">
            <select class='common' name='supplier' id='select_supplier'>
                <option value='0'>Выберите поставщика</option>
            </select>
            &nbsp;&nbsp;&nbsp;
            <input type="button" id="send_msg" value="Отправить письмо оператору" ></p>
        
        <div>
    
</div>
<br />
<br />

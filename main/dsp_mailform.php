<script type="text/javascript">
    $(document).ready(function(){
        $("#msg").focus();
    });
</script>
<br />
<div align="center">
    <form action="index.php?act=sendmail<?php echo $urladd; ?>" method="post" name="addform" enctype="multipart/form-data">
        <textarea cols="122" rows="12" wrap="soft" id="msg" name="comments"><?php echo $msg;?></textarea>
        <br>
        <input type="Submit" value="Отправить письмо оператору" >
    </form>
</div>
<br />
<br />

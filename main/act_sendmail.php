<?php
if($user['role']!=2){
    
        $msg = $attributes['comments'];
        
        echo "$msg<br>";
        
        $query = "INSERT INTO `private_messages` (`sender`,`recipient`,`message`) VALUES ({$_SESSION['id']}, {$attributes['supplier']}, '$msg')";

        mysql_query($query);
        
}
if(mysql_affected_rows()>0 and $user['role'] != 2){
    ?>
<script type="text/javascript">
    alert("Ваше сообщение отправлено оператору.");
</script>

<?php
}else{
    ?>
<script type="text/javascript">
    alert("К сожалению адресата не удалось определить. Сообщение не отправлено!");
</script>
<?php
}
?>
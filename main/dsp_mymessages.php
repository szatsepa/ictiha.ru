<script type="text/javascript">
    $(document).ready(function(){
        
        $("#msg_table").css({'margin-top':'57px'});
        
        $("#msg_tab").css({'width':'100%','border':'none'});
        
        var msg_id;
        
        if($("#_act").val()=='msg') {
            console.log($("#btn_msg").attr('id'));
            $("#btn_msg").attr('id', 'btn_archmsg');
            $("#btn_archmsg").text("Архив сообщений");
        }
        
        $("input.button").css({'cursor':'pointer'}).click(function(event){
            
            $("#user_msg").css('display', 'block');
            
            $("#sender").empty();
            
            msg_id = $($(this).parent().parent()).attr('id').substr(1);
            
            var uid = $($(this).parent().parent()).children('td.dat:eq(0)').attr('id');
            
            var out = {'msg':$($(this).parent().parent()).attr('id').substr(1),'uid':uid};
            
            var sender = $($(this).parent().parent()).children('td.dat:eq(1)').text();
            
            $("#sender").append("<strong><p>"+sender+"</p></strong>");

            $("#sender p").attr('id', uid);
            
            $("#out_msg").attr('placeholder', $($(this).parent().parent()).children('td.dat:eq(2)').text()).focus();

            
            
//        console.log("sender - "+sender+" recipient - "+$($(this).parent().parent()).children('td.dat:eq(1)').text()+" message "+$($(this).parent().parent()).children('td.dat:eq(2)').text());
//        console.log($("#sender").text());

        });
        $("table.dat th").addClass('dat');
        $("table.dat th:eq(0)").css('width','5%');
        $("table.dat th:eq(1)").css('width', '30%');
        $("table.dat th:eq(2)").css('width', '60%');
        $("table.dat th:eq(3)").css('width', '5%');
        $("table.dat td").addClass('dat');
        $("div.horizontal_scroller").css('display', 'none');
        
        $("#submit").click(function(){
            markMessage();
        });
        
        $("#out_msg").keypress(function(event){
            if(event.which == 13){
                markMessage();
            }
        });
         
         function markMessage(){
             
              var out = {'sender':$("#uid").val(),'out_msg':$("#out_msg").val(),'recipient':$("#user_msg span p").attr('id'),'in_msg':$("#out_msg").attr('placeholder'),'msg_id':msg_id};

            $.ajax({
                
                url:'main/act_mark_message.php',
                type:'post',
                dataType:'json',
                data:out,
                success:function(data){
                   if(data['ok']==1){
                       
                        $("#user_msg").css('display', 'none');
             
                        $("#out_msg").val('');
                        
                        $("#"+data['row']).remove();
                   } 
                },
                error:function(data){
                    console.log(data['responseText']);
                }

            });
            return false;
         }
    });
</script>
<div id="msg_table">
    <input type="hidden" id="_act" value="<?php echo $attributes['act'];?>">
    <table class='dat' id="msg_tab">
        <thead>
            <tr>
                <th>
                    
                </th>
                <th>
                  Автор  
                </th>
                <th>
                  Сообщение  
                </th>
                <th>
                    
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            $num = 1;
            if($messages){
                foreach ($messages as $value) {
                    echo "<tr id='r{$value['id']}'>";
                    echo "<td id='{$value['uid']}'>$num</td><td>{$value['sender']}</td><td>{$value['message']}</td><td><input type='button' value='&gt;&gt;' class='button' title='Ответить'></td>";
                    echo "</tr>";
                    $num++;
                }
            }
            
            ?>
        </tbody>
    </table>
</div>
<div id="user_msg" style="display: none">
<span id="sender"></span>
        <p><textarea  cols="97" rows="6" wrap="soft"  id="out_msg"></textarea></p>
        <p><input id="submit" type="button" value="Отправить"></p>
        <input type="hidden" id="uid" value="<?php echo $user['id'];?>">
    
    
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $("#msg_table").css({'margin-top':'57px'});
        $("#msg_tab").css({'width':'100%','border':'none'})
        $("input.button").css({'cursor':'pointer'}).click(function(){
            var id = $(this).parent().parent().attr('id');
            var out = {'msg':$(this).parent().parent().attr('id').substr(1)};
            
                     $.ajax({
                         url:'main/act_mark_message.php',
                         type:'post',
                         dataType:'json',
                         data:out,
                         success:function(data){
                             if(data['ok']==1){
                                 $("#"+id).remove();
                             }
                         },
                         error:function(data){
                             console.log(data['responseText']);
                         }
                     });
        });
        $("table.dat th").addClass('dat');
        $("table.dat th:eq(0)").css('width','5%');
        $("table.dat th:eq(1)").css('width', '30%');
        $("table.dat th:eq(2)").css('width', '60%');
        $("table.dat th:eq(3)").css('width', '5%');
        $("table.dat td").addClass('dat');
        $("div.horizontal_scroller").css('display', 'none');
    });
</script>
<div id="msg_table">
    <table class='dat'id="msg_tab">
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
            foreach ($messages as $value) {
             echo "<tr id='r{$value['id']}'>";
             echo "<td>$num</td><td>{$value['sender']}</td><td>{$value['message']}</td><td><input type='button' value='&gt;&gt;' class='button'></td>";
             echo "</tr>";
             $num++;
            }
            ?>
        </tbody>
</div>
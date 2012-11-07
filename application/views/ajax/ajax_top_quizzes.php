<?php if(empty($top_quiz)):?> 
  <br/><br/><div id="error_clientsTop" class="message error closeable">
                    <span class="message-close"></span>
                    <h3>Error!</h3>
                    <p><?php echo $lang_quiz['top_quiz']['error'];?></p>                        
  </div>
<?php else:?>
  <style>
    .dataTables_info{width: 40%!important;}
    .dataTables_length{width: 45%!important; }
</style>
<table id="clientsTop" class="display">
            <thead>
                    <th><?php echo $lang_quiz['top_quiz']['th8'];?></th>
                    <th><?php echo $lang_quiz['top_quiz']['th1'];?></th>
                    <th><?php echo $lang_quiz['top_quiz']['th2'];?></th>
                    <th><?php echo $lang_quiz['top_quiz']['th3'];?></th>
                    <th><?php echo $lang_quiz['top_quiz']['th4'];?></th>
                    <th><?php echo $lang_quiz['top_quiz']['th5'];?></th>
                    <th><?php echo $lang_quiz['top_quiz']['th6'];?></th>
                    <th><?php echo $lang_quiz['top_quiz']['th7'];?></th>
            </thead>
            <tbody>
            <?php $i=1; foreach($top_quiz as $message): ?>
                    <tr>
                        <td align="center"><?php echo $i; ?></td>
                        <td align="center"><?php echo $message['member_email']; ?></td> 
                        <td align="center"><?php echo $message['group_name']; ?></td>
                        <td align="center"><?php echo $message['quiz_name']; ?></td>
                        <td align="center"><?php echo $message['quiz_questions']; ?></td>
                        <td align="center" ><?php echo $message['score']?> %</td>
                        <td align="center"><?php echo $message['completed_time']?> %</td>
                        <td align="center"><?php echo $message['data'] ?></td>
                    </tr>
            <?php $i++;endforeach; ?>
            </tbody>
        </table>


<?php endif;?>
<script type="text/javascript">
$(function(){
 
  
   var lang = '<?php echo $this->session->userdata('language')?>';
         if(lang =='ro'){
           $('#clientsTop').dataTable( {
                "sPaginationType": "full_numbers",
                 "oLanguage":{
                    "sProcessing":   "Proceseaza...",
                    "sLengthMenu":   "Afiseaza _MENU_ inregistrari",
                    "sZeroRecords":  "Nu am gasit nimic - ne pare rau",
                    "sInfo":         "Afisate de la _START_ la _END_ din _TOTAL_ inregistrari",
                    "sInfoEmpty":    "Afisate de la 0 la 0 din 0 inregistrari",
                    "sInfoFiltered": "(filtrate dintr-un total de _MAX_ inregistrari)",
                    "sInfoPostFix":  "",
                    "sSearch":       "Cauta:",
                    "sUrl":          "",
                            "oPaginate": {
                                "sFirst":    "Prima",
                                "sPrevious": "Precedenta",
                                "sNext":     "Urmatoarea",
                                "sLast":     "Ultima"
                            }
                    }
            });
         }else{
              $('#clientsTop').dataTable( {
                    "sPaginationType": "full_numbers"
                });
         }

   $("select[name=clientsTop_length]").uniform();
   
});

</script>
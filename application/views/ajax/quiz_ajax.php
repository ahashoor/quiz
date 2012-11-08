    <table id="client_quizes" class="display">
            <thead>
                    <th><?php echo $lang_quiz['your_quizzes']['table']['th1']; ?></th>
                    <th><?php echo $lang_quiz['your_quizzes']['table']['th2']; ?></th>
                    <th><?php echo $lang_quiz['your_quizzes']['table']['th3']; ?></th>
                    <th><?php echo $lang_quiz['your_quizzes']['table']['th4']; ?></th>
                    <th><?php echo $lang_quiz['your_quizzes']['table']['th5']; ?></th>
                    <th class="action_hide"><?php echo $lang_quiz['your_quizzes']['table']['th6']; ?></th>
            </thead>
            <tbody>
            <?php foreach($quizes as $quiz): ?>
                    <tr>
                        <td align="center"><?php echo ucfirst($quiz['quiz_name']); ?></td>
                        <td align="center"><?php echo ucfirst($quiz['category']); ?></td>
                        <td align="center"><?php if( floor($quiz['complete_time'] / 60) > 0){echo floor($quiz['complete_time'] / 60)."h : ";}
                        echo floor($quiz['complete_time'] % 60)."min";?></td>
                        <td align="center"><?php echo $quiz['questions']?></td>
                        <td align="center"><?php echo $quiz['added_on']; ?></td>
                        <td align="center">
                            <a class="client_quizes tooltip_new" href="main/client_quiz/view/<?php echo $quiz['id'] ?>" ><span><?php echo $lang_quiz['your_quizzes']['table']['tip_view']; ?></span> <img alt="quiz"src="template/images/navicons-small/12.png"/></a> 
                            <a class="tooltip_new" href="#main/client_quiz/edit/<?php echo $quiz['id'] ?>"><span><?php echo $lang_quiz['your_quizzes']['table']['tip_edit']; ?></span><img  alt="quiz"src="template/images/navicons-small/165.png"/></a> 
                            <a class="delete_quiz tooltip_new" href="main/client_quiz/delete/<?php echo $quiz['assoc_id']; ?>"><span><?php echo $lang_quiz['your_quizzes']['table']['tip_del']; ?></span><img  alt="quiz"src="template/images/navicons-small/delete.png"/></a> 
                        </td>
                    </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

<?php if(isset($error)):?>
    <script> $("error_quiz").show().find('p').html(<?php echo $del_error; ?>);</script>
<?php endif; if(isset($success)):?> 
    <script>$("#success_quiz").notify("create","success-container",{title: 'Succes', text:<?php echo $success ;?>, icon:'template/images/navicons/92.png'});</script>
<?php endif;?>
<script type="text/javascript">
$(function(){
    if('<?php echo $this->session->userdata('language')?>' =='en'){
         $('#client_quizes').dataTable( {
                "sPaginationType": "full_numbers"
         });
    }else{
         $('#client_quizes').dataTable( {
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
    }
    $("select").uniform();
});
</script>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<h1 class="page-title"><?php echo $lang_page_title['manage_your_quiz']['h1'];?> </h1>
<div class="container_12 clearfix" ><br />
    
    <?php if(isset($error)){?>
        <div id="error_client_quizes1" class="message error closeable">
                    <span class="message-close"></span>
                    <p><?php echo $error;?></p>                        
        </div>
    <?php }else{?>
   
        <div id="error_quiz" class="message error closeable" style="display: none;">
                    <span class="message-close"></span>
                    <h3>Error!</h3>
                    <p>Client was not deleted successfully</p>                        
        </div>
 
        <div id="success_quiz" style="display: none;">
             <div id="success-container">
                <a class="ui-notify-close ui-notify-cross" href="#">x</a>
                <div class="with-icon"><img src="#{icon}" alt="success"/></div>
                <h1>#{title}</h1>
                <p>#{text}</p>
             </div>
        </div>
    
    <div id="ajax_quiz">
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
      
    </div>
    <?php }?>
</div>
<script type="text/javascript">
$(function(){    
    $("#error_quiz").hide();   $("#success_quiz").notify();

    $(document).on("click",'a.client_quizes',function(eve){
            eve.preventDefault();
            eve.stopImmediatePropagation();
            $.colorbox({href:$(this).attr('href')});
            $.colorbox.resize({height:"85%", width:"65%"});
    });

    pageLang =$.parseJSON('<?php echo json_encode($lang_quiz['your_quizzes']);?>');
    
    $(document).on("click", "a.delete_quiz", function(eve){
        eve.preventDefault();
        eve.stopImmediatePropagation();
        var link = $(this).attr('href'),delete_button = {};
            $('#delete-confirm').find('p#err b').html(pageLang.table.delete_text);
                delete_button[pageLang.table.button2]=function() {$(this).dialog('close');}
                
                delete_button[pageLang.table.button1]=function() {
                $(this).dialog('close');
                    $.ajax({type: "POST",url: link,dataType:'json',
                        success: function(data) {
                            if(data.status == 'succes'){
                                $("#ajax_quiz").html("<div id='loading-container' style='margin-top:20%;'><p id='loading-content'><img id='loading-graphic' width='16' height='16' src='template/images/ajax-loader-abc4ff.gif' /> Loading...</p></div>");
                                $("#ajax_quiz").load('main/client_quiz/delete/reload');
                                $("#success_quiz").notify("create","success-container", {title: 'Succes', text: data.msg ,icon:'template/images/navicons/92.png'});
                            }else{
                                $("#error_members").show().find('p').html(data.msg);
                            }	
                        }
                    });
            };

        $('#delete-confirm').dialog({
                    title:pageLang.table.title,
                    buttons: delete_button
        });
        $("#delete-confirm").dialog("open");
    });
    
    
  //change language system
    var sess_lang_update='<?php echo $this->session->userdata('lang_update')?>';
   
     var  page_title = '<?php echo $lang_page_title['manage_your_quiz']['h1'];?>',
                menu = $.parseJSON('<?php echo json_encode($lang_menu);?>'),
                lang = '<?php echo $this->session->userdata('language')?>';
    $.each(menu,function(key,val){
        $("span."+key).text(val);
    });
   
    if('<?php echo $this->session->userdata('language')?>' =='en'){
        $("a.flag_after img").attr('src','template/images/ro.png');
        $("a.flag_after").attr('href','main/change_lang/ro');
         $('#client_quizes').dataTable( {
                "sPaginationType": "full_numbers"
         });
    }else{
         $("a.flag_after img").attr('src','template/images/en.png');
         $("a.flag_after").attr('href','main/change_lang/en');
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
    $("div.user-info").text(menu.welcome+' <?php echo strtoupper($this->session->userdata('loged_user')->full_name);?>');
    $("a.logout").text(menu.logout);
    $("h1.grid_12").text(page_title);
    $("button.back").text(menu.back);
    $("u.copyright").text(menu.copyright);
    $("u.created").text(menu.created);
     if(sess_lang_update ==="updated"){
         $("select, :checkbox").uniform();
        $("#wrapper > section > section > section > div").css({'position':'relative','width':'96%'})
    }
 //
});
</script>


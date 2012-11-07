<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<h1 class="page-title"><?php echo $lang_page_title['top_quiz']['h1'];?></h1>
<div class="container_12 clearfix" ><br />
        <div class="message info closeable">
                <span class="message-close"></span>
                <h3><?php echo $lang_quiz['top_quiz']['h3'];?></h3>
        </div>
        <form id="select_quiz" accept-charset="utf-8">
                        <div style=" float: left; margin-bottom: 10px;">
                                <select id="quizing" name="quiz">
                                    <option value="not_set"><?php echo $lang_quiz['top_quiz']['select'];?></option>
                                    <?php foreach($quizzes as $quiz):?>
                                    <option value="<?php echo $quiz['id']?>"> <?php echo $quiz['quiz_name'];?></option>
                                    <?php endforeach;?>
                                </select>
                        </div>
        </form>
        <div id="ajax_clientsTop"></div>
</div>
<script type="text/javascript">
$(function(){    
   
      $(document).on("change", "#quizing", function(eve){
           eve.stopImmediatePropagation();
            var selectedVal = $("#quizing option:selected").val();
            $("#ajax_clientsTop").load('main/client_quiz/top_quizzes/change/'+selectedVal)
    });
//      $(".dataTables_info,.dataTables_length").css("width","40%!important");
//change language system
    var sess_lang_update='<?php echo $this->session->userdata('lang_update')?>';
    if(sess_lang_update ==="updated"){
        $("select, :checkbox").uniform();
        $("#wrapper > section > section > section > div").css({'position':'relative','width':'97%'})
    }
     var  page_title = '<?php echo $lang_page_title['top_quiz']['h1'];?>',
                menu = $.parseJSON('<?php echo json_encode($lang_menu);?>'),
                lang = '<?php echo $this->session->userdata('language')?>';
              
    $.each(menu,function(key,val){
        $("span."+key).text(val);
    });
    if(lang =='en'){
        $("a.flag_after img").attr('src','template/images/ro.png');
        $("a.flag_after").attr('href','main/change_lang/ro');
    }else{
         $("a.flag_after img").attr('src','template/images/en.png');
         $("a.flag_after").attr('href','main/change_lang/en');
    }
    $("div.user-info").text(menu.welcome+' <?php echo strtoupper($this->session->userdata('loged_user')->full_name);?>');
    $("a.logout").text(menu.logout);
    $("h1.grid_12").text(page_title);
    $("button.back").text(menu.back);
    $("u.copyright").text(menu.copyright);
    $("u.created").text(menu.created);
//  
});    
</script>
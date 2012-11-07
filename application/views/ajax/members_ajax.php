  <table id="clientsTbl" class="display">
            <thead>
                    <th class="srt"><input id="select-all" type="checkbox" /></th>
                    <th><?php echo $lang_members['table']['th1'];?></th>
                    <th><?php echo $lang_members['table']['th2'];?></th>
                    <th><?php echo $lang_members['table']['th3'];?></th>
                    <th><?php echo $lang_members['table']['th4'];?></th>
                    <th><?php echo $lang_members['table']['th5'];?></th>
                    <th><?php echo $lang_members['table']['th6'];?></th>
                    <th class="action_hide" style="width:90px;"><?php echo $lang_members['table']['th7'];?></th>
            </thead>
            <tbody>
            <?php foreach($members as $member): ?>
                    <tr>
                        <td>
                            <div  class="checker">
                                <span class="second">
                                    <input class="check_member " id="<?php echo $member['id'] ?>"  type="checkbox"  />
                                </span>
                            </div>
                        </td>
                        <td align="center"><?php echo $member['group_name']; ?></td>
                        <td align="center" class="email"><?php echo $member['member_email']; ?></td>
                        <td align="center" class="quiz"><input type="hidden" class="quiz_id" value="<?php echo $member['quize_id'] ?>"/><a class="client_quiz tooltip_new" href="main/client_quiz/view/<?php echo $member['quize_id']?>"><span>Click to View Quiz</span> <u><?php echo ucfirst($member['quiz_name']); ?></u></a></td>
                        <td align="center"><?php echo $member['dispatched'] ?></td>
                        <td align="center"><?php echo $member['completed'] ?></td>
                        <td align="center"><?php echo $member['added_on']; ?></td>
                        <td align="center">
                            <?php if($member['completed'] > 0):?>
                            <a class="member_status tooltip_new" href="#main/client/member_quiz_status/<?php echo $member['id'] ?>" ><span><?php echo $lang_members['info']['tooltip_quiz_status'];?></span> <img alt="quiz"src="template/images/navicons-small/12.png"/></a> 
                            <?php else:?>
                            <img alt="quiz"src="template/images/navicons-small/image_space.png"/>
                            <?php endif;?>
                            <a class="tooltip_new edit_member" href="div.edit_member" ><span><?php echo $lang_members['info']['tooltip_edit'];?></span><img  alt="quiz"src="template/images/navicons-small/165.png"/></a> 
                            <a class="dispatchTo tooltip_new" href="main/client/member_dispatch" ><span><?php echo $lang_members['info']['tooltip_dispatch'];?> </span> <img alt="quiz"src="template/images/navicons-small/18.png"/></a> 
                            <a class="delete_member tooltip_new" href="main/client/delete_member/<?php echo $member['id']; ?>"><span><?php echo $lang_members['info']['tooltip_delete'];?> </span><img  alt="quiz"src="template/images/navicons-small/delete.png"/></a> 
                        </td>
                    </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

<?php if(isset($del_error)):?>
    <script>$("error_members").show().find('p').html(<?php echo $del_error; ?>);</script>
<?php endif;  if(isset($success)):?> 
    <script>$("#success_members").notify("create","success-container",{title: 'Succes', text:<?php echo $success ;?>, icon:'template/images/navicons/92.png'});</script>
<?php endif;?>
<script type="text/javascript">
$(function(){
    $("#error_members").hide();
    $(".firstInfo").show();
    
      //checkbox hack 
    $("#select-all").toggle(
        function () {
            $('.check_member,#select-all').attr("checked", true);
            $("div.checker span").addClass('checked');
            $(".srt").removeClass("sorting_asc");
        },
        function () {
            $('.check_member,#select-all').attr("checked", false);
            $("div.checker span").removeClass('checked');
        });
    
    $(document).on("click", "input:checkbox", function(eve){
       eve.stopImmediatePropagation();
        if($(this).hasClass('checked')){
            $(this).removeClass('checked');
            $(this).closest('span').removeClass('checked');
        }else{
            $(this).addClass('checked');
            $(this).closest('span').addClass('checked');
        }
     });
     
     //change language system
    var sess_lang_update='<?php echo $this->session->userdata('lang_update')?>';
   
     var  page_title = '<?php echo $lang_page_title['your_members']['h1'];?>',
                menu = $.parseJSON('<?php echo json_encode($lang_menu);?>'),
                lang = '<?php echo $this->session->userdata('language')?>';
              
    $.each(menu,function(key,val){
        $("span."+key).text(val);
    });
    if(lang =='en'){
        $("a.flag_after img").attr('src','template/images/ro.png');
        $("a.flag_after").attr('href','main/change_lang/ro');
        $('#clientsTbl').dataTable( {"sPaginationType": "full_numbers"});
    }else{
         $("a.flag_after img").attr('src','template/images/en.png');
         $("a.flag_after").attr('href','main/change_lang/en');
         $('#clientsTbl').dataTable( {
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
        $("select[name=clientsTbl_length], :checkbox").uniform();
    //
});
</script>    
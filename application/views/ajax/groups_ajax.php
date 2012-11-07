<table id="groupsTbl" class="display">
            <thead>
                    <th><?php echo $lang_members['manage_groups']['th1'];?></th>
                    <th class="action_hide"><?php echo $lang_members['manage_groups']['th2'];?></th>
            </thead>
            <tbody>
            <?php foreach($groups as $group): ?>
                    <tr>
                        <td align="center"><?php echo $group->name; ?></td>
                        <td align="center">
                            <a class="tooltip_new edit_group" href="div.edit_group" name="<?php echo $group->name;?>" id="<?php echo $group->id;?>"><span>Edit Group</span><img  src="template/images/navicons-small/165.png"/></a> 
                            <a class="delete_group tooltip_new" id="<?php echo $group->id;?>" href="main/client/manage_groups/delete"><span>Delete Group </span><img src="template/images/navicons-small/delete.png"/></a> 
                        </td>
                    </tr>
            <?php endforeach; ?>
            </tbody>
</table>

<script type="text/javascript">
$(function(){
   //delete group
    $(document).on("click","a.delete_group",function(eve){
        eve.preventDefault();
        eve.stopImmediatePropagation();
        var URL = $(this).attr('href'),
            id  = $(this).attr('id'),
            delete_button={};
            $('#delete-confirm').find('p#err b').html(members.deleteMember.delete_text);
                delete_button[members.deleteMember.button2]=function() {$(this).dialog('close');}
                delete_button[members.deleteMember.button1]=function() {
                    $(this).dialog('close');
                        $.ajax({type:"POST",url:URL,dataType:'json',data: 'group_id='+id,
                                success: function(data) {
                                    if(data.status == 'succes'){
                                        var link = "main/client/manage_groups/reload"; 
                                        $("#error_groups").hide()
                                        $("#success_groups").notify("create","success-container",{title: 'Succes', text:data.msg , icon:'template/images/navicons/92.png'});
                                        $("#ajax_groups").html("<div id='loading-container' style='margin-top:20%;'><p id='loading-content'><img id='loading-graphic' width='16' height='16' src='template/images/ajax-loader-abc4ff.gif' /> Loading...</p></div>");
                                        $("#ajax_groups").load(link);
                                    }else{
                                        $("#error_groups").show().find('p').html(data.msg);
                                        $.colorbox.resize({inline:true});
                                    }	
                                }
                        });
                };
            $('#delete-confirm').dialog({
                        title:members.manage_groups.delete_title,
                        buttons: delete_button
            });
            $("#delete-confirm").dialog("open");
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
        $('#groupsTbl').dataTable( {"sPaginationType": "full_numbers"});
    }else{
         $("a.flag_after img").attr('src','template/images/en.png');
         $("a.flag_after").attr('href','main/change_lang/en');
         $('#groupsTbl').dataTable( {
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
   
   $('select[name=groupsTbl_length]').uniform();
});
</script>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<h1 class="page-title"><?php echo $lang_page_title['manage_groups']['h1'];?></h1>
<div class="container_12 clearfix" ><br />
    <?php if(isset($error)){?>
        <div id="msgbox-error" class="message error closeable">
                    <span class="message-close"></span>
                    <p><?php echo $error;?></p>                        
        </div>
    <?php }else{?>
    <!-- messages --> 
        <div id="error_groups" class="message error closeable" style="display:none;">
                    <span class="message-close"></span>
                    <h3><?php echo $lang_members['errors']['error'];?></h3>
                    <p></p>                        
        </div>
        <div id="success_groups" style="display:none;">
             <div id="success-container">
                <a class="ui-notify-close ui-notify-cross" href="#">x</a>
                <div class="with-icon"><img src="#{icon}" alt="success"/></div>
                <h1>#{title}</h1>
                <p>#{text}</p>
             </div>
        </div>
        <div class="message info closeable">
                <span class="message-close"></span>
                <h3><?php echo $lang_members['manage_groups']['h3'];?></h3>
        </div>
    
        <div style=" float: right; margin-bottom: 10px;">
                 <a href="div.add_group"  class="addGroup button"><?php echo $lang_members['add_members']['buttons']['button2'];?></a> 
        </div>
    
    
        <div id="ajax_groups">
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
                                <a class="tooltip_new edit_group" href="div.edit_group" name="<?php echo $group->name;?>" id="<?php echo $group->id;?>"><span><?php echo $lang_members['manage_groups']['edit_holder'];?></span><img  src="template/images/navicons-small/165.png"/></a> 
                                <a class="delete_group tooltip_new" id="<?php echo $group->id;?>" href="main/client/manage_groups/delete"><span><?php echo $lang_members['manage_groups']['delete_holder'];?></span><img src="template/images/navicons-small/delete.png"/></a> 
                            </td>
                        </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php }?>
</div>

<!-- edit group name -->
<div style="display: none;">
    <div class="container_12 clearfix edit_group" >
	<div class="grid_12"><br />
            <!-- error -->    
            <div id="msgbox-error-group" class="message error closeable">
                    <span class="message-close"></span>
                    <h3><?php echo $lang_members['errors']['error'];?></h3>
                    <p></p>                        
            </div>
            <!-- Info -->
            <div class="message info closeable"  >
                <span class="message-close"></span>
                <h3><?php echo $lang_members['add_members']['info']['h3'];?></h3>
            </div>

            <form class="form has-validation" method="post" id="edit_group">
                    <div class="clearfix">
                            <label for="email" class="form-label colorbox_form_label"> <em>*</em> <?php echo $lang_members['add_members']['buttons']['field1'];?></label>
                            <div class="form-input colorbox_form_input">
                                    <input type="text"  name="group_name"  placeholder="ex : html-php"  />
                                    <input type="hidden" name="group_id" />
                            </div>
                    </div>
                    <div class="form-action clearfix" align="left">
                            <button id="submit_group" class="button"><?php echo $lang_members['add_members']['buttons']['button1'];?></button>
                    </div>
            </form>
	</div>
    </div>
</div>

<!-- add new group -->
<div style="display: none;">
    <div class="container_12 clearfix add_group" >
	<div class="grid_12"><br/>
                <!-- error -->    
            <div class="error_add_group message error closeable">
                    <span class="message-close"></span>
                    <h3><?php echo $lang_members['errors']['error'];?></h3>
                    <p></p>                        
            </div>
            <!-- Info -->
            <div class="message info closeable addGroup_info"  >
                <span class="message-close"></span>
                <h3><?php echo $lang_members['add_members']['info']['h3'];?></h3>
            </div>
                <form class="form has-validation" method="post" id="group_add">
			<div class="clearfix">
				<label for="name" class="form-label colorbox_form_label"><em>*</em> <?php echo $lang_members['add_members']['buttons']['field1'];?></label>
				<div class="form-input colorbox_form_input">
					<input type="text" class="group_name" name="group_name" placeholder="ex : html-php"  />
				</div>
			</div>
			<div class="form-action clearfix" align="left">
				<button  class="button submit_grup1"><?php echo $lang_members['add_members']['buttons']['button1'];?></button>
			</div>
		</form>
	</div>
    </div>
</div>
<script>  $("#error_groups").hide();   $("#success_groups").notify();</script>
<script type="text/javascript">
$(function(){
    //info | error on close click for colorbox resize
    $(document).on("click","span.message-close",function(){
        $(this).closest('div.closeable').hide();
        $.colorbox.resize({inline:true,height:175});
    });
    
    //load edit group colorbox
    $(document).on("click", "a.edit_group", function(eve){
            $("div.info").show();$("#msgbox-error-group").hide();
            eve.preventDefault();
            eve.stopImmediatePropagation();
            $.colorbox({inline:true, href:$(this).attr('href')});
            $.colorbox.resize({inline:true});
            var groupName = $(this).attr('name'),
                id = $(this).attr('id');
            $('div.edit_group').find('input[name=group_id]').val(id)   
            $('div.edit_group').find('input[name=group_name]').val(groupName)
    });
    
    //submit edit group
    $("#edit_group").on("submit",function(eve){
        eve.preventDefault();
        $.ajax({type:"POST",url:'main/client/manage_groups/edit',dataType:'json',data: $("#edit_group").serialize(),
                    success: function(data) {
                        if(data.status == 'succes'){
                            $(window).colorbox.close();
                            var link = "main/client/manage_groups/reload";                        
                            $("#success_groups").notify("create","success-container",{title: 'Succes', text:data.msg , icon:'template/images/navicons/92.png'});
                            $("#ajax_groups").html("<div id='loading-container' style='margin-top:20%;'><p id='loading-content'><img id='loading-graphic' width='16' height='16' src='template/images/ajax-loader-abc4ff.gif' /> Loading...</p></div>");
                            $("#ajax_groups").load(link);
                        }else{
                            $("div.info").hide();$("#msgbox-error-group").show().find('p').html(data.msg);
                            $.colorbox.resize({inline:true});
                        }	
                    }
        });
    });
    
     //load add group colorbox
    $(document).on('click'," a.addGroup",function(eve){
        $("div.info").show();$(".error_add_group").hide();
        eve.preventDefault();
        eve.stopImmediatePropagation();
            $.colorbox({inline:true, href:$(this).attr('href')});
            $.colorbox.resize({inline:true});
    });
    
     //submit add group
    $(document).on("click",".submit_grup1",function(eve){
        eve.preventDefault();
        eve.stopImmediatePropagation();
        $.ajax({type:"POST",url:'main/client/manage_groups/add',dataType:'json',data: $("#group_add").serialize(),
                success: function(data) {
                    if(data.status == 'succes'){
                        $(window).colorbox.close();
                        $("#success_groups").notify("create","success-container",{title: 'Succes', text:data.msg , icon:'template/images/navicons/92.png'});
                        $("#ajax_groups").html("<div id='loading-container' style='margin-top:20%;'><p id='loading-content'><img id='loading-graphic' width='16' height='16' src='template/images/ajax-loader-abc4ff.gif' /> Loading...</p></div>");
                        $("#ajax_groups").load("main/client/manage_groups/reload");
                        $(".group_name").val('');
                    }else{

                        $("div.addGroup_info").hide();$(".error_add_group").show().find('p').html(data.msg);
                        $.colorbox.resize({inline:true});
                    }	
                }
            });
    });

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
});
</script>


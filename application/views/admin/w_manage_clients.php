<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<script>  $("#msgbox-error-manage").hide();   $("#success_admin").notify();</script>
<h1 class="page-title">Manage clients</h1>
<div class="container_12 clearfix" ><br />
    <?php if(isset($error)){?>
        <div id="msgbox-error" class="message error closeable">
                    <span class="message-close"></span>
                    <p><?php echo $error;?></p>                        
        </div>
    <?php }else{?>
        <div id="msgbox-error-manage" class="message error closeable"  >
                    <span class="message-close"></span>
                    <h3>Error!</h3>
                    <p></p>                        
        </div>
        <div id="success_admin"  >
            <div id="success-container">
                <a class="ui-notify-close ui-notify-cross" href="#">x</a>
                <div class="with-icon"><img src="#{icon}" alt="success"/></div>
                <h1>#{title}</h1>
                <p>#{text}</p>
            </div>
        </div> 
    <div id="ajax_clients">
        <table id="clients" class="display">
            <thead>
                    <th>Client</th>
                    <th>Permited</th>
                    <th>Sent</th>
                    <th>Members</th>
                    <th>Groups</th>
                    <th>Quizzes</th>
                    <th class="action_hide">Actions</th>
            </thead>
            <tbody>
            <?php foreach($clients as $client): ?>
                    <tr>
                        <td align="left"><a href="#main/client/view_members/<?php echo $client['id'] ?>"><?php echo $client['email']; ?></a></td>
                        <td align="center"><?php echo $client['emails_permited'];  ?></td>
                        <td align="center"><?php echo $client['emails_sent'];  ?></td>
                        <td align="center"><?php echo $client['members'];  ?></td>
                        <td align="center"><?php echo $client['groups'];  ?></td>
                        <td align="center"><?php echo $client['quizzes'];  ?></td>
                        <td align="center">
                            <a class="tooltip_new" href="#main/client/member_add/<?php echo $client['id'];?>">
                                <span> Add Member</span>
                                <img alt="view" src="template/images/navicons-small/65.png"/>
                            </a>
                             <a class="tooltip_new" href="#main/client/manage_groups/<?php echo $client['id'];?>">
                                <span>Manage Groups</span>
                                <img alt="view" src="template/images/navicons-small/63.png"/>
                            </a>
                            <a class="tooltip_new" href="#main/client_quiz/default/<?php echo $client['id'];?>">
                                <span>View Client quizes</span>
                                <img  alt="edit" src="template/images/navicons-small/33.png"/>
                            </a>
                             <a class="tooltip_new attach_quizzes" title="<?php echo $client['id']?>" href="main/admin_attach_quizzes/<?php echo $client['id']?>">
                                <span>Add Quizzes </span>
                                <img  alt="edit" src="template/images/navicons-small/10.png"/>
                            </a>
                            <a class="edit_client tooltip_new" href="main/admin_edit_client/<?php echo $client['id'];?>">
                                <span>Edit Client</span>
                                <img  alt="edit" src="template/images/navicons-small/165.png"/>
                            </a>
                            <a class="update_client tooltip_new " href="main/admin_update_status/<?php echo $client['id'];?>">
                                <?php if ($client['status'] == 1 ) :?>
                                    <span> Click for dezactivation</span>
                                    <img src="template/images/navicons-small/172.png" alt=""/>
                                <?php else :?>
                                    <span> Click for activation </span>
                                    <img src="template/images/navicons-small/92.png" alt=""/>
                                <?php endif ;?>
                            </a>
                            <a class="sendMessage tooltip_new" href="div.send_message" title="<?php echo $client['id']; ?>"><span>Send message</span> <img alt="quiz"src="template/images/navicons-small/18.png"/></a> 
                            <a class="delete_client tooltip_new" href="main/admin_delete_client/<?php echo $client['id'];?>">
                                <span>Delete Client</span>
                                <img  alt="delete " src="template/images/navicons-small/delete.png"/>
                            </a>
                        </td>
                    </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php }?>
</div>


<!-- send message to client -->
<div style="display: none;">
    <div class="container_12 clearfix send_message">
	<div class="grid_12">
		<br />
                <div id="error-message" class="message error closeable">
                        <span class="message-close"></span>
                        <h3>Error !</h3>
                        <p></p>                        
                </div>
      
		<form class="form has-validation" method="post" id="form_message">
                        <div class="clearfix">
				<label for="email" class="form-label colorbox_form_label">Subject <em>*</em></label>
				<div class="form-input colorbox_form_input">
					<input type="text" id="form-email" name="subject"  placeholder="Subject"  />
				</div>
			</div>
                        <div class="clearfix">
				<label for="email" class="form-label colorbox_form_label">Message <em>*</em></label>
				<div class="form-input colorbox_form_input">
                                        <textarea rows="5" id="autotextarea" style="height: auto; overflow: hidden;" placeholder="Message" name="message"></textarea>
				</div>
			</div>
                        <input type="hidden" name="client_id"/>
			<div class="form-action clearfix" align="left">
				<button id="send_message" class="button">Send</button>
			</div>
		</form>
	</div>
    </div>
</div>
<script type="text/javascript">
$(function(){
     $('#clients').dataTable( {
        "sPaginationType": "full_numbers"
    });
     $('#client_quizzes').dataTable( {
        "sPaginationType": "full_numbers"
    });
    $("#autotextarea").autoGrow();

$(document).on("click", "a.edit_client", function(eve){
        eve.preventDefault();
        eve.stopImmediatePropagation();
        $.colorbox({href:$(this).attr('href')});
        $.colorbox.resize({inline:true, width:"45%"});
});
$(document).on("click", "a.delete_client ", function(eve){
        eve.preventDefault();
        eve.stopImmediatePropagation();
        var link = $(this).attr('href');
        $('#delete-confirm').find('p#err b').html('These items will be permanently deleted and cannot be recovered.<br/> Are you sure ?');
        $('#delete-confirm').dialog({
                    title:"Delete",
                    buttons: {            
                            'Delete': function() {
                                    $("#ajax_clients").html("<div id='loading-container' style='margin-top:20%;'><p id='loading-content'><img id='loading-graphic' width='16' height='16' src='template/images/ajax-loader-abc4ff.gif' /> Loading...</p></div>");
                                    $("#ajax_clients").load(link);
                                    $(this).dialog('close');
                                },
                            Cancel: function() {
                                $(this).dialog('close');
                                }
                            }
          });
          $("#delete-confirm").dialog("open");
       
});
$(document).on("click", "a.update_client ", function(eve){
        eve.preventDefault();
        eve.stopImmediatePropagation();
        var link = $(this).attr('href');
        $("#ajax_clients").html("<div id='loading-container' style='margin-top:20%;'><p id='loading-content'><img id='loading-graphic' width='16' height='16' src='template/images/ajax-loader-abc4ff.gif' /> Loading...</p></div>");
        $("#ajax_clients").load(link);
});
$(document).on("click", "a.attach_quizzes", function(eve){
        eve.preventDefault();
        eve.stopImmediatePropagation();
        $.colorbox({href:$(this).attr('href')});
        $.colorbox.resize({width:"55%"})
});
 

$(document).on("click",'a.view_quiz',function(eve){
            eve.preventDefault();
            eve.stopImmediatePropagation();
            $.colorbox({href:$(this).attr('href')});
            $.colorbox.resize({height:"85%", width:"65%"});
    });
$(document).on("click", "a.edit_quiz", function(eve){
        eve.stopImmediatePropagation();
         $.colorbox.close();
});

$(document).on("click", "a.sendMessage", function(eve){
           $("#error-message").hide();
        eve.preventDefault();
        eve.stopImmediatePropagation();
        $('#form_message input[type=hidden]').val($(this).attr('title'))
        $.colorbox({inline:true, href:$(this).attr('href')});
        $.colorbox.resize({inline:true,width:"55%"})
});

$(document).on("click", "#send_message", function(eve){
     eve.preventDefault();
     eve.stopImmediatePropagation();
     $.ajax({type: "POST",url: 'main/admin_send_message',dataType:'json',data: $('#form_message').serialize()+'&ajax=true',
                    success: function(data) {
                        if(data.status == 'succes'){
                            $.colorbox.close();
                            $("#success_admin").notify("create","success-container",{title: 'Succes', text:data.msg , icon:'template/images/navicons/92.png'});
                        }else{
                             $("#error-message").show().find('p').html(data.msg);
                             $.colorbox.resize({inline:true});
                        }	
                    }
                });
   
});

});
</script>
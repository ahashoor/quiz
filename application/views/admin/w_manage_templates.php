<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<h1 class="page-title">Email Templates Assoc</h1>
<div class="container_12 clearfix" ><br />

<?php if(isset($error)){?>
                <div id="msgbox-error" class="message error closeable">
                        <span class="message-close"></span>
                        <p><?php echo $error;?></p>                        
                </div>
<?php }else{?>
            <div id="msgbox-error_attrib_temp" class="message error closeable" align="left">
                    <span class="message-close"></span>
                    <h3>Error!</h3>
                    <p>atribuire nereusita</p>                        
            </div>

            <div id="success_attrib_temp">
                <div id="container" >
                    <a class="ui-notify-close ui-notify-cross" href="#">x</a>
                    <div class="with-icon"><img src="#{icon}" alt="success"/></div>
                    <h1>#{title}</h1>
                    <p>#{text}</p>
                </div>
            </div> 
    
            <form id="selected_template" >
                    <div style=" float: left; margin-bottom: 10px;">
                            <select id="template" name="template">
                                <option value="not_set"> Change Template to selected emails </option>
                                <?php foreach($template_id_name as $val):?>
                                <option value="<?php echo $val['id']?>"><?php echo $val['name'];?></option>
                                <?php endforeach;?>
                            </select>
                    </div>
                
                    <div style=" float: right; margin-bottom: 10px;">
                        <a href="div.add_email" class="button addEmail">Adauga email nume </a> 
                    </div>
                
            </form>
    
            <div id="template_manger">
                    <table id="templatesTbl_templates" class="display">
                        <thead>
                                <th class="srt">
                                    <input id="select-all" type="checkbox"/>
                                </th>
                                <th>Email Name  </th>
                                <th>Template name  </th>
                                <th class="action_hide">Actions</th>
                        </thead>
                        <tbody>
                        <?php foreach($templates as $template): ?>
                                <tr>
                                    <td>
                                        <div  class="checker">
                                            <span class="second">
                                                <input class="check_templates " id="<?php echo $template['id'] ?>"  type="checkbox"  />
                                            </span>
                                        </div>
                                    </td>
                                    <td align="center"><?php echo $template['template_name'] ;?></td>
                                    <td align="center"><?php echo $template['temp_name'] ;?></td>
                                    <td align="center">
                                        <?php if(!empty($template['id_template'])):?>
                                        <a class="view_template " href="main/admin_view_email_template_assoc/<?php echo $template['id_template'];?>"><img  alt="View" src="template/images/navicons-small/12.png"/></a>
                                        <?php else:?>
                                        <a class="edit_email tooltip_new" href="div.email_edit" name="<?php echo $template['template_name'];?>" id="<?php echo $template['id'];?>"><span>Edit Email</span><img  src="template/images/navicons-small/165.png"/></a> 
                                        <a class="delete_email tooltip_new" id="<?php echo $template['id']?>" href="main/admin_delete_email"><span>Delete Email </span><img src="template/images/navicons-small/delete.png"/></a> 
                                       <?php endif;?> 
                                    </td>
                                </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php }?>
            </div>
</div>

<div style="display: none;">
    <div class="container_12 clearfix add_email" align="center" >
	<div class="grid_12">
		<br />
                <div id="msgbox-error-email" class="message error closeable" align="left">
                        <span class="message-close"> </span><h3>Error!</h3><p></p>                        
                </div>
		<form class="form has-validation" method="post" id="add_email">
                        <div class="clearfix">
				<label for="email" class="form-label">Email Name <em>*</em></label>
				<div class="form-input">
					<input type="text"  name="email_name"  placeholder="Name for the email"  />
				</div>
			</div>
			<div class="form-action clearfix" align="left">
				<button id="submit_email" class="button">Submit</button>
			</div>
		</form>
	</div>
    </div>
</div>

<div style="display: none;">
    <div class="container_12 clearfix email_edit" align="center" >
	<div class="grid_12">
		<br />
                <div id="msgbox-error-edit_email" class="message error closeable">
                        <span class="message-close"> </span><h3>Error!</h3><p></p>                        
                </div>
		<form class="form has-validation" method="post">
                        <div class="clearfix">
				<label for="email" class="form-label">Email Name <em>*</em></label>
				<div class="form-input">
					<input type="text" id="admin_edit_email" name="email_name1"   />
                                        <input type="hidden"  id="admin_hidden"/>
				</div>
			</div>
			<div class="form-action clearfix" align="left">
				<button id="submit_admin_email_edit" class="button">Submit</button>
			</div>
		</form>
	</div>
    </div>
</div>
<script type="text/javascript">
    $("#msgbox-error_attrib_temp").hide();   $("#success_attrib_temp").notify();

    $('#templatesTbl_templates').dataTable( {"sPaginationType": "full_numbers"});
    
    //add email
    $(document).on('click'," a.addEmail",function(eve){
        $("#msgbox-error-email").hide();
        eve.preventDefault();
        eve.stopImmediatePropagation();
            $.colorbox({inline:true, href:$(this).attr('href')});
            $.colorbox.resize({inline:true, width:"40%"});
    });
    
    $(document).on("click","#submit_email",function(event){
        event.preventDefault();
         if($(':input[name=email_name]').val().length > 0){
                  $.ajax({type: "POST",url: 'main/add_name_email',dataType:'json',data: $("#add_email").serialize()+'&ajax=1',
                            success: function(data) {
                                    if(data.status == 'succes'){
                                        $(window).colorbox.close();$(':input[name=email_name]').val('');
                                        $("#template_manger").load("main/load_ajax_template_table");
                                        $("#success_attrib_temp").notify("create","container", {title: 'Succes', text: data.msg ,icon:'template/images/navicons/92.png'});
                                    }	
                                }
                        });
            }else{
                $("#msgbox-error-email").show().find('p').html('The Email Name field is required.'); $.colorbox.resize({inline:true});
            }
   });
   //-----
   
   //view email
       $(document).on("click", "a.view_template", function(eve){
            eve.preventDefault();
            eve.stopImmediatePropagation();
            $.colorbox({href:$(this).attr('href')});
            $.colorbox.resize({inline:true});
    });
    //---
   
   //edit email
    $(document).on("click", "a.edit_email", function(eve){
        eve.preventDefault();
        eve.stopImmediatePropagation();
        $("#msgbox-error-edit_email").hide()
        $.colorbox({inline:true, href:$(this).attr('href')});
        $('input#admin_edit_email').val($(this).attr('name'));
        $(':input#admin_hidden').val($(this).attr('id'));   
    });
    $("#submit_admin_email_edit").on("click",function(eve){
        eve.preventDefault();
        var id = $(':input#admin_hidden').val(),
        email_name =$('input#admin_edit_email').val();
        $.ajax({type:"POST",url:'main/admin_edit_email',dataType:'json',data: 'email_id='+id+'&email_name='+email_name+'&ajax=edit',
                    success: function(data) {
                        if(data.status == 'succes'){
                            $.colorbox.close();
                            $("#success_attrib_temp").notify("create","container",{title: 'Succes', text:data.msg , icon:'template/images/navicons/92.png'});
                            $("#template_manger").html("<div id='loading-container' style='margin-top:20%;'><p id='loading-content'><img id='loading-graphic' width='16' height='16' src='template/images/ajax-loader-abc4ff.gif' /> Loading...</p></div>");
                            $("#template_manger").load("main/load_ajax_template_table");
                        }else{
                            $("#msgbox-error-edit_email").show().find('p').html(data.msg);
                            $.colorbox.resize({inline:true});
                        }	
                    }
        });
    });
    //-----
    
    
    //delete email
    $("a.delete_email").on("click",function(eve){
    eve.preventDefault();
    eve.stopImmediatePropagation();
    var URL = $(this).attr('href'),
        id  = $(this).attr('id'); 
          $('#delete-confirm').find('p#err b').html('These items will be permanently deleted and cannot be recovered.<br/> Are you sure ?');
          $('#delete-confirm').dialog({
                    title:"Delete",
                    buttons: {            
                            'Delete': function() {
                                      $.ajax({type:"POST",url:URL,dataType:'json',data: 'email_id='+id,
                                                success: function(data) {
                                                    if(data.status == 'succes'){
                                                        $("#msgbox-error_attrib_temp").hide()
                                                        $("#success_attrib_temp").notify("create","container",{title: 'Succes', text:data.msg , icon:'template/images/navicons/92.png'});
                                                        $("#template_manger").html("<div id='loading-container' style='margin-top:20%;'><p id='loading-content'><img id='loading-graphic' width='16' height='16' src='template/images/ajax-loader-abc4ff.gif' /> Loading...</p></div>");
                                                        $("#template_manger").load("main/load_ajax_template_table");
                                                    }else{
                                                        $("#msgbox-error_attrib_temp").show().find('p').html(data.msg);
                                                    }	
                                                }
                                        });
                                    $(this).dialog('close');
                                },
                            Cancel: function() {
                                $(this).dialog('close');
                                }
                            }
          });
          $("#delete-confirm").dialog("open");
    });
    
    //change/add template to email
    $(document).on("change", "#template", function(event){
        var ids = [];
        $(':input:checkbox:checked').each(function(){
            ids.push($(this).attr('id'));
        });
        event.stopImmediatePropagation();
        if(ids.length === 0 ){
            $("div.info").hide(); $("#msgbox-error_attrib_temp").show().find('p').html('Please select email to apply the selected template !');
            $("div#uniform-template span").text($("#template option:first").text());
            $("#template option:first").attr('selected',true);
        }else{
                $.ajax({type: "POST",url: 'main/admin_manage_tempates', dataType:'json',data: $("#selected_template").serialize()+'&to='+ids+'&ajax=1',
                        success: function(data) {
                            if(data.status == 'succes'){
                                $("#msgbox-error_attrib_temp").hide();
                                $("#success_attrib_temp").notify("create","container", {title: 'Succes', text: data.msg ,icon:'template/images/navicons/92.png'});
                                $("#template_manger").html("<div id='loading-container' style='margin-top:20%;'><p id='loading-content'><img id='loading-graphic' width='16' height='16' src='template/images/ajax-loader-abc4ff.gif' /> Loading...</p></div>");
                                $("#template_manger").load("main/load_ajax_template_table");
                                
                            }else{
                                $("#msgbox-error_attrib_temp").show().find('p').html(data.msg);
                            }	
                        }
                });
        }
            
    });
    
    $("#select-all").toggle(
        function (e) {

            $('#check_all').attr("checked", true);
            $("div.checker span").addClass('checked');
            $(".sort").removeClass("sorting_asc");
        },
        function (e) {
            $('#select-all').attr("checked", false);
            $("div.checker span").removeClass('checked');
        }
        );

    $(document).on("click", "input:checkbox.check_templates", function(eve){
         eve.stopImmediatePropagation();
        if($(this).hasClass('checked')){
            $(this).removeClass('checked');
            $(this).parent('span').removeClass('checked');
        }else{
            $(this).addClass('checked');
            $(this).parent('span').addClass('checked');
        }
    });
</script>
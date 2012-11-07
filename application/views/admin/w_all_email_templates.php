<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<h1 class="page-title">Email Templates</h1>
<div class="container_12 clearfix" ><br />

<?php if(isset($error)){?>
                <div id="msgbox-error" class="message error closeable">
                        <span class="message-close"></span>
                        <p><?php echo $error;?></p>                        
                </div>
<?php }else{?>
            <div id="error_template" class="message error closeable">
                    <span class="message-close"></span>
                    <h3>Error!</h3>
                    <p></p>                        
            </div>
        <div id="success_template" style="display: none;">
             <div id="success-container">
                <a class="ui-notify-close ui-notify-cross" href="#">x</a>
                <div class="with-icon"><img src="#{icon}" alt="success"/></div>
                <h1>#{title}</h1>
                <p>#{text}</p>
             </div>
        </div>
          <form id="selected_template" accept-charset="utf-8">
                <div style=" float: right; margin-bottom: 10px;">
                    <a href="#main/admin_add_email_template" class="button" >Add template</a>
                </div>
          </form>
            <div id="template_manger">
                    <table id="templates" class="display">
                        <thead>
                                <th> Template name </th>
                                <th> Email Subject </th>
                                <th> Last update </th>
                                <th> Added </th>
                                <th class="action_hide">Actions</th>
                        </thead>
                        <tbody>
                        <?php foreach($template_id_name as $template): ?>
                            <tr>
                                <td align="center"><?php echo $template['name'] ;?></td>
                                <td align="center"><?php echo $template['email_subject'];?></td>
                                <td align="center"><?php echo $template['last_updated'];?></td>
                                <td align="center"><?php echo $template['added'];?></td>
                                <td align="center">
                                    <a class="view_template" href="main/admin_view_email_template_assoc/<?php echo $template['id'];?>"><img  alt="View" src="template/images/navicons-small/12.png"/></a>
                                    <a class="edit_template" href="#main/admin_edit_template/<?php echo $template['id'];?>"><img  alt="edit" src="template/images/navicons-small/165.png"/></a> 
                                    <a class="delete_template" href="main/admin_delete_template/<?php echo $template['id'];?>"><img  alt="delete " src="template/images/navicons-small/delete.png"/></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php }?>
            </div>
</div>
<script type="text/javascript">
$(function(){
    $("#error_template").hide();   
    $("#success_template").notify();
    $('#templates').dataTable( {
        "sPaginationType": "full_numbers"
    });

    $(document).on("click", "a.view_template", function(eve){
            eve.preventDefault();
            eve.stopImmediatePropagation();
            $.colorbox({href:$(this).attr('href')});
            $.colorbox.resize({inline:true, width:"45%"});
    });
    $(document).on("click", "a.delete_template", function(eve){
            eve.preventDefault();
            eve.stopImmediatePropagation();
            $.ajax({
                type: "POST",
                url: $(this).attr('href'),
                dataType:'json',
                data: '',
                    success: function(data) {
                        if(data.status == 'succes'){
                            $("#template_manger").load('main/admin_delete_template/reload');
                            $("#success_template").notify("create","success-container", {title: 'Succes', text: data.msg ,icon:'template/images/navicons/92.png'});
                        }else{
                                $("#msgbox-error_assoc_template").show().find('p').html(data.msg);
                            }	
                        }
                });

    });
});
</script>
<?php if(isset($del_error)){?>
    <script>
    var txt=<?php echo $del_error; ?>;
    $("#msgbox-error-manage").show().find('p').html(txt);
    </script>
<?php } ?>
<?php if(isset($success)){?> 
    <script>$("#success_admin").notify("create","success-container",{title: 'Succes', text:<?php echo $success ;?>, icon:'template/images/navicons/92.png'});</script>
<?php }?>
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
                        <td align="left"><a href="#main/client/view_members/<?php echo $client['id'] ?>" ><?php echo $client['email']; ?></a></td>
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
                            <a class="sendMessage tooltip_new" href="div.send_message" ><span>Send message</span> <img alt="quiz"src="template/images/navicons-small/18.png"/></a> 
                            <a class="delete_client tooltip_new" href="main/admin_delete_client/<?php echo $client['id'];?>">
                                <span>Delete Client</span>
                                <img  alt="delete " src="template/images/navicons-small/delete.png"/>
                            </a>
                        </td>
                    </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
<script type="text/javascript">
$(function(){
    $('#clients').dataTable( {
        "sPaginationType": "full_numbers"
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
    $("a.update_client").click( function(eve){
        eve.preventDefault();
        //eve.stopPropagation();
         eve.stopImmediatePropagation();
        var link = $(this).attr('href');
        $("#ajax_clients").html("<div id='loading-container' style='margin-top:20%;'><p id='loading-content'><img id='loading-graphic' width='16' height='16' src='template/images/ajax-loader-abc4ff.gif' /> Loading...</p></div>");
        $("#ajax_clients").load(link);
    });
      $("select").uniform();

    $(document).on("click", "a.edit_client", function(eve){
            eve.preventDefault();
            eve.stopImmediatePropagation();
            $.colorbox({href:$(this).attr('href')});
            $.colorbox.resize({inline:true, width:"35%"})
    });
}); 
</script>    
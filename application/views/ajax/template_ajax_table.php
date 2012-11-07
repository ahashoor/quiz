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

<script type="text/javascript">
$(function(){
    $('#templatesTbl_templates').dataTable( {
        "sPaginationType": "full_numbers"
    });
    $(":checkbox,select[name=templatesTbl_templates_length]").uniform();
    
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
});
</script>
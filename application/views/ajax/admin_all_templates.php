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
<script>
$(document).ready(function(){
     $('#templates').dataTable( {
        "sPaginationType": "full_numbers"
    });
    $('select[name=templates_length]').uniform()
});
</script>
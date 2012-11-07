	 <table id="how" class="display">
        <thead>
                <th>Order</th>
                <th>H1</th>
                <th>First Image</th>
                <th>Second Image</th>
                <th>First Text</th>
                <th>Second text</th>
                <th>Lang</th>

                <th class="action_hide">Actions</th>
        </thead>
        <tbody id="sortable">
        <?php foreach($how as $val): ?>
                <tr id="<?php echo $val['id']?>" > 
                  <td align="center"><?php echo $val['order']; ?></td>
                    <td align="center" class="h1"><?php echo $val['h1']; ?></td>
                    <td align="center" class="img1">
                        <a class="grup-first" href=" <?php echo $val['img1']; ?>"><img width="50" height="30"  src=" <?php echo $val['img1']; ?>" /></a>
                    </td>
                    <td align="center" class="img2">
                         <a class="grup-second" href=" <?php echo $val['img2']; ?>"><img width="50" height="30"  src=" <?php echo $val['img2']; ?>" /></a>
                    </td>
                    <td align="center" class="text1"><?php echo $val['text1']?></td>
                    <td align="center" class="text2"><?php echo $val['text2']; ?></td>
                    <td align="center" class="language"><?php echo ucfirst($val['language']); ?></td>

                    <td align="center">
                        <a class="update_status tooltip_new " id="<?php echo $val['id'];?>" href="javascript:void(0)" title="<?php if ($val['status'] == 1 ){echo 0;}else{echo 1;}?>">
                            <?php if ($val['status'] == 1 ) :?>
                                <span> Click for dezactivation</span>
                                <img src="template/images/navicons-small/172.png" alt=""/>
                            <?php else :?>
                                <span> Click for activation </span>
                                <img src="template/images/navicons-small/92.png" alt=""/>
                            <?php endif ;?>
                        </a>
                        <a class="edit_how tooltip_new"  href="div.edit_image" ><span>Edit</span><img  alt="edit"src="template/images/navicons-small/165.png"/></a> 
                        <a class="delete_how tooltip_new" id="<?php echo $val['id'] ?>" href="javascript:void(0)" ><span>Delete </span> <img alt="delete"src="template/images/navicons-small/delete.png"/></a> 
                    </td>
                </tr>
        <?php endforeach; ?>
        </tbody>
     </table>
<br/><br/>  <a href="div.new_image" class="add_new_image button">Add new image </a>

<script type="text/javascript">
$(document).ready(function(){
     $('#how').dataTable( {
        "bPaginate": false
    });
      $(".grup-first").colorbox({rel:'grup-first'});
     $(".grup-second").colorbox({rel:'grup-second'});
    $( "#sortable" ).sortable({
    placeholder: "ui-state-highlight",
    opacity: 0.6,
    update: function(event, ui) {
         var itmr =[],
             itme =[],
             itmr_length =$( "#sortable td.language:contains('ro')" ),
             itme_length =$( "#sortable td.language:contains('en')" );

         $.each(itmr_length,function(){
             itmr.push($(this).parent('tr').attr('id'))
         });
         $.each(itme_length,function(){
             itme.push($(this).parent('tr').attr('id'))
         });
        $.ajax({
            type: "POST",
            url: "main/admin_edit_how_its_work_order",
            data: 'ro='+itmr+'&en='+itme,
            dataType:'json',
            success: function(data){
              if(data.status == 'succes'){
                        var link = "main/admin_how_its_work/reload"; 
                        $("#success_add_image").notify("create","success-container",{title: 'Succes', text:data.msg , icon:'template/images/navicons/92.png'});
                        $("#ajax_groups").html("<div id='loading-container' style='margin-top:20%;'><p id='loading-content'><img id='loading-graphic' width='16' height='16' src='template/images/ajax-loader-abc4ff.gif' /> Loading...</p></div>");
                        $("#ajax_groups").load(link);
                    }else{
                        $("#error_attach").show().find('p').text(data.msg);
                    }
            }
        });
    }
});
$( "#sortable" ).disableSelection();
});

</script>
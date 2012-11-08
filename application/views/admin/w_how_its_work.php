<script type="text/javascript" src="template/js/jquery.colorbox.js"></script>
<style>
  .ui-state-highlight { height: 3.5em; line-height: 2.2em; border:1px solid #CCCCCC; }
</style>
<h1 class="page-title" align="center">How its work - slide</h1>

<div class="container_12 clearfix add_quiz">
      <br/>
      <div id="error_attach" class="message error closeable"style="display:none;">
                  <span class="message-close"></span>
                  <h3>Error !</h3>
                  <p></p>                        
      </div>
      <div id="success_add_image" style="display: none;">
          <div id="success-container">
                  <a class="ui-notify-close ui-notify-cross" href="#">x</a>
                  <div class="with-icon"><img src="#{icon}" alt="success"/></div>
                  <h1>#{title}</h1>
                  <p>#{text}</p>
          </div>
      </div> 
      
	<div class="grid_12"><br />
    <div id="ajax_groups">
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
        </div>
	</div>
</div>

<!-- Add new image -->
<div style="display: none;">
    <div class="container_12 clearfix new_image" >
        <div class="grid_12"><br />
          <div id="msgbox-error-newImage" class="message error closeable" style="display:none;">
                  <span class="message-close"></span>
                  <h3>Error !</h3>
                  <p></p>                        
          </div>
          <div class="message info closeable" id="info-newImage" >
              <span class="message-close"></span>
              <h3>Add new image for how its work frontend slide</h3>
          </div>
          <form class="form has-validation" method="post" id="addImage-form">
                       <div class="clearfix">
                              <label for="form-timezone" class="form-label">Language</label>
                              <div class="form-input">
                                  <select id="form-timezone" name="language">
                                      <option value="ro">Ro</option>
                                      <option value="en">En</option>
                                  </select>
                              </div>
                          </div>
                       <div class="clearfix">
                              <label for="h1" class="form-label"> Text for top</label>
                              <div class="form-input ">
                                      <input type="text"  name="h1"  id="h1" />
                              </div>
                       </div>
                       <div class="clearfix">
                          <label for="first-text" class="form-label"> First Text</label>
                          <div class="form-input ">
                                  <input type="text"  name="first_text"  id="first-text"/>
                          </div>
                       </div>
                       <div class="clearfix">
                          <label for="first-image" class="form-label"> First Image</label>
                          <div >
                                  <input type="text"  name="first_image"  id="first-image" class="img_span" placeholder="Double click to load gallery"/>
                          </div>
                       </div>
                       <div class="clearfix">
                          <label for="second-text" class="form-label"> Second text</label>
                          <div class="form-input">
                                  <input type="text"  name="second_text"  id="second-text"/>
                          </div>
                       </div>
                       <div class="clearfix">
                          <label for="second-image" class="form-label"> Second Image</label>
                          <div >
                                  <input type="text"  name="second_image"  id="second-image" class="img_span" placeholder="Double click to load gallery"/>
                          </div>
                       </div>
                  <div class="form-action clearfix" align="left">
                          <button id="submit_addImage" class="button">Upload image</button>
                  </div>
          </form>
      </div>
  </div>
</div>


<!-- Edit image-->
<div style="display: none;">
  <div class="container_12 clearfix edit_image">
    <div class="grid_12"><br/>
            <div id="ajax_groups">  
               <div id="error_attach" class="message error closeable"style="display:none;">
                             <span class="message-close"></span>
                             <h3>Error !</h3>
                             <p></p>                        
                 </div>
                 <div class="message info closeable" >
                       <span class="message-close"></span>
                       <h3>Edit image for how its work frontend slide</h3>
                   </div>
               <form class="form has-validation" method="post" id="editImage-form">
                          <div class="clearfix">
                                 <label for="form-timezone" class="form-label">Language</label>
                                 <div class="form-input">
                                     <select id="form-timezone-edit" name="language">
                                         <option value="ro" >Ro</option>
                                         <option value="en" >En</option>
                                     </select>
                                 </div>
                             </div>
                          <div class="clearfix">
                                 <label for="h1" class="form-label"> Text for top</label>
                                 <div class="form-input ">
                                         <input type="text"  name="h1"  id="h1-edit" />
                                 </div>
                          </div>
                          <div class="clearfix">
                             <label for="first-text" class="form-label"> First Text</label>
                             <div class="form-input ">
                                     <input type="text"  name="first_text"  id="first-text-edit" />
                             </div>
                          </div>
                          <div class="clearfix">
                             <label for="first-image" class="form-label"> First Image</label>
                             <div >
                                     <input type="text"  name="first_image"  id="first-image-edit" class="img_span" placeholder="Double click to load gallery"/>
                             </div>
                          </div>
                          <div class="clearfix">
                             <label for="second-text" class="form-label"> Second text</label>
                             <div class="form-input">
                                     <input type="text"  name="second_text"  id="second-text-edit" />
                             </div>
                          </div>
                          <div class="clearfix">
                             <label for="second-image" class="form-label"> Second Image</label>
                             <div >
                                     <input type="text"  name="second_image"  id="second-image-edit" class="img_span" placeholder="Double click to load gallery"/>
                             </div>
                          </div>
                     <div class="form-action clearfix" align="left">
                         <input type="hidden" id="id-edit"/>
                             <button id="submit_editImage" class="button">Update image</button>
                     </div>
             </form>
           </div>
        </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
     $('#how').dataTable( {
        "bPaginate": false
    });
     $("#success_add_image").notify();
     $(".grup-first").colorbox({rel:'grup-first'});
     $(".grup-second").colorbox({rel:'grup-second'});
        
   //load add group colorbox
    $(document).on('click'," a.add_new_image",function(eve){
        $("#info-newImage").show();$("#msgbox-error-newImage").hide();
        eve.preventDefault();
        eve.stopImmediatePropagation();
            $.colorbox({inline:true, width:"50%", href:$(this).attr('href')});
    });  
  
    $(document).on("dblclick","#second-image,#first-image,#second-image-edit,#first-image-edit",function(event){
        event.stopImmediatePropagation();
        elfinder_load($(this));
    });

   //load add group colorbox
    $(document).on('click'," a.edit_how",function(eve){
        $("#info-newImage").show();$("#msgbox-error-newImage").hide();
        eve.preventDefault();
        eve.stopImmediatePropagation();
        var trVal = $(this).parents('tr');
        var lang = trVal.find('td.language').text();
        var selected = $("#form-timezone-edit").find("option:contains("+lang+")").attr("selected","selected")
        selected.parents("#uniform-form-timezone-edit").find('span').text(lang);
        $('#h1-edit').val(trVal.find('td.h1').text());
        $('#first-text-edit').val(trVal.find('td.text1').text());
        $('#first-image-edit').val(trVal.find('td.img1 img').attr('src'));
        $('#second-text-edit').val(trVal.find('td.text2').text());
        $('#second-image-edit').val(trVal.find('td.img2 img').attr('src'));
        $('#id-edit').val(trVal.attr('id'));
        $.colorbox({inline:true, width:"50%", href:$(this).attr('href')});
    });
    
    //delete image
    $(document).on("click","a.delete_how",function(eve){
        eve.preventDefault(); eve.stopImmediatePropagation();
        var id  = $(this).attr('id'),
            delete_button={};
            $('#delete-confirm').find('p#err b').html('These items will be permanently deleted and cannot be recovered.Are you sure ?');
                delete_button['Cancel']=function() {$(this).dialog('close');}
                delete_button['Delete']=function() {
                 $(this).dialog('close');
                    $.ajax({type:"POST",url:'main/admin_delete_how_its_work',dataType:'json',data: 'image_id='+id,
                            success: function(data) {
                                if(data.status == 'succes'){
                                    var link = "main/admin_how_its_work/reload"; 
                                    $("#error_groups").hide()
                                    $("#success_add_image").notify("create","success-container",{title: 'Succes', text:data.msg , icon:'template/images/navicons/92.png'});
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
                        title:'Delete',
                        buttons: delete_button
            });
            $("#delete-confirm").dialog("open");
    });
    
    
    //update image status: 1-0
    $(document).on("click","a.update_status",function(eve){
      eve.preventDefault(); eve.stopImmediatePropagation();
      var id  = $(this).attr('id'),
      status = $(this).attr('title');
        $.ajax({type:"POST",url:'main/admin_update_status_how_its_work',dataType:'json',data: 'image_id='+id+'&status='+status,
                success: function(data) {
                    if(data.status == 'succes'){
                        var link = "main/admin_how_its_work/reload"; 
                        $("#success_add_image").notify("create","success-container",{title: 'Succes', text:data.msg , icon:'template/images/navicons/92.png'});
                        $("#ajax_groups").html("<div id='loading-container' style='margin-top:20%;'><p id='loading-content'><img id='loading-graphic' width='16' height='16' src='template/images/ajax-loader-abc4ff.gif' /> Loading...</p></div>");
                        $("#ajax_groups").load(link);
                    }	
                }
        });
    });

    
   //add image
    $(document).on("click", "#submit_addImage", function(event){
       event.preventDefault();event.stopImmediatePropagation();
       var len ='';
      $.each($("#addImage-form input:text"),function(){
          if($(this).val().length == 0){
            len += $(this).parent().prev().text()+' can not be empty <br/>';
          }
      });
       
        if(len.length == 0 ){
            $.ajax({type: "POST",url: 'main/admin_how_its_work',dataType:'json',data: $("#addImage-form").serialize()+'&ajax=add',
                    success: function(data) {
                        if(data.status == 'succes'){
                            $(':checkbox:checked').each(function(){
                                $(this).attr('checked', false);
                                $(this).parent('span').removeClass('checked');
                            }); 
                            var link = "main/admin_how_its_work/reload"; 
                            $("#error_groups").hide()
                            $("#success_add_image").notify("create","success-container",{title: 'Succes', text:data.msg , icon:'template/images/navicons/92.png'});
                            $("#ajax_groups").html("<div id='loading-container' style='margin-top:20%;'><p id='loading-content'><img id='loading-graphic' width='16' height='16' src='template/images/ajax-loader-abc4ff.gif' /> Loading...</p></div>");
                            $("#ajax_groups").load(link);
                            $.colorbox.close();
                            $("#edit_group input:text").val('');
                        }else{
                            
                            $("#msgbox-error-newImage").show().find('p').html(data.msg);
                            $.colorbox.resize({inline:true});
                            
                        }	
                    }
                });
        }else{
            $("#info-newImage").hide();
            $("#msgbox-error-newImage").show().find('p').html(len+'<br />');
            $.colorbox.resize({inline:true});
        }
    }); 
    //edit image
      $(document).on("click", "#submit_editImage", function(event){
       event.preventDefault();event.stopImmediatePropagation();
       var len ='';
      $.each($("#editImage-form input:text"),function(){
          if($(this).val().length == 0){
            len += $(this).parent().prev().text()+' can not be empty <br/>';
          }
      });
       
        if(len.length == 0 ){
            var id = $('#id-edit').val();
            $.ajax({type: "POST",url: 'main/admin_edit_how_its_work/'+id,dataType:'json',data: $("#editImage-form").serialize()+'&ajax=update',
                    success: function(data) {
                        if(data.status == 'succes'){
                            $("#error_groups").hide()
                             $("#success_add_image").notify("create","success-container", {title: 'Succes', text: data.msg ,icon:'template/images/navicons/92.png'});
                            $("#ajax_groups").html("<div id='loading-container' style='margin-top:20%;'><p id='loading-content'><img id='loading-graphic' width='16' height='16' src='template/images/ajax-loader-abc4ff.gif' /> Loading...</p></div>");
                            $("#ajax_groups").load("main/admin_how_its_work/reload");
                            $.colorbox.close();
                            $("input:text").val('');
                        }else{
                            $("#error_edit_image").show().find('p').html(data.msg);
                        }	
                    }
                });
        }else{
            $("#error_edit_image").show().find('p').html(len+'<br />');
        }
    });
    
   //error on close - colorbox resize 
    $(document).on("click","span.message-close",function(){
        $(this).closest('div.closeable').hide();
        $.colorbox.resize({inline:true});
    });
   //checkbox hack 
    $("select[name=client_quizzes_length], :checkbox").uniform();
      
    $("#select_all").toggle(
    function () {
        $('#select-all').attr("checked", true);
        $("div.checker span").addClass('checked');
        $("input:checkbox").addClass('checked').attr("checked", true);
    },
    function () {
        $('#select-all').attr("checked", false);
        $("div.checker span").removeClass('checked');
        $("input:checkbox").removeClass('checked').attr("checked", false);
    });
    
    
    function elfinder_load(element,to){
        $('<div />').elfinder({
            url : 'main/elfinder_init/first_page',
            lang : 'en',
            places:'',
            dialog : {width : 600, modal : true, title:'',zIndex:999991},
            editorCallback : function(url) {
                element.val(url);
            }
        });
    }  
});
   
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
</script>
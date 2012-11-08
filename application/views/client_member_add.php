<div class="reload">
    <h1 class="page-title"><?php echo $lang_page_title['add_member']['h1'];?></h1>
    <div class="container_12 clearfix" align="center" >
            <div id="success_add_member">
                <div id="success-container" style="display: none;">
                        <a class="ui-notify-close ui-notify-cross" href="#">x</a>
                        <div class="with-icon"><img src="#{icon}" alt="success"/></div>
                        <h1>#{title}</h1>
                        <p>#{text}</p>
                </div>
            </div>
        
            <div class="grid_12">
                    <br />
                    <!-- error -->
                    <div class="message error closeable error_add_member" align="left" style="display: none;">
                            <span class="message-close"></span>
                            <h3><?php echo $lang_members['errors']['error'];?></h3>
                            <p></p>                        
                    </div>
                    <!-- Info -->
                    <div class="message info closeable add_member_info" align="left" >
                        <span class="message-close"></span>
                        <h3><?php echo $lang_members['add_members']['info']['h3'];?></h3>
                        <p> <?php echo $lang_members['add_members']['info']['p1'];?></p>
                        <p> <?php echo $lang_members['add_members']['info']['p2'];?></p>
                        <p> <?php echo $lang_members['add_members']['info']['p3'];?></p>
                        <p> <?php echo $lang_members['add_members']['info']['p4'];?></p>
                    </div>

                    <div class="clearfix" align="left"> 
                        <a class="plus_member tooltip_new"><img alt="New question" src="template/images/navicons-small/10.png"></a>
                        <a class="minus_member tooltip_new"><img alt="Delete last question" src="template/images/navicons-small/135.png"></a>
                        <em><?php echo $lang_members['add_members']['buttons']['plus_minus_message'];?></em> 
                    </div>
                    <form class="form has-validation" method="post" id="addMember">
                            <div class="clearfix">
                                <label class="form-label" for="status"><em>* </em><?php echo $lang_members['add_members']['buttons']['field1'];?></label>
                                <div class="form-input">
                                        <select name="group_selected" id="group_selected">
                                            <option  selected='selected'><?php echo $lang_members['add_members']['buttons']['select_group'];?></option>
                                        </select>
                                </div>
                            </div>
                            <div class="clearfix member">
                                    <label for="name" class="form-label"><em>* </em><?php echo $lang_members['add_members']['buttons']['field2'];?></label>
                                    <div class="form-input">
                                            <input type="text" class="member_email" name="member_email[]" placeholder="<?php echo $lang_members['add_members']['buttons']['field2_placeholder'];?>"  />
                                    </div>
                            </div>

                            <div class="form-action clearfix" align="left">
                                    <input type="submit"  class="button" id="save" value="<?php echo $lang_members['add_members']['buttons']['button1'];?>"/>
                                    <a href="div.add_group" class="add_group button"><?php echo $lang_members['add_members']['buttons']['button2'];?></a>
                            </div>
                    </form>
            </div>
    </div>
</div>

<div style="display: none;">
    <div class="container_12 clearfix add_group">
        <div class="grid_12">
            <br/>
            <div class="error_add_group message error closeable">
                <span class="message-close"></span>
                <h3><?php echo $lang_members['errors']['error'];?></h3>
                <p></p>                        
            </div>
            <!-- Info -->
            <div class="message info closeable group_info" align="left" >
                <span class="message-close"></span>
                <h3><?php echo $lang_members['add_members']['info']['h3'];?></h3>
            </div>

            <div class="grid_12">
                    <form class="form has-validation" method="post" id="group_add">
                            <div class="clearfix">
                                    <label for="name" class="form-label colorbox_form_label"><em>* </em><?php echo $lang_members['add_members']['buttons']['group_name'];?></label>
                                    <div class="form-input colorbox_form_input">
                                            <input type="text" class="group_name" name="group_name" placeholder="ex:html-php"  />
                                    </div>
                            </div>
                            <div class="form-action clearfix" align="left">
                                    <button class="button submit_grup"><?php echo $lang_members['add_members']['buttons']['button1'];?></button>
                            </div>
                    </form>
            </div>
        </div>
    </div>
</div>
<script> 
$(function(){
    $("#success_add_member").notify();
    $(".error_add_member").hide();
    $("select#group_selected").load("main/client/manage_groups/get");
    
    //info | error on close click for colorbox resize
    $(document).on("click","span.message-close",function(){
        $(this).closest('div.closeable').hide();
        $.colorbox.resize({inline:true,height:175});
    });
    
    //review the info 
    $(document).on("click"," span.message-close",function(){
        $("div.add_member_info").show();
    })
    
    $(document).on('click'," a.add_group",function(eve){
        $('div.group_info').show();$(".error_add_group").hide();
        eve.preventDefault();
        eve.stopImmediatePropagation();
         $.colorbox({inline:true, href:$(this).attr('href')});
         $.colorbox.resize({inline:true})
        
    });
    
    $(document).on("click",".submit_grup",function(event){
         event.preventDefault();
         event.stopImmediatePropagation();
        $.ajax({type:"POST",url:'main/client/manage_groups/add',dataType:'json',data: $("#group_add").serialize(),
                success: function(data) {
                    if(data.status == 'succes'){
                        $(window).colorbox.close();
                        $("#success_add_member").notify("create","success-container",{title: 'Succes', text:data.msg , icon:'template/images/navicons/92.png'});
                        $("select#group_selected").load("main/client/manage_groups/get");
                        $(".group_name").val('');
                    }else{
                        
                        $('div.group_info').hide();$(".error_add_group").show().find('p').html(data.msg);
                        $.colorbox.resize({inline:true});
                    }	
                }
            });
    })
      //settings button add new 
    $(document).on("click","a.plus_member",function(event){
        event.preventDefault();
        event.stopImmediatePropagation();
          var member = $("div.member").eq(0).clone(),
          lastMember = $("div.member").last();
          $(member).find('input').val('').removeClass('invalid').removeClass('err');
           $(member).insertAfter(lastMember)
    });
    
    //settings button remove last 
     $(document).on("click","a.minus_member",function(event){
        event.preventDefault();
        event.stopImmediatePropagation();
        if($("div.member").length > 1)
        $("div.member").last().remove();
    });
    
;
    
     $(document).on("click","#save",function(event){
       
        event.preventDefault();
         event.stopImmediatePropagation();
        $.ajax({type:"POST",url:'main/client/member_add',dataType:'json',data: $("#addMember").serialize()+'&ajax=1',
                beforeSend:function(){
                      $("#save").attr("disabled",true);
                },
                success: function(data) {
                    $("#save").attr("disabled",false);
                    if(data.status == 'succes'){
                        $("div.info").show();$(".error_add_member").hide();
                        $("#success_add_member").notify("create","success-container",{title: 'Succes', text:data.msg , icon:'template/images/navicons/92.png'});
                        $("select#group_selected").load("main/client/manage_groups/get");
                        $("input.member_email").val('').removeClass('err').removeClass('invalid');
                        $("#uniform-group_selected span").text($("#group_selected option:first").text());
                        
                    }else{
                        if(data.type=='already_exist'){
                            var t = data.msg.split(',');
                            if(t.length > 1){
                                $("div.info").hide();$(".error_add_member").show().find('p').html(members.edit.error);
                              var ip = $("input.member_email");
                               $(ip).removeClass('invalid')
                              $.each(t,function(i,v){
                                  
                                   $.each(ip,function(idx,input){
                                      
                                       if($(input).val() == v){
                                           $(input).addClass('invalid');
                                       }else{
                                           $(input).removeClass('err')
                                       }
                                   });
                                });
                            }
                        }else if(data.type == 'wrong_domain'){
                            var t = data.msg.split(',');
                            if(t.length > 1){
                                $("div.info").hide();$(".error_add_member").show().find('p').html(members.errors.wrong_domain);
                              var ip = $("input.member_email");
                                $(ip).removeClass('err');
                              $.each(t,function(i,v){
                                   $.each(ip,function(idx,input){
                                       if($(input).val() === v){
                                           $(input).addClass('err');
                                       }else{
                                           $(input).removeClass('invalid')
                                       }
                                   });
                                });
                            }
                        }else{
                            $("div.info").hide();$(".error_add_member").show().find('p').html(data.msg);
                        }
                        
                        
                    }	
                }
            });
    });
    
//change language system
     var  page_title = '<?php echo $lang_page_title['add_member']['h1'];?>',
                menu = $.parseJSON('<?php echo json_encode($lang_menu);?>'),
                lang = '<?php echo $this->session->userdata('language')?>',
                sess_lang_update='<?php echo $this->session->userdata('lang_update')?>';
                members = $.parseJSON('<?php echo json_encode($lang_members);?>');
                
    if(sess_lang_update ==="updated"){
        $("select").uniform();
    }
    
    $.each(menu,function(key,val){
        $("span."+key).text(val);
    });
    
    if(lang =='en'){
        $("a.flag_after img").attr('src','template/images/ro.png');
        $("a.flag_after").attr('href','main/change_lang/ro');
    }else{
         $("a.flag_after img").attr('src','template/images/en.png');
         $("a.flag_after").attr('href','main/change_lang/en');
    }
    $("div.user-info").text(menu.welcome+' <?php echo strtoupper($this->session->userdata('loged_user')->full_name);?>');
    $("a.logout").text(menu.logout);
    $("h1.grid_12").text(page_title);
    $("button.back").text(menu.back);
    $("u.copyright").text(menu.copyright);
    $("u.created").text(menu.created);
//  
});
</script>


                
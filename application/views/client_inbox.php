<?php $read=count($message_read);?>

    <h1 class="page-title"><?php echo $lang_page_title['inbox']['h1'];?></h1>
    <div class="container_12 clearfix"  >
    
        <div id="error_inbox" class="message error closeable"style="display:none;">
                    <span class="message-close"></span>
                    <h3><?php echo $lang_members['errors']['error'];?></h3>
                    <p></p>                        
        </div>
        <div id="success_inbox" style="display:none;">
             <div id="success-container">
                <a class="ui-notify-close ui-notify-cross" href="#">x</a>
                <div class="with-icon"><img src="#{icon}" alt="success"/></div>
                <h1>#{title}</h1>
                <p>#{text}</p>
             </div>
        </div>
        
            <div class="grid_12">
                    <br />  

     
        
<?php if($read > 0){?>
    <div id="accordion3" >
     <h3><a href="#" class="pane"><?php echo $lang_inbox['messages']?> <b class="old_nr"><?php echo $read?></b></a></h3>
         <div>
             <div id="accordion4" class="pane" >
                 <?php foreach ($message_read as $value){ ?>
                            <h3 style="margin-top: 10px;">
                                <a href="#" >
                                    <img  src="<?php echo base_url('template/images/navicons-small/180.PNG')?>"/>
                                    <div class="user_nm"><?php echo ucfirst($value['sender_name'])?> : <?php echo $value['added_on'];?> </div>
                                    <div class="user_mes"><?php echo $value['subject'] ;?></div>
                                </a>
                            </h3>
                            <div>
                                  <p id="<?php echo $value['id']?>"><?php echo $value['message'] ;?>
                                       <img  src="<?php echo base_url('template/images/close-icon.png')?>" alt="delete" class="delete" />
                                  </p>
                            </div>
                    <?php }?>
                 
             </div>

        </div>
    </div>

               <?php }else{?>

      <div id="msgbox-error" class="message error closeable" >
                    <span class="message-close"></span>
                    <p>No messagess</p>                        
        </div>
        
     <?php }?>
            </div>
    </div>
  <?php $this->firephp->log($notifications_read);?>
<script>
    $(function(){
         $("#error_inbox").hide();   $("#success_inbox").notify();
         //change language system
            var sess_lang_update='<?php echo $this->session->userdata('lang_update')?>';
            var  page_title = '<?php echo $lang_page_title['inbox']['h1'];?>',
                        menu = $.parseJSON('<?php echo json_encode($lang_menu);?>'),
                        notification = $.parseJSON('<?php echo json_encode($lang_notification);?>'),
                        lang = '<?php echo $this->session->userdata('language')?>';
                        
            $("#notifications-popover header").text(notification.title);
            $("#activity-popover header").text(notification.title1);
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
            if(sess_lang_update ==="updated"){
                $("select, :checkbox").uniform();
                $("#wrapper > section > section > section > div").css({'position':'relative','width':'96%'})
            }
        //         
		$(".delete").click(function(){
                    var parent = $(this).closest('div'),
                          head = parent.prev('h3'),
                          oldNr = $("h3 a b.old_nr"),
                          data = $(this).parent();
			$.ajax({type: "POST",url: 'main/client/inbox/delete',data: "id="  + data.attr('id'),dataType:"json",
                          success: function(msg) {
                             parent.add(head).fadeOut('fast',function(){$(this).remove();});
                               if(msg.status == 'succes'){
                                   $(oldNr).text($(oldNr).text()-1)
                                    $("#success_inbox").notify("create","success-container",{title: 'Succes', text:data.msg , icon:'template/images/navicons/92.png'});
                                }else{
                                    $("#error_inbox").show().find('p').html(data.msg);
                                }
                          }
			});
		});

                $( "#accordion3" ).accordion({
                        collapsible: true,
                        active: false,
                        clearStyle: true
                });
                $( "#accordion4" ).accordion({
                        collapsible: true,
                        active: false,
                        clearStyle: true
                });
   });
</script>
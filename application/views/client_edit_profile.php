<h1 class="page-title"><?php echo $lang_page_title['edit_profile']['h1'];?></h1>
<div class="container_12 clearfix" align="center" ><br />
	<div class="grid_12">
		
                <div id="edit_error" class="message error closeable" style="display: none;">
                        <span class="message-close"></span>
                        <p></p>                        
                </div>
                <div class="message info closeable" align="left">
                        <span class="message-close"></span>
                        <h3><?php echo $lang_edit['info']['h3'];?></h3>
                        <p><?php echo $lang_edit['info']['p'];?></p>
                </div>
               <div id="success_edit" style="display:none;">
                    <div id="success-container">
                        <a class="ui-notify-close ui-notify-cross" href="#">x</a>
                        <div class="with-icon"><img src="#{icon}" alt="success"/></div>
                        <h1>#{title}</h1>
                        <p>#{text}</p>
                    </div>
                </div>
		<form class="form has-validation" method="post" id="formSettings">
			<div class="clearfix">
                            <label for="name" class="form-label"><em>* </em> <?php echo $lang_edit['full_name'];?></label>
				<div class="form-input">
					<input type="text" id="form-name"  name="full_name" required="required" placeholder="Full Name"  value="<?php echo $loged_user_data->full_name;?>"/>
				</div>
			</div>
			<div class="clearfix">
				<label for="name" class="form-label"><em>* </em><?php echo $lang_edit['email_address'];?> </label>
				<div class="form-input">
					<input type="text" id="email" name="email" required="required" placeholder="email@email.com"  value="<?php echo $loged_user_data->email;?>"/>
				</div>
			</div>
                        <div class="clearfix">
				<label for="name" class="form-label"><?php echo $lang_edit['password'];?></label>
				<div class="form-input">
					<input type="password"  id="permitted" name="new_password" required="required" placeholder="<?php echo $lang_edit['reset_pass_placeholder'];?>"  />
				</div>
			</div>
                       
                        <div class="clearfix">
				<label for="name" class="form-label"><?php echo $lang_edit['emails_permitted'];?></label>
				<div class="form-input">
					<input type="text"   onfocus="this.blur()"  disabled="disabled" value="<?php echo $loged_user_data->emails_permited;?>"/>
				</div>
			</div>
                        <div class="clearfix">
				<label for="name" class="form-label"><?php echo $lang_edit['emails_sent'];?></label>
				<div class="form-input">
					<input type="text"  onfocus="this.blur()"  disabled="disabled" value="<?php echo $loged_user_data->emails_sent;?>"/>
				</div>
			</div>
			<div class="form-action clearfix" align="left">
				<button id="submit_clients" class="button">Submit</button>
			</div>
		</form>
	</div>
</div>

<script> 
$(function(){ 
    $("#edit_error").hide();
    $("#success_edit").notify();

    
//change language system
     var sess_lang_update='<?php echo $this->session->userdata('lang_update')?>';
     var  page_title = '<?php echo $lang_page_title['edit_profile']['h1'];?>',
                menu = $.parseJSON('<?php echo json_encode($lang_menu);?>'),
                lang = '<?php echo $this->session->userdata('language')?>';
        
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

    $(document).on("click", "#submit_clients", function(event){
        $("#edit_error").hide();
        event.preventDefault();
        event.stopImmediatePropagation();
        $.ajax({type: "POST",url:'main/client/edit_profile',dataType:'json',data: $("#formSettings").serialize()+'&submit=true',
                    success: function(data) {
                        if(data.status == 'succes'){
                                $("div.user-info").text(data.welcome+' '+$('#form-name').val().toUpperCase());
                                $(".info").show(); $("#success_edit").notify("create","success-container", {title: 'Succes', text: data.msg, icon:'template/images/navicons/92.png'});
                        }else{
                                $(".info").hide();$("#edit_error").show().find('p').html(data.msg);
                            }	
                        }
                });
    });
});
</script>
                
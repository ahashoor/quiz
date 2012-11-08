<?php $loged_user_data = $this->session->userdata('loged_user');?>
<script>  $("#msgbox-ed_profile").hide();   $("#success_edit").notify();</script>
<h1 class="page-title">Edit your Account</h1>
<div class="container_12 clearfix" >
	<div class="grid_12">
		<br />
                <div id="msgbox-ed_profile" class="message error closeable">
                        <span class="message-close"></span>
                        <p></p>                        
                </div>
<div id="success_edit" style="display: none;">
<div id="success-container">
        <a class="ui-notify-close ui-notify-cross" href="#">x</a>
        <div class="with-icon"><img src="#{icon}" alt="success"/></div>
        <h1>#{title}</h1>
        <p>#{text}</p>
    </div>
</div> 
		<form class="form has-validation" method="post" id="formSettings">
			<div class="clearfix">
                            <label for="name" class="form-label"><em>*</em> Full Name</label>
				<div class="form-input">
					<input type="text" id="form-name"  name="full_name" required="required" placeholder="Full Name"  value="<?php echo $loged_user_data->full_name;?>"/>
				</div>
			</div>
			<div class="clearfix">
				<label for="name" class="form-label"><em>*</em> Email Address </label>
				<div class="form-input">
					<input type="text" id="email" name="email" required="required" placeholder="email@email.com"  value="<?php echo $loged_user_data->email;?>"/>
				</div>
			</div>
            <div class="clearfix">
				<label for="name" class="form-label"> Password</label>
				<div class="form-input">
					<input type="password"  id="password" name="password" required="required" placeholder="Reset Password"  />
				</div>
			</div>
			<div class="form-action clearfix" align="left">
				<button id="edit_admin" class="button">Submit</button>
			</div>
		</form>
	</div>
</div>
<script> 
$("#msgbox-ed_profile").hide();
$(document).on("click", "#edit_admin", function(event){
      event.preventDefault();
       event.stopImmediatePropagation();
    $.ajax({
        type: "POST",
        url:'main/admin_edit_profile',
        dataType:'json',
        data: $("#formSettings").serialize()+'&ajax=1'+'&id=<?php echo $loged_user_data->id;?>',
                success: function(data) {
                    if(data.status == 'ok'){
                           // $("#success").notify();
//                            $("#success").show();
                           $("#success_edit").notify("create","success-container",{title: 'Succes', text:data.msg , icon:'template/images/navicons/92.png'});
                    }else{
                            $("#msgbox-ed_profile").show().find('p').html(data.msg);
                        }	
                    }
            })
});
</script>
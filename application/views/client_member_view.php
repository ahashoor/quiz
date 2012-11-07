<div class="container_12 clearfix" >
	<div class="grid_12">
		<br />
                <div id="msgbox-error-clients" class="message error closeable">
                        <span class="message-close"> </span>
                        <p></p>                        
                </div>
		<form class="form has-validation" method="post" id="formSettings">
            <div class="clearfix">
                            <label for="name" class="form-label">Name<em>*</em></label>
				<div class="form-input">
					<input type="text" id="form-name"  name="full_name" required="required" placeholder="Full Name"  value=""/>
				</div>
			</div>
            <div class="clearfix">
				<label for="email" class="form-label">Email Address <em>*</em></label>
				<div class="form-input">
					<input type="text" id="form-email" name="email" required="required" placeholder="email@email.com"  value=""/>
				</div>
			</div>
          
           <div class="clearfix">
                <label class="form-label" for="status">Status</label>
                <div class="form-input">
                <div class="selector" >
                    <select name="status" id="status">
                        <option>t</option>
                    </select>
                </div>
                </div>
            </div>
			<div class="clearfix">
				<label for="members_permited" class="form-label">Members Permited<em>*</em></label>
				<div class="form-input">
					<input type="text" id="members_permited" name="members_permited" required="required" placeholder="Members Permited"  value=""/>
				</div>
            </div>
            <div class="clearfix">
                            <label for="quizes_permited" class="form-label">Quizz Permited<em>*</em></label>
				<div class="form-input">
					<input type="text" id="quizes_permited"  name="quizes_permited" required="required" placeholder="quizes_permited"  value=""/>
				</div>
			</div>
           	<input type="hidden" name="hid" value=""/>
			<div class="form-action clearfix" align="left">
				<button id="submit_clients" class="button">Submit</button>
			</div>
		</form>
	</div>
</div>
<script>
$(function(){    
    $("select#status").uniform();
    $(document).ready(function (){
        $("#msgbox-error-clients").hide();
    });
    $(document).on("click", "#submit_clients", function(event){
        event.preventDefault();
        event.stopImmediatePropagation();
        console.log($("#formSettings").serialize())
        $.ajax({
            type:"POST",
            url:'main/admin_edit_client/',
            dataType:'json',
            data: $("#formSettings").serialize()+'&ajax=1',
                    success: function(data) {
                        if(data.status == 'succes'){
                            $(window).colorbox.close();
                            var link = "main/load_ajax_table";                        
                            $("#success").notify("create","success-container",{title: 'Succes', text:data.msg , icon:'template/images/navicons/92.png'});
                            $("#ajax_clients").html("<div id='loading-container' style='margin-top:20%;'><p id='loading-content'><img id='loading-graphic' width='16' height='16' src='template/images/ajax-loader-abc4ff.gif' /> Loading...</p></div>");
                            $("#ajax_clients").load(link);
                        }else{
                            $("#msgbox-error-clients").show().find('p').html(data.msg);
                            $.colorbox.resize({innerHeight:450});
                        }	
                    }
                });
    });
});
</script>
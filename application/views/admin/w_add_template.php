<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<script type="text/javascript">
    $().ready(function() {
        $('textarea.tinymce').tinymce({
             // Location of TinyMCE script
            script_url : './template/lib/tinymce/tiny_mce.js',
            
            file_browser_callback : 'elFinderBrowser',
            // General options
            theme : "advanced",
            plugins : "autolink,lists,pagebreak,style,layer,table,tableDropdown,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,preview,media,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
            remove_script_host : false,
            convert_urls : false,
            // Theme options
            theme_advanced_buttons1 : "bold,italic,underline,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,fontsizeselect,|,media,advhr",
            theme_advanced_buttons2 : "bullist,numlist,|,blockquote,|,link,unlink,anchor,image,code,|,preview,|,forecolor,backcolor,|,tableDropdown,|,charmap,iespell,|,fullscreen",
            theme_advanced_toolbar_location : "bottom",
            theme_advanced_toolbar_align : "left",
            theme_advanced_statusbar_location : "bottom",
            theme_advanced_resizing : true
        });
    });
</script>
<h1 class="page-title">Edit email template</h1>
<div id="success_add_email_template">
    <div id="success_add_email_container" >
    <a class="ui-notify-close ui-notify-cross" href="#">x</a>
    <div class="with-icon"><img src="#{icon}" alt="success"/></div>
    <h1>#{title}</h1>
    <p>#{text}</p>
    </div>
</div> 
<div class="container_12 clearfix">
	<div class="grid_12"><br />
        <div id="msgbox-error_add_email_template" class="message error closeable">
                            <span class="message-close"></span>
                            <h3>Error!</h3>
                            <p> There was an Error</p>                        
        </div>
		<div style="clear: both"><br /></div>
		<div id="msgBox" style="width: 100%; text-align: center; color: #000000; font-weight: bold;"></div>
		<form class="form has-validation" method="post" id="formSettings">  
			<div class="clearfix">
				<label for="name" class="form-label" style="width: 20%;">Name<em>*</em></label>
				<div class="form-input" style="width:80%" >
					<input type="text" id="name" name="template_name" required="required" placeholder="Template name"  />
				</div>
			</div>
                        <div class="clearfix">
				<label for="name" class="form-label" style="width: 20%;">Email subject<em>*</em></label>
				<div class="form-input" style="width:80%" >
					<input type="text"  name="email_subject" required="required" placeholder="Email subject"  />
				</div>
			</div>
    <!-- header -->
			<div class="clearfix">
				<label for="header" class="form-label" style="width: 20%;">Header</label>
				<div>
                                    <textarea id="header1-add" style="width: 80%;height: 100%;" name="header-add_template"  class="tinymce" ></textarea>
				</div>
			</div>
   <!-- content -->
                        <div class="clearfix">
				<label for="content" class="form-label" style="width: 20%;">Content<em>*</em></label>
				<div >
                                    <textarea id="content-add" style="width: 80%;height: 100%;" name="content"  class="tinymce" ></textarea>
				</div>
			</div>
   <!-- footer -->
			<div class="clearfix">
				<label for="footer" class="form-label" style="width: 20%;">Footer</label>
				<div>
                                    <textarea id="footer-add" style="width: 80%;height: 100%;" name="footer-add_template"  class="tinymce" ></textarea>
				</div>
			</div>
			<div class="form-action clearfix" align="left" >
				<button class="button" id="add_template">Insert</button>
				<a href="#main/admin_all_email_template" class="button">Back</a>
			</div>
		</form>
	</div>
</div>
<script type="text/javascript">

    
   $("#msgbox-error_add_email_template").hide(); $("#success_add_email_template").notify();
   $("#add_template").click(function(event){
   event.preventDefault();
       $.ajax({
            type: "POST",
            url: 'main/admin_add_email_template',
            dataType:'json',
            data: $("#formSettings").serialize()+'&ajax=1',
                success: function(data) {
                    if(data.status == 'succes'){
                           $("#success_add_email_template").notify("create","success_add_email_container", {title: 'Succes', text: data.msg ,icon:'template/images/navicons/92.png'});
                           
                    }else{
                           // $("#msgbox-error_add_email_template").show();
                            $("#msgbox-error_add_email_template").show().find('p').html(data.msg);
                        }	
                    }
            });
   });
</script>
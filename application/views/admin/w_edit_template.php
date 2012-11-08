<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<script type="text/javascript">
   function elFinderBrowser (field_name, url, type, win) {
                var cmsURL = 'main/load_elfinder';    // script URL - use an absolute path!
                if (cmsURL.indexOf("?") < 0) {
                    //add the type as the only query parameter
                    cmsURL = cmsURL + "?type=" + type;
                }
                else {
                    //add the type as an additional query parameter
                    // (PHP session ID is now included if there is one at all)
                    cmsURL = cmsURL + "&type=" + type;
                }

                tinyMCE.activeEditor.windowManager.open({
                    file : cmsURL,
                    width : 900,  
                    height : 450,
                    resizable : "yes",
                    inline : "yes",  // This parameter only has an effect if you use the inlinepopups plugin!
                    popup_css : false, // Disable TinyMCE's default popup CSS
                    close_previous : "no"
                }, {
                    window : win,
                    input : field_name
                });
                return false;
            }
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
</script>
<h1 class="page-title">Edit email template -- <em><?php echo $email_templates ->name;?></em> --</h1>
<div id="success_edit_email_template">
    <div id="success-email-template-container" >
    <a class="ui-notify-close ui-notify-cross" href="#">x</a>
    <div class="with-icon"><img src="#{icon}" alt="success"/></div>
    <h1>#{title}</h1>
    <p>#{text}</p>
    </div>
</div> 
<div class="container_12 clearfix">
	<div class="grid_12"><br/>
        <div id="msgbox-error_edit_template" class="message error closeable" align="left">
                            <span class="message-close"></span>
                            <h3>Error!</h3>
                            <p> There was an Error</p>                        
        </div>
		<div style="clear: both"><br /></div>
		<div id="msgBox" style="width: 100%; text-align: center; color: #000000; font-weight: bold;"></div>
		<form class="form has-validation" method="post" id="formSettings">  
			<div class="clearfix">
				<label for="name" class="form-label" style="width: 20%;">Name <em>*</em></label>
				<div class="form-input" style="width:80%" >
					<input type="text" id="name" name="template_name" required="required" placeholder="Template name" value="<?php echo $email_templates ->name;?>" />
				</div>
			</div>
                         <div class="clearfix">
				<label for="name" class="form-label" style="width: 20%;">Email subject<em>*</em></label>
				<div class="form-input" style="width:80%" >
					<input type="text"  name="email_subject" required="required" placeholder="Email subject" value="<?php echo $email_templates ->email_subject;?>" />
				</div>
			</div>
    <!-- header -->
			<div class="clearfix">
				<label for="header" class="form-label" style="width: 20%;">Header </label>
				<div>
                                    <textarea id="header1" name="header"style="width: 80%;height: 100%;"  class="tinymce" ><?php echo $email_templates ->email_template_header; ?></textarea>
				</div>
			</div>
   <!-- content -->
                        <div class="clearfix">
				<label for="content" class="form-label" style="width: 20%;">Content<em>*</em></label>
				<div>
                                    <textarea id="content" name="content"  style="width: 80%;height: 100%;"class="tinymce" ><?php echo $email_templates ->email_template_content; ?></textarea>
				</div>
			</div>
   <!-- footer -->
			<div class="clearfix">
				<label for="footer" class="form-label" style="width: 20%;">Footer</label>
				<div>
                                    <textarea id="footer" name="footer"  style="width: 80%;height: 100%;"class="tinymce" ><?php echo $email_templates ->email_template_footer ;?></textarea>
				</div>
			</div>
			<div class="form-action clearfix" align="left" >
				<button class="button" id="edit_template">Edit</button>
				<a href="#main/admin_all_email_template" class="button">Back</a>
			</div>
		</form>
	</div>
</div>
<?php $template_url_session =  site_url('/source/template_images');
$_SESSION['template_url_session'] = $template_url_session;

?>
<script type="text/javascript">

    
   $("#msgbox-error_edit_template").hide(); $("#success_edit_email_template").notify();
   $("#edit_template").click(function(event){
   event.preventDefault();
       $.ajax({
            type: "POST",
            url: 'main/admin_edit_template/<?php echo  $email_templates ->id;?>',
            dataType:'json',
            data: $("#formSettings").serialize()+'&ajax=1',
                success: function(data) {
                    if(data.status == 'succes'){
                        $("#msgbox-error_edit_template").hide()
                           $("#success_edit_email_template").notify("create","success-email-template-container", {title: 'Succes', text: data.msg ,icon:'template/images/navicons/92.png'});
                           
                    }else{
                            //$("#msgbox-error_edit_template").show();
                            $("#msgbox-error_edit_template").show().find('p').html(data.msg);
                        }	
                    }
            });
   });
</script>
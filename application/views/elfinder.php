<!DOCTYPE html>
<html>
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>Email Template Images Gallery</title>
        <link rel="stylesheet" type="text/css" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/themes/smoothness/jquery-ui.css">
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/jquery-ui.min.js"></script>

		
                
                <link rel="stylesheet" type="text/css" media="screen" href="<?php echo site_url('template/elfinder/css/elfinder.css');?>">

<script type="text/javascript" src="<?php echo site_url('template/elfinder/js/elfinder.min.js');?>"></script>

		<!-- elFinder translation (OPTIONAL) -->
		<script type="text/javascript" src="<?php echo site_url('template/lib/tinymce/tiny_mce_popup.js');?>"></script>

		<!-- elFinder initialization (REQUIRED) -->
<script type="text/javascript">
            var FileBrowserDialogue = {
                init : function () {
                    // Here goes your code for setting your custom things onLoad.
                },
                mySubmit : function (URL) {
                    
                    var win = tinyMCEPopup.getWindowArg("window");

                    // insert information now
                    win.document.getElementById(tinyMCEPopup.getWindowArg("input")).value = URL;

                    // are we an image browser
                    if (typeof(win.ImageDialog) != "undefined") {
                        // we are, so update image dimensions...
                        if (win.ImageDialog.getImageData)
                            win.ImageDialog.getImageData();

                        // ... and preview if necessary
                        if (win.ImageDialog.showPreviewImage)
                            win.ImageDialog.showPreviewImage(URL);
                    }

                    // close popup window
                    tinyMCEPopup.close();
                }
            }

            tinyMCEPopup.onInit.add(FileBrowserDialogue.init, FileBrowserDialogue);
            $().ready(function() {
                var elf = $('#elfinder').elfinder({
                    // lang: 'ru',             // language (OPTIONAL)
                    url : '<?php echo site_url('main/elfinder_init/email_template'); ?>',  // connector URL (REQUIRED)
                    getfile : {
                        onlyURL : true,
                        multiple : false,
                        folders : false
                    },
                   editorCallback : function(url) {
                    
                        FileBrowserDialogue.mySubmit(url);
                    }                     
                })            
            });
        </script>
		</head>
		<body>

<!-- Element where elFinder will be created (REQUIRED) -->
<div id="elfinder"></div>
</body>
</html>
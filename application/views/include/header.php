<!DOCTYPE html>
<!--[if IE 7 ]>   <html lang="en" class="ie7 lte8"> <![endif]--> 
<!--[if IE 8 ]>   <html lang="en" class="ie8 lte8"> <![endif]--> 
<!--[if IE 9 ]>   <html lang="en" class="ie9"> <![endif]--> 
<!--[if gt IE 9]> <html lang="en"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head><!--[if lte IE 9 ]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- iPad Settings -->
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" /> 
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<!-- Adding "maximum-scale=1" fixes the Mobile Safari auto-zoom bug: http://filamentgroup.com/examples/iosScaleBug/ -->
<!-- iPad Settings End -->
<title>Quize</title>

<link rel="shortcut icon" href="favicon.ico">

<!-- iOS ICONS -->
<link rel="apple-touch-icon" href="touch-icon-iphone.png" />
<link rel="apple-touch-icon" sizes="72x72" href="touch-icon-ipad.png" />
<link rel="apple-touch-icon" sizes="114x114" href="touch-icon-iphone4.png" />
<link rel="apple-touch-startup-image" href="touch-startup-image.png">
<!-- iOS ICONS END -->

<!-- STYLESHEETS -->

<link rel="stylesheet" href="template/css/reset.css" media="screen" />
<link rel="stylesheet" href="template/css/grids.css" media="screen" />
<link rel="stylesheet" href="template/css/ui.css" media="screen" />
<link rel="stylesheet" href="template/css/forms.css" media="screen" />
<link rel="stylesheet" href="template/css/device/general.css" media="screen" />
<!--[if !IE]><!-->
<link rel="stylesheet" href="template/css/device/tablet.css" media="only screen and (min-width: 768px) and (max-width: 991px)" />
<link rel="stylesheet" href="template/css/device/mobile.css" media="only screen and (max-width: 767px)" />
<link rel="stylesheet" href="template/css/device/wide-mobile.css" media="only screen and (min-width: 480px) and (max-width: 767px)" />
<!--<![endif]-->
<link rel="stylesheet" href="template/css/jquery.uniform.css" media="screen" />
<link rel="stylesheet" href="template/css/jquery.popover.css" media="screen">
<link rel="stylesheet" href="template/css/jquery.itextsuggest.css" media="screen">
<link rel="stylesheet" href="template/css/themes/lightblue/style.css" media="screen" />

<style type = "text/css">
    #loading-container {position: absolute; top:50%; left:50%;}
    #loading-content {width:800px; text-align:center; margin-left: -400px; height:50px; margin-top:-25px; line-height: 50px;}
    #loading-content {font-family: "Helvetica", "Arial", sans-serif; font-size: 18px; color: black; text-shadow: 0px 1px 0px white; }
    #loading-graphic {margin-right: 0.2em; margin-bottom:-2px;}
    #loading {background-color:#abc4ff; background-image: -moz-radial-gradient(50% 50%, ellipse closest-side, #abc4ff, #87a7ff 100%); background-image: -webkit-radial-gradient(50% 50%, ellipse closest-side, #abc4ff, #87a7ff 100%); background-image: -o-radial-gradient(50% 50%, ellipse closest-side, #abc4ff, #87a7ff 100%); background-image: -ms-radial-gradient(50% 50%, ellipse closest-side, #abc4ff, #87a7ff 100%); background-image: radial-gradient(50% 50%, ellipse closest-side, #abc4ff, #87a7ff 100%); height:100%; width:100%; overflow:hidden; position: absolute; left: 0; top: 0; z-index: 99999;}

    #loading-container1 {position: relative; top:25%; left:50%; }
    #loading-content1 {width:800px; text-align:center; margin-left: -400px; height:50px;  line-height: 50px;}
    #loading-content1 {font-family: "Helvetica", "Arial", sans-serif; font-size: 18px; color: black; text-shadow: 0px 1px 0px white; }
    #loading-graphic1 {margin-right: 0.2em; margin-bottom:-2px;}
</style>

<!-- STYLESHEETS END -->

<!--[if lt IE 9]>
<script src="template/js/html5.js"></script>
<script type="text/javascript" src="template/js/selectivizr.js"></script>
<a href="http://www.mozilla.org/en-US/firefox/new">ie</a>
<![endif]-->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src='template/js/jquery-ui-1.8.21.custom.min.js'></script>
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/smoothness/jquery-ui.css" type="text/css" />-->

  <script>window.jQuery || document.write("<script src='template/js/jquery.min.js'>\x3C/script>")</script>
    <link rel="stylesheet" type="text/css" media="screen" href="template/css/jquery-ui-1.8.21.custom.css">
     <script type="text/javascript" src='template/js/jquery-ui-1.8.21.custom.min.js'></script>

<!--  css-->
<link rel="stylesheet" media="screen" href="template/css/costum_style.css" />
<link rel="stylesheet" media="screen" href="template/css/notifications.css" />
<link rel="stylesheet" href="template/css/colorbox.css" />
<link rel="stylesheet" type="text/css" media="screen" href="template/elfinder/css/elfinder.css">
<link rel="stylesheet" media="screen" href="template/css/docs.css" />
<link rel="stylesheet" media="screen" href="template/lib/datatables/css/vpad.css" />
<link rel="stylesheet" media="screen" href="template/css/forms.css" />    
<link rel="stylesheet" media="screen" href="template/lib/jqplot/jquery.jqplot.min.css" />
<!-- end css-->

</head>
<body style="overflow: hidden;">
    <div id="loading"> 
        <script type = "text/javascript"> 
            document.write("<div id='loading-container'><p id='loading-content'>" +
                           "<img id='loading-graphic' width='16' height='16' src='template/images/ajax-loader-trans.gif' /> " +
                           "Loading...</p></div>");
           base_url ='<?php echo base_url();?>';            
        </script> 
    </div> 
    
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<script>  $("#msgbox-error_bk").hide();   $("#success_bk").notify();</script>
<h1 class="page-title">Settings</h1>
<div class="container_12 clearfix" align="center" >
<div class="grid_12">
<br />
<div id="msgbox-error_bk" class="message error closeable" > 
    <span class="message-close"></span>
    <h3>Error!</h3>
    <p></p>                        
</div>
<div id="success_bk" >
    <div id="success-container">
        <a class="ui-notify-close ui-notify-cross" href="#">x</a>
        <div class="with-icon"><img src="#{icon}" alt="success"/></div>
        <h1>#{title}</h1>
        <p>#{text}</p>
    </div>
</div> 
<form class="form has-validation" id="back_up" accept-charset="utf-8">
    <div class="clearfix">
        <label for="form-name" class="form-label">DB Name</label>
        <div class="form-input">
            <input type="text" id="form-name" name="name"  value='db_backup.sql' readonly="readonly"/>
        </div>
    </div>
    <div class="form-action clearfix">
        <button class="button" id="bkp" type="submit">OK</button>
    </div>
</form>
</div>
</div>
<script>
//$("select").uniform();
//$(document).ready(function (){
//    $("#msgbox-error-clients").hide();
//});
$(document).on('click','#bkp',function(event){
     event.preventDefault();
    event.stopImmediatePropagation();
    $.ajax({
        type:"POST",
        url:'main/admin_back_up_db',
        dataType:'json',
        data: $('#back_up').serialize()+'&ajax=1',
        success : function(data){
           if(data.status == 'ok'){
            //$("#success").notify();
//            $("#success").show();
               $("#success_bk").notify("create","success-container",{title: 'Succes', text:data.msg , icon:'template/images/navicons/92.png'}); 
           }else{
               $("#msgbox-error_bk").show().find('p').html(data.msg);
           }
        }
    })
});
</script>
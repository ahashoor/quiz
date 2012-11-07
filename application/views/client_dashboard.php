<div class="ajax-order">
<h1 class="page-title"><?php echo $lang_page_title['dashboard']['h1'];?> </h1>
    <div class="container_12 clearfix leading">
        <section class="portlet grid_12 leading"> 
            <header>
                <h2><?php echo $client_dashboard['welcome'];?> </h2> 
            </header>
            <section>

                    <table class="full"> 
                        <tbody> 
                            <tr> 
                                <td><?php echo $client_dashboard['email_purchased'];?></td> 
                                <td class="ar"><?php echo $dash[0]['emails_permited'];?></td> 
                            </tr> 
                            <tr> 
                                <td><?php echo $client_dashboard['emails_sent'];?></td> 
                                <td class="ar"><?php echo $dash[0]['emails_sent'];?></td> 
                            </tr> 
                            <tr> 
                                <td><?php echo $client_dashboard['members_added'];?></td> 
                                <td class="ar"><?php echo $dash[0]['members'];?></td> 
                            </tr> 
                            <tr> 
                                <td><?php echo $client_dashboard['groups_added'];?></td> 
                                <td class="ar"><?php echo $dash[0]['groups'];?></td> 
                            </tr> 
                            <tr> 
                                <td><?php echo $client_dashboard['quizzes_added'];?></td> 
                                <td class="ar"><?php echo $dash[0]['quizzes'];?></td> 
                            </tr> 
                        </tbody> 
                    </table>
<!--                <center><a href="div.order_emails" class="button order"><?php //echo $client_dashboard['order_emails'];?></a></center>-->
            </section>
        </section>
    </div>

<div style="display: none;">
    <div class="container_12 clearfix order_emails"  >
        <div class="grid_12"><br/>
                <div class="error_order_email message error closeable">
                                <span class="message-close"></span>
                                <h3>Error !</h3>
                                <p></p>                        
                </div>
                <div class="message info closeable" align="left">
                        <span class="message-close"></span>
                        <h3><?php echo $client_dashboard['info']['h3'];?></h3>
                        <p><?php echo $client_dashboard['info']['price'];?></p>
                        <p><?php echo $client_dashboard['info']['l1'];?></p>
                        <p><?php echo $client_dashboard['info']['l2'];?></p>
                </div>
                <form class="form">
                        <div class="clearfix">
                            <label  class="form-label colorbox_form_label"><em> * </em><?php echo $client_dashboard['form']['total_emails'];?></label>
                            <div >
                                    <input type="text" class="emails_nr" value="0" style=" margin-top:10px;"/>
                                    <div class="adding">
                                        <a class="qPlus"><img src="template/images/navicons-small/10.png"></a>
                                        <a class="qMinus"><img src="template/images/navicons-small/135.png"></a>
                                    </div>
                            </div>
                        </div>
                </form>
                <h4> &nbsp;</h4>
                <form class="form" id="card_datails">
                    <div class="clearfix">
                        <label  class="form-label colorbox_form_label"><?php echo $client_dashboard['form']['total_price'];?></label>
                        <div >
                                <input type="text" class="answers_number order_price" value="0 USD" name="total_price"readonly style="width:36%; background: #F7F7F7;box-shadow: none; border: 1px solid #F7F7F7;" />
                        </div>
                    </div>
                    <div class=" clearfix">
                        <label class="form-label colorbox_form_label"><em> * </em><?php echo $client_dashboard['form']['card_nr'];?> <a href="" class="tooltip_box tooltip_card"><span><?php echo $client_dashboard['form']['tooltip1'];?></span> ? </a></label>
                        <div class=" form-row " >
                            <input type="text" size="20" maxlength="20" autocomplete="off" required="required" class="card-number" name="card_number" style="margin-top:10px;" />
                        </div>
                    </div>
                    <div class=" clearfix">
                        <label class="form-label colorbox_form_label"><em> * </em><?php echo $client_dashboard['form']['cvc'];?>
                            <a class="tooltip_box tooltip_card" >
                                <span><?php echo $client_dashboard['form']['tooltip2'];?></span>? 
                            </a>
                        </label>
                        <div class="form-row">
                                <input type="text" size="4" maxlength="3"autocomplete="off" class="card-cvc" name="card_csv" style="margin-top:10px;" />
                        </div>
                    </div>
                    <div class=" clearfix">
                        <label class="form-label colorbox_form_label"><em> * </em><?php echo $client_dashboard['form']['expiration'];?> (MM/YYYY) <a class="tooltip_box tooltip_card"><span><?php echo $client_dashboard['form']['tooltip3'];?></span> ? </a></label>
                        <div>
                                <input type="text" size="2" maxlength="2" class="card-expiry-month" name="card_ex_month"style="margin-top:10px;" />
                            <span> / </span>
                            <input type="text" size="4" maxlength="4"class="card-expiry-year" name="card_ex_year"style="margin-top:10px;" />
                        </div>
                    </div>
                    <div class="form-action clearfix" align="left">
                                <button id="submit_emails_order" class="button"><?php echo $client_dashboard['form']['button_order'];?></button>
                    </div>
                </form>
	</div>
    </div>
</div>

<!-- success order message -->
<div id="success_order" style="display: none;">
             <div id="success-container">
                <a class="ui-notify-close ui-notify-cross" href="#">x</a>
                <div class="with-icon"><img src="#{icon}" alt="success"/></div>
                <h1>#{title}</h1>
                <p>#{text}</p>
             </div>
</div>
</div>
<script type="text/javascript">
   
$(function(){  
     //change language system
    var sess_lang_update='<?php echo $this->session->userdata('lang_update')?>';
    if(sess_lang_update ==="updated"){
     $("select, :checkbox").uniform();
     $("#wrapper > section > section > section > div").css({'position':'relative','width':'96%'})
    }
     var  page_title = '<?php echo $lang_page_title['dashboard']['h1'];?>',
                menu = $.parseJSON('<?php echo json_encode($lang_menu);?>'),
                lang = '<?php echo $this->session->userdata('language')?>';
                members = $.parseJSON('<?php echo json_encode($lang_members);?>');
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
      
    $("#success_order").notify();
    var email_price = '<?php echo $this->config->item('email_price');?>';
    
     //info | error on close click for colorbox resize
    $(document).on("click","span.message-close",function(){
        $(this).closest('div.closeable').hide();
        $.colorbox.resize({inline:true,height:405});
    });
    
    $(document).on("click", "a.order", function(eve){
            $("div.info").show();$(".error_order_email").hide();
            eve.preventDefault();
            eve.stopImmediatePropagation();
            $.colorbox({inline:true, href:$(this).attr('href')});
            $.colorbox.resize({inline:true,width:"55%"})
    });
    
         
    $(document).on("click","div.order_emails a.qPlus",function(eve){
         var n = parseFloat($("div.order_emails input.emails_nr").val());
            eve.stopImmediatePropagation();
            $("div.order_emails input.emails_nr").val(++n);
            $("div.order_emails input.order_price").val((n*email_price).toFixed(1) + ' USD');
    });
    
    $(document).on("click","div.order_emails a.qMinus",function(eve){
         var n = parseFloat($("div.order_emails input.emails_nr").val());
            eve.stopImmediatePropagation();
            $("div.order_emails input.emails_nr").val(--n);
            $("div.order_emails input.order_price").val((n*email_price).toFixed(1) + ' USD');
    });
    
     $(document).on("keyup","input.emails_nr",function(eve){
            eve.stopImmediatePropagation();
            $("div.order_emails input.order_price").val(($(this).val()*email_price).toFixed(1) + ' USD');
    });
    
    $(document).on("click","#submit_emails_order",function(eve){
         eve.preventDefault();
         eve.stopImmediatePropagation();
         var nr = $("div.order_emails input.emails_nr").val(),
             price = $("div.order_emails input.order_price").val(),
             before =parseFloat($("td.ar:first").text()),
             nrEmailsOrder =parseFloat($("div.order_emails input.emails_nr").val());
              $.ajax({type: "POST",url: 'main/payment',dataType:'json',data: $("#card_datails").serialize()+'&emails_nr='+nr,
                    success: function(data) {
                        if(data.status == 'succes'){
                             $.colorbox.close();
                           $("#success_order").notify("create","success-container", {title: 'Succes', text: data.msg ,icon:'template/images/navicons/92.png'});
//                            $(".ajax-order").html("<div id='loading-container' style='margin-top:20%;'><p id='loading-content'><img id='loading-graphic' width='16' height='16' src='template/images/ajax-loader-abc4ff.gif' /> Loading...</p></div>");
//                            $(".ajax-order").load('main/client');

                           $("td.ar:first").text((before)+(nrEmailsOrder));
                                
                           
                            $("form#card_datails :input").val(' ');   
                           
                        }else{
                           $("div.info").hide();
                           $(".error_order_email").show().find('p').html(data.msg);
                            $.colorbox.resize({inline:true});
                        }	
                    }
                });
             
    });
});
</script>

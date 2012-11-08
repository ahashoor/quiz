</div>
<div id="elfinder"></div>
    <!-- MAIN JAVASCRIPTS -->
    <script type="text/javascript" src="template/js/jquery.tools.min.js"></script>
    <script type="text/javascript" src="template/js/jquery.uniform.min.js"></script>
    <script type="text/javascript" src="template/js/jquery.easing.js"></script>
    <script type="text/javascript" src="template/js/jquery.ui.totop.js"></script>
    <script type="text/javascript" src="template/js/jquery.itextsuggest.js"></script>
    <script type="text/javascript" src="template/js/jquery.itextclear.js"></script>
    <script type="text/javascript" src="template/js/jquery.hashchange.min.js"></script>
    <script type="text/javascript" src="template/js/jquery.drilldownmenu.js"></script>
    <script type="text/javascript" src="template/js/jquery.popover.js"></script>
    
    <!-- costum js-->
    <script type="text/javascript" src="template/elfinder/js/elfinder.min.js"></script>
    <script type="text/javascript" src="template/js/jquery.ui.widget.min.js"></script>
    <script type="text/javascript" src="template/js/jquery.notify.js"></script>
    <script type="text/javascript" src="template/js/jquery.colorbox.js"></script>
    <script type="text/javascript" src="template/lib/datatables/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="template/js/jquery.ui.widget.min.js"></script>
    <script type="text/javascript" src="template/js/jquery.autocomplete.js"></script>
    <script type="text/javascript" src="template/js/jquery.wizard.js"></script>
    <script type="text/javascript" src="template/lib/tinymce/jquery.tinymce.js"></script>
    <script type="text/javascript" src="template/js/jquery.autogrowtextarea.js"></script>
    
    <script type="text/javascript" src="template/lib/tinymce/jquery.tinymce.js"></script>
    <script type="text/javascript" src="template/elfinder/js/elfinder.full.js"></script>
       <!--[if lt IE 9]>
    <script type="text/javascript" src="template/lib/jqplot/excanvas.js"></script>
    <![endif]-->
    <script type="text/javascript" src="template/lib/jqplot/jquery.jqplot.min.js"></script>
    <script type="text/javascript" src="template/lib/jqplot/plugins/jqplot.categoryAxisRenderer.min.js"></script>
    <script type="text/javascript" src="template/lib/jqplot/plugins/jqplot.barRenderer.min.js"></script>
    <!--end costum js-->
    <!--[if lt IE 9]>
    <script type="text/javascript" src="template/js/PIE.js"></script>
    <script type="text/javascript" src="template/js/ie.js"></script>
    <![endif]-->

    <script type="text/javascript" src="template/js/global.js"></script>
    <!-- MAIN JAVASCRIPTS END -->

    <!-- LOADING SCRIPT -->
    <script>
    $(window).load(function(){
        $("#loading").fadeOut(function(){
            $(this).remove();
            $('body').removeAttr('style');
        });
    });
    </script>
    <!-- LOADING SCRIPT -->

    <!-- CHANGE LANGUAGE -->
<script>
        
$(function(){
    function updateMessages(){
         
    $.getJSON(base_url+'main/client/inbox/refresh', function(data) {
        console.log(data)
//        $("ul.toolbar li").css({'visibility':'hidden'});
        //messages
        if(data.msg){
                   $("ul.toolbar li").eq(0).show();
                    $("#activity-popover ul").html('');


                    $.each(data.msg, function(i) {
                        var mesaje1 = '<li class="msg"><a class="new_msg" href="main/client/set_message_status/'+this.id+'/messages"> <span class="avatar"></span>'+this.sender_name+'(admin)</a></li>';
                    $("#activity-popover header").text(data.lang.title1)
                    $("#activity-popover ul").append(mesaje1);
                    $("span.messages").text(i+1)

                    });

                    var spanCounter = $("span.messages"),
                            msgNr = spanCounter.text()

                    $("a.new_msg").on("click",function(eve){
                        --msgNr
                        eve.preventDefault();
                        $.colorbox({href:$(this).attr('href')});
                        $.colorbox.resize({inline:true, width:"35%"})
                        if(msgNr >= 1){
                            spanCounter.text(msgNr);
                            $(this).closest('li.msg').hide();
                        }else{
                        $("#activity-button").closest('li').hide();
                        }
                    });  
            }

            //notifications
            if(data.notif){
                 $("ul.toolbar li").eq(1).show();
                    $("#notifications-popover ul").html('');  
                    

                    $.each(data.notif, function(j) {
                        var notific = '<li class="notif"><a class="new_notif" href="main/client/set_message_status/'+this.id+'/notifications"> <span class="avatar"></span>'+this.member_email+' completed quiz</a></li>';
                        $("#notifications-popover header").text(data.lang.title)
                        $("#notifications-popover ul").append(notific);
                        $("span.notifications").text(j+1)

                    });

                    var spanC = $("span.notifications"),
                    notifNr= spanC.text();

                    $("a.new_notif").on("click",function(eve){
                        --notifNr
                        eve.preventDefault();
                        $.colorbox({href:$(this).attr('href')});
                        $.colorbox.resize({inline:true, width:"35%"})

                        if(notifNr >= 1){
                            spanC.text(notifNr);
                            $(this).closest('li.notif').hide();
                        }else{
                            $("#notifications-button").closest('li').hide();
                        }
                    }); 
            }

        setTimeout(updateMessages, 30000);
    });
}
    $("a.change_lang").on("click",function(e){
        e.preventDefault();
        e.stopImmediatePropagation();

        $.ajax({type:"GET",url:$(this).attr("href"),dataType:'json',
            beforeSend:function(){
            $("<div style='background: none repeat scroll 0% 0% white; height: 800px; line-height: 800px;'><div id='loading-container1'><p id='loading-content1'><img id='loading-graphic1' width='16' height='16' src='template/images/ajax-loader-trans.gif' />Loading...</p></div></div>").appendTo("section#main-content")
            },
            success: function(data) {
                    if(data.status == 'succes'){
                            $("section#main-content").load(data.msg);
                    }	
                }
            });
    });

        updateMessages();

    $('#activity-button').popover('#activity-popover', {preventRight: true});
    $('#notifications-button').popover('#notifications-popover', {preventRight: true});  
            
});
</script>
    <!-- CHANGE LANGUAGE -->
<!-- new messages -->
    <div id="activity-popover" class="popover">
        <header>
        </header>
        <section>
            <div class="content">
                <nav><ul></ul></nav>
            </div>
        </section>
    </div>
<!-- new messages -->

<!-- new notifications -->
    <div id="notifications-popover" class="popover">
        <header></header>
        <section>
            <div class="content">
                <nav><ul></ul></nav>
            </div>
        </section>
    </div>
<!-- new notifications -->

    <!-- POPOVERS SETUP END-->

</body>
</html>
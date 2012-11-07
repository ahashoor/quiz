<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<h1 class="page-title"><?php echo $lang_page_title['your_members']['h1'];?> </h1>
<div class="container_12 clearfix" ><br />
    <?php if(isset($error)){?>
        <div id="msgbox-error" class="message error closeable" >
                    <span class="message-close"></span>
                    <p><?php echo $error;?></p>                        
        </div>
    <?php }else{?>
    <!-- messages --> 
        <div class="message info closeable firstInfo">
                <span class="message-close"></span>
                <h3><?php echo $lang_members['info']['h3'];?></h3>
                <p><?php echo $lang_members['info']['p1'];?></p>
                <p><?php echo $lang_members['info']['p2'];?></p>
                <p><?php echo $lang_members['info']['p3'];?></p>
                <p><?php echo $lang_members['info']['p4'];?></p>
        </div>
        <div id="error_members" class="message error closeable"style="display:none;">
                    <span class="message-close"></span>
                    <h3><?php echo $lang_members['errors']['error'];?></h3>
                    <p></p>                        
        </div>
        <div id="success_members" style="display:none;">
             <div id="success-container">
                <a class="ui-notify-close ui-notify-cross" href="#">x</a>
                <div class="with-icon"><img src="#{icon}" alt="success"/></div>
                <h1>#{title}</h1>
                <p>#{text}</p>
             </div>
        </div>
    <!-- messages --> 
     <form id="select_quiz" accept-charset="utf-8">
                    <div style=" float: left; margin-bottom: 10px;">
                            <select id="quiz" name="quiz">
                                <option value="not_set"><?php echo $lang_members['buttons']['b1'];?> </option>
                                <?php foreach($quizes as $quiz):?>
                                <option value="<?php echo $quiz['id']?>"> <?php echo $quiz['quiz_name'];?></option>
                                <?php endforeach;?>
                            </select>
                            <select  id="group_name"name="group_name">
                                <option value="not_set"><?php echo $lang_members['buttons']['b2'];?></option>
                                <?php foreach($groups as $group):?>
                                <option value="<?php echo $group->id?>"> <?php echo $group->name;?></option>
                                <?php endforeach;?>
                            </select>
                    </div>
            
            <div style=" float: right; margin-bottom: 10px;">
                <button  class="dispatchToAll button"><?php echo $lang_members['buttons']['b3'];?></button> 
            </div>
    </form>
    
    <div id="ajax_members">
        <table id="clientsTbl" class="display">
            <thead>
                    <th class="srt"><input id="select-all" type="checkbox" /></th>
                    <th><?php echo $lang_members['table']['th1'];?></th>
                    <th><?php echo $lang_members['table']['th2'];?></th>
                    <th><?php echo $lang_members['table']['th3'];?></th>
                    <th><?php echo $lang_members['table']['th4'];?></th>
                    <th><?php echo $lang_members['table']['th5'];?></th>
                    <th><?php echo $lang_members['table']['th6'];?></th>
                    <th class="action_hide" style="width:90px;"><?php echo $lang_members['table']['th7'];?></th>
            </thead>
            <tbody>
            <?php foreach($members as $member): ?>
                    <tr>
                        <td>
                            <div  class="checker">
                                <span class="second">
                                    <input class="check_member " id="<?php echo $member['id'] ?>"  type="checkbox"  />
                                </span>
                            </div>
                        </td>
                        <td align="center"><?php echo $member['group_name']; ?></td>
                        <td align="center" class="email"><?php echo $member['member_email']; ?></td>
                        <td align="center" class="quiz"><input type="hidden" class="quiz_id" value="<?php echo $member['quize_id'] ?>"/><a class="client_quiz tooltip_new" href="main/client_quiz/view/<?php echo $member['quize_id']?>"><span><?php echo $lang_members['table']['quiz_placeholder'];?></span> <u><?php echo ucfirst($member['quiz_name']); ?></u></a></td>
                        <td align="center"><?php echo $member['dispatched'] ?></td>
                        <td align="center"><?php echo $member['completed'] ?></td>
                        <td align="center"><?php echo $member['added_on']; ?></td>
                        <td align="center">
                            <?php if($member['completed'] > 0):?>
                            <a class="member_status tooltip_new" href="#main/client/member_quiz_status/<?php echo $member['id'] ?>" ><span><?php echo $lang_members['info']['tooltip_quiz_status'];?></span> <img alt="quiz"src="template/images/navicons-small/12.png"/></a> 
                            <?php else:?>
                            <img alt="quiz"src="template/images/navicons-small/image_space.png"/>
                            <?php endif;?>
                            <a class="tooltip_new edit_member" href="div.edit_member"><span><?php echo $lang_members['info']['tooltip_edit'];?></span><img  alt="quiz"src="template/images/navicons-small/165.png"/></a> 
                            <a class="dispatchTo tooltip_new" href="main/client/member_dispatch" ><span><?php echo $lang_members['info']['tooltip_dispatch'];?> </span> <img alt="quiz"src="template/images/navicons-small/18.png"/></a> 
                            <a class="delete_member tooltip_new" href="main/client/delete_member/<?php echo $member['id']; ?>"><span><?php echo $lang_members['info']['tooltip_delete'];?> </span><img  alt="quiz"src="template/images/navicons-small/delete.png"/></a> 
                        </td>
                    </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php }?>
</div>
<div style="display: none;">
    <div class="container_12 clearfix edit_member">
	<div class="grid_12">
		<br />
                <div id="msgbox-error-clients" class="message error closeable">
                        <span class="message-close"></span>
                        <h3><?php echo $lang_members['errors']['error'];?></h3>
                        <p></p>                        
                </div>
                <!-- Info -->
                <div class="message info closeable secondInfo" align="left" >
                    <span class="message-close"></span>
                    <h3><?php echo $lang_members['edit']['h3'];?></h3>
                </div>
		<form class="form has-validation" method="post" id="edit_member">
                        <div class="clearfix">
				<label for="email" class="form-label colorbox_form_label"><?php echo $lang_members['edit']['email_address'];?><em>*</em></label>
				<div class="form-input colorbox_form_input">
					<input type="text" id="form-email" name="email"  placeholder="<?php echo $lang_members['edit']['email_placeholder'];?>"  />
                                        <input type="hidden" id="hidden" />
				</div>
			</div>
			<div class="form-action clearfix" align="left">
				<button id="submit_clients" class="button"><?php echo $lang_members['edit']['button'];?></button>
			</div>
		</form>
	</div>
    </div>
</div>

<script type="text/javascript">
$(function(){
     $("#error_members").hide();   $("#success_members").notify();
    //info | error on close click for colorbox resize
    $(document).on("click","span.message-close",function(){
        $(this).closest('div.closeable').hide();
        $.colorbox.resize({inline:true,height:175});
    });
    
    $(document).on("click","div#error_members span.message-close",function(){
        $("div.firstInfo").show();
    })
    //load edit email colorbox
    $(document).on("click", "a.edit_member", function(eve){
             $("div.secondInfo").show();$("#msgbox-error-clients").hide();
            eve.preventDefault();
            eve.stopImmediatePropagation();
            $.colorbox({inline:true, href:$(this).attr('href')});
            $.colorbox.resize({inline:true});
            var email = $(this).parents('tr').find('td.email').text(),
                id = $(this).parents('tr').find('td input.check_member').attr('id');
            $('div.edit_member').find('input#hidden').val(id)   
            $('div.edit_member').find('input#form-email').val(email)
    });

    //submit edit email
    $("#edit_member").on("submit",function(eve){
        eve.preventDefault();
    var id = $(this).find('input#hidden').val();
        $.ajax({type:"POST",url:'main/client/member_edit/'+id,dataType:'json',data: $("#edit_member").serialize()+'&ajax=edit',
                    success: function(data) {
                        if(data.status == 'succes'){
                            $(window).colorbox.close();
                            var link = "main/client/member_edit/reload";                        
                            $("#success_members").notify("create","success-container",{title: 'Succes', text:data.msg , icon:'template/images/navicons/92.png'});
                            $("#ajax_members").html("<div id='loading-container' style='margin-top:20%;'><p id='loading-content'><img id='loading-graphic' width='16' height='16' src='template/images/ajax-loader-abc4ff.gif' /> Loading...</p></div>");
                            $("#ajax_members").load(link);
                        }else{
                            $("div.secondInfo").hide();$("#msgbox-error-clients").show().find('p').html(data.msg);
                            $.colorbox.resize({inline:true});
                        }	
                    }
        });
    });


    $(document).on("click", "a.member_view", function(eve){
            eve.preventDefault();
            eve.stopImmediatePropagation();
            $.colorbox({href:$(this).attr('href')});
            $.colorbox.resize({inline:true, width:"35%"})
    });


    $(document).on("click", "a.delete_member", function(eve){
            eve.preventDefault();
            eve.stopImmediatePropagation();
            var link = $(this).attr('href'),delete_button = {};
            
            $('#delete-confirm').find('p#err b').html(members.deleteMember.delete_text);
              delete_button[members.deleteMember.button2]=function() {$(this).dialog('close');}
              delete_button[members.deleteMember.button1]=function() {
                    $(this).dialog('close');
                        $.ajax({type: "POST",url: link,dataType:'json',
                            success: function(data) {
                                if(data.status == 'succes'){
                                    $("#ajax_members").html("<div id='loading-container' style='margin-top:20%;'><p id='loading-content'><img id='loading-graphic' width='16' height='16' src='template/images/ajax-loader-abc4ff.gif' /> Loading...</p></div>");
                                    $("#ajax_members").load('main/client/delete_member/reload');
                                    $("#success_members").notify("create","success-container", {title: 'Succes', text: data.msg ,icon:'template/images/navicons/92.png'});
                                }else{
                                    $("#error_members").show().find('p').html(data.msg);
                                }	
                            }
                        });
                };

            $('#delete-confirm').dialog({
                        title:members.deleteMember.title,
                        buttons: delete_button
            });
            $("#delete-confirm").dialog("open");
    });


    //add/change quizes to members
    $(document).on("change", "#quiz", function(event){
            var ids = [];
        $(':input:checkbox:checked').each(function(){
                ids.push($(this).attr('id'));
        });
        $("#error_members").hide();
        event.preventDefault();
        event.stopImmediatePropagation();
        if($("#quiz").val() === 'not_set' ){
            $("div.info").hide();$("#error_members").show().find('p').html('Please select Quiz  for members!');
        }else if(ids.length === 0 ){
            $("div.info").hide(); $("#error_members").show().find('p').html(members.errors.change_quiz);
            $("div#uniform-quiz span").text($("#quiz option:first").text());
            $("#quiz option:first").attr('selected',true);
        }else{
            $.ajax({type: "POST",url: 'main/client/change_on_members',dataType:'json',data: $("#select_quiz").serialize()+'&to='+ids+'&submit= true',
                    success: function(data) {
                        if(data.status == 'succes'){
                            $("div.info").show();
                            $(':checkbox:checked').each(function(){
                                $(this).attr('checked', false);
                                $(this).parent('span').removeClass('checked');
                            }); 
                            $("div#uniform-quiz span").text($("#quiz option:first").text());
                            $("#quiz option:first").attr('selected',true);
                            $("#ajax_members").html("<div id='loading-container' style='margin-top:20%;'><p id='loading-content'><img id='loading-graphic' width='16' height='16' src='template/images/ajax-loader-abc4ff.gif' /> Loading...</p></div>");
                            $("#ajax_members").load('main/client/change_on_members/reload');
                            $("#success_members").notify("create","success-container", {title: 'Succes', text: data.msg ,icon:'template/images/navicons/92.png'});
                        }else{
                            $("#error_members").show().find('p').html(data.msg);
                        }	
                    }
                });
        }
    }); 


    //add/change group to members
    $(document).on("change", "#group_name", function(event){
            var ids = [];
        $(':input:checkbox:checked').each(function(){
                ids.push($(this).attr('id'));
        });
        $("#error_members").hide();
        event.preventDefault();
        event.stopImmediatePropagation();
        if($("#group_name").val() === 'not_set' ){
            $("div.info").hide();$("#error_members").show().find('p').html('Please select Group  for members!')
        }else if(ids.length === 0 ){
            $("div.info").hide(); $("#error_members").show().find('p').html(members.errors.change_group);
            $("div#uniform-group_name span").text($("#group_name option:first").text());
            $("#group_name option:first").attr('selected',true);
        }else{

            $.ajax({type: "POST",url: 'main/client/change_on_members',dataType:'json',data: $("#select_quiz").serialize()+'&to='+ids+'&submit= true',
                    success: function(data) {
                        if(data.status == 'succes'){
                            $("div.info").show();
                            $(':checkbox:checked').each(function(){
                                $(this).attr('checked', false);
                                $(this).parent('span').removeClass('checked');
                                }); 
                            $("div#uniform-group_name span").text($("#group_name option:first").text());
                            $("#group_name option:first").attr('selected',true);    
                            $("#ajax_members").html("<div id='loading-container' style='margin-top:20%;'><p id='loading-content'><img id='loading-graphic' width='16' height='16' src='template/images/ajax-loader-abc4ff.gif' /> Loading...</p></div>");
                            $("#ajax_members").load('main/client/change_on_members/reload');
                            $("#success_members").notify("create","success-container", {title: 'Succes', text: data.msg ,icon:'template/images/navicons/92.png'});
                        }else{
                            $("#error_members").show().find('p').html(data.msg);
                        }	
                    }
                });
            }
    });


    //send email to multy members
    $(document).on("click",'button.dispatchToAll',function(eve){
        eve.preventDefault();
        eve.stopImmediatePropagation();
        $('td.email').removeClass('err'); $("#error_members").hide();
        var ids = [];
        $(':input:checkbox:checked').each(function(){
                ids.push($(this).attr('id'));
        });

        if(ids.length === 0 ){
            $("div.info").hide(); $("#error_members").show().find('p').html(members.errors.dispatch_to_all);
            $("div#uniform-group_name span").text($("#group_name option:first").text());
            $("#group_name option:first").attr('selected',true);
        }else{
            var email = []
            $.each(ids,function(i,v){
                var trIndex = $(':input[id='+v+']').parents('tr').index(),
                quizVal = $('tr').eq(trIndex+1).find('td.quiz a.client_quiz u').text();
                if(quizVal.length < 1){
                    email.push($('tr').eq(trIndex+1).find('td.email').text());
                    $.each(email,function(i,text){
                            $('td.email:contains('+text+')').addClass('err');
                    });
                    $("div.info").hide(); $("#error_members").show().find('p').html(members.errors.dispatch_to_all1);
                }
            });

            if(email.length < 1){
                $("div.info").show();
            $.ajax({type: "POST",url: 'main/client/member_dispatch',dataType:'json',data: $("#select_quiz").serialize()+'&to='+ids+'&ajax=multy',
                    success: function(data) {
                        if(data.status == 'succes'){
                            $("div.info").show();
                            $('input:checkbox:checked').each(function(){
                                $(this).attr('checked', false);
                                $(this).closest('span').removeClass('checked');
                                }); 
                            $("div#uniform-group_name span").text($("#group_name option:first").text());
                            $("#group_name option:first").attr('selected',true);    
                            $("#ajax_members").html("<div id='loading-container' style='margin-top:20%;'><p id='loading-content'><img id='loading-graphic' width='16' height='16' src='template/images/ajax-loader-abc4ff.gif' /> Loading...</p></div>");
                            $("#ajax_members").load('main/client/member_dispatch/reload');
                            $("#success_members").notify("create","success-container", {title: 'Succes', text: data.msg ,icon:'template/images/navicons/92.png'});
                        }else{
                            var t = data.msg.split(',');
                            if(t.length > 1){
                                $("div.info").hide();$("#error_members").show().find('p').html(members.errors.wrong_domain);
                                $.each(t,function(i,v){
                                    $('td.email:contains('+v+')').addClass('err');
                                });
                            }else{
                                $("div.info").hide();$("#error_members").show().find('p').html(data.msg);
                            }
                        }	
                    }
                });
            }
        }
    });

    //send email to one member
    $(document).on("click", "a.dispatchTo", function(eve){
        eve.preventDefault();
        eve.stopImmediatePropagation();
        
        $("#error_members").hide();
        var email = $(this).parents('tr').find('td.email').text(),
            quizVal = $(this).parents('tr').find('td.quiz a.client_quiz u').text(),
            $this = $(this);
                if(quizVal.length < 1){
                    $("div.info").hide(); $("#error_members").show().find('p').html(members.errors.no_quiz+'<b>'+ email +'</b> !');
                }else{
                   var quizID = $(this).parents('tr').find('input.quiz_id').val(),dialog_button = {};
                   $('#delete-confirm').find('p#err b').html(members.dispatch.text+email );
                    dialog_button[members.dispatch.button2]=function() {$(this).dialog('close');}
                    dialog_button[members.dispatch.button1]=function() {
                        $(this).dialog('close');
                        $.ajax({type: "POST",url: 'main/client/member_dispatch',dataType:'json',data: "email="+email+'&quiz_id='+quizID+'&ajax=single',
                            success: function(data) {
                                if(data.status == 'succes'){
                                    $("div.info").show();
                                    $("#ajax_members").html("<div id='loading-container' style='margin-top:20%;'><p id='loading-content'><img id='loading-graphic' width='16' height='16' src='template/images/ajax-loader-abc4ff.gif' /> Loading...</p></div>");
                                    $("#ajax_members").load('main/client/member_dispatch/reload');
                                    $("#success_members").notify("create","success-container", {title: 'Succes', text: data.msg ,icon:'template/images/navicons/92.png'});
                                }else{
                                    $("div.info").hide();$("#error_members").show().find('p').html(data.msg);
                                        $this.parents('tr').find('td.email').addClass('err');
                                }	
                            }
                        });
                    };

                    $('#delete-confirm').dialog({
                        title:members.dispatch.title,
                        buttons: dialog_button
                    });
                    $("#delete-confirm").dialog("open");
               }              
    });

    //preview quiz  
    $(document).on("click",'a.client_quiz',function(eve){
        eve.preventDefault();
        eve.stopImmediatePropagation();
        $.colorbox({href:$(this).attr('href')});
        $.colorbox.resize({height:"85%",width:"65%"});
    });


    //checkbox hack 
    $("#select-all").toggle(
    function () {
        $('#select-all').attr("checked", true);
        $("div.checker span").addClass('checked');
        $("input:checkbox").addClass('checked').attr("checked", true);
    },
    function () {
        $('#select-all').attr("checked", false);
        $("div.checker span").removeClass('checked');
        $("input:checkbox").removeClass('checked').attr("checked", false);
    });

    $(document).on("click", "input:checkbox", function(eve){
        eve.stopImmediatePropagation();
        if($(this).hasClass('checked')){
            $(this).removeClass('checked');
            $(this).closest('span').removeClass('checked');
        }else{
            $(this).addClass('checked');
            $(this).closest('span').addClass('checked');
        }
    });
    
   members = $.parseJSON('<?php echo json_encode($lang_members);?>');
   
 //change language system
    var sess_lang_update='<?php echo $this->session->userdata('lang_update')?>';
   
     var  page_title = '<?php echo $lang_page_title['your_members']['h1'];?>',
                menu = $.parseJSON('<?php echo json_encode($lang_menu);?>'),
                lang = '<?php echo $this->session->userdata('language')?>';
              
    $.each(menu,function(key,val){
        $("span."+key).text(val);
    });
    if(lang =='en'){
        $("a.flag_after img").attr('src','template/images/ro.png');
        $("a.flag_after").attr('href','main/change_lang/ro');
        $('#clientsTbl').dataTable( {"sPaginationType": "full_numbers"});
    }else{
         $("a.flag_after img").attr('src','template/images/en.png');
         $("a.flag_after").attr('href','main/change_lang/en');
         $('#clientsTbl').dataTable( {
                "sPaginationType": "full_numbers",
                "oLanguage":{
                            "sProcessing":   "Proceseaza...",
                            "sLengthMenu":   "Afiseaza _MENU_ inregistrari",
                            "sZeroRecords":  "Nu am gasit nimic - ne pare rau",
                            "sInfo":         "Afisate de la _START_ la _END_ din _TOTAL_ inregistrari",
                            "sInfoEmpty":    "Afisate de la 0 la 0 din 0 inregistrari",
                            "sInfoFiltered": "(filtrate dintr-un total de _MAX_ inregistrari)",
                            "sInfoPostFix":  "",
                            "sSearch":       "Cauta:",
                            "sUrl":          "",
                                    "oPaginate": {
                                        "sFirst":    "Prima",
                                        "sPrevious": "Precedenta",
                                        "sNext":     "Urmatoarea",
                                        "sLast":     "Ultima"
                                    }
                            }
         });
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
});
</script>
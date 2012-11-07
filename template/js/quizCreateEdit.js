 $(function(){
//step2 - after quiz baze complete  
$(".base,.edit_base").on('click',function(){
    var q_nr = $(".quiz_nr_questions").val();
    if($(this).hasClass('edit_base')){
        question_settings(); 
        not= 'edit';
    }else{
        add_question(q_nr)
        question_settings();
        $("button.prev").attr('disabled',true);
        not='';
    }
});

//step3 - after complete answers >> questions        
$('.final,.edit_final').on('click',function (){
       validate_quiz('final');

//prepare the big quiz objects array
    var quiz_name = $("input[name=quiz_name]").val(),
        quiz_category = $("input[name=category]").val(),
        quiz_complete_time = $("input.cTime").val(),
        content = [];
      
    $.each($('.q li.que'),function(ind,value){
        
        var answer = $(value).find('ul li input.answer'),
                a = [];
         
        if($(value).find('input.corect_answer').is(':checkbox')){
            var answer_type = 2;
        }else{
             answer_type = 1;
        } 
         
       $.each(answer,function(i,v){
           var pkAnswer = 'null';
           if($(this).parent().find('input.pk_answer').val()){
                pkAnswer = $(this).parent().find('input.pk_answer').val();
           }
           a.push({
                   answer_value:$(v).val(),
                   corect_answer:check_checked(ind,i),
                   answer_img:$(this).parent().find('a.tooltip_image_answer img').attr('src'),
                   pk_answer:pkAnswer
           });
       })
   
       content.push({
               question_value:$(value).find('label input.question').val(),
               question_img:$(value).find('ul li a.tooltip_image_question img').attr('src'),
               pk_question:$(value).find('label input.pk_question').val(),
               answers:a,
               answer_type:answer_type
           });
    });
    
    var err = $(".invalid");
    if(err.length < 1){
         if($(this).hasClass('edit_final')){
                var url ='main/client_quiz/edit',
                    quiz_id =$("input.quiz_id").val();

                $.ajax({type: "POST",url:url,dataType:'json',data:'quiz_name='+quiz_name+'&quiz_category='+quiz_category+'&quiz_id='+quiz_id+'&quiz_complete_time='+quiz_complete_time+'&content='+JSON.stringify( content )+'&submit=true',
                    success: function(data) {
                            if(data.status == 'succes'){
                                    $("#success_edit_quiz").notify("create","success-container_quiz", {title: 'Succes', text: data.msg,icon:'template/images/navicons/92.png'});
                            }	
                        }
                    });
        }else{
                url ='main/client_quiz/add';

                $.ajax({type: "POST",url:url,dataType:'json',data:'quiz_name='+quiz_name+'&quiz_category='+quiz_category+'&quiz_complete_time='+quiz_complete_time+'&content='+JSON.stringify( content )+'&submit=true',
                success: function(data) {
                        if(data.status == 'succes'){
                                $("#success_create_quiz").notify("create","success-container_quiz", {title: 'Succes', text: data.msg,icon:'template/images/navicons/92.png'});
                        }	
                    }
                });
        }
    };
 });    

//---------- add quiz settings--------------   
function question_settings(){
    var info=[];
    $('input.question').each(function(i){
        var found = $('li.que').eq(i).find("input.corect_answer");
            $(found).attr('name','corect_answer_'+i);
    });
    //button settings
    $(document).on("click","a.settings",function(eve){

            eve.preventDefault();
            eve.stopImmediatePropagation();
            $.colorbox({inline:true, href:$(this).attr('href')});
            $.colorbox.resize({inline:true, width:"55%"});
            $("#cboxClose").hide();
            queIndex = $(this).closest('li.que').index();
             var checkbox = $('li.que').eq(queIndex).find('input:checkbox'),
                 radio    = $('li.que').eq(queIndex).find('input:radio'),
           question_image = $('li.que').eq(queIndex).find('a.tooltip_image_question span img'),
               tQuestions = $('li.que').eq(queIndex).find('input:text.answer').length;
               
              $(".answers_number").val(tQuestions);
              $("div#uniform-answer_type span").text($('#answer_type').find('option:first').text());
              $('#answer_type').find('option:first').attr('selected', true);
              $("input.question_image").val('');
              
                if(checkbox.length > 0 ){
                      $("#answer_type [value='2']").attr("selected",true);
                      $("div#uniform-answer_type span").text($("#answer_type option:selected").text());
                 }
               
                  if(radio.length > 0){
                     $("#answer_type [value='1']").attr("selected",true);
                      $("div#uniform-answer_type span").text($("#answer_type option:selected").text());
                 }
                 
                 if(question_image.length > 0){
                     $("input.question_image").val(question_image.attr('src'));
                 }
    });
    
    //question settings form submit
    $(document).on("click","button#submit_settings",function(e){
        e.preventDefault();
            
        var exist = $("li.que").eq(queIndex).find('li label.corect_answer'),
        answer_nr = $(".quiz_nr_answers").val(),
        answer_type = $("#answer_type").val();
  
        if(exist.length > 0){
                $.each(exist,function(){
                    $(this).remove(); 
                });
        }
        if(answer_type == 1){
            for ( var i=0; i < answer_nr; i++){
                var input ='<label class="corect_answer"><br><div class="radio" id="uniform-corect_answer"><span><input type="radio" id="corect_answer" class="corect_answer" name="corect_ans_'+queIndex+'" style="opacity: 0;"></span></div></label>'
            }$("li.que").eq(queIndex).find('li.answer').append(input);
        }else if(answer_type == 2){
            for ( var i=0; i < answer_nr; i++){
                var input='<label class="corect_answer"><br><div class="checker" id="uniform-corect_answer"><span><input type="checkbox" id="corect_answer" class="corect_answer" style="opacity: 0;"></span></div></label>';
            }$("li.que").eq(queIndex).find('li.answer').append(input);
        } 
                      
        if($(".invalid_popup").length < 1 ){
                $.colorbox.close();
                $(".question_image").val('');
        }
    });
    
    //settings button add new answer
    $(document).on("click",".qPlus",function(event){
        event.stopImmediatePropagation();
            var n = $("div.question_settings input.answers_number").val();n++
          
           var input_b ="<ul class='clearfix '><li class='double answer'><label><div class='space'></div><input type='text' class='full inp answer' placeholder='"+step2.answer_tooltip+' '+n+"' name='answer' required /></label></li></ul>";
            $('li.que').eq(queIndex).append(input_b);
            $("div.question_settings input.answers_number").val(n)
    });
    
    //settings button remove last answer
     $(document).on("click",".qMinus",function(event){
         event.stopImmediatePropagation();
          var n = $("div.question_settings input.answers_number").val(); 
          if(n > 2){n--
            $('li.que').eq(queIndex).find('li.answer').parent().eq(n).remove();
            $("div.question_settings input.answers_number").val(n)
           }
    });
    
    //question add
    $(document).on("click",".plus_question",function(event){
         event.stopImmediatePropagation();
        add_question(1,'plusOne');
    });
    
    //question remove last
     $(document).on("click",".delete_last_question",function(event){
        event.stopImmediatePropagation();
        del_question();
    });
    
    //answer input gallery image
    $(document).on("dblclick","input.answer",function(event){
        event.stopImmediatePropagation();
         elfinder_load($(this),'answer');
    });
    
    //question input gallery image
    $(document).on("dblclick",".question_image",function(event){
        event.stopImmediatePropagation();
          elfinder_load($(this),'question');
    });  
    
    //delete question/answer image
    $(document).on("click","em.delete",function(event){
        event.stopImmediatePropagation();
        $(this).closest("span").effect( 'puff', 1000, callback($(this)) );
        function callback(element) {
                setTimeout(function() {
                        $( element ).closest("a.tooltip_new").replaceWith("<div class='space'></div>");
                }, 1000 );
        };
    });
    
    //info && errors
   $(document).on("click","input:checkbox,input:radio",function(event){
       event.stopImmediatePropagation();
            var e = $(this),
            indx = e.closest('li.que').index(),
        element = $('li.que').eq(indx),
        all_radio = element.find('input:radio');
          
    //checkbox check/uncheck   
    if(e.is(':checkbox:checked')){
         e.parent().addClass('checked');
         element.find('div#uniform-corect_answer').removeClass('invalid');
         element.find("a.settings").removeClass('invalid');
    }else{
         e.parent().removeClass('checked');
    }
    
    //radiobox check/uncheck
    $.each(all_radio,function(r,radio){
        if($(radio).is(':radio:checked')){
            $(radio).parent().addClass('checked');
            element.find('div#uniform-corect_answer').removeClass('invalid');
            element.find("a.settings").removeClass('invalid');
        }else{
            $(radio).parent().removeClass('checked');
        } 
    });
  
    //info for answers with checkboxes
        if(element.find('input[type=checkbox]:checked').length == 1){
            removeByValue(info,indx+1);
            info.push(indx+1);
            var notification = '#quiz_info';
            if(not=='edit'){notification ='#quiz_edit_info';}
            $("#quiz_info").css('display','block')

            $(notification).notify("create","info-container", {title: 'Info', text: step2.info_checkbox+' <b style="margin-left:50px;">'+step2.question+' &raquo;</b> '+info.unique(),icon:'template/images/navicons/171.png'});
                if($(notification).eq(0).children().length > 1){
                    var ez =$(notification).eq(0).children();
                    var lasq_eq = ez.last().index()
                    ez.eq(lasq_eq-1).remove();
                }
        }else{
              $("#quiz_info").css('display','none');
                removeByValue(info,indx+1);
        }
   });
   
   //validate input:text
    $('input:text').on('keyup',function(){
       if($(this).is('input:text')){
            if($(this).val().length > 0){
                $(this).removeClass('invalid');
            }else{
                $(this).addClass('invalid');
            }
        }
    });
}    
    
 function validate_quiz(from){
      //validator
    	var jVal = {
		'cheked' :function (){
                   $('.que input:checkbox, input:radio').each(function(){
                        var indx1 = $(this).closest('li.que').index();
                           
			if($('li.que').eq(indx1).find('input:checked').length === 0) {
                             $(this).closest('div#uniform-corect_answer').addClass('invalid');
			}
                    });
                },
                 'text_checker':function(){
                        $('.que input:text').each(function(){
                            var exist_image_answer = $(this).parent().find('a.tooltip_image_answer');
                        
                            if(exist_image_answer.length > 0 || $(this).val().length > 0){
                                  $(this).removeClass('invalid');
                            }else{
                                  $(this).addClass('invalid');
                            }
                      })
                 }
	 }; 
        if(from == 'final'){jVal.cheked();jVal.text_checker();}
 };
      
//functions
  Array.prototype.unique =
    function() {
        var a = [];
        var l = this.length;
        for(var i=0; i<l; i++) {
        for(var j=i+1; j<l; j++) {
            // If this[i] is found later in the array
            if (this[i] === this[j])
            j = ++i;
        }
        a.push(this[i]);
        }
        return a;
    };
    
    function removeByValue(arr, val) {
        for(var i=0; i<arr.length; i++) {
            if(arr[i] == val) {
                arr.splice(i, 1);
                break;
            }
        }
    }

    function check_checked(ind,i){
       if($('li.que').eq(ind).find('input.corect_answer').eq(i).is(':checked')){
            return 'CORECT';
       }else{
            return'FALSE';
       }
    }
    
    
    function add_question(q_nr,plusOne){
        var total_questions = $("li.que").length,
            answer_nr = $(".quiz_nr_answers").val();
         //questions
          for ( var i=0; i < q_nr; i++ ){
            if(plusOne =='plusOne'){var qN = total_questions+1;}else{qN = i+1;}
                var input ="<li class='que'>\n\
                                <ul class='clearfix'>\n\
                                    <li class='double'>\n\
                                        <label>"+step2.question+"<strong>"+qN+"</strong><span> * </span><br /><div class='space'></div>\n\
                                            <input type='text' class='full question' name='question' placeholder=' "+step2.plus+' '+qN+"'/>\n\
                                        </label><br/>\n\
                                        <label>\n\
                                            <a class='settings button tooltip_new tooltip_client_settings_button' href='.question_settings'>\n\
                                                <span>"+step2.settings_tooltip+"</span>\n\
                                                <img src='template/images/navicons-small/20.png'style='margin:-3px;' alt='settings'/>\n\
                                            </a>\n\
                                        </label>\n\
                                    </li>\n\
                                </ul></li>";
                $('ul.q').append(input+"\n",true);
          }
        //answers
          for ( var j=0; j < answer_nr; j++ ){
                var input_a ="<ul class='clearfix '><li class='double answer'><label><div class='space'></div><input type='text' class='full inp answer' placeholder='"+step2.answer_tooltip+(j+1)+" ' name='answer' required /></label>\n\
                               <label class='corect_answer'><br><div class='radio' id='uniform-corect_answer'><span><input type='radio' id='corect_answer' class='corect_answer' name='corect_ans_'+queIndex+'' style='opacity: 0;'></span></div></label></li></ul>"
                if(plusOne =='plusOne'){$('li.que:last').append(input_a,true);}else{$('li.que').append(input_a,true);}
          }
    }
    
    function del_question(){
         var total_questions = $("li.que").length;
         if(total_questions > 1){
            $("li.que:last").remove();
         }
    }
  
    function elfinder_load(element,to){
        $('<div />').elfinder({
            url : 'main/elfinder_init/quiz',
            lang : 'en',
            toolbar : [['back', 'reload'],['select', 'open','rm'],['upload','quicklook'],['icons','list'] ],
            contextmenu : {
                // Commands that can be executed for current directory
                cwd : ['reload', 'delim', 'upload', 'delim', 'delim', 'info'], 
                // Commands for only one selected file
                file : ['select', 'delim', 'rm', 'delim',  'rename','quicklook'], 
                // Coommands for group of selected files
                group : ['rm'] 
            },
            places:'',
            dialog : {width : 600, modal : true, title:'Your Images Gallery',zIndex:99991},
            editorCallback : function(url) {
                   
                    if(to =='answer'){
                         var exist = $(element).parent().find('a.tooltip_image_answer');
                            //remove div before input
                            $(element).parent().find('div.space').remove();
                      if(exist.length > 0){
                          exist.remove();
                      }
                      $("<a class='tooltip_new tooltip_image_answer'><span><em class='delete'> X </em><img src="+url+" width='200' alt='answer'/></span>Mouse hover to see answer image</a>").insertBefore(element);
                    }
                    if(to =='question'){
                         var question_input = $('.que').eq(queIndex).find('input.question'),
                                      exist = $('.que').eq(queIndex).find('a.tooltip_image_question');
                                      
                         if(exist.length > 0){exist.remove();}
                         $('.que').eq(queIndex).find('div.space:first').remove();
                            element.val(url);
                        
                     var question_input = $('.que').eq(queIndex).find('input.question');
                     $("<a class='tooltip_new tooltip_image_question' ><span><em class='delete'> X </em><img src="+url+" width='200' alt='question'/></span>Mouse hover to see question image </a>").insertBefore(question_input);
                    }
                   
            }
        });
    }
 //completed time slider
  $(function(){
    //edit
    if($("form#quiz_edit").length ==1){
        var tm = $("input.cTime").val(),
            eh = Math.floor(tm/60),
            em = tm% 60;
        $( "#slider" ).slider({
                value:tm,
                min: 0,
                max: 300,
                step: 1,
                slide: function( event, ui ) {
                            var eho = Math.floor(ui.value/60),
                                emi=ui.value% 60;
                        $( ".complete_time" ).val(  eho+" hours : "+emi+" minutes" );
                        $( ".cTime" ).val(ui.value);
                }
        });
    $( ".complete_time" ).val(  eh+" hours : "+em+" minutes" ); 
    }
    //create
    
     $( "#slider_c" ).slider({
            value:0,
            min: 0,
            max: 300,
            step: 1,
            slide: function( event, ui ) {
                        var ho = Math.floor(ui.value/60),
                            mi=ui.value% 60;
                    $( ".complete_time_c" ).val(  ho+" hours : "+mi+" minutes" );
                    $( ".cTime" ).val(ui.value);
            }
    });
   $( ".complete_time_c" ).val(  0+" hours : "+0+" minutes" ); 
   
  });
//----------finish | add quiz settings--------------
 });

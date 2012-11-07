<link rel='stylesheet' href='quize/css/styles.css' />
<link rel='stylesheet' href='quize/countDown/jquery.countdown.css' />

 <input type="hidden" class="test" value="<?php echo $quiz;?>"/>
    <div class="timer clientPreview"></div>
    <div id='quiz-container'></div>
  

  <script type="text/javascript" src="quize/countDown/jquery.countdown.js"></script>
 <script src='quize/js/quiz_test.js'></script>
<script>
$(function(){
    var arr = $.parseJSON('<?php echo json_encode($quiz[0]);?>'),
        lang = $.parseJSON('<?php echo json_encode($lang_quiz['view_quiz']);?>');

    var completedTime='';
    if(arr.complete_time!=null){
        var h = Math.floor(arr.complete_time/60),
            m = arr.complete_time% 60;
            (h > 0)? h = h+lang.h : h ='';
            
            (m > 0)? m = m+lang.m: m='';
        completedTime='<p>'+lang.time+h+m+'</p>';
    }
    
    var q = [];
    $.each(arr.questions, function(i, val) {
        var a =[],cor=[],aimg=[];
        for(var i=0; i < val.answers.length; i++) {
                if(val.answers[i].status =='CORECT'){
                    cor.push(i);
                }
                if(val.answers[i].image !=null){
                    var  image ='<a class="tooltip_answer"><span><img width="350" src="'+val.answers[i].image+'" /></span><img width="20" src="'+val.answers[i].image+'" /></a>';
                    a.push(val.answers[i].answer+'&nbsp;'+image);
                }else{
                    a.push(val.answers[i].answer);
                }
            }
        var qImg='';
        if(val.image!=null){
            qImg = val.image;
        }
        q.push({question:val.question,
                answers:a,
                aImage:aimg,
                image:'<a class="tooltip_question"><span><img width="350" src="'+qImg+'" /></span><img width="50" height="50" src="'+qImg+'" /></a>',
                correctAnswer:cor})
        });

//    var set = {
//        'questions':q,
//        'lang':lang    
//    }

    $('#quiz-container').jquizzy({
                lang:lang,
                questions: q,
                questionsNr:q.length,
                completeTime:arr.complete_time,
                startText: '<p align="center">'+lang.title+'</p><p>'+lang.name+ucfirst(arr.quiz_name)+'</p>\n\
                            <p>'+lang.category+ucfirst(arr.category_name)+'</p>'+completedTime+'<p>'+lang.questions+q.length
        });

        function ucfirst (str) {
            var f = str.charAt(0).toUpperCase();
            return f + str.substr(1);
        }

    $("#counterOut").dialog({autoOpen: false, height:160,width:300});
});


 </script>
 <div id="counterOut" title="Time up">
      <p id="err">
          <span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>your time is finised
      </p>
  </div>

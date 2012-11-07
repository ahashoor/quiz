<html xmlns="http://www.w3.org/1999/xhtml"/>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<link rel='stylesheet' href='<?php echo site_url('quize/css/styles.css')?>' />
<link rel='stylesheet' href='<?php echo site_url('quize/countDown/jquery.countdown.css')?>' />
<link rel="stylesheet" type="text/css" media="screen" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/smoothness/jquery-ui.css">
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script >
            google.load("jquery", "1.7.1");
            google.load("jqueryui", "1.8.16");
              var base_url = '<?php echo base_url(); ?>';
    </script>
 <body> 
     
 <?php if(isset($error)):?> 
  <script>
      $(function(){
        $("#error").dialog({autoOpen: true, height:200,width:350,modal:true,title:'ERROR'});
      });
 </script>
    
   <div id="error" ><p id="err"><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><?php echo $error;?></p></div>
  <?php else:?>   
 <input type="hidden" class="test" value="<?php echo $quiz;?>"/>
 <div class="timer memberPreview"></div>
 <div id='quiz-container'></div>
 <div id="counterOut" ><p id="err"><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>your time is finised</p></div>

 <script type="text/javascript" src="<?php echo site_url('quize/countDown/jquery.countdown.js')?>"></script>
 <?php if($this->session->userdata("language")=="ro"):?>
 <script type="text/javascript" src="<?php echo site_url('quize/countDown/jquery.countdown-ro.js')?>"></script>
 <?php endif;?>

 
 <script src='<?php echo site_url('quize/js/completeQuiz.js')?>'></script>
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
    
    var q = [],warning='';
  $.each(arr.questions, function(i, val) {
        var a =[],cor=[],aimg=[];
        for(var i=0; i < val.answers.length; i++) {
                if(val.answers[i].status =='CORECT'){
                    cor.push(i);
                }
                if(val.answers[i].image != null){
                    var  image ='<a class="tooltip_answer"><span><img width="350" src="'+val.answers[i].image+'" /></span><img width="20" src="'+val.answers[i].image+'" /></a>';
                    a.push(val.answers[i].answer+'&nbsp;'+image);
                }else{
                    a.push(val.answers[i].answer);
                }
            }
        var qImg='';
        if(val.image != null){
            qImg ='<a class="tooltip_question"><span><img width="350" src="'+val.image+'" /></span><img width="50" height="50" src="'+val.image+'" /></a>' ;
        }
       
        if(cor.length > 1){
             warning=lang.info_multiple_answers;
        }
        q.push({question:val.question,
                answers:a,
                aImage:aimg,
                image:qImg,
                correctAnswer:cor})
    });
     $('#quiz-container').jquizzy({
                quizID: arr.id,
                clientID:'<?php echo $client_id;?>',
                memberID:'<?php echo $member_id?>',
                lang:lang,
                questions: q,
                questionsNr:q.length,
                completeTime:arr.complete_time,
                startText: '<p align="center">'+lang.title+'</p><p>'+lang.name+ucfirst(arr.quiz_name)+'</p>\n\
                            <p>'+lang.category+ucfirst(arr.category_name)+'</p>'+completedTime+'<p>'+lang.questions+q.length+'</p>',
                startInfo: lang.info+warning              
        });

        function ucfirst (str) {
            var f = str.charAt(0).toUpperCase();
            return f + str.substr(1);
        }

    $("#counterOut").dialog({autoOpen: false, height:160,width:300});
});


 </script>
 <?php endif;?>
 </body>
</html>
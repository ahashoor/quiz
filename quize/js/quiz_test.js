(function ($) {
    $.fn.jquizzy = function (settings) {
        var defaults = {
            lang:null,
            questions: null,
            startText: 'Let\'s get started!',
            endText: 'Finished!',
            splashImage: base_url+'quize/img/start.png',
            completeTime:null,
            logoImage:base_url+'quize/img/logo.png',
            //twitterImage: 'img/share.png',
            resultComments: {
                perfect: settings.lang.perfect,
                excellent: settings.lang.excellent,
                good: settings.lang.good,
                average: settings.lang.average,
                bad: settings.lang.bad,
                poor: settings.lang.poor,
                worst: settings.lang.worst
            }
        };
        var config = $.extend(defaults, settings);
        if (config.questions === null) {
            $(this).html('<div class="intro-container slide-container"><h2 class="qTitle">Failed to parse questions.</h2></div>');
            return
        }
        var superContainer = $(this),
            answers = [],
            introFob = ' <div class="intro-container slide-container "><img src="'+config.logoImage+'"/><div class="onStartText">' + config.startText + '</div><a class="nav-start" href="#"><img src="' + config.splashImage + '" /></a></div> ',
            exitFob = '<div class="results-container slide-container"><div class="question-number">' + config.endText + '</div><div class="result-keeper"></div></div><div class="progress-keeper" ><div class="progress"></div></div><div class="notice">Please select an option</div>',
            contentFob = '';
        superContainer.addClass('main-quiz-holder');
        for (questionsIteratorIndex = 0; questionsIteratorIndex < config.questions.length; questionsIteratorIndex++) {
            contentFob += '<div class="slide-container"><div class="question-number">' + (questionsIteratorIndex + 1) + '/' + config.questions.length + '</div><div class="question">' + ucfirst(config.questions[questionsIteratorIndex].question)+' ?' +config.questions[questionsIteratorIndex].image+'</div><ul class="answers">';
            for (answersIteratorIndex = 0; answersIteratorIndex < config.questions[questionsIteratorIndex].answers.length; answersIteratorIndex++) {
                contentFob += '<li>' + ucfirst(config.questions[questionsIteratorIndex].answers[answersIteratorIndex]) + '</li>'
          
            }
            
            contentFob += '</ul><div class="nav-container">';
            if (questionsIteratorIndex !== 0) {
                contentFob += '<div class="prev"><a class="nav-previous" href="#">Prev</a></div>'
            }
            if (questionsIteratorIndex < config.questions.length - 1) {
                contentFob += '<div class="next"><a class="nav-next" href="#">Next</a></div>'
            } else {
                contentFob += '<div class="next final"><a class="nav-show-result" href="#">Finish</a></div>'
            }
            contentFob += '</div></div>';
            answers.push(config.questions[questionsIteratorIndex].correctAnswer)
        }

        superContainer.html(introFob + contentFob + exitFob);
        var progress = superContainer.find('.progress'),
            progressKeeper = superContainer.find('.progress-keeper'),
            notice = superContainer.find('.notice'),
            progressWidth = progressKeeper.width(),
            userAnswers = [],
            questionLength = config.questions.length,
            slidesList = superContainer.find('.slide-container');

        function checkAnswers() {
            var resultArr = [],
                flag = false;
            for (i = 0; i < answers.length; i++) {
                if(answers[i].compare(userAnswers[i])) {
                    flag = true
                } else {
                    flag = false
                }
             resultArr.push(flag)
            }
             return resultArr
    
        }
        

	

Array.prototype.compare = function(testArr) {
    if (this.length != testArr.length) return false;
    for (var i = 0; i < testArr.length; i++) {
        if (this[i].compare) { 
            if (!this[i].compare(testArr[i])) return false;
        }
        if (this[i] !== testArr[i]) return false;
    }
    return true;
}


        function roundReloaded(num, dec) {
            var result = Math.round(num * Math.pow(10, dec)) / Math.pow(10, dec);
            return result
        }
        
        function judgeSkills(score) {
            var returnString;
            if (score == 100) return config.resultComments.perfect;
            else if (score > 90) return config.resultComments.excellent;
            else if (score > 70) return config.resultComments.good;
            else if (score > 50) return config.resultComments.average;
            else if (score > 35) return config.resultComments.bad;
            else if (score > 20) return config.resultComments.poor;
            else return config.resultComments.worst
        }
         function liftOff() { 
             $.colorbox.close();
            $("#counterOut").dialog("open");
          
            }
         function ucfirst (str) {
            var f = str.charAt(0).toUpperCase();
            return f + str.substr(1);
        }
        progressKeeper.hide();
        notice.hide();
        slidesList.hide().first().fadeIn(500);
        superContainer.find('li').click(function () {
            var thisLi = $(this);
            if (thisLi.hasClass('selected')) {
                thisLi.removeClass('selected')
            } else {
                thisLi.addClass('selected')
            }
        });
        superContainer.find('.nav-start').click(function () {
            $(".slide-container").css("padding","5px 50px 0");
            $(this).parents('.slide-container').fadeOut(500, function () {
                $(this).next().fadeIn(500);
                progressKeeper.fadeIn(500);
                
            });
            if(config.completeTime!=null){
                $('.timer').countdown({until: +(config.completeTime*60), onExpiry: liftOff});
            }
            return false
        });
        superContainer.find('.next').click(function () {
           
            if ($(this).parents('.slide-container').find('li.selected').length === 0) {
                notice.fadeIn(300);
               
                return false
            }
            notice.hide();
            $(this).parents('.slide-container').fadeOut(500, function () {
                $(this).next().fadeIn(500)
            });
            progress.animate({
                width: progress.width() + Math.round(progressWidth / questionLength)
            }, 500);
            return false
        });
        superContainer.find('.prev').click(function () {
            
            notice.hide();
            $(this).parents('.slide-container').fadeOut(500, function () {
                $(this).prev().fadeIn(500)
            });
            progress.animate({
                width: progress.width() - Math.round(progressWidth / questionLength)
                  
            }, 500);
        
            return false
        });
       
        superContainer.find('.final').click(function () {
            if ($(this).parents('.slide-container').find('li.selected').length === 0) {
                notice.fadeIn(300);
             
                return false
            }
               $('.timer').countdown('pause');
               console.log($('.timer').countdown('getTimes'))
            superContainer.find('ul.answers').each(function (i, val) {
                var t = $(this).find('li.selected'),
                    n =[];
                
                $.each(t,function(j,y){
                    if($(y).parent().index(i)){
                   n.push($(y).index());
                    }
                })
                 userAnswers.push(n);
            });
            progressKeeper.hide();
            var results = checkAnswers(),
                resultSet = '',
                trueCount = 0,
                shareButton = '',
                score;
            for (var i = 0, toLoopTill = results.length; i < toLoopTill; i++) {
                if (results[i] === true) {
                    trueCount++;
                    isCorrect = true
                }
                resultSet += '<div class="result-row"> Question #' + (i + 1) + (results[i] === true ? "<div class='correct'><span>Correct</span></div>" : "<div class='wrong'><span>Incorrect</span></div>");
               
                resultSet += '<div class="resultsview-qhover">' + config.questions[i].question;
                resultSet += "<ul>";
                for (answersIteratorIndex = 0; answersIteratorIndex < config.questions[i].answers.length; answersIteratorIndex++) {
                    var classestoAdd = '';
                   
                    $.each(config.questions[i].correctAnswer,function(ind,v){
                       if (v == answersIteratorIndex ) {
                             classestoAdd += 'right'
                        }
                    });
                    
                    $.each(userAnswers[i],function(o,lov){
                        if (lov == answersIteratorIndex) {
                             classestoAdd += ' selected'
                        }
                    });
                    
                    resultSet += '<li class="' + classestoAdd + '">' + config.questions[i].answers[answersIteratorIndex] + '</li>'
                }
                resultSet += "</ul></div></div>"
            }
            score = roundReloaded(trueCount / questionLength * 100, 2);

            resultSet = '<h2 class="qTitle">' + judgeSkills(score) + settings.lang.score + score + '%</h2>' + shareButton + resultSet;
         
            superContainer.find('.result-keeper').html(resultSet).css('display','table').show(500);
            superContainer.find('.resultsview-qhover').hide();
            superContainer.find('.result-row').hover(function () {
                $(this).find('.resultsview-qhover').show()
            }, function () {
                $(this).find('.resultsview-qhover').hide();
            });
            $(this).parents('.slide-container').fadeOut(500, function () {
                $(this).next().fadeIn(500)
                
            });
            //resize colorbox
            if(config.questions.length > 10){
               var p = config.questions.length -10,
                   v = (p/3)*60,
                   h=$("#cboxWrapper").height()+Math.round(v);
              $.colorbox.resize({height:h});
            }

            return false
        })
    }
})(jQuery);
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
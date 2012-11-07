<h1 class="page-title"><?php echo $lang_page_title['create_quiz']['h1'];?></h1>
<div class="container_12 clearfix dots"><br/>
<div id="success_create_quiz" style="display: none;">
    <div id="success-container_quiz">
            <a class="ui-notify-close ui-notify-cross" href="#">x</a>
            <div class="with-icon"><img src="#{icon}" alt="success"/></div>
            <h1>#{title}</h1>
            <p>#{text}</p>
    </div>
</div> 
<div id="quiz_info" style="display: none;">    
    <div id="info-container">
            <a class="ui-notify-close ui-notify-cross" href="#">x</a>
            <div class="with-icon"><img src="#{icon}" alt="info"/></div>
            <h1>#{title}</h1>
            <p class>#{text}</p>
            
    </div> 
</div>
<!-- Info -->
    <div class="message info closeable" align="left" >
        <span class="message-close"></span>
        <h3><?php echo $lang_quiz['create_quiz']['first']['info'];?></h3>
    </div>
	<section class="portlet grid_12 leading docs">
		<header>
                    <h2><?php echo $lang_quiz['create_quiz']['first']['begin'];?></h2>
                </header>
    	<section>
    		<!-- the form --> 
            <form action="#" id="quiz" novalidate>
            	<div class="wizard"> 
                    <nav>
                        <ul class="clearfix">
                            <li class="active"><strong>1.</strong> <?php echo $lang_quiz['create_quiz']['first']['step_name1'];?></li> 
                            <li><strong>2.</strong> <?php echo $lang_quiz['create_quiz']['first']['step_name2'];?></li> 
                            <li><strong>3.</strong> <?php echo $lang_quiz['create_quiz']['first']['step_name3'];?></li> 
                        </ul>
                    </nav>
                    <div class="items"> 
                        <!-- page1 --> 
                        <section class="first"> 
                            <header> 
                                <h2>
                                    <strong><?php echo $lang_quiz['create_quiz']['first']['step1'];?></strong><?php echo $lang_quiz['create_quiz']['first']['step_name1'];?>
                                </h2>
                            </header> 
                            <section>
                                    <ul class="clearfix">
                                        <li class="double">
                                            <label> 
                                                <strong>1.</strong><?php echo $lang_quiz['create_quiz']['first']['opt1'];?><span>*</span><br /> 
                                                <input type="text" class="full" name="quiz_name" required/> 
                                                <em><?php echo $lang_quiz['create_quiz']['first']['opt1Tip'];?></em> 
                                            </label> 
                                              <label> 
                                                <strong>2.</strong><?php echo $lang_quiz['create_quiz']['first']['opt2'];?> <span>*</span><br /> 
                                                <input type="text" id="autocomplete" class="full" required  name="category"/>
                                                <em><?php echo $lang_quiz['create_quiz']['first']['opt2Tip'];?></em> 
                                            </label> 
                                        </li>
                                        <li class="double"> 
                                            <label> 
                                                <strong>3.</strong><?php echo $lang_quiz['create_quiz']['first']['opt3'];?><span>*</span><br /> 
                                                <select class="full quiz_nr_questions" name="quiz_nr_questions"  required>
                                                    <option value=''>- <?php echo $lang_quiz['create_quiz']['first']['opt3Tip'];?> -</option>
                                                    <?php for($i=1; $i<=10; $i++):?>
                                                    <option value="<?php echo $i;?>"> <?php echo $i;?></option>
                                                    <?php endfor;?>
                                                </select>
                                                <em>&nbsp;</em> 
                                            </label> 
                                            <label> 
                                                <strong>4.</strong><?php echo $lang_quiz['create_quiz']['first']['opt4'];?> <span>*</span><br /> 
                                                <select class="full quiz_nr_answers"  required>
                                                     <option value=''>- <?php echo $lang_quiz['create_quiz']['first']['opt4Tip'];?> -</option>
                                                    <?php for($i=2; $i<=10; $i++):?>
                                                    <option value="<?php echo $i;?>"> <?php echo $i;?></option>
                                                    <?php endfor;?> 
                                                </select>
                                                <em>&nbsp;</em> 
                                            </label> 
                                        </li>
                                        <li>
                                             <label>
                                                <strog>5.</strog><?php echo $lang_quiz['create_quiz']['first']['opt5'];?><br/>
                                                <div id="slider_c"></div>
                                                <em> <?php echo $lang_quiz['create_quiz']['first']['opt5Tip'];?><input type="text" class="complete_time_c" style="border:0; box-shadow: none;" /></em>
                                                 <input type="hidden" class="cTime" value="0" />
                                            </label>
                                        </li>
                                    </ul>
                            </section>
                            <footer class="clearfix">
                                <button type="button" class="next fr base"><?php echo $lang_quiz['create_quiz']['first']['button'];?></button> 
                            </footer>
                        </section> 
             
             <!-- page2 --> 
                        <section class="second"> 
                           
                            <header>
                                <h2>
                                    <strong><?php echo $lang_quiz['create_quiz']['first']['step2'];?></strong><?php echo $lang_quiz['create_quiz']['first']['step_name2'];?> 
                                    <em><?php echo $lang_quiz['create_quiz']['second']['em'];?> </em> 
                                </h2><br/>
                                <div style='display:none' id="settings-error" class="message error closeable"><span class="message-close"></span><p></p></div>
                            </header>
                            <section>
                                <div class="clearfix"> 
                                    <a class="plus_question tooltip_new"><span><?php echo $lang_quiz['create_quiz']['second']['plus'];?> </span><img  src="template/images/navicons-small/10.png"></a>
                                    <a class="delete_last_question tooltip_new"><span><?php echo $lang_quiz['create_quiz']['second']['minus'];?></span><img  src="template/images/navicons-small/135.png"></a>
                                    <em><?php echo $lang_quiz['create_quiz']['second']['p_m'];?></em> 
                                </div>
                                <ul class="clearfix q"></ul>
                            </section>
                            <footer class="clearfix">
                                <button type="button" class="next fr final"><?php echo $lang_quiz['create_quiz']['first']['button'];?></button> 
                            </footer>
                        </section> 
             
                        <!-- page3 --> 
                        <section> 
                            <header> 
                                <h2>
                                    <?php echo $lang_quiz['create_quiz']['third']['h2'];?>
                                    <em></em>
                                </h2>
                            </header> 
                            <section>
                                <h3><?php echo $lang_quiz['create_quiz']['third']['h3'];?></h3>
                            </section>
                             <footer class="clearfix">
                           
                            </footer>
                        </section> 
                    </div><!--items--> 
                </div><!--wizard--> 
            </form>
		
		</section>
	</section>
</div>

<div id="ctlPerson"></div>
<script type="text/javascript">
    $(function(){
         step2 = $.parseJSON('<?php echo json_encode($lang_quiz['create_quiz']['second']);?>');   
    });
</script>
<script type="text/javascript" src="template/js/quizCreateEdit.js"></script>
<script>
$(function(){
    var data = '<?php echo $category;?>'.split(",");
    $('.wizard').wizard();
    $("#success_create_quiz").notify();
    $("#quiz_info").notify();
    $("#autocomplete").autocomplete(data);
});
</script>

<div style='display:none'>
        <div class='question_settings' style='padding:10px; background:#fff;'>
        
        <div class="container_12 clearfix" align="center" >
                <div class="grid_12">
                        <br />
                        <form class="form has-validation" method="post" id="formSettings">
                                
                                <div class="clearfix">
                                        <label for="name" class="form-label"><?php echo $lang_quiz['create_quiz']['second']['settings']['1'];?></label>
                                        <div class="form-input">
                                                <input type="text" class="question_image" name="member_email"  placeholder="<?php echo $lang_quiz['create_quiz']['second']['settings']['question_img_tooltip'];?>"  />
                                        </div>
                                </div>
                                <div class="clearfix">
                                    <label  class="form-label"><?php echo $lang_quiz['create_quiz']['second']['settings']['2'];?></label>
                                    <div class="form-input">
                                            <select name="answer_type" id="answer_type" required>
                                                    <?php foreach($answers_type as $key=>$option):?>
                                                    <option value="<?php echo $key;?>"><?php echo $option;?></option>
                                                    <?php endforeach;?>
                                            </select>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <label  class="form-label"><?php echo $lang_quiz['create_quiz']['second']['settings']['3'];?></label>
                                    <div >
                                         <input type="text" class="answers_number" readonly />
                                         <div class="adding">
                                            <a class="qPlus"><img src="template/images/navicons-small/10.png"></a>
                                            <a class="qMinus"><img src="template/images/navicons-small/135.png"></a>
                                         </div>
                                    </div>
                                </div>
                               
                                <div class="form-action clearfix" align="left">
                                        <button id="submit_settings" class="button"><?php echo $lang_quiz['create_quiz']['second']['settings']['button'];?></button>
                                </div>
                        </form>
                </div>
        </div>
        </div>
</div>

<script>
//change language system
    var sess_lang_update='<?php echo $this->session->userdata('lang_update')?>';
    if(sess_lang_update ==="updated"){
        $('.wizard').wizard();   
        $("select, :checkbox").uniform();
        $("#wrapper > section > section > section > div").css({'position':'relative','width':'100%'})
    }
     var  page_title = '<?php echo $lang_page_title['create_quiz']['h1'];?>',
                menu = $.parseJSON('<?php echo json_encode($lang_menu);?>'),
                lang = '<?php echo $this->session->userdata('language')?>';
              
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
</script>
    <link href="template/firstPage/css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="template/firstPage/js/jquery.parallax-init.js"></script>

<div id="Header">
			<div id="Nav">
				<h1><a href="#Intro"><img src="template/firstPage/images/logo_quiz1.png" alt="Moksha" /></a></h1>
				<ul>
                                    
				    <li><a href="#Features" title="Next Section"><?php echo $lang_login['page']['howItWork']?></a></li>
				    <li><a href="#About" title="Next Section"><?php echo $lang_login['page']['about']?></a></li>
				    <li><a class="login green btn" href="javascript:void(0)" title="Get started now"><?php echo $lang_login['buttons']['but2']?></a></li>
				    <li class="penultimate"><a class="talk_to_us orange btn" id="cont"href="javascript:void(0)" title="Contact"><?php echo $lang_login['contact']['h1']?></a></li>
                                    <li>
                                        <?php if($this->session->userdata("language") == "en"):?>
                                            <a href="index/change_lang/ro" class="change_lang_login" title="Ro"><img src="template/firstPage/images/ro.png" class="flag_index" /></a>
                                        <?php else:?>
                                            <a href="index/change_lang/en" class="change_lang_login" title="En"><img src="template/firstPage/images/en.png" class="flag_index" /></a>
                                        <?php endif;?> 
                                    </li>
				</ul>
			</div>
		</div> <!--Header-->

		<div id="Contact">
			<h4><?php echo $lang_login['contact']['h1']?></h4>
                        <p> <?php echo $lang_login['contact']['info']?></p>
			<div class="center">
                            <div class="message error" style="display: none;"></div>
                            <form id="form_contact">
                                    <input class="name" name="name" placeholder="<?php echo $lang_login['contact']['full_name']?>" type="text" >
                                    <input name="email" type="text" placeholder="<?php echo $lang_login['buttons']['email_placeholder']?>" >
                                    <textarea name="message" placeholder="<?php echo $lang_login['contact']['text']?>"></textarea>
                                    <div class="captcha">
                                    <a href="#" id="reset_captcha"><?php echo $lang_login['contact']['reset']?></a>
                                    <div id="captcha"></div>
                                        <span><?php echo $lang_login['contact']['insert']?> </span>
                                     </div>    
                                    <input type="text" autocomplete="off" id="done" name="captcha" size="40" />
                                    <button id="submit" class="submitContact"><?php echo $lang_login['contact']['button']?></button>
                            </form>
			</div>
			<a href="javascript:void(0)" class="btn close talk_to_us">Close</a>
		</div>
                
                <div id="Login">
			<h4><?php echo $lang_login['buttons']['but2']?></h4>
			<div class="center">
                            <div class="message error" style="display: none;"></div>
                            <form id="form_login">
                                    <input name="email" class="email" placeholder="<?php echo $lang_login['buttons']['email_placeholder']?>" type="text" required>
                                    <input name="password" type="password" placeholder="<?php echo $lang_login['buttons']['password_placeholder']?>" required>
                                    <input id="submit" class="submitLogin"name="submit" type="submit" value="<?php echo $lang_login['buttons']['but2']?>">
                            </form>
			</div>
                        <div class="col">
                            
                            <p>
                                <a href="#" class="create  btn orange" style="color:#000;"><?php echo $lang_login['buttons']['but3']?></a>
                                <a href="#" class="forgot btn orange" style="color:#000;"><?php echo $lang_login['buttons']['but4']?></a>
                            </p>
                        </div>
			<a href="javascript:void(0)" class="btn close login">Close</a>
		</div>
                
                <!--create-->
                <div id="Create">
			<h4><?php echo $lang_login['buttons']['but3']?></h4>
			<div class="center">
                            <div class="message error" style="display: none;"></div>
                            <form class="form" id="formRegister">
                                <input name="full_name"  id="form-name" placeholder="<?php echo $lang_login['create_account']['full_name']?>" type="text" required AUTOCOMPLETE=OFF>
                                <input name="email"  id="email" placeholder="<?php echo $lang_login['buttons']['email_placeholder']?>" type="text" required AUTOCOMPLETE=OFF>
                                <input name="password"  id="password" placeholder="<?php echo $lang_login['buttons']['password_placeholder']?>" type="password" required AUTOCOMPLETE=OFF>
                                <input name="conf_password"  id="conf_password" placeholder="<?php echo $lang_login['buttons']['conf_password_placeholder']?>" type="password" required AUTOCOMPLETE=OFF>
                                <input id="submit" class="submitCreate"  type="submit" value="<?php echo $lang_login['buttons']['but3']?>">
                        </form>
			</div>
			<a href="javascript:void(0)" class="btn close create">Close</a>
		</div>
                
		<!-- forgot -->
                <!-- forgot -->
                <div id="Forgot">
			<h4><?php echo $lang_login['buttons']['but5']?></h4>
                        <p style="font-size:12px;"><?php echo $lang_login['forgot_password']['info']?></p>
			<div class="center">
                            <div class="message error" style="display: none;"></div>
                            <form id="formForgot">
                                    <input class="email" name="email" placeholder="<?php echo $lang_login['buttons']['email_placeholder']?>" type="text"  AUTOCOMPLETE=OFF>
                                    <input id="submit" class="submitForgot" type="submit" value="<?php echo $lang_login['buttons']['but5']?>">
                            </form>
			</div>
			<a href="javascript:void(0)" class="btn close forgot">Close</a>
		</div>
                
                
		<div id="Section1">
			<div id="Intro" class="story">
                            <div class="fixed">
                                    <div  class=" sprite">
                                          <img alt="" class="video_background1" src="template/firstPage/images/section2_slide1_laptop.png" />
                                          <iframe class="video1" name="tsc_player" src="how_its_work/how_its_work_player.html" scrolling="no" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                                    </div>
                                     <div class="intro_right">        
                                                    <p class="ptitle"><?php echo $lang_login['page']['p']?></p>
                                                    <ul>
                                                        <li><p><?php echo $lang_login['page']['li1']?></p></li>
                                                        <li><p><?php echo $lang_login['page']['li2']?></p></li>
                                                        <li><p><?php echo $lang_login['page']['li3']?></p></li>
                                                        <li><p><?php echo $lang_login['page']['li4']?></p></li>
                                                        <li><p><?php echo $lang_login['page']['li5']?></p></li>
                                                        <li><p><?php echo $lang_login['page']['li6']?></p></li>
                                                        <li><p><?php echo $lang_login['page']['li7']?></p></li>
                                                        <li><p><?php echo $lang_login['page']['li8']?></p></li>
                                                    </ul>
                                     </div>
                                     <div class="intro_middle">
                                        <a href="#Features" class="learn_alt green btn"><?php echo $lang_login['page']['howItWork']?></a>
                                    </div>
                             </div>
			</div> <!--.story-->
		</div> <!--Section1-->
<?php if(!empty($how)):?>
		<div id="Section2">
			<div id="Features" class="story">
				<div class="slide_indicator" style="display: none">
					<ul>
						<li class="dir"><a href="#" class="prev">Aliquam tincidunt mauris eu risus.</a></li>
                                                <?php foreach ($how as $key=>$value) :?>
						<li class="ind"><a href="#item<?php echo $key;?>" class="active">Aliquam tincidunt mauris eu risus.</a></li>
                                                   <?php endforeach;?>
						<li class="dir"><a href="#" class="next">Next</a></li>
					</ul>
				</div>
				<div class="slide_container">
					<div class="controls">
						<a class="prev controller" href="javascript:void(0)">Previous</a>
						<a class="next controller" href="javascript:void(0)">Next</a>
					</div>
                                   
					<div class="slide_wrapper">
           <?php foreach ($how as $key=>$value) :?>
						<div id="item<?php echo $key;?>" class="slide start">
							<div class="tagline_slider">
								<p><?php echo $value->h1?></p>
							</div>
              <div class="contents">
                      <a class="grup1" href="<?php echo $value->img1?>"><img alt="" class="FeatureS1-1 sprite f-image" src="<?php echo $value->img1?>" /></a>
                      <a class="grup1" href="<?php echo $value->img2?>"><img alt="" class="FeatureS1-2 sprite s-image" src="<?php echo $value->img2?>" /></a>
                      <div class="t-first  text"><?php echo $value->text1?><em class="arrow-left text"></em></div>
                      <div class="t-second  text"><?php echo $value->text2?><em class="arrow-right text"></em></div>
							</div>
            </div> 
          <?php endforeach;?>
					</div>
				</div>
			</div> <!--.story-->
		</div> <!--Section2-->
<?php endif;?>
		
		<div id="Section4">
			<div id="About" class="story">
                            
				<div class="slide_indicator" style="display: none">
					<ul>
						<li class="dir"><a href="#" class="prev">&nbsp;</a></li>
						<li class="ind"><a href="#about" class="active">&nbsp;</a></li>
						<li class="ind"><a href="#Customers">&nbsp;</a></li>
						<li class="dir"><a href="#" class="next">&nbsp;</a></li>
					</ul>
				</div>
				<div class="slide_container">
					<div class="controls">
						<a class="prev controller" href="javascript:void(0)">Previous</a>
						<a class="next controller" href="javascript:void(0)">Next</a>
					</div>
					<div class="slide_wrapper">
						<div id="about" class="slide start">
							<div class="tagline_slider">
								<p><strong>A few words about us</strong></p>
							</div>
							<div class="contents">
                                                            <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p>
                                                            <p id="team"><strong>The Team</strong></p>
                                                                <img src="template/firstPage/images/team1.png" id="frstimg">
                                                                <img src="template/firstPage/images/team2.png">
                                                                <img src="template/firstPage/images/team3.png">
							</div>
                                                </div> <!--.slide-->

						<div id="Customers" class="slide">
							<div class="tagline_slider">
								<p><strong>Our Client Base</strong></p>
							</div>
							<div class="contents">
								<div class="row center">
									<img src="template/firstPage/images/client.png" alt="My Best Client" />
                                                                        <img src="template/firstPage/images/client.png" alt="My Best Client" />
                                                                        <img src="template/firstPage/images/client.png" alt="My Best Client" />
                                                                        <img src="template/firstPage/images/client.png" alt="My Best Client" />
								</div>
								<div class="row center">
									<img src="template/firstPage/images/client.png" alt="My Best Client" />
                                                                        <img src="template/firstPage/images/client.png" alt="My Best Client" />
                                                                        <img src="template/firstPage/images/client.png" alt="My Best Client" />
                                                                        <img src="template/firstPage/images/client.png" alt="My Best Client" />
								</div>
								<div class="row center">
                                                                        <img src="template/firstPage/images/client.png" alt="My Best Client" />
                                                                        <img src="template/firstPage/images/client.png" alt="My Best Client" />
                                                                        <img src="template/firstPage/images/client.png" alt="My Best Client" />
                                                                        <img src="template/firstPage/images/client.png" alt="My Best Client" />
                                                                </div>
							</div>
                                                </div> <!--.slide-->
					</div>
				</div>
                           
			</div> <!--.story-->
                        
		</div> <!--Section2-->

		
		<div id="Footer">
                     <a href="#Intro" class="to_top btn"><?php echo $lang_login['page']['back']?></a>
			<p>
                            <span class="copy">&copy; 2012 <?php echo $lang_login['page']['copyright']?> QuizCreator.</span>
                            <span class="meta">
                                    <a href="#" class="talk_to_us"><?php echo $lang_login['contact']['h1']?></a>
                                    <a href="http://facebook.com/" >Facebook</a>
                                    <a href="http;//twitter.com">Twitter</a>
                            </span>
			</p>
		</div> <!--Footer-->
                
                
  <script type="text/javascript">
  $(function(){    
   var preloader = "<p class=loader><img  width='16' height='16' src='template/images/ajax-loader-trans.gif' /><b style='color:black; height: 20px; line-height: 20px; position: relative;top:-2px; font-size: 17px;'>Loading . . . </b></p>",
      preloader2 ="<div id='loading'><div id='loading-container'><p id='loading-content'><img id='loading-graphic' width='16' height='16' src='template/images/ajax-loader-trans.gif' />Loading...</p></div></div>";
    $("#success_add").notify();
    $(".submitLogin").on('click',function(event) {
        event.preventDefault();
        event.stopImmediatePropagation();
        $("#form_login .loader").remove();
       $.ajax({
                type: "POST",
                url: 'index/index/true',
                data: $("#form_login").serialize(),
                dataType:'json',
                beforeSend: function(){
                    $(preloader).insertBefore("#form_login input.email");
                },
                success: function(data) {
                    $("#form_login .loader").remove();
                   
                    if(data.status == 'error'){
                            $("#Login div.error").show().html(data.msg).delay(4000).fadeOut(300)
                        }
                        else{
                            $("#Login div.error").removeClass('error').addClass('success').show().html('<?php echo $lang_login['success1'] ;?>').delay(5000).fadeOut(300)
                            window.location =data.msg
                        }
                    }
            });
    });
    
    //submit forgot password form
    $(".submitForgot").click(function(event) {
        event.stopImmediatePropagation();
        event.preventDefault();
         $("#formForgot .loader").remove();
            $.ajax({
                    type: "POST",
                    url: 'register/forgot_password',
                    data: $("#formForgot").serialize()+'&submit= true',
                    dataType:'json',
                    beforeSend: function(){
                        $(preloader).insertBefore("#formForgot input.email");
                    },
                    success: function(data) {
                        $("#formForgot .loader").remove();
                        if(data.status == 'succes'){
                            $("#Forgot").hide();$("#success_add").notify("create","success-container", {title: 'Succes', text: data.msg, icon:'template/images/navicons/92.png'});
                        }else{
                            $("#Forgot div.error").show().html(data.msg).delay(4000).fadeOut(300)
                            }	
                        }
                });
    });
    
    //submit create account form
     $(".submitCreate").click(function(event) {
        event.stopImmediatePropagation();
        event.preventDefault();
        $("#formRegister .loader").remove();
        $.ajax({
                type: "POST",
                url: 'register/index',
                data: $("#formRegister").serialize()+'&submit= true',
                dataType:'json',
                beforeSend: function(){
                    $(preloader).insertBefore("#formRegister #form-name");
                },
                success: function(data) {
                        $("#formRegister .loader").remove();
                    if(data.status == 'succes'){
                          $("#Create").hide();  $("#success_add").notify("create","success-container", {title: 'Succes', text: data.msg, icon:'template/images/navicons/92.png'});
                    }else{
                            $("#Create div.error").show().html(data.msg).delay(4000).fadeOut(300)
                        }	
                    }
            });
    });
      $("#cont").on("click",function(){
         //load captcha
        $.ajax({type: "POST",url: 'index/captcha',data: 'reset=true',dataType:'json',  success: function(msg) {$("#captcha").html(msg.succes);} });
    })
        //submit contact form
     $(".submitContact").click(function(event) {
        event.stopImmediatePropagation();
        event.preventDefault();
        $("#form_contact .loader").remove();
          if($('.invalid_word').length == 0){
                $.ajax({
                        type: "POST",
                        url: 'register/contact',
                        data: $("#form_contact").serialize()+'&submit= true',
                        dataType:'json',
                        beforeSend: function(){
                            $(preloader).insertBefore("#form_contact input.name");
                        },
                        success: function(data) {
                                $("#form_contact .loader").remove();
                            if(data.status == 'succes'){
                                 $("#Contact :input").val('');
                                $("#Contact").hide();  $("#success_add").notify("create","success-container", {title: 'Succes', text: data.msg, icon:'template/images/navicons/92.png'});
                            }else{
                                    $("#Contact div.error").show().html(data.msg).delay(4000).fadeOut(300)
                                }	
                            }
                    });
          }else{
             $("#Contact div.error").show().html('error').delay(4000).fadeOut(300)
          }
    });
    
    $("a.change_lang_login").click(function(e){
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    $.ajax({type:"POST",url:$(this).attr("href"),dataType:'json',
                        beforeSend: function(){
                            $("#login-box").html(preloader2);
                            
                        },
                        success: function(data) {
//                                $("#loading").hide();
                                if(data.status == 'succes'){
                                    $("#login-box").load(data.msg);
                                }	
                            }
                        });
     });


  
    $('#reset_captcha').on('click', function(eve){
            eve.preventDefault();
            eve.stopPropagation();
            var link ='index/captcha';
           
                    $("#captcha").html('<img src="template/images/ajax-loader-abc4ff.gif" style="padding:0;margin:0 0 0 100px;width:30px;"  />');
                    $.ajax({
                                type: "POST",
                                url: link,
                                data: 'reset=true',
                                dataType:'json',
                                success: function(msg) {
                                    if(msg.succes){
                                            $("#captcha").html(msg.succes);
                                    }
                                }    
                            });
              
	});
      //when captcha have 8 characters  
    $('#done').keyup(function(e){
        if($(this).val().length == 8){
           $.ajax({
                    type: "POST",
                    url: 'index/captcha/TRUE',
                    data: 'captcha='+$(this).val(),
                    dataType:'json',
                    success: function(date) {
                        if(date.status =='success'){
                            $('#done').removeClass('invalid_word').addClass('valid_word').val($(this).val());
                           
                            $("#Contact div.error").hide();
                        }else{
                             $('#done').removeClass('valid_word').addClass('invalid_word');
                        }
                    }    
                });
        }
    });               
});   
    </script>
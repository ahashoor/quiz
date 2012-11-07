<?php $this->load->view('include/header');?>
<?php $loged_user_data = $client?>
    <div id="wrapper">
        <header>
            <h1>Quiz Creator</h1>
             
            <nav>
                <div class="container_12">
                    <div class="grid_12 ">
                      <ul class="toolbar clearfix fl">
                          <li style="display: none;">
                                <a href="#"  class="icon-only" id="activity-button">
                                    <img src="template/images/navicons-small/18.png" alt=""/>
                                    <span class="message-count messages"></span>
                                </a>
                            </li>
                            <li style="display: none;">
                                <a href="#" class="icon-only" id="notifications-button">
                                    <img src="template/images/navicons-small/77.png" alt=""/>
                                     <span class="message-count notifications"></span>
                                </a>
                            </li>
                     
                        </ul>
                      
                        <a href="index/logout" title="Logout" class="button logout icon-with-text fr"><img src="template/images/navicons-small/129.png" alt=""/><?php echo $lang_menu['logout'];?></a>
                        
                        <div class="user-info fr">
                            <?php echo $lang_menu['welcome'];?><?php if($loged_user_data->admin == 1){echo " Admin &raquo; ";}?> <?php echo strtoupper($loged_user_data->full_name);?>
                        </div>
                            <?php if($this->session->userdata("language") == "en"):?>
                        <a href="main/change_lang/ro" class="change_lang flag_after " title="Ro"><img src="template/images/ro.png" alt="ro" width="25"/></a>
                            <?php else:?>
                        <a href="main/change_lang/en" class="change_lang flag_after " title="En"><img src="template/images/en.png" alt="en" width="25"/></a>
                            <?php endif;?>
                    </div>
                </div>
            </nav>
        </header>
        <section>
            <!-- Sidebar -->

            <aside> 
                <nav class="drilldownMenu">
                    <h1>
                        <span class="title">Main Menu</span>
                        <button title="Go Back" class="back"><?php echo $lang_menu['back'];?></button>
                    </h1>
                    <ul class="tlm">
                        <?php if($loged_user_data->admin == 1):?>
                        <li >
                            <a href="#main/admin_edit_profile" title="Edit Account">
                                <img src="template/images/navicons/165.png" alt=""/>
                                    <span >Edit Account</span>
                            </a>
                        </li>
                        <li >
                            <a href="#main/admin_view_client" title="Clients">
                                <img src="template/images/navicons/112.png" alt=""/>
                                    <span>Clients</span>
                            </a>
                        </li>
                        <li>
                            <a href="#main/admin_back_up_db" title="BackUP DB">
                                <img src="template/images/navicons/109.png" alt=""/>
                                    <span>Backup Db</span>
                            </a>
                        </li>
                        <li class="hasul"><a href="#" title="Email Settings"><img src="template/images/navicons/20.png" alt=""/><span>Email Settings</span></a>
                            <ul>
                                <li>
                                    <a href="#main/admin_manage_tempates" title="Manage Template">
                                        <img src="template/images/navicons/121.png" alt=""/>
                                            <span>Emails</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#main/admin_all_email_template" title="Email Template">
                                        <img src="template/images/navicons/104.png" alt=""/>
                                            <span>Email Templates </span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="hasul"><a href="#" title="First Page"><img src="template/images/navicons/20.png" alt=""/><span>First Page</span></a>
                            <ul>
                                <li>
                                    <a href="#main/admin_how_its_work" title="Manage how its work">
                                        <img src="template/images/navicons/121.png" alt=""/>
                                            <span>How its work </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" title="Manage how its work">
                                        <img src="template/images/navicons/121.png" alt=""/>
                                            <span>About us </span>
                                    </a>
                                </li>
                                
                            </ul>
                        </li>
                        <li ><a href="#main/client"><img src="template/images/navicons/05.png" alt=""/><span>Dasboard</span></a></li>
                        <?php else: ?>
                        <?php if(isset($message_read)):?>
                        <li ><a href="#main/client/inbox"><img src="template/images/navicons/09.png" alt=""/><span class="inbox"><?php echo $lang_menu['inbox'];?></span></a></li>
                        <?php endif;?>
                        <li ><a href="#main/client/edit_profile"><img src="template/images/navicons/165.png" alt=""/><span class="edit_profile"><?php echo $lang_menu['edit_profile'];?></span></a></li>
                        <li class="hasul"><a href="#" title="Forms"><img src="template/images/navicons/112.png" alt=""/><span class="members"><?php echo $lang_menu['members'];?></span></a>
                            <ul>
                                <li><a href="#main/client/view_members" title="View Members"><img src="template/images/navicons/112.png" alt=""/><span class="your_members"><?php echo $lang_menu['your_members'];?></span></a></li>
                                <li><a href="#main/client/member_add" title="Add Member"><img src="template/images/navicons/10.png" alt=""/><span class="add_member"><?php echo $lang_menu['add_member'];?></span></a></li>
                                <li><a href="#main/client/manage_groups" title="Add Member"><img src="template/images/navicons/165.png" alt=""/><span class="manage_groups"><?php echo $lang_menu['manage_groups'];?></span></a></li>
                            </ul>
                        </li>
                      
                        <li class="hasul"><a href="#" title="Forms"><img src="template/images/navicons/33.png" alt=""/><span class="quizzes"><?php echo $lang_menu['quizzes'];?></span></a>
                            <ul>
                                <li><a href="#main/client_quiz" title="View Members"><img src="template/images/navicons/109.png" alt=""/><span class="your_quizzes"><?php echo $lang_menu['your_quizzes'];?></span></a></li>
                                <li><a href="#main/client_quiz/add"  class="add_quize" title="Add quize"><img src="template/images/navicons/10.png" alt=""/><span class="add_quiz"><?php echo $lang_menu['add_quiz'];?></span></a></li>
                            <?php if(isset($quizzes)):?>
                                <li><a href="#main/client_quiz/top_quizzes" title="Top Quizzes"><img src="template/images/navicons/108.png" alt=""/><span class="top_quizzes"><?php echo $lang_menu['top_quizzes'];?></span></a></li>
                            <?php endif;?>
                            </ul>
                        </li>
                        <li ><a href="#main/client/"><img src="template/images/navicons/05.png" alt=""/><span class="dashboard"> <?php echo $lang_menu['dashboard'];?></span></a></li>
                        <li><a href="#main/client/how_its_works" title="View Members"><img src="template/images/navicons/43.png" alt=""/><span class="how_it_works"><?php echo $lang_menu['how_it_works'];?></span></a></li>
                  <?php endif;?>
                    </ul>
                </nav>
            </aside>

            <!-- Sidebar End -->

            <section>
                <header>
                    <div class="container_12 clearfix">
                        <a href="#menu" class="showmenu button">Menu</a>
                        <h1 class="grid_12"></h1>
                    </div>
                </header>
                <section id="main-content" class="clearfix">
                </section>
                <footer class="clearfix">
                    <div class="container_12">
                        <div class="grid_12 ">
                           Copyright &copy; 2012 | <u class="copyright"><?php echo $lang_menu['copyright'];?></u> | QuizCreator . <p style="float:right;"><u class="created">Created by</u> <a target="_blank" href="http://grigoritaadrian.heliohost.org/">AdrianGrigorita</a> - <a target="_blank" href="http://abutnariu.heliohost.org/">AdrianButnariu</a> </p>
                        </div>
                    </div>
                </footer>
            </section>

            <!-- Main Section End -->
        </section>
    </div>

<?php $this->load->view('include/footer');?>   

<?php
$lang['full_name'] ="Full Name";
$lang['email_address']="Email Address";
$lang['group'] = "Group Name";
$lang['password']="Password";
$lang['conf_password']="Confirm Password";
$lang['message']="Message";

$lang['login']=array(
                'buttons'=>array('email_placeholder'=>'Email : JhonHilton@gmail.com',
                                 'password_placeholder'=>'Password : ****',
                                 'conf_password_placeholder'=>'Confirm Password : ****',
                                 'but1'=>'Keep me logged in',
                                 'but2'=>'Login',
                                 'but3'=>'Create Free Account',
                                 'but4'=>'Forgot Password ?',
                                 'but5'=>'Reset Password'
                    ),
    
                 'create_account'=>array('full_name'=>'Full Name : first name ,last name',
                                         'wrong_domain'=>'Email address have wrong domain'),
                 'forgot_password'=>array('info'=>' » Enter your email address and receive email with new password !'),
                 'contact'=>array('info'=>'If you have questions or problems, do not hesitate, send us your details through this form',
                                  'button'=>'Send',
                                  'h1'=>'Contact Us',
                                  
                                  'full_name'=>'Full Name : first name ,last name',
                                  'text'=>'Message : Add here the details of your problem',
                                  'reset'=>'Reset Word',
                                  'insert'=>'Insert the word you see below'),
                  'success'=>'Your data was succeffuly saved',
                  'success1'=>'You have successfully logged in !',
                  'success2'=>'Your account was successfully activated !',
                  'check'=>', check your email',
                  'activate'=>' , to activate your account',
                  'error'=>'Error !',
                  'error1'=>'This data was not found !',
                  'error2'=>'Check your email to acctivate this account or your account was suspended!',
                  'page'=>array(
                                'about'=>'About Us',
                                'howItWork'=>'How It Works ?',
                                'p'=>'Implemented systems :',
                                'li1'=>'System  create quiz',
                                'li2'=>'System  view quiz',
                                'li3'=>'System  edit quiz',
                                'li4'=>'System  validate sent quizzes  ',
                                'li5'=>'System  members ',
                                'li6'=>'System  Single dispatch  E-mail',
                                'li7'=>'System  Multiple dispatch E-mails ',
                                'li8'=>'System  individual Top quiz ',
                                'back'=>'Back to Top',
                                'copyright'=>'All Rights Reserved.'
                )
);
//meniu and general interface 
$lang['menu'] = array('edit_profile'=>'Account Settings',
                      'members'=>'Members',
                      'your_members'=>'Your Members',
                      'add_member'=>'Add Member',
                      'manage_groups'=>'Manage Groups',
                      'quizzes'=>'Quizzes',
                      'top_quizzes'=>'Top quiz',
                      'your_quizzes'=>'Your Quizzes',
                      'add_quiz'=>'Add Quiz',
                      'dashboard'=>'Dashboard',
                      'how_it_works'=>'How it works',
                      'back'=>'Back',
                      'welcome'=>'Welcome',
                      'logout'=>'Logout',
                      'copyright'=>'All rights reserved',
                      'created'=>'Created by',
                      'inbox'=>'Messages'
);

//dashboard 
$lang['client_dashboard'] = array(
                    "welcome"=>"Welcome to QuizCreator",
                    "email_purchased"=>"Total Emails purchased",
                    "emails_sent" =>"Total Emails sent",
                    "members_added"=>"Total Members added",
                    "groups_added"=>"Total Groups added",
                    "quizzes_added"=>"Total Quizzes added",
                    "order_emails"=>"Order Emails",
                    "info"=>array("h3"=>"Order Emails &raquo; All fields with * are required !",
                                  "price"=>"1 Email = 0.3 USD",
                                  "l1"=>"&raquo; Click on +/-  or type the number to add emails",
                                  "l2"=>"&raquo; The second form , is for your credit card details"),
                    "form"=>array("total_emails"=>"Total emails",
                                  "total_price"=>"Total price",
                                  "card_nr"=>"Card number",
                                  "cvc"=>"CVC",
                                  "expiration"=>"Expiration",
                                  "tooltip1"=>"Type your card number",
                                  "tooltip2"=>"<u>Type the last three-digits</u> <br/> On the back of the card are three-digit number<br/> following the credit card number",
                                  "tooltip3"=>"Type the expiration data month/year",
                                  "button_order"=>"Checkout")
);

//edit client profile
$lang['edit_profile'] =array(
                    'full_name'=>'Change Full Name',
                    'email_address'=>'Change Email Address',
                    'password'=>'Change Password',
                    'reset_pass_placeholder'=>'Add New Password (optional)',
                    'emails_permitted'=>'Emails Permitted',
                    'emails_sent'=>'Emails Sent',
                    'error'=>'There are nothing to change',
                    'info'=>array("h3"=>"Edit Profile » All fields with * are required !",
                                'p'=>'- If you fill Reset Password , the password will be changed with it')
); 

//your members
$lang['your_members']=array(
                    'info'=>array('h3'=>'Quick Help',
                                  'p1'=>'&raquo; <b>Add/Change Quiz</b> - Check the box who is specific to the member(s), then select the Quiz to change on those selected member(s)  or send email with attributed quiz',
                                  'p2'=>'&raquo; <b>Add/Change Group</b> - Check the box who is specific to the member(s), then select the Group to change on those selected member(s)',
                                  'p3'=>'&raquo; <b>Dispatch to all</b> - Check the box who is specific to the member(s), then click to send emails to those member(s) with attributed quiz',
                                  'p4'=>'- To set actions for only one group , type the group name in search box ',
                                  'tooltip_edit'=>'Edit Member',
                                  'tooltip_delete'=>'Delete Member',
                                  'tooltip_quiz_status'=>'View Quiz Status',
                                  'tooltip_dispatch'=>'Dispatch email'
                                    ),
                    'table'=>array('th1'=>'Group',
                                    'th2'=>'Email',
                                    'th3'=>'Quiz',
                                    'th4'=>'Dispatched',
                                    'th5'=>'Copleted',
                                    'th6'=>'Added',
                                    'th7'=>'Actions',
                                    'quiz_placeholder'=>'Click to view quiz'
                                     ),
                    'buttons'=>array('b1'=>'Add/Change Quiz',
                                       'b2'=>'Add/Change Group',
                                       'b3'=>'Dispatch to all selected'
                                      ),
                    'errors'=>array('error'=>'Error !',
                                      'noMembers'=>'There are no members , press <b>Add Members</b> , to add membes !',
                                      'noGroup'=>'There are no groups !' ,
                                      'delete_success'=>'Data was succefully deleted !',
                                      'change_quiz'=>'Please check members to apply the selected Quiz !',
                                      'change_group'=>'Please check members to apply the selected Group !',
                                      'dispatch_to_all'=>'Please check members to Dispatch emails !',
                                      'dispatch_to_all1'=>'Please apply Quiz to members with red color !',
                                      'no_quiz'=>'Please apply Quiz to member ',
                                      'success'=>'Email succefully sent !',
                                      'wrong_domain'=>'Please change the email to members with red color, has wrong domain !',
                                      'emails_left'=>' Emails left !',
                                      'email_finised'=>'Your emails finished',
                                      'order_emails'=>$lang['client_dashboard']['order_emails'],
                                      ),
                    'dispatch'=>array('button1'=>'Dispatch',
                                         'button2'=>'Cancel',
                                         'title'=>'Dispatch email',
                                         'text'=>'Are you sure, <br/>you want to send email to ',
                                      ),
                    'edit'=>array('h3'=>"Edit email &raquo; All fields with * are required !",
                                      'email_address'=>'Email Address' ,
                                      'email_placeholder'=>'JhonHilton@gmail.com',
                                      'button'=>'Edit',
                                      'error'=>'Email already exist !',
                                      'success'=>'Data was succefully saved !'
                                      ),
                     'deleteMember'=>array('title'=>'Delete Member',
                                     'delete_text'=>'These items will be permanently deleted and cannot be recovered.<br/> Are you sure ?',
                                     'button1'=>'Delete',
                                     'button2'=>'Cancel'
                        ),
                     'add_members'=>array('info'=>array('h3'=>"Quick Help &raquo; All fields with * are required !",
                                                        'p1'=>'&raquo; Select the group where your new member will be added !  ',
                                                        'p2'=>'&raquo; Click <b>New Group</b> to add new group !',
                                                        'p3'=>'&raquo; To add new <b>Email Address</b> input , click + !',
                                                        'p4'=>'&raquo; To remove last <b>Email Address</b> input , click - !'
                                                        ),
                                           'buttons'=>array('button1'=>'Save',
                                                            'button2'=>'Add Group',
                                                            'field1'=>'Group Name',
                                                            'field2'=>'Email Address',
                                                            'field2_placeholder'=>'E-mail: JhonHilton@gmail.com',
                                                            'plus_minus_message'=>'Add or delete Email Address',
                                                            'group_name'=>'Group Name',
                                                            'select_group'=>'Select Group'
                                                            )             
                         ),
                      'manage_groups'=>array('h3'=>'Quick Help &raquo; Here you can add new group, edit groups, delete groups!',
                                                'th1'=>'Group Name',
                                                'th2'=>'Acctions',
                                                'delete_title'=>'Delete Group',
                                                'edit_holder'=>'Edit Group',
                                              'delete_holder'=>'Delete Group'
                           )
);

$lang['quiz']= array(
                        'your_quizzes'=>array(
                                                'table'=>array(
                                                    'th1'=>'Quiz Name', 
                                                    'th2'=>'Quiz Category',
                                                    'th3'=>'Quiz Time',
                                                    'th4'=>'Questions',
                                                    'th5'=>'Added',
                                                    'th6'=>'Actions',
                                                    'tip_edit'=>'Edit Quiz',
                                                    'tip_view'=>'View Quiz',
                                                    'tip_del'=>'Delete Quiz',
                                                    'title'=>'Delete Quiz',
                                                    'delete_text'=>'These items will be permanently deleted and cannot be recovered.<br/> Are you sure ?',
                                                    'button1'=>'Delete',
                                                    'button2'=>'Cancel'
                                                ),
                                                
                        ),
                        'create_quiz'=>array(
                              'first'=>array(
                                  'info'=>'Quick help&raquo; All fields with * are required !!' ,
                                  'begin'=>'QuizCreator &raquo; With us , you can create and send quickly , quizzes online  !',
                                  'opt1'=>'Quiz Name',
                                  'opt1Tip'=>'Add your prefered quiz name',
                                  'opt2'=>'Quiz category',
                                  'opt2Tip'=>'Add Category. This field have autocomplete, type -a-',
                                  'opt3'=>'Questions Number',
                                  'opt3Tip'=>'Select number of questions',
                                  'opt4'=>'Number of answers per question',
                                  'opt4Tip'=>'Select number of answers',
                                  'opt5'=>'Add time to complete Quiz(optional)',
                                  'opt5Tip'=>'Actual time test is  &raquo;',
                                  'step1'=>'Step 1 : ',
                                  'step2'=>'Step 2 : ',
                                  'step_name1'=>'Basics of quiz',
                                  'step_name2'=>'Questions &raquo; Answers',
                                  'step_name3'=>'Finish',
                                  'button'=>'Forward',
                                  'button1'=>'Back'
                               ),
                              'second'=>array(
                                  'info_checkbox'=>'On multiple response is recommended to choose more than one answer.<br/>',
                                  'em'=>'Add questions and answers then check the correct answer :',
                                  'plus'=>'Add question',
                                  'minus'=>'Delete last question',
                                  'p_m'=>'Add or delete question',
                                  'question'=>'Question',
                                  'question_placeholder'=>'Add question',
                                  'answer_tooltip'=>'Double click for images gallery / Add answer ',
                                  'settings_tooltip'=>'Question Settings - Set the answer type or add quiestion image',
                                  'settings'=>array(
                                      '1'=>'Question Image',
                                      '2'=>'Answer Type',
                                      '3'=>'Answers per question',
                                      'question_img_tooltip'=>'Double click for images gallery (Optional)',
                                      'button'=>'Add'
                                  )
                              ),
                              'third'=>array(
                                  'success'=>'Congratulations your Quiz was added!',
                                  'error'=>'error',
                                  'h2'=>'<strong>Step 3: </strong> Congratulations your Quiz was registered!',
                                  'h3'=>'Now you can start sending e-mails with the new quiz.<br/> Select member to attach the Quiz !',
                              )
                        ),
                      'top_quiz'=>array(
                             'h3'=>'Quick help &raquo; Select Quiz to see rankings',
                             'select'=>'- Select Quiz -',
                             'th1'=>'Member',
                             'th2'=>'Gruop',
                             'th3'=>'Quiz Name',
                             'th4'=>'Questions',
                             'th5'=>'Score',
                             'th6'=>'Time used',
                             'th7'=>'Completed Data',
                             'th8'=>'Place',
                             'error'=>'At this moment no one completed this Quiz !'
                        ), 
                        'view_quiz'=>array(
                            'title'=>'To begin , click START !',
                            'name'=>'Quiz name &raquo; ',
                            'category'=>'Quiz category &raquo; ',
                            'time'=>'Time to complete &raquo; ',
                            'questions'=>'Number of questions &raquo; ',
                            'h'=>' houers : ',
                            'm'=>' minutes',
                            'perfect'=> 'Albus, is that you?',
                            'excellent'=> 'Outstanding, noble sir!',
                            'good'=> 'Exceeds expectations!',
                            'average'=> 'Acceptable. For a muggle.',
                            'bad'=> 'Well, that was poor.',
                            'poor'=> 'Dreadful!',
                            'worst'=> 'For shame, troll!',
                            'score'=>' Your scored ',
                            'please'=>'Please select an answer',
                            'finale'=>'This Quiz was Finished',
                            'question'=>'Question',
                             'info'=>'<p>To complete this quiz you must tick  answers that you think are correct.</p>',
                            'info_multiple_answers'=>'<i><u> <p> Attention !</p> This Quiz  have questions with multiple correct answers , you must tick more then one answer on some questons !</u></i>' 
                        ) 
);
//h1-title on loaded page 
$lang['lang_page_title'] =array(
            'dashboard'=>array('h1'=>'Dashboard'),
            'how_it_works'=>array('h1'=>'How it work`s'),
            'edit_profile'=>array('h1'=>'Account Settings'),
            'your_members'=>array('h1'=>'Manage your members'),
            'add_member'=>array('h1'=>'Add new members'),
            'manage_groups'=>array('h1'=>'Manage Groups'),
            'manage_your_quiz'=>array('h1'=>'Manage your Quizzes'),
            'create_quiz'=>array('h1'=>'Create Quiz'),
            'edit_quiz'=>array('h1'=>'Edit Quiz'),
            'top_quiz'=>array('h1'=>'Top Quiz'),    
            'inbox'=>array('h1'=>'View your messagess')
);
$lang['date_differance']=array(
                        'year'=>' Year ago',
                        'years'=>' Years ago',
                        'month'=>' Month ago',
                        'months'=>' Monts ago',
                        'day'=>' Day ago',
                        'days'=>' Days ago',
                        'today'=>' Today',
                        
);
$lang['inbox']=array(
                'messages'=>'Old Messages'
);
$lang['notification']=array(
                'quick_help'=>'Quick Help',
                'info'=>'  has completed the quiz received. These are data after filling',
                'email'=>$lang['email_address'],
                'group'=>$lang['group'],
                'quiz_name'=>'Quiz Name',
                'question_nr'=>'Question Number',
                'score'=>'Score',
                'time_used'=>'Used Time',
                'complete_data'=>'Date of completion ',
                'title'=>'Notifications',
                'title1'=>'Messages'
);
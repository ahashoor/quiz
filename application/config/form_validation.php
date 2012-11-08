<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$config = array(
                 'login' => array(
                                    array(
                                            'field' => 'email',
                                            'label' => 'lang:email_address',
                                            'rules' => 'trim|required|valid_email|xss_clean'
                                         ),
                                    array(
                                            'field' => 'password',
                                            'label' => 'lang:password',
                                            'rules' => 'trim|required|xss_clean'
                                         ),
                                    ),
                  'contact'=>array(
                                    array(
                                            'field' => 'name',
                                            'label' => 'lang:full_name',
                                            'rules' => 'trim|required|xss_clean'
                                    ),
                                    array(
                                            'field' => 'email',
                                            'label' => 'lang:email_address',
                                            'rules' => 'trim|required|valid_email|xss_clean'
                                    ),
                                    array(
                                            'field' => 'message',
                                            'label' => 'lang:message',
                                            'rules' => 'trim|required|xss_clean'
                                    ),
                                    array(
                                            'field' => 'captcha',
                                            'label' => 'Word',
                                            'rules' => 'trim|required|xss_clean'
                                    )
                  ),                  
                  'create_account' => array(
                                    array(
                                            'field' => 'full_name',
                                            'label' => 'lang:full_name',
                                            'rules' => 'trim|required|min_length[3]|xss_clean'
                                         ),
                                     array(
                                            'field' => 'email',
                                            'label' => 'lang:email_address',
                                            'rules' => 'trim|required|valid_email|xss_clean'
                                         ),
                                    array(
                                            'field' => 'password',
                                            'label' => 'lang:password',
                                            'rules' => 'trim|required|min_length[3]|matches[conf_password]|xss_clean'
                                         ),
                                     array(
                                            'field' => 'conf_password',
                                            'label' => 'lang:conf_password',
                                            'rules' => 'trim|required|xss_clean'
                                         ),
                                    ),
                  'add_group' => array(
                                    array(
                                            'field' => 'group_name',
                                            'label' => 'lang:group',
                                            'rules' => 'trim|required|min_length[3]|xss_clean'
                                         )
                                    ),
                  'forgot_password' => array(
                                    array(
                                            'field' => 'email',
                                            'label' => 'lang:email_address',
                                            'rules' => 'trim|required|min_length[3]|valid_email|xss_clean'
                                         )
                                    ),
                  'add_member' => array(
                                   array(
                                            'field' => 'group_selected',
                                            'label' => 'lang:group',
                                            'rules' => 'trim|required|xss_clean'
                                         ),
                                    array(
                                            'field' => 'member_email[]',
                                            'label' => 'lang:email_address',
                                            'rules' => 'trim|required|min_length[3]|valid_email|xss_clean'
                                         ) 
                                    ),  
                   'admin_edit_clients' => array(
                                    array(
                                            'field' => 'full_name',
                                            'label' => 'Name',
                                            'rules' => 'trim|required|min_length[3]|xss_clean'
                                        ),
                                    array(
                                            'field' => 'email',
                                            'label' => 'Email',
                                            'rules' => 'trim|required|min_length[3]|valid_email|xss_clean'
                                        )
                                   
                                    ),   
                 'admin_edit_profile' => array(
                                    array(
                                            'field' => 'full_name',
                                            'label' => 'Name',
                                            'rules' => 'trim|required|min_length[3]|xss_clean'
                                        ),
                                   
                                    array(
                                            'field' => 'email',
                                            'label' => 'Email',
                                            'rules' => 'trim|required|min_length[3]|valid_email|xss_clean'
                                        )  
                                                          
                                     ),
                  'client_edit_profile' => array(
                                    array(
                                            'field' => 'full_name',
                                            'label' => 'Name',
                                            'rules' => 'trim|required|min_length[3]|xss_clean'
                                        ),
                                   
                                    array(
                                            'field' => 'email',
                                            'label' => 'Email',
                                            'rules' => 'trim|required|min_length[3]|valid_email|xss_clean'
                                        )  
                                                          
                                     ),
                  'admin_add_email_template' => array(
                                    array(
                                            'field' => 'template_name',
                                            'label' => 'Name',
                                            'rules' => 'trim|required|min_length[3]|xss_clean'
                                        ),
                                    array(
                                            'field' => 'email_subject',
                                            'label' => 'Email Subject',
                                            'rules' => 'trim|required|min_length[3]|xss_clean'
                                        ),
                                    array(
                                            'field' => 'content',
                                            'label' => 'Email Content',
                                            'rules' => 'trim|required|min_length[3]'
                                        )
                                   
                                     ), 
                   'admin_send_message'=>array(
                                    array(
                                            'field' => 'subject',
                                            'label' => 'Subject',
                                            'rules' => 'trim|required|min_length[3]|xss_clean'
                                        ),
                                    array(
                                            'field' => 'message',
                                            'label' => 'Message',
                                            'rules' => 'trim|required|min_length[3]|xss_clean'
                                        )
                                    ),                  
                   'card_datails' => array(
                                    array(
                                            'field' => 'card_number',
                                            'label' => 'Card Number',
                                            'rules' => 'trim|required|numeric|min_length[10]|xss_clean'
                                        ),
                                    array(
                                            'field' => 'card_csv',
                                            'label' => 'CSV',
                                            'rules' => 'trim|required|numeric|min_length[3]|xss_clean'
                                        ),
                                    array(
                                            'field' => 'card_ex_month',
                                            'label' => 'lang:CardExpirationMonth',
                                            'rules' => 'trim|required|numeric|xss_clean'
                                        ),
                                   array(
                                            'field' => 'card_ex_year',
                                            'label' => 'lang:CardExpirationYear',
                                            'rules' => 'trim|required|numeric|xss_clean'
                                        ),
                                   array(
                                            'field' => 'emails_nr',
                                            'label' => 'lang:EmailsNumber',
                                            'rules' => 'trim|required|numeric|greater_than[0]|xss_clean',
                                        ),
                                     ),                   
                                    
               );
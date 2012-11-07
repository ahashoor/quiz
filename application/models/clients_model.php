<?php
class Clients_model extends CI_Model {
 
    function __construct() {
        parent::__construct();
        $this->load->helper('string');
        $this->load->library('email');
        //config email
        $config['useragent'] = 'Code-Igniter-Mailer-^^';
        $config['mailtype'] = 'html';
        $config['charset'] = 'iso-8859-1';
        $config['validate'] = TRUE;
        $config['newline'] = "\r\n";
        $this->email->initialize($config);
        $this->body = '<html><head><meta http-equiv="Content-type" content="text/html; charset=utf-8"></head><body ><div align="center" style="background: #E9E9E9; padding:30px 0;">';
        $this->footer = '</div></body></html>';
        
    }

    public function client($acction = '',$par='',$par1='',$par2=''){
        $lang_member = $this->lang->line('your_members');
        switch ($acction) {
            case 'inbox':
                    if($par1 == 'unread'){
                        $data = $this->db->where(array('client_id'=>$par,'status'=>'0'))->get('qu_messages');
                    }elseif($par1 == 'read'){
                        $data = $this->db->where(array('client_id'=>$par,'status'=>'1'))->get('qu_messages');
                    }
                    if($data->num_rows() >0 ){
                            $data = $data->result_array();
                            $new_array = array();
                            $i=0;
                            
                            foreach ($data as $value) :
                                $new_val =array('added_on'=>$this->dateDiff($value['data'],date("Y-m-d")),
                                                'sender_name'=>$this->db->select('full_name')->where('id',$value['sender_id'])->get('qu_users')->row()->full_name,
                                                );
                                $new_array[]= array_replace($data[$i], $new_val);
                                $i++;
                            endforeach;
                            
                            return $new_array;
                    }else{
                        return NULL;
                    }
                break;
             case 'inbox_notifications':
                   
                    $data = $this->db->where(array('client_id'=>$par,'status'=>'1'))->get('qu_quiz_message');
                   
                    if($data->num_rows() >0 ){
                            $data = $data->result_array();
                            $new_array = array();
                            $i=0;
                            
                            foreach ($data as $value) :
                                $new_val =array(
                                    'added_on' => $this->dateDiff($value['completed_data'],date("Y-m-d")),
                                    'quiz_name' => $this->quizes('get_name',$value['quiz_id']),
                                    'quiz_questions' => $this->db->where('quiz_id',$value['quiz_id'])->count_all_results('qu_questions'),
                                    'member_email' => $this->client('get_member_email',$value['member_id']),
                                    'group_name' => $this->get_by_id('name', $this->get_by_id('group_id', $value['member_id'], 'qu_members'), 'qu_client_groups_assoc')
                                   );
                                $new_array[]= array_replace($data[$i], $new_val);
                                $i++;
                            endforeach;
                            
                            return $new_array;
                    }else{
                        return NULL;
                    }
                 break;
             case 'first_login':
                        $data = array(
                                'client_id'=>$par,
                                'sender_id'=>13,
                                'subject'=>'Welcome',
                                'message'=>'Welcome to Quiz Creator, enjoy your stay on ouer system',
                                'data'=>date('Y-m-d'),
                                'status'=>'1'
                        );
                        $this->db->insert('qu_messages',$data);
                        $this->db->where('id',$par)->update('qu_users',array('first_login'=>'1'));
                 break;
            //edit client profile 
            case 'edit_profile':
                        
                        $password = NULL;
                        $email = NULL;
                        $full_name = NULL;
                        if($this->input->post('new_password')){
                            if($par->password !== md5($this->input->post('new_password'))){
                                $password = $this->input->post('new_password');
                            }
                        }
                        
                        if($par->full_name !== $this->input->post('full_name')){
                                $full_name = $this->input->post('full_name');
                        }
                            
                        if($par->email !== $this->input->post('email')){
                                $data = $this->db->where(array('email'=>$this->input->post('email')))->get('qu_users');
                                if($data->num_rows()>0){
                                    $msg  =array('status'=> 'error','msg'=>$lang_member['edit']['error']);
                                    echo json_encode($msg);die();
                                }else{
                                    $email = $this->input->post('email');
                                }
                        }
                        
                        if( !empty($email) || !empty($password)){
                            $searchArray = array('{{$key_password}}','{{$key_email}}');
                            $replaceArray = array($password,$this->input->post('email'));
                            $message = $this->email_message_template('client_edit_account_settings', $searchArray, $replaceArray);
                            $this->send_emails($this->input->post('email'), 'Quiz Creator - Account Settings', $message);
                        }
                        
                        if( !empty($email)  || !empty($full_name) ){
                            $array = array(
                                'email'=>$this->input->post('email'),
                                'full_name'=>$this->input->post('full_name'),
                            );
                            return $this->db->where('id',$par->id)->update('qu_users',$array);
                        }
                        
                        if( !empty($password) ){
                            $array = array(
                                'password'=>md5($this->input->post('new_password')),
                            );
                            return $this->db->where('id',$par->id)->update('qu_users',$array);
                        }
                        
                        
                break;   
            //create new account
            case 'add_client':
                            $err ='';
                            $lang_login = $this->lang->line('login');
                            
                            $client = array('full_name' =>$this->input->post('full_name'),
                                            'email'=>$this->input->post('email'),
                                            'password'=>md5($this->input->post('password')),
                                            'added' =>date('Y-m-d H:i:s'),
                                            'acctivation_key' =>random_string('unique'),
                                            'first_login'=>0,
                                            'emails_permited'=>10000);
                            
                            //validate if email already exists
                            $email = $this->db->where('email',$client['email'])->get('qu_users');
                            
                            if($email->num_rows() > 0){
                                $msg  =array('status'=> 'error','msg'=>$lang_member['edit']['error']);
                                echo json_encode($msg);die();
                            }
                            
                            if( $this->validate_email($client['email'])!=true){
                                $msg  =array('status'=> 'error','msg'=>$lang_login['create_account']['wrong_domain']);
                                echo json_encode($msg);die();                      
                            }

                            //email settup
                            $templateId = $this->db->where('template_name', 'create_acount')->get('qu_email_assoc')->row('id_template');
                            $content = $this->db->where('id', $templateId)->get('qu_email_template')->row();
                            $url = site_url('register/acctivate_account').'/'.$client['acctivation_key'];
                            
                            $searchArray = array('{{$key_password}}', '{{$key_email}}', '{{$key_url}}');
                            $replaceArray = array($this->input->post('password'),$client['email'],$url);

                            
                           $message = $this->email_message_template('create_acount', $searchArray, $replaceArray);

                            if($this->send_emails($client['email'], $content->email_subject, $message)){
                               return  $this->db->insert('qu_users', $client); 
                            }else{
                                $msg  =array('status'=> 'error','msg'=>$err);
                                echo json_encode($msg);die();
                            }    
                            
                                
                break;
                
            //activate account -- $par = activation key 
            case 'acctivate_account':    
                            $rez = $this->db->where('acctivation_key',$par)->get('qu_users');
                            if($rez->num_rows() > 0){
                                $array = array('status'=>1);
                                return $this->db->where('acctivation_key',$par)->update('qu_users',$array);
                            }else{
                                return FALSE;
                            }
                break;  
                
            //forgot password
            case 'reset_password':
                        $rez = $this->db->where('email',$this->input->post('email'))->get('qu_users');
                        if($rez->num_rows() > 0){
                            $new_pass = random_string('alpha',8);
                            $array = array('password'=>md5($new_pass));
                          
                            $searchArray = array('{{$key_password}}','{{$key_email}}');
                            $replaceArray = array($new_pass,$this->input->post('email'));
                            $message = $this->email_message_template('reset_password', $searchArray, $replaceArray);
                            $this->send_emails($this->input->post('email'), 'Quiz Creator - New Password', $message);
                            
                            return $this->db->where('email',$this->input->post('email'))->update('qu_users',$array);
                        }else{
                            return FALSE;
                        }
                break;
                
            //$par = client_id
            case 'get_members':
                        $data = $this->db->order_by('group_id')->where('client_id',$par)->get('qu_members');
                        if($data->num_rows() >0 ){
                            $data = $data->result_array();
                            $new_array = array();
                            $i=0;
                            
                            foreach ($data as $value) :
                                $new_val =array('added_on'=>$this->dateDiff($value['added'],date("Y-m-d")),
                                                'quiz_name'=>$this->quizes('get_name',$value['quize_id']),
                                                'completed'=>$this->db->where('member_id',$value['id'])->count_all_results('qu_quiz_message'),
                                                'group_name'=>$this->get_by_id('name', $value['group_id'], 'qu_client_groups_assoc'));
                                $new_array[]= array_replace($data[$i], $new_val);
                                $i++;
                            endforeach;
                            
                            return $new_array;
                        }else{
                            return FALSE;
                        }
                break;
                
            //add new member -- $par = client_id
            case 'add_member':
                        $err = '';
                        $err1 ='';
                        foreach($this->input->post('member_email') as $email):
                            if( $this->validate_email($email)!=true):
                                $err .= $email.',';                       
                            endif;
                            
                            $email = $this->db->select('member_email')->where('member_email',$email)->where('client_id',$par)->get('qu_members');
                            if($email->num_rows() > 0){
                                $err1 .= $email->row('member_email').',';
                            }
                        endforeach;
                    
                        
                        if($err != ''){
                            
                             $msg  =array('status'=> 'error','type'=>'wrong_domain','msg'=>$err);
                              echo json_encode($msg);die();
                              
                        }elseif($err1 != ''){
                            
                            $msg  =array('status'=> 'error','type'=>'already_exist','msg'=>$err1);
                            echo json_encode($msg);die();
                            
                        }else{
                            
                            foreach($this->input->post('member_email') as $email1):
                                $member = array('client_id' =>$par,
                                                'group_id' =>$this->input->post('group_selected'),
                                                'member_email'=>$email1,
                                                'added' =>date('Y-m-d H:i:s'));
                                $data = $this->db->insert('qu_members', $member);

                            endforeach;
                        }
                        
                       
                        if($data){
                            return TRUE;
                        }else{
                            return FALSE;
                        }
                break;
                
            //edit member email -- $par = member_id | $par1 = client_id
            case 'edit_member':
                        $data = $this->db->where(array('member_email'=>$this->input->post('email'),'client_id'=>$par1))->get('qu_members');
                        if($data->num_rows()>0){
                            $msg  =array('status'=> 'error','msg'=>$lang_member['edit']['error']);
                            echo json_encode($msg);die();
                        }
                    return $this->db->where('id',$par)->update('qu_members',array('member_email'=>$this->input->post('email')));
                break;
                    
            //delete member -- $par = member_id
            case 'delete_member':  
                    return $this->db->where('id',$par)->delete('qu_members');
                break;
            
            //change to selected members the quiz or the group 
            case 'change_on_members':
                        $to = explode(',', $this->input->post('to'));
                        foreach( $to as $member_id):
                            if($this->input->post('quiz') == 'not_set'){
                                $data =  $this->db->where('id',$member_id)->update('qu_members',array('group_id'=>$this->input->post('group_name')));
                            }else{
                                $data =  $this->db->where('id',$member_id)->update('qu_members',array('quize_id'=>$this->input->post('quiz')));
                            }        
                        endforeach;
                    return $data;
                break;
                
            // return email of member -- $par = member_id   
            case 'get_member_email':
                        $data = $this->db->select('member_email')->where('id',$par)->get('qu_members');
                        if($data->num_rows()>0){
                            return $data->row()->member_email;
                        }else{
                            return FALSE;
                        }
                break; 
            
            // add/view/edit/delete the client groups -- $par = client_id    
            case 'manage_groups':
                        //add
                        if( $par1 == 'add' ){
                            //validate group name
                            $group = $this->db->where('name',$this->input->post('group_name'))->where('client_id',$par)->get('qu_client_groups_assoc');
                            if($group->num_rows() > 0){
                                $msg  =array('status'=> 'error','msg'=>"Group  allredy exist ");
                                echo json_encode($msg);die();
                            }
                            $new_group = array('client_id'=>$par,
                                            'name'=>$this->input->post('group_name'));
                            return $this->db->insert('qu_client_groups_assoc',$new_group);
                        //edit    
                        }elseif( $par1 == 'edit' ){ 
                            //validate group name
                            $group = $this->db->where('name',$this->input->post('group_name'))->where('client_id',$par)->get('qu_client_groups_assoc');
                            if($group->num_rows() > 0){
                                $msg  =array('status'=> 'error','msg'=>"Group  allredy exist ");
                                echo json_encode($msg);die();
                            }
                            return $this->db->where('id',$this->input->post('group_id'))->update('qu_client_groups_assoc',array('name'=>$this->input->post('group_name')));
                        }elseif( $par1 == 'delete' ){
                            $data = $this->db->where('group_id',$this->input->post('group_id'))->get('qu_members');

                            if($data->num_rows()>0){
                                $msg  =array('status'=> 'error','msg'=>"<b>You have Members in this group </b><br/> - change the group for those members then you can delete this group");
                                echo json_encode($msg);die();
                            }else{
                                return $this->db->where('id',$this->input->post('group_id'))->delete('qu_client_groups_assoc');
                            }
                        //get groups    
                        }else{
                            
                            return $this->db->where('client_id',$par)->get('qu_client_groups_assoc')->result();
                        }
                break;
                
            // send email to only one member -- $par = client_id   
            case 'single_dispatch':
                 
                        //if email 
                        if($this->validate_email($this->input->post('email'))==FALSE){
                            echo json_encode(array('status'=>'error','msg'=>$lang_member['errors']['wrong_domain']));die();
                        }else{
                                $user = $this->db->where('id',$par)->get('qu_users')->row();
                               
                                if($user->emails_sent < $user->emails_permited){
                                        $member = $this->db->select('id,dispatched')->where(array('client_id'=>$user->id,'member_email'=>$this->input->post('email')))->get('qu_members')->row(); 
                                        //email settup
                                        $emailTemplateId = $this->db->where('template_name', 'client_send_quiz')->get('qu_email_assoc')->row('id_template');
                                        
                                        $url = site_url('quiz/index/'.$this->input->post('quiz_id')).'/'.$par.'/'.$member->id;
                                        
                                        $content = $this->db->where('id', $emailTemplateId)->get('qu_email_template')->row();

                                        $searchArray = array('{{$key_email}}', '{{$key_url}}');
                                        $replaceArray = array($user->email,$url);
                                        $message = $this->email_message_template('client_send_quiz', $searchArray, $replaceArray);
                                        
                                        
                                        //info, when 10 emails left
                                        $left = ($user->emails_permited - $user->emails_sent)-1;
                                        if($left <= 10){
                                            $this->email->send(); 
                                            $this->email->clear(TRUE);
                                            $this->db->where('id',$par)->update('qu_users',array('emails_sent'=>$user->emails_sent+1));
                                            //update email sent on members table
                                            $this->db->where('id',$member->id)->update('qu_members',array('dispatched'=>$member->dispatched+1));
                                            echo json_encode(array('status'=>'succes','msg'=>$lang_member['errors']['success'].'<br/> <h4 style="color:#71973B">'.$left.$lang_member['errors']['emails_left'].'</h4>'));die();
                                        }else{
                                            $this->db->where('id',$par)->update('qu_users',array('emails_sent'=>$user->emails_sent+1));
                                            //update email sent on members table
                                            $this->db->where('id',$member->id)->update('qu_members',array('dispatched'=>$member->dispatched+1));

                                            return  $this->send_emails($this->input->post('email'), $content->email_subject, $message);
                                        }
                                }else{
                                    echo json_encode(array('status'=>'error','msg'=>$lang_member['errors']['email_finised'].' <a href="#main/client">'.$lang_member['errors']['order_emails'].'</a>'));die(); 
                                }
                    }
                break;
                
            //send multy emails to selected members -- $par = client_id   
            case 'multy_dispatch':
                    $members_ids =  explode(',', $this->input->post('to'));
                    $err = '';
                    //if there is no valid domain name
                    foreach($members_ids as $id):
                        $member_email = $this->get_by_id('member_email', $id, 'qu_members');
                        
                         if($this->validate_email($member_email)==FALSE){
                             $err .= $member_email.','; continue;                        
                           }
                    endforeach;
                    
                   if(empty($err)){
                        $user = $this->db->where('id',$par)->get('qu_users')->row();

                        if($user->emails_sent < $user->emails_permited){
                            foreach($members_ids as $id):
                                $emails_permited = $this->get_by_id('emails_permited', $par, 'qu_users');
                                $emails_sent = $this->get_by_id('emails_sent', $par, 'qu_users');
                                $member_email = $this->get_by_id('member_email', $id, 'qu_members');
                                $quiz_id = $this->get_by_id('quize_id', $id, 'qu_members');
                                $dispatched = $this->get_by_id('dispatched', $id, 'qu_members');
                                //email settup
                                $emailTemplateId = $this->db->where('template_name', 'client_send_quiz')->get('qu_email_assoc')->row('id_template');
                                $url = site_url('quiz/index/'.$quiz_id).'/'.$par.'/'.$id;
                                $content = $this->db->where('id', $emailTemplateId)->get('qu_email_template')->row();
                                $searchArray = array('{{$key_email}}', '{{$key_url}}');
                                $replaceArray = array($user->email,$url);
                                $message = $this->email_message_template('client_send_quiz', $searchArray, $replaceArray);
                                        
                                if($emails_sent <= $emails_permited):
                                        //info, when 10 emails left
                                        $left = ($emails_permited - $emails_sent)-1;
                                        if($left <= 10){
                                                $lefting = $left;
                                                $rez = $this->send_emails($member_email, $content->email_subject, $message); 
                                                if($rez){
                                                    $this->db->where('id',$par)->update('qu_users',array('emails_sent'=>$emails_sent+1));
                                                    //update email sent on members table
                                                    $this->db->where('id',$id)->update('qu_members',array('dispatched'=>$dispatched+1));
                                                    $errRez[] =$rez;
                                                }else{
                                                    $errRez[] = FALSE;
                                                }
                                        }else{
                                                $rez = $this->send_emails($member_email, $content->email_subject, $message); 
                                                if($rez){
                                                    $this->db->where('id',$par)->update('qu_users',array('emails_sent'=>$emails_sent+1));
                                                    //update email sent on members table
                                                    $this->db->where('id',$id)->update('qu_members',array('dispatched'=>$dispatched+1));
                                                    $errRez[] = $rez;
                                                }else{
                                                    $errRez[] = FALSE;
                                                }
                                        }
                                else:
                                        echo json_encode(array('status'=>'error','msg'=>$lang_member['errors']['email_finised'].'<a href="#main/client">'.$lang_member['errors']['order_emails'].'</a>'));die(); 
                                endif;

                                endforeach;
                               
                                    if($errRez):
                                        if(isset($lefting)):
                                            $mesaj = $lang_member['errors']['success'].'<br/> <h4 style="color:#71973B">'.$lefting.$lang_member['errors']['emails_left'].'</h4>';
                                        else:
                                            $mesaj = $lang_member['errors']['success'];
                                        endif;
                                        echo json_encode(array('status'=>'succes','msg'=>$mesaj));die();
                                    else:
                                        return FALSE;
                                    endif;
                        }else{
                            echo json_encode(array('status'=>'error','msg'=>$lang_member['errors']['email_finised'].'<a href="#main/client">'.$lang_member['errors']['order_emails'].'</a>'));die(); 
                        }
                    }else{
                        echo json_encode(array('status'=>'error','msg'=>$err));die();
                    }
                break;
                
            //setup result page - if the member completed the quiz received    
            case 'view_quiz_status':
                    if($par1 != ''):
                        if($par2 =='by_quiz'):
                            $sel = array('client_id'=>$par,'quiz_id'=>$par1);
                        else:
                            $sel = array('client_id'=>$par,'member_id'=>$par1);
                        endif;
                    else:
                        $sel = array('client_id'=>$par);
                    endif;
                    
                    $data =  $this->db->order_by('score','desc')->order_by('completed_time','asc')->where($sel)->get('qu_quiz_message');

                    if($data->num_rows() >0 ):
                        $data = $data->result_array();

                        $new_array = array();
                        $i=0;
                            foreach ($data as $value):
                                $group_id = $this->get_by_id('group_id', $value['member_id'], 'qu_members');
                                $new_val =array('data'=>$this->dateDiff($value['completed_data'],date("Y-m-d")),
                                                'quiz_name'=>$this->quizes('get_name',$value['quiz_id']),
                                                'quiz_questions'=>$this->db->where('quiz_id',$value['quiz_id'])->count_all_results('qu_questions'),
                                                'member_email'=>$this->client('get_member_email',$value['member_id']),
                                                'group_name'=>$this->get_by_id('name', $group_id, 'qu_client_groups_assoc'));
                                $new_array[]= array_replace($data[$i], $new_val);
                                $i++;
                            endforeach;
                            
                        return $new_array;

                    endif;
                        return FALSE;
                break;   
                
           //view the client notifications $par ='single' OR $par = client_id    
            case 'notifications':
                        //for view one message
                        if($par =='single'):
                                    $data = $this->db->where('id',$par1)->get('qu_quiz_message')->row();
                                    $group_id = $this->get_by_id('group_id', $data->member_id, 'qu_members');
                                    $data->data = $this->dateDiff($data->completed_data,date("Y-m-d"));
                                    $data->quiz_name = $this->quizes('get_name',$data->quiz_id);
                                    $data->quiz_questions = $this->db->where('quiz_id',$data->quiz_id)->count_all_results('qu_questions');
                                    $data->member_email = $this->client('get_member_email',$data->member_id);
                                    $data->group_name = $this->get_by_id('name', $group_id, 'qu_client_groups_assoc');
                                return $data;
                        else:
                            //all messagess
                            $data =  $this->db->where(array('client_id'=>$par,'status'=>'0'))->get('qu_quiz_message');
                            if($data->num_rows() >0 ):
                                $data = $data->result_array();
                                $new_array = array();
                                $i=0;

                                foreach ($data as $value):
                                    $new_val =array('member_email'=>$this->client('get_member_email',$value['member_id']));
                                    $new_array[]= array_replace($data[$i], $new_val);
                                    $i++;
                                endforeach;

                                return $new_array;
                            endif;

                            return FALSE;

                        endif;
                    break;
                    
              //view the client messages $par ='single' OR $par = client_id    
            case 'messages':
                        //for view one message
                        if($par =='single'):
                            $data = $this->db->where('id',$par1)->get('qu_messages');
                            if($data->num_rows() >0 ):
                                $data = $data->result_array();
                                $new_array = array();
                                $i=0;

                                foreach ($data as $value):
                                    $new_val =array('name'=>$this->get_by_id('full_name', $value['sender_id'], 'qu_users'),
                                                    'admin'=>$this->get_by_id('admin', $value['sender_id'], 'qu_users'),
                                                    'added_on'=>$this->dateDiff($value['data'],date("Y-m-d")),
                                        );
                                    $new_array[]= array_replace($data[$i], $new_val);
                                    $i++;
                                endforeach;

                                return $new_array[0];
                            endif;

                            return FALSE;
                                    
                        else:
                            //all messagess
                            $data =  $this->db->where(array('client_id'=>$par,'status'=>'0'))->get('qu_messages');
                            if($data->num_rows() >0 ):
                                $data = $data->result_array();
                                $new_array = array();
                                $i=0;

                                foreach ($data as $value):
                                    $new_val =array('name'=>$this->get_by_id('full_name', $value['sender_id'], 'qu_users'),
                                                    'admin'=>$this->get_by_id('admin', $value['sender_id'], 'qu_users')
                                        );
                                    $new_array[]= array_replace($data[$i], $new_val);
                                    $i++;
                                endforeach;

                                return $new_array;
                            endif;

                            return FALSE;

                        endif;
                    break;
                    
              //update the payment order -- recive new emails  (not completed)    
              case 'email_order':
                   $emails_p =  $this->db->select('emails_permited')->where('id',$par)->get('qu_users')->row()->emails_permited;
                   $new_emails_nr = $emails_p + $this->input->post('emails_nr');
                   return $this->db->where('id',$par)->update('qu_users',array('emails_permited'=>$new_emails_nr));
                   
                   break;
            //setup dashboard -- $par = client_id 
            default:
                    $data = $this->db->where('id',$par->id)->get('qu_users');
                    if($data->num_rows() >0 ):
                        $data = $data->result_array();
                        $new_array = array();
                        $i=0;
                        foreach ($data as $value) {
                            $new_val =array('groups'=>$this->db->where('client_id',$value['id'])->count_all_results('qu_client_groups_assoc'),
                                            'members'=>$this->db->where('client_id',$value['id'])->count_all_results('qu_members'),
                                            'quizzes'=>$this->db->where('client_id',$value['id'])->count_all_results('qu_quiz_assoc'));
                            $new_array[]= array_replace($data[$i], $new_val);
                            $i++;
                        }
                        return $new_array;
                    endif;
                 return FALSE;
                break;
        }
    }
    
    
    public function quizes($acction='',$client_id='',$quiz_id=''){
        switch ($acction) {
            
            //add new quiz
            case 'add'://check if category exist, else, add new one
                        $data = $this->db->select('id')->where('category_name',trim($this->input->post('quiz_category')))->get('qu_categories');
                        if($data->num_rows() < 1){
                            $this->db->insert('qu_categories',array('category_name'=>trim($this->input->post('quiz_category'))));
                            $category_id = $this->db->insert_id();
                        }else{
                            $category_id= $data->row()->id;
                        }

                        if($this->input->post('quiz_complete_time') < 1){$time  = NULL;}else{$time=$this->input->post('quiz_complete_time');}
                        //insert quiz base
                        $quiz = array('category_id' =>$category_id,
                                      'quiz_name' =>trim($this->input->post('quiz_name')),
                                      'complete_time'=>$time,
                                      'added'=>date('Y-m-d'));
                        $this->db->insert('qu_quiz',$quiz);

                        $quiz_id = $this->db->insert_id();
                        $assoc = array(
                                        'client_id'=>$client_id,
                                        'quiz_id'=>$quiz_id,
                                        'status'=>'created'
                                    );
                        $this->db->insert('qu_quiz_assoc',$assoc);


                        //insert questions
                        $content = json_decode($this->input->post('content'));

                        $i = 1;
                        foreach($content as $question):
                            if(!isset($question->question_img)){$question->question_img = NULL;}
                            $q_without_asking_mark = str_replace('?', ' ', $question->question_value);
                            $q_new = htmlspecialchars($q_without_asking_mark, ENT_QUOTES);
                            $que = array('quiz_id' =>$quiz_id,
                                        'question'=>$q_new,
                                        'answer_type'=>$question->answer_type,
                                        'image'=>$question->question_img,
                                        'order'=>$i);

                            $this->db->insert('qu_questions',$que);
                            $question_id = $this->db->insert_id();
                            //insert answers

                                $j=1;
                                foreach($question->answers as $answer):
                                    if(!isset($answer->answer_img)){$answer->answer_img = NULL;}
                                    $new_answer = htmlspecialchars($answer->answer_value, ENT_QUOTES);
                                    $ans = array('question_id'=>$question_id,
                                                'answer'=>$new_answer,
                                                'status'=>$answer->corect_answer,
                                                'image'=>$answer->answer_img,
                                                'order'=>$j);
                                $error = $this->db->insert('qu_answers',$ans);
                                $j++;
                                endforeach;

                        $i++;   
                        endforeach;

                        return $error;  

                break;
                
            case 'edit'://check if category exist, else, add new one
                        $data = $this->db->select('id')->where('category_name',trim($this->input->post('quiz_category')))->get('qu_categories');
                        if($data->num_rows() < 1){
                            $this->db->insert('qu_categories',array('category_name'=>trim($this->input->post('quiz_category'))));
                            $category_id = $this->db->insert_id();
                        }else{
                            $category_id= $data->row()->id;
                        }

                        if($this->input->post('quiz_complete_time') < 1){$time  = NULL;}else{$time=$this->input->post('quiz_complete_time');}
                        
                        
                        //verific daca quizul a fost atribuit atunci la edit va crea un quiz nou cu datele lui,
                        // pentru a nu modifica datele quizului atribuit, daca a fost creat de el, poate sa il editeze 
                        
                        $status = $this->db->select('status')->where(array('quiz_id'=>$quiz_id,'client_id'=>$client_id))->get('qu_quiz_assoc')->row()->status;
                        if($status =='created'){
                                //update quiz base
                                $quiz = array('category_id' =>$category_id,
                                            'quiz_name' =>trim($this->input->post('quiz_name')),
                                            'complete_time'=>$time);
                                $this->db->where('id',$quiz_id)->update('qu_quiz',$quiz);

                                //update questions
                                $content = json_decode($this->input->post('content'));

                                $i = 1;
                                foreach($content as $question):
                                    if(!isset($question->question_img)){$question->question_img = NULL;}
                                    $q_without_asking_mark = str_replace('?', ' ', $question->question_value);
                                    $q_new = htmlspecialchars($q_without_asking_mark, ENT_QUOTES);
                                    $que = array('question'=>$q_new,
                                                'answer_type'=>$question->answer_type,
                                                'image'=>$question->question_img,
                                                'order'=>$i);

                                    $this->db->where('pk_question',$question->pk_question)->update('qu_questions',$que);
                                    //update answers

                                        $j=1;
                                        foreach($question->answers as $answer):
                                            if(!isset($answer->answer_img)){$answer->answer_img = NULL;}
                                            $new_answer = htmlspecialchars($answer->answer_value, ENT_QUOTES);
                                            if($answer->pk_answer === 'null'){
                                                $raspuns = array('answer'=>$new_answer,
                                                                'status'=>$answer->corect_answer,
                                                                'image'=>$answer->answer_img,
                                                                'question_id'=>$question->pk_question,
                                                                'order'=>$j);
                                            $error =   $this->db->insert('qu_answers',$raspuns);

                                            }else{
                                            $ans = array('answer'=>$new_answer,
                                                        'status'=>$answer->corect_answer,
                                                        'image'=>$answer->answer_img,
                                                        'order'=>$j);
                                            $error = $this->db->where('pk_answer',$answer->pk_answer)->update('qu_answers',$ans);
                                            }
                                        $j++;
                                        endforeach;

                                $i++;   
                                endforeach;
                        }elseif($status='attribuited'){
                          
                                $this->db->where(array('quiz_id'=>$quiz_id,'client_id'=>$client_id))->delete('qu_quiz_assoc');
                                //insert quiz base
                                $quiz = array('category_id' =>$category_id,
                                              'quiz_name' =>trim($this->input->post('quiz_name')),
                                              'complete_time'=>$time,
                                              'added'=>date('Y-m-d'));
                                $this->db->insert('qu_quiz',$quiz);

                                $quiz_id = $this->db->insert_id();
                                $assoc = array(
                                                'client_id'=>$client_id,
                                                'quiz_id'=>$quiz_id,
                                                'status'=>'created'
                                            );
                                $this->db->insert('qu_quiz_assoc',$assoc);

                                //insert questions
                                $content = json_decode($this->input->post('content'));

                                $i = 1;
                                foreach($content as $question):
                                    if(!isset($question->question_img)){$question->question_img = NULL;}
                                    $q_without_asking_mark = str_replace('?', ' ', $question->question_value);
                                    $q_new = htmlspecialchars($q_without_asking_mark, ENT_QUOTES);
                                    $que = array('quiz_id' =>$quiz_id,
                                                'question'=>$q_new,
                                                'answer_type'=>$question->answer_type,
                                                'image'=>$question->question_img,
                                                'order'=>$i);

                                    $this->db->insert('qu_questions',$que);
                                    $question_id = $this->db->insert_id();
                                    //insert answers
                                        $j=1;
                                        foreach($question->answers as $answer):
                                            if(!isset($answer->answer_img)){$answer->answer_img = NULL;}
                                            $new_answer = htmlspecialchars($answer->answer_value, ENT_QUOTES);
                                            $ans = array('question_id'=>$question_id,
                                                        'answer'=>$new_answer,
                                                        'status'=>$answer->corect_answer,
                                                        'image'=>$answer->answer_img,
                                                        'order'=>$j);
                                        $error = $this->db->insert('qu_answers',$ans);
                                        $j++;
                                        endforeach;

                                $i++;   
                                endforeach;
                                }

                        return $error;

                break;
                
            case 'by_id'://get quiz by id  
                        $query = $this->db->select('id,category_id,quiz_name,complete_time')->get_where('qu_quiz', array('id' => $quiz_id) )->result();

                            foreach ($query as $value)
                            {
                                $value->category_name = $this->get_by_id('category_name',$value->category_id,'qu_categories');
                                $value->questions = $this->db->select('pk_question,question,order as question_order,answer_type,image')->order_by('question_order', 'asc')->get_where('qu_questions', array('quiz_id' => $quiz_id))->result();

                                foreach ($value->questions as  $valu)
                                {
                                    $valu->answers =$this->db->select('pk_answer,answer,status,order as answer_order,image')->order_by('answer_order', 'asc')->get_where('qu_answers', array('question_id' => $valu->pk_question))->result();
                                }
                            }
                        return $query;
                    
                    break;   
             //delete quiz   
            case 'delete':
       
                  return  $this->db->where('id', $client_id)->delete('qu_quiz_assoc');
                break;
            //$client_id = member_id
            case 'complete_done':
                    $data = array('client_id'=>$this->input->post('client_id'),
                                  'member_id'=>$this->input->post('member_id'),
                                  'quiz_id'=>$this->input->post('quiz_id'),
                                  'score'=>$this->input->post('score'),
                                  'completed_time'=>$this->input->post('completed_time'),
                                  'completed_data'=>  date("Y-m-d"));
                    $this->db->insert('qu_quiz_message',$data);
                    break;
            //$client_id = quiz id
            case 'get_name':
                            $data = $this->db->select('quiz_name')->where('id',$client_id)->get('qu_quiz');
                            if($data->num_rows()>0){
                                return $data->row()->quiz_name;
                            }else{
                                return FALSE;
                            }
                break;
                
            //view all client quizes(table)
            default:
                $new_array = array();
                    if($client_id !==''){
                        //admin - attached quizzes table
                        if($quiz_id == 'unattached'){
                            
                               $quiz = $this->db->get('qu_quiz');
                                if($quiz->num_rows() >0 ){
                                    $data = $quiz->result_array();
                                    $i=0;
                                    foreach ($data as $value) {

                                        $new_val =array('added_on'=>$this->dateDiff($value['added'],date("Y-m-d")),
                                                        'category'=>$this->get_by_id('category_name',$value['category_id'],'qu_categories'),
                                                        'questions'=>$this->db->where('quiz_id',$value['id'])->get('qu_questions')->num_rows(),
                                                        'client_id'=>$this->get_by('client_id','quiz_id',$value['id'],'qu_quiz_assoc')
                                                    );
                                        $exist = $this->db->where(array('quiz_id'=>$value['id'],'client_id'=>$client_id))->get('qu_quiz_assoc');
                                        if($exist->num_rows() == 0){
                                            $new_array[]= array_replace($data[$i], $new_val);
                                        }
                                        $i++;
                                    }
                                   
                                    return $new_array;
                                }
                                return FALSE;
                                
                        }else{
                            //view quizzes by client id
                            $quiz_ids = $this->db->select('quiz_id')->where('client_id',$client_id)->get('qu_quiz_assoc');
                           
                            if($quiz_ids->num_rows() >0 ){
                                $quizzes = $quiz_ids->result();
                             
                                foreach($quizzes as $q_id){
                                    $quiz = $this->db->where('id',$q_id->quiz_id)->get('qu_quiz');

                                    $data = $quiz->result_array();

                                    $i=0;
                                    foreach ($data as $value) {
                                        $new_val =array('added_on'=>$this->dateDiff($value['added'],date("Y-m-d")),
                                                        'category'=>$this->get_by_id('category_name',$value['category_id'],'qu_categories'),
                                                        'questions'=>$this->db->where('quiz_id',$value['id'])->get('qu_questions')->num_rows(),
                                                        'client_id'=>$this->get_by('client_id','quiz_id',$value['id'],'qu_quiz_assoc'),
                                                        'assoc_id'=>$this->db->select('id')->where('quiz_id',$value['id'])->where('client_id',$client_id)->get('qu_quiz_assoc')->row()->id
                                            );
                                        $new_array[]= array_replace($data[$i], $new_val);
                                        $i++;
                                    }
                                }
                              
                             return $new_array;
                            }
                             return array(); 
                        }
                        
                    }
                    
                break;
        }
    }
    
    public function dateDiff($start, $end) {
        $lang_datedif = $this->lang->line('date_differance');
        $diff = abs(strtotime($end) - strtotime($start));
        $years = floor($diff / (365*60*60*24));
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
        if($years > 0):
            $y = $lang_datedif['year'];if($years > 1):$y = $lang_datedif['years'];endif;
            return $years.$y;  
        elseif ($months > 0):
            $m = $lang_datedif['month'];if($months > 1):$m = $lang_datedif['months'];endif;
            return $months.$m;       
      
        elseif($days > 0): 
            $d = $lang_datedif['day'];if($days > 1):$d = $lang_datedif['days'];endif;
            return $days.$d;
        else:
            return $lang_datedif['today'];
        endif;
    }
    
    public function get_category(){
  
        $data = $this->db->select('category_name')->get('qu_categories');
        if($data->num_rows() > 0){
            $data = $data->result();
            foreach($data as $val){
                $value[] = $val->category_name; 
            }
            return implode(",", $value);
        }else{
            return FALSE;
        }
    }
    
    public function get_answers_type(){
  
        $data = $this->db->get('qu_answers_type');
        if($data->num_rows() > 0){
            $data = $data->result();
            foreach($data as $val){
                $value[$val->id] = $val->answer_type; 
            }
          //  $data = str_replace('"',' ',json_encode($data)); 
            return $value;
            
        }else{
            return FALSE;
        }
    }
    
    public function get_by_id($select,$id,$table){
        $data = $this->db->select($select)->where('id',$id)->get($table);
        if($data->num_rows()>0){
            return $data->row()->$select;
        }else{
            return FALSE;
        }
    }
        public function get_by($select,$column,$id,$table){
        $data = $this->db->select($select)->where($column,$id)->get($table);
        if($data->num_rows()>0){
            return $data->row()->$select;
        }else{
            return FALSE;
        }
    }
    public function validate_email($email) {

        //check for all the non-printable codes in the standard ASCII set,
        //including null bytes and newlines, and exit immediately if any are found.
        if (preg_match("/[\\000-\\037]/",$email)) {
            return false;
        }
      
        // Validate the domain exists with a DNS check
        // if the checks cannot be made (soft fail over to true)
        list($user,$domain) = explode('@',$email);
        if( function_exists('checkdnsrr') ) {
            if( !checkdnsrr($domain,"MX") ) { // Linux: PHP 4.3.0 and higher & Windows: PHP 5.3.0 and higher
                return false;
            }
        }
        else if( function_exists("getmxrr") ) {
            if ( !getmxrr($domain, $mxhosts) ) {
                return false;
            }
        }
        return true;
   } 
       function new_inbox_message(){
        if( $this->validate_email($this->input->post('email'))!=true){
            $lang_login = $this->lang->line('login');
            $msg  =array('status'=> 'error','msg'=>$lang_login['create_account']['wrong_domain']);
            echo json_encode($msg);die();                      
        }
         $value = array(
                'name'=>$this->input->post('name'),
                'email'=>$this->input->post('email'),
                'message'=>$this->input->post('message'),
                'data'=>date("y-m-d"));
          $err =  $this->db->insert('qu_inbox',$value);
            if($err){  
               $message="<div style='background-color: #DCDCDC; color: #ffffff; font-size: 14px; font-weight: bold; height: 22px; padding-left: 10px; padding-top: 8px; width: auto;'>
                            <span style='color:#008080;'>Grigorita Adrian - Portofoliu Web Site</span></div>
        `                   <h3><em><u>From :</u></em></h3>".$this->input->post('email')."
                            <h3><em><u>Message :</u></em></h3>".$this->input->post('message');
                $this->email->from($this->input->post('email'), 'Portofoliu Web Site');
                $this->email->to('adriangrigorita@gmail.com');
                $this->email->subject('QuizCreator - Contact form');
                $this->email->message($message);
                $this->email->send();
            }
          if($err): return TRUE; else: return FALSE; endif;
    }
    
    function send_emails($to,$subject,$message){
        $this->email->from('no_reply@stevie.heliohost.org','Quiz Creator');
        $this->email->reply_to('no_reply@stevie.heliohost.org','Quiz Creator');
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        return  $this->email->send();
    }
        function email_message_template($temp_name,$searchArray,$replaceArray){
        
         //email settings
        $templateId = $this->db->where('template_name', $temp_name)->get('qu_email_assoc')->row('id_template');
        $content = $this->db->where('id', $templateId)->get('qu_email_template')->row();
    
        $intoString = $content->email_template_content;
        $content_final = str_replace($searchArray, $replaceArray, $intoString);
        
        return $this->body . $content->email_template_header . $content_final . $content->email_template_footer.$this->footer;
      
    }
    
}
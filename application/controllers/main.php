<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
    
        public function __construct()
        {
            
        
            parent::__construct();
            $this->load->model('admin_model');
            
            
            $this->load->model('clients_model');
           
            if(!$this->session->userdata('loged_user')){
                redirect('index');
            }
//            $this->user = $this->session->userdata('loged_u ser');
            if($this->session->userdata('loged_user')){
                $client_id = $this->session->userdata('loged_user')->id;
               
                $this->user = $this->admin_model->admin_client_data($client_id);
                $this->session->set_userdata('loged_user',$this->user);
            }
            
            // load language file
            if($this->session->userdata("language") == "en"){
                $this->lang->load('english', 'english');
            }else{
                 $this->lang->load('romana', 'romana');
            }
             if($this->session->userdata('language')=="ro"){
                $this->form_validation->set_message('required', $this->lang->line('required'));
                $this->form_validation->set_message('greater_than', $this->lang->line('gt0'));
                $this->form_validation->set_message('numeric', $this->lang->line('numeric'));
                $this->form_validation->set_message('valid_email', $this->lang->line('valid_email'));
                $this->form_validation->set_message('min_length', $this->lang->line('min_length'));
            }
	}
        
        public function change_lang($lang){
            $page =   $this->session->userdata('page');
            $this->session->set_userdata('language',$lang);
            $this->session->set_userdata('lang_update','updated');
            echo json_encode(array('status'=>'succes','msg'=>$page));die();
         }
        
	public function index()
	{
            $data='';
            $this->session->set_userdata('lang_update','not');
            $data['lang_menu'] = $this->lang->line('menu');
            $data['lang_notifications'] = $this->lang->line('notification');
            $data['message_read'] = $this->clients_model->client('inbox',$this->user->id,'read');
            if($quizzes = $this->clients_model->client('view_quiz_status',$this->user->id)){
                $data['quizzes'] = count($quizzes);
            }
            $data['client']=$this->admin_model->admin_client_data($this->user->id);
            $this->load->view('main_view',$data);
	}
        
        
        public function client($acction='',$par = '',$par1=''){
          $data['lang_members'] = $this->lang->line('your_members');
          $data['lang_menu'] = $this->lang->line('menu');
          $data['lang_page_title']=  $this->lang->line('lang_page_title');
          $data['lang_notification'] = $this->lang->line('notification');
            switch ($acction) {
                //inbox
                case 'inbox':
                    if($par =='delete'){
                       if($this->db->where('id',$this->input->post('id'))->delete('qu_messages')){
            
                            $msg = array('status'=>'succes','msg'=>$data['lang_members']['edit']['success']);
                        }else{
                            $msg = array('status'=>'error','msg'=>$data['lang_members']['errors']['error']);
                        }
                            echo json_encode($msg);die();
                            
                    }elseif($par == 'refresh'){
                            $msg = array(
                                'lang'=> $this->lang->line('notification'),
                                'msg'=>$this->clients_model->client('inbox',$this->user->id,'unread'),
                                'notif'=>$this->clients_model->client('notifications',$this->user->id)
                                );

                        echo json_encode($msg);die();
                        
                    }else{
                        $data['lang_inbox'] = $this->lang->line('inbox');
                        $this->session->set_userdata('page','main/client/'.$acction);
                        
                        $data['lang_edit'] = $this->lang->line('edit_profile');
                        $data['message_read'] = $this->clients_model->client('inbox',$this->user->id,'read');
                        $data['notifications_read'] = $this->clients_model->client('inbox_notifications',$this->user->id);
                        $this->load->view('client_inbox',$data);
                    }
                    break;
            
                //edit the client profile    
                case'edit_profile':
                     
                     $this->session->set_userdata('page','main/client/'.$acction);
                       
                     $data['lang_edit'] = $this->lang->line('edit_profile');
                        if($this->input->post('submit') == 'true'){
                                if($this->form_validation->run('client_edit_profile')) {
                                    if($this->clients_model->client('edit_profile',$this->user)){
                       
                                        $msg = array('status'=>'succes','msg'=>$data['lang_members']['edit']['success'],'welcome'=>$data['lang_menu']['welcome']);
                                    }else{
                                        $msg = array('status'=>'error','msg'=>$data['lang_edit']['error']);
                                    }
                                }else{
                                    $msg =array('status'=>'error','msg'=>validation_errors());
                                }    
                            echo json_encode($msg);die();
                        }else{
                            $data['loged_user_data'] = $this->admin_model->admin_client_data($this->user->id);
                            $this->load->view('client_edit_profile',$data);
                        }
                    break;
                    
                 //view table with client members data
                case 'view_members':
                     $this->session->set_userdata('page','main/client/'.$acction);
                     $data['lang_members'] = $this->lang->line('your_members');
                     
                     
                    if ($this->user->admin == 1) {
                        $this->session->set_userdata('client_id', $par);
                    }
                    if ($par) {
                        $id_client = $par;
                    } else {
                        $id_client = $this->user->id;
                    }
                    
                    $data['quizes'] = $this->clients_model->quizes('',$id_client);
                    $data['groups'] = $this->clients_model->client('manage_groups',$id_client);
                     
                    if ($members = $this->clients_model->client('get_members', $id_client)) {
                        $data['members'] = $members;
                    } else {
                        $data['error'] = 'There are no members!';
                    }
                        $this->load->view('client_members',$data);
                    break;
                
                //edit client member data -- $par = member_id    
                case 'member_edit':
                        if ($this->user->admin == 1) {
                            $id_client = $this->session->userdata('client_id');
                        } else {
                            $id_client = $this->user->id;
                        }
                        
                        if($par == 'reload'){
                            $data['members'] = $this->clients_model->client('get_members',$id_client);
                            $this->load->view('ajax/members_ajax', $data);
                        }
                        
                        if($this->input->post('ajax') == 'edit'){
                                if($this->form_validation->run('forgot_password')) {
                                    if($this->clients_model->client('edit_member',$par,$id_client)){
                                        $msg = array('status'=>'succes','msg'=>$data['lang_members']['edit']['success']);
                                    }else{
                                        $msg = array('status'=>'error','msg'=>$data['lang_members']['errors']['error']);
                                    }
                                }else{
                                    $msg =array('status'=>'error','msg'=>validation_errors());
                                }    
                            echo json_encode($msg);die();
                        }
                    break;
                    
                //add new member
                case 'member_add':
                    if ($this->user->admin == 1) {
                        if (ctype_digit($par)):
                                $this->session->set_userdata('client_id', $par);
                            endif;
                    }
                    if ($this->user->admin == 1) {
                        $id_client = $this->session->userdata('client_id');
                    } else {
                        $id_client = $this->user->id;
                    }
                
                      if($this->input->post('ajax') == true){
                          
                            if($this->form_validation->run('add_member')) {
                                if($this->clients_model->client('add_member',$id_client)){
                                    $msg = array('status'=>'succes','msg'=>$data['lang_members']['edit']['success']);
                                }else{
                                    $msg = array('status'=>'error','msg'=>$data['lang_members']['errors']['error']);
                                }

                            }else{
                                $msg =array('status'=>'error','msg'=>validation_errors());
                            }    
                            echo json_encode($msg);die();
                            
                      }else{
                            $this->session->set_userdata('page','main/client/'.$acction);
                            
                            $data['groups'] = $this->clients_model->client('manage_groups',$id_client);
                            
                            $this->load->view('client_member_add',$data);
                      } 
                    break;  
                    
                // add/view/edit/delete the client group(s)
                case 'manage_groups':
                        //set the client id session , if admin need to take some acctions
                        if ($this->user->admin == 1) {
                            if (ctype_digit($par)):
                                $this->session->set_userdata('client_id', $par);
                            endif;
                        }
                        if ($this->user->admin == 1) {
                                $id_client = $this->session->userdata('client_id');
                        } else {
                                $id_client = $this->user->id;
                        }
                        
                        if($par == 'reload'):
                            $data['groups'] =  $this->clients_model->client('manage_groups',$id_client);
                            $this->load->view('ajax/groups_ajax', $data);
                        //edit
                        elseif($par=='edit'):
                            if( $this->form_validation->run('add_group') ) {
                                if( $this->clients_model->client('manage_groups',$id_client,'edit') ){
                                    $msg = array('status'=>'succes','msg'=>$data['lang_members']['edit']['success']);
                                }else{
                                    $msg = array('status'=>'error','msg'=>$data['lang_members']['errors']['error']);
                                }
                            }else{
                                $msg =array('status'=>'error','msg'=>validation_errors());
                            }  
                            echo json_encode($msg);
                            
                        //add
                        elseif($par=='add'):
                            
                            if($this->form_validation->run('add_group')) {
                                 if( $this->clients_model->client('manage_groups',$id_client,'add') ){
                                    $msg = array('status'=>'succes','msg'=>$data['lang_members']['edit']['success']);
                                }else{
                                    $msg = array('status'=>'error','msg'=>$data['lang_members']['errors']['error']);
                                }
                            }else{
                                $msg =array('status'=>'error','msg'=>validation_errors());
                            }  
                            echo json_encode($msg);
                            
                        //set groups options     
                        elseif($par=='get'): 
                          
                            $data['groups'] =  $this->clients_model->client('manage_groups',$id_client);
                            if(!empty ($data['groups']) ){
                                $opt = "<option value=' ' selected='selected'> </option>";
                                foreach($data['groups'] as $group) {
                                        $opt .= "<option value='" . $group->id . "'>" . $group->name . "</option><br />";
                                }
                                echo $opt;
                            }else{
                                 echo "<option value=' '  class='invalid'> ".$data['lang_members']['errors']['noGroup']."</option>";
                            }
                        //delete    
                        elseif($par=='delete'):
                            if( $this->clients_model->client('manage_groups',$id_client,'delete') ){
                                    $msg = array('status'=>'succes','msg'=>$data['lang_members']['errors']['delete_success']);
                            }else{
                                    $msg = array('status'=>'error','msg'=>$data['lang_members']['errors']['error']);
                            }
                            echo json_encode($msg);
                        //get groups     
                        else:
                            $this->session->set_userdata('page','main/client/'.$acction);
                            $data['groups'] =  $this->clients_model->client('manage_groups',$id_client);
                            $this->load->view('client_manage_groups',$data);
                        endif;
                    break;
 //to fix
                //delete member    
                case 'delete_member':
                         if($par == 'reload'){
                            $data['members'] = $this->clients_model->client('get_members',$this->user->id);
                            $this->load->view('ajax/members_ajax', $data);
                        }else{  
                            if ($this->clients_model->client('delete_member',$par)) {
                                $msg = array('status'=>'succes','msg'=>$data['lang_members']['errors']['delete_success']);
                            } else {
                                $msg = array('status'=>'error','msg'=>$data['lang_members']['errors']['error']);
                            }
                            echo json_encode($msg);die();
                        }
                    break;
                    
                //send emails -- $_POST[ajax] = single (send email to only one member) | $_POST[ajax] = multy (send email to all selected members)    
                case 'member_dispatch':
                        
                        if ($this->user->admin == 1) {
                            if (ctype_digit($par)):
                                $this->session->set_userdata('client_id', $par);
                            endif;
                        }
                        if ($this->user->admin == 1) {
                                $id_client = $this->session->userdata('client_id');
                        } else {
                                $id_client = $this->user->id;
                        }
                    
                        if($par == 'reload'){
                            $data['members'] = $this->clients_model->client('get_members',$id_client);
                            $this->load->view('ajax/members_ajax', $data);
                        }  

                        if($this->input->post('ajax') == 'multy'){
                            
                                if($this->clients_model->client('multy_dispatch',$id_client)){
                                    $msg = array('status'=>'succes','msg'=>$data['lang_members']['errors']['success']);
                                }else{
                                    $msg = array('status'=>'error','msg'=>$data['lang_members']['errors']['error']);
                                }
                                echo json_encode($msg);die();
                            
                        }elseif($this->input->post('ajax') == 'single'){

                                if($this->clients_model->client('single_dispatch',$id_client)){
                                    $msg = array('status'=>'succes','msg'=>$data['lang_members']['errors']['success']);
                                }else{
                                    $msg = array('status'=>'error','msg'=>$data['lang_members']['errors']['error']);
                                }
                                echo json_encode($msg);die();
                        } 
                    break;

                //change to selected members the quiz or the group    
                case 'change_on_members':
                        if ($this->user->admin == 1) {
                            $client_id = $this->session->userdata('client_id');
                        } else {
                            $client_id = $this->user->id;
                        }
                        if($par == 'reload'){
                            $data['members'] = $this->clients_model->client('get_members',$client_id);
                            $this->load->view('ajax/members_ajax', $data);
                        }
                        if($this->input->post('submit') == true){
                                if($this->clients_model->client('change_on_members')){
                                    $msg = array('status'=>'succes','msg'=>$data['lang_members']['edit']['success']);
                                }else{
                                    $msg = array('status'=>'error','msg'=>$data['lang_members']['errors']['error']);
                                }
                                echo json_encode($msg);
                        }
                    break;
                
                //view the how it works page(video)
                case'how_its_works':
                        $data['lang_page_title']=  $this->lang->line('lang_page_title');
                        $this->session->set_userdata('page','main/client/'.$acction);
                        $this->load->view('client_how_its_work',$data);
                    break;
                
                    
                //setup result page - if the member completed the quiz received 
                case 'member_quiz_status':
                        $data['lang_quiz'] = $this->lang->line('quiz');
                        if ($this->user->admin == 1) {
                            $client_id = $this->session->userdata('client_id');
                        } else {
                            $client_id = $this->user->id;
                        }
                        $data['messages'] = $this->clients_model->client('view_quiz_status',$this->user->id,$par);
                        $this->load->view('client_member_quiz_status',$data);
                    break;
                
                //view new massage - update the message status
                case 'set_message_status':
                    if($par1 == 'notifications'){
                        $data['notification']= $this->clients_model->client('notifications','single',$par);
                        $this->db->where('id',$par)->update('qu_quiz_message',array('status'=>'1'));
                    }else{
                        $data['message']= $this->clients_model->client('messages','single',$par);
                        $this->db->where('id',$par)->update('qu_messages',array('status'=>'1'));
                    }
                        $this->load->view('client_message_box',$data);
                     break;
                 
               
                
                    
                //load dashboard
                default:
                        $this->session->set_userdata('page','main/client/'.$acction);
                       $data['client_dashboard'] = $this->lang->line('client_dashboard');
                       if($this->user->admin == 1){
                           $this->load->view('admin/w_dashboard');
                       }else{
                          $data['dash'] = $this->clients_model->client('',$this->user);
                          $this->load->view('client_dashboard',$data);
                       }
                        
                   break;
            }
        }

        
        
        public function client_quiz($acction = '',$par ='',$par1 =''){
            $data['lang_quiz'] = $this->lang->line('quiz');
            $data['lang_menu'] = $this->lang->line('menu');
            $data['lang_page_title']=  $this->lang->line('lang_page_title');
          

//            if(ctype_digit($par)):$id = $par; else:$id = $this->user->id;endif;
            
            switch ($acction) {
                //view quiz
                //$par = quiz_id
                case 'view':
                        $data['quiz'] = $this->clients_model->quizes('by_id','',$par);
                        $this->load->view('quize_view',$data);
                    break;
               
                //edit quiz
                //$par = quiz_id
                case 'edit':
                            if ($this->user->admin == 1) {
                                $client_id = $this->session->userdata('client_id');
                            } else {
                                $client_id = $this->user->id;
                            }
                            if($this->input->post('submit') == true){
                                
                                if($this->clients_model->quizes('edit',$client_id,$this->input->post('quiz_id'))){
                                    $msg = array('status'=>'succes','msg'=>$data['lang_quiz']["create_quiz"]['third']['success']);
                                }else{
                                    $msg = array('status'=>'error','msg'=>$data['lang_quiz']["create_quiz"]['third']['error']);
                                }
                                echo json_encode($msg);die();
                            }
                            
                            $this->session->set_userdata('page','main/client_quiz/'.$acction.'/'.$par);
                            $data['quiz'] = $this->clients_model->quizes('by_id',$client_id,$par);
                            $data['category'] =  $this->clients_model->get_category();
                            $data['answers_type'] = $this->clients_model->get_answers_type();
                            $this->load->view('client_edit_quiz',$data);
                    break;
                 
                 //add quiz   
                 case 'add':
                            if($this->input->post('submit') == true){
                                if($this->clients_model->quizes('add',$this->user->id)){
                                    $msg = array('status'=>'succes','msg'=>$data['lang_quiz']["create_quiz"]['third']['success']);
                                }else{
                                    $msg = array('status'=>'error','msg'=>$data['lang_quiz']["create_quiz"]['third']['error']);
                                }
                                echo json_encode($msg);die();
                            }
                            
                            $data['category'] =  $this->clients_model->get_category();
                            $data['answers_type'] = $this->clients_model->get_answers_type();
                            $this->session->set_userdata('page','main/client_quiz/'.$acction);
                            $this->load->view('client_add_quiz',$data);
                     break; 
                     
                  //delete quiz
                  //$par = quiz_id   
                  case 'delete': 
                           
                            if ($this->user->admin == 1) {
                                    $id_client = $this->session->userdata('client_id');
                            } else {
                                    $id_client = $this->user->id;
                            }
                            if($par == 'reload'){
                                $data['quizes'] = $this->clients_model->quizes('',$id_client);
                                $this->load->view('ajax/quiz_ajax', $data);
                            }else{  
                                if ($this->clients_model->quizes('delete',$par)) {
                                    $msg = array('status'=>'succes','msg'=>'succes');
                                } else {
                                    $msg = array('status'=>'error','msg'=>'err');
                                }
                                echo json_encode($msg);die();
                            }
                    break;
                    
                  //view the score on completed and selected  quiz 
                  case 'top_quizzes':
                    
                        if($par == 'change'){
                            $data['top_quiz'] = array();
                            $data['top_quiz'] = $this->clients_model->client('view_quiz_status',$this->user->id,$par1,'by_quiz');
                            $this->load->view('ajax/ajax_top_quizzes',$data);
                        }else{
                            $this->session->set_userdata('page','main/client_quiz/'.$acction);
                            $this->session->set_userdata('page','main/client_quiz/'.$acction);
                            $data['quizzes']=$this->clients_model->quizes('',$this->user->id);
                            $this->load->view('client_top_quizzes',$data);
                        }
                    break; 
                //view client quizzes(table)
                default: 
                        if ($this->user->admin == 1) {
                            if (ctype_digit($par)):
                                $this->session->set_userdata('client_id', $par);
                            endif;
                        }
                        if ($this->user->admin == 1) {
                                $id_client = $this->session->userdata('client_id');
                        } else {
                                $id_client = $this->user->id;
                        }
                        
                        $this->session->set_userdata('page','main/client_quiz/'.$acction);
                        if($quize = $this->clients_model->quizes('',$id_client)){
                            $data['quizes']= $quize;
                        }else{
                            $data ['error'] = 'There are no quizes!';
                        }
                      
                        $this->load->view('client_quizes',$data);
                    break;
            }
        }
        
  
    //-------------------   ADMIN--------------------
    /**
     * incarca tabelul cu utilizatori
     */
    public function admin_view_client()
    {
        $data['clients'] = $this->admin_model->admin_view_clients();
        $this->load->view('admin/w_manage_clients', $data);
    }
    /**
     * incarca formularul pentru editare
     * editeaza cimpurile primite by id 
     */
    public function admin_edit_client($id)
    {
        if ($this->input->post('ajax') == 1) {
            $new_id = $this->input->post('hid');
            if ($this->form_validation->run('admin_edit_clients')) {
                if ($this->admin_model->admin_edit_client($new_id)) {
                    $data = array('status' => 'succes', 'msg' => "Client " . ucfirst($this->input->
                            post('full_name')) . " successfully updated");
                } else {
                    $data = array('status' => 'error', 'msg' => "Client " . ucfirst($this->input->
                            post('full_name')) . " was not updated !");
                }
            } else {
                $data = array('status' => 'error', 'msg' => validation_errors());
            }
            echo json_encode($data);
        } else {
            $data['client'] = $this->admin_model->admin_client_data($id);
            $this->load->view('admin/w_edit_clients', $data);
        }
    }
    public function load_ajax_table()
    {
        $clients['clients'] = $this->admin_model->admin_view_clients();
        $this->load->view('ajax/clients_ajax', $clients);
    }
     /**
     * delete client by ID 
     */
    public function admin_delete_client($id)
    {
        if ($this->admin_model->admin_delete_client($id)) {
            $clients['clients'] = $this->admin_model->admin_view_clients();
            $clients['success'] = "\"Client was successfully deleted \"";
            $this->load->view('ajax/clients_ajax', $clients);
        } else {
            $clients['clients'] = $this->admin_model->admin_view_clients();
            $clients['del_error'] = "\"Client  not deleted \"";
            $this->load->view('ajax/clients_ajax', $clients);
        }
    }
    /**
     * update status 
     */
    public function admin_update_status($id_u)
    {
        $user = $this->admin_model->admin_client_data($id_u);
        ($user->status == 1) ? $id_s = 0 : $id_s = 1;
        if (!empty($user)) {
            $this->admin_model->admin_update_status($id_u, $id_s);
            $clients['clients'] = $this->admin_model->admin_view_clients();
            $clients['success'] = "\"Member " . ucfirst($user->full_name) .
                " was update status successfully \"";
            $this->load->view('ajax/clients_ajax', $clients);
        } else {
            $clients['clients'] = $this->admin_model->admin_view_clients();
            $clients['del_error'] = "\"Member " . ucfirst($user->full_name) .
                " not update status successfully \"";
            $this->load->view('ajax/clients_ajax', $clients);
        }
    }
    /**
     * Back up db
     */
    public function admin_back_up_db()
    {
        if ($this->input->post('ajax') == 1) {
            $file_name = $this->input->post('name');
            if ($file_name == 'db_backup.sql') {
                $this->admin_model->back_up_db($file_name);
                $data = array('status' => 'ok', 'msg' => 'Database was successfully saved');
            } else {
                $data = array('status' => 'err', 'msg' => 'Database can not be saved ');
            }
            echo json_encode($data);
        } else {
            $this->load->view('admin/w_back_up_db');
        }
    }
    /**
     * EDIT  admin profile 
     */
    public function admin_edit_profile()
    {
        $id = $this->input->post('id');
        //$mail_profile = $this->input->post('email_profile');
        //$all_mail_profile['mail_template']= $this->admin_model->admin_view_templates();
        if ($this->input->post('ajax') == 1) {
            if ($this->form_validation->run('admin_edit_profile')) {
                if ($this->admin_model->admin_edit_profile($id)) {
                    $data = array('status' => 'ok', 'msg' => 'Update successfully ');
                } else {
                    $data = array('status' => 'err', 'msg' => 'Update error ');
                }
            } else {
                $data = array('status' => 'error', 'msg' => validation_errors());
            }
            echo json_encode($data);
        } else {
            $this->load->view('admin/w_edit_admin_profile');
        }
    }
    /**
     * View clients-members
     */
    public function admin_client_members($id)
    {
        if ($members = $this->clients_model->get_members($id)) {
            $data['members'] = $members;
        } else {
            $data['error'] = 'There are no members!';
        }
        $this->load->view('client_members', $data);
    }
    /**
     * View manage templates si atribuire templateuri pe actiuni 
     */
    public function admin_manage_tempates()
    {
        if ($this->input->post('ajax') == 1) {
            if ($this->admin_model->admin_update_email_template_assoc()) {
                $data = array('status' => 'succes', 'msg' => 'atribuire template reusita ');
            } else {
                $data = array('status' => 'error', 'msg' => 'atribuire template nereusita');
            }
            echo json_encode($data);
        } else {
            $data['template_id_name'] = $this->admin_model->get_all_template();
            $data['templates'] = $this->admin_model->admin_view_templates();
            $this->load->view('admin/w_manage_templates', $data);
        }
    }
    /**
     * ADD email template 
     */
    public function admin_add_email_template()
    {
        if ($this->input->post('ajax') == 1) {
            if ($this->form_validation->run('admin_add_email_template')) {
                if ($this->admin_model->admin_add_email_template()) {
                    $data = array('status' => 'succes', 'msg' => 'Template added successfully');
                } else {
                    $data = array('status' => 'error', 'msg' => 'Template added error');
                }
            } else {
                $data = array('status' => 'error', 'msg' => validation_errors());
            }
            echo json_encode($data);
        } else {
            $this->load->view('admin/w_add_template');
        }
    }
    /**
     * View edit email template
     */
    public function admin_edit_template()
    {
        $id = $this->uri->segment(3);
        if ($this->input->post('ajax') == 1) {
            if ($this->form_validation->run('admin_add_email_template')) {  
                    if ($this->admin_model->admin_edit_email_templates($id)) {
                        $data = array('status' => 'succes', 'msg' => 'Editing templates success');
                    } else {
                        $data = array('succes' => 'error', 'msg' => 'Editing templates failure');
                    }
             } else {
                $data = array('status' => 'error', 'msg' => validation_errors());
              }
            echo json_encode($data);
        } else {
            $data['email_templates'] = $this->admin_model->admin_email_templates($id);
            $this->load->view('admin/w_edit_template', $data);
        }
    }
    
    public function add_name_email()
    {
        if ($this->input->post('ajax') == 1) {
            if ($this->admin_model->add_name_email()) {
                $data = array('status' => 'succes', 'msg' => 'nume adaugat cu succes ');
            } else {
                $data = array('succes' => 'error', 'msg' => 'eroare mai ');
            }
            echo json_encode($data);
        } else {
            $this->load->view('admin/w_add_name_email');
        }
    }
    /**
     * VIEW  email template _asoc
     */
    public function admin_view_email_template_assoc($id)
    {
        $data['continut'] = $this->admin_model->admin_email_template_assoc($id);
        $this->load->view('admin/w_view_email_templates', $data);
    }
    
     public function admin_delete_email()
    {
        if ($this->admin_model->admin_delete_email()) {
            $data = array('status' => 'succes', 'msg' => 'Data was succeffuly deleted');
        } else {
            $data = array('succes' => 'error', 'msg' => 'Editing templates failure');
        }
        echo json_encode($data);
    }
    
     public function admin_delete_template($id='')
    {
         if($id == 'reload' ){
             $data['template_id_name'] = $this->admin_model->get_all_template();
             $this->load->view('ajax/admin_all_templates', $data);
         }else{
            if ($this->admin_model->admin_delete_template($id)) {
                $data = array('status' => 'succes', 'msg' => 'Data was succeffuly deleted');
            } else {
                $data = array('succes' => 'error', 'msg' => 'Editing templates failure');
            }
            echo json_encode($data);
         }
    }
    
    public function admin_edit_email()
    {
        if ($this->admin_model->admin_edit_email()) {
            $data = array('status' => 'succes', 'msg' => 'Data was succeffuly updated');
        } else {
            $data = array('succes' => 'error', 'msg' => 'Editing templates failure');
        }
        echo json_encode($data);
    }
    /**
     * All email template 
     */
    public function admin_all_email_template()
    {
        $data['template_id_name'] = $this->admin_model->get_all_template();
        $this->load->view('admin/w_all_email_templates', $data);
    }
    /**
     * load ajax template tabel
     */
    public function load_ajax_template_table(){
        $data['template_id_name'] = $this->admin_model->get_all_template();
        $data['templates'] = $this->admin_model->admin_view_templates();
        $this->load->view('ajax/template_ajax_table', $data);
    }

    public function admin_attach_quizzes($client_id=''){
         if ($this->input->post('ajax') == 'true') {
             if($this->admin_model->attach_quizzes($this->user)){
                 $data = array('status' => 'succes', 'msg' => 'Data was succeffuly updated');
             }else{
                 $data = array('succes' => 'error', 'msg' => 'Editing templates failure');
             }
              echo json_encode($data);
         }else{
            $data['client_id'] =$client_id; 
            $data['quizzes'] = $this->clients_model->quizes('',$client_id,'unattached');
            $this->load->view('admin/w_quizzes_table',$data);
         }
    }
    
    public function admin_send_message(){
            if ($this->input->post('ajax') == 'true') {
                if ($this->form_validation->run('admin_send_message')) {
                    if ($this->admin_model->admin_new_message($this->user->id)) {
                        $data = array('status' => 'succes', 'msg' => 'successfully ');
                    } else {
                        $data = array('status' => 'error', 'msg' => ' error ');
                    }
                } else {
                    $data = array('status' => 'error', 'msg' => validation_errors());
                }
                echo json_encode($data);
            }
    }
    /* Admin- How its work */
    public function admin_how_its_work($reload=''){
     
        if($reload=='reload'){
            $data['how'] = $this->admin_model->get_all_how_its_work();
            $this->load->view('ajax/admin_how_its_work_ajax', $data);
        }elseif($this->input->post('ajax')=='add'){
            if($this->admin_model->add_how_its_work()){
                $data = array('status' => 'succes', 'msg' => 'successfully ');
            } else {
                $data = array('status' => 'error', 'msg' => ' error ');
            }
            echo json_encode($data);
        }else{
            $data['how'] = $this->admin_model->get_all_how_its_work();
            $this->load->view('admin/w_how_its_work', $data);
        }
    }
    
    public function admin_delete_how_its_work(){
            if($this->admin_model->delete_how_its_work()){
                $data = array('status' => 'succes', 'msg' => 'successfully ');
            } else {
                $data = array('status' => 'error', 'msg' => ' error ');
            }
            echo json_encode($data);
    }

    public function admin_update_status_how_its_work(){
         if($this->admin_model->update_status_how_its_work()){
                $data = array('status' => 'succes', 'msg' => 'successfully ');
            } else {
                $data = array('status' => 'error', 'msg' => ' error ');
            }
            echo json_encode($data);
    }
    
  
    public function admin_edit_how_its_work($id='')
    {
        if ($this->input->post('ajax') == "update") {
             
                    if ($this->admin_model->edit_how_its_work($id)) {
                        $data = array('status' => 'succes', 'msg' => 'Editing image success');
                    } else {
                        $data = array('succes' => 'error', 'msg' => 'Editing image failure');
                    }
            echo json_encode($data);
        }
    }
    
     public function admin_edit_how_its_work_order()
    {
        if ($this->input->is_ajax_request()) {
             
                    if ($this->admin_model->change_order()) {
                        $data = array('status' => 'succes', 'msg' => 'Order was changed  success');
                    } else {
                        $data = array('succes' => 'error', 'msg' => 'failure');
                    }
            
            echo json_encode($data);
        } 
    }
    
    //---------------------------------------
 
    
      public function get_answer_type(){
             echo json_encode($this->clients_model->get_answers_type());die();
        }
        
        
        
      public function elfinder_init($action)
        {
            $this->load->helper('file');
            $this->load->helper('path');
            
            switch ($action) {
                case 'quiz':
                            $url = "source/public_quiz_images/".$this->user->id;
                            $user_gallery_folder = get_filenames($url);

                            if(!file_exists($url)){
                                mkdir($url);
                            }
                            
                            $opts = array(
                                        'root'            => set_realpath($url),   
                                        'URL'             => site_url($url) . '/', 
                                        'tmbDir'       => '.tmb',
                                        'dotFiles'     => false,
                                        'rootAlias'       => 'Your Images Gallery',
                                       );
                    break;
                case 'email_template':
                               $opts = 
                                    array( 
                                        'root'   => set_realpath('source/template_images'), 
                                        'URL'    => site_url('source/template_images') . '/',
                                        'rootAlias'  =>'Email Templates',
                                      
                                      );
                    break;
                case 'first_page':
                               $opts = 
                                    array( 
                                        'root'   => set_realpath('template/firstPage/images'), 
                                        'URL'    => site_url('template/firstPage/images') . '/',
                                        'rootAlias'  =>'How its work',
                                      
                                      );
                    break;
            }
           
            $this->load->library('elfinder_lib', $opts);
            
        }
        
        
        
     public function load_elfinder(){
            $this->load->view('elfinder');
        }
        
             
     public function payment(){    
            //order for new emails(not completed)
            $data['lang_members'] = $this->lang->line('your_members');
            
            if($this->session->userdata('language')=="ro"){
                $this->form_validation->set_message('required', $this->lang->line('required'));
                $this->form_validation->set_message('greater_than', $this->lang->line('gt0'));
                $this->form_validation->set_message('numeric', $this->lang->line('numeric'));
            }
            
            if($this->form_validation->run('card_datails')) {
                if($this->clients_model->client('email_order',$this->user->id)){
                    $msg = array('status'=>'succes','msg'=>$data['lang_members']['edit']['success']);
                }else{
                    $msg = array('status'=>'error','msg'=>$data['lang_members']['errors']['error']);
                }
            }else{
                $msg =array('status'=>'error','msg'=>validation_errors());
            } 
            
            echo json_encode($msg);die();
      }   
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

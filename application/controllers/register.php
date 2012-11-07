<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {  
     public function __construct()
        {
            parent::__construct();
             $this->form_validation->set_error_delimiters('<b>', '</b><br/>');
           $this->load->model('clients_model');
             // load language file
            if($this->session->userdata("language") == "en"){
                 $this->lang->load('english', 'english');
            }else{
                 $this->lang->load('romana', 'romana');
            }
	}
        
    public function index(){
         $data['lang_login'] = $this->lang->line('login');
                if($this->input->post('submit') == true){
                     if($this->session->userdata('language')=="ro"){
                        $this->form_validation->set_message('required', $this->lang->line('required'));
                        $this->form_validation->set_message('valid_email', $this->lang->line('valid_email'));
                        $this->form_validation->set_message('matches', $this->lang->line('matches'));
                        $this->form_validation->set_message('min_length', $this->lang->line('min_length'));
                     }
                        if($this->form_validation->run('create_account')) {
                           
                            if ($this->clients_model->client('add_client')):
                                    $msg  =array('status'=> 'succes' ,'msg'=>$data['lang_login']['success'].$data['lang_login']['check'].$data['lang_login']['activate']);
                            else:
                                    $msg  =array('status'=> 'error','msg'=>$data['lang_login']['success']);
                            endif;
			}else {
				$msg =array('status'=>'error','msg'=>validation_errors());
			}

			echo json_encode($msg);die();
		}else {
			$this->load->view('create_account');
		}
        }
        
   public function acctivate_account($key){
        $data['lang_login'] = $this->lang->line('login');
       if($this->clients_model->client('acctivate_account',$key)){
           $this->session->set_flashdata('account_succes',$data['lang_login']['success2']);
           redirect('index');
       }
       else{
           $this->session->set_flashdata('account_error',$data['lang_login']['error1']);
           redirect('index');
       }
       
   }     
   
   public function forgot_password(){
        if($this->input->post('submit') == true){
            $data['lang_login'] = $this->lang->line('login');
             if($this->session->userdata('language')=="ro"){
                 $this->form_validation->set_message('required', $this->lang->line('required'));
                 $this->form_validation->set_message('valid_email', $this->lang->line('valid_email'));
                 
             }
                 if($this->form_validation->run('forgot_password')) {
                        if ($this->clients_model->client('reset_password')) {
                                $msg  =array('status'=> 'succes' ,'msg'=>$data['lang_login']['success'].$data['lang_login']['check']);
                        } else {
                                $msg  =array('status'=> 'error','msg'=>$data['lang_login']['error1']);
                        }
                }else {
                        $msg =array('status'=>'error','msg'=>validation_errors());
                }

                echo json_encode($msg);die();
        }else {
                $this->load->view('forgot_password');
        }
   }  
   
   public function contact(){
         if($this->input->post('submit') == true){
            $data['lang_login'] = $this->lang->line('login');
            //set validation value in Ro language
             if($this->session->userdata('language')=="ro"){
                 $this->form_validation->set_message('required', $this->lang->line('required'));
                 $this->form_validation->set_message('valid_email', $this->lang->line('valid_email'));
             }
             
             if($this->form_validation->run('contact')) {
                    if ($this->clients_model->new_inbox_message()) {
                            $msg  =array('status'=> 'succes' ,'msg'=>$data['lang_login']['success']);
                    } else {
                            $msg  =array('status'=> 'error','msg'=>$data['lang_login']['error1']);
                    }
             }else {
                    $msg =array('status'=>'error','msg'=>validation_errors());
             }

             echo json_encode($msg);die();
        }
   }
   

   

}

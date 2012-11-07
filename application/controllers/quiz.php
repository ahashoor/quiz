<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quiz extends CI_Controller {  
     public function __construct()
        {
            parent::__construct();
            
           $this->load->model('clients_model');
           
             // set language 
            $country = file_get_contents('http://api.wipmania.com/'.$this->input->ip_address().'?google.com');
            if($country == "RO"){
                $this->session->set_userdata('language',"ro");
            }else{
                $this->session->set_userdata('language',"en");
            }
            if($this->session->userdata("language") == "en"){
                $this->lang->load('english', 'english');
            }else{
                $this->lang->load('romana', 'romana');
            }
	}
        
    public function index($quiz_id,$client_id,$member_id){
      
        
       $c = $this->db->where(array('quiz_id'=>$quiz_id,'member_id'=>$member_id))->count_all_results('qu_quiz_message'); 
       if($c < 10){
        $data['quiz'] = $this->clients_model->quizes('by_id','',$quiz_id);
        $data['client_id'] = $client_id;
        $data['member_id'] = $member_id;
       }else{
           $data['error'] = 'This quiz was completed! <br/><br/> You cant made this quiz again..';
       }
       $data['lang_quiz'] = $this->lang->line('quiz');
       $this->load->view('complete_quiz',$data);
   }   
   
   public function done(){
        $data['lang_quiz'] = $this->lang->line('quiz');
        $this->clients_model->quizes('complete_done',$this->input->post('member_id'));
        $msg =array('status'=>'succes','msg'=>'Your Quiz was succeffuly register!');
        echo json_encode($msg);die();
   }
}

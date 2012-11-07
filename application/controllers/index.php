<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

	public function __construct()
        {
            parent::__construct();
             $this->form_validation->set_error_delimiters('<b>', '</b><br/>');
            // load language file
            if($this->session->userdata("language") == "en"){
                $this->lang->load('english', 'english');
            }else{
                 $this->lang->load('romana', 'romana');
            }
	}
	
	public function index($par = ''){
          
		if(($this->input->cookie('email') != '')&&($this->input->cookie('password') != '')){
			if($this->checkLogin($this->input->cookie('email'),$this->input->cookie('password'))!=FALSE){
                              redirect("main#main/client");
			}
		}
//                if($this->session->userdata('loged_user')){
//                    redirect("main#main/client");
//                }
               
		if($par == 'true'){
                    
                    if($this->session->userdata('language')=="ro"){
                        $this->form_validation->set_message('required', $this->lang->line('required'));
                        $this->form_validation->set_message('valid_email', $this->lang->line('valid_email'));
                    }
                      
                    if ($this->form_validation->run('login') == FALSE){
                           
                            $msg  =array('status'=> 'error','msg'=>validation_errors());
                            
                    }else{	
                            if($this->checkLogin($this->input->post('email'),$this->input->post('password'))!=FALSE){

                                    if($this->input->post('remember')=='1'){
                                            $cookie = array(
                                            'name'   => 'email',
                                            'value'  => $this->input->post('email'),
                                            'expire' =>  86500,
                                            'secure' => false
                                            );
                                            $this->input->set_cookie($cookie); 

                                            $cookie = array(
                                            'name'   => 'password',
                                            'value'  => $this->input->post('password'),
                                            'expire' =>  86500,
                                            'secure' => false
                                            );
                                            $this->input->set_cookie($cookie); 		
                                    }
                                
                                      $msg  =array('status'=> 'succes','msg'=> "main#main/client");
                                    
                            }else{
                                     $lang = $this->lang->line('login');
                                     $msg  =array('status'=> 'error','msg'=> $lang['error1']);
                            }
                        }
                        echo json_encode($msg);
                }else{
                     // set language 
                     $country='RO';
//                      $country = file_get_contents('http://api.wipmania.com/'.$this->input->ip_address().'?google.com');
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
                    $data['how']= $this->get_all_how_its_work();    
                    $data['lang_login'] = $this->lang->line('login');
                    $this->load->view('index',$data);
                }
	}
        
 
            
   private function checkLogin($email,$password){
        $condArray  = array('email' => $email,
                            'password' => md5($password));
        $lang = $this->lang->line('login');
        $query = $this->db->where($condArray)->get("qu_users");
        if($query->num_rows() > 0)
        {
            $data =   $query->row();
            if($data->status == 0){
                $msg  =array('status'=> 'error','msg'=>$lang['error2']);
                echo json_encode($msg);die();
            }else{
                if($data->first_login == 0){
                    $this->load->model('clients_model');
                    $this->clients_model->client('first_login',$data->id);
                }
                $this->session->set_userdata('loged_user',$data);
                return TRUE;
            }
        }
        else
        {
            return FALSE;
        }
    }
    
  public function change_lang($lang){
        
            $this->session->set_userdata('language',$lang);
            echo json_encode(array('status'=>'succes','msg'=>"index/reload"));
    }
 
  public function reload(){
            if($this->session->userdata("language") == "en"){
                $this->lang->load('english', 'english');
            }else{
                $this->lang->load('romana', 'romana');
            }
             $data['how']= $this->get_all_how_its_work(); 
             $this->firephp->log($data['how']);
            $data['lang_login'] = $this->lang->line('login');
            $this->load->view('ajax/login_ajax',$data);
    }      
        
   public function logout(){
        delete_cookie("email");   
        delete_cookie("password");
        $this->session->sess_destroy();
        redirect('index');
    }
    
   public function captcha($post=FALSE){
            if($post!=FALSE){
                // First, delete old captchas
                $expiration = time()-3600; // Two hour limit
                $this->db->where('captcha_time < ',$expiration)->delete('captcha');
                // Then see if a captcha exists:
                $where = array('word'=>$this->input->post('captcha'),'ip_address'=>$this->input->ip_address(),'captcha_time >'=>$expiration);
                $sql = $this->db->where($where)->get('captcha');
                $lang = $this->lang->line('login');
                    if ($sql->num_rows() >0)
                    {
                        $msg  =array('status'=> 'success');
                    }else{
                          $msg  =array('status'=> 'error','msg'=> 'word is wrong');
                    }
               
                echo json_encode($msg);die();
            }else{
                $this->load->helper('captcha');
                $vals = array(
                    'img_path' => './source/captcha/',
                    'img_url' => base_url().'source/captcha/',
                    'font_path' => './source/font/Bedizen.ttf',
                    'img_width' => '240',
                    'img_height' => 30,
                    );
           
                $cap = create_captcha($vals);
                $data = array(
                    'captcha_time' => $cap['time'],
                    'ip_address' => $this->input->ip_address(),
                    'word' => $cap['word']
                    );
                $query = $this->db->insert_string('captcha', $data);
                $this->db->query($query);
                if($this->input->post('reset') == 'true'){
                    echo json_encode(array('succes'=>$cap['image'])); die();
                }
                return $cap;
            }
        }
        
        function getUserCountry($site_name) {
            $fp = fsockopen("api.wipmania.com", 80, $errno, $errstr, 5);
            if (!$fp) {
                // API is currently down, return as "Unknown" :(
                return "XX";
            } else {
                $out = "GET /".$_SERVER['REMOTE_ADDR']."?".$site_name." HTTP/1.1\r\n";
                $out .= "Host: api.wipmania.com\r\n";
                $out .= "Typ: php\r\n";
                $out .= "Ver: 1.0\r\n";
                $out .= "Connection: Close\r\n\r\n";
                fwrite($fp, $out);
                while (!feof($fp)) {
                    $country = fgets($fp, 3);
                }
                fclose($fp);
                return $country;
            }
        }
    public function get_all_how_its_work(){
      $query = $this->db->order_by('order')->where(array('status'=>'1','language'=>$this->session->userdata("language")))->get('qu_how_its_work');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    } 
}
?>
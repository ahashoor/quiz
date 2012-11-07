<?php
class Admin_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->dbutil();
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
    /**
     * @return all clients order by id desc 
     */
     public function admin_view_clients()
    {
        $query = $this->db->where('admin', 0)->order_by('id', 'DESC')->get('qu_users');
        if ($query->num_rows() > 0) {
            
             $data = $query->result_array();
                            $new_array = array();
                            $i=0;
                            
                            foreach ($data as $value) :
                                $new_val =array('members'=>$this->db->where('client_id',$value['id'])->count_all_results('qu_members'),
                                                'groups'=>$this->db->where('client_id',$value['id'])->count_all_results('qu_client_groups_assoc'),
                                                'quizzes'=>$this->db->where('client_id',$value['id'])->count_all_results('qu_quiz_assoc'));
                                $new_array[]= array_replace($data[$i], $new_val);
                                $i++;
                            endforeach;
                            
            return $new_array;
        } else {
            return array();
        }
    }
    /**
     * @return datele selectate de id pentru editare
     */
    public function admin_client_data($id)
    {
        $query = $this->db->where('id', $id)->get('qu_users');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }
    public function admin_edit_client($id)
    {
        $update_data = array(
            'full_name' => $this->input->post('full_name'),
            'email' => $this->input->post('email'),
            'status' => $this->input->post('status'),
            'emails_permited' => $this->input->post('email_permited'));
        return $this->db->where('id', $id)->update('qu_users', $update_data);
    }
    
    public function admin_delete_client($id)
    {
        $this->load->helper('file');
        $this->load->helper('directory');
        $dir_general = "./source/public_quiz_images/" . $id;
        $map = directory_map($dir_general, false, true);
        if (!empty($map)) {
            foreach ($map as $folder_name => $val) {
                if (!is_numeric($folder_name)) {
                    $dir_name[] = $dir_general . "/" . $folder_name;
                }
                foreach ($dir_name as $dir) {
                    if (is_dir($dir)) {
                        delete_files($dir);
                        rmdir($dir);
                    }
                }
            }
        }
        if (is_dir($dir_general)) {
            delete_files($dir_general);
            rmdir($dir_general);
        }
        $err = NULL;

        $err .= $this->db->where('client_id', $id)->delete('qu_quiz_assoc');
        $err .= $this->db->where('client_id', $id)->delete('qu_members');
        $err .= $this->db->where('client_id', $id)->delete('qu_quiz_message');
        $err .= $this->db->where('client_id', $id)->delete('qu_client_groups_assoc');
        $err .= $this->db->where('id', $id)->delete('qu_users');
        if(!$err){
                 return FALSE; 
         }else{
             return TRUE;
         }
    }
    
    
    public function admin_update_status($id_u, $id_s)
    {
        //print_r($id_s);
        $update_data = array('status' => $id_s);
        return $this->db->where('id', $id_u)->update('qu_users', $update_data);
    }
    public function back_up_db($file_name)
    {
        $this->load->helper('file');
        $prefs = array('format' => 'txt', );
        $backup = &$this->dbutil->backup($prefs);
        write_file('./source/' . $file_name, $backup);
    }
    public function admin_edit_profile($id)
    {
        $data = $this->admin_client_data($id);
        // email cinfig
        $config['useragent'] = 'Code-Igniter-Mailer-^^';
        $config['mailtype'] = 'html';
        $config['validate'] = true;
        $config['newline'] = "\r\n";
        $this->email->initialize($config);
        $id_template_resetpassword = $this->db->where('template_name', 'Reset Password')->
            get('qu_email_assoc')->row('id_template');
        $content = $this->db->select('email_template_header,email_template_content,email_template_footer')->
            where('id', $id_template_resetpassword)->get('qu_email_template')->row();
        $rep_arr = array('$pass_key', '$nume_key');
        $atribuire = array(
            '$pass_key' => $this->input->post('password'),
            '$nume_key' => $this->input->post('full_name'),
            );
        $uniq_key = $this->input->post('password');
        $content_message = str_replace($rep_arr, $atribuire, $content->
            email_template_content);
        $message = $content->email_template_header . $content_message . $content->
            email_template_footer;
        $this->email->from('Quiz Creator');
        $this->email->to($this->input->post('email'));
        $this->email->subject('Quiz Creator - reset password');
        $this->email->message($message);
        if ($this->input->post('password') && $this->input->post('email')) {
            $pass = md5($this->input->post('password'));
            $this->email->send();
        } else {
            $pass = $data->password;
        }
        $update_data = array(
            'full_name' => $this->input->post('full_name'),
            'email' => $this->input->post('email'),
            'password' => $pass);
        return $this->db->where('id', $id)->update('qu_users', $update_data);
    }
    /**
     * TEMPLATE VIEW
     */
    public function admin_view_templates()
    {
        $query = $this->db->order_by('id', 'ASC')->get('qu_email_assoc');
        if ($query->num_rows() > 0) {
            $data = $query->result_array();
            $new_array = array();
            $i = 0;
            foreach ($data as $value) {
                $new_val = array('temp_name' => $this->admin_get_template_column($value['id_template'],
                        'name'));
                $new_array[] = array_replace($data[$i], $new_val);
                $i++;
            }
            return $new_array;
        } else {
            return array();
        }
    }
    public function admin_get_template_column($id, $col)
    {
        $query = $this->db->select($col)->where('id', $id)->get('qu_email_template');
        if ($query->num_rows() > 0) {
            return $query->row($col);
        } else {
            return false;
        }
    }
    /**
     * ADD EMAIL TEMPLATE
     */
    public function admin_add_email_template()
    {
        $data_insert = array(
            'name' => $this->input->post('template_name'),
            'email_subject'=>$this->input->post('email_subject'),
            'email_template_header' => $this->input->post('header-add_template'),
            'email_template_content' => $this->input->post('content'),
            'email_template_footer' => $this->input->post('footer-add_template'),
            'last_updated'=>date('Y-m-d'),
            'added'=>date('Y-m-d'));
        return $this->db->insert('qu_email_template', $data_insert);
    }
    public function get_all_template()
    {
        $query = $this->db->get('qu_email_template');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }
    /**
     * TEMPLATE EMAIL VIEW BY ID 
     */
    public function admin_email_templates($id)
    {
        $query = $this->db->where('id', $id)->get('qu_email_template');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
    }
    /**
     * vizualizare in manage template de templateuri asociate 
     */
    //   public function email_update_association()
    //    {
    //        $query = $this->db->select('id_update')->get('qu_email_assoc')->result();
    //        foreach ($query as $id) {
    //            $resultat[] = $this->db->where('id', $id->id_update)->get('qu_email_template')->
    //                row('name');
    //        }
    //        return $resultat;
    //        //print_r ($resultat);
    //    }
    /**
     * ADMIN EDIT/UPDATE EMAIL TEMPLATE
     */
    public function admin_edit_email_templates($id)
    {
        $update_data = array(
            'name' => $this->input->post('template_name'),
            'email_subject'=>$this->input->post('email_subject'),
            'email_template_header' => $this->input->post('header'),
            'email_template_content' => $this->input->post('content'),
            'email_template_footer' => $this->input->post('footer'),
            'last_updated'=>date('Y-m-d')
            );
        return $this->db->where('id', $id)->update('qu_email_template', $update_data);
    }
    /**
     * ADMIN UPDATE EMAIL ASSOC
     */
    public function admin_update_email_template_assoc()
    {
        $id_to = explode(',', $this->input->post('to'));
        $update_data = array('id_template' => $this->input->post('template'));
        // de facut o verificare
        foreach ($id_to as $to) {
            $this->db->where('id', $to)->update('qu_email_assoc', $update_data);
        }
        return 1;
    }
    public function add_name_email()
    {
        return $this->db->insert('qu_email_assoc', array('template_name' => $this->input->post('email_name')));
    }
    /**
     * view email template_Association 
     *
     */
    public function admin_email_template_assoc($id){
        $query = $this->db->where('id',$id)->get('qu_email_template');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }
    
     public function admin_delete_email(){
        $query = $this->db->select('id_template')->where('id',$this->input->post('email_id'))->get('qu_email_assoc')->row()->id_template;
        if (!empty($query) ){
            $msg  =array('status'=> 'error','msg'=>"You have Template in this email");
            echo json_encode($msg);die();
        } else {
             return $this->db->where('id',$this->input->post('email_id'))->delete('qu_email_assoc');
        }
    }
    
     public function admin_delete_template($id){
        $query = $this->db->where('id_template',$id)->get('qu_email_assoc');
        if ($query->num_rows() > 0 ){
            $msg  =array('status'=> 'error','msg'=>"You have emails with this template");
            echo json_encode($msg);die();
        } else {
             return $this->db->where('id',$id)->delete('qu_email_template');
        }
    }
    
     public function admin_edit_email(){
        $query = $this->db->where('template_name',$this->input->post('email_name'))->get('qu_email_assoc');
        if ($query->num_rows() > 0) {
            $msg  =array('status'=> 'error','msg'=>"This Email name exist ");
            echo json_encode($msg);die();
        } else {
             return $this->db->where('id',$this->input->post('email_id'))->update('qu_email_assoc',array("template_name"=>$this->input->post('email_name')));
        }
    }
    
    public function attach_quizzes($admin){
          $err='';
          $quiz_name ='';
          $to = explode(',', $this->input->post('to'));
          $i = 0;
          
                foreach( $to as $quiz_id):
                    
                    $exist = $this->db->where('quiz_id',$quiz_id)->where('client_id',$this->input->post('client_id'))->get('qu_quiz_assoc');
                    $separator = ' , ';
                    if(count($to)-1 == $i){
                        $separator = '';
                    }
                    $quiz_name .= ucfirst($this->db->select('quiz_name')->where('id',$quiz_id)->get('qu_quiz')->row()->quiz_name).$separator;
                    
                    if($exist->num_rows()== 0){
                        $data = array('client_id'=>$this->input->post('client_id'),
                                      'quiz_id'=>$quiz_id,
                                      'status'=>'attribuited'
                                       );
                        $this->db->insert('qu_quiz_assoc',$data);   
                        $i++;
                    }else{
                        $msg  =array('status'=> 'error','msg'=>'Quiz already exist');
                        echo json_encode($msg);die();
                    }
                endforeach;
             
                //email settings
                $templateId = $this->db->where('template_name', 'admin_attach_quizzes')->get('qu_email_assoc')->row('id_template');
                $content = $this->db->where('id', $templateId)->get('qu_email_template')->row();

                $searchArray = array(' {{$key_quizzes_nr}}');
                $replaceArray = array($i);
                $intoString = $content->email_template_content;
                $content_final = str_replace($searchArray, $replaceArray, $intoString);

                $message = $this->body . $content->email_template_header . $content_final . $content->email_template_footer.$this->footer;
                $client = $this->db->where('id',  $this->input->post('client_id'))->get('qu_users')->row();
                
                $this->email->from('no_reply@stevie.heliohost.org','Quiz Creator');
                $this->email->reply_to('no_reply@stevie.heliohost.org','Quiz Creator');
                $this->email->to($client->email);
                $this->email->subject($content->email_subject);
                $this->email->message($message);
                $err .= $this->email->send();
                $mess="QuizCreator staff added to your account $i quizzes \nQuizzes name : $quiz_name";
                if($err == 1){
                    $data = array(
                        'client_id'=>$this->input->post('client_id'),
                        'subject'=>$content->email_subject,
                        'sender_id'=>$admin->id,
                        'message'=>$mess,
                        'data'=>date('Y-m-d')
                    );
                    return  $this->db->insert('qu_messages',$data); 
                }else{
                    $msg  =array('status'=> 'error','msg'=>$err);
                    echo json_encode($msg);die();
                }
                
    }
    
    
    public function admin_new_message($id){
        $err = '';
        $data = array(
                'client_id'=>$this->input->post('client_id'),
                'sender_id'=>$id,
                'subject'=>$this->input->post('subject'),
                'message'=>$this->input->post('message'),
                'data'=>date('Y-m-d')
        );
        $client = $this->db->where('id',$data['client_id'])->get('qu_users')->row();
        $sender_name = $this->db->select('full_name')->where('id',$id)->get('qu_users')->row()->full_name;
        
        $searchArray = array('{{$key_client_fullname}}', '{{$key_sender_name}}');
        $replaceArray = array(ucfirst($client->full_name),ucfirst($sender_name));

        
        $message = $this->email_message_template('admin_send_message', $searchArray, $replaceArray);
        
        $err = $this->send_emails($client->email, $this->input->post('subject'), $message);
       

        if($err == 1){
               return  $this->db->insert('qu_messages',$data); 
        }else{
            $msg  =array('status'=> 'error','msg'=>$err);
            echo json_encode($msg);die();
        }
    }
    /* how its work*/
    public function get_all_how_its_work(){
      $query = $this->db->order_by('order')->get('qu_how_its_work');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }
    
    public function add_how_its_work(){
       $order_nr = $this->db->select_max('order','order_nr')->where('language',$this->input->post('language'))->get('qu_how_its_work')->row()->order_nr;
        $data = array(
                'h1'=>$this->input->post('h1'),
                'img1'=>$this->input->post('first_image'),
                'img2'=>$this->input->post('second_image'),
                'text1'=>$this->input->post('first_text'),
                'text2'=>$this->input->post('second_text'),
                'language'=>$this->input->post('language'),
                'status'=>'0',
                'updated'=>date('Y-m-d'),
                'order'=>$order_nr+1
        );
        return  $this->db->insert('qu_how_its_work',$data);
    }
    
    
    public function delete_how_its_work(){
//        $lang = $this->db->select('language')->where('id',$this->input->post('image_id'))->get('qu_how_its_work')->row()->language;
//        $this->db->select_max('order')->where('language',$language)->get('qu_how_its_work')->row()->order;
        return $this->db->where('id',$this->input->post('image_id'))->delete('qu_how_its_work');
    }
    
    public function update_status_how_its_work(){
        return $this->db->where('id',$this->input->post('image_id'))->update('qu_how_its_work',array("status"=>$this->input->post('status')));
    }
    
    public function edit_how_its_work($id){
        $this->firephp->log($_REQUEST);
     
         $data = array(
                'h1'=>$this->input->post('h1'),
                'img1'=>trim($this->input->post('first_image')),
                'img2'=>trim($this->input->post('second_image')),
                'text1'=>$this->input->post('first_text'),
                'text2'=>$this->input->post('second_text'),
                'language'=>$this->input->post('language')
        );
        return $this->db->where('id',$id)->update('qu_how_its_work',$data);
     
    }
    
     function change_order(){
      
       $ro = explode(',',$this->input->post('ro'));
       $en = explode(',',$this->input->post('en'));
       $err ='';
       if(strlen($ro[0])>0){
       $i=1;
       foreach($ro as $ids):
        $oldOrder = $this->db->select('order')->where(array('id'=>$ids,'language'=>'ro'))->get('qu_how_its_work')->row()->order;
        $id = $this->db->select('id')->where(array('order'=>$i,'language'=>'ro'))->get('qu_how_its_work')->row()->id;
        $err.=$this->db->where(array('id'=>$ids,'language'=>'ro'))->update('qu_how_its_work', array('order' => $i));
        $err.=$this->db->where(array('id'=>$id,'language'=>'ro'))->update('qu_how_its_work', array('order' => $oldOrder));
         $i++;
       endforeach;
       }
       if(strlen($en[0])>0){
       $j=1;
       foreach($en as $ids):
        $oldOrder1 = $this->db->select('order')->where(array('id'=>$ids,'language'=>'en'))->get('qu_how_its_work')->row()->order;
        $id = $this->db->select('id')->where(array('order'=>$j,'language'=>'en'))->get('qu_how_its_work')->row()->id;
        $err.=$this->db->where(array('id'=>$ids,'language'=>'en'))->update('qu_how_its_work', array('order' => $j));
        $err.=$this->db->where(array('id'=>$id,'language'=>'en'))->update('qu_how_its_work', array('order' => $oldOrder1));
         $j++;
       endforeach;
       }
//       $err_length = strlen($err)-1;
//       for($l=0; $l<= $err_length;$l++){
//         $this->firephp->log($err[$l]);
//       }
    return TRUE;
        
    }
    /*end how its work*/
    
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

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Superadmin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
	
    	$this->load->view('superadmin/home');

	}


public function anaylatics(){
    $d['no_of_admin']=count($this->db->select('id')->where('type','admin')->get('users')->result_array());
    $d['no_of_opertaor']=count($this->db->select('id')->where('type','operator')->get('users')->result_array());
    $d['no_of_site']=count($this->db->get('site')->result_array());
     $d['no_of_sensor']=count($this->db->select('sensor_id')->get('Sensor')->result_array());
    $this->load->view('superadmin/analytics',$d);
}

    public function site(){
        $d['site']=$this->db->get('site')->result_array();
        $this->load->view('superadmin/site',$d);

    }
   
    
    public function adminlist (){
        $d['adminlist']=$this->db->where('type','admin')->get('users')->result_array();
        $this->load->view('superadmin/adminlist',$d);

    }
    
    public  function editadmin($id){
        
            $d['adminlist']=$this->db->where('id',$id)->get('users')->row_array();
    	 $d['id']=$id;     
                $d['site']=$this->db->get('site')->result_array();
        $d['adminsite']=$this->db->where('user_id',$id)->get('adminsite')->result_array();
		$this->load->view('superadmin/editadmin',$d);
    }
    
    
    public function addnewadmin(){
        $d['site']=$this->db->get('site')->result_array();
        $this->load->view('superadmin/addnewadmin',$d);
    }
    
    

    //addadmindata
    public function addadmindata(){
    $d= $this->db->where('email',$this->input->post('email'))->get('users')->row_array();
        if(empty($data)){
            $j['email']=$this->input->post('email');
            $j['password']=$this->input->post('password');
            $j['username']=$this->input->post('username');
            $j['type']='admin';
            $j['status']=1;
            $this->db->insert('users',$j);
            $insert_id = $this->db->insert_id();
            $c['user_id']=$insert_id;
            $c['site_id']=$this->input->post('site_id');
            $this->db->insert('adminsite',$c);
            $this->session->set_flashdata('success', 'Data has been Added Sucessfully.');
            redirect(base_url().'superadmin/addnewadmin/');
        }else{
 //error           
 $this->session->set_flashdata('error', 'Email already Exist.');
 redirect(base_url().'superadmin/adminlist/');


        }


        $this->load->view('superadmin/addnewadmin',$d);
    }
    
    function deleteadmin($id){
	$this->db->where('id',$id);
	 $this->db->delete('users');
$this->db->where('user_id',$id);
	 $this->db->delete('adminsite');
	 	 $this->session->set_flashdata('error', 'Email already Exist.');
	 redirect(base_url().'superadmin/adminlist/'.$id);
        
    }
    

function editadmindata($id){
	    $d= $this->db->where('email',$this->input->post('email'))->where('id<>',$id)->get('users')->row_array();
	    
	    if(empty($d)){
	        	$j['email']=$this->input->post('email');
	        	$j['username']=$this->input->post('username');
	        	if($this->input->post('password') !=""){
	        	$j['password']=$this->input->post('password');
	        	}
	        	$this->db->where('id',$id);
	        	$this->db->update('users',$j);
        	$this->db->where('user_id',$id);
	        	$this->db->delete('adminsite');
	        	
	        	$sitelist=$this->input->post('site_id');
	        	    for($i=0;$i<count($sitelist);$i++){
	        	        
	        	 $c['user_id']=$id;
            $c['site_id']=$sitelist[$i];
            $this->db->insert('adminsite',$c);
	        	        
	        	    }
	        	
	        	
	        	
	        	
	        	$this->session->set_flashdata('success', 'Data has been update Sucessfully.');
				redirect(base_url().'superadmin/editadmin/'.$id);
	    }else{
	 $this->session->set_flashdata('error', 'Email already Exist.');
	 redirect(base_url().'superadmin/editadmin/'.$id);
	       
	    }
}


    //addsite
    public function addsite(){
        $this->load->view('superadmin/addsite');
    }
    
    
    public function  editprofile(){
                $this->load->view('superadmin/editprofile');
    }
    
    
    
    //  
     public function editsite($id){
         $d['adminlist']=$this->db->where('site_id',$id)->get('site')->row_array();
    	 $d['id']=$id;     
     
        $this->load->view('superadmin/editsite',$d);
    }   
    
    
    function editprofiledata(){
        $d['username']=$this->input->post('name');
        	$this->session->set_userdata('name', $d['username']);


        
        $insert_id = $this->session->userdata('admin_id');
        if( move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/profile/' . $insert_id . '.jpg')){
        $d['profile_photo']=base_url().'uploads/profile/' . $insert_id . '.jpg';   
        	$this->session->set_userdata('profile_photo', $d['profile_photo']);	
        }
        $this->db->where('id',$insert_id);
        $this->db->update('users',$d);
    $this->session->set_flashdata('success', 'Data Has Been Update.');
        redirect(base_url().'superadmin/editprofile/');        
        
        
        
    }
    
    
    
    
    
//addsitedata
public function addsitedata(){
   
    $this->db->insert('site',$this->input->post());

    $this->session->set_flashdata('success', 'Data Has Been Saved.');
        redirect(base_url().'superadmin/addsite/');
}
public function editsitedata($id){
    $this->db->where('site_id',$id); 
    $this->db->update('site',$this->input->post());

    $this->session->set_flashdata('success', 'Data Has Been Saved.');
        redirect(base_url().'superadmin/addsite/');
}





}
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Operator extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
	    redirect(base_url().'Operator/sensor');
		$this->load->view('operator/home');


	}
	function editoproifledata($id){
	    $d= $this->db->where('email',$this->input->post('email'))->where('id<>',$id)->get('users')->row_array();
	    if(empty($d)){
	        	$j['email']=$this->input->post('email');
	        	$j['username']=$this->input->post('username');
	        	if($this->input->post('password') !=""){
	        	$j['password']=$this->input->post('password');
	        	}
				if(move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/profile/' . $id . '.jpg'))  {
					$j['profile_photo']=base_url().'uploads/profile/' . $id . '.jpg';
						}
				$this->db->where('id',$id);
	        	$this->db->update('users',$j);





	        	$this->session->set_flashdata('success', 'Data has been update Sucessfully.');
				redirect(base_url().'Operator/profile/'.$id);
	    }else{
	 $this->session->set_flashdata('error', 'Email already Exist.');
	 redirect(base_url().'Operator/profile/'.$id);
	       
	    }
	    
	    
	    
	}
	function profile(){
		$d['id']=$this->session->userdata('admin_id');
		$d['adminlist']=$this->db->where('id',$this->session->userdata('admin_id'))->get('users')->row_array();
		$this->load->view('operator/editprofile',$d);
	
	}
	
		function sensor(){
	   
	   $parent_id=$this->db->where('user_id',$this->session->userdata('admin_id'))->get('adminoperator')->row()->admin_id;
	   
	   
	    $d['adminlist']=$this->db->where('user_id',$parent_id)->get('Sensor')->result_array();

		$this->load->view('operator/Sensor',$d);
	}
		public function sensorreading(){
	    $this->db->select ( '*' ); 
     //$this->db->group_by('sensor_data.sensor_id');	   
    $this->db->from ( 'Sensor' );
    //$this->db->join ( 'sensor_data', 'sensor_data.sensor_id = Sensor.sensor_id' , 'left' );
    //$this->db->order_by('sensor_data.id','desc');


   
 $d['adminlist'] = $this->db->get()->result_array();
	 $this->load->view('operator/sensorreading',$d);
	    
	    
	    
	}
	
}
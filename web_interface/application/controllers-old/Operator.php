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
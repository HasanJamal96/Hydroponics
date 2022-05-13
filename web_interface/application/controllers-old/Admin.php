<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}
	public function addnewoperator(){
        $d['site']=$this->db->get('site')->result_array();
        $this->load->view('admin/addnewoperator',$d);
    }
    
    //camlist
    
	public function camlist()
	
	{
	    $x=array();
	    $i=0;
    $d['adminlist']=$this->db->where('admin_id',$this->session->userdata('admin_id'))->get('camera')->result_array();
    	  

		$this->load->view('admin/camlist',$d);


	}
	function editoperator($id){
	    $d['adminlist']=$this->db->where('id',$id)->get('users')->row_array();
    	 $d['id']=$id;     
        
		$this->load->view('admin/editoperator',$d);
		
	}
	
	
	function deleteoperator($id){
	    	
				$this->db->where('id',$id)->delete('users');
				

				$this->db->where('user_id',$id)->where('admin_id',$this->session->userdata('admin_id'))->delete('adminoperator');
				$this->session->set_flashdata('success', 'Data has been Removed Sucessfully.');
				redirect(base_url().'admin/');
	}
	
	
	
	public function viewtimeslice($id){
	    $startdate=$this->input->get('start_date');
	    $enddate=$this->input->get('end_date');
	    $x['images_data']=$this->db->where('inserted_date BETWEEN "'. date('Y-m-d', strtotime($startdate)). '" and "'. date('Y-m-d', strtotime($enddate)).'"')->get('timelapes')->result_array();
        // echo "<pre>";
        // print_r($x);
        // echo "</pre>";
	    	$this->load->view('admin/viewtimelapes',$x);
	    
	}
	
	public function deletecam($id){
	    $this->db->where('camera_id',$id)->delete('camera');
	    	    		redirect(base_url().'admin/camlist/');	    
	}
	
	
	public function viewcam($id){
	    $x=array();
	    $i=0;
$d['adminlist']=$this->db->where('camera_id',$id)->get('camera')->row_array();
$d['cam_id']=$id;
    	  

		$this->load->view('admin/viewcam',$d);

	}
	
	
	//addnewcam
	public function addnewcam(){

        $this->load->view('admin/addcam');
    }
    
    	public function addnewoutput(){

        $this->load->view('admin/addnewoutput');
    }
    
    //addnewtrigger
    	public function addnewtrigger(){

        $this->load->view('admin/addnewtrigger');
    }
    public function output(){
        $this->load->view('admin/output');
    }
    //trigger
        public function trigger(){
        $this->load->view('admin/trigger');
    }
    
    //editcam    
    public function editcam($id){
            $data['id']=$id;
        $this->load->view('admin/editcam',$data);
    }
    
    //addnewsensor
	public function addnewsensor(){

        $this->load->view('admin/addnewsensor');
    }
    

	public function index()
	
	{
	    $x=array();
	    $i=0;
    $mydata=$this->db->where('admin_id',$this->session->userdata('admin_id'))->get('adminoperator')->result_array();
    	    foreach($mydata as $my){
    	     $x[$i]=$my['user_id'];
    	     $i=$i+1;
    	    }
	    
	    if(!empty($x)){
	    $d['adminlist']=$this->db->where('type','operator')->where_in('id',$x)->get('users')->result_array();    
	    }else{
	        $d['adminlist']="";
	    }
		

		$this->load->view('admin/home',$d);


	}
	function sensor(){
	   
	   
	   
	    $d['adminlist']=$this->db->where('user_id',$this->session->userdata('admin_id'))->get('Sensor')->result_array();

		$this->load->view('admin/Sensor',$d);
	}
	
function edit_sensor($id){
    	    $d['adminlist']=$this->db->where('sensor_id',$id)->get('Sensor')->row_array();
    	    $d['id']=$id;

		$this->load->view('admin/editSensor',$d);
    
}


//
function associatinlist($id){
    	    $d['adminlist']=$this->db->where('sensor_id',$id)->get('Sensor')->row_array();
    	    $d['id']=$id;

		$this->load->view('admin/associatinlist',$d);
    
}
function editoutput($id){
    
    	    $d['adminlist']=$this->db->where('output_id',$id)->get('output')->row_array();
    	    $d['id']=$id;

		$this->load->view('admin/editoutput',$d);
}



	
	
	function camconfigration($id){
	        $d['adminlist']=$this->db->where('camera_id',$id)->get('camera')->row_array();
    	    $d['id']=$id;

		$this->load->view('admin/camconfigration',$d);
	}
	
	function stopcam(){
$data['mode']='stop';	
$data['intrupt_by_admin']=1;
$data['start_time']="";
$data['end_time']="";
$data['canfigration']=0;
$this->db->where('camera_id',$this->input->post('cam_id'))->update('camera',$data);
$j['sucess']=1;
$j['mode']="";
echo json_encode($j);
exit;	    
	}
	
	

	
	function setstrat($camid,$status){
	    //echo $status;
	    $data=array();
	    if($status==0){
    $data['mode']="stop";	
    			$this->session->set_flashdata('success', 'Cam is Now Stop.');
	    }else{
	        $data['mode']="start";	       
    			$this->session->set_flashdata('success', 'Cam is Now Start.');
	    }
	
$data['intrupt_by_admin']=1;
$this->db->where('camera_id',$camid)->update('camera',$data);

	   // print_r($data);		
	    		redirect(base_url().'admin/camlist/');	    
	}
	
	
	function startcam(){
$type=$this->input->post('type');

if($type==1){
$data['mode']=$this->input->post('mode');	
$data['intrupt_by_admin']=1;
$data['start_time']="";
$data['end_time']="";
$data['canfigration']=1;
$this->db->where('camera_id',$this->input->post('cam_id'))->update('camera',$data);
$j['sucess']=1;
$j['mode']=$data['mode'];
echo json_encode($j);
exit;
}else{
$data['mode']=$this->input->post('mode');	
$data['intrupt_by_admin']=1;
$data['start_time']=$this->input->post('start_time');
$data['end_time']=$this->input->post('end_time');
$data['canfigration']=1;
$this->db->where('camera_id',$this->input->post('cam_id'))->update('camera',$data);
$j['sucess']=1;
$j['mode']=$data['mode'];
echo json_encode($j);
exit;
}




	    
	    echo json_encode($this->input->post());
	}
	
	
	
	
	function delete_sensor($id){
	    
	    $x=$this->db->where('sensor_id',$id)->get('Sensor')->row_array();
	    
	    $k['sensor_id']=$id;
	    $k['sensor_name']=$x['name'];
	    $this->db->insert('delete_sensor',$k);
	    		$this->db->where('sensor_id',$id);
				$this->db->delete('Sensor');
	   
	    					$this->session->set_flashdata('success', 'Data has been Removed Sucessfully.');
	    		redirect(base_url().'admin/sensor/');
	}
	
	
	
	//addsensordata
	public function addsensordata(){
	   //         echo "<pre>";
		  //  	print_r($this->input->post());
		    	
		    	$html="";
		    			    $index=$this->input->post('selectedv');	
		    			    $myindex=explode(",",$index);
		    	
		    	for($i=0;$i<count($myindex);$i++){
		    	    
		    	   // $html .= "{".$this->input->post('label'.$i).
		    	    $html .='{"label":"'.$this->input->post('label'.$myindex[$i]).'","min-value":"'.$this->input->post('minvalue'.$myindex[$i]).'","unit":"'.$this->input->post('minunit'.$myindex[$i]).'", "max-val":"'.$this->input->post('maxvalue'.$myindex[$i]).'" ,"unit":"'.$this->input->post('maxunit'.$myindex[$i]).'" }';
		            if($i != count($myindex) - 1 ){
		            $html .=",";    
		            } 	    
		    
		    	}
		    	
		  //  	echo $html;
		  //  	echo "</pre>";
		    	
		    	$c['name']=$this->input->post('name');
		    	$c['sensor_type']=$this->input->post('sensor_type');
		    	$c['sensor_type_description']=$this->input->post('sensor_type_description');
		    	//sensor_type
				$c['user_id']=$this->session->userdata('admin_id');
				$c['intrupt_by_admin']=1;
				//print_r($this->input->post());
				$c['default_value']="[".$html."]";
				
				
				//'[{"min-val":"'.$this->input->post('minvalue').'","unit":"'.$this->input->post('minunit').'"},{"max-val":"'.$this->input->post('minvalue').'","Unit":'.$this->input->post('minunit').'}]';
				//echo $finalval;
				
				
			//	exit;
				
				$this->db->insert('Sensor',$c);
					$this->session->set_flashdata('success', 'Data has been Added Sucessfully.');
				redirect(base_url().'admin/addnewsensor/');
			
	    
	}
	
	function updatesensordatawithout($id){
	    	$c['intrupt_by_admin']=1;
	    	$c['output_id']=$this->input->post('output_id');
	    		$this->db->where('sensor_id',$id);
				$this->db->update('Sensor',$c);
	   
	    					$this->session->set_flashdata('success', 'Data has been updated Sucessfully.');
	    		redirect(base_url().'admin/associatinlist/'.$id);
	}
	
	public function updatesensordata($id){
	    	$html="";
		    			    $index=$this->input->post('selectedv');	
		    			    $myindex=explode(",",$index);
		    	
		    	for($i=0;$i<count($myindex);$i++){
		    	    
		    	   // $html .= "{".$this->input->post('label'.$i).
		    	    $html .='{"label":"'.$this->input->post('label'.$myindex[$i]).'","min-value":"'.$this->input->post('minvalue'.$myindex[$i]).'","unit":"'.$this->input->post('minunit'.$myindex[$i]).'", "max-val":"'.$this->input->post('maxvalue'.$myindex[$i]).'" ,"unit":"'.$this->input->post('maxunit'.$myindex[$i]).'" }';
		            if($i != count($myindex) - 1 ){
		            $html .=",";    
		            } 	    
		    
		    	}
	  
	  
	    	$c['name']=$this->input->post('name');
			$c['user_id']=$this->session->userdata('admin_id');
			$c['sensor_type']=$this->input->post('sensor_type');
		   	$c['sensor_type_description']=$this->input->post('sensor_type_description');
			$c['intrupt_by_admin']=1;
				//print_r($this->input->post());
								$c['default_value']="[".$html."]";
	//		$c['default_value']='[{"min-val":"'.$this->input->post('minvalue').'","unit":"'.$this->input->post('minunit').'"},{"max-val":"'.$this->input->post('maxvalue').'","unit":"'.$this->input->post('minunit').'"}]';

				$this->db->where('sensor_id',$id);
				$this->db->update('Sensor',$c);
	            $this->session->set_flashdata('success', 'Data has been Added Sucessfully.');
	    		redirect(base_url().'admin/edit_sensor/'.$id);
	}
	
	public function sensorreading(){
	    $this->db->select ( '*' ); 
     //$this->db->group_by('sensor_data.sensor_id');	   
    $this->db->from ( 'Sensor' );
    //$this->db->join ( 'sensor_data', 'sensor_data.sensor_id = Sensor.sensor_id' , 'left' );
    //$this->db->order_by('sensor_data.id','desc');


   
 $d['adminlist'] = $this->db->get()->result_array();
//  echo "<pre>";
//  print_r($d);
//  echo "</pre>";
	 $this->load->view('admin/sensorreading',$d);
	    
	    
	    
	}
	
	
	//addoutputdata
	public function addoutputdata(){
	        $j=$this->input->post();
				$this->db->insert('output',$j);
				$insert_id = $this->db->insert_id();
				$this->session->set_flashdata('success', 'Data has been Added Sucessfully.');
				redirect(base_url().'admin/addnewoutput/');
	    
	}
	 public function editoutputdata($param){
	     
	        $j=$this->input->post();
	        $this->db->where('output_id',$param);
				$this->db->update('output',$j);
				$c['intrupt_by_admin']=1;
			$this->db->where('output_id',$param)->update('Sensor',$c);	
				
				

				$this->session->set_flashdata('success', 'Data has been Added Sucessfully.');
				redirect(base_url().'admin/editoutput/'.$param);
	 }
	
	
	public function  deleteoutput($param1){
	    $l['output_id']="";
	    $l['intrupt_by_admin']=1;
	    
	    $this->db->where('output_id',$param1)->update('Sensor',$l);
	    $this->db->where('output_id',$param1)->delete('output');
	    		$this->session->set_flashdata('success', 'Data has been Removed Sucessfully.');
				redirect(base_url().'admin/output/');
	}
	
	
	
	
	
	public function addcamdata(){
	    	$j['mode']='stop';
	        	$j['picperhour']=$this->input->post('picperhour');
	        	$j['camtype']=$this->input->post('camtype');
	        	$j['livecamresolation']=$this->input->post('livecamresolation');
	        	$j['rotation']=$this->input->post('rotation');
	        	$j['livecamfps']=$this->input->post('livecamfps');
	        	$j['livecamkey']=$this->input->post('livecamkey');
				$j['admin_id']=$this->session->userdata('admin_id');
				$j['status']=1;
	            $j['cam_name']=$this->input->post('cam_name');
				$this->db->insert('camera',$j);
				$insert_id = $this->db->insert_id();
				$this->session->set_flashdata('success', 'Data has been Added Sucessfully.');
				redirect(base_url().'admin/addnewcam/');
			
	}
	
	//editcamdata
		public function editcamdata($id){

	    	
	    	$j['mode']='stop';
	        	$j['picperhour']=$this->input->post('picperhour');
	        	$j['camtype']=$this->input->post('camtype');
	        	$j['livecamresolation']=$this->input->post('livecamresolation');
	        	$j['rotation']=$this->input->post('rotation');
	        	$j['livecamfps']=$this->input->post('livecamfps');
	        	$j['livecamkey']=$this->input->post('livecamkey');
	        	$j['embedcode']=$this->input->post('embedcode');
				$j['admin_id']=$this->session->userdata('admin_id');
				$j['status']=1;
                $j['intrupt_by_admin']=1;
                $j['canfigration']=1;
				$j['cam_name']=$this->input->post('cam_name');
				$this->db->where('camera_id',$id);
				$this->db->update('camera',$j);
				$insert_id = $this->db->insert_id();
				$this->session->set_flashdata('success', 'Data has been Added Sucessfully.');
				redirect(base_url().'admin/editcam/'.$id);
			
	}
	
	function editoperatordata($id){
	    $d= $this->db->where('email',$this->input->post('email'))->where('id<>',$id)->get('users')->row_array();
	    if(empty($d)){
	        	$j['email']=$this->input->post('email');
	        	$j['username']=$this->input->post('username');
	        	if($this->input->post('password') !=""){
	        	$j['password']=$this->input->post('password');
	        	}
	        	$this->db->where('id',$id);
	        	$this->db->update('users',$j);
	        	$this->session->set_flashdata('success', 'Data has been update Sucessfully.');
				redirect(base_url().'admin/editoperator/'.$id);
	    }else{
	 $this->session->set_flashdata('error', 'Email already Exist.');
	 redirect(base_url().'admin/editoperator/'.$id);
	       
	    }
	    
	    
	    
	}
	
	
	
	
	//addoperatordata
	public function addoperatordata(){
		$d= $this->db->where('email',$this->input->post('email'))->get('users')->row_array();
			if(empty($data)){
				$j['email']=$this->input->post('email');
				$j['password']=$this->input->post('password');
				$j['username']=$this->input->post('username');
				$j['type']='operator';
				$j['status']=1;
				$this->db->insert('users',$j);
				$insert_id = $this->db->insert_id();
				$c['user_id']=$insert_id;
				$c['admin_id']=$this->session->userdata('admin_id');
				$this->db->insert('adminoperator',$c);
				$this->session->set_flashdata('success', 'Data has been Added Sucessfully.');
				redirect(base_url().'admin/addnewoperator/');
			}else{
	 //error           
	 $this->session->set_flashdata('error', 'Email already Exist.');
	 redirect(base_url().'admin/addnewoperator/');
	
	
			}
	
	

		}

}
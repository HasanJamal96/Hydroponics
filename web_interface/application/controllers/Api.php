<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();


    }

    public function test(){
//set the sesnor name
    $lol=array("BME280","Light","Promity","Gas sensor","Particulate Matter"
,"Noise Sensor");
    
    for($i=0;$i<count($lol);$i++){
        $c['name']=$lol[$i];
        $this->db->insert('ripiesensor',$c);
    }
    
    
    }
    public function readSesnor(){
        $k['success']=1;
        $k['sensor']=$this->db->select('*')->where('user_id',$this->input->post('user_id'))->get('ripiesensor')->result_array();
        echo json_encode($k);
    }
    
    
    public function addheatdata(){
      
      
        
         $json = file_get_contents('php://input');
                        $da = json_decode($json);
        		$data['floor_id']=$da->floor_id;
				$data['data']=$da->data;
      
        
        if($this->db->insert('heatsensor_data',$data)){
            $k['success']=1;
            $k['msg']="data has been added";
            echo json_encode($k);
            exit;
        }else{
            $k['success']=0;
            $k['msg']="SOme Error";
            echo json_encode($k);
            exit;
        }    
        
    }
    
    
    public function postsensordata(){
      
        $x=$this->db->where('id',$this->input->post('sensor_id'))->get('ripiesensor')->row_array();
        if(!empty($x)){
                
            $data['sensor_id']=$this->input->post('sensor_id');
            $data['sensor_data']=$this->input->post('sensor_data');
            $this->db->insert('ressensor_data',$data);
            $d['sucess']=1;
          
            $d['snsor_value']=$this->db->where('sensor_id',$data['sensor_id'])->order_by('id','desc')->get('ressensor_data')->row_array();
            echo json_encode($d);
                
            
        }else{
            //
            $data['success']=1;
            $data['error']=1;
            $data['msg']="sensor is not defined";
            echo json_encode($data);
            
            
        }
        
        
        
    }
    
    	function uploadtimelapes(){
	    if(isset($_REQUEST['image'])){
	        $data['cam_id']=$this->input->post('cam_id');	
            $data['inserted_date']=date("Y-m-d");
            $data['time']=date("g:i a");  

            $this->db->insert('timelapes',$data);
	        $insert_id=$this->db->insert_id();		
	            	  $base=$_REQUEST['image']; 
	            $filename =$insert_id.rand().'.png';
                    	$ndata['image_url']=base_url().'/uploads/'.$filename;
                    	$profile_link=base_url().'/uploads/'.$filename;
                    	  $binary=base64_decode($base);
                    	  header('Content-Type: bitmap; charset=utf-8');
                    	// Images will be saved under 'www/imgupload/uplodedimages' folder
                        $file = fopen($_SERVER['DOCUMENT_ROOT'].'/Hydroponics/uploads/'.$filename, 'wb');
                    	// Create File
                        fwrite($file, $binary);
                        fclose($file);
                        $this->db->where('timelapes_id',$insert_id);
                        $this->db->update('timelapes',$ndata);
                        $data['success']=1;
            $data['error']=0;
            $data['msg']="image has been uploaded successfully.";
                   echo json_encode($data);
	            }else{
	                $data['success']=0;
            $data['error']=1;
            $data['msg']="image is not defined";
                   echo json_encode($data);
	            }
	}
	
	
    
    public function readSesnorName(){
        $k['success']=1;
        $lol=array();
        $k1=$this->db->select('*')->get('Sensor')->result_array();
        foreach($k1 as $y){
            $c['sensor_id']=$y['sensor_id'];
            $c['name']=$y['name'];
            $c['interface']=$y['sensor_type'];
            $c['interface_description']=$y['sensor_type_description'];
            $c['trigger']=$y['default_value'];
            if($y['output_id']==""){
            $c['output']="";                
            }else{
            $c['output']=$this->db->where('output_id',$y['output_id'])->get('output')->row_array();
            }

            array_push($lol,$c);
        }
        $k['sensor']=$lol;
        
        echo json_encode($k);
    }
    
    //intrupt_by_admin
        public function readintruptedSesnorName(){
        $k['success']=1;
        $k1=$this->db->select('*')->where('intrupt_by_admin',1)->get('Sensor')->result_array();
         $lol=array();
    
        foreach($k1 as $y){
            $c['sensor_id']=$y['sensor_id'];
            $c['name']=$y['name'];
            $c['interface']=$y['sensor_type'];
            $c['interface_description']=$y['sensor_type_description'];
            $c['trigger']=$y['default_value'];
            if($y['output_id']==""){
            $c['output']="";                
            }else{
            $c['output']=$this->db->where('output_id',$y['output_id'])->get('output')->row_array();
            }

            array_push($lol,$c);
        }
        $k['sensor']=$lol;
        $k['delete_sesnor']=$this->db->get('delete_sensor')->result_array();
           $this->db->where('delete_sensor_id>',0)->delete('delete_sensor');     
    
    
    
        $k['camsensor']=$this->db->select('*')->get('camera')->result_array();
        $c1['intrupt_by_admin']=0;
        $this->db->where('intrupt_by_admin',1)->update('Sensor',$c1);
          $c1['intrupt_by_admin']=0;
        $this->db->where('intrupt_by_admin',1)->update('camera',$c1);
        
        echo json_encode($k);
    }
    
    function readdataapi(){
            $data=array();
         $adminlist=$this->db->get('Sensor')->result_array();
       foreach($adminlist as $ad){ 
           $x1=$this->db->order_by('id','desc')->where('sensor_id',$ad['sensor_id'])->get('sensor_data')->row_array();
            $j=array();
            $j['sensor_info']=$ad;
            $j['lastreading']=$x1;
           array_push($data,$j);
       }
    
    echo json_encode($data);
    
        
    }
    
    
    
    public function postsensorvalue(){
      
        $x=$this->db->where('sensor_id',$this->input->post('sensor_id'))->get('Sensor')->row_array();
        if(!empty($x)){
            if($x['intrupt_by_admin']==0){
                ///get //simplevalues form data
                
            $data['sensor_id']=$this->input->post('sensor_id');
            $data['sensor_data']=$this->input->post('sensor_data');
            $this->db->insert('sensor_data',$data);
            $d['sucess']=1;
            $d['intrupt']=0;
            $d['snsor_value']=$this->db->where('sensor_id',$data['sensor_id'])->order_by('id','desc')->get('sensor_data')->row_array();
            echo json_encode($d);
                
            }else{
                
                    $data['sensor_id']=$this->input->post('sensor_id');
            $data['sensor_data']=$this->input->post('sensor_data');
            $this->db->insert('sensor_data',$data);
            $d['sucess']=1;
            $d['intrupt']=1;
            $d['snsor_value']=$this->db->where('sensor_id',$data['sensor_id'])->where('status',1)->order_by('id','desc')->get('sensor_data')->row_array();
            $c['status']=0;
            $l['intrupt_by_admin']=0;
            $this->db->where('sensor_id',$data['sensor_id'])->where('status',1)->update('sensor_data',$c);
            $this->db->where('sensor_id',$data['sensor_id'])->update('Sensor',$l);
            echo json_encode($d);
                        
                
            }
        }else{
            //
            $data['success']=1;
            $data['error']=1;
            $data['msg']="sensor is not defined";
                   echo json_encode($data);
            
            
        }
        
        
        
    }
    
       function verify($email){
	    $credential = array('user_email' => $email);
	 $query = $this->db->get_where('mqtt_user', $credential);
	if ($query->num_rows() > 0) {

return 1;
    } else{
	return 0;
    }
    }
    
    function devices($param1){
        	   if($param1=="adddevices"){
        		$data['device_name']=$this->input->post('device_name');
				$data['user_id']=$this->input->post('user_id');
				$data['lat']=$this->input->post('lat');
				$data['lng']=$this->input->post('lng');
				
                $this->db->insert('devices',$data);
				$insert_id=$this->db->insert_id();	
        	   $response['success']=1;
							$response['result']=$this->db->get_where('devices',array('id' => $insert_id ))->row_array();
	
							$response['message']="You have sucessfully Registerd";			
        	       
        	   }
		echo json_encode($response);        	   
        
    }
    
    
        function mqttsensor($param1){
        	   if($param1=="addsensor"){
        		$data['sensor_name']=$this->input->post('sensor_name');
				$data['device_id']=$this->input->post('device_id');
				$data['threashold_value']=$this->input->post('threashold_value');
			
				
                $this->db->insert('mqttsensor',$data);
				$insert_id=$this->db->insert_id();	
        	   $response['success']=1;
							$response['result']=$this->db->get_where('mqttsensor',array('id' => $insert_id ))->row_array();
	
							$response['message']="You have sucessfully Registerd";			
        	       
        	   }
		echo json_encode($response);        	   
        
    }
       function mqttsensoraddvalue($param1){
        	   if($param1=="addsensorvalue"){
        		$data['sensor_id']=$this->input->post('sensor_id');
				$data['data']=$this->input->post('data');
			
			
				
                $this->db->insert('mqttsensorvalue',$data);
				$insert_id=$this->db->insert_id();	
        	   $response['success']=1;
							$response['result']=$this->db->get_where('mqttsensorvalue',array('id' => $insert_id ))->row_array();
	
							$response['message']="You have sucessfully Registerd";			
        	       
        	   }
		echo json_encode($response);        	   
        
    }
    
    
    function admin($param1=""){
        if($param1=="dashboard"){
               $response['success']=1;
                $res['active']=$this->db->where('active',1)->get('devices')->num_rows();
                $res['offline']=$this->db->where('active',0)->get('devices')->num_rows();;
                $res['issue']=$this->db->where('active',2)->get('devices')->num_rows();
                $res['total']=$res['active']+$res['offline']+$res['issue'];
                $res['devices']=$this->db->get('devices')->result_array();
                $response['dashboard']=$res;
        }
        if($param1=="list_of_sesnor"){
               $response['success']=1;
              
                $res['devices']=$this->db->where('mqttsensor.device_id',$this->input->post('device_id'))->get('mqttsensor')->result_array();
                $response['dashboard']=$res;
        }
        
        
    	echo json_encode($response);        	   
        
    }
    
    
    
    function users($param1){
			   if($param1=="app_register"){
			       
				$id=0;
				 $data['phone_number']=$this->input->post('phone_number');
				$data['first_name']=$this->input->post('first_name');
				$data['last_name']=$this->input->post('last_name');
				$data['user_email']=$this->input->post('user_email');
				$data['user_password']=$this->input->post('user_password');
				$data['role']=$this->input->post('role');
				$data['companey']=$this->input->post('companey');
				$data['land_line']=$this->input->post('land_line');
				$data['user_type']=$this->input->post('user_type');			
		$flag=$this->verify($data['user_email']);
		if($flag==0){
			//////////////////role for normaluser/////
		
				$this->db->insert('mqtt_user',$data);
				$insert_id=$this->db->insert_id();		
			
						
			

							$response['success']=1;
							$response['result']=$this->db->get_where('mqtt_user',array('id' => $insert_id ))->row_array();
	
							$response['message']="You have sucessfully Registerd";			
				}
					else{
							$response['success']=0;
							$response['error']=1;
							$response['message']="user is already register againest this email";
						}

			}
			else if($param1=="app_login"){
			
			    	$user_email=$this->input->post('user_email');
			$user_password=$this->input->post('user_password');
			$flag=$this->verifyUser($user_email,$user_password);
			if($flag==0){
			$response['success']=0;
            	$response['result']="";
	    	$response['message']="Invalid User";
			}
			else{
			$response['success']=1;
	        $response['result']=$flag;

	
	
	
	$rdata['msg']="You have sucessfully Login";
			}
			}else if($param1=="update_tokken"){
			    	$data['token_id']=$_REQUEST['token_id'];
	$this->db->where('user_id',$_REQUEST['user_id']);
$this->db->update('users',$data);
	$response['success']=1;
        $response['message']="Token Update Sucessfully.";
			}
			else  if($param1=="update_profile"){
			       
				$id=0;
				
		 $data['phone_number']=$this->input->post('phone_number');
				$data['first_name']=$this->input->post('first_name');
				$data['last_name']=$this->input->post('last_name');
				//$data['user_email']=$this->input->post('user_email');
				
				//$data['user_password']=$this->input->post('user_password');
				$data['role']=$this->input->post('role');
				$data['companey']=$this->input->post('companey');
				$data['land_line']=$this->input->post('land_line');
				$data['user_type']=$this->input->post('user_type');		
				
				$insert_id=$this->input->post('user_id');
			
	            $this->db->where('id',$insert_id);
				$this->db->update('mqtt_user',$data);
			
			
						
			

							$response['success']=1;
							$response['result']=$this->db->get_where('mqtt_user',array('id' => $insert_id ))->row_array();
	
							$response['message']="Your profile has been sucessfully updated";			
				
				

			}
					else  if($param1=="update_password"){
			       
				$id=0;
				$data['user_password']=$this->input->post('user_password');
				
				$insert_id=$this->input->post('user_id');
			
	            $this->db->where('id',$insert_id);
				$this->db->update('mqtt_user',$data);
			
			
						
			

							$response['success']=1;
							$response['result']=$this->db->get_where('mqtt_user',array('id' => $insert_id ))->row_array();
	
							$response['message']="Your password has been sucessfully updated";			
				
				

			}
				else  if($param1=="forget_password"){
			       
				$id=0;
				$user_email=$this->input->post('user_email');
	            $x=$this->db->where('user_email',$user_email)->get('mqtt_user')->row_array();
			if(empty($x)){
							$response['success']=1;
							$response['message']="Invalid Email";			
							    
			}else{
			    			$response['success']=1;
							$response['message']="Please Check Your  Email";	
			}
			
						
			


				

			}
	
	
			
		echo json_encode($response);

		}
        function verifyUser($email,$passeord){
   	  $credential = array('user_email' => $email,'user_password'=>$passeord);
	 $query = $this->db->get_where('mqtt_user', $credential)->row_array();
	 if(!empty($query)){
	 	return $query;
	 }else{
	 	return 0;
	 }
}
    
    
    
}
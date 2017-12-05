<?php

//ob_start();

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class TestapiController extends AppController {

	public $uses = array('UserPlan','UserDrink','SubscriptionPlan','Product','Product','RestaurantsType','User','UserCoupon');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('api_planbuy','api_drinkbuy','api_drink_history','api_cronupdate','api_couponapply','api_resgallery','api_getallcity','api_resgallerybyid','api_ratings','api_getalldrink','api_codetest','api_sendpush','api_testpush');        
	}



	private function strposa($haystack, $needle, $offset = 0) {
		if (!is_array($needle))
			$needle = array($needle);
		foreach ($needle as $query) {
			if (strpos($haystack, $query, $offset) !== false)
                return true; // stop on first true result
        }
        return false;
    }   


    public function sendpush($token,$message){
    	
    	Configure::write("debug", 0);
    	
    	$ch = curl_init("https://fcm.googleapis.com/fcm/send");		  
    	$title = "Buzzed";		  
    	$body = "Wine";
        
    	$notification = array('title' =>$title , 'body' => $body, 'vibrate' => true, 'click_action' => 'FCM_PLUGIN_ACTIVITY',  'sound' => 'default', 'content-available' => '1', 'priority' => 'high');
    	//$token = "E5DBEC45-944C-4B92-8ED0-15F234934D4D";
    	
    	$arrayToSend = array('to' => $token, 'notification' => $notification, 'data' => $message);
    	$json = json_encode($arrayToSend);
    	// print_r($json);
    	// die();
    	$headers = array();  
    	$headers[] = 'Content-Type: application/json';			  
    	$headers[] = 'Authorization: key= AIzaSyCSvm3aWnKGkyMYokZwrVczfyCvwmgvgKg';

    	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    	curl_setopt($ch, CURLOPT_POSTFIELDS, $json);			  
    	curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	

    	curl_exec($ch);			  			  
    	print_r($ch);
    	curl_close($ch);
    	return true;
    }

    /*Cron Job Code*/

    public function api_cronreporthistory(){

   	configure::write('debug', 0);
        $this->loadModel('PatientTest');      
        $this->loadModel('StatusHistory');

        $today =  strtotime(date('Y-m-d'));
        $dataee = $this->PatientTest->find('all', array( 
                                            'conditions' => array('not' => array('PatientTest.report' => null))
                                           ));      
        foreach($dataee as $datas){
        $dated = strtotime(date('Y-m-d',strtotime($datas['PatientTest']['reportdate']))); 
        $days_between = ceil(abs($today - $dated) / 86400); 
        $data['StatusHistory']['doctorid'] = $datas['PatientTest']['doctorid'];
        $data['StatusHistory']['patientid'] = $datas['PatientTest']['patientid'];
        $data['StatusHistory']['userid'] = $datas['PatientTest']['userid'];
        $data['StatusHistory']['testid'] = $datas['PatientTest']['testid'];
        $data['StatusHistory']['status'] = $datas['PatientTest']['status'];
        $data['StatusHistory']['date'] = $datas['PatientTest']['date'];
        $data['StatusHistory']['report'] = $datas['PatientTest']['report'];
        $data['StatusHistory']['reportdate'] = $datas['PatientTest']['reportdate'];

                
        if($days_between > 5){
            $this->StatusHistory->create();
            $savedata = $this->StatusHistory->save($data);
            $this->PatientTest->deleteAll(array('PatientTest.id' => $datas['PatientTest']['id']), false);
                }  
        }
            
        exit;
    }
    
     public function api_cronreporthistorydelete(){

   	configure::write('debug', 0);
        $this->loadModel('PatientTest');      
        $this->loadModel('StatusHistory');

        $today =  strtotime(date('Y-m-d'));
        $dataee = $this->StatusHistory->find('all');      
        foreach($dataee as $datas){
        $dated = strtotime(date('Y-m-d',strtotime($datas['StatusHistory']['created']))); 
        $days_between = ceil(abs($today - $dated) / 86400); 
        $id = $datas['StatusHistory']['id'];

                
        if($days_between > 14){
            $this->StatusHistory->deleteAll(array('StatusHistory.id' => $id), false);
                }  
        }
            
        exit;
    }

    public function api_cronpatientdelete(){
   	configure::write('debug', 0);
        $this->loadModel('PatientTest');      
        $this->loadModel('Patient');

        $today = strtotime(date('Y-m-d'));
        
        $dataee = $this->Patient->query("SELECT patients.id,(SELECT count(*) FROM `patient_tests` where patientid =patients.id and report is not null) as patient_count ,(SELECT count(*) FROM `patient_tests` where patientid =patients.id) as allcount, (SELECT patient_tests.reportdate FROM `patient_tests` where patient_tests.patientid =patients.id and patient_tests.report is not null order by patient_tests.reportdate DESC limit 1) as last_reportdate FROM `patients` having patient_count>0 and allcount>0 and  patient_count = allcount ");
       
        foreach($dataee as $datas){
                       
        $pid = $datas['patients']['id'];      
        $dated = strtotime(date('Y-m-d',strtotime($datas[0]['last_reportdate']))); 
        $days_between = ceil(abs($today - $dated) / 86400); 
                
        if($days_between > 30){          
            $data = $this->Patient->updateAll(array('Patient.enable' => '1'), array('Patient.id' => $pid));
            } 
        $x++;
        }            
        echo json_encode($data);
        exit;
    }
    
    public function api_testpush(){

        Configure::write("debug", 0);
        
        $ch = curl_init("https://fcm.googleapis.com/fcm/send");      
        $title = "Truelab";        
        $body = "Free Drink- Yoyu have get succesdkfhsdkj";
        $notification = array('title' =>$title , 'body' => $body, 'vibrate' => true, 'click_action' => 'FCM_PLUGIN_ACTIVITY',  'sound' => 'default', 'content-available' => '1', 'priority' => 'high');

       $token = "ckRovok2GSw:APA91bHFXXuS251wvY7_kfRq0dpaTCmFraPvfxrjdNbfctJ2_0Q6zdW7TsMp_qlHGtheid0pl8oC1Ta6L9MAlPBOjZo6sKE6vyct-_LPsdypm-Q6ef9oVzQHd0AHmwtmw-7XMLK9366A";
        
        $arrayToSend = array('to' => $token, 'notification' => $notification);
        $json = json_encode($arrayToSend);
        // print_r($json); 
        // die();
        $headers = array();  
        $headers[] = 'Content-Type: application/json';            
        $headers[] = 'Authorization: key= AIzaSyD_KIN1XzSBZROwuJts42jZ8NITPcCfPj8';

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);              
        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 

        $result = curl_exec($ch);                       

        curl_close($ch);
        return "ok"; 
           
    }
}
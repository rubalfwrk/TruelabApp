<?php
App::uses('Shell', 'Console');

class MainShell extends AppShell{


 //   public $uses = array('UserPlan','UserDrink','SubscriptionPlan','Product','Product','RestaurantsType','User','UserCoupon');

  
     public function sendpush($token,$message){
      
      Configure::write("debug", 0);
      
      $ch = curl_init("https://fcm.googleapis.com/fcm/send");     
      $title = "Truelab";      
      $body = $message;

      $notification = array('title' =>$title , 'body' => $body, 'vibrate' => true, 'click_action' => 'FCM_PLUGIN_ACTIVITY',  'sound' => 'default', 'content-available' => '1', 'priority' => 'high');
      //$token = "E5DBEC45-944C-4B92-8ED0-15F234934D4D";
      
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

      curl_exec($ch);               
      //print_r($ch);
      curl_close($ch);
      return true;
    }

    public function workmain() {
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

                
        if($data['StatusHistory']['report'] != ""){
            $this->StatusHistory->create();
            $savedata = $this->StatusHistory->save($data);
            $this->PatientTest->deleteAll(array('PatientTest.id' => $datas['PatientTest']['id']), false);
                }  
        }

        exit;
        }
        

    public function delpatientinfo(){
      configure::write('debug', 0);
      echo "hello"; die;
        $this->loadModel('PatientTest');      
        $this->loadModel('Patient');
        $this->loadModel('StatusAccept');
        $this->loadModel('StatusDecline');
        $this->loadModel('StatusCancel');
        $this->loadModel('StatusHistory');
        $this->loadModel('StatusReschedule');

        $today = strtotime(date('Y-m-d'));
        $dataee = $this->Patient->query("SELECT patients.id,(SELECT count(*) FROM `patient_tests` where patientid = patients.id and report is not null) as patient_count ,(SELECT count(*) FROM `patient_tests` where patientid = patients.id) as allcount, (SELECT patient_tests.appclientdownloadreport_date FROM `patient_tests` where patient_tests.patientid =patients.id and patient_tests.appclientdownloadreport = '1' order by patient_tests.reportdate DESC limit 1) as last_reportdate FROM `patients` having patient_count>0 and allcount>0 and  patient_count = allcount");
       
        foreach($dataee as $datas){
                       
        $pid = $datas['patients']['id'];  

        $dated = strtotime(date('Y-m-d',strtotime($datas[0]['last_reportdate']))); 
        $days_between = ceil(abs($today - $dated) / 86400); 
        
        if($days_between > 3){
           $this->Patient->deleteAll(array('Patient.id' => $id), false); 
           $this->StatusAccept->deleteAll(array('StatusAccept.patientid' => $id), false);
           $this->StatusDecline->deleteAll(array('StatusDecline.patientid' => $id), false);
           $this->StatusCancel->deleteAll(array('StatusCancel.patientid' => $id), false);
           $this->StatusHistory->deleteAll(array('StatusHistory.patientid' => $id), false);
           $this->StatusReschedule->deleteAll(array('StatusReschedule.patientid' => $id), false);
           $this->PatientTest->deleteAll(array('PatientTest.patientid' => $id), false); 
        }
    }
  }


}

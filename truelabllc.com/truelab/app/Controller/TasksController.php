<?php 

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
// App::uses('fpdi', 'Controller');

class TasksController extends AppController {

   public $components = array('Paginator', 'Session', 'PhpExcel');

    //public $helpers = array('PhpExcel');

    public function beforeFilter() {

        parent::beforeFilter();
        $this->Auth->allow(array('api_acceptdecline','api_adminassignedpatients'));

    }

    public function api_acceptdecline(){
    	
    	configure::write('debug', 0);
        
            $this->loadModel('PatientTest');
            $this->loadModel('StatusAccept');
            $this->loadModel('StatusDecline'); 
            $this->loadModel('StatusCancel');
            $this->loadModel('StatusReschedule');
            $this->loadModel('User');
            $this->loadModel('Patient');
            $this->loadModel('Test');
            
            $patientid = $_POST['patientid'];
            $doctorid = $_POST['doctorid'];
            $userid = $_POST['userid'];
            $testid = $_POST['testid'];
            $status = $_POST['status'];
            $date = $_POST['date'];
            $dat = date('Y-m-d h:i:s');
            $adminstatus = "";

            $tokenid = $this->User->find('first', array('conditions' => array('id' => $doctorid)));

            $token = $tokenid['User']['tokenid'];
    
            if($status == '2'){
            $id = $_POST['id'];
            $reason = $_POST['reason'];
                        
            if($reason == ""){
           
            $adminstatus = "Test Accepted";
            $body = "A new test has been accepted";   
            $data = $this->PatientTest->updateAll(array('PatientTest.status' => "'$status'",'PatientTest.date' => "'$date'"), array('PatientTest.id' => $id));

            $this->request->data['StatusAccept']['patienttestid'] = $_POST['id'];
            $this->request->data['StatusAccept']['patientid'] = $_POST['patientid'];
            $this->request->data['StatusAccept']['userid'] = $_POST['userid'];
            $this->request->data['StatusAccept']['testid'] = $_POST['testid'];
            $this->request->data['StatusAccept']['status'] = $_POST['status'];
            $this->request->data['StatusAccept']['date'] = $_POST['date'];

            $this->StatusAccept->create();
            $this->StatusAccept->save($this->request->data); 
            $this->pushnotification($adminstatus,$body,$token);
            }else{
            $id = $_POST['id'];
            $reason = $_POST['reason'];
            $role = $_POST['role'];  
            if($role == "user"){
            $adminstatus = "Test Reschdule by user";
            $body = "A test has been reschduled by the user";
            $data = $this->PatientTest->updateAll(array('PatientTest.status' => "'$status'",'PatientTest.date' => "'$date'",'PatientTest.userreason' => "'$reason'",'PatientTest.reschduleddate' => "'$date'"), array('PatientTest.id' => $id));    
            
            $this->pushnotification($adminstatus,$body,$token);
            }else{
            $adminstatus = "Test Reschdule by Patient";
            $body = "A test has been reschduled by the patient";
            $data = $this->PatientTest->updateAll(array('PatientTest.status' => "'$status'",'PatientTest.date' => "'$date'",'PatientTest.patientreason' => "'$reason'",'PatientTest.reschduleddate' => "'$date'"), array('PatientTest.id' => $id));
              
            $this->pushnotification($adminstatus,$body,$token);
            }
            $this->request->data['StatusReschedule']['patienttestid'] = $_POST['id'];
            $this->request->data['StatusReschedule']['patientid'] = $_POST['patientid'];
            $this->request->data['StatusReschedule']['userid'] = $_POST['userid'];
            $this->request->data['StatusReschedule']['testid'] = $_POST['testid'];
            $this->request->data['StatusReschedule']['status'] = '5';
            $this->request->data['StatusReschedule']['admin_reason'] = $_POST['reason'];
            $this->request->data['StatusReschedule']['date'] = $_POST['date'];
           
            $this->StatusReschedule->create();
            $this->StatusReschedule->save($this->request->data);
            }
        
            }else if($status == '3'){
            $id = $_POST['id'];
            $reason = $_POST['reason'];
            $adminstatus = "Test Declined";
            $body = "A new test has been declined";
            $data = $this->PatientTest->updateAll(array('PatientTest.status' => "'0'", 'PatientTest.reason' => "'$reason'",'PatientTest.declinedate' => "'$date'",), array('PatientTest.id' => $id));
            $this->request->data['StatusDecline']['patienttestid'] = $_POST['id'];
            $this->request->data['StatusDecline']['patientid'] = $_POST['patientid'];
            $this->request->data['StatusDecline']['userid'] = $_POST['userid'];
            $this->request->data['StatusDecline']['testid'] = $_POST['testid'];
            $this->request->data['StatusDecline']['status'] = $_POST['status'];
            $this->request->data['StatusDecline']['reason'] = $_POST['reason'];

            $this->StatusDecline->create();
            $this->StatusDecline->save($this->request->data);
            $this->pushnotification($adminstatus,$body,$token);
            }else if($status == '4'){
            $id = $_POST['id'];
            $reason = $_POST['reason'];
            
            $role = $_POST['role'];  
            if($role == "user"){
            $adminstatus = "Test Cancelled by user";
            $body = "A new test has been cancelled by the user";
            $data = $this->PatientTest->updateAll(array('PatientTest.status' => "'$status'",'PatientTest.userreason' => "'$reason'",'PatientTest.canceldate' => "'$date'"), array('PatientTest.id' => $id));    
            $this->pushnotification($adminstatus,$body,$token);
            
            }else{
            $adminstatus = "Test Cancelled by Patient";
            $body = "A new test has been cancelled by the patient";
            $data = $this->PatientTest->updateAll(array('PatientTest.status' => 0,'PatientTest.patientreason' => "'$reason'",'PatientTest.canceldate' => "'$date'"), array('PatientTest.id' => $id));
            $this->pushnotification($adminstatus,$body,$token);
            }    
            
            $this->request->data['StatusCancel']['patienttestid'] = $_POST['id'];
            $this->request->data['StatusCancel']['doctorid'] = $_POST['doctorid'];
            $this->request->data['StatusCancel']['patientid'] = $_POST['patientid'];
            $this->request->data['StatusCancel']['userid'] = $_POST['userid'];
            $this->request->data['StatusCancel']['testid'] = $_POST['testid'];
            $this->request->data['StatusCancel']['status'] = $_POST['status'];
            $this->request->data['StatusCancel']['admin_reason'] = $reason;

            $this->StatusCancel->create();
            $this->StatusCancel->save($this->request->data);

            }else if($status == '0'){
                
            $adminstatus = "New test request by client";
            $body = "A new test has been requested by the client";
            $this->request->data['PatientTest']['patientid'] = $_POST['patientid'];
            $this->request->data['PatientTest']['doctorid'] = $_POST['doctorid'];
            $this->request->data['PatientTest']['testid'] = $_POST['testid'];
            $this->request->data['PatientTest']['status'] = $_POST['status'];
            $data =  $this->PatientTest->create();
            $this->PatientTest->save($this->request->data);       
            $this->pushnotification($adminstatus,$body,$token);
            }
                       
            $adminemail = $this->User->find('all', array('conditions' => array('role' => 'admin')));
            $patient = $this->Patient->find('first', array('conditions' => array('id' => $patientid)));
            $test = $this->Test->find('first', array('conditions' => array('id' => $testid)));
            $user = $this->User->find('first', array('conditions' => array('id' => $userid)));
            $doctor = $this->User->find('first', array('conditions' => array('id' => $doctorid)));

                      
            foreach($adminemail as $adminsemail){
               $email = $adminsemail['User']['email'];

               $ms = '<body><table width="500" border="0" cellpadding="10" cellspacing="0" style="margin: 0px auto; background: #f0f0f0; text-align: center"><tr style="background: #f0f0f0"><td colspan="2" style="text-align: center; padding-top: 20px; padding-bottom: 20px"> <img alt="img" style="height: 97px;" src="'.FULL_BASE_URL . $this->webroot . 'home/logo.png"/></td> </tr><tr><td colspan="2"> <h2>Welcome to Truelab</h2><h3> '.$adminstatus.' </h3></td> </tr><tr><td>Patient Tracking Id </td><td>'.$patient['Patient']['trackingid'].' </td></tr><tr><td>Doctor Name </td><td>'.$doctor['User']['firstname'].' </td></tr><tr><td>User Name</td><td>'.$user['User']['firstname'].'</td></tr><tr><td>Test Name </td><td>'.$test['Test']['test'].' </td></tr><tr><td>Status</td><td>'.$adminstatus.' </td></tr><td colspan="2"><h3>Thank you</h2> </td> </tr></table> </body>'; 

                    $Email = new CakeEmail();
                    $Email->config('default');
                    $Email->template('default');
                    $Email->emailFormat('html');
                    $Email->from(array('noreply@truelabllc.com' => 'Truelabllc'));
                    $Email->to($adminsemail['User']['email']);
                    $Email->subject('Test Status');
                    $Email->send($ms);

                    $mss = '<body><table width="500" border="0" cellpadding="10" cellspacing="0" style="margin: 0px auto; background: #f0f0f0; text-align: center"><tr style="background: #f0f0f0"><td colspan="2" style="text-align: center; padding-top: 20px; padding-bottom: 20px"> <img alt="img" style="height: 97px;" src="'.FULL_BASE_URL . $this->webroot . 'home/logo.png"/></td> </tr><tr><td colspan="2"> <h2>Welcome to Truelab</h2><h3> '.$adminstatus.' </h3></td> </tr><tr><td>Patient Tracking Id </td><td>'.$patient['Patient']['trackingid'].' </td></tr><tr><td>Status</td><td>'.$adminstatus.' </td></tr><td colspan="2"><h3>Thank you</h2> </td> </tr></table></body>'; 

                 $Email = new CakeEmail();
                    $Email->config('default');
                    $Email->template('default');
                    $Email->emailFormat('html');
                    $Email->from(array('noreply@truelabllc.com' => 'Truelabllc'));
                    $Email->to($doctor['User']['email']);
                    $Email->subject('Test Status');
                    $Email->send($mss);

            }
            
               $doctoremail = $doctor['User']['email'];
               
               $ms = '<body><table width="500" border="0" cellpadding="10" cellspacing="0" style="margin: 0px auto; background: #f0f0f0; text-align: center"><tr style="background: #f0f0f0"><td colspan="2" style="text-align: center; padding-top: 20px; padding-bottom: 20px"> <img alt="img" style="height: 97px;" src="'.FULL_BASE_URL . $this->webroot . 'home/logo.png"/></td> </tr><tr><td colspan="2"> <h2>Welcome to Truelab</h2><h3> '.$adminstatus.' </h3></td> </tr><tr><td>Patient Tracking Id</td><td>'.$patient['Patient']['trackingid'].' </td></tr><tr><td>Test Name </td><td>'.$test['Test']['test'].' </td></tr><tr><td>Status</td><td>'.$adminstatus.'</td></tr><td colspan="2"><h3>Thank you</h2> </td> </tr></table> </body>'; 
             
                $Email = new CakeEmail();
                    $Email->config('default');
                    $Email->template('default');
                    $Email->emailFormat('html');
                    $Email->from(array('noreply@truelabllc.com' => 'Truelabllc'));
                    $Email->to($doctor['User']['email']);
                    $Email->subject('Test Status');
                    $Email->send($ms);
                    
            if ($data) {
                         
                $response['data'] = $_POST;
                $response['error'] = 0;
                $response['isSucess'] = 'true';

            }
            else{
                $response['error'] = 1;
                $response['isSucess'] = 'false';
            }   

        echo json_encode($response);

        exit;	
    }

    public function api_adminassignedpatients(){
        
        configure::write('debug', 0);
             $this->loadModel('PatientTest');
             
            $patientid = $_POST['patientid'];

            $data = $this->PatientTest->find('all', array('conditions' => array('patientid' => $patientid)));

            if ($data) {
                $response['data'] = $data;
                $response['error'] = 0;
                $response['isSucess'] = 'true';

            }
            else{
                $response['error'] = 1;
                $response['isSucess'] = 'false';
            }   

        echo json_encode($response);

        exit;   
    }
    
    public function pushnotification($title,$body,$token){
        //print_r($token);die;
        Configure::write("debug", 0);
        
        $ch = curl_init("https://fcm.googleapis.com/fcm/send");      
        
        $notification = array('title' =>$title , 'body' => $body, 'vibrate' => true, 'sound' => 'default', 'content-available' => '1', 'priority' => 'high');
        
        $arrayToSend = array('to' => $token, 'notification' => $notification);
        $json = json_encode($arrayToSend);
       
        $headers = array();  
        $headers[] = 'Content-Type: application/json';            
        $headers[] = 'Authorization: key= AIzaSyCbdKNXKWOXMWVjrRemkdIwQndN8Vbget8';

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);              
        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 

        $result = curl_exec($ch);                       
        
        curl_close($ch);
        return "ok";    
    
    }
    

        public function api_uploadrep(){


            Configure::write("debug", 0);
            $this->loadModel('PatientTest');
            $id = $_POST['id'];
           
            $reportdate = date("Y-m-d H:i:s");   
           
            //$image = $_FILES['report'];
            //password for the pdf file
            $password = 'info@domain.com';
            $origFile = "../webroot/fpdi/AuditReport.pdf";
            $destFile = "../webroot/fpdi/AuditReport.pdf";
            $this->pdfEncrypt($origFile, $password, $destFile);
            
            $abc = $this->PatientTest->updateAll(array('PatientTest.report' => "'$destFile'",'PatientTest.reportdate' => "'$reportdate'"), array('PatientTest.id' => $id));  
            if($abc){
               echo "hdfhk"; die; 
            }else{
                echo "yes"; die;
            }
            $response['msg'] = 'Report Updated';
            $response['error'] = 0; 
                    
            
                $response['msg'] = 'No Post Data Available';
                $response['error'] = 1; 
           
            echo json_encode($response);
            exit;

	}
        
       function pdfEncrypt ($origFile, $password, $destFile){
	
	//include("/home/rakesh/public_html" . $this->webroot . "fpdi/FPDI_Protection.php");
        include("../webroot/fpdi/FPDI_Protection.php");
        //echo "/home/rakesh/public_html".$this->webroot . "fpdi/FPDI_Protection.php"; 
	$pdf = new FPDI_Protection();
        
	$pdf->FPDF("P", "in", array('8.27','11.69'));

        
          
	$pagecount = $pdf->setSourceFile($origFile);
               
	for ($loop = 1; $loop <= $pagecount; $loop++) {
   	 	$tplidx = $pdf->importPage($loop);
    	$pdf->addPage();
    	$pdf->useTemplate($tplidx);
	}
          
        
	$pdf->SetProtection(array(),$password);
	
	$destFile = "../webroot/fpdi/AuditReport.pdf";
      
	$pdf->Output($destFile,'F');
	echo 'file is password protected now!!';
	return $destFile;
        }
       
}
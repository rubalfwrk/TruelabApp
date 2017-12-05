<?php

App::uses('AppController', 'Controller');

class PatientsController extends AppController {

    public function beforeFilter() {

        parent::beforeFilter();

        $this->Auth->allow('api_addpatients', 'api_viewpatients', 'api_userpatientlist', 'api_useracceptpatientlist', 'api_userdeclinepatientlist', 'api_clientscheduledlist', 'api_clientpendinglist', 'admin_historypatient', 'api_clientdownloadreportfromapp', 'api_delpatientinfo');
    }

    public function api_addpatients() {

        Configure::write("debug", 0);

        $name = $_POST['name'];

        $doctorid = $_POST['doctorid'];

        $address = $_POST['address'];

        $phonenumber = $_POST['phonenumber'];

        $dob = $_POST['dob'];

        $doctorname = $_POST['doctorname'];

        $doctornumber = $_POST['doctornumber'];

        $doctorfaxnumber = $_POST['doctorfaxnumber'];

        if ($this->request->is('post')) {

            $this->loadModel('Patient');

            $this->Patient->create();

            $savedata = $this->Patient->save($this->request->data);

            if ($savedata) {

                $response['status'] = 1;

                $response['msg'] = 'Patients Registration has been successfully Completed. ';

                $response['error'] = 0;
            }
        } else {

            $response['msg'] = 'Sorry please try again';

            $response['status'] = 2;

            $response['error'] = 1;
        }

        echo json_encode($response);

        exit;
    }

    public function api_viewpatients() {

        Configure::write("debug", 0);

        $id = $_POST['id'];



        if ($this->request->is('post')) {



            $this->loadModel('Patient');

            $this->loadModel('PatientTest');

            $this->loadModel('Test');

            //$this->Patient->recursive = 2;

            $patientdetail = $this->Patient->find('first', array('conditions' => array('id' => $id)));

            //$this->PatientTest->recursive = 2;

            $Testdetail = $this->PatientTest->find('all', array('conditions' => array('patientid' => $id, 'PatientTest.reportpdf IS NOT NULL'), 'order' => array('PatientTest.id' => 'ASC'), 'recursive' => 2, 'contain' => 'Test'));

            // print_r($Testdetail); die;

            $response['status'] = 1;



            $response['msg'] = $patientdetail;

            $response['msg1'] = $Testdetail;

            $response['error'] = 0;
        } else {



            $response['msg'] = 'Sorry please try again';



            $response['status'] = 2;



            $response['error'] = 1;
        }



        echo json_encode($response);

        exit;
    }

    public function api_userpatientlist() {



        Configure::write("debug", 0);

        $uid = $_POST['id'];



        if ($this->request->is('post')) {

            $this->loadModel("PatientTest");

            $this->loadModel("Patient");

            $this->PatientTest->recursive = 2;
            $patientlists = $this->PatientTest->find("all", array('conditions' => array('PatientTest.userid' => $uid, 'PatientTest.status' => 1), 'order' => array('PatientTest.id' => 'ASC')));

            if (!empty($patientlists)) {

                $response['msg'] = $patientlists;

                $response['error'] = 0;
            } else {

                $response['msg'] = 'No Data Available';

                $response['error'] = 1;
            }
        } else {

            $response['msg'] = 'No Post Data Available';

            $response['error'] = 1;
        }

        echo json_encode($response);

        exit;
    }

    public function api_useracceptpatientlist() {

        $uid = $_POST['id'];

        if ($this->request->is('post')) {

            $this->loadModel("PatientTest");

            $this->loadModel("Patient");

            $this->PatientTest->recursive = 2;

            $patientlists = $this->PatientTest->find("all", array('conditions' => array('PatientTest.userid' => $uid, 'PatientTest.status' => 2), 'recursive' => 2));

            if (!empty($patientlists)) {

                $response['msg'] = $patientlists;



                $response['error'] = 0;
            } else {

                $response['msg'] = 'No Data Available';

                $response['error'] = 1;
            }
        } else {

            $response['msg'] = 'No Post Data Available';

            $response['error'] = 1;
        }

        echo json_encode($response);



        exit;
    }

    public function api_userdeclinepatientlist() {
        $uid = $_POST['id'];

        if ($this->request->is('post')) {

            $this->loadModel("PatientTest");



            $this->loadModel("Patient");

            $this->PatientTest->recursive = 2;

            $patientlists = $this->PatientTest->find("all", array('conditions' => array('AND' => array('PatientTest.userid' => $uid, 'PatientTest.status' => 4))));

            if (!empty($patientlists)) {

                $response['msg'] = $patientlists;



                $response['error'] = 0;
            } else {

                $response['msg'] = 'No Data Available';



                $response['error'] = 1;
            }
        } else {

            $response['msg'] = 'No Post Data Available';



            $response['error'] = 1;
        }

        echo json_encode($response);



        exit;
    }

    /*     * ************** Edit Profile Patients ************************ */

    public function api_editpatientprofile() {

        configure::write('debug', 0);



        $this->loadModel('Patient');

        $id = $_POST['id'];

        $name = $_POST['name'];

        $address = $_POST['address'];

        $dob = $_POST['dob'];

        $doctorname = $_POST['doctorname'];

        $doctornumber = $_POST['doctornumber'];

        $doctorfaxnumber = $_POST['doctorfaxnumber'];


        $phonenumber = $_POST['phonenumber'];

        $data = $this->Patient->updateAll(array('Patient.name' => "'name'", 'Patient.address' => "'$address'", 'Patient.dob' => "'$dob'", 'Patient.phonenumber' => "'$phonenumber'", 'Patient.doctorname' => "'$doctorname'", 'Patient.doctornumber' => "'$doctornumber'", 'Patient.doctorfaxnumber' => "'$doctorfaxnumber'"), array('Patient.id' => $id));

        if ($data) {

            $response['data'] = $_POST;

            $response['error'] = 0;

            $response['isSucess'] = 'true';
        } else {

            $response['error'] = 1;

            $response['error'] = 1;

            $response['isSucess'] = 'false';
        }

        echo json_encode($response);

        exit;
    }

    /*     * ******* Patients Listing *********** */

    public function admin_index() {
        Configure::write("debug", 0);
        $this->Patient->recursive = 1;
        $this->loadModel('User');
        $this->loadModel('PatientTest');
        $patients_lists = array();
        if ($this->Auth->user('role') == 'client') {
            $email = $this->Auth->user('email');

            $doctorlist = $this->User->find('all', array('conditions' => array('User.email' => $this->Auth->user('email')), 'group' => '`User`.`firstname`'));


            foreach ($doctorlist as $key => $value) {
                $id = $value['User']['id'];
                $patients_lists[] = $this->Patient->find('all', array('order' => 'Patient.id ASC', 'conditions' => array('Patient.doctorid' => $id)));
            }


            $this->set(compact('patients_lists'));
        } elseif ($this->Auth->user('role') == 'user') {
            $patients_lists[] = $this->PatientTest->find('all', array('order' => 'Patient.id ASC', 'conditions' => array('Patient.userid' => $this->Auth->user('id'))));
        } else {

            $patients_lists[] = $this->Patient->find('all', array('order' => 'Patient.id ASC'));
        }
        $this->set(compact('patients_lists'));
    }

    public function admin_historypatient() {
        Configure::write("debug", 0);
        $this->Patient->recursive = 1;
        $this->loadModel('User');
        if ($this->Auth->user('role') == 'client') {
            $patients_lists = $this->Patient->find('all', array('order' => 'Patient.id DESC', 'conditions' => array('Patient.doctorid' => $this->Auth->user('id'), 'Patient.history' => '1')));
        } else {

            $patients_lists = $this->Patient->find('all', array('conditions' => array('Patient.history' => 1), array('order' => 'Patient.id DESC')));
        }
        $this->set(compact('patients_lists'));
    }

    /*     * ************** View Patient Details *********************** */

    public function admin_view($id = null) {

        Configure::write("debug", 2);
        $this->set('patient', $this->Patient->read(null, $id));
        $Patientcalage = $this->Patient->find('first', array('conditions' => array('Patient.id' => $id)));
        $dob = $Patientcalage['Patient']['dob'];
        $diff = (date('Y') - date('Y', strtotime($dob)));


        $this->set('patage', $diff);
    }

    /*     * ************ Edit Patient ***************** */

    public function admin_edit($id = null) {
        Configure::write("debug", 0);
        $this->loadModel("User");
        if ($this->request->is('post') || $this->request->is('put')) {

            if ($this->request->data['Patient']['doctorid'] == 0) {
                $this->Session->setFlash("Please select a Doctor");
                return $this->redirect(array('action' => 'edit', $id));
            } else {
                
                $docname = explode("(",$this->request->data['Patient']['doctorname']);
                $this->request->data['Patient']['doctorname'] = $docname[0]; 

                if ($this->Patient->save($this->request->data)) {
                    $this->Session->setFlash('The Patient has been saved');
                    /*                     * *************** */

                    if ($this->Auth->User("role") == 'admin') {
                        $this->loadModel("User");
                        $doctortoken = $this->User->find("first", array("conditions" => array("User.id" => $this->request->data['Patient']['doctorid'])));
                        //print_r($doctortoken); die;
                        
                    }

                    /*                     * *********************** */
                    return $this->redirect(array('action' => 'index'));
                } else {

                    $this->Session->setFlash('The Patient could not be saved. Please, try again.');
                }
            }
        } else {

            if ($this->Auth->User("role") == 'admin') {

                $users = $this->User->find('all', array('conditions' => array('User.role' => 'client','User.firstname !=' => NULL)));

                $doctorsel = array();

                foreach ($users as $user) {
                    // $doctorsel[0] = '--Select Doctor---';
                    // $doctorsel[$user['User']['id']] = $user['User']['firstname'] . ' ' . $user['User']['lastname'];
                    if (isset($user['User']['agencyname']) && $user['User']['agencyname'] != NULL && $user['User']['firstname'] != NULL) {
                    $doctorsel[0] = '--Select Doctor---';
                    $doctorsel[$user['User']['id']] = $user['User']['firstname'] . ' ' . $user['User']['lastname'] . ' ' . '(' . $user['User']['agencyname'] . ')';
                } elseif($user['User']['firstname'] != NULL) {
                    $doctorsel[0] = '--Select Doctor---';
                    $doctorsel[$user['User']['id']] = $user['User']['firstname'] . ' ' . $user['User']['lastname'];
                }
                }

                

                $this->set("doctorsel", $doctorsel);
            } else {

                $users = $this->User->find('all', array('conditions' => array('AND' => array('User.role' => 'client', 'User.firstname !=' => NULL,'User.agencyname' => $this->Auth->User('agencyname')))));

                $doctorsel = array();

                foreach ($users as $user) {

                    if (isset($user['User']['agencyname']) && $user['User']['agencyname'] != NULL && $user['User']['firstname'] != NULL) {
                    $doctorsel[0] = '--Select Doctor---';
                    $doctorsel[$user['User']['id']] = $user['User']['firstname'] . ' ' . $user['User']['lastname'] . ' ' . '(' . $user['User']['agencyname'] . ')';
                } elseif($user['User']['firstname'] != NULL) {
                    $doctorsel[0] = '--Select Doctor---';
                    $doctorsel[$user['User']['id']] = $user['User']['firstname'] . ' ' . $user['User']['lastname'];
                }
                }

                $this->set("doctorsel", $doctorsel);
            }



            $this->request->data = $this->Patient->read(null, $id);
        }


        $this->set("userrole", $this->Auth->User("role"));
    }

    /*     * ************ Delete Patient ***************** */

    public function admin_delete($id = null) {

        Configure::write("debug", 0);

        //$this->User->id = $id;
        $this->loadModel("Patient");
        $this->loadModel("PatientTest");
        $this->loadModel("StatusAccept");
        $this->loadModel("StatusCancel");
        $this->loadModel("StatusReschedule");
        $this->loadModel("StatusHistory");
        $this->loadModel("StatusDecline");
        $deletepatient = $this->Patient->deleteAll(array('Patient.id' => $id));
        $deletePatientTest = $this->PatientTest->deleteAll(array('PatientTest.id' => $id));
        $deleteStatusAccept = $this->StatusAccept->deleteAll(array('StatusAccept.patientid' => $id));
        $deleteStatusCancel = $this->StatusCancel->deleteAll(array('StatusCancel.patientid' => $id));
        $deleteStatusReschedule = $this->StatusReschedule->deleteAll(array('StatusReschedule.patientid' => $id));
        $deleteStatusHistory = $this->StatusHistory->deleteAll(array('StatusHistory.patientid' => $id));
        $deleteStatusDecline = $this->StatusDecline->deleteAll(array('StatusDecline.patientid' => $id));

        if ($deletepatient) {

            $this->Session->setFlash('Patient deleted');

            return $this->redirect(array('action' => 'index'));
        }

        $this->Session->setFlash('Patient was not deleted');

        return $this->redirect(array('action' => 'index'));
    }

    /*     * ******************* Patient Test By id ********************************** */

    public function admin_test($id = null) {

        Configure::write("debug", 0);

        $this->loadModel("PatientTest");

        $this->loadModel("Patient");

        $this->loadModel("StatusRecord");

        $this->loadModel("User");

        $this->loadModel("Test");
        $this->loadModel("StatusCancel");

        if ($this->request->is('post')) {

            $update_row = $this->request->data['PatientTest']['patient_row_id'];

            $pid = $this->request->data['PatientTest']['patient_id'];

            $schdueleddate = date('Y-m-d h:i:s');

            $udateuser = $this->request->data['PatientTest']['users'];

            $patient_data = $this->Patient->find("first", array("conditions" => array('Patient.id' => $pid)));

            $patienttest_data = $this->PatientTest->find("first", array("conditions" => array('PatientTest.id' => $update_row)));

            $doctor_id = $patient_data['Patient']['doctorid'];
            $trackid = $patient_data['Patient']['trackingid'];
            
            $tstid = $patienttest_data['PatientTest']['testid'];

            $tetid = $this->Test->find("first", array("conditions" => array('Test.id' => $tstid)));

            $update_patient = $this->PatientTest->updateAll(array('PatientTest.userid' => "'$udateuser'", 'PatientTest.schdueleddate' => "'$schdueleddate'", 'PatientTest.doctorid' => "'$doctor_id'", 'PatientTest.status' => '1'), array('PatientTest.id' => $update_row));


            if ($update_patient) {

                /*                 * ********** Notification to Phlebotomist **************** */
                $usertoken = $this->User->find("first", array("conditions" => array("User.id" => $udateuser)));
                $title = "You have a new task.";
                $message = "A new patient ". $trackid." has been assigned to you.";

                $this->sendNewnotificationPush($title, $usertoken['User']['tokenid'], $message);

                /*                 * ********** Notification to Doctor **************** */
                $doctortoken = $this->User->find("first", array("conditions" => array("User.id" => $doctor_id)));
                //print_r($doctortoken); die;
                $title1 = "Assign Phlebotomist";
                $message1 = "Your Test has been assign to the Phlebotomist";

                $this->sendNewnotificationPushdoctor($title1, $doctortoken['User']['tokenid'], $message1);
                $trackingid = $patient_data['Patient']['trackingid'];

                $mss = '<body><table width="500" border="0" cellpadding="10" cellspacing="0" style="margin: 0px auto; background: #f0f0f0; text-align: center"><tr style="background: #f0f0f0"><td colspan="2" style="text-align: center; padding-top: 20px; padding-bottom: 20px"> <img alt="img" style="height: 97px;" src="'.FULL_BASE_URL . $this->webroot . 'home/logo.png"/></td> </tr><tr><td colspan="2"> <h2>Welcome to QualityLabOne</h2><h3></tr><tr> '.$trackingid.' has been scheduled successfully. </tr><tr><td colspan="2"><h3>Thank you</h2> </td> </tr></table></body>'; 
                // ;

                 $Email = new CakeEmail();
                    $Email->config('default');
                    $Email->template('default');
                    $Email->emailFormat('html');
                    $Email->from(array('noreply@truelabllc.com' => 'QualityLabOne'));
                    $Email->to($doctortoken['User']['email']);
                    $Email->subject('Test Status');
                    $Email->send($mss);

                if($doctortoken['User']['agencyname'] != Null){
                    $ag = $doctortoken['User']['agencyname'];
                }else{
                    $ag = $doctortoken['User']['firstname'];
                }

                $ms = '<body><table width="500" border="0" cellpadding="10" cellspacing="0" style="margin: 0px auto; background: #f0f0f0; text-align: center"><tr style="background: #f0f0f0"><td colspan="2" style="text-align: center; padding-top: 20px; padding-bottom: 20px"> <img alt="img" style="height: 97px;" src="'.FULL_BASE_URL . $this->webroot . 'home/logo.png"/></td> </tr><tr><td colspan="2"><h2>Welcome to QualityLabOne</h2><h3> '.$trackingid.' has been scheduled successfully. </h3></td> </tr><tr>Patient Tracking Id : '.$trackingid.' </tr><tr>Phlebotomist Name : '.$usertoken['User']['firstname'].' </tr><tr> Agency Name :'.$ag.' </tr><tr> Test Name : '.$tetid['Test']['test'].' </tr><td colspan="2"><h3>Thank you</h3> </td> </tr></table></body>'; 

                    $Email = new CakeEmail();
                    $Email->config('default');
                    $Email->template('default');
                    $Email->emailFormat('html');
                    $Email->from(array('noreply@truelabllc.com' => 'QualityLabOne'));
                    $Email->to('notification@truelabllc.com');
                    $Email->subject('Test Status');
                    $Email->send($ms);
                return $this->redirect(array('action' => 'test', $id));
            }
        }

        $testids = array();

        $testsdata = array();

        $this->PatientTest->recursive = 2;

        $tests = $this->PatientTest->find('all', array('order' => 'PatientTest.id DESC', 'conditions' => array('PatientTest.patientid' => $id)));

        $patientname = $this->Patient->find('first', array('conditions' => array('Patient.id' => $id), 'fields' => array('firstname', 'lastname', 'doctorname')));
        $users = $this->User->find('all', array('conditions' => array('User.role' => 'user','User.active'=>1)));

        $usersel = array();

        foreach ($users as $user) {

            $usersel[$user['User']['id']] = $user['User']['firstname'] . ' ' . $user['User']['lastname'];
        }

        /*         * ******* count schedule tests ********** */

        $countdecline_test = $this->PatientTest->find("count", array('conditions' => array('AND' => array('PatientTest.status' => 3, 'PatientTest.patientid' => $id))));

        $countaccept_test = $this->PatientTest->find("count", array('conditions' => array('AND' => array('PatientTest.status' => 2, 'PatientTest.patientid' => $id, 'PatientTest.reporttime' => NULL))));

        $countsch_test = $this->PatientTest->find("count", array('conditions' => array('AND' => array('PatientTest.status' => 1, 'PatientTest.patientid' => $id))));

        $this->set('count_schedule', $countsch_test);

        $this->set('count_decline', $countdecline_test);

        $this->set('count_accept', $countaccept_test);

        /*         * *************************************** */
        /*         * **************** Cancel Tests *********************** */
        $this->loadModel("StatusCancel");
        $finalcancel = array();
        $canceltests = $this->StatusCancel->find('all', array('order' => 'StatusCancel.id DESC', 'conditions' => array('StatusCancel.patientid' => $id)));
        $canceltestscount = $this->StatusCancel->find('count', array('conditions' => array('StatusCancel.patientid' => $id)));
        foreach ($canceltests as $canceltest) {
            $doctorname = $this->User->find("first", array("conditions" => array("User.id" => $canceltest['StatusCancel']['doctorid'])));
            $phlebo = $this->User->find("first", array("conditions" => array("User.id" => $canceltest['StatusCancel']['userid'])));
            $testname = $this->Test->find("first", array("conditions" => array("Test.id" => $canceltest['StatusCancel']['testid'])));
            $finalcancel[] = array(
                'phleboname' => $phlebo['User']['firstname'] . ' ' . $phlebo['User']['lastname'],
                'doctorname' => $doctorname['User']['firstname'] . ' ' . $doctorname['User']['lastname'],
                'testname' => $testname['Test']['test'],
                'reason' => $canceltest['StatusCancel']['admin_reason'],
                'cancel_date' => $canceltest['StatusCancel']['created']
            );
        }
        /*         * **************** End *********************** */
        //echo '<pre>'; print_r($canceltests); echo '</pre>'; die;
        $this->set(compact('usersel'));

        $this->set(compact('tests'));

        $this->set("patientname", $patientname);

        $this->set('finalcancel', $finalcancel);
        $this->set('canceltestscount', $canceltestscount);

        $this->set("userrole", $this->Auth->User("role"));
    }

    /*     * *************** Tests Listing ************************** */

    public function admin_testindex() {

        Configure::write("debug", 0);



        $this->loadModel("Test");

        $alltest = $this->Test->find("all");

        $this->set(compact('alltest'));
    }

    public function admin_testedit($id = null) {

        Configure::write("debug", 0);



        $this->loadModel("Test");



        if ($this->request->is('post') || $this->request->is('put')) {



            if ($this->Test->save($this->request->data)) {



                $this->Session->setFlash('The Test has been saved');



                return $this->redirect(array('action' => 'testindex'));
            } else {



                $this->Session->setFlash('The Test could not be saved. Please, try again.');
            }
        } else {

            $this->request->data = $this->Test->read(null, $id);
        }
    }

    public function admin_testview($id = null) {



        Configure::write("debug", 0);



        $this->loadModel("Test");



        $this->set('test', $this->Test->read(null, $id));
    }

    public function admin_testdelete($id = null) {



        Configure::write("debug", 0);

        $this->loadModel("Test");



        $deletetest = $this->Test->deleteAll(array('Test.id' => $id));

        if ($deletetest) {



            $this->Session->setFlash('Test deleted');



            return $this->redirect(array('action' => 'testindex'));
        }



        $this->Session->setFlash('Test was not deleted');



        return $this->redirect(array('action' => 'testindex'));
    }

    public function admin_reschedule($ptestid = null, $pid = null, $tid = null) {

        Configure::write("debug", 0);
        $usersel = array();

        $users = $this->User->find('all', array('conditions' => array('User.role' => 'user','active'=>1)));

        foreach ($users as $user) {

            $usersel[$user['User']['id']] = $user['User']['firstname'] . ' ' . $user['User']['lastname'];
        }

        $this->set(compact('usersel'));

        if ($this->request->is("post")) {

            $this->loadModel("PatientTest");

            $this->loadModel("User");
            $this->loadModel("Test");

            $this->loadModel("StatusReschedule");

            $this->request->data['StatusReschedule']['patienttestid'] = $ptestid;

            $this->request->data['StatusReschedule']['patientid'] = $pid;

            $this->request->data['StatusReschedule']['testid'] = $tid;

            $this->request->data['StatusReschedule']['status'] = 5;

            $this->request->data['StatusReschedule']['admin_reason'] = $this->request->data['StatusReschedule']['admin_reason'];

            $this->request->data['StatusReschedule']['reason'] = '';

            $this->request->data['StatusReschedule']['userid'] = $this->request->data['StatusReschedule']['users'];

            $udateuser = $this->request->data['StatusReschedule']['users'];

            $udateschdate = date("Y-m-d");

            if ($this->StatusReschedule->save($this->request->data)) {
                $reas = $this->request->data['StatusReschedule']['admin_reason'];
                $this->PatientTest->updateAll(array('PatientTest.userid' => "'$udateuser'", 'PatientTest.status' => '1', 'PatientTest.schdueleddate' => "'$udateschdate'", 'PatientTest.userreason ' => "'$reas'", 'PatientTest.declinedate ' => Null), array('PatientTest.id' => $ptestid));

                $this->loadModel("User"); 
                  $this->loadModel("Patient");
                  $patient = $this->Patient->find("first", array("conditions" => array("Patient.id" => $pid)));
                  $trackingid = $Patient['Patient']['trackingid'];
                    $doctor_id = $patient['Patient']['doctorid'];

                  $doctortoken = $this->User->find("first", array("conditions" => array("User.id" => $doctor_id)));

                  $patienttest_data = $this->PatientTest->find("first", array("conditions" => array('PatientTest.id' => $ptestid)));
                
                $tstid = $patienttest_data['PatientTest']['testid'];

                $tetid = $this->Test->find("all", array("conditions" => array('Test.id' => $tstid)));

                  if($doctortoken['User']['email'] != ''){
                  $ms = '<body><table width="500" border="0" cellpadding="10" cellspacing="0" style="margin: 0px auto; background: #f0f0f0; text-align: center"><tr style="background: #f0f0f0"><td colspan="2" style="text-align: center; padding-top: 20px; padding-bottom: 20px"><img alt="img" style="height: 97px;" src="'.FULL_BASE_URL . $this->webroot . 'home/logo.png"/></td></tr><tr><b>Patient Test has been reschduled</b></tr><tr>'.$trackingid.'</tr></table></body>'; 
                 
                  $Email = new CakeEmail();
                    $Email->config('default');
                    $Email->template('default');
                    $Email->emailFormat('html');
                    $Email->from(array('noreply@truelabllc.com' => 'QualityLabOne'));
                    $Email->to($doctortoken['User']['email']);
                    $Email->subject('Add New Patient');
                    $Email->send($ms);

                    $mss = '<body><table width="500" border="0" cellpadding="10" cellspacing="0" style="margin: 0px auto; background: #f0f0f0; text-align: center"><tr style="background: #f0f0f0"><td colspan="2" style="text-align: center; padding-top: 20px; padding-bottom: 20px"> <img alt="img" style="height: 97px;" src="'.FULL_BASE_URL . $this->webroot . 'home/logo.png"/></td> </tr><tr><td colspan="2"><h2>Welcome to QualityLabOne</h2><h3> '.$trackingid.' has been reschduled. </h3></td> </tr><tr>Patient Tracking Id : '.$trackingid.' </tr><tr>Phlebotomist Name : '.$doctortoken['User']['firstname'].' </tr><tr> Agency Name :'.$ag.' </tr><tr> Test Name : '.$tetid['Test']['test'].' </tr><td colspan="2"><h3>Thank you</h3> </td> </tr></table></body>'; 

                 $Email = new CakeEmail();
                    $Email->config('default');
                    $Email->template('default');
                    $Email->emailFormat('html');
                    $Email->from(array('noreply@truelabllc.com' => 'QualityLabOne'));
                    $Email->to('notification@truelabllc.com');
                    $Email->subject('Test Status');
                    $Email->send($mss);

                  } 
                 
                return $this->redirect(array('action' => 'index'));
            }
        }
    }

    public function admin_cancel($ptestid = null, $pid = null, $tid = null) {

        Configure::write("debug", 0);

        if ($this->request->is("post")) {

            $this->loadModel("PatientTest");

            $this->loadModel("Patient");

            $this->loadModel("User");

            $this->loadModel("StatusCancel");
            $this->loadModel("Test");

            $dat = date('Y-m-d h:i:s');

            $patient_data = $this->Patient->find("first", array("conditions" => array('Patient.id' => $pid)));
            $user_data = $this->PatientTest->find("first", array("conditions" => array('PatientTest.id' => $ptestid)));

            $doctor_id = $patient_data['Patient']['doctorid'];

            $this->request->data['StatusCancel']['doctorid'] = $doctor_id;

            $this->request->data['StatusCancel']['patienttestid'] = $ptestid;

            $this->request->data['StatusCancel']['patientid'] = $pid;

            $this->request->data['StatusCancel']['testid'] = $tid;

            $this->request->data['StatusCancel']['status'] = 4;

            $this->request->data['StatusCancel']['admin_reason'] = $this->request->data['StatusCancel']['admin_reason'];

            $this->request->data['StatusCancel']['reason'] = '';

            $this->request->data['StatusCancel']['userid'] = $user_data['PatientTest']['userid'];

            $udateuser = $this->request->data['StatusCancel']['userid'];

            if ($this->StatusCancel->save($this->request->data)) {

                $this->PatientTest->updateAll(array('PatientTest.userid' => "'$udateuser'", 'PatientTest.status' => '4', 'PatientTest.canceldate' => "'$dat'"), array('PatientTest.id' => $ptestid));
                $this->loadModel("User");
                $this->loadModel("Patient");
                $doctortoken = $this->User->find("first", array("conditions" => array("User.id" => $doctor_id)));
                $patient = $this->Patient->find("first", array("conditions" => array("Patient.id" => $pid)));

                $trackingid = $patient['Patient']['trackingid'];

                $patienttest_data = $this->PatientTest->find("first", array("conditions" => array('PatientTest.id' => $ptestid)));
                
                $tstid = $patienttest_data['PatientTest']['testid'];
                $tetid = $this->Test->find("all", array("conditions" => array('Test.id' => $tstid)));
                

                if($doctortoken['User']['email'] != ''){        
                  $ms = '<body><table width="500" border="0" cellpadding="10" cellspacing="0" style="margin: 0px auto; background: #f0f0f0; text-align: center"><tr style="background: #f0f0f0"><td colspan="2" style="text-align: center; padding-top: 20px; padding-bottom: 20px"><img alt="img" style="height: 97px;" src="'.FULL_BASE_URL . $this->webroot . 'home/logo.png"/></td></tr><tr><b>Patient Test has been cancelled</b></tr><tr>'.$trackingid.'</tr></table></body>';

                   $Email = new CakeEmail();
                    $Email->config('default');
                    $Email->template('default');
                    $Email->emailFormat('html');
                    $Email->from(array('noreply@truelabllc.com' => 'QualityLabOne'));
                    $Email->to($doctortoken['User']['email']);
                    $Email->subject('Test Cancel');
                    $Email->send($ms);

                    if($doctortoken['User']['agencyname'] != Null){
                        $ag = $doctortoken['User']['agencyname'];
                    }else{
                        $ag = $doctortoken['User']['firstname'];
                    }

                $mss = '<body><table width="500" border="0" cellpadding="10" cellspacing="0" style="margin: 0px auto; background: #f0f0f0; text-align: center"><tr style="background: #f0f0f0"><td colspan="2" style="text-align: center; padding-top: 20px; padding-bottom: 20px"> <img alt="img" style="height: 97px;" src="'.FULL_BASE_URL . $this->webroot . 'home/logo.png"/></td> </tr><tr><td colspan="2"><h2>Welcome to QualityLabOne</h2><h3> '.$trackingid.' has been Cancelled. </h3></td> </tr><tr>Patient Tracking Id : '.$trackingid.' </tr><tr>Phlebotomist Name : '.$doctortoken['User']['firstname'].' </tr><tr> Agency Name :'.$ag.' </tr><tr> Test Name : '.$tetid['Test']['test'].' </tr><td colspan="2"><h3>Thank you</h3> </td> </tr></table></body>'; 

                 $Email = new CakeEmail();
                    $Email->config('default');
                    $Email->template('default');
                    $Email->emailFormat('html');
                    $Email->from(array('noreply@truelabllc.com' => 'QualityLabOne'));
                    $Email->to('notification@truelabllc.com');
                    $Email->subject('Test Status');
                    $Email->send($mss);

                  }
                  return $this->redirect(array('action' => 'index'));
            }
        }
    }

    /*     * ************ Add New Test From Admin ********************** */

    public function admin_addtest() {

        Configure::write("debug", 2);

        $this->loadModel("Test");

        if ($this->request->is("post")) {


            $this->Test->create();

            if ($this->Test->save($this->request->data)) {

                return $this->redirect(array('action' => 'testindex'));
            }
        }
    }

    public function api_listofalltest() {

        $this->loadModel('Test');

        $test = $this->Test->find('all');

        $response['status'] = 1;



        $response['msg'] = $test;

        $response['error'] = 0;



        echo json_encode($response);

        exit;
    }

    public function api_doctorcanceledpatientlist() {

        Configure::write("debug", 0);

        $uid = $_POST['id'];

        if ($this->request->is('post')) {

            $this->loadModel("StatusCancel");

            $this->loadModel("Patient");



            //$this->StatusCancel->recursive = 2;

            $patientlists = $this->StatusCancel->find("all", array('conditions' => array('StatusCancel.doctorid' => $uid), 'recursive' => 2, 'contain' => 'Patient'));
            if (!empty($patientlists)) {

                $response['msg'] = $patientlists;



                $response['error'] = 0;
            } else {

                $response['msg'] = 'No Data Available';

                $response['error'] = 1;
            }
        } else {

            $response['msg'] = 'No Post Data Available';

            $response['error'] = 1;
        }

        echo json_encode($response);



        exit;
    }

    public function api_usercanceledpatientlist() {

        Configure::write("debug", 0);

        $uid = $_POST['id'];

        if ($this->request->is('post')) {

            $this->loadModel("StatusCancel");

            $this->loadModel("Patient");

            //$this->StatusCancel->recursive = 2;

            $patientlists = $this->StatusCancel->find("all", array('conditions' => array('StatusCancel.userid' => $uid), 'recursive' => 2, 'contain' => 'Patient'));

            if (!empty($patientlists)) {

                $response['msg'] = $patientlists;
                $response['error'] = 0;
            } else {

                $response['msg'] = 'No Data Available';

                $response['error'] = 1;
            }
        } else {

            $response['msg'] = 'No Post Data Available';

            $response['error'] = 1;
        }

        echo json_encode($response);

        exit;
    }

    public function api_uploadreport() {

        $postdata = file_get_contents("php://input");

        $redata = json_decode($postdata);

        ob_start();

        print_r($redata);
        $c = ob_get_clean();

        $fc = fopen('files' . DS . 'detail.txt', 'w');

        fwrite($fc, $c);

        fclose($fc);

        Configure::write("debug", 0);

        $id = "1";

        $reportdate = date("Y-m-d H:i:s");

        $image = $_POST['report'];

        if ($image != "") {

            $img = base64_decode($image);

            $im = imagecreatefromstring($img);

            if ($im !== false) {

                $image = "1" . time() . ".png";

                imagepng($im, WWW_ROOT . "files" . DS . "profile_pic" . DS . $image);

                imagedestroy($im);
            }

            $this->PatientTest->updateAll(array('PatientTest.report' => "'$image'", 'PatientTest.reportdate' => "'$reportdate'"), array('PatientTest.id' => $id));

            $response['msg'] = 'Report Updated';

            $response['error'] = 0;
        } else {

            $response['msg'] = 'No Post Data Available';

            $response['error'] = 1;
        }

        echo json_encode($response);

        exit;
    }

    public function api_clientscheduledlist() {

        Configure::write("debug", 0);

        $uid = $_POST['id'];

        if ($this->request->is('post')) {

            $this->loadModel("PatientTest");

            $this->loadModel("Patient");

            $this->PatientTest->recursive = 2;

            $patientlists = $this->PatientTest->find("all", array('conditions' => array('PatientTest.doctorid' => $uid, 'PatientTest.status' => 1,'PatientTest.reporttime' => NULL), 'recursive' => 2));
            
            if (!empty($patientlists)) {

                $response['msg'] = $patientlists;
                $response['error'] = 0;
            } else {

                $response['msg'] = 'No Data Available';

                $response['error'] = 1;
            }
        } else {

            $response['msg'] = 'No Post Data Available';

            $response['error'] = 1;
        }

        echo json_encode($response);



        exit;
    }

    /*     * ** START *************Send Notification for Delivery Boy********************************* */

    public function sendNewnotificationPush($title, $token, $body) {

        Configure::write("debug", 0);

        $ch = curl_init("https://fcm.googleapis.com/fcm/send");

        $notification = array('title' => $title, 'body' => $body);

        $arrayToSend = array('to' => $token, 'notification' => $notification);
        $json = json_encode($arrayToSend);

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key= AIzaSyC85MK9anXJydJc0ol8eLUvXRUNWU1bHrc';


        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        //echo '<pre>'; print_r($result); echo '</pre>'; die;   
        curl_close($ch);
        return "ok";
    }

    public function sendNewnotificationPushdoctor($title, $token, $body) {

        Configure::write("debug", 0);

        $ch = curl_init("https://fcm.googleapis.com/fcm/send");

        $notification = array('title' => $title, 'body' => $body);

        $arrayToSend = array('to' => $token, 'notification' => $notification);
        $json = json_encode($arrayToSend);

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        //$headers[] = 'Authorization: key= AIzaSyBw40rweTyioDe0BFfyYrk1uK2bxbGZb6k';
        $headers[] = 'Authorization: key= AIzaSyCbdKNXKWOXMWVjrRemkdIwQndN8Vbget8';

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        // echo '<pre>'; print_r($result); echo '</pre>'; die;   
        curl_close($ch);
        return "ok";
    }

    /*     * ************ End *************************************************** */

    public function api_clientpendinglist() {

        Configure::write("debug", 0);

        $uid = $_POST['id'];

        if ($this->request->is('post')) {

            $this->loadModel("PatientTest");

            $this->loadModel("Patient");

            $this->PatientTest->recursive = 2;
            $status = 1;
            $conditions = array('PatientTest.status' => array(0, $status));

            $patientlists = $this->PatientTest->find("all", array('conditions' => array('PatientTest.doctorid' => $uid, $conditions), 'recursive' => 2, 'contain' => array('Patient', 'Test')));

            if (!empty($patientlists)) {

                $response['msg'] = $patientlists;
                $response['error'] = 0;
            } else {

                $response['msg'] = 'No Data Available';
                $response['error'] = 1;
            }
        } else {

            $response['msg'] = 'No Post Data Available';
            $response['error'] = 1;
        }

        echo json_encode($response);
        exit;
    }

    public function admin_addpatient() {

        Configure::write("debug", 0);

        $this->loadModel("User");

        $this->request->data['Patient']['enable'] = 0;

        if ($this->request->is("post")) {

            //echo '<pre>'; print_r($this->request->data); echo '</pre>'; die;
            $date = date('mdY');
            $firstname = $this->request->data['Patient']['firstname'];
            $dob = date("mdY", strtotime($this->request->data['Patient']['dob']));

            $this->request->data['Patient']['trackingid'] = $firstname[0] . $this->request->data['Patient']['lastname'][0] . $this->request->data['Patient']['lastname'][1] . $this->request->data['Patient']['lastname'][2] . $dob;
            $trackid = $this->request->data['Patient']['trackingid'];
            if ($this->request->data['Patient']['doctorid'] == 0) {
                $this->Session->setFlash("Please select a Doctor");
                return $this->redirect(array('action' => 'addpatient'));
            } else {
                $docname = explode("(",$this->request->data['Patient']['doctorname']);
                $this->request->data['Patient']['doctorname'] = $docname[0]; 

                $this->Patient->create();

                if ($this->Patient->save($this->request->data)) {

                    /*                     * ********** Notification to Doctor **************** */
                    if ($this->Auth->User("role") == 'admin') {
                        $this->loadModel("User");
                        $doctortoken = $this->User->find("first", array("conditions" => array("User.id" => $this->request->data['Patient']['doctorid'])));
                        if ($doctortoken['User']['tokenid'] != '') {
                            $title1 = "New Patient Added";
                            $message1 = "A New Patient ".$trackid." is Added";
                            //echo '<pre>'; print_r($doctortoken); echo '</pre>'; die;
                            $this->sendNewnotificationPushdoctor($title1, $doctortoken['User']['tokenid'], $message1);
                            $trackingid = $this->request->data['Patient']['trackingid'];
                            $ms = '<body>'
                                    . '<table width="500" border="0" cellpadding="10" cellspacing="0" style="margin: 0px auto; background: #f0f0f0; text-align: center">'
                                    . '<tr style="background: #f0f0f0">'
                                    . '<td colspan="2" style="text-align: center; padding-top: 20px; padding-bottom: 20px">'
                                    . '<img alt="img" style="height: 97px;" src="' . FULL_BASE_URL . $this->webroot . 'home/logo.png"/>'
                                    . '</td></tr>'
                                    . '<tr><b>A New Patient is Added</b></tr>'
                                    . '<tr>'.$trackingid.' has been added successfully.</tr>'
                                    . '</table'
                                    . '></body>';

                            $Email = new CakeEmail();
                            $Email->config('default');
                            $Email->template('default');
                            $Email->emailFormat('html');
                            $Email->from(array('noreply@truelabllc.com' => 'QualityLabOne'));
                            $Email->to($doctortoken['User']['email']);
                            $Email->subject('Add New Patient');
                            $Email->send($ms);

                            //print_r($doctortoken); die;
                            //$doctortoken['User']['email'];
                            //$l = new CakeEmail();
                            // $l->config('default');
                            // $l->emailFormat('html')->template('default', 'default')->subject('Add New Patient')->to("ashutosh@avainfotech.com")->send($ms);
                        }
                    }

                    $this->redirect(array('action' => 'index'));
                }
            }
        }

        if ($this->Auth->User("role") == 'admin') {

            $users = $this->User->find('all', array('conditions' => array('User.role' => 'client')));

            $doctorsel = array();

            foreach ($users as $user) {
                if (isset($user['User']['agencyname']) && $user['User']['agencyname'] != NULL && $user['User']['firstname'] != NULL) {
                    $doctorsel[0] = '--Select Doctor---';
                    $doctorsel[$user['User']['id']] = $user['User']['firstname'] . ' ' . $user['User']['lastname'] . ' ' . '(' . $user['User']['agencyname'] . ')';
                } elseif($user['User']['firstname'] != NULL) {
                    $doctorsel[0] = '--Select Doctor---';
                    $doctorsel[$user['User']['id']] = $user['User']['firstname'] . ' ' . $user['User']['lastname'];
                }
            }

            $this->set("doctorsel", $doctorsel);
        } else {

            $users = $this->User->find('all', array('conditions' => array('AND' => array('User.role' => 'client', 'User.email' => $this->Auth->User('email')))));

            $doctorsel = array();

            foreach ($users as $user) {

                if (isset($user['User']['agencyname']) && $user['User']['agencyname'] != NULL && $user['User']['firstname'] != NULL) {
                    $doctorsel[0] = '--Select Doctor---';
                    $doctorsel[$user['User']['id']] = $user['User']['firstname'] . ' ' . $user['User']['lastname'] . ' ' . '(' . $user['User']['agencyname'] . ')';
                } elseif($user['User']['firstname'] != NULL) {
                    $doctorsel[0] = '--Select Doctor---';
                    $doctorsel[$user['User']['id']] = $user['User']['firstname'] . ' ' . $user['User']['lastname'];
                }
                //$doctorsel[$user['User']['id']] = $user['User']['firstname'] . ' ' . $user['User']['lastname'];
            }

            $doctor = $this->User->find('first', array('conditions' => array('AND' => array('User.role' => 'client', 'User.id' => $this->Auth->User('id')))));

            $doctorname = $doctor['User']['firstname'] . $doctor['User']['lastname'];

            $this->set("doctorname", $doctorname);

            $this->set("doctorsel", $doctorsel);
        }

        $this->set("userrole", $this->Auth->User("role"));
    }

    public function admin_newtest($id = null) {

        Configure::write("debug", 0);

        $this->loadModel("Test");

        $this->loadModel("Patient");

        $this->loadModel("PatientTest");
        $this->loadModel('User');
        $this->loadModel('Agency');

        $this->set('mytitle', 'newtest');
        $this->set('alltest', $this->Test->find("all"));

        $doctordata = $this->Patient->find("first", array("conditions" => array("Patient.id" => $id)));

        if (!empty($doctordata)) {
            $doctor = $doctordata['Patient']['doctorid'];
        } else {

            $doctor = '';
        }

        if ($this->request->is('post')) {

            $testids = $this->request->data['testid'];
            if (isset($this->request->data['fasting'])) {
                $fasting = $this->request->data['fasting'];
            } else {
                $fasting = array();
            }

            $testdiagnosis = $this->request->data['testdiagnosis'];

            $popupDatepicker = $this->request->data['popupDatepicker'];


            $signature = $this->request->data['clientsignature'];


            $img = $signature;
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            $imgname = "1" . time() . ".png";
            $file = WWW_ROOT . "files" . DS . "profile_pic" . DS . $imgname;
            $imgsuccess = file_put_contents($file, $data);

            foreach ($testids as $testid) {

                if ($testid != "") {

                    $this->request->data['PatientTest'] = array();

                    $this->request->data['PatientTest']['doctorid'] = $doctor;

                    $this->request->data['PatientTest']['testid'] = $testid;

                    $this->request->data['PatientTest']['patientid'] = $id;

                    $this->request->data['PatientTest']['clientsignature'] = FULL_BASE_URL . $this->webroot . 'files/profile_pic/' . $imgname;
                    $ima = FULL_BASE_URL . $this->webroot . 'files/profile_pic/' . $imgname;
                    $this->PatientTest->create();

                    $this->PatientTest->save($this->request->data);
                    $lastid = $this->PatientTest->getInsertID();

                    $this->Patient->updateAll(array('Patient.history' => "'0'"), array('Patient.id' => $id));

                    foreach ($testdiagnosis as $key => $value) {

                        $this->PatientTest->updateAll(array('PatientTest.testdiagnosis' => "'$value'"), array('PatientTest.testid' => $key, 'PatientTest.patientid' => $id, 'PatientTest.doctorid' => $doctor, 'PatientTest.id' => $lastid));
                    }

                    foreach ($popupDatepicker as $key => $value) {

                        $this->PatientTest->updateAll(array('PatientTest.request_date' => "'$value'"), array('PatientTest.testid' => $key, 'PatientTest.patientid' => $id, 'PatientTest.doctorid' => $doctor, 'PatientTest.id' => $lastid));
                    }

                    foreach ($fasting as $fastingid) {

                        if ($fastingid != "") {

                            $this->PatientTest->updateAll(array('PatientTest.fasting' => 1), array('PatientTest.testid' => $fastingid, 'PatientTest.patientid' => $id,
                                'PatientTest.doctorid' => $doctor,
                                'PatientTest.status' => 0));
                        }
                    }



                    /*                     * ****************************Genrate PId Pdf******************************************** */


                    require_once("../webroot/MPDF57/mpdf.php");
                    $mpdf = new mPDF();

                    $patienttestdata = $this->PatientTest->find("first", array("conditions" => array("PatientTest.id" => $lastid)));
                    //echo '<pre>'; print_r($patienttestdata); echo '</pre>';
                    $patientid = $patienttestdata['PatientTest']['patientid'];
                    $doctorid = $patienttestdata['PatientTest']['doctorid'];
                    $testid = $patienttestdata['PatientTest']['testid'];
                    $clientsignature = $patienttestdata['PatientTest']['clientsignature'];
                    $patientdata = $this->Patient->find("first", array("conditions" => array("Patient.id" => $patientid)));
                    //print_r($patientdata);
                    //$dob = $patientdata['Patient']['dob'];
                    $dob = $patientdata['Patient']['dob'];
                    $trackingid = $patientdata['Patient']['trackingid'];
                    $dated = strtotime(date('Y-m-d', strtotime($dob)));
                    $today = date("Y-m-d");
                    $diff = round((time() - strtotime($dob)) / (3600 * 24 * 365.25));

                    $doctordata = $this->User->find("first", array("conditions" => array("User.id" => $doctorid)));
                    $agencyname = $doctordata['User']['agencyname'];
                    $currentdate = date('Y-m-d');
                    if ($agencyname != NULL) {
                        $agencies = $this->Agency->find("first", array("conditions" => array("Agency.agencyname" => $agencyname)));
                    }
                    $testdata = $this->Test->find("all");
                    $testdatas = $this->Test->find("all", array("conditions" => array("Test.id" => $testid)));

                    $agencyname = $doctordata['User']['agencyname'];
                    $myhtml = '';
                    $myhtml.='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <title>Report</title>

                </head>

                <body style="width:100%; text-align:center;">

                <table width="600px" border="0" style="margin:0px auto; font-family:Arial, Helvetica, sans-serif; font-size:12px; table-layout:fixed;">
                  <tr>
                    <td style="text-align:center;">
                        <h1 style="margin:0;">True Laboratories LLC</h1>
                    </td>
                  </tr>
                   <tr>
                    <td style="text-align:center;">
                        <p style="margin-top:0; font-size:14px;"><b>Oak Forest, IL. 60452. Tel No (708) 620-5790. Fax No (708) 620-5215</b></p><br />
                    </td>
                  </tr>
                  <tr>
                    <td style="table-layout:fixed; display:table; border:none; padding:0;">
                        <table style="table-layout:fixed; display:table;" width="600px" border="0" cellpadding="10" cellspacing="0">
                  </tr>
                  <tr>
                    <td style="border:1px solid #bababa; border-right:none;">PATIENT LASTNAME :</td>
                    <td style="border:1px solid #bababa; border-right:none;">' . $patientdata["Patient"]["lastname"] . '</td>
                    <td style="border:1px solid #bababa; border-right:none;">REQUEST DATE :</td>
                    <td style="border:1px solid #bababa;">' . $currentdate . '</td>
                  </tr>
                  <tr>

                  <tr style="background:#f9f9f9;">
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">PATIENT FIRSTNAME :</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">' . $patientdata["Patient"]["firstname"] . '</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">CLINIC/AGENCY NAME :</td>';
                    if ($agencyname != NULL) {
                        $myhtml.='<td style="border:1px solid #bababa; border-top:none;">' . $agencyname . '</td>';
                    } else {
                        $myhtml.='<td style="border:1px solid #bababa; border-top:none;">' . $patientdata["Patient"]["doctorname"] . '</td>';
                    }
                    $myhtml.='</tr>
                  <tr style="background:#fff;">
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">DATE OF BIRTH :</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">' . $patientdata["Patient"]["dob"] . '</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">OFFICE NUMBER :</td>';
                    if ($agencyname != NULL) {

                        $myhtml.='<td style="border:1px solid #bababa; border-top:none;">' . $doctordata['User']['agencyphonenumber'] . '</td>';
                    } else {
                        $myhtml.='<td style="border:1px solid #bababa; border-top:none;">' . $doctordata['User']['phonenumber'] . '</td>';
                    }
                    $myhtml.='</tr>
                    
                  

                  <tr style="background:#f9f9f9;">
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">AGE :</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">' . $diff . '</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">FAX NUMBER :</td>
                    ';
                    if ($agencyname != NULL) {
                        $myhtml.='<td style="border:1px solid #bababa; border-top:none;">' . $doctordata["User"]["agencyfax"] . '</td>';
                    } else {
                        $myhtml.='<td style="border:1px solid #bababa; border-top:none;">' . $doctordata["User"]["fax"] . '</td>';
                    }

                    $myhtml.='</tr>

                  <tr style="background:#fff;">
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">GENDER :</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">' . ucfirst($patientdata["Patient"]["sex"]) . '</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">ADDRESS :</td>
                    <td style="border:1px solid #bababa; border-top:none;">' . $doctordata['User']['address'] . ',' . $doctordata["User"]["address2"] . '</td>
                  </tr>

                  <tr style="background:#f9f9f9;">
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">PHONE NUMBER :</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">' . $patientdata["Patient"]["phonenumber"] . '</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">CITY, STATE, ZIP CODE :</td>
                    <td style="border:1px solid #bababa; border-top:none;">' . $doctordata["User"]["city"] . ',' . $doctordata["User"]['state'] . ',' . $doctordata['User']["zipcode"] . '</td>
                  </tr>

                  <tr style="background:#fff;">
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">ADDRESS :</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">' . $patientdata["Patient"]["address"] . '</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">DOCTOR NAME :</td>
                    <td style="border:1px solid #bababa; border-top:none;">' . $doctordata["User"]["firstname"] . '</td>
                  </tr>

                  <tr style="background:#f9f9f9;">
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">ADDRESS2 :</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">' . $patientdata["Patient"]["address2"] . '</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">DOCTOR NPI NO. :</td>
                    <td style="border:1px solid #bababa; border-top:none;">' . $doctordata["User"]["npi"] . '</td>
                  </tr>

                  <tr style="background:#fff;">
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">CITY, STATE, ZIP CODE :</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">' . $patientdata["Patient"]["city"] . ',' . $patientdata["Patient"]["state"] . ',' . $patientdata["Patient"]["zipcode"] . '</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">DOCTOR/REPRESENTATIVE SIGNATURE :</td>
                    <td style="border:1px solid #bababa; border-top:none;"><img width="150px" src=' . $clientsignature . '></td>
                  </tr>

                  <tr style="background:#f9f9f9;">
                    <td colspan="2" style="border:1px solid #bababa; border-right:none; border-top:none;">DIAGNOSIS (ICD 10) :</td>
                    <td colspan="2" style="border:1px solid #bababa; border-top:none;">' . $patienttestdata["PatientTest"]["testdiagnosis"] . '</td>
                  </tr>

                  <tr style="background:#fff;">
                    <td colspan="2" style="border:1px solid #bababa; border-right:none; border-top:none;">SPECIAL INSTRUCTION :</td>
                    <td colspan="2" style="border:1px solid #bababa;  border-top:none;">' . $patientdata["Patient"]["diagnosis"] . '</td>
                  </tr>

                  <tr>
                        <td colspan="4"><form id="form1" name="form1" method="post" action="">
                          <p>';
                    $checked = "";
                    foreach ($testdata as $tests) {
                        if ($testid == $tests['Test']['id']) {

                            $myhtml.='<label>
                              <input type="checkbox" name="CheckboxGroup1" value="checkbox" checked="checked" id="CheckboxGroup1_0" />';
                        } else {
                            $myhtml.='<label>
                              <input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_0" />';
                        }

                        $myhtml.='<b style="font-size:12px">' . $tests["Test"]["test"] . '</b></label> <br/>';
                    }
                    $myhtml.='</p>
                          </form></td>
                  </tr>
                  <tr>

                    <td style="border:1px solid #bababa; border-bottom:none;" colspan="4"><p>I AUTHORIZE THE RELEASE OF MY INSURANCE CARRIER OF ANY MEDICAL INFORMATION NECESSARY TO PROCESS THIS CLAIM AND I AUTHORIZE PAYMENT OF MEDICAL BENEFITS DIRECTLY TO TRUE LABORATORIES LLC.</p></td>
                  </tr>
                  <tr>
                        <td colspan="2" style="border:1px solid #bababa; border-right:none;">
                        PATIENTâ€™S SIGNATURE
                    </td>
                    <td style="border:1px solid #bababa;" colspan="2">
                       
                            
                    </td>
                  </tr>

                </table>

                    </td>
                  </tr>
                </table>

                </body>
                </html>';


                    $nomFacture = time() . ".pdf";
                    $filename = $nomFacture;

                    $path = '../webroot/MPDF57/pdf';
                    $file = $path . "/" . $filename;

                    $mpdf->WriteHTML($myhtml);
                    $mpdf->Output($file, 'F');
                    $filesave = FULL_BASE_URL . "/truelab/MPDF57/pdf/" . $filename;
                    $this->PatientTest->updateAll(array('PatientTest.paidreport' => "'$filesave'"), array('PatientTest.id' => $lastid));
                    if ($agencyname != NULL) {
                       $ag = $agencyname;
                    }else{
                      $ag = $patientdata["Patient"]["doctorname"]; 
                    }
                    $tn = $testdatas["Test"]["test"];

                    $ms = '<body><table width="500" border="0" cellpadding="10" cellspacing="0" style="margin: 0px auto; background: #f0f0f0; text-align: center"><tr style="background: #f0f0f0"><td colspan="2" style="text-align: center; padding-top: 20px; padding-bottom: 20px"><img alt="img" style="height: 97px;" src="' . FULL_BASE_URL . $this->webroot .'home/logo.png"/></td></tr><tr><b>New Test Added</b></tr><tr>New Test for '.$trackingid.' has been added successfully.</tr><tr>Agency Name : '.$ag.'</tr><tr>Test Name : '.$tn.'</tr></table></body>';

                    $Email = new CakeEmail();
                    $Email->config('default');
                    $Email->template('default');
                    $Email->emailFormat('html');
                    $Email->from(array('noreply@truelabllc.com' => 'QualityLabOne'));
                    $Email->to('notification@truelabllc.com');
                    $Email->subject('Add Test Added');
                    $Email->send($ms); 


                    /*                     * ************************************************************************ */
                }
            }
            return $this->redirect(array('action' => 'test', $id));
        }
    }

    public function api_getdoc() {
        $postdata = file_get_contents("php://input");
        $redata = json_decode($postdata);
        echo json_encode($_POST);
        exit;
    }

    public function admin_patienttestreport($id = null) {
        Configure::write("debug", 0);
        $this->loadModel("PatientTest");
        $this->loadModel("User");
        $this->loadModel("Test");
        $finalreport = array();
        $allreports = $this->PatientTest->find("all", array("conditions" => array("AND" => array("PatientTest.patientid" => $id))));

        foreach ($allreports as $allreport) {
            $tests = $this->Test->find("first", array("conditions" => array("Test.id" => $allreport['PatientTest']['testid'])));

            $phlebotomists = $this->User->find("first", array("conditions" => array("User.id" => $allreport['PatientTest']['userid'])));
            if (!empty($phlebotomists)) {
                $phlebotomistsname = $phlebotomists['User']['firstname'] . ' ' . $phlebotomists['User']['lastname'];
            } else {
                $phlebotomistsname = '';
            }
            if ($allreport['PatientTest']['fasting'] == 1) {
                $fasting = 'Yes';
            } else {
                $fasting = 'No';
            }
            if (isset($allreport['PatientTest']['reportpdf']) && $allreport['PatientTest']['reportpdf'] != NULL) {
                $reportfilestatus = 1;
                $report = $allreport['PatientTest']['reportpdf'];
            } else {
                $reportfilestatus = 0;
                $report = "No Report Available Now";
            }
            if (isset($allreport['PatientTest']['paidreport']) && $allreport['PatientTest']['paidreport'] != NULL) {
                $paidreportfilestatus = 1;
                $paidreport = $allreport['PatientTest']['paidreport'];
            } else {
                $paidreportfilestatus = 0;
                $paidreport = "No Report Available Now";
            }
            //check date 
            if ($allreport['PatientTest']['date'] != NULL) {
                $testdate = date("Y-m-d", strtotime($allreport['PatientTest']['date']));
            } else {
                $testdate = '';
            }
            if ($allreport['PatientTest']['reportdate'] != NULL) {
                $reportdate = date("Y-m-d", strtotime($allreport['PatientTest']['reportdate']));
            } else {
                $reportdate = '';
            }

            if (isset($allreport['PatientTest']['reportdownloadstatus']) && $allreport['PatientTest']['reportdownloadstatus'] == '1') {
                $reportdownloadstatus = 'background-color:green';
            } else {
                $reportdownloadstatus = '';
            }
            if (isset($allreport['PatientTest']['paidreportdownloadstatus']) && $allreport['PatientTest']['paidreportdownloadstatus'] == '1') {
                $paidreportdownloadstatus = 'background-color:green';
            } else {
                $paidreportdownloadstatus = '';
            }
            $finalreport[] = array(
                'id' => $allreport['PatientTest']['id'],
                'testid' => $allreport['PatientTest']['testid'],
                'testname' => $tests['Test']['test'],
                'phlebotomistname' => $phlebotomistsname,
                'fasting' => $fasting,
                'testdate' => $testdate,
                'reportdate' => $reportdate,
                'report' => $report,
                'reportfilestatus' => $reportfilestatus,
                'paidreport' => $paidreport,
                'paidreportfilestatus' => $paidreportfilestatus,
                'reportdownloadstatus' => $reportdownloadstatus,
                'paidreportdownloadstatus' => $paidreportdownloadstatus
            );
        }
        //echo '<pre>'; print_r($allreports); echo '</pre>'; die();
        $this->set("finalreport", $finalreport);
    }

    public function admin_deleterequest($id = null, $pid = null) {
        Configure::write("debug", 0);
        $this->loadModel("PatientTest");
        $deletepatient = $this->PatientTest->deleteAll(array('PatientTest.id' => $id, 'PatientTest.patientid' => $pid));
        if ($deletepatient) {
            $this->Session->setFlash("Request canceled");
            return $this->redirect(array('action' => 'test', $pid));
        }
    }

    public function api_patientreport() {
       
        Configure::write("debug", 0);
        
        $id = $_POST['id'];
        $report = $_POST['report'];
        $flag = $_POST['flag'];
        $conclusion = $_POST['conclusion'];
        $reportdate = date("Y-m-d h:i:s");
        $this->loadModel("PatientTest");
        $this->loadModel("Patient");
        $this->loadModel("User");
        $this->loadModel("Test");
        $day = date("Y-m-d");
        $time = date("H:i:s");

        $data = $this->PatientTest->find("first", array("conditions" => array("PatientTest.id" => $id)));
        if($data['PatientTest']['reporttime'] != Null){
        	$reportadd = $this->PatientTest->updateAll(array('PatientTest.report' => "'$report'", 'PatientTest.conclusion' => "'$conclusion'", 'PatientTest.flag' => "'$flag'", 'PatientTest.reportdate' => "'$reportdate'"), array('PatientTest.id' => $id));

        }else{
                $reportadd = $this->PatientTest->updateAll(array('PatientTest.report' => "'$report'", 'PatientTest.conclusion' => "'$conclusion'", 'PatientTest.flag' => "'$flag'", 'PatientTest.reportdate' => "'$reportdate'", 'PatientTest.reporttime' => "'$time'", 'PatientTest.reportday' => "'$day'"), array('PatientTest.id' => $id));

    	}

        if ($reportadd) {

            $patienttestdata = $this->PatientTest->find("first", array("conditions" => array("PatientTest.id" => $id)));
            $patientid = $patienttestdata['PatientTest']['patientid'];
            $testid = $patienttestdata['PatientTest']['testid'];
            $userid = $patienttestdata['PatientTest']['userid'];
            $did = $patienttestdata['PatientTest']['doctorid'];
            $patientdata = $this->Patient->find("first", array("conditions" => array("Patient.id" => $patientid)));
            $userdata = $this->User->find("first", array("conditions" => array("User.id" => $userid)));
            $ddata = $this->User->find("first", array("conditions" => array("User.id" => $did)));
            $testdata = $this->Test->find("first", array("conditions" => array("Test.id" => $testid)));
            $testname = $testdata['Test']['test'];
            $testtext = $testdata['Test']['freetext'];
            //$dob = $patientdata['Patient']['dob'];
            //$time = strtotime($dob);
            //$newformat = date("Y-m-d",$time);
            $today = date("Y-m-d");
            //$diff = date_diff(date_create($newformat), date_create($today));
            /* $diff= '22'; */
            $dob = $patientdata['Patient']['dob'];
            $dated = strtotime(date('Y-m-d', strtotime($dob)));
            $diff = round((time() - strtotime($dob)) / (3600 * 24 * 365.25));

            $pass = $id . $testname . $patientid;
            $pdate = date("Y-m-d", strtotime($patienttestdata['PatientTest']['date']));
            $ptime = date("h:i:s", strtotime($patienttestdata['PatientTest']['date']));
          	//$time=date("H:i:s");
            $bccemail = $this->User->find("first", array("conditions" => array("User.role" => "admin")));
            $bcc = $bccemail['User']['email'];
            $myhtml = '';
            $myhtml = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <title>Report</title>
                </head>

                <body style="font-family:times-new-roman; font-size:12px;">
                    <h1 style="text-align:center; width:100%; float: left; margin-bottom:0;">True Laboratories LLC</h1>
                    <p style="text-align:center; width:100%; float: left;  border-bottom:3px solid #000; margin-top:0px; padding-bottom:10px;">Oak Forest, IL. Tel No (708) 620-5790. Fax No (708) 620-5215</p>
					
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-bottom:10px; text-align:left; border-bottom:1px solid #000;">
                	<tr>					
					<td style="height:30px;"><strong>Patient Name</strong>: ' . ucwords($patientdata['Patient']['firstname'] . ' ' . $patientdata['Patient']['lastname']) . '</td>
					</tr>
					<tr>
						<td style="height:30px;"></td>
					</tr>
                	<tr>
                    <td style="height:30px;"><strong>Gender</strong>: ' . ucfirst($patientdata['Patient']['sex']) . '</td>
                    <td style="height:30px;"><strong>MR#</strong>: ' . $patientdata["Patient"]["trackingid"] . '</td>
                    <td style="height:30px;"><strong>Collection Date</strong>: ' . $day . '</td>
                  </tr>
				 
                 
                 <tr>
                    <td style="height:30px;"><strong>DOB</strong>: ' . $patientdata['Patient']['dob'] . '</td>
                    <td style="height:30px;"><strong>Accession No.</strong>: ' . $id . '</td>
                    <td style="height:30px;"><strong>Collected Time</strong>: ' . $patienttestdata['PatientTest']['reporttime'] . '</td>
                  </tr>
                  	<tr>
                    <td style="height:30px;"><strong>Age</strong>:' . $diff . '</td>
                    <td style="height:30px;"><strong>Doctor Name</strong>: ' . $ddata['User']['firstname'] . '</td>
                    <td style="height:30px;"><strong>Collected by</strong>: ' . $userdata['User']['firstname'][0] . $userdata['User']['lastname'][0] . $userdata['User']['lastname'][1] . $userdata['User']['lastname'][2] . '</td>
                  </tr>
                </table>

                <table width="100%" border="0" cellpadding="10" style="padding-bottom:10px; text-align:left; border-bottom:1px solid #000;">
                  <tr style="text-align:left;">
                    <th style="text-align:left;">Test Name</th>
                    <th style="text-align:left;">Result</th>
                    <th style="text-align:left;">Units</th> 
                    <th style="text-align:left;">Flag</th>
                    <th style="text-align:left;">Reference Range</th>
                    </tr>';

            if ($testname == "PT/INR") {
                $myArray = explode('/', $testname);
                $rep = explode('/', $report);
                $units = $testdata['Test']['units'];
                $unit = explode('/', $units);
                $referencerange = $testdata['Test']['referencerange'];
                $range = explode('/', $referencerange);
                $flags = explode('/', $flag);

                $myhtml.='<tr style="text-align:left;">
                          <td style="text-align:left;">' . $myArray[0] . '</td>
                          <td style="text-align:left;">' . $rep[0] . '</td>
                          <td style="text-align:left;">' . $unit[0] . '</td>
                          <td style="text-align:left;">' . $flags[0] . '</td>
                          <td style="text-align:left;">' . $range[0] . '</td>
                        </tr>
                        <tr style="text-align:left;">
                          <td style="text-align:left;">' . $myArray[1] . '</td>
                          <td style="text-align:left;">' . $rep[1] . '</td>
                          <td style="text-align:left;">' . $unit[1] . '</td>
                          <td style="text-align:left;">' . $flags[1] . '</td>
                          <td style="text-align:left;">' . $range[1] . '</td>
                        </tr>';
            } else {
                $myhtml.='<tr style="text-align:left;">
                          <td style="text-align:left;">' . $testdata['Test']['test'] . '</td>
                          <td style="text-align:left;">' . $report . '</td>
                          <td style="text-align:left;">' . $testdata['Test']['units'] . '</td>
                          <td style="text-align:left;">' . $flag . '</td>
                          <td style="text-align:left;">' . $testdata['Test']['referencerange'] . '</td>
                        </tr>';
            }

            $myhtml.='</table>
                <p style="width:100%; float:left; padding-top: 10px;">
                ' . $testtext . '
                </p>
                <p style="width:100%; float:left; padding-top: 10px;font-style: italic;">
                ' . $conclusion . '
                </p> </body> </html>';

            //echo "<pre>";
            //echo $myhtml; die;
            $nomFacture = time() . ".pdf";
            $filename = $nomFacture;

            $path = '../webroot/MPDF57/pdf';
            $file = $path . "/" . $filename;

            include("../webroot/MPDF57/mpdf.php");
            $mpdf = new mPDF();
            $mpdf->SetProtection(array(), $pass, 'MyPassword');
            $mpdf->WriteHTML($myhtml);
            $mpdf->Output($file, 'F');
            $filesave = FULL_BASE_URL . "/truelab/MPDF57/pdf/" . $filename;
            $this->PatientTest->updateAll(array('PatientTest.reportpdf' => "'$filesave'"), array('PatientTest.id' => $id));
            $emailz = $userdata['User']['email'];
            $subject = 'Patient Report';
            $message = 'The Password to view this report is  ' . $pass . '  .';
            $ddoctoremail = $ddata['User']['email'];
            $Email = new CakeEmail();
                    $Email->config('default');
                    $Email->template('default');
                    $Email->emailFormat('html');
                    $Email->from(array('noreply@truelabllc.com' => 'QualityLabOne'));
                    $Email->to('notification@truelabllc.com');
                    $Email->subject('Patient Report');
                    $Email->send($message);

            $Email = new CakeEmail();
                    $Email->config('default');
                    $Email->template('default');
                    $Email->emailFormat('html');
                    $Email->from(array('noreply@truelabllc.com' => 'QualityLabOne'));
                    $Email->to($ddoctoremail);
                    $Email->subject('Patient Report');
                    $Email->send($message);

            $response['msg'] = 'Report added Successfuly';
            $response['error'] = 0;
        } else {
            $response['msg'] = 'No Data Available';
            $response['error'] = 1;
        }

        echo json_encode($response);

        exit;
    }

    public function admin_ajaxagencyload() {
        Configure::write("debug", 0);
        $doctorid = $_REQUEST['doctorid'];
        $this->loadModel("User");
        if (isset($doctorid)) {
            $html = '';
            $agencyname = $this->User->find("first", array("conditions" => array("AND" => array("User.id" => $doctorid))));

            if (isset($agencyname['User']['agencyname']) && $agencyname['User']['agencyname'] != NULL) {
                $html .= '<br>';
                $html .= '<div class="input text">';
                $html .= '<label>Agency Name</label>';
                $html .= '<input type="text" disabled class="form-control" value="' . $agencyname['User']['agencyname'] . '">';
                $html .= '</div>';
                $html .= '<br>';
            } else {
                $html = '';
            }
        }
        echo $html;
        exit;
    }

    public function admin_autoloaddoctorinfo() {
        Configure::write("debug", 2);
        $doctorid = $_REQUEST['doctorid'];
        $this->loadModel("User");
        $json = array();
        $agencyinfo = $this->User->find("first", array("conditions" => array("AND" => array("User.id" => $doctorid))));
        if (!empty($agencyinfo)) {
            $json = array(
                'doctornumber' => $agencyinfo['User']['phonenumber'],
                'doctorfax' => $agencyinfo['User']['fax'],
                'doctornpi' => $agencyinfo['User']['npi']
            );
        } else {
            $json = array();
        }

        echo json_encode($json);
        exit;
    }

    public function api_reportstatus() {
        Configure::write("debug", 0);
        $this->loadModel("PatientTest");
        $patienttestid = $_POST['id'];
        $reportstatus = $_POST['reportstatus'];

        if ($this->request->is('post')) {
            $this->PatientTest->updateAll(array('PatientTest.reportstatus' => "'$reportstatus'"), array("PatientTest.id" => $patienttestid));
            $response['msg'] = 'Update successfully';
            $response['error'] = 0;
        } else {
            $response['msg'] = 'No Post data Available';
            $response['error'] = 1;
        }

        echo json_encode($response);
        exit;
    }

    public function admin_testsforreportuploded($id = null) {
        Configure::write("debug", 0);
        $this->loadModel("PatientTest");
        $this->loadModel("User");
        $this->loadModel("Test");
        $finalalltest = array();
        $currentdate = date("Y-m-d");
        $alltests = $this->PatientTest->find("all", array("conditions" => array("PatientTest.patientid" => $id)));

        //$alltests = $this->PatientTest->find("all", array("conditions" => array("AND" => array("PatientTest.status" => 2,"DATE(PatientTest.date) > " => $currentdate, "PatientTest.patientid" => $id))));


        foreach ($alltests as $alltest) {

            if ($alltest['PatientTest']['status'] == 2 && date('Y-m-d', strtotime($alltest['PatientTest']['date'])) > $currentdate) {

                $tests = $this->Test->find("first", array("conditions" => array("Test.id" => $alltest['PatientTest']['testid'])));

                $phlebotomists = $this->User->find("first", array("conditions" => array("User.id" => $alltest['PatientTest']['userid'])));
                $doctor = $this->User->find("first", array("conditions" => array("User.id" => $alltest['PatientTest']['doctorid'])));
                if (!empty($phlebotomists)) {
                    $phlebotomistsname = $phlebotomists['User']['firstname'] . ' ' . $phlebotomists['User']['lastname'];
                } else {
                    $phlebotomistsname = '';
                }
                if (!empty($doctor)) {
                    $doctorname = $doctor['User']['firstname'] . ' ' . $doctor['User']['lastname'];
                } else {
                    $doctorname = '';
                }
                if ($alltest['PatientTest']['fasting'] == 1) {
                    $fasting = 'Yes';
                } else {
                    $fasting = 'No';
                }
                if ($alltest['PatientTest']['reportpdf'] == NULL) {
                    $alreadytestreport = '';
                } else {
                    $alreadytestreport = 'Already Exsist';
                }
                $finalalltest[] = array(
                    'id' => $alltest['PatientTest']['id'],
                    'patientid' => $alltest['PatientTest']['patientid'],
                    'testid' => $alltest['PatientTest']['testid'],
                    'testname' => $tests['Test']['test'],
                    'phlebotomistname' => $phlebotomistsname,
                    'doctorname' => $doctorname,
                    'fasting' => $fasting,
                    'alreadytestreport' => $alreadytestreport,
                );
            } elseif ($alltest['PatientTest']['status'] == 1) {

                $tests = $this->Test->find("first", array("conditions" => array("Test.id" => $alltest['PatientTest']['testid'])));

                $phlebotomists = $this->User->find("first", array("conditions" => array("User.id" => $alltest['PatientTest']['userid'])));
                $doctor = $this->User->find("first", array("conditions" => array("User.id" => $alltest['PatientTest']['doctorid'])));
                if (!empty($phlebotomists)) {
                    $phlebotomistsname = $phlebotomists['User']['firstname'] . ' ' . $phlebotomists['User']['lastname'];
                } else {
                    $phlebotomistsname = '';
                }
                if (!empty($doctor)) {
                    $doctorname = $doctor['User']['firstname'] . ' ' . $doctor['User']['lastname'];
                } else {
                    $doctorname = '';
                }
                if ($alltest['PatientTest']['fasting'] == 1) {
                    $fasting = 'Yes';
                } else {
                    $fasting = 'No';
                }
                if ($alltest['PatientTest']['reportpdf'] == NULL) {
                    $alreadytestreport = 'Pending..';
                } else {
                    $alreadytestreport = 'Already Exsist';
                }

                $finalalltest[] = array(
                    'id' => $alltest['PatientTest']['id'],
                    'patientid' => $alltest['PatientTest']['patientid'],
                    'testid' => $alltest['PatientTest']['testid'],
                    'testname' => $tests['Test']['test'],
                    'phlebotomistname' => $phlebotomistsname,
                    'doctorname' => $doctorname,
                    'fasting' => $fasting,
                    'alreadytestreport' => $alreadytestreport,
                );
            }
        }
        $this->set("finalalltest", $finalalltest);
    }

    public function admin_reportadminupload($tid = null, $id = null, $pid = null) {
        Configure::write("debug", 0);
        $this->loadModel("Test");
        $this->loadModel("Patient");
        $this->loadModel("PatientTest");
        $test = $this->Test->find("first", array("conditions" => array("Test.id" => $tid)));
        $patientdata = $this->Patient->find("first", array("conditions" => array("Patient.id" => $pid)));
        $datapatienttest = $this->PatientTest->find("first", array("conditions" => array("PatientTest.id" => $id)));
        $this->set("patienttestid", $id);
        $this->set("datapatienttest", $datapatienttest);
        $this->set("testid", $tid);
        $this->set("patid", $pid);
        $this->set("test", $test);
        $this->set("patientdata", $patientdata);
        if ($this->request->is("post")) {
            if ($this->request->data['PatientTest']['test'] == 'PT/INR') {
                $report = $this->request->data['PatientTest']['report'] . '/' . $this->request->data['PatientTest']['report1'];
                $flag = $this->request->data['PatientTest']['flag'] . '/' . $this->request->data['PatientTest']['flag1'];
                $conclusion = $this->request->data['PatientTest']['conclu'];
            } else {
                $report = $this->request->data['PatientTest']['report'];
                $flag = $this->request->data['PatientTest']['flag'];
                $conclusion = $this->request->data['PatientTest']['conclu'];
            }
            $reportdate = date("Y-m-d h:i:s");

            $time = date("H:i:s");
            $day = date("Y-m-d");

	        $data = $this->PatientTest->find("first", array("conditions" => array("PatientTest.id" => $id)));

	        if($data['PatientTest']['reporttime'] != Null){
	        $reportadd = $this->PatientTest->updateAll(array('PatientTest.report' => "'$report'", 'PatientTest.conclusion' => "'$conclusion'", 'PatientTest.flag' => "'$flag'", 'PatientTest.reportdate' => "'$reportdate'"), array('PatientTest.id' => $id));
	        }else{
	         $reportadd = $this->PatientTest->updateAll(array('PatientTest.report' => "'$report'", 'PatientTest.conclusion' => "'$conclusion'", 'PatientTest.flag' => "'$flag'", 'PatientTest.reportdate' => "'$reportdate'", 'PatientTest.reporttime' => "'$time'", 'PatientTest.reportday' => "'$day'"), array('PatientTest.id' => $id));
	    	}

            if ($reportadd) {
                $patienttestdata = $this->PatientTest->find("first", array("conditions" => array("PatientTest.id" => $id)));
                $patientid = $patienttestdata['PatientTest']['patientid'];
                $testid = $patienttestdata['PatientTest']['testid'];
                $userid = $patienttestdata['PatientTest']['userid'];
                $did = $patienttestdata['PatientTest']['doctorid'];
                $patientdata = $this->Patient->find("first", array("conditions" => array("Patient.id" => $patientid)));
                $userdata = $this->User->find("first", array("conditions" => array("User.id" => $userid)));
                $ddata = $this->User->find("first", array("conditions" => array("User.id" => $did)));
                $testdata = $this->Test->find("first", array("conditions" => array("Test.id" => $testid)));
                $testname = $testdata['Test']['test'];
                //$dob = $patientdata['Patient']['dob'];
                //$time = strtotime($dob);
                //$newformat = date("Y-m-d",$time);
                $today = date("Y-m-d");
                //$diff = date_diff(date_create($newformat), date_create($today));

                $dob = $patientdata['Patient']['dob'];
                $dated = strtotime(date('Y-m-d', strtotime($dob)));
                $diff = round((time() - strtotime($dob)) / (3600 * 24 * 365.25));

                $pass = $id . $testname . $patientid;
                $pdate = date("Y-m-d", strtotime(str_replace('-', '/', $patienttestdata["PatientTest"]["date"])));

                $ptime = date("h:i:s", strtotime(str_replace('-', '/', $patienttestdata["PatientTest"]["date"])));
                
                $bccemail = $this->User->find("first", array("conditions" => array("User.role" => "admin")));
                $bcc = $bccemail['User']['email'];
                $ddoctoremail = $ddata['User']['email'];
                $myhtml = '';
                $myhtml .='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <title>Report</title>
                </head>

                <body style="font-family:times-new-roman; font-size:12px;">
                    <h1 style="text-align:center; width:100%; float: left; margin-bottom:0;">True Laboratories LLC</h1>
                    <p style="text-align:center; width:100%; float: left;  border-bottom:3px solid #000; margin-top:0px; padding-bottom:10px;">Oak Forest, IL. Tel No (708) 620-5790. Fax No (708) 620-5215</p>
                    
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-bottom:10px; text-align:left; border-bottom:1px solid #000;">
                    <tr>        
                    <td colspan="3" style="height:30px;"><strong>Patient Name</strong>: ' . ucwords($patientdata["Patient"]["firstname"] . ' ' . $patientdata["Patient"]["lastname"]) . '</td>
                    </tr>
                    <tr>
                        <td style="height:30px;"></td>
                    </tr>
                  </tr>
                  <tr >
                    <td style="height:30px;"><strong>Gender</strong>: ' . ucfirst($patientdata["Patient"]["sex"]) . '</td>
                    <td style="height:30px;"><strong>MR#</strong>: ' . $patientdata["Patient"]["trackingid"]. '</td>
                    <td style="height:30px;"><strong>Collection Date</strong>: ' . $day . '</td>
                  </tr>
                 
                  <tr>
                    <td style="height:30px;"><strong>DOB</strong>: ' . $patientdata["Patient"]["dob"] . '</td>
                    <td style="height:30px;"><strong>Accession No.</strong>: ' . $id . '</td>
                    <td style="height:30px;"><strong>Collected Time</strong>: ' . $patienttestdata['PatientTest']['reporttime'] . '</td>
                  </tr>
                  <tr>
                    <td style="height:30px;"><strong>Age</strong>: ' . $diff . '</td>
                    <td style="height:30px;"><strong>Doctor Name</strong>: ' . $ddata["User"]["firstname"] . '</td>
                    <td style="height:30px;"><strong>Collected by</strong>: ' . $userdata['User']['firstname'][0] . $userdata['User']['lastname'][0] . $userdata['User']['lastname'][1] . $userdata['User']['lastname'][2] . '</td>
                  </tr>
                </table>

                <table width="100%" border="0" cellpadding="10" style="padding-bottom:10px; text-align:left; border-bottom:1px solid #000;">
                  <tr style="text-align:left;">
                    <th style="text-align:left;">Test Name</th>
                    <th style="text-align:left;">Result</th>
                    <th style="text-align:left;">Units</th> 
                    <th style="text-align:left;">Flag</th>
                    <th style="text-align:left;">Reference Range</th>
                    </tr>';
                if ($testname == "PT/INR") {
                    $myArray = explode('/', $testname);
                    $rep = explode('/', $report);
                    $units = $testdata["Test"]["units"];
                    $unit = explode('/', $units);
                    $referencerange = $testdata["Test"]["referencerange"];
                    $range = explode('/', $referencerange);
                    $flags = explode('/', $flag);

                    $myhtml.='<tr>
                          <td style="height:30px;">' . $myArray[0] . '</td>
                          <td style="height:30px;">' . $rep[0] . '</td>
                          <td style="height:30px;">' . $unit[0] . '</td>
                          <td style="height:30px;">' . $flags[0] . '</td>
                          <td style="height:30px;">' . $range[0] . '</td>
                        </tr>
                        <tr>
                          <td style="height:30px;">' . $myArray[1] . '</td>
                          <td style="height:30px;">' . $rep[1] . '</td>
                          <td style="height:30px;">' . $unit[1] . '</td>
                          <td style="height:30px;">' . $flags[1] . '</td>
                          <td style="height:30px;">' . $range[1] . '</td>
                        </tr>';
                } else {
                    $myhtml.='<tr>
                          <td style="height:30px;">' . $testdata["Test"]["test"] . '</td>
                          <td style="height:30px;">' . $report . '</td>
                          <td style="height:30px;">' . $testdata["Test"]["units"] . '</td>
                          <td style="height:30px;">' . $flag . '</td>
                          <td style="height:30px;">' . $testdata["Test"]["referencerange"] . '</td>
                        </tr>';
                }

                $myhtml.='</table>
                <p style="width:100%; float:left; padding-top: 10px;">
                ' . $testdata['Test']['freetext'] . '
                </p>
                <p style="width:100%; float:left; padding-top: 10px;font-style: italic;">
                ' . $conclusion . '
                </p> </body> </html>';


                $nomFacture = time() . ".pdf";
                $filename = $nomFacture;

                $path = '../webroot/MPDF57/pdf';
                $file = $path . "/" . $filename;

                include("../webroot/MPDF57/mpdf.php");
                $mpdf = new mPDF();
                $mpdf->SetProtection(array(), $pass, 'MyPassword');
                $mpdf->WriteHTML($myhtml);
                $mpdf->Output($file, 'F');
                $filesave = FULL_BASE_URL . "/truelab/MPDF57/pdf/" . $filename;
                $this->PatientTest->updateAll(array('PatientTest.reportpdf' => "'$filesave'"), array('PatientTest.id' => $id));
                $emailz = $userdata['User']['email'];
                $subject = 'Patient Report';
                $message = 'The Password to view this report is  ' . $pass . '  .';

                $Email = new CakeEmail();
                    $Email->config('default');
                    $Email->template('default');
                    $Email->emailFormat('html');
                    $Email->from(array('noreply@truelabllc.com' => 'QualityLabOne'));
                    $Email->to('notification@truelabllc.com');
                    $Email->attachments($file);
                    $Email->subject('Patient Report');
                    $Email->send($message);

                    $Email = new CakeEmail();
                    $Email->config('default');
                    $Email->template('default');
                    $Email->emailFormat('html');
                    $Email->from(array('noreply@truelabllc.com' => 'QualityLabOne'));
                    $Email->to($ddoctoremail);
                    $Email->attachments($file);
                    $Email->subject('Patient Report');
                    $Email->send($message);

                if ($_SESSION['Auth']['User']['role'] == 'user') {
                    return $this->redirect(array('action' => 'phlebotomistscheduled'));
                } else {
                    return $this->redirect(array('action' => 'testsforreportuploded', $pid));
                }
            }
        }
    }

    public function admin_ajaxupdatereportstatus() {
        Configure::write("debug", 0);
        $this->loadModel("PatientTest");
        $id = $_REQUEST['id'];
        $date = date("Y-m-d H:i:s");
        if (isset($id)) {
            $update = 1;
            $this->PatientTest->updateAll(
                    array('PatientTest.reportdownloadstatus' => "'" . $update . "'",'PatientTest.reportdownloadstatus_date' => "'" . $date . "'"), array('PatientTest.id' => $id)
            );
        }
        echo 'success';
        exit;
    }

    public function admin_ajaxupdatepaidreportstatus() {
        Configure::write("debug", 0);
        $this->loadModel("PatientTest");
        $id = $_REQUEST['id'];
        $date = date("Y-m-d H:i:s");
        if (isset($id)) {
            $update = 1;
            $this->PatientTest->updateAll(
                    array('PatientTest.paidreportdownloadstatus' => "'" . $update . "'",'PatientTest.paidreportdownloadstatus_date' => "'" . $date . "'"), array('PatientTest.id' => $id)
            );
        }
        echo 'success';
        exit;
    }

    public function api_clientdownloadreportfromapp() {
        Configure::write("debug", 0);
        $this->loadModel("PatientTest");
        $id = $_POST['id'];
        $status = $_POST['status'];
        $date = date('Y-m-d h:i:s');
        if ($this->request->is('post')) {
            $data = $this->PatientTest->updateAll(array('PatientTest.appclientdownloadreport' => "'$status'", 'PatientTest.appclientdownloadreport_date' => "'$date'"), array('PatientTest.id' => $id));

            $response['appclientdownloadreport'] = $status;

            $response['error'] = 0;

            $response['isSucess'] = 'true';
        } else {

            $response['error'] = 1;

            $response['isSucess'] = 'false';
        }

        echo json_encode($response);

        exit;
    }

    public function api_delpatientinfo() {
        configure::write('debug', 0);
        $this->loadModel('PatientTest');
        $this->loadModel('Patient');
        $this->loadModel('StatusAccept');
        $this->loadModel('StatusDecline');
        $this->loadModel('StatusCancel');
        $this->loadModel('StatusHistory');
        $this->loadModel('StatusReschedule');

        $today = strtotime(date('Y-m-d'));
        $dataee = $this->Patient->query("SELECT patients.id,(SELECT count(*) FROM `patient_tests` where patientid = patients.id and report is not null) as patient_count ,(SELECT count(*) FROM `patient_tests` where patientid = patients.id) as allcount, (SELECT patient_tests.appclientdownloadreport_date FROM `patient_tests` where patient_tests.patientid = patients.id and patient_tests.appclientdownloadreport = '1' order by patient_tests.reportdate DESC limit 1) as last_reportdate FROM `patients` having patient_count>0 and allcount>0 and  patient_count = allcount");

        foreach ($dataee as $datas) {

            $id = $datas['patients']['id'];

            $dated = strtotime(date('Y-m-d', strtotime($datas[0]['last_reportdate'])));
            $days_between = ceil(abs($today - $dated) / 86400);

            if ($days_between > 3) {
                $this->Patient->deleteAll(array('Patient.id' => $id), false);
                $this->StatusAccept->deleteAll(array('StatusAccept.patientid' => $id), false);
                $this->StatusDecline->deleteAll(array('StatusDecline.patientid' => $id), false);
                $this->StatusCancel->deleteAll(array('StatusCancel.patientid' => $id), false);
                $this->StatusHistory->deleteAll(array('StatusHistory.patientid' => $id), false);
                $this->StatusReschedule->deleteAll(array('StatusReschedule.patientid' => $id), false);
                $this->PatientTest->deleteAll(array('PatientTest.patientid' => $id), false);
            }
        }
        exit;
    }

    public function admin_phlebotomistunscheduled() {

        Configure::write("debug", 0);
        if (isset($_POST['postid'])) {

            $id = $_POST['postid'];
            $this->loadModel("PatientTest");
            $this->loadModel("StatusAccept");
            $this->loadModel("StatusDecline");

            if ($_POST['dateselect']) {
                $adminstatus = "Test Accepted";
                $body = "A new test has been accepted";
                $value = $this->PatientTest->find('first', array('conditions' => array('id' => $id)));
                $date = $_POST['dateselect'];
                $data = $this->PatientTest->updateAll(array('PatientTest.status' => "'2'", 'PatientTest.date' => "'$date'"), array('PatientTest.id' => $id));

                $this->request->data['StatusAccept']['patienttestid'] = $id;
                $this->request->data['StatusAccept']['patientid'] = $value['PatientTest']['patientid'];
                $this->request->data['StatusAccept']['userid'] = $value['PatientTest']['userid'];
                $this->request->data['StatusAccept']['testid'] = $value['PatientTest']['testid'];
                $this->request->data['StatusAccept']['status'] = '2';
                $this->request->data['StatusAccept']['date'] = $_POST['dateselect'];

                $this->StatusAccept->create();
                $this->StatusAccept->save($this->request->data);
                $this->pushnotification($adminstatus, $body, $token);
            } else {
                $reason = $_POST['reason'];
                $adminstatus = "Test Declined";
                $body = "A new test has been declined";
                $dat = date("Y-m-d h:i:s");
                $value = $this->PatientTest->find('first', array('conditions' => array('id' => $id)));

                $data = $this->PatientTest->updateAll(array('PatientTest.status' => "'0'", 'PatientTest.userreason' => "'$reason'", 'PatientTest.declinedate' => "'$dat'"), array('PatientTest.id' => $id));

                $this->request->data['StatusDecline']['patienttestid'] = $id;
                $this->request->data['StatusDecline']['patientid'] = $value['PatientTest']['patientid'];
                $this->request->data['StatusDecline']['userid'] = $value['PatientTest']['userid'];
                $this->request->data['StatusDecline']['testid'] = $value['PatientTest']['testid'];
                $this->request->data['StatusDecline']['status'] = '3';
                $this->request->data['StatusDecline']['reason'] = $_POST['reason'];

                $this->StatusDecline->create();
                $this->StatusDecline->save($this->request->data);
                $this->pushnotification($adminstatus, $body, $token);
            }
        }
        $this->loadModel("PatientTest");

        $patients_lists = $this->PatientTest->find('all', array('conditions' => array('status' => '1', 'userid' => $this->Auth->user('id')), 'recursive' => 2, 'contain' => array('Patient', 'User', 'Test')));

        $this->set(compact('patients_lists'));
    }

    public function admin_phlebotomistscheduled() {

        Configure::write("debug", 0);
        $this->loadModel("PatientTest");
        $this->loadModel("StatusReschedule");
        $this->loadModel("StatusCancel");
        if (isset($_POST['postid'])) {

            $id = $_POST['postid'];
            if ($_POST['dateselect']) {
                $status = '2';
                $reason = $_POST['reason'];
                $role = $_POST['role'];
                $date = $_POST['dateselect'];
                $value = $this->PatientTest->find('first', array('conditions' => array('id' => $id)));
                $tokenid = $this->User->find('first', array('conditions' => array('id' => $value['PatientTest']['doctorid'])));
                $token = $tokenid['User']['tokenid'];
                if ($role == "user") {
                    $adminstatus = "Test Reschdule by user";
                    $body = "A test has been reschduled by the user";
                    $data = $this->PatientTest->updateAll(array('PatientTest.status' => "'$status'", 'PatientTest.date' => "'$date'", 'PatientTest.userreason' => "'$reason'", 'PatientTest.reschduleddate' => "'$date'"), array('PatientTest.id' => $id));

                    $this->pushnotification($adminstatus, $body, $token);
                } else {
                    $adminstatus = "Test Reschdule by Patient";
                    $body = "A test has been reschduled by the patient";
                    $data = $this->PatientTest->updateAll(array('PatientTest.status' => "'$status'", 'PatientTest.date' => "'$date'", 'PatientTest.patientreason' => "'$reason'", 'PatientTest.reschduleddate' => "'$dat'"), array('PatientTest.id' => $id));

                    $this->pushnotification($adminstatus, $body, $token);
                }
                $this->request->data['StatusReschedule']['patienttestid'] = $id;
                $this->request->data['StatusReschedule']['patientid'] = $value['PatientTest']['patientid'];
                $this->request->data['StatusReschedule']['userid'] = $value['PatientTest']['userid'];
                $this->request->data['StatusReschedule']['testid'] = $value['PatientTest']['testid'];
                $this->request->data['StatusReschedule']['status'] = '5';
                $this->request->data['StatusReschedule']['admin_reason'] = $_POST['reason'];
                $this->request->data['StatusReschedule']['date'] = $date;
                $this->StatusReschedule->create();
                $this->StatusReschedule->save($this->request->data);
            } else {
                $reason = $_POST['reason'];
                $role = $_POST['role'];
                $dat = date("Y-m-d h:i:s");
                $value = $this->PatientTest->find('first', array('conditions' => array('id' => $id)));
                $tokenid = $this->User->find('first', array('conditions' => array('id' => $value['PatientTest']['doctorid'])));
                $token = $tokenid['User']['tokenid'];
                if ($role == "user") {
                    $adminstatus = "Test Cancelled by user";
                    $body = "A new test has been cancelled by the user";
                    $data = $this->PatientTest->updateAll(array('PatientTest.status' => "'0'", 'PatientTest.userreason' => "'$reason'", 'PatientTest.canceldate' => "'$dat'"), array('PatientTest.id' => $id));
                    $this->pushnotification($adminstatus, $body, $token);
                } else {
                    $adminstatus = "Test Cancelled by Patient";
                    $body = "A new test has been cancelled by the patient";
                    $data = $this->PatientTest->updateAll(array('PatientTest.status' => "'4'", 'PatientTest.patientreason' => "'$reason'", 'PatientTest.canceldate' => "'$dat'"), array('PatientTest.id' => $id));
                    $this->pushnotification($adminstatus, $body, $token);
                }

                $this->request->data['StatusCancel']['patienttestid'] = $id;
                $this->request->data['StatusCancel']['doctorid'] = $value['PatientTest']['doctorid'];
                $this->request->data['StatusCancel']['patientid'] = $value['PatientTest']['patientid'];
                $this->request->data['StatusCancel']['userid'] = $value['PatientTest']['userid'];
                $this->request->data['StatusCancel']['testid'] = $value['PatientTest']['testid'];
                $this->request->data['StatusCancel']['status'] = '4';
                $this->request->data['StatusCancel']['admin_reason'] = $reason;
                $this->request->data['StatusCancel']['date'] = date("Y-m-d h:i:s");

                $this->StatusCancel->create();
                $this->StatusCancel->save($this->request->data);
            }
        }
        $patients_lists = $this->PatientTest->find('all', array('conditions' => array('status' => '2', 'userid' => $this->Auth->user('id')), 'recursive' => 2, 'contain' => array('Patient', 'User', 'Test')));

        $this->set(compact('patients_lists'));
    }

    public function admin_phlebotomistcancels() {

        Configure::write("debug", 0);
        $this->loadModel("PatientTest");

        $patients_lists = $this->PatientTest->find('all', array('conditions' => array('status' => '4', 'userid' => $this->Auth->user('id')), 'recursive' => 2, 'contain' => array('Patient', 'User', 'Test')));

        $this->set(compact('patients_lists'));
    }

     public function admin_phlebotomistcancel() {

        Configure::write("debug", 0);
        $this->loadModel("PatientTest");
        $this->loadModel("StatusCancel");

        $patients_lists = $this->StatusCancel->find('all', array('conditions' => array('userid' => $this->Auth->user('id')), 'recursive' => 2));
        //echo "<pre>"; print_r($patients_lists); die;
        $this->set(compact('patients_lists'));
    }

    public function pushnotification($title, $body, $token) {
        
        Configure::write("debug", 0);

        $ch = curl_init("https://fcm.googleapis.com/fcm/send");

        $notification = array('title' => $title, 'body' => $body, 'vibrate' => true, 'sound' => 'default', 'content-available' => '1', 'priority' => 'high');

        $arrayToSend = array('to' => $token, 'notification' => $notification);
        $json = json_encode($arrayToSend);
        // print_r($json); 
        // die();
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key= AIzaSyCbdKNXKWOXMWVjrRemkdIwQndN8Vbget8';

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);

        curl_close($ch);
        return "ok";
    }

    public function admin_patientphlebotomistreport() {

        Configure::write("debug", 0);
        $id = $_POST['id'];
        $report = $_POST['report'];
        $flag = $_POST['flag'];
        $conclusion = $_POST['conclusion'];
        $reportdate = date("Y-m-d h:i:s");
        $this->loadModel("PatientTest");
        $this->loadModel("Patient");
        $this->loadModel("User");
        $this->loadModel("Test");
        $time = date("H:i:s");
        $day = date("Y-m-d");
        $data = $this->PatientTest->find("first", array("conditions" => array("PatientTest.id" => $id)));
        if($data['PatientTest']['reporttime'] != Null){
        	$reportadd = $this->PatientTest->updateAll(array('PatientTest.report' => "'$report'", 'PatientTest.conclusion' => "'$conclusion'", 'PatientTest.flag' => "'$flag'", 'PatientTest.reportdate' => "'$reportdate'"), array('PatientTest.id' => $id));
        }else{
        $reportadd = $this->PatientTest->updateAll(array('PatientTest.report' => "'$report'", 'PatientTest.conclusion' => "'$conclusion'", 'PatientTest.flag' => "'$flag'", 'PatientTest.reportdate' => "'$reportdate'",'PatientTest.reporttime' => "'$time'",'PatientTest.reportday' => "'$day'"), array('PatientTest.id' => $id));
    	}
        if ($reportadd) {

            $patienttestdata = $this->PatientTest->find("first", array("conditions" => array("PatientTest.id" => $id)));
            $patientid = $patienttestdata['PatientTest']['patientid'];
            $testid = $patienttestdata['PatientTest']['testid'];
            $userid = $patienttestdata['PatientTest']['userid'];
            $did = $patienttestdata['PatientTest']['doctorid'];
            $patientdata = $this->Patient->find("first", array("conditions" => array("Patient.id" => $patientid)));
            $userdata = $this->User->find("first", array("conditions" => array("User.id" => $userid)));
            $ddata = $this->User->find("first", array("conditions" => array("User.id" => $did)));
            $testdata = $this->Test->find("first", array("conditions" => array("Test.id" => $testid)));
            $testname = $testdata['Test']['test'];
            $testtext = $testdata['Test']['freetext'];
            // $dob = $patientdata['Patient']['dob'];
            //$time = strtotime($dob);
            //$newformat = date("Y-m-d",$time);
            $today = date("Y-m-d");
            // $diff = date_diff(date_create($newformat), date_create($today));

            $dob = $patientdata['Patient']['dob'];
            $dated = strtotime(date('Y-m-d', strtotime($dob)));
            $diff = round((time() - strtotime($dob)) / (3600 * 24 * 365.25));

            $pass = $id . $testname . $patientid;
            $pdate = date("Y-m-d", strtotime($patienttestdata['PatientTest']['date']));
            $ptime = date("h:i:s", strtotime($patienttestdata['PatientTest']['date']));
            $bccemail = $this->User->find("first", array("conditions" => array("User.role" => "admin")));
            
            $bcc = $bccemail['User']['email'];
            $ddoctormail = $ddata['User']['email'];
            $myhtml = '';
            $myhtml = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <title>Report</title>
                </head>

                <body style="font-family:times-new-roman; font-size:12px;">
                <table width="800" border="0" style="text-align:left; margin:0px auto;" cellpadding="0">
                  <tr style="width:100%;">
                    <td>

                    <h1 style="text-align:center; margin-bottom:0; width:100%; float:left;">True Laboratories LLC</h1>
                    <p style="text-align:center; width:100%; float:left; border-bottom:3px solid #000; margin-top:0px; padding-bottom:5px;">Oak Forest, IL. Tel No (708) 620-5790. Fax No (708) 620-5215</p>

                    <table width="100%" border="0" cellpadding="10" style="padding-bottom:10px; border-bottom:1px solid #000;">
                  <tr>
                    <td colspan="3" style="height:30px;"><Strong>Patient Name</strong>: ' . ucwords($patientdata['Patient']['firstname'] . ' ' . $patientdata['Patient']['lastname']) . '</td>
                  </tr>
                   <tr>
                        <td style="height:30px;"></td>
                    </tr>
                  <tr >
                    <td style="height:30px;"><strong>Gender</strong>: ' . ucfirst($patientdata['Patient']['sex']) . '</td>
                    <td style="height:30px;"><strong>MR#</strong>: ' .  $patientdata["Patient"]["trackingid"] . '</td>
                    <td style="height:30px;"><strong>Collection Date</strong>: ' . $day . '</td>
                  </tr>
                 
                  <tr>
                    <td style="height:30px;"><strong>DOB</strong>: ' . $patientdata['Patient']['dob'] . '</td>
                    <td style="height:30px;"><strong>Accession No.</strong>: ' . $id . '</td>
                    <td style="height:30px;"><strong>Collected Time</strong>: ' . $patienttestdata['PatientTest']['reporttime'] . '</td>
                  </tr>
                  <tr>
                    <td style="height:30px;"><strong>Age</strong>:' . $diff . '</td>
                    <td style="height:30px;"><strong>Doctor Name</strong>: ' . $ddata['User']['firstname'] . '</td>
                    <td style="height:30px;"><strong>Collected by</strong>: ' . $userdata['User']['firstname'][0] . $userdata['User']['lastname'][0] . $userdata['User']['lastname'][1] . $userdata['User']['lastname'][2] . '</td>
                  </tr>
                </table>

                <table width="100%" border="0" cellpadding="10" style="padding-bottom:10px; text-align:left; border-bottom:1px solid #000;">
                  <tr style="text-align:left;">
                    <th style="text-align:left;">Test Name</th>
                    <th style="text-align:left;">Result</th>
                    <th style="text-align:left;">Units</th> 
                    <th style="text-align:left;">Flag</th>
                    <th style="text-align:left;">Reference Range</th>
                    </tr>';

            if ($testname == "PT/INR") {
                $myArray = explode('/', $testname);
                $rep = explode('/', $report);
                $units = $testdata['Test']['units'];
                $unit = explode('/', $units);
                $referencerange = $testdata['Test']['referencerange'];
                $range = explode('/', $referencerange);
                $flags = explode('/', $flag);

                $myhtml.='<tr>
                          <td style="height:30px;">' . $myArray[0] . '</td>
                          <td style="height:30px;">' . $rep[0] . '</td>
                          <td style="height:30px;">' . $unit[0] . '</td>
                          <td style="height:30px;">' . $flags[0] . '</td>
                          <td style="height:30px;">' . $range[0] . '</td>
                        </tr>
                        <tr>
                          <td style="height:30px;">' . $myArray[1] . '</td>
                          <td style="height:30px;">' . $rep[1] . '</td>
                          <td style="height:30px;">' . $unit[1] . '</td>
                          <td style="height:30px;">' . $flags[1] . '</td>
                          <td style="height:30px;">' . $range[1] . '</td>
                        </tr>';
            } else {
                $myhtml.='<tr>
                          <td style="height:30px;">' . $testdata['Test']['test'] . '</td>
                          <td style="height:30px;">' . $report . '</td>
                          <td style="height:30px;">' . $testdata['Test']['units'] . '</td>
                          <td style="height:30px;">' . $flag . '</td>
                          <td style="height:30px;">' . $testdata['Test']['referencerange'] . '</td>
                        </tr>';
            }

            $myhtml.='</table>
                <p style="width:100%; float:left; padding-top: 10px;">
                ' . $testtext . '
                </p>
                <p style="width:100%; float:left; padding-top: 10px;font-style: italic;">
                ' . $conclusion . '
                </p> </body> </html>';


            $nomFacture = time() . ".pdf";
            $filename = $nomFacture;

            $path = '../webroot/MPDF57/pdf';
            $file = $path . "/" . $filename;

            include("../webroot/MPDF57/mpdf.php");
            $mpdf = new mPDF();
            $mpdf->SetProtection(array(), $pass, 'MyPassword');
            $mpdf->WriteHTML($myhtml);
            $mpdf->Output($file, 'F');
            $filesave = FULL_BASE_URL . "/truelab/MPDF57/pdf/" . $filename;
            $this->PatientTest->updateAll(array('PatientTest.reportpdf' => "'$filesave'"), array('PatientTest.id' => $id));
            $emailz = $userdata['User']['email'];
            $subject = 'Patient Report';
            $message = 'The Password to view this report is  ' . $pass . '  .';

            $Email = new CakeEmail();
            $Email->config('default');
            $Email->template('default');
            $Email->emailFormat('html');
            $Email->from(array('noreply@truelabllc.com' => 'QualityLabOne'));
            $Email->to('notification@truelabllc.com');
            $Email->attachments($file);
            $Email->subject('Patient Report');
            $Email->send($message);

            $Email = new CakeEmail();
            $Email->config('default');
            $Email->template('default');
            $Email->emailFormat('html');
            $Email->from(array('noreply@truelabllc.com' => 'QualityLabOne'));
            $Email->to($ddoctormail);
            $Email->attachments($file);
            $Email->subject('Patient Report');
            $Email->send($message);

            

            $response['msg'] = 'Report added Successfuly';
            $response['error'] = 0;
        } else {
            $response['msg'] = 'No Data Available';
            $response['error'] = 1;
        }

        echo json_encode($response);

        exit;
    }

    public function admin_phlebotomistpatientsignature($id = NULL) {

        Configure::write("debug", 0);

        $this->loadModel('PatientTest');
        $this->loadModel('Patient');
        $this->loadModel('Test');
        $this->loadModel('User');
        $this->loadModel('Agency');
        if ($_POST) {

            $imgname = "";
            if ($_POST['clientsignature'] != "") {
                $one = $_POST['clientsignature'];
                $img = $one;
                $img = str_replace('data:image/png;base64,', '', $img);
                $img = str_replace(' ', '+', $img);
                $data = base64_decode($img);
                $imgname = "1" . time() . ".png";
                $file = WWW_ROOT . "files" . DS . "profile_pic" . DS . $imgname;
                $imgsuccess = file_put_contents($file, $data);
            } else {
                $image = $_FILES['signature'];

                $uploadFolder = "profile_pic";
                $uploadPath = WWW_ROOT . '/files/' . $uploadFolder;
                if ($image['error'] == 0) {
                    $imgname = $image['name'];
                    if (file_exists($uploadPath . DS . $imgname)) {
                        $imgname = date('His') . $imgname;
                    }
                    $full_image_path = $uploadPath . DS . $imgname;

                    move_uploaded_file($image['tmp_name'], $full_image_path);
                }
            }

            $ima = FULL_BASE_URL . $this->webroot . 'files/profile_pic/' . $imgname;
            $data = $this->PatientTest->updateAll(array('PatientTest.patientsignature' => "'$ima'"), array('PatientTest.id' => $id));

            require_once("../webroot/MPDF57/mpdf.php");
            $mpdf = new mPDF();

            $patienttestdata = $this->PatientTest->find("first", array("conditions" => array("PatientTest.id" => $id)));
            //echo '<pre>'; print_r($patienttestdata); echo '</pre>';
            $patientid = $patienttestdata['PatientTest']['patientid'];
            $doctorid = $patienttestdata['PatientTest']['doctorid'];
            $testid = $patienttestdata['PatientTest']['testid'];
            $clientsignature = $patienttestdata['PatientTest']['clientsignature'];
            $patientdata = $this->Patient->find("first", array("conditions" => array("Patient.id" => $patientid)));
            //print_r($patientdata);
            //$dob = $patientdata['Patient']['dob'];
            $dob = $patientdata['Patient']['dob'];
            $dated = strtotime(date('Y-m-d', strtotime($dob)));
            $today = date("Y-m-d");
            $diff = round((time() - strtotime($dob)) / (3600 * 24 * 365.25));

            $doctordata = $this->User->find("first", array("conditions" => array("User.id" => $doctorid)));
            //echo '<pre>'; print_r($doctordata); echo '</pre>'; die;
            $agencyname = $doctordata['User']['agencyname'];
            $currentdate = date('Y-m-d');
            if ($agencyname != NULL) {
                $agencies = $this->Agency->find("first", array("conditions" => array("Agency.agencyname" => $agencyname)));
            }
            $testdata = $this->Test->find("all");
            $agencyname = $doctordata['User']['agencyname'];
            $myhtml = '';
            $myhtml.='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <title>Report</title>

                </head>

                <body style="width:100%; text-align:center;">

                <table width="600px" border="0" style="margin:0px auto; font-family:Arial, Helvetica, sans-serif; font-size:12px; table-layout:fixed;">
                  <tr>
                    <td style="text-align:center;">
                        <h1 style="margin:0;">True Laboratories LLC</h1>
                    </td>
                  </tr>
                   <tr>
                    <td style="text-align:center;">
                        <p style="margin-top:0; font-size:14px;"><b>Oak Forest, IL. 60452. Tel No (708) 620-5790. Fax No (708) 620-5215</b></p><br />
                    </td>
                  </tr>
                  <tr>
                    <td style="table-layout:fixed; display:table; border:none; padding:0;">
                        <table style="table-layout:fixed; display:table;" width="600px" border="0" cellpadding="10" cellspacing="0">
                  </tr>
                  <tr>
                    <td style="border:1px solid #bababa; border-right:none;">PATIENT LAST NAME :</td>
                    <td style="border:1px solid #bababa; border-right:none;">' . $patientdata["Patient"]["lastname"] . '</td>
                    <td style="border:1px solid #bababa; border-right:none;">REQUEST DATE :</td>
                    <td style="border:1px solid #bababa;">' . $currentdate . '</td>
                  </tr>
                  <tr>

                  <tr style="background:#f9f9f9;">
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">PATIENT FIRSTNAME :</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">' . $patientdata["Patient"]["firstname"] . '</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">CLINIC/AGENCY NAME :</td>';
            if ($agencyname != NULL) {
                $myhtml.='<td style="border:1px solid #bababa; border-top:none;">' . $agencyname . '</td>';
            } else {
                $myhtml.='<td style="border:1px solid #bababa; border-top:none;">' . $patientdata["Patient"]["doctorname"] . '</td>';
            }
            $myhtml.='</tr>
                  <tr style="background:#fff;">
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">DATE OF BIRTH :</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">' . $patientdata["Patient"]["dob"] . '</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">OFFICE NUMBER :</td>';
                    if ($agencyname != NULL) {

                        $myhtml.='<td style="border:1px solid #bababa; border-top:none;">' . $doctordata['User']['agencyphonenumber'] . '</td>';
                    } else {
                        $myhtml.='<td style="border:1px solid #bababa; border-top:none;">' . $doctordata['User']['phonenumber'] . '</td>';
                    }
                    $myhtml.='</tr>

                  <tr style="background:#f9f9f9;">
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">AGE :</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">' . $diff . '</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">FAX NUMBER :</td>
                    ';
            if ($agencyname != NULL) {
                $myhtml.='<td style="border:1px solid #bababa; border-top:none;">' . $doctordata["User"]["agencyfax"] . '</td>';
            } else {
                $myhtml.='<td style="border:1px solid #bababa; border-top:none;">' . $doctordata["User"]["fax"] . '</td>';
            }

            $myhtml.='</tr>

                  <tr style="background:#fff;">
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">GENDER :</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">' . ucfirst($patientdata["Patient"]["sex"]) . '</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">ADDRESS :</td>
                    <td style="border:1px solid #bababa; border-top:none;">' . $doctordata['User']['address'] . ',' . $doctordata["User"]["address2"] . '</td>
                  </tr>

                  <tr style="background:#f9f9f9;">
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">PHONE NUMBER :</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">' . $patientdata["Patient"]["phonenumber"] . '</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">CITY, STATE, ZIP CODE :</td>
                    <td style="border:1px solid #bababa; border-top:none;">' . $doctordata["User"]["city"] . ',' . $doctordata["User"]['state'] . ',' . $doctordata['User']["zipcode"] . '</td>
                  </tr>

                  <tr style="background:#fff;">
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">ADDRESS :</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">' . $patientdata["Patient"]["address"] . '</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">DOCTOR NAME :</td>
                    <td style="border:1px solid #bababa; border-top:none;">' . $doctordata["User"]["firstname"] . '</td>
                  </tr>

                  <tr style="background:#f9f9f9;">
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">ADDRESS2 :</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">' . $patientdata["Patient"]["address2"] . '</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">DOCTOR NPI NO. :</td>
                    <td style="border:1px solid #bababa; border-top:none;">' . $doctordata["User"]["npi"] . '</td>
                  </tr>

                  <tr style="background:#fff;">
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">CITY, STATE, ZIP CODE :</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">' . $patientdata["Patient"]["city"] . ',' . $patientdata["Patient"]["state"] . ',' . $patientdata["Patient"]["zipcode"] . '</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">DOCTOR/REPRESENTATIVE SIGNATURE :</td>
                    <td style="border:1px solid #bababa; border-top:none;"><img width="150px" src=' . $clientsignature . '></td>
                  </tr>

                  <tr style="background:#f9f9f9;">
                    <td colspan="2" style="border:1px solid #bababa; border-right:none; border-top:none;">DIAGNOSIS (ICD 10) :</td>
                    <td colspan="2" style="border:1px solid #bababa; border-top:none;">' . $patienttestdata["PatientTest"]["testdiagnosis"] . '</td>
                  </tr>

                  <tr style="background:#fff;">
                    <td colspan="2" style="border:1px solid #bababa; border-right:none; border-top:none;">SPECIAL INSTRUCTION :</td>
                    <td colspan="2" style="border:1px solid #bababa;  border-top:none;">' . $patientdata["Patient"]["diagnosis"] . '</td>
                  </tr>

                  <tr>
                        <td colspan="4"><form id="form1" name="form1" method="post" action="">
                          <p>';
            $checked = "";
            foreach ($testdata as $tests) {
                if ($testid == $tests['Test']['id']) {

                    $myhtml.='<label>
                              <input type="checkbox" name="CheckboxGroup1" value="checkbox" checked="checked" id="CheckboxGroup1_0" />';
                } else {
                    $myhtml.='<label>
                              <input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_0" />';
                }

                $myhtml.='<b style="font-size:12px">' . $tests["Test"]["test"] . '</b></label> <br/>';
            }
            $myhtml.='</p>
                          </form></td>
                  </tr>
                  <tr>

                    <td style="border:1px solid #bababa; border-bottom:none;" colspan="4"><p>I AUTHORIZE THE RELEASE OF MY INSURANCE CARRIER OF ANY MEDICAL INFORMATION NECESSARY TO PROCESS THIS CLAIM AND I AUTHORIZE PAYMENT OF MEDICAL BENEFITS DIRECTLY TO TRUE LABORATORIES LLC.</p></td>
                  </tr>
                  <tr>
                        <td colspan="2" style="border:1px solid #bababa; border-right:none;">
                        PATIENTâ€™S SIGNATURE
                    </td>
                    <td style="border:1px solid #bababa;" colspan="2">
                       <img width="150px" src=' . $ima . '>
                            
                    </td>
                  </tr>

                </table>

                    </td>
                  </tr>
                </table>

                </body>
                </html>';


            $nomFacture = time() . ".pdf";
            $filename = $nomFacture;

            $path = '../webroot/MPDF57/pdf';
            $file = $path . "/" . $filename;

            $mpdf->WriteHTML($myhtml);
            $mpdf->Output($file, 'F');
            $filesave = FULL_BASE_URL . "/truelab/MPDF57/pdf/" . $filename;
            $this->PatientTest->updateAll(array('PatientTest.paidreport' => "'$filesave'"), array('PatientTest.id' => $id));
            return $this->redirect(array('action' => 'phlebotomistscheduled'));
        }
    }

}

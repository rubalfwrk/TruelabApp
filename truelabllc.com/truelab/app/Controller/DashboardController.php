<?php
App::uses('AppController', 'Controller');

class DashboardController extends AppController {

       public function beforeFilter() {

        parent::beforeFilter('admin_phlebotomistdashindex');

       

    }



    public function admin_dashboard() {


    }

    public function admin_dashboardview($id=NULL) {

        Configure::write("debug", 2);

        $this->loadModel('Dashboard');

        $data=$this->Dashboard->find('all',array('conditions'=>array('Dashboard.id'=>$id)),array('limit'=>30, 'order' => array(

                'Dashboard.id' => 'desc'

            )));

        $this->set('data',$data);

    }



    public function admin_index($id=NULL) { 

        Configure::write("debug",2);
      

        $this->loadModel('User');

        $this->loadModel('PatientTest');

        $this->loadModel('Patient');

        $this->loadModel('StatusCancel');

        $this->loadModel('Test');

        $recentupdates = array();

        $clientusers = $this->User->find('all', array('conditions' => array('AND' => array('User.role'=>'client', 'User.agencyname IS NULL'))));

		$agencycount = $this->User->find('all', array('conditions' => array('AND' => array('User.role'=>'client', 'User.agencyname !=' => ''))));
		
        $user = $this->User->find('all', array('conditions' => array('User.role' => 'user')));

        //$totaltest = $this->Test->find('all');

        $totaltest = $this->PatientTest->find('all', array('conditions' => array('MONTH(PatientTest.created)' => date('n'))

));

        $totaltestyearely = $this->PatientTest->find('all', array('conditions' => array('YEAR(PatientTest.created)' => date('Y'))

));

        $recents = $this->PatientTest->find("all", array("conditions" => array("PatientTest.status" => 0)));

        

        foreach($recents as $recent){

            $patients = $this->Patient->find("first", array("conditions" => array("Patient.id" => $recent['PatientTest']['patientid'])));
			if(!empty($patients)){
				$patientname = $patients['Patient']['firstname'] . ' ' . $patients['Patient']['lastname'];;
			}else{
				$patientname = '';
			}
            $doctor = $this->User->find("first", array("conditions" => array("User.id" => $recent['PatientTest']['doctorid'])));
			if(!empty($doctor)){
				$doctorname = $doctor['User']['firstname'];
				$agencyname = $doctor['User']['agencyname'];
			}else{
				$doctorname = '';
				$agencyname = '';
			}

            if($recent['PatientTest']['status'] == 0){

                $status = 'Unschedule';

            }

            $recentupdates[]['Recent'] = array(

                'id' => $recent['PatientTest']['id'],

                'patientname' => $patientname,

                'patientid' => $recent['PatientTest']['patientid'],

                'doctorid' => $recent['PatientTest']['doctorid'],

                'doctorname' => $doctorname,
				
				'agencyname' => $agencyname,

                'status' => $status

            );

        }

        $countdecline_test = $this->PatientTest->find("count", array('conditions'=> array('PatientTest.status' => 3)));

        $countaccept_test = $this->PatientTest->find("count", array('conditions'=> array('PatientTest.status' => 2)));

        $countsch_test = $this->PatientTest->find("count", array('conditions'=> array('PatientTest.status' => 1)));

        $countcancel_test = $this->StatusCancel->find("count", array('conditions'=> array('StatusCancel.status' => 4)));

        $this->set('count_schedule', $countsch_test);

        $this->set('count_decline', $countdecline_test);

        $this->set('count_accept', $countaccept_test);

        $this->set('count_cancel', $countcancel_test);

           $totalpatients = $this->Patient->find('all', array('conditions' => array('MONTH(Patient.created)' => date('n'))

));

        $totalpatientsyearly = $this->Patient->find('all', array('conditions' => array('YEAR(Patient.created)' => date('Y'))));

        $this->set(array('client' => $clientusers,'user'=>$user, 'recents' => $recentupdates, 'totaltest' => $totaltest, 'totalpatients' => $totalpatients, 'totalpatientsyearly' => $totalpatientsyearly, 'totaltestyearely' => $totaltestyearely, 'agencycount' => $agencycount));

       

    }

    public function admin_clientdashindex(){

        Configure::write("debug", 0);

        $this->loadModel("Patient");

        $this->loadModel("PatientTest");

        $this->loadModel("StatusCancel");

        $this->loadModel("User");

        $recentupdates = array();

        $currentlogin = $this->Auth->User("id");

        $recents = $this->PatientTest->find("all", array("conditions" => array("AND" => array("PatientTest.doctorid" => $this->Auth->User("id"), "PatientTest.status" => 0))));

        

        foreach($recents as $recent){

            $patients = $this->Patient->find("first", array("conditions" => array("Patient.id" => $recent['PatientTest']['patientid'])));
			if(!empty($patients)){
				$patientname = $patients['Patient']['firstname'] . ' ' . $patients['Patient']['lastname'];
			}else{
				$patientname = '';
			}
            $doctor = $this->User->find("first", array("conditions" => array("User.id" => $recent['PatientTest']['doctorid'])));
			if(!empty($doctor)){
				$doctorname = $doctor['User']['firstname'];
				$agencyname = $doctor['User']['agencyname'];
			}else{
				$doctorname = '';
				$agencyname = '';
			}
			
            if($recent['PatientTest']['status'] == 0){

                $status = 'Unschedule';

            }
			
            $recentupdates[]['Recent'] = array(

                'id' => $recent['PatientTest']['id'],

                'patientname' => $patientname,

                'patientid' => $recent['PatientTest']['patientid'],

                'doctorid' => $recent['PatientTest']['doctorid'],

                'doctorname' => $doctorname,
				
				'agencyname' => $agencyname,

                'status' => $status

            );

        }

        $this->set('recents', $recentupdates);
        

        $countdecline_test = $this->PatientTest->find("count", array('conditions'=> array('AND' => array('PatientTest.doctorid' => $this->Auth->User("id"), 'PatientTest.status' => 3))));

        $countaccept_test = $this->PatientTest->find("count", array('conditions'=> array('AND' => array('PatientTest.doctorid' => $this->Auth->User("id"), 'PatientTest.status' => 2))));

        $countsch_test = $this->PatientTest->find("count", array('conditions'=> array('AND' => array('PatientTest.doctorid' => $this->Auth->User("id"), 'PatientTest.status' => 1))));

        $countcancel_test = $this->StatusCancel->find("count", array('conditions'=> array('AND' => array('StatusCancel.doctorid' => $this->Auth->User("id"), 'StatusCancel.status' => 4))));

        $this->set('count_schedule', $countsch_test);

        $this->set('count_decline', $countdecline_test);

        $this->set('count_accept', $countaccept_test);

        $this->set('count_cancel', $countcancel_test);

    }

    public function admin_phlebotomistdashindex(){

        Configure::write("debug", 2);

        $this->loadModel("Patient");

        $this->loadModel("PatientTest");

        $this->loadModel("StatusCancel");

        $this->loadModel("User");


        $recentupdates = array();

        $currentlogin = $this->Auth->User("id");

        $recents = $this->PatientTest->find("all", array("conditions" => array("AND" => array("PatientTest.userid" => $this->Auth->User("id"), "PatientTest.status" => 0))));
 
        // print_r($recents); die;
        foreach($recents as $recent){

            $patients = $this->Patient->find("first", array("conditions" => array("Patient.id" => $recent['PatientTest']['patientid'])));
            if(!empty($patients)){
                $patientname = $patients['Patient']['firstname'] . ' ' . $patients['Patient']['lastname'];
            }else{
                $patientname = '';
            }
            $doctor = $this->User->find("first", array("conditions" => array("User.id" => $recent['PatientTest']['doctorid'])));

            if(!empty($doctor)){
                $doctorname = $doctor['User']['firstname'];
                $agencyname = $doctor['User']['agencyname'];
            }else{
                $doctorname = '';
                $agencyname = '';
            }
            
            if($recent['PatientTest']['status'] == 0){

                $status = 'Unschedule';

            }
            
            $recentupdates[]['Recent'] = array(

                'id' => $recent['PatientTest']['id'],

                'patientname' => $patientname,

                'patientid' => $recent['PatientTest']['patientid'],

                'doctorid' => $recent['PatientTest']['doctorid'],

                'doctorname' => $doctorname,
                
                'agencyname' => $agencyname,

                'status' => $status

            );

        }

        $this->set('recents', $recentupdates);
        

        $countdecline_test = $this->PatientTest->find("count", array('conditions'=> array('AND' => array('PatientTest.userid' => $this->Auth->User("id"), 'PatientTest.status' => 3))));

        $countaccept_test = $this->PatientTest->find("count", array('conditions'=> array('AND' => array('PatientTest.userid' => $this->Auth->User("id"), 'PatientTest.status' => 2))));

        $countsch_test = $this->PatientTest->find("count", array('conditions'=> array('AND' => array('PatientTest.userid' => $this->Auth->User("id"), 'PatientTest.status' => 1))));

        $countcancel_test = $this->StatusCancel->find("count", array('conditions'=> array('AND' => array('StatusCancel.userid' => $this->Auth->User("id"), 'StatusCancel.status' => 4))));

        $this->set('count_schedule', $countsch_test);

        $this->set('count_decline', $countdecline_test);

        $this->set('count_accept', $countaccept_test);

        $this->set('count_cancel', $countcancel_test);   

    }

}
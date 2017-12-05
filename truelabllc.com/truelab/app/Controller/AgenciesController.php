<?php
App::uses('AppController', 'Controller');

App::uses('CakeEmail', 'Network/Email');

class AgenciesController extends AppController {

    public function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow();
		$this->Auth->allow('admin_add','admin_addagencymember');
	}
	
	public function admin_index(){
		Configure::write("debug", 0);
		
		$this->loadModel("User");
		if($this->Auth->User('role') == 'admin'){
			$agencies = $this->Agency->find("all"); 
		}else{
			//echo $this->Auth->user('agencyname');
			$agencies = $this->Agency->find("all", array("conditions" => array("Agency.agencyname" => $this->Auth->user('agencyname'))));
		}
		$this->set("agencies", $agencies);
	}

	public function admin_add(){
 		Configure::write("debug", 0);
		
        if($this->request->is("post")){ 
			if ($this->Agency->hasAny(array('Agency.agencyname' => strtolower($this->request->data['Agency']['agencyname'])))) {
					$this->Session->setFlash(__('Agency already exist in Database!!!'));
				   return $this->redirect(array('action' => 'add'));
	
			}else if ($this->Agency->hasAny(array('Agency.agencyemail' => strtolower($this->request->data['Agency']['agencyemail'])))) {
				$this->Session->setFlash(__('Agency Email already exist in Database!!!'));
				return $this->redirect(array('action' => 'add'));
			
			}else{


			$this->request->data['Agency']['agencyname'] = strtolower($this->request->data['Agency']['agencyname']);
			$this->request->data['Agency']['simpass'] = $this->request->data['Agency']['password'];
			//echo '<pre>'; print_r($this->request->data); echo '</pre>'; die;
        	$this->Agency->create();

            if($this->Agency->save($this->request->data)){
				//echo 'Record Add';
				$this->loadModel('User');
				$this->request->data['User']['agencyid'] = $this->Agency->getLastInsertId();
				$this->request->data['User']['role'] = 'client';
				$this->request->data['User']['agencyname'] = $this->request->data['Agency']['agencyname'];
				$this->request->data['User']['email'] = $this->request->data['Agency']['agencyemail'];
				$this->request->data['User']['username'] = $this->request->data['Agency']['agencyemail'];
				$this->request->data['User']['password'] = $this->request->data['Agency']['password'];
				$this->request->data['User']['agencyphonenumber'] = $this->request->data['Agency']['agencyphonenumber'];
				$this->request->data['User']['agencyfax'] = $this->request->data['Agency']['agencyfax'];
				$this->request->data['User']['address'] = $this->request->data['Agency']['address'];
				$this->request->data['User']['address2'] = $this->request->data['Agency']['address2'];
				$this->request->data['User']['city'] = $this->request->data['Agency']['city'];
				$this->request->data['User']['state'] = $this->request->data['Agency']['state'];
				$this->request->data['User']['zipcode'] = $this->request->data['Agency']['zipcode'];
				$this->User->save($this->request->data);
				$firstname = $this->request->data['User']['agencyname']; 
				$ms = '<body><table width="500" border="0" cellpadding="10" cellspacing="0" style="margin: 0px auto; background: #f0f0f0; text-align: center"><tr style="background: #f0f0f0"><td colspan="2" style="text-align: center; padding-top: 20px; padding-bottom: 20px"><img alt="img" style="height: 97px;" src="' . FULL_BASE_URL . $this->webroot .'home/logo.png"/></td></tr><tr><b>New Agency registration</b></tr><tr>Agency Name : '.$firstname.'</tr></table></body>';
					$Email = new CakeEmail();
                    $Email->config('default');
                    $Email->template('default');
                    $Email->emailFormat('html');
                    $Email->from(array('noreply@truelabllc.com' => 'Truelabllc'));
                    $Email->to('notification@truelabllc.com');
                    $Email->subject('New Agency registration');
                    $Email->send($ms);

            	return $this->redirect(array('action' => 'index'));
            }
        }

        }
	}	
	
	public function admin_edit($id = null){
		Configure::write("debug", 0);
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data['Agency']['id'] = $id;
			if ($this->Agency->save($this->request->data)) {
			
			/****************************************/
			$this->loadModel("User");
			$agencyname = $this->request->data['Agency']['agencyname'];
			$agencyphonenumber = $this->request->data['Agency']['agencyphonenumber'];
			$agencyfax = $this->request->data['Agency']['agencyfax'];
			$agencyemail = $this->request->data['Agency']['agencyemail'];
			$agencyaddress = $this->request->data['Agency']['address'];
			$agencyaddress2 = $this->request->data['Agency']['address2'];
			$agencycity = $this->request->data['Agency']['city'];
			$agencystate = $this->request->data['Agency']['state'];
			$agencyzipcode = $this->request->data['Agency']['zipcode'];
			//echo '<pre>'; print_r($this->request->data); echo '</pre>'; die;
			$this->User->updateAll(array('User.agencyname' => "'$agencyname'", 'User.agencyphonenumber' => "'$agencyphonenumber'", 'User.agencyfax' => "'$agencyfax'", 'User.username' => "'$agencyemail'", 'User.email' => "'$agencyemail'", 'User.address' => "'$agencyaddress'", 'User.address2' => "'$agencyaddress2'", 'User.city' => "'$agencycity'", 'User.state' => "'$agencystate'"),array('User.agencyid' => $id));
			/*******************************************/
            	$this->Session->setFlash('The Agency has been saved');
                return $this->redirect(array('action' => 'index'));
            }else {
				$this->Session->setFlash('The Agency could not be saved. Please, try again.');
            }
		}else{
			$this->request->data = $this->Agency->read(null, $id);
		}
	}
	
	public function admin_view($id = null){
		Configure::write("debug", 0);

        $this->set('agency', $this->Agency->read(null, $id));

	}
	
	    public function admin_delete($id = null) {

		Configure::write("debug", 0);

        $deleteAgency = $this->Agency->deleteAll(array('Agency.id' => $id));

        if ($deleteAgency) {
			$this->loadModel("User");
			$this->User->deleteAll(array('User.agencyid' => $id));
			
            $this->Session->setFlash('Agency deleted');

            return $this->redirect(array('action' => 'index'));
        }

        $this->Session->setFlash('Agency was not deleted');

        return $this->redirect(array('action' => 'index'));

    }


	public function admin_agencypassword($id = null) {
		Configure::write("debug", 0);
      $this->Agency->id = $id;

        if ($this->request->is('post') || $this->request->is('put')) {

            if ($this->Agency->save($this->request->data)) {
					$this->loadModel("User");
					$pass = $this->request->data['Agency']['password'];
					$this->User->updateAll(array('User.password' => "'$pass'"),array('User.agencyid' => $id));
                	$this->Session->setFlash('The Agency has been saved');

                	$this->redirect(array('action' => 'index'));

            } else {
                $this->Session->setFlash('The user could not be saved. Please, try again.');
            }

        } else {
            $this->request->data = $this->Agency->read(null, $id);

        }

    }
	
	public function admin_addagencymember($id = null){
		Configure::write("debug", 0);
		$this->loadModel("User");
		//echo $this->Auth->user('role');
		$agencyinfo = $this->Agency->find("first", array("conditions" => array("Agency.id" => $id)));
		$userinfo = $this->User->find("first", array("conditions" => array("User.agencyid" => $id)));
		if ($this->request->is('post') || $this->request->is('put')) { 
		//echo '<pre>'; print_r($this->request->data); echo '</pre>'; 
			if(($userinfo['User']['agencyid'] == $id) && ($userinfo['User']['firstname'] == NULL)){

				$role = 'client';
				$agencyid = $this->request->data['agencyid'];
				$agencyname = $this->request->data['agencyname'];
				$email = $this->request->data['email'];
				$username = $this->request->data['email'];
				$password = $this->request->data['password'];
				$agencyphonenumber = $this->request->data['agencyphonenumber'];
				$agencyfax = $this->request->data['agencyfax'];
				$firstname = $this->request->data['firstname'];
				$fax = $this->request->data['fax'];
				$npi = $this->request->data['npi'];
				$phonenumber = $this->request->data['phonenumber'];
				$address = $this->request->data['address'];
				$address2 = $this->request->data['address2'];
				$city = $this->request->data['city'];
				$state = $this->request->data['state'];
				$zipcode = $this->request->data['zipcode'];
				//echo '<pre>'; print_r($this->request->data); echo '</pre>'; 
				//die;
				$this->User->updateAll(array('User.role' => "'$role'", 'User.firstname' => "'$firstname'", 'User.fax' => "'$fax'", 'User.npi' => "'$npi'", 'User.phonenumber' => "'$phonenumber'")		,array('User.agencyid' => $agencyid));

				$ms = '<body><table width="500" border="0" cellpadding="10" cellspacing="0" style="margin: 0px auto; background: #f0f0f0; text-align: center"><tr style="background: #f0f0f0"><td colspan="2" style="text-align: center; padding-top: 20px; padding-bottom: 20px"><img alt="img" style="height: 97px;" src="' . FULL_BASE_URL . $this->webroot .'home/logo.png"/></td></tr><tr><b>New Doctor registration</b></tr><tr>Agency Name : '.$firstname.'</tr></table></body>';
					$Email = new CakeEmail();
                    $Email->config('default');
                    $Email->template('default');
                    $Email->emailFormat('html');
                    $Email->from(array('noreply@truelabllc.com' => 'Truelabllc'));
                    $Email->to('notification@truelabllc.com');
                    $Email->subject('New Doctor registration');
                    $Email->send($ms);

				return $this->redirect(array('controller' => 'users', 'action' => 'indexagency'));
			}else{
				
				$this->request->data['User']['role'] = 'client';
				$this->request->data['User']['agencyid'] = $this->request->data['agencyid'];
				$this->request->data['User']['agencyname'] = $this->request->data['agencyname'];
				$this->request->data['User']['email'] = $this->request->data['email'];
				$this->request->data['User']['username'] = $this->request->data['email'];
				$this->request->data['User']['password'] = $this->request->data['simpass'];
				$this->request->data['User']['agencyphonenumber'] = $this->request->data['agencyphonenumber'];
				$this->request->data['User']['agencyfax'] = $this->request->data['agencyfax'];
				$this->request->data['User']['firstname'] = $this->request->data['firstname'];
				$this->request->data['User']['fax'] = $this->request->data['fax'];
				$this->request->data['User']['npi'] = $this->request->data['npi'];
				$this->request->data['User']['phonenumber'] = $this->request->data['phonenumber'];
				$this->request->data['User']['address'] = $this->request->data['address'];
				$this->request->data['User']['address2'] = $this->request->data['address2'];
				$this->request->data['User']['city'] = $this->request->data['city'];
				$this->request->data['User']['state'] = $this->request->data['state'];
				$this->request->data['User']['zipcode'] = $this->request->data['zipcode'];
				
				$this->User->create();
				if($this->User->save($this->request->data)){
					$doctorname = $this->request->data['User']['agencyname'];

					$ms = '<body><table width="500" border="0" cellpadding="10" cellspacing="0" style="margin: 0px auto; background: #f0f0f0; text-align: center"><tr style="background: #f0f0f0"><td colspan="2" style="text-align: center; padding-top: 20px; padding-bottom: 20px"><img alt="img" style="height: 97px;" src="' . FULL_BASE_URL . $this->webroot .'home/logo.png"/></td></tr><tr><b>New Doctor registration</b></tr><tr>Agency Name : '.$doctorname.'</tr></table></body>';
					$Email = new CakeEmail();
                    $Email->config('default');
                    $Email->template('default');
                    $Email->emailFormat('html');
                    $Email->from(array('noreply@truelabllc.com' => 'Truelabllc'));
                    $Email->to('notification@truelabllc.com');
                    $Email->subject('New Doctor registration');
                    $Email->send($ms);

					if($this->Auth->user('role') != 'admin'){
						return $this->redirect(array('controller' => 'users', 'action' => 'index'));
					}else{
						return $this->redirect(array('controller' => 'users', 'action' => 'indexagency'));
					}
				}	
			}
		}

		$this->set("agencyinfo", $agencyinfo);
	}

	public function admin_activateuser($id = null){

		Configure::write("debug", 0);
		$this->loadModel("User");
		$useractivate = $this->User->updateAll(array("User.active" => 1), array("User.agencyid" => $id));
		$agencyactivate = $this->Agency->updateAll(array("Agency.active" => 1), array("Agency.id" => $id));
		if($useractivate){
			if ($this->Auth->user('role') == 'admin') {
				$this->Session->setFlash(__('Agency Activate Successfully!!!'));
				return $this->redirect(array('action' => 'index'));
			}else{
				$this->Session->setFlash(__('Agency Activate Successfully!!!'));
				return $this->redirect(array('action' => 'index'));
			}
		}
	}

	public function admin_deactivateuser($id = null){
		Configure::write("debug", 0);
		$this->loadModel("User");
		$useractivate = $this->User->updateAll(array("User.active" => 0), array("User.agencyid" => $id));
		$agencyactivate = $this->Agency->updateAll(array("Agency.active" => 0), array("Agency.id" => $id));
		if($useractivate){
			if ($this->Auth->user('role') == 'admin') {
				$this->Session->setFlash(__('Agency is Deactivate Successfully!!!'));
				return $this->redirect(array('action' => 'index'));
			}else{
				$this->Session->setFlash(__('Agency Deactivate Successfully!!!'));
				return $this->redirect(array('action' => 'index'));
			}
		}
	}

	 	
}


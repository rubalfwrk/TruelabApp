<?php

App::uses('AppController', 'Controller');

App::uses('CakeEmail', 'Network/Email');

class UsersController extends AppController {

  
//////////////////////////////////////////////////////////

public $components = array(

        'Session',

        'Auth',

        'RequestHandler',

    );

// Simple setup

//$this->Auth->config('authenticate', ['Form']);

    public function beforeFilter() {

        parent::beforeFilter();

        $this->Auth->allow('login','api_deletepatient', 'admin_add', 'api_login', 'api_registration', 'admin', 'admin_login','admin_resetbyadmin','api_contact', 'api_forgetpwd', 'api_trackorder', 'api_addresslist', 'api_resetpwd', 'api_fblogin', 'walletipn', 'api_wallet', 'api_loginwork', 'api_ccresponse', 'api_ccresponsepickup', 'api_ccresponsewallet', 'ccresponse','emailverify','webverifyemail','api_verifyEmail','strposa','api_test','api_editprofile','api_userinfo','api_clientpatientlist','api_clientacceptpatientlist','api_patienttestlist');

    }



////////////////////////////////////////////////////////////


    private function strposa($haystack, $needle, $offset = 0) {



        if (!is_array($needle))



        $needle = array($needle);



        foreach ($needle as $query) {



            if (strpos($haystack, $query, $offset) !== false)



                return true; // stop on first true result



        }



        return false;



    }


    public function admin_login(){

    Configure::write("debug", 0);

        $this->layout = "admin2";
        
        if ($this->request->is('post')) { 


            $sesid = $this->Session->id();        
            
            if ($this->Auth->login()) { 
                

                $this->User->id = $this->Auth->user('id');

                $this->User->saveField('logins', $this->Auth->user('logins') + 1);

                $this->User->saveField('last_login', date('Y-m-d H:i:s'));

                $updatesess = $this->Session->id();

                if ($this->Auth->user('role') == 'admin') { 

                    $uploadURL = Router::url('/') . 'app/webroot/upload';

                    $_SESSION['KCFINDER'] = array(

                        'disabled' => false,

                        'uploadURL' => $uploadURL,

                        'uploadDir' => ''

                    );

                    return $this->redirect(array(

                                'controller' => 'Dashboard',
                                'action' => 'index',
                                'manager' => false,
                                'admin' => true
                    ));



                } elseif ($this->Auth->user('role') == 'client' && $this->Auth->user('active') == 1) {



                    $uploadURL = Router::url('/') . 'app/webroot/upload';



                    $_SESSION['KCFINDER'] = array(
                        'disabled' => false,
                        'uploadURL' => $uploadURL,
                        'uploadDir' => ''
                    );
                    return $this->redirect(array(
                                'controller' => 'Dashboard',
                                'action' => 'clientdashindex',
                                'manager' => false,
                                'admin' => true
                    ));

                } elseif ($this->Auth->user('role') == 'user' && $this->Auth->user('active') == 1) {


                    $uploadURL = Router::url('/') . 'app/webroot/upload';

                    $_SESSION['KCFINDER'] = array(
                        'disabled' => false,
                        'uploadURL' => $uploadURL,
                        'uploadDir' => ''
                    );

                    return $this->redirect(array(
                                'controller' => 'Dashboard',
                                'action' => 'phlebotomistdashindex'
                    ));

                } else {
                    $this->Session->setFlash('Login is incorrect');

                }

            } else {
                $this->Session->setFlash('Login is incorrect');
            }

        }

    }



    public function login() {

        if ($this->request->is('post')) {

            $sesid = $this->Session->id();

            if ($this->Auth->login()) {

                $this->User->id = $this->Auth->user('id');

                $this->User->saveField('logins', $this->Auth->user('logins') + 1);

                $this->User->saveField('last_login', date('Y-m-d H:i:s'));

                $updatesess = $this->Session->id();


            } else {

                $this->Session->setFlash('Login is incorrect');

            }

        } else {

            return $this->redirect(array('controller' => 'products', 'action' => 'index'));

        }

    }


////////////////////////////////////////////////////////////


    public function logout() {

        $this->Session->setFlash('Good-Bye');

        $_SESSION['KCEDITOR']['disabled'] = true;

        unset($_SESSION['KCEDITOR']);

        return $this->redirect($this->Auth->logout());

    }


    public function admin_logout() {



        $this->Session->setFlash('Good-Bye');



        $_SESSION['KCEDITOR']['disabled'] = true;



        unset($_SESSION['KCEDITOR']);



        $this->Auth->logout();



        return $this->redirect('/admin');



    }







////////////////////////////////////////////////////////////







    public function customer_dashboard() {


    }







////////////////////////////////////////////////////////////



////////////////////////////////////////////////////////////



public function admin_adminindex() {



        Configure::write("debug", 0);
     

        $admin = $this->User->find('all', array('conditions' => array('User.role' => 'admin')));

        $this->set(compact('admin')); 

    }
/*	public function admin_agencylisting(){
		Configure::write("debug", 0);
	
		$agencyusers = $this->User->find('all', array('conditions' => array('AND' => array('User.role' => 'client', 'User.agencyname !=' => NULL)), 'order' => 'User.id DESC'));
		//echo '<pre>'; print_r($agencyusers); echo '</pre>'; die;
		$this->set(compact('agencyusers', $agencyusers));

	}
*/	
    public function admin_indexagency(){
	
	Configure::write("debug", 0);
	
		$agencyusers = $this->User->find('all', array('conditions' => array('AND' => array('User.role' => 'client', 'User.agencyname !=' => NULL)), 'order' => 'User.id DESC'));
		//echo '<pre>'; print_r($agencyusers); echo '</pre>'; die;
		$this->set(compact('agencyusers', $agencyusers));
	
	}
	
    public function admin_index() {
        Configure::write("debug", 0);
		if($this->Auth->User('role') == 'admin'){
        $users = $this->User->find('all', array('order' => 'User.id DESC', 'conditions' => array('AND' => array('User.role' => 'client', 'User.agencyname IS NULL'))));
		}else{
		$userscheck = $this->User->find('first', array('order' => 'User.id DESC', 'conditions' => array('AND' => array('User.id' =>$this->Auth->User('id'), 'User.role' => 'client'))));
			if($userscheck['User']['agencyname'] != NULL){
				$users = $this->User->find('all', array('order' => 'User.id DESC', 'conditions' => array('AND' => array('User.agencyname' =>$userscheck['User']['agencyname'], 'User.role' => 'client'))));
				//echo '<pre>'; print_r($users); echo '</pre>';
			}else{ 
				//echo '<pre>'; print_r($userscheck); echo '</pre>';
				$users = $this->User->find('all', array('order' => 'User.id DESC', 'conditions' => array('AND' => array('User.id' =>$userscheck['User']['id'], 'User.role' => 'client'))));
			}
		
		}
		//echo '<pre>'; print_r($users); echo '</pre>'; die;
        $this->set(compact('users')); 
    }
	
	public function admin_phlebotomistindex() {
		$phlebotomists = $this->User->find('all', array('conditions' => array('User.role' => 'user'), 'order' => 'User.id DESC'));
		$this->set(compact('phlebotomists')); 
	}
////////////////////////////////////////////////////////////
    public function admin_view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException('Invalid user');
        }

        $this->set('user', $this->User->read(null, $id));
    }

////////////////////////////////////////////////////////////







    public function admin_resadd() {



        if ($this->request->is('post')) {



            // debug($this->request->data);exit;



            if ($this->User->hasAny(array('User.username' => $this->request->data['User']['username']))) {



                $this->Session->setFlash(__('Username already exist!!!'));



                return $this->redirect(array('action' => 'resadd'));



            }



            $this->User->create();



            $resname = $this->request->data['User']['name'];



            if ($this->User->save($this->request->data)) {



                $this->loadModel('Restaurant');



                $uid = $this->User->getLastInsertID();



                $this->request->data['Restaurant']['status'] = 1;



                $this->request->data['Restaurant']['taxes'] = 0;



                $this->request->data['Restaurant']['user_id'] = $uid;



                $resname = $this->request->data['Restaurant']['name'] = $resname;



                if ($this->Restaurant->save($this->request->data)) {



                    $id = $this->Restaurant->getLastInsertID();



                    $this->loadModel('Tax');



                    $this->request->data['Tax']['tax'] = 0;



                    $this->request->data['Tax']['resid'] = $id;



                    $this->Tax->save($this->request->data);



                    return $this->redirect(array('controller' => 'restaurants', 'action' => 'edit/' . $id . '/' . $uid));



                }



            } else {



                $this->Session->setFlash('The user could not be saved. Please, try again.');



            }



        }



    }

	/*public function admin_addagency(){
		$this->loadModel("Agency");
		$agencydata = array();
		$agencies = $this->Agency->find('all');
		foreach($agencies as $agency){
			$agencydata[$agency['Agency']['id']] = $agency['Agency']['agencyname'];
		}
		//echo '<pre>'; print_r($agencydata); echo '</pre>'; die;
		$this->set('agency', $agencydata);

        if($this->request->is("post")){ 
			if ($this->User->hasAny(array('User.agencyname' => strtolower($this->request->data['User']['agencyname'])))) {
					$this->Session->setFlash(__('Agency already exist in Database!!!'));
				   return $this->redirect(array('action' => 'addagency'));
	
			}
			
			if ($this->User->hasAny(array('User.agencyemail' => strtolower($this->request->data['User']['agencyemail'])))) {
				$this->Session->setFlash(__('Agency Email already exist in Database!!!'));
				return $this->redirect(array('action' => 'addagency'));
			
			}
        	$this->User->create();

            if($this->User->save($this->request->data)){
				//echo 'Record Add';
            	return $this->redirect(array('action' => 'agencylisting'));
            }
		}
		
	}*/




    public function admin_add() {

        Configure::write("debug", 0);
		$this->loadModel('Agency');
        if ($this->request->is('post')) { 
			//if($this->request->data['User']['agencyname'] == NULL) {
				$this->request->data['User']['email'] = $this->request->data['User']['email'];
				$this->request->data['User']['username'] = $this->request->data['User']['email'];
				
				$this->request->data['User']['active'] = 0;
				
				if ($this->User->hasAny(array('User.email' => $this->request->data['User']['email']))) {
					$this->Session->setFlash(__('Email already exist in Database!!!'));
				   return $this->redirect(array('action' => 'add'));
				}
			
			
         
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $doctorname = $this->request->data['User']['firstname'];

                 $ms = '<body><table width="500" border="0" cellpadding="10" cellspacing="0" style="margin: 0px auto; background: #f0f0f0; text-align: center"><tr style="background: #f0f0f0"><td colspan="2" style="text-align: center; padding-top: 20px; padding-bottom: 20px"><img alt="img" style="height: 97px;" src="' . FULL_BASE_URL . $this->webroot .'home/logo.png"/></td></tr><tr><b>New Doctor registration</b></tr><tr>Doctor Name : '.$doctorname.'</tr></table></body>';


				 $Email = new CakeEmail();
                    $Email->config('default');
                    $Email->template('default');
                    $Email->emailFormat('html');
                    $Email->from(array('noreply@truelabllc.com' => 'QualityLabOne'));
                    $Email->to('notification@truelabllc.com');
                    $Email->subject('New Doctor registration');
                    $Email->send($ms);

                    $Email = new CakeEmail();
                    $Email->config('default');
                    $Email->template('default');
                    $Email->emailFormat('html');
                    $Email->from(array('noreply@truelabllc.com' => 'QualityLabOne'));
                    $Email->to($this->request->data['User']['email']);
                    $Email->subject('Registration is successful');
                    $Email->send($ms);

					return $this->redirect(array('action' => 'index'));
					$this->Session->setFlash('The Doctor has been saved');
				

            }else {
               $this->Session->setFlash('The user could not be saved. Please, try again.');
			   
           }
        }
		$agencydata = array();
		$agencies = $this->Agency->find('all');
		foreach($agencies as $agency){
			$agencydata[$agency['Agency']['id']] = $agency['Agency']['agencyname'];
		}
		$this->set('agency', $agencydata);
   }
    public function admin_addphlebotomist() {

        Configure::write("debug", 0);

        if ($this->request->is('post')) {

            if ($this->User->hasAny(array('User.email' => $this->request->data['User']['email']))) {
                $this->Session->setFlash(__('Email already exist in Database!!!'));
               return $this->redirect(array('action' => 'addphlebotomist'));

            }
            $this->request->data['User']['username'] = $this->request->data['User']['email'];
			 $this->request->data['User']['active'] = 0;
         
            $this->User->create();

            if ($this->User->save($this->request->data)) {

                $doctorname = $this->request->data['User']['firstname'];

                $ms = '<body><table width="500" border="0" cellpadding="10" cellspacing="0" style="margin: 0px auto; background: #f0f0f0; text-align: center"><tr style="background: #f0f0f0"><td colspan="2" style="text-align: center; padding-top: 20px; padding-bottom: 20px"><img alt="img" style="height: 97px;" src="' . FULL_BASE_URL . $this->webroot .'home/logo.png"/></td></tr><tr><b>New Phlebotomist registration</b></tr><tr>Phlebotomist Name : '.$doctorname.'</tr></table></body>';

            $Email = new CakeEmail();
                    $Email->config('default');
                    $Email->template('default');
                    $Email->emailFormat('html');
                    $Email->from(array('noreply@truelabllc.com' => 'QualityLabOne'));
                    $Email->to('notification@truelabllc.com');
                    $Email->subject('New Phlebotomist registration');
                    $Email->send($ms);

                    $Email = new CakeEmail();
                    $Email->config('default');
                    $Email->template('default');
                    $Email->emailFormat('html');
                    $Email->from(array('noreply@truelabllc.com' => 'QualityLabOne'));
                    $Email->to($this->request->data['User']['email']);
                    $Email->subject('Registration is successful');
                    $Email->send($ms);


                $this->Session->setFlash('The user has been saved');
                return $this->redirect(array('action' => 'phlebotomistindex'));

            } else {
               $this->Session->setFlash('The user could not be saved. Please, try again.');
           }
        }
   }






    public function add() {







        Configure::write("debug", 0);



        if ($this->request->is('post')) {



            $this->request->data['User']['name'] = $this->request->data['User']['name'];







            $this->request->data['User']['email'] = $this->request->data['User']['email'];







            $this->request->data['User']['active'] = 0;



            $this->request->data['User']['role'] = 'customer';



            $verification_code = rand(11111,99999);



            $this->request->data['User']['verification_code'] = $verification_code;



            if ($this->User->hasAny(array('User.username' => $this->request->data['User']['username']))) {



                $this->Session->setFlash(__('Username already exist!!!'));



                echo "<script>alert('Username already exist!!!')</script>";



                echo "<script>window.location.assign('http://readytodropin.com/')</script>";



                //return $this->redirect('http://' . $this->request->data['User']['server']);



            }



            $this->User->create();



            $savedhai = $this->User->save($this->request->data);



            if ($savedhai){

             $ms = "Welcome to Dropin 
             <b>Verfication Code is: ".$verification_code." "

                . "</b><br/>".' <p style="color:#999;"><h5>Thanks for registration with us</h5></p><p style="color:#999;">Copy the given code to complete the registration process</p>'. "</b><br/>";



/*                $l = new CakeEmail('smtp');



                $l->emailFormat('html')->template('default', 'default')->subject('Registration Successful!!!')->



                to($this->request->data['User']['email'])->send($ms);
*/






				/*$txtcode = "Your Email Verification code is $verification_code/n/r Click this link: http://readytodropin.com/users/emailverify";



				



				//$this->set(compact('shop'));



				App::uses('CakeEmail', 'Network/Email');



                $email = new CakeEmail();



                $email->from('noreply@readytodropin.com')



                        ->cc('gurpreet@avainfotech.com')



                        ->to($this->request->data['User']['email'])



                        ->subject('User Registration')



                        ->template('default','default') // 'user','user'



                        ->emailFormat('html')



                        ->viewVars(array('linktext' => $txtcode))



                        ->send();*/



                    }







				/*$to = $this->request->data['User']['email'];



				$subject = "Welcome To register to our store";



				$txt = "<iframe src='http://readytodropin.com/img/color_logo.png'></iframe>\n\r";



				$txt .= "Thanks for registration with us. /n/r Your Email Verification code is $verification_code/n/r Click this link: http://readytodropin.com/users/emailverify";



				$headers = "From: gurpreet@avainfotech.com";



				



				



				$mymail = mail($to,$subject,$txt,$headers);*/



				if($savedhai){







                    echo "<script>alert('Please check your email for email verfication code and successfull registration')</script>";



                    echo "<script>window.location.assign('http://readytodropin.com/users/emailverify')</script>";







                }







           /* if ($this->User->save($this->request->data)) {



               /* $this->Session->setFlash('The user has been saved');			



                $l = new CakeEmail('smtp');



                $ms = "Welcome !Your Username & password we mentioned below <br/>";



                $ms.="Username:" . $this->request->data['User']['username'] . "<br/>";



                $ms.="Password:" . $this->request->data['User']['password'] . "<br/>";



                $l->emailFormat('html')->template('default', 'default')->subject('Welcome To register to our store')



                        ->to($this->request->data['User']['username'])->send($ms);



                $this->set('smtp_errors', "none");



                //return $this->redirect('http://' . $this->request->data['User']['server']);



				echo "<script>alert('The user has been saved')</script>";



				echo "<script>window.location.assign('http://readytodropin.com/')</script>";



            }*/







            else {



                //$this->Session->setFlash('The user could not be saved. Please, try again.');



                echo "<script>alert('The user could not be saved. Please, try again.')</script>";



                echo "<script>window.location.assign('http://readytodropin.com/')</script>";



            }



        }



    }











    /*-------Email Verifcation for web-----------*/



    public function webverifyemail(){



        if($this->request->is('post')){



            $exist = $this->User->find("first",array('conditions'=>array(



                "AND"=>array(



                    'User.email'=>$this->request->data['email'],



                    'User.verification_code'=>$this->request->data['verification_code'],



                    'User.active'=>0



                    )



                )));



            if($exist){



                //            print_r($this->request->data); exit;



                $updated = $this->User->updateAll(array('User.active'=>1,'User.verification_code'=>NULL),



                    array('User.email'=>$this->request->data['email'],'User.verification_code'=>$this->request->data['verification_code'],'User.active'=>0)



                    );







                $get_email = $this->request->data['email'];



                $getuserid = $this->User->find('first',array('conditions'=>array('email'=>$get_email)));



                $getuserid = $getuserid['User']['id'];



                $user = $this->User->findById($getuserid);



                $user = $user['User'];



                $this->Auth->login($user);



					/*	if($updated){



					



            //echo $this->request->data['User']['server'];exit;



            $sesid = $this->Session->id();



            if ($this->Auth->login()) {







                $this->User->id = $this->Auth->user('id');



                $this->User->saveField('logins', $this->Auth->user('logins') + 1);



                $this->User->saveField('last_login', date('Y-m-d H:i:s'));



                $this->loadModel('Cart');



                $updatesess = $this->Session->id();



                $this->Cart->updateAll(array('Cart.sessionid' => "'$updatesess'"), array('Cart.sessionid' => $sesid));



                if ($this->Auth->user('role') == 'customer') {



                    return $this->redirect('http://' . $this->request->data['User']['server']);



                } elseif ($this->Auth->user('role') == 'admin') {



                    $uploadURL = Router::url('/') . 'app/webroot/upload';



                    $_SESSION['KCFINDER'] = array(



                        'disabled' => false,



                        'uploadURL' => $uploadURL,



                        'uploadDir' => ''



                    );







                    return $this->redirect(array(



                                'controller' => 'users',



                                'action' => 'emailverify',



                                'manager' => false,



                                'admin' => true



                    ));



                } else {



                    $this->Session->setFlash('Login is incorrect');



                }



            } else {



                $this->Session->setFlash('Login is incorrect');



            }*/







            echo "<script>alert('Email successfully verified')</script>";



            echo "<script>window.location='http://readytodropin.com/'</script>";



        }else{



            echo "<script>alert('Please check your email Id or Verification code')</script>";



            echo "<script>window.location='http://readytodropin.com/users/emailverify'</script>";



        }







    }          



}







public function forgetpwd() {



    Configure::write("debug", 0);



    $this->User->recursive = -1;



    if (!empty($this->data)) {



        if (empty($this->data['User']['username'])) {



            $this->Session->setFlash('Please Provide Your Username that You used to Register with Us');



        } else {



            $username = $this->data['User']['username'];



            $fu = $this->User->find('first', array('conditions' => array('User.username' => $username)));



            if ($fu['User']['email']) {



                if ($fu['User']['active'] == "1") {



                    $key = Security::hash(CakeText::uuid(), 'sha512', true);



                    $hash = sha1($fu['User']['email'] . rand(0, 100));



                    $url = Router::url(array('controller' => 'Users', 'action' => 'reset'), true) . '/' . $key . '#' . $hash;



                    $ms = "<p>Welcome To QualityLabOne</p><p>Click the Link below to reset your password.</p><br /> " . $url;



                    $fu['User']['tokenhash'] = $key;



                    $this->User->id = $fu['User']['id'];



                    if ($this->User->saveField('tokenhash', $fu['User']['tokenhash'])) {



                        /*$l = new CakeEmail('smtp');



                        $l->emailFormat('html')->template('default', 'default')->subject('Reset Your Password')



                        ->to($fu['User']['email'])->send($ms);*/



                        $this->set('smtp_errors', "none");



                        $this->Session->setFlash(__('Check Your Email To Reset your password', true));



                        $this->redirect(array('controller' => 'Products', 'action' => 'index'));



                    } else {



                        $this->Session->setFlash("Error Generating Reset link");



                    }



                } else {



                    $this->Session->setFlash('This Account is not Active yet.Check Your mail to activate it');



                }



            } else {



                $this->Session->setFlash('Username does Not Exist');



            }



        }



    }



}







public function reset($token = null) {



    configure::write('debug', 0);



    $this->User->recursive = -1;



    if (!empty($token)) {



        $u = $this->User->findBytokenhash($token);



        if ($u) {



            $this->User->id = $u['User']['id'];



            if (!empty($this->data)) {



                if ($this->data['User']['password'] != $this->data['User']['password_confirm']) {



                    $this->Session->setFlash("Both the passwords are not matching...");



                    return;



                }



                $this->User->data = $this->data;



                $this->User->data['User']['email'] = $u['User']['email'];



                    $new_hash = sha1($u['User']['email'] . rand(0, 100)); //created token



                    $this->User->data['User']['tokenhash'] = $new_hash;



                    if ($this->User->validates(array('fieldList' => array('password', 'password_confirm')))) {



                        if ($this->User->save($this->User->data)) {



                            $this->Session->setFlash('Password Has been Updated');



                            $this->redirect(array('controller' => 'Products', 'action' => 'index'));



                        }



                    } else {



                        $this->set('errors', $this->User->invalidFields());



                    }



                }



            } else {



                $this->Session->setFlash('Token Corrupted, Please Retry.the reset link 



                    <a style="cursor: pointer; color: rgb(0, 102, 0); text-decoration: none;



                    background: url("http://files.adbrite.com/mb/images/green-double-underline-006600.gif") 



                    repeat-x scroll center bottom transparent; margin-bottom: -2px; padding-bottom: 2px;"



                    name="AdBriteInlineAd_work" id="AdBriteInlineAd_work" target="_top">work</a> only for once.');



            }



        } else {



            $this->Session->setFlash('Pls try again...');



            $this->redirect(array('controller' => 'pages', 'action' => 'login'));



        }



    }







////////////////////////////////////////////////////////////
    public function admin_phlebotomistedit($id = null){
        
         Configure::write("debug", 0);
          if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash('The user has been saved');
                return $this->redirect(array('action' => 'phlebotomistindex'));
            } else {
                $this->Session->setFlash('The user could not be saved. Please, try again.');
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
        }
 
    }

    public function admin_phlebotomistview($id = null) {



        $this->User->id = $id;



        if (!$this->User->exists()) {



            throw new NotFoundException('Invalid user');



        }



        $this->set('user', $this->User->read(null, $id));



    }

    public function admin_phlebotomistdelete($id = null) {



        if (!$this->request->is('post')) {



            throw new MethodNotAllowedException();



        }



        $this->User->id = $id;



        if (!$this->User->exists()) {



            throw new NotFoundException('Invalid user');



        }



        if ($this->User->delete()) {



            $this->Session->setFlash('User deleted');



            return $this->redirect(array('action' => 'phlebotomistindex'));



        }



        $this->Session->setFlash('User was not deleted');



        return $this->redirect(array('action' => 'phlebotomistindex'));



    }
	
		public function admin_editagencybydoctor($id = null) {
	
		Configure::write("debug", 0);
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException('Invalid user');
        }
        // get saved page permissions
      if ($this->request->is('post') || $this->request->is('put')) { //echo '<pre>'; print_r($this->request->data); echo '</pre>'; die;

            if ($this->User->save($this->request->data)) {


                $this->Session->setFlash('The Agency has been saved');
                return $this->redirect(array('action' => 'indexagency'));
            } else {
                $this->Session->setFlash('The Agency could not be saved. Please, try again.');

            }
        } else {
            $this->request->data = $this->User->read(null, $id);
        }

	}

    
	public function admin_editagency($id = null) {
	
		Configure::write("debug", 0);
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException('Invalid user');
        }
        // get saved page permissions
      if ($this->request->is('post') || $this->request->is('put')) { 

            if ($this->User->save($this->request->data)) {


                $this->Session->setFlash('The Agency has been saved');
                return $this->redirect(array('action' => 'agencylisting'));
            } else {
                $this->Session->setFlash('The Agency could not be saved. Please, try again.');

            }
        } else {
            $this->request->data = $this->User->read(null, $id);
        }

	
	}
	
	public function admin_viewagencybydoctor($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException('Invalid user');
        }

        $this->set('user', $this->User->read(null, $id));
    }


    public function admin_viewagency($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException('Invalid user');
        }

        $this->set('user', $this->User->read(null, $id));
    }

	
    public function admin_edit($id = null) {

        Configure::write("debug", 0);
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException('Invalid user');
        }
        // get saved page permissions
      if ($this->request->is('post') || $this->request->is('put')) {

            if ($this->User->save($this->request->data)) {


                $this->Session->setFlash('The user has been saved');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The user could not be saved. Please, try again.');

            }
        } else {
            $this->request->data = $this->User->read(null, $id);
        }
    }

    public function edit() {



        $id = $this->Auth->user('id');



        $this->User->id = $this->Auth->user('id');



        if (!$this->User->exists($id)) {



            return $this->redirect(array('action' => 'myaccount'));



        }



        if ($this->request->is('post') || $this->request->is('put')) {



            $email = $this->Auth->user('email');



            $username = $this->Auth->user('username');



            if (($email == $this->request->data['User']['email']) && ($username == $this->request->data['User']['username'])) {



                if ($this->User->save($this->request->data)) {



                    $this->Session->setFlash(__('Your profile has been updated.'));



                    return $this->redirect(array('action' => 'myaccount'));



                } else {



                    $this->Session->setFlash(__('The user could not be saved. Please, try again.'));



                }



            } else if ($this->User->hasAny(array('User.email' => $this->request->data['User']['email']))) {



                $this->Session->setFlash(__('Email already exist!'));



                return $this->redirect(array('action' => 'edit'));



            } else if ($this->User->hasAny(array('User.username' => $this->request->data['User']['username']))) {



                $this->Session->setFlash(__('Username already exist!'));



                return $this->redirect(array('action' => 'edit'));



            } else {



                if ($this->User->save($this->request->data)) {



                    $this->Session->setFlash(__('Your profile has been updated.'));



                    return $this->redirect(array('action' => 'myaccount'));



                } else {



                    $this->Session->setFlash(__('The user could not be saved. Please, try again.'));

                }

            }

        } else {

            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $data = $this->request->data = $this->User->find('first', $options);
            $this->set('data', $data);

        }

    }



////////////////////////////////////////////////////////////


    public function admin_password($index = null, $id = null) {

 	Configure::write("debug", 0);

        $this->User->id = $id;

        if (!$this->User->exists()) {

            throw new NotFoundException('Invalid user');
        }
        
        if ($this->request->is('post') || $this->request->is('put')) {

            $dat = date("Y-m-d h:i:s");

            $values = $this->User->find('first', array('conditions' => array('User.id'=> $id)));
            $em = $values['User']['email'];

            $this->request->data['User']['passworddate'] = $dat;
            
            if ($this->User->save($this->request->data)) {

				if($index == 'agency'){

                	$this->Session->setFlash('The Agency has been saved');

                	$this->redirect(array('action' => 'indexagency'));

				}else{
                	$this->Session->setFlash('The User has been saved');

                	$this->redirect(array('action' => 'index'));
				}

                $mss = '<body><table width="500" border="0" cellpadding="10" cellspacing="0" style="margin: 0px auto; background: #f0f0f0; text-align: center"><tr style="background: #f0f0f0"><td colspan="2" style="text-align: center; padding-top: 20px; padding-bottom: 20px"> <img alt="img" style="height: 97px;" src="'.FULL_BASE_URL . $this->webroot . 'home/logo.png"/></td> </tr><tr><td colspan="2"> <h2>Welcome to QualityLabOne</h2><h3></tr><tr> The Password for '.$em.' has been updated on '.$dat.'. Thank you. </tr><tr><td colspan="2"><h3>Thank you</h2> </td> </tr></table></body>'; 
                

                        $Email = new CakeEmail();
                        $Email->config('default');
                        $Email->template('default');
                        $Email->emailFormat('html');
                        $Email->from(array('noreply@truelabllc.com' => 'QualityLabOne'));
                        $Email->to('notification@truelabllc.com');
                        $Email->subject('Change Password');
                        $Email->send($mss);

            } else {
                $this->Session->setFlash('The user could not be saved. Please, try again.');
            }



        } else {



            $this->request->data = $this->User->read(null, $id);



        }



    }


////////////////////////////////////////////////////////////

    public function admin_delete($index = null, $id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException('Invalid user');
        }
        if ($this->User->delete()) {
			if($index != 'agency') {
            	$this->Session->setFlash('User deleted');
            	return $this->redirect(array('action' => 'index'));
			}else{
            	$this->Session->setFlash('Agency deleted');
            	return $this->redirect(array('action' => 'indexagency'));
			}
        }
        $this->Session->setFlash('User was not deleted');
        return $this->redirect(array('action' => 'index'));
    }


////////////////////////////////////////////////////////////



    public function api_loginwork() {



       Configure::write("debug", 0);



       $postdata = file_get_contents("php://input");



       $redata = json_decode($postdata);



       ob_start();



       //print_r($redata);



       $c = ob_get_clean();



       $fc = fopen('files' . DS . 'detail.txt', 'w');



       fwrite($fc, $c);



       fclose($fc);



       $this->layout = "ajax";



       $username = $redata->user->username;



       $password = $redata->user->password;



       $this->request->data['User']['username'] = $username;



        //$this->request->data['email'];        



       $this->request->data['password'] = $password;







        ////



       $this->request->data['User']['username'] = $username;



        //$this->request->data['email'];        



       $this->request->data['password'] = $password;



       if ($redata) {



        $password_hash = AuthComponent::password($password);



        $check = $this->User->find('first', array('conditions' => array(



            "AND"=>array(



                "User.username" => $this->request->data['User']['username'],



                "User.password"=>$password_hash



                    //"User.active"=>1



                )



            ), 'recursive' => '-1'));







        if($check){



          if($check['User']['active']==0){



            $response['status'] = true;



            $response['data'] = $check;



            $response['msg'] = 'You have not verified your email';



        }else {



            $check['User']['image']= FULL_BASE_URL . $this->webroot . "files/profile_pic/" . $check['User']['image'];



            $response['status'] = true;



            $response['msg'] = 'You have successfully logged in';



            $response['data'] = $check;



        }



    }else{



        $response['status'] = false;



        $response['msg'] = 'User is not valid';



    }           



}



echo json_encode($response);



exit;



}







public function api_login() {

	Configure::write("debug", 0);

    $this->request->data['User']['email'] = $this->request->data['email'];

    $tokenid = $this->request->data['tokenid'];
    $pass = $this->request->data['password'];
    $role = $this->request->data['role'];



    if ($this->request->is('post')) {           



        $this->request->data['User']['password'] = $pass; 



        $password = AuthComponent::password($pass);                
       
        $check = $this->User->find('first', array('conditions' => array('User.password' => $password,'User.role' => $role, 'User.email' =>  $this->request->data['User']['email'])));


        if($check){
              $data = $this->User->updateAll(array('User.tokenid' => "'$tokenid'"), array('User.id' => $check['User']['id']));  

            $response['msg'] = 'User Successfully Login';
            $response['userid'] =$check['User']['id'];
			$response['data'] =$check;

            $response['error'] = 0; 

        } else {

           $response['msg'] = 'Invalid Credentials';

            $response['error'] =2; 

        }

    } else {

        $response['msg'] = 'Sorry Something Went Wrong!';



        $response['error'] =1; 

    }



    echo json_encode($response);



    exit;

}





public function api_registration() {      



    Configure::write("debug", 0);

    $this->request->data['User']['firstname'] = $this->request->data['firstname'];

    $this->request->data['User']['lastname'] = $this->request->data['lastname'];
 
    $this->request->data['User']['email'] = $this->request->data['email'];

    $this->request->data['User']['username'] = $this->request->data['email'];

    $this->request->data['User']['phonenumber'] = $this->request->data['phonenumber'];
    $this->request->data['User']['fax'] = $this->request->data['fax'];
    $this->request->data['User']['address'] = $this->request->data['address'];
    $this->request->data['User']['address2'] = $this->request->data['address2'];
    $this->request->data['User']['city'] = $this->request->data['city'];
    $this->request->data['User']['state'] = $this->request->data['state'];
        $this->request->data['User']['zipcode'] = $this->request->data['zipcode'];
    $this->request->data['User']['agencyname'] = $this->request->data['agencyname'];
   
    $this->request->data['User']['password'] = $this->request->data['password'];
    $dat = date("Y-m-d h:i:s");
    $this->request->data['User']['passworddate'] = $dat;



    $this->request->data['User']['role'] = $this->request->data['role'];



    if ($this->request->is('post')) {



        if ($this->User->hasAny(array('User.username' => $this->request->data['User']['username']))) {



            $response['msg'] = 'Email already exist';



            $response['status'] = 3;   

            $response['error'] = 1;   



        } else {



            $this->loadModel('User');



            $this->User->create();



            $savedata = $this->User->save($this->request->data);
            $pnam = $this->request->data['User']['firstname'];

            $ms = '<body><table width="500" border="0" cellpadding="10" cellspacing="0" style="margin: 0px auto; background: #f0f0f0; text-align: center"><tr style="background: #f0f0f0"><td colspan="2" style="text-align: center; padding-top: 20px; padding-bottom: 20px"><img alt="img" style="height: 97px;" src="' . FULL_BASE_URL . $this->webroot .'home/logo.png"/></td></tr><tr><b>New Phlebotomist registration</b></tr><tr>Phlebotomist Name : '.$pnam.'</tr></table></body>';


            $Email = new CakeEmail();
                    $Email->config('default');
                    $Email->template('default');
                    $Email->emailFormat('html');
                    $Email->from(array('noreply@truelabllc.com' => 'QualityLabOne'));
                    $Email->to('notification@truelabllc.com');
                    $Email->subject('New Phlebotomist registration');
                    $Email->send($ms);

                    $Email = new CakeEmail();
                    $Email->config('default');
                    $Email->template('default');
                    $Email->emailFormat('html');
                    $Email->from(array('noreply@truelabllc.com' => 'QualityLabOne'));
                    $Email->to($this->request->data['User']['email']);
                    $Email->subject('Registration is successful');
                    $Email->send($ms);


            if($savedata){

                $response['isSuccess'] = true;

                $response['user_id']=$this->User->getLastInsertID();
                $response['email']=$this->request->data['User']['email'];

				$response['username']=$this->request->data['User']['username'];

                $response['status'] = true;



                $response['msg'] = 'Registration has been successful.';



                $response['status'] = 1;

                $response['error'] = 0;     						   



            }



        } 



    } else {



        $response['msg'] = 'Sorry please try again';



        $response['status'] =2;  

        $response['error'] = 1;   



    }



    echo json_encode($response);



    exit;



}

public function api_registrationclient() {      

    Configure::write("debug", 0);
    $this->request->data['User']['role'] = $this->request->data['role'];
    $this->request->data['User']['email'] = $this->request->data['email'];
    $this->request->data['User']['password'] = $this->request->data['password'];
    $this->request->data['User']['agencyname'] = $this->request->data['agencyname'];
    $this->request->data['User']['agencyphonenumber'] = $this->request->data['agencyphonenumber'];
    $this->request->data['User']['agencyfax'] = $this->request->data['agencyfax'];
    $this->request->data['User']['address'] = $this->request->data['address'];
    $this->request->data['User']['address2'] = $this->request->data['address2'];
    $this->request->data['User']['city'] = $this->request->data['city'];
    $this->request->data['User']['state'] = $this->request->data['state'];
    $this->request->data['User']['zipcode'] = $this->request->data['zipcode'];
    $this->request->data['User']['firstname'] = $this->request->data['firstname'];
    $this->request->data['User']['lastname'] = $this->request->data['lastname'];
    $this->request->data['User']['username'] = $this->request->data['email'];
    $this->request->data['User']['phonenumber'] = $this->request->data['phonenumber'];
    $this->request->data['User']['fax'] = $this->request->data['fax'];
    $this->request->data['User']['npi'] = $this->request->data['npi'];

    $dat = date("Y-m-d h:i:s");
    $this->request->data['User']['passworddate'] = $dat;

    if ($this->request->is('post')) {
        if ($this->User->hasAny(array('User.username' => $this->request->data['User']['username']))) {

            $response['msg'] = 'Email already exist';



            $response['status'] = 3;   

            $response['error'] = 1;   



        }else if ($this->User->hasAny(array('User.phonenumber' => $this->request->data['User']['phonenumber']))) {



            $response['msg'] = 'Phone number already exist';
            
            $response['status'] = 3;   

            $response['error'] = 1;   



        } else {



            $this->loadModel('User');



            $this->User->create();



            $savedata = $this->User->save($this->request->data);
            $doctorname = $this->request->data['firstname'];

            $ms = '<body><table width="500" border="0" cellpadding="10" cellspacing="0" style="margin: 0px auto; background: #f0f0f0; text-align: center"><tr style="background: #f0f0f0"><td colspan="2" style="text-align: center; padding-top: 20px; padding-bottom: 20px"><img alt="img" style="height: 97px;" src="' . FULL_BASE_URL . $this->webroot .'home/logo.png"/></td></tr><tr><b>New Doctor registration</b></tr><tr>Agency Name : '.$doctorname.'</tr></table></body>';

            $Email = new CakeEmail();
                    $Email->config('default');
                    $Email->template('default');
                    $Email->emailFormat('html');
                    $Email->from(array('noreply@truelabllc.com' => 'QualityLabOne'));
                    $Email->to('notification@truelabllc.com');
                    $Email->subject('New Doctor registration');
                    $Email->send($ms);

                    $Email = new CakeEmail();
                    $Email->config('default');
                    $Email->template('default');
                    $Email->emailFormat('html');
                    $Email->from(array('noreply@truelabllc.com' => 'QualityLabOne'));
                    $Email->to($this->request->data['User']['email']);
                    $Email->subject('Registration is successful');
                    $Email->send($ms);

            if($savedata){                       

                $response['isSuccess'] = true;

                $response['user_id']=$this->User->getLastInsertID();
                $response['email']=$this->request->data['User']['email'];



                $response['status'] = true;



                $response['msg'] = 'Registration has been successful. ';



                $response['status'] = 1;

                $response['error'] = 0;     						   



            }



        } 



    } else {



        $response['msg'] = 'Sorry please try again';



        $response['status'] =2;  

        $response['error'] = 1;   



    }



    echo json_encode($response);



    exit;



}

public function api_agencyregistration(){

    $this->loadModel('Agency');
    $this->loadModel('User');
    Configure::write("debug", 0);
        
        if($this->request->is("post")){ 

            if ($this->Agency->hasAny(array('Agency.agencyname' => strtolower($this->request->data['agencyname'])))) {
                    $response['msg'] = 'Agency already exists!';
                    $response['status'] = 1;  
   
            }elseif ($this->Agency->hasAny(array('Agency.agencyemail' => strtolower($this->request->data['agencyemail'])))) {
                $response['msg'] = 'Agency Email already exist in Database!';
                $response['status'] = 1;
            
            }else{

            $this->request->data['Agency']['agencyname'] = strtolower($this->request->data['agencyname']);
             $this->request->data['Agency']['password'] = $this->request->data['password'];
            $this->request->data['Agency']['simpass'] = $this->request->data['password'];
                $this->request->data['Agency']['agencyphonenumber'] = $this->request->data['agencyphonenumber'];
                $this->request->data['Agency']['agencyfax'] = $this->request->data['agencyfax'];
                $this->request->data['Agency']['address'] = $this->request->data['address'];
                $this->request->data['Agency']['address2'] = $this->request->data['address2'];
                $this->request->data['Agency']['city'] = $this->request->data['city'];
                $this->request->data['Agency']['state'] = $this->request->data['state'];
                $this->request->data['Agency']['zipcode'] = $this->request->data['zipcode'];
                $this->request->data['Agency']['agencyemail'] = strtolower($this->request->data['agencyemail']);

            $this->Agency->create();

            if($this->Agency->save($this->request->data)){
                //echo 'Record Add';
                
                $this->request->data['User']['agencyid'] = $this->Agency->getLastInsertId();
                $this->request->data['User']['role'] = 'client';
                $this->request->data['User']['agencyname'] = $this->request->data['agencyname'];
                $this->request->data['User']['email'] = $this->request->data['agencyemail'];
                $this->request->data['User']['username'] = $this->request->data['agencyemail'];
                $this->request->data['User']['password'] = $this->request->data['password'];
                $this->request->data['User']['agencyphonenumber'] = $this->request->data['agencyphonenumber'];
                $this->request->data['User']['agencyfax'] = $this->request->data['agencyfax'];
                $this->request->data['User']['address'] = $this->request->data['address'];
                $this->request->data['User']['address2'] = $this->request->data['address2'];
                $this->request->data['User']['city'] = $this->request->data['city'];
                $this->request->data['User']['state'] = $this->request->data['state'];
                $this->request->data['User']['zipcode'] = $this->request->data['zipcode'];
                 $dat = date("Y-m-d h:i:s");
                $this->request->data['User']['passworddate'] = $dat;
                $this->User->save($this->request->data);

                $doctorname = $this->request->data['agencyname'];

                $ms = '<body><table width="500" border="0" cellpadding="10" cellspacing="0" style="margin: 0px auto; background: #f0f0f0; text-align: center"><tr style="background: #f0f0f0"><td colspan="2" style="text-align: center; padding-top: 20px; padding-bottom: 20px"><img alt="img" style="height: 97px;" src="' . FULL_BASE_URL . $this->webroot .'home/logo.png"/></td></tr><tr><b>New Agency registration</b></tr><tr>Agency Name : '.$doctorname.'</tr></table></body>';

            $Email = new CakeEmail();
                    $Email->config('default');
                    $Email->template('default');
                    $Email->emailFormat('html');
                    $Email->from(array('noreply@truelabllc.com' => 'QualityLabOne'));
                    $Email->to('notification@truelabllc.com');
                    $Email->subject('New Agency registration');
                    $Email->send($ms);

                    $Email = new CakeEmail();
                    $Email->config('default');
                    $Email->template('default');
                    $Email->emailFormat('html');
                    $Email->from(array('noreply@truelabllc.com' => 'QualityLabOne'));
                    $Email->to($this->request->data['User']['email']);
                    $Email->subject('Registration is successful');
                    $Email->send($ms);


                $response['msg'] = 'A new agency is created!';
                $response['status'] = 0;
            }

        }
    }

    echo json_encode($response);
    exit;

}


/*-------Email Verifcation-----------*/



public function api_verifyEmail(){



    if($this->request->is('post')){



        $exist = $this->User->find("first",array('conditions'=>array(



            "AND"=>array(



                'User.email'=>$this->request->data['email'],



                'User.verification_code'=>$this->request->data['verification_code'],



                'User.active'=>0



                )



            )));



        if($exist){



            $updated = $this->User->updateAll(array('User.active'=>1,'User.verification_code'=>NULL),



                array('User.email'=>$this->request->data['email'],'User.verification_code'=>$this->request->data['verification_code'],'User.active'=>0)



                );



            if($updated){



                $user=$this->User->find('first',array('conditions'=>array('User.email'=>$this->request->data['email'])));



                $response['isSuccess']=true;



                $response['msg']="Verified Successfully";



                $response['data']=$user;



            }else{



                $response['isSuccess']=false;



                $response['msg']="Please verify account with valid verification code. Unable to verify";



            }



        }else{



            $response['isSuccess']=false;



            $response['msg']="Please verify account with valid verification code.";



        }



    }else{



        $response['isSuccess']=false;



        $response['msg']="Only Post Method is allowed";



    }



    echo json_encode($response);



    exit;



}







public function api_chekdata() {











    configure::write('debug', 0);



















    $this->layout = 'ajax';







    ob_start();







    var_dump($this->request->data);







    $c = ob_get_clean();







    $fc = fopen('files' . DS . 'detail.txt', 'w');







    fwrite($fc, $c);







    fclose($fc);







    exit;



}







public function api_logout() {

    configure::write('debug', 0);



    $this->layout = 'ajax';







    if ($this->request->is('post')) {







        $this->User->id = $this->request->data[User][id];







        $this->Auth->logout();







            //$this->Cookie->delete('User');







        $response['isSucess'] = 'true';







        $response['msg'] = "Logout Successfully";



    }







    $this->set('response', $response);







    $this->render('ajax');



}



public function api_editprofile() {


    configure::write('debug', 0);
    
    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $phonenumber = $_POST['phonenumber'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $fax = $_POST['fax'];
    $address = $_POST['address'];
    $address2 = $_POST['address2'];
    $zipcode = $_POST['zipcode'];
    $agencyname = $_POST['agencyname'];
    $agencyphonenumber = $_POST['agencyphonenumber'];
    $agencyfax = $_POST['agencyfax'];
    $npi = $_POST['npi'];
    $image = $_POST['image'];

        $img = base64_decode($image);

        $im = imagecreatefromstring($img);

        if ($im !== false) {

            $image = "1" . time() . ".png";

            imagepng($im, WWW_ROOT . "files" . DS . "profile_pic" . DS . $image);

            imagedestroy($im);
            
        
        }
		
		if(!isset($agencyname)){

        $data = $this->User->updateAll(array('User.username' => "'$username'",'User.lastname' => "'$lastname'", 'User.firstname' => "'$firstname'", 'User.phonenumber' => "'$phonenumber'",'User.image' => "'$image'",'User.city' => "'$city'",'User.state' => "'$state'",'User.address' => "'$address'",'User.address2' => "'$address2'",'User.zipcode' => "'$zipcode'",'User.npi' => "'$npi'"), array('User.id' => $id));
        }else{

          $data = $this->User->updateAll(array('User.username' => "'$username'",'User.lastname' => "'$lastname'", 'User.firstname' => "'$firstname'", 'User.phonenumber' => "'$phonenumber'",'User.image' => "'$image'", 'User.city' => "'$city'",'User.state' => "'$state'",'User.address' => "'$address'",'User.address2' => "'$address2'",'User.zipcode' => "'$zipcode'",'User.agencyname' => "'$agencyname'",'User.agencyphonenumber' => "'$agencyphonenumber'",'User.agencyfax' => "'$agencyfax'",'User.npi' => "'$npi'"), array('User.id' => $id));  

        }   
        if ($data) {

        $response['data'] = $_POST['image'];

        $response['error'] = 0;

        $response['isSucess'] = 'true';



    }

    else{

        $response['error'] = 1;

        $response['error'] = 1;

        $response['isSucess'] = 'false';

    }   



    echo json_encode($response);



    exit;



}

public function api_agencyeditprofile() {


    configure::write('debug', 0);
    $this->loadModel('Agency');
    $this->loadModel('User');

    $id = $_POST['agencyid'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $address = $_POST['address'];
    $address2 = $_POST['address2'];
    $zipcode = $_POST['zipcode'];
    $agencyname = $_POST['agencyname'];
    $agencyphonenumber = $_POST['agencyphonenumber'];
    $agencyfax = $_POST['agencyfax'];
    $image = $_POST['image'];

        $img = base64_decode($image);

        $im = imagecreatefromstring($img);

        if ($im !== false) {

            $image = "1" . time() . ".png";

            imagepng($im, WWW_ROOT . "files" . DS . "profile_pic" . DS . $image);

            imagedestroy($im);
            
        
        }
        
        $data = $this->User->updateAll(array('User.username' => "'$username'",'User.image' => "'$image'", 'User.city' => "'$city'",'User.state' => "'$state'",'User.address' => "'$address'",'User.address2' => "'$address2'",'User.zipcode' => "'$zipcode'",'User.agencyname' => "'$agencyname'",'User.agencyphonenumber' => "'$agencyphonenumber'",'User.agencyfax' => "'$agencyfax'"), array('User.agencyid' => $id));

        $this->Agency->updateAll(array('Agency.agencyemail' => "'$username'", 'Agency.city' => "'$city'",'Agency.state' => "'$state'",'Agency.address' => "'$address'",'Agency.address2' => "'$address2'",'Agency.zipcode' => "'$zipcode'",'Agency.agencyname' => "'$agencyname'",'Agency.agencyphonenumber' => "'$agencyphonenumber'",'Agency.agencyfax' => "'$agencyfax'"), array('Agency.id' => $id));   


        if ($data) {

        $response['data'] = $_POST;

        $response['error'] = 0;

        $response['isSucess'] = 'true';



    }

    else{

        $response['error'] = 1;

        $response['error'] = 1;

        $response['isSucess'] = 'false';

    }   



    echo json_encode($response);



    exit;



}



public function api_patientsignature(){
   
    Configure::write("debug",0);
    
    $this->loadModel('PatientTest');
    $this->loadModel('Patient');
    $this->loadModel('Test');
    $this->loadModel('User');    
    $this->loadModel('Agency');

    
    $one = $_POST['patientsignature'];
    $id = $_POST['id']; 
    

        $img = base64_decode($one);

        

        $im = imagecreatefromstring($img);

        if ($im !== false) {



            $image = "1" . time() . ".png";



            imagepng($im, WWW_ROOT . "files" . DS . "profile_pic" . DS . $image);



            imagedestroy($im);
            $ima = FULL_BASE_URL.$this->webroot .'files/profile_pic/'.$image;
            $data = $this->PatientTest->updateAll(array('PatientTest.patientsignature' => "'$ima'"), array('PatientTest.id' => $id));

            require_once("../webroot/MPDF57/mpdf.php"); 
            $mpdf=new mPDF();
            
            $patienttestdata = $this->PatientTest->find("first", array("conditions" => array("PatientTest.id" => $id)));
            $patientid = $patienttestdata['PatientTest']['patientid'];
            $doctorid = $patienttestdata['PatientTest']['doctorid'];
            $testid = $patienttestdata['PatientTest']['testid'];
            $clientsignature = $patienttestdata['PatientTest']['clientsignature'];
            $patientdata = $this->Patient->find("first", array("conditions" => array("Patient.id" => $patientid)));
            // $time = strtotime($dob);
            // $newformat = date("Y-m-d",$time);
            $today = date("Y-m-d");
            // $diff = date_diff(date_create($newformat), date_create($today));
            $dob = "06-10-1973 02:22:22";
            $dated = strtotime(date('Y-m-d',strtotime($dob))); 
            $diff = round((time()-strtotime($dob))/(3600*24*365.25)); 

            $doctordata = $this->User->find("first", array("conditions" => array("User.id" => $doctorid)));
            $agencyname = $doctordata['User']['agencyname'];
            $currentdate = date('Y-m-d');
            if($agencyname != NULL){
                $agencies = $this->Agency->find("first", array("conditions" => array("Agency.agencyname" => $agencyname)));   
            }
            $testdata = $this->Test->find("all");
            $agencyname = $doctordata['User']['agencyname'];
            
            $myhtml='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <title>Report</title>

                </head>

                <body>

                <table width="600" border="0" style="margin:0px auto; font-family:Arial, Helvetica, sans-serif; font-size:12px;table-layout:fixed;">
                  <tr>
                    <td style="text-align:center;">
                        <h1 style="margin:0;">True Laboratories LLC</h1>
                    </td>
                  </tr>
                   <tr>
                    <td style="text-align:center;">
                        <p style="margin-top:0;"><b>Oak Forest, IL. 60452. Tel No (708) 620-5790. Fax No (708) 620-5215</b></p><br />
                    </td>
                  </tr>
                  <tr>
                    <td style="border:none; padding:0;">
                        <table width="100%" border="0" cellpadding="10" cellspacing="0">
                  <tr>
                    <td style="border:1px solid #bababa; border-right:none;">PATIENT LAST NAME :</td>
                    <td style="border:1px solid #bababa; border-right:none;">'.$patientdata['Patient']['lastname'].'</td>
                    <td style="border:1px solid #bababa; border-right:none;">REQUEST DATE :</td>
                    <td style="border:1px solid #bababa;">'.$currentdate.'</td>
                  </tr>
                  <tr>

                  <tr style="background:#f9f9f9;">
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">PATIENT FIRSTNAME:</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">'.$patientdata['Patient']['firstname'].'</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">CLINIC/AGENCY NAME :</td>';
                    if($agencyname != NULL){
                      $myhtml.='<td style="border:1px solid #bababa; border-top:none;">'.$agencyname.'</td>';
                    }else{
                      $myhtml.='<td style="border:1px solid #bababa; border-top:none;">'.$patientdata['Patient']['doctorname'].'</td>';  
                    }    
                  $myhtml.='</tr>
                  <tr style="background:#fff;">
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">DOB :</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">'.$patientdata['Patient']['dob'].'</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">OFFICE NUMBER :</td>';
                    if($agencyname != NULL){
                      $myhtml.='<td style="border:1px solid #bababa; border-top:none;">'.$doctordata['User']['agencyphonenumber'].'</td>';
                    }   else{
                       $myhtml.='<td style="border:1px solid #bababa; border-top:none;">'.$doctordata['User']['phonenumber'].'</td>'; 
                    }
                  $myhtml.='</tr>

                  <tr style="background:#f9f9f9;">
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">AGE :</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">'.$diff.'</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">FAX NUMBER :</td>
                    ';
                    if($agencyname != NULL){
                      $myhtml.='<td style="border:1px solid #bababa; border-top:none;">'.$doctordata['User']['agencyfax'].'</td>';
                    }else{
                      $myhtml.='<td style="border:1px solid #bababa; border-top:none;">'.$doctordata['User']['fax'].'</td>';  
                    }
                    
                  $myhtml.='</tr>

                  <tr style="background:#fff;">
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">GENDER :</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">'.$patientdata['Patient']['sex'].'</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">ADDRESS :</td>
                    <td style="border:1px solid #bababa; border-top:none;">'.$doctordata['User']['address'].','.$doctordata['User']['address2'].'</td>
                  </tr>

                  <tr style="background:#f9f9f9;">
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">PHONE NUMBER :</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">'.$patientdata['Patient']['phonenumber'].'</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">CITY, STATE, ZIP CODE :</td>
                    <td style="border:1px solid #bababa; border-top:none;">'.$doctordata['User']['city'].','.$doctordata['User']['state'].','.$doctordata['User']['zipcode'].'</td>
                  </tr>

                  <tr style="background:#fff;">
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">ADDRESS :</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">'.$patientdata['Patient']['address'].'</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">DOCTOR NAME :</td>
                    <td style="border:1px solid #bababa; border-top:none;">'.$doctordata['User']['firstname'].'</td>
                  </tr>

                  <tr style="background:#f9f9f9;">
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">ADDRESS2 :</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">'.$patientdata['Patient']['address2'].'</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">DOCTOR NPI NO. :</td>
                    <td style="border:1px solid #bababa; border-top:none;">'.$doctordata['User']['npi'].'</td>
                  </tr>

                  <tr style="background:#fff;">
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">PATIENT INSURANCE NAME :</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">'.$patientdata['Patient']['insurancename'].'</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">PATIENT INSURANCE NO. :</td>
                    <td style="border:1px solid #bababa; border-top:none;">'.$patientdata['Patient']['insurancenumber'].'</td>
                  </tr>

                  <tr style="background:#f9f9f9;">
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">CITY, STATE, ZIP CODE :</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">'.$patientdata['Patient']['city'].','.$patientdata['Patient']['state'].','.$patientdata['Patient']['zipcode'].'</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">DOCTOR/REPRESENTATIVE SIGNATURE :</td>
                    <td style="border:1px solid #bababa; border-top:none;"><img width="150px" src='.$clientsignature.'></td>
                  </tr>

                  <tr style="background:#fff;">
                    <td colspan="2" style="border:1px solid #bababa; border-right:none; border-top:none;">DIAGNOSIS (ICD 10) :</td>
                    <td colspan="2" style="border:1px solid #bababa; border-top:none;">'.$patienttestdata['PatientTest']['testdiagnosis'].'</td>
                  </tr>

                  <tr style="background:#f9f9f9;">
                    <td colspan="2" style="border:1px solid #bababa; border-right:none; border-top:none;">SPECIAL INSTRUCTION :</td>
                    <td colspan="2" style="border:1px solid #bababa;  border-top:none;">'.$patientdata['Patient']['diagnosis'].'</td>
                  </tr>

                  <tr>
                        <td colspan="4"><form id="form1" name="form1" method="post" action="">
                          <p>';
                          $checked="";
                          foreach($testdata as $tests){
                            if($testid == $tests['Test']['id']){
                                                        
                            $myhtml.='<label>
                              <input type="checkbox" name="CheckboxGroup1" value="checkbox" checked="checked" id="CheckboxGroup1_0" />';
                            }else{
                             $myhtml.='<label>
                              <input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_0" />';   
                            }
                            
                            $myhtml.='<b style="font-size:12px">'.$tests['Test']['test'].'</b></label> <br/>';
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
                        <img width="150px" src="'.$ima.'">
                            
                    </td>
                  </tr>

                </table>

                    </td>
                  </tr>
                </table>


                </body>
                </html>';

            
                $nomFacture = time().".pdf";
                $filename = $nomFacture;

                $path = '../webroot/MPDF57/pdf';
                $file = $path . "/" . $filename;
  
                $mpdf->WriteHTML($myhtml);
                $mpdf->Output($file, 'F'); 
                $filesave = FULL_BASE_URL."/truelab/MPDF57/pdf/".$filename;
                $this->PatientTest->updateAll(array('PatientTest.paidreport' => "'$filesave'"),array('PatientTest.id' => $id));    
                
                
            $response['msg'] = "image is uploaded";


        } else {



            $response['isSucess'] = 'true';



            $response['msg'] = 'Image did not create';



        }

        echo json_encode($response);

        exit;
    }

public function api_clientsignature(){
   
    $this->loadModel('PatientTest');
    
    $image = $_POST['clientsignature'];
    $id = $_POST['id']; 
    
        if($image != ""){
        $img = base64_decode($image);

        $im = imagecreatefromstring($img);

        if ($im !== false) {

            $image = "1" . time() . ".png";

            imagepng($im, WWW_ROOT . "files" . DS . "profile_pic" . DS . $image);

            imagedestroy($im);
            
        
        }

        $data = $this->PatientTest->updateAll(array('PatientTest.clientsignature' => FULL_BASE_URL . $this->webroot . "files/profile_pic/".$image), array('PatientTest.id' => $id));
        }
        echo json_encode($response);

    exit;
}

public function api_user() {

    $id = $_POST['id'];

    $data = $this->User->find('all', array('conditions' => array('User.id' => $id)));

    if(count($data)>0){



        if ($data[0]['User']['image']) {



            $data[0]['User']['image'] = FULL_BASE_URL . $this->webroot . "files/profile_pic/" . $data[0]['User']['image'];



        } else {



            $data[0]['User']['image'] = FULL_BASE_URL . $this->webroot . "files/profile_pic/noimagefound.jpg";



        } 







        $response['msg'] = 'Success';







        $response['data'] = $data;           



    }



    else{



        $response['isSucess'] = 'false';







        $response['msg'] = 'Sorry! There is no data';



    }











    echo json_encode($response);



    exit;



}







public function api_alluser() {







    $this->layout = 'ajax';







    $resp = $this->User->find('all', array('conditions' => array(



        "User.status" => 1



        ), 'recursive' => '-1'));







    if ($resp) {







        $response['isSucess'] = 'true';







        $response['msg'] = 'Success';







        $response['data'] = $resp;



    } else {







        $response['isSucess'] = 'false';







        $response['msg'] = 'Sorry there are no data';



    }







    $this->set('response', $response);







    $this->render('ajax');



}







public function api_changepasswordwork() {



    Configure::write('debug', 0);







    $oldpassword = $_REQUEST['old_password'];



    $newpassword =  $_REQUEST['new_password'];



    $username = $_REQUEST['username'];







    if ($this->request->is('post')) {



        $password = AuthComponent::password($oldpassword);







        $pass = $this->User->find('first', array('conditions' => array('AND' => array('User.password' => $password, 'User.id' => $username))));



        if ($pass) {







            $this->User->data['User']['password'] = $newpassword;



            $this->User->id = $pass['User']['id'];



            if ($this->User->exists()) {



                $pass['User']['password'] = $newpassword;



                if ($this->User->save()) {						



                  $this->User->id = $pass['User']['id'];



                  $this->Auth->logout();						



                  $response['isSucess'] = 'true';



                  $response['msg'] = "your password has been updated";



              }



          }



      } else {



        $response['isSucess'] = 'false';



        $response['msg'] = "Your old password did not match";



    }



}



else{



    $response['isSucess'] = 'false';



    $response['msg'] = "Please Fill all the fields";







}



echo json_encode($response);



exit;



}

public function changepassword() {

    if ($this->request->is('post')) {



        $password = AuthComponent::password($this->data['User']['old_password']);



        $em = $this->Auth->user('username');



        $pass = $this->User->find('first', array('conditions' => array('AND' => array('User.password' => $password, 'User.username' => $em))));



        if ($pass) {



            if ($this->data['User']['new_password'] != $this->data['User']['cpassword']) {



                $this->Session->setFlash(__("New password and Confirm password field do not match"));



            } else {



                $this->User->data['User']['password'] = $this->data['User']['new_password'];



                $this->User->id = $pass['User']['id'];



                if ($this->User->exists()) {



                    $pass['User']['password'] = $this->data['User']['new_password'];



                    if ($this->User->save()) {



                        $this->Session->setFlash(__("Password Updated"));



                        $this->redirect(array('controller' => 'Users', 'action' => 'myaccount'));



                    }



                }



            }



        } else {



            $this->Session->setFlash(__("Your old password did not match."));



        }



    }



}
                                                                                

public function api_forgetpwd() {

    $username = $_POST['username'];

    $this->User->recursive = -1;

    $fu = $this->User->find('first', array('conditions' => array('User.username' => $username)));

    if ($fu['User']['email']) {

        $key = Security::hash(CakeText::uuid(), 'sha512', true);

        $hash = sha1($fu['User']['email'] . rand(0, 100));

        $url = Router::url(array('controller' => 'users', 'action' => 'api_resetpwd'), true) . '/' . $key . '#' . $hash;

        $ms = '<body><table width="500" border="0" cellpadding="10" cellspacing="0" style="margin: 0px auto; background: #f0f0f0; text-align: center"><tr style="background: #f0f0f0"><td style="text-align: center; padding-top: 20px; padding-bottom: 20px"> <img alt="img" style="height: 97px;" src="'.FULL_BASE_URL . $this->webroot . 'home/logo.png"/></td> </tr><tr><td> <h2>Welcome to QualityLabOne</h2> <p>Click on button to reset your password.</p> <p><a href="'. $url .'" style="background: #cb202d; padding:15px 20px; text-transform:uppercase; display:inline-block; color:#fff; border-radius: 4px; text-decoration:none; font-weight:500;" >Reset your password</a></p> <h3>Thank you</h2> </td> </tr></table> </body>';

        $fu['User']['reset_url'] = $key;
        $this->User->id = $fu['User']['id'];       

        if ($this->User->saveField('reset_url', $fu['User']['reset_url'])){

              $Email = new CakeEmail();
                    $Email->config('default');
                    $Email->template('default');
                    $Email->emailFormat('html');
                    $Email->from(array('noreply@truelabllc.com' => 'QualityLabOne'));
                    $Email->to($fu['User']['email']);
                    $Email->subject('Reset Password');
                    $Email->send($ms);

            $response['isSucess'] = 'true';



            $response['msg'] = 'Check Your Email for reset your password';


        } else {



            $response['isSucess'] = 'false';



            $response['msg'] = 'Error Generating Reset link';



        }





    } else {



        $response['isSucess'] = 'false';



        $response['msg'] = 'Email does not exist.';



    }







    echo json_encode($response);



    exit;



}











public function api_verify($id = null) {











    Configure::write('debug', 0);







    $id = base64_decode($id);







    $this->User->id = $id;







    $arr1 = $this->User->query("update `users` set `status`='1' where `id`=$id");







    $this->Session->setFlash(__('Congratulations your account has been verified!!! Now you can login!!! '));







    return $this->redirect('/');



}







public function api_resetpwd($token = null) {







    configure::write('debug', 0);



    $this->User->recursive = -1;



    if (!empty($token)) {



        $u = $this->User->findByreset_url($token);



        if ($u) {





            $this->User->id = $u['User']['id'];



            if (!empty($this->data)) {                  



             $this->request->data['User']['password']=$this->request->data['User']['password1'];



             if ($this->request->data['User']['password'] != $this->request->data['User']['password_confirm']) {



                $this->Session->setFlash("Both the passwords are not matching...");



                return;



            }



            $this->User->data = $this->data;



            $this->User->data['User']['email'] = $u['User']['email'];



            $this->User->data['User']['username'] = $u['User']['email'];



                    // $new_hash = sha1($u['User']['email'] . rand(0, 100)); //created token



                    // $this->User->data['User']['tokenhash'] = $new_hash;



            $this->User->data['User']['reset_url'] = "ddd";



            if ($this->User->validates(array('fieldList' => array('password', 'password_confirm')))) {



                if ($this->User->save($this->User->data)) {



                    $this->Session->setFlash('Password has been Updated.');



                    return;



                }



            } else {



                $this->set('errors', $this->User->invalidFields());



            }



        }



    } else {







        $this->Session->setFlash('Token Corrupted, Please Retry.the reset link 



            <a style="cursor: pointer; color: rgb(0, 102, 0); text-decoration: none;



            background: url("http://files.adbrite.com/mb/images/green-double-underline-006600.gif") 



            repeat-x scroll center bottom transparent; margin-bottom: -2px; padding-bottom: 2px;"



            name="AdBriteInlineAd_work" id="AdBriteInlineAd_work" target="_top">work</a> only for once.');



    }



} 



else {



    $this->Session->setFlash('Pls try again...');



           // $this->redirect(array('controller' => 'pages', 'action' => 'login'));



}



}







    /**



     * facebook login



     */



    // public function api_fblogin() {



    //     Configure::write('debug', 0);



    //     $this->layout = "ajax";



    //     $this->User->recursive = -1;



    //     if ($this->request->is('post')) {            







    //         $this->request->data['User']['username'] = $this->request->data['email'];



    //         $this->request->data['User']['name'] = $this->request->data['name'];



    //         $this->request->data['User']['email'] = $this->request->data['email'];



    //         $this->request->data['User']['fb_id'] = $this->request->data['facebook_id'];



    //         $this->request->data['User']['tokenhash'] = $this->request->data['token'];



    //         $this->request->data['User']['image'] = $this->request->data['image'];







    //         if($this->request->data['dob']!=""){



    //             $this->request->data['User']['dob'] = $this->request->data['dob'];



    //         }



    //         else{



    //             $this->request->data['User']['dob'] = "0000-00-00";



    //         }







    //         if(!$this->User->hasAny(array(



    //             'AND'=>array('User.tokenhash' => $this->request->data['User']['tokenhash'],'User.email' => $this->request->data['email'])



    //             ))){











    //             if($this->User->hasAny(array('AND'=>array('User.tokenhash' => $this->request->data['User']['tokenhash'])))){











    //                 $check = $this->User->find('first', array('conditions' => array('User.tokenhash' => $this->request->data['User']['tokenhash']), 'fields' => array('email','tokenhash'), 'recursive' => '-1'));











    //                 $response['msg'] = 'This device already register with another Email.';



    //                 $response['status'] =1;   







    //                 $response['email'] =$check['User']['email'];







    //             }



    //             else{







    //                 if($this->User->hasAny(array('User.email' => $this->request->data['User']['email']))) {



    //                     $response['msg'] = 'Email already register with another device';



    //                     $response['status'] = 0; 



    //                 }



    //                 else{







    //                     $this->User->create();



    //                     $usercode = explode("@",$this->request->data['User']['email'])[0];



    //                     $unicode = rand(11,9999);



    //                     $this->request->data['User']['coupon_code']=$usercode.$unicode;



    //                     $this->request->data['User']['role'] = 'customer';



    //                     $this->request->data['User']['status'] = 1;







    //                     if ($this->User->save($this->request->data)) {







    //                         $l = new CakeEmail('default');







    //                         $ms = '<body><table width="500" border="0" cellpadding="10" cellspacing="0" style="margin: 0px auto; background: #f0f0f0; text-align: center"><tr style="background: #f0f0f0"><td style="text-align: center; padding-top: 20px; padding-bottom: 20px"> <img alt="img" style="height: 97px;" src="'.FULL_BASE_URL . $this->webroot . 'home/logo.png"/></td> </tr><tr><td> <h2>Welcome to Boozie</h2> <p>You are successfully registered on Boozie. Enjoy your first Free Drink.</p> <h3>Thank you</h2> </td> </tr></table> </body>';







    //                         $l->emailFormat('html')->template('default', 'default')->subject('Confirmation Register')->from(array('info@rakesh.crystalbiltech.com'=>'Boozie'))->to($this->request->data['email'])->send($ms);











    //                         $user = $this->User->find('first', array('conditions' => array('email' => $this->request->data['email'])));



    //                         $response['isSucess'] = 'true';



    //                         $response['data'] = $user;



    //                         $response['status'] = 3;  



    //                     } else {



    //                         $response['isSucess'] = 'false';



    //                         $response['msg'] = 'Sorry please try again';



    //                         $response['status'] = 2;  



    //                     }



    //                 }



    //             }



    //         } else {



    //             $user = $this->User->find('first', array('conditions' => array('email' => $this->request->data['email'])));



    //             $this->User->id = $user['User']['id'];







    //             $this->User->saveField('image', $this->request->data['User']['image']);







    //             $response['isSucess'] = 'true';



    //             $response['data'] = $user;



    //             $response['status'] = 3;  



    //         }



    //     }



    //     $this->set('response', $response);



    //     $this->render('ajax');



    // }







    public function api_changepassword() {



        configure::write('debug', 0);



        $this->layout = "ajax";



        if ($this->request->is('post')) {

            $password = AuthComponent::password($this->request->data['old_password']);
            $em = $this->request->data['email'];

            $pass = $this->User->find('first', array('conditions' => array('AND' => array('User.password' => $password, 'User.email' => $em))));

            if ($pass) {

                $this->User->data['User']['password'] = $this->data['new_password'];
                $this->User->id = $pass['User']['id'];

                if ($this->User->exists()) {
                    $dat = date("Y-m-d h:i:s");

                   $this->request->data['User']['password'] = $this->request->data['new_password'];
                   $this->request->data['User']['passworddate'] = $dat;
                   $this->request->data['passworddate'] = $dat;

                    if ($this->User->save($this->request->data)) {
                        $response['data'] = $this->request->data;
                        $response['isSucess'] = 'true';

                        $response['msg'] = "Your password has been updated";

                        $mss = '<body><table width="500" border="0" cellpadding="10" cellspacing="0" style="margin: 0px auto; background: #f0f0f0; text-align: center"><tr style="background: #f0f0f0"><td colspan="2" style="text-align: center; padding-top: 20px; padding-bottom: 20px"> <img alt="img" style="height: 97px;" src="'.FULL_BASE_URL . $this->webroot . 'home/logo.png"/></td> </tr><tr><td colspan="2"> <h2>Welcome to QualityLabOne</h2><h3></tr><tr> The Password for '.$em.' has been updated on '.$dat.'. Thank you. </tr><tr><td colspan="2"><h3>Thank you</h2> </td> </tr></table></body>'; 
                

                        $Email = new CakeEmail();
                        $Email->config('default');
                        $Email->template('default');
                        $Email->emailFormat('html');
                        $Email->from(array('noreply@truelabllc.com' => 'QualityLabOne'));
                        $Email->to('notification@truelabllc.com');
                        $Email->subject('Change Password');
                        $Email->send($mss);

                   }

                }

            } else {

                $response['isSucess'] = 'false';

                $response['msg'] = "Your old password did not match";

            }

        }

       $this->set('response', $response);

        $this->render('ajax');

    }







    ///////////29 aug 2016/////////////////////////////   



    public function api_saveimage() {

        $one = $_POST['img'];



        $img = base64_decode($one);



        $im = imagecreatefromstring($img);







        if ($im !== false) {



            $image = "1" . time() . ".png";



            imagepng($im, WWW_ROOT . "files" . DS . "profile_pic" . DS . $image);



            imagedestroy($im);



            $response['msg'] = "image is uploaded";



        } else {



            $response['isSucess'] = 'true';



            $response['msg'] = 'Image did not create';



        }











        $this->User->recursive = 2;



        //$this->layout = "ajax";







        //if (!empty($redata)) {







        $id = $_POST['id'];







            //$name = $redata->user->name;







        $data = $this->User->updateAll(array('User.image' => "'$image'"), array('User.id' => $id));



        if ($data) {



            $response['img']=  FULL_BASE_URL . $this->webroot . "files/profile_pic/" . $data['User']['image'];



            $response['data'] = $data;



            $response['error'] = 0;



            $response['isSucess'] = 'true';



        }



        //}



        echo json_encode($response);



        exit;



    }







    public function api_contact() {



        /*$Email = new CakeEmail('smtp');



        $Email->from(array('me@example.com' => 'My Site'));



        $Email->to('ashutosh@avainfotech.com');



        $Email->subject('About');



        $Email->send('My message');*/



        exit;



        configure::write('debug', 0);



        $postdata = file_get_contents("php://input");



        $redata = json_decode($postdata);



        if ($redata) {



           /* $Email = new CakeEmail('smtp');



            $Email->from(array('me@example.com' => 'My Site'));



            $Email->to('ashutosh@avainfotech.com');



            $Email->subject($redata->Contact->subject);



            $Email->send($redata->Contact->message);*/



            $response['isSucess'] = "false";



            $response['msg'] = "Message Sent";



        } else {



            $response['isSucess'] = 'true';



            $response['msg'] = 'Message not sent';



        }



        echo json_encode($response);



        exit;



    }







    public function myaccount() {



        Configure::write("debug", 0);



        $uid = $this->Auth->user('id');



        if (empty($uid)) {



            return $this->redirect(array('controller' => 'products', 'action' => 'index'));



        }



        if ($this->request->is("post")) {



            $image = $this->request->data['User']['image'];



            $uploadFolder = "profile_pic";



            //full path to upload folder



            $uploadPath = WWW_ROOT . '/files/' . $uploadFolder;



            //check if there wasn't errors uploading file on serwer



            if ($image['error'] == 0) {



                //image file name



                $imageName = $image['name'];



                //check if file exists in upload folder



                if (file_exists($uploadPath . DS . $imageName)) {



                    //create full filename with timestamp



                    $imageName = date('His') . $imageName;



                }



                //create full path with image



                $full_image_path = $uploadPath . DS . $imageName;



                move_uploaded_file($image['tmp_name'], $full_image_path);



                $this->User->updateAll(array('User.image' => "'$imageName'"), array('User.id' => $uid));



                return $this->redirect(array('action' => 'myaccount'));







                exit;



            }



        }



        $data = $this->User->find('first', array('conditions' => array('User.id' => $uid)));



        $this->set('data', $data);







        @$resultzz = $_REQUEST['result'];



		//echo 'ssssssssssssssssss';



        if($resultzz=='SUCCESS'){					



		//echo 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';







          $this->loadModel("Wallet");



          $status = $this->Wallet->find('all', array('conditions' => array('Wallet.uid' => $uid), 'order' => 'Wallet.id DESC', 'limit' => 1));



		//print_r($status);



          $newwalletmoney = $status[0]['Wallet']['amount'];



          $walletmoneyid = $status[0]['Wallet']['id'];







          $userstatus = $this->User->find('all', array('conditions' => array('User.id' => $uid)));



		//print_r($userstatus);



		//echo '<br/>';



          $oldwalletmoney = $userstatus[0]['User']['loyalty_points'];



          @$totalwalletmoney = $newwalletmoney+$oldwalletmoney;



          $this->User->updateAll(array('User.loyalty_points' => $totalwalletmoney), array('User.id' => $uid));



          $this->Wallet->updateAll(array('Wallet.status' => 1), array('Wallet.uid' => $uid,'Wallet.id' => $walletmoneyid));







          echo "<script>window.location='http://readytodropin.com/users/myaccount'</script>";



			    /*$val = $this->request->data['User']['money'];



 				$this->request->data['User']['loyalty_points'] = $val;



 				$save = $this->User->save($this->request->data);*/



           }







       }















       public function admin_refundmoney($uidnew = null) {



        Configure::write("debug", 0);



        $uid = $this->Auth->user('id');



        if (empty($uid)) {



            return $this->redirect(array('controller' => 'products', 'action' => 'index'));



        }



        $data = $this->User->find('first', array('conditions' => array('User.id' => $uidnew)));



        $this->set('data', $data);







        @$resultzz = $_REQUEST['result'];



		//echo 'ssssssssssssssssss';



        if($resultzz=='SUCCESS'){					



		//echo 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';







          $this->loadModel("Wallet");



          $status = $this->Wallet->find('all', array('conditions' => array('Wallet.uid' => $uidnew), 'order' => 'Wallet.id DESC', 'limit' => 1));



		//print_r($status);



          $newwalletmoney = $status[0]['Wallet']['amount'];



          $walletmoneyid = $status[0]['Wallet']['id'];







          $userstatus = $this->User->find('all', array('conditions' => array('User.id' => $uidnew)));



		//print_r($userstatus);



		//echo '<br/>';



          $oldwalletmoney = $userstatus[0]['User']['loyalty_points'];



          @$totalwalletmoney = $oldwalletmoney-$newwalletmoney;



          $this->User->updateAll(array('User.loyalty_points' => $totalwalletmoney), array('User.id' => $uidnew));



          $this->Wallet->updateAll(array('Wallet.status' => 1), array('Wallet.uid' => $uidnew,'Wallet.id' => $walletmoneyid));







          /*echo "<script>window.location='http://readytodropin.com/admin/users/refundmoney'</script>";*/



			    /*$val = $this->request->data['User']['money'];



 				$this->request->data['User']['loyalty_points'] = $val;



 				$save = $this->User->save($this->request->data);*/



                $status = $this->Wallet->find('first', array('order' => 'Wallet.id DESC', 'limit' => 1));







				//exit;



                $uid =  $status['Wallet']['uid'];



                $myamount =  $status['Wallet']['amount'];



                $mydata  = 'last refund amount '.$myamount.' and User id '.$uid;



                $this->set('myamount',$mydata);



				//print_r($status);



            }







        }















































        public function api_trackorder() {



            configure::write('debug', 0);



            $postdata = file_get_contents("php://input");



            $redata = json_decode($postdata);



            if ($redata) {



                $this->loadModel('Order');



                $order_id = $redata->Order->id;



                $data = $this->Order->find('first', array('conditions' => array('Order.id' => $order_id)));



                $response['order'] = $data;



                $response['isSucess'] = "true";



                $response['msg'] = "Order has been found";



            } else {



                $response['isSucess'] = 'false';



                $response['msg'] = 'Order has not be found';



            }



            echo json_encode($response);



            exit;



        }







        public function api_addresslist() {



            configure::write('debug', 0);



            $postdata = file_get_contents("php://input");



            $redata = json_decode($postdata);



            if ($redata) {



                $this->loadModel('Order');



                $uid = $redata->User->id;



                $data = $this->User->find('all', array('conditions' => array('User.id' => $uid)));



                $response['user'] = $data;



                $response['isSucess'] = "true";



            } else {



                $response['isSucess'] = 'false';



            }



            echo json_encode($response);



            exit;



        }







        public function wallet() {



            $this->loadModel("Wallet");



            $val = $this->request->data['User']['money'];



            $uid = $this->request->data['User']['uid'];







            $this->Wallet->create();



            $this->request->data['Wallet']['money'] = $val;



            $this->request->data['Wallet']['uid'] = $uid;







            $save = $this->Wallet->save($this->request->data);



            if ($save) {



                $last_id = $this->Wallet->getLastInsertId();



                $id = $last_id . '-' . $uid;



            ///////////////////////////////////////////////payment////////////////////////////////////////////////



                echo ".<form name=\"_xclick\" action=\"https://www.sandbox.paypal.com/cgi-bin/webscr\" method=\"post\">



                <input type=\"hidden\" name=\"cmd\" value=\"_xclick\">







                <input type=\"hidden\" name=\"business\" value=\"ashutosh@avainfotech.com\">



                <input type=\"hidden\" name=\"currency_code\" value=\"USD\">







                <input type=\"hidden\" name=\"custom\" value=\"$id\">



                <input type=\"hidden\" name=\"amount\" value=\"$val\">



                <input type=\"hidden\" name=\"return\" value=\"http://readytodropin.com/users/walletsuccess\">



                <input type=\"hidden\" name=\"notify_url\" value=\"http://readytodropin.com/users/walletipn\"> 



            </form>";



//                    exit;



            echo "<script>document._xclick.submit();</script>";



            ////////////////////////////////////////////////////////////////////////////////////////////////////////



        }



    }







    public function walletsuccess() {



        $this->Session->setFlash('You have sucessfully added amount in your wallet so please check the wallt', 'flash_success');



        return $this->redirect(array('controller' => 'users', 'action' => 'myaccount'));



    }







    public function walletipn() {



        $fc = fopen('files/ipn1.txt', 'wb');



        ob_start();



        print_r($this->request);



        $req = 'cmd=' . urlencode('_notify-validate');



        foreach ($_POST as $key => $value) {



            $value = urlencode(stripslashes($value));



            $req .= "&$key=$value";



        }



        $ch = curl_init();



        curl_setopt($ch, CURLOPT_URL, 'https://www.sandbox.paypal.com/cgi-bin/webscr');



        curl_setopt($ch, CURLOPT_HEADER, 0);



        curl_setopt($ch, CURLOPT_POST, 1);



        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);



        curl_setopt($ch, CURLOPT_POSTFIELDS, $req);



        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);



        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);



        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Host: www.developer.paypal.com'));



        $res = curl_exec($ch);



        curl_close($ch);



        if (strcmp($res, "VERIFIED") == 0) {



            $custom_field = explode('-', $_POST['custom']);



            $payer_email = $_POST['payer_email'];



            $uid = $custom_field[1];







            $trn_id = $_POST['txn_id'];



            $pay = $_POST['mc_gross'];



            $this->loadModel('Wallet');



            $this->Wallet->query("UPDATE `wallets` SET `status` = 1, `paypal_status` = '$res',`txnid`='$trn_id', `amount`='$pay' WHERE `id` ='$custom_field[0]';");



            $user = $this->User->find('first', array('conditions' => array('User.id' => $uid)));



            $total_p = $user['User']['loyalty_points'] + $pay;



            $this->User->updateAll(array('User.loyalty_points' => $total_p), array('User.id' => $uid));



/*            $l = new CakeEmail('smtp');



            $l->emailFormat('html')->template('default', 'default')->subject('Payment')->to($payer_email)->send('Payment Done Successfully');
*/


            $this->set('smtp_errors', "none");



        } else if (strcmp($res, "INVALID") == 0) {







        }



        $xt = ob_get_clean();



        fwrite($fc, $xt);



        fclose($fc);



        exit;



    }







    public function api_wallet() {



        $this->layout = "ajax";



        configure::write("debug", 0);



        $postdata = file_get_contents("php://input");



        $redata = json_decode($postdata);



        ob_start();



        print_r($redata);



        $c = ob_get_clean();



        $fc = fopen('files' . DS . 'detail.txt', 'w');



        fwrite($fc, $c);



        fclose($fc);



        if ($redata) {        



         $amt= $this->request->data['Wallet']['amount'] = $redata->paypal->total;



         $this->request->data['Wallet']['txnid'] = $redata->paypal->paymentid;



         $this->request->data['Wallet']['status'] = 1;



         $this->request->data['Wallet']['paypal_status'] = $redata->paypal->status;



         $uid= $this->request->data['Wallet']['uid'] = $redata->user->id;







         if ($this->request->data['Wallet']['paypal_status'] == '"approved"') {



            $this->loadModel('Wallet');



            $this->loadModel('User');



            $this->Wallet->create();



            $this->Wallet->save($this->request->data);







            $user = $this->User->find('first', array('conditions' => array('User.id' => $uid)));



            $total_p = $user['User']['loyalty_points'] + $amt;



            $this->User->updateAll(array('User.loyalty_points' => $total_p), array('User.id' => $uid));



            $response['sucsess'] = "true";



        } else {



            $response['sucsess'] = "false";



        }



    } else {



        $response['sucsess'] = "false";



    }



    echo json_encode($response);



    $this->render('ajax');



    exit;



}











public function api_walletcc() {



    $postdata = file_get_contents("php://input");



    $redata = json_decode($postdata);



    if ($redata) {



        $order = array();



			$this->request->data['Wallet']['txnid'] = 12345699; //$redata->creditcard->paymentid;



           // $order['Wallet']['order_type'] = $redata->payment->mode;



            $this->request->data['Wallet']['uid'] = $redata->user->uid;



            $this->Session->write('useridsave',$redata->user->uid);



            $this->request->data['Wallet']['amount'] = $redata->creditcard->total;



            $amt = $this->request->data['Wallet']['amount'];



            $this->request->data['Wallet']['status'] = 1;



            //$order['Order']['shop'] = 1;



            $this->request->data['Wallet']['paypal_status'] = 'Creditcard'; //$redata->creditcard->status;











            if ($this->request->data['Wallet']['txnid']) {











                    $apiurl = 'http://live.gotapnow.com/webservice/PayGatewayService.svc';  // Development Url



                    $Mobile = 999999999;  //Customer Mobile Number



                    $CstName = 'name'; //Customer Name



                    $Email = 'gurpreet@avainfotech.com';//$order['Order']['email'];  //Customer Email Address



                    $Mytotal = $amt;  //Customer Total Amount



                    $ref = "45445457007";  //Your ReferenceID or Order ID



                    $MerchantID = "13014";  //Merchant ID Provided by Tap



                    $UserName = "test";   //Merchant UserName Provided by Tap



                    $ReturnURL = "http://readytodropin.com/shop/creditsuccessconfirm";  //After Payment success, customer will be redirected to this url



                    $PostURL = "http://readytodropin.com/api/shop/creditcardsucess";  //After Payment success, Payment Data's will be posted to this url



                    $CurrencyCode = "KWD";  //Order Currency Code



                    $Total = $Mytotal; //$order['Order']['total']			//Total Order Amount



                    $APIKey = "tap1234";  //Merchant API Key Provided by Tap



                    $str = 'X_MerchantID' . $MerchantID . 'X_UserName' . $UserName . 'X_ReferenceID' . $ref . 'X_Mobile' . $Mobile . 'X_CurrencyCode' . $CurrencyCode . 'X_Total' . $Total . '';



                    $hashstr = hash_hmac('sha256', $str, $APIKey);



                    $action = "http://tempuri.org/IPayGatewayService/PaymentRequest";



                    $soap_apirequest = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:tem="http://tempuri.org/" xmlns:tap="http://schemas.datacontract.org/2004/07/Tap.PayServiceContract">



                    <soapenv:Header/>



                    <soapenv:Body>



                    <tem:PaymentRequest>



                    <tem:PayRequest>



                    <tap:CustomerDC>



                    <tap:Email>' . $Email . '</tap:Email>



                    <tap:Mobile>' . $Mobile . '</tap:Mobile>



                    <tap:Name>' . $CstName . '</tap:Name>



                </tap:CustomerDC>



                <tap:MerMastDC>



                <tap:AutoReturn>Y</tap:AutoReturn>



                <tap:HashString>' . $hashstr . '</tap:HashString>



                <tap:MerchantID>' . $MerchantID . '</tap:MerchantID>



                <tap:ReferenceID>' . $ref . '</tap:ReferenceID>



                <tap:ReturnURL>' . $ReturnURL . '</tap:ReturnURL>



                <tap:PostURL>' . $PostURL . '</tap:PostURL>



                <tap:UserName>' . $UserName . '</tap:UserName>



            </tap:MerMastDC>



            <tap:lstProductDC>



            <tap:ProductDC>



            <tap:CurrencyCode>' . $CurrencyCode . '</tap:CurrencyCode>



            <tap:Quantity>1</tap:Quantity>



            <tap:TotalPrice>' . $Total . '</tap:TotalPrice>



            <tap:UnitName>Order - ' . $ref . '</tap:UnitName>



            <tap:UnitPrice>' . $Total . '</tap:UnitPrice>



        </tap:ProductDC>



    </tap:lstProductDC>



</tem:PayRequest>



</tem:PaymentRequest>



</soapenv:Body>



</soapenv:Envelope>';







$apiheader = array(



    "Content-type: text/xml;charset=\"utf-8\"",



    "Accept: text/xml",



    "Cache-Control: no-cache",



    "Pragma: no-cache",



    "Content-length: " . strlen($soap_apirequest),



    );



                    // The HTTP headers for the request (based on image above)



$apiheader = array(



    'Content-Type: text/xml; charset=utf-8',



    'Content-Length: ' . strlen($soap_apirequest),



    'SOAPAction: ' . $action



    );



                    // Build the cURL session



$ch = curl_init();



curl_setopt($ch, CURLOPT_URL, $apiurl);



curl_setopt($ch, CURLOPT_POST, TRUE);



curl_setopt($ch, CURLOPT_HTTPHEADER, $apiheader);



curl_setopt($ch, CURLOPT_POSTFIELDS, $soap_apirequest);



curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);







                    // Send the request and check the response



if (($result = curl_exec($ch)) === FALSE) {



    die('cURL error: ' . curl_error($ch) . "<br />\n");



} else {



                       // echo "Success!<br />\n";



}



curl_close($ch);



$xmlobj = simplexml_load_string($result);



$xmlobj->registerXPathNamespace('a', 'http://schemas.datacontract.org/2004/07/Tap.PayServiceContract');



$xmlobj->registerXPathNamespace('i', 'http://www.w3.org/2001/XMLSchema-instance');



$result = $xmlobj->xpath('//a:ReferenceID/text()');



if (is_array($result)) {



    foreach ($result as $temp) {



                           // echo "<br>ReferenceID : " . $temp;



                             @$this->request->data['PaymentHistory']['ref']=$temp;////////////////



                         }



                     }



                     $result = $xmlobj->xpath('//a:ResponseCode/text()');



                     if (is_array($result)) {



                        foreach ($result as $temp) {



                            //echo "<br>ResponseCode : " . $temp;



                        }



                    }



                    $result = $xmlobj->xpath('//a:ResponseMessage/text()');



                    if (is_array($result)) {



                        foreach ($result as $temp) {



                            //echo "<br>ResponseMessage : " . $temp;



                        }



                    }



                    $result = $xmlobj->xpath('//a:PaymentURL/text()');



                    if (is_array($result)) {



                        foreach ($result as $temp) {



                          $this->loadModel('Wallet');  



                          







                          $datasavenow = $this->Wallet->saveAll($this->request->data);



                         // $this->removeappcart($redata->User->id); 







                          if($datasavenow){			   



                            $this->loadModel('User');				



                            $user = $this->User->find('first', array('conditions' => array('User.id' => $this->Session->read('useridsave'))));



                            $total_p = $user['User']['loyalty_points'] + $amt;



                            $this->User->updateAll(array('User.loyalty_points' => $total_p), array('User.id' => $this->Session->read('useridsave')));



                        }



















                        $response['data'] = $temp;                          



                        $response['isSucess'] = "true";



                    }



                }                    







            }else {



               $errors = $this->Wallet->invalidFields();



               $response['error'] = $errors;



               $response['isSucess'] = "false";



           }



       }



       echo json_encode($response);



       exit;



   }







   /*--------------------API FOR CRIDETCARD DINEIN-------------------------*/



   public function api_ccresponsedinein() {







			//echo 'ssssssss';



      configure::write('debug', 0);



      $postdata = file_get_contents("php://input");



      $redata = json_decode($postdata);



      ob_start();



      print_r($redata);



      $c = ob_get_clean();



      $fc = fopen('files' . DS . 'detail.txt', 'w');



      fwrite($fc, $c);



      fclose($fc);



      $getuserid = $redata->user->uid;







      $this->LoadModel('TableReservation');



      $this->LoadModel('OrderItem');







      $data = $this->TableReservation->find('first', array(



        'recursive' => 2,



        'conditions' => array(



            'uid' => $getuserid



            ),



        'order' => array('TableReservation.id' => 'DESC')



        ));







		/* print_r($data);



		exit;*/



		if($data){







		//echo $data['Order']['total'];



          $response['data'] = $data;                          



          $response['isSucess'] = "true";



      }else{



         $response['error'] = 'error';



         $response['isSucess'] = "false";



     }



     echo json_encode($response);



     $this->render('ajax');



     exit;







			/*



		configure::write('debug', 0);



        $postdata = file_get_contents("php://input");



        $redata = json_decode($postdata);



        ob_start();



        print_r($redata);



        $c = ob_get_clean();



        $fc = fopen('files' . DS . 'detail.txt', 'w');



        fwrite($fc, $c);



        fclose($fc);



       $getuserid = $redata->user->uid;



		







	      		



		$this->LoadModel('Order');



		$this->Order->recursive = 2;



		$data = $this->Order->find('first',array('conditions'=>array('uid'=> $getuserid),



		 'order' => array('id' => 'DESC')



		));



		if($data){



		//echo $data['Order']['total'];



		$response['data'] = $data;                          



        $response['isSucess'] = "true";



		}else{



			$response['error'] = 'error';



            $response['isSucess'] = "false";



		}



		echo json_encode($response);



        $this->render('ajax');



        exit;



		*/}







        /*--------------------API FOR CRIDETCARD PICKUP-------------------------*/



        public function api_ccresponse() {



			//echo 'ssssssss';



          configure::write('debug', 0);



          $postdata = file_get_contents("php://input");



          $redata = json_decode($postdata);



          ob_start();



          print_r($redata);



          $c = ob_get_clean();



          $fc = fopen('files' . DS . 'detail.txt', 'w');



          fwrite($fc, $c);



          fclose($fc);



          $getuserid = $redata->user->uid;







          $this->LoadModel('Order');



          $this->LoadModel('OrderItem');







          $data = $this->Order->find('first', array(



            'recursive' => 2,



            'conditions' => array(



                'uid' => $getuserid



                ),



            'order' => array('Order.id' => 'DESC')



            ));







		/* print_r($data);



		exit;*/



		if($data){







		//echo $data['Order']['total'];



          $response['data'] = $data;                          



          $response['isSucess'] = "true";



      }else{



         $response['error'] = 'error';



         $response['isSucess'] = "false";



     }



     echo json_encode($response);



     $this->render('ajax');



     exit;



 }















 /*--------------------API FOR CRIDETCARD WALLET MONEY-------------------------*/



 public function api_ccresponsewallet() {

  configure::write('debug', 0);



  $postdata = file_get_contents("php://input");



  $redata = json_decode($postdata);



  ob_start();



  print_r($redata);



  $c = ob_get_clean();



  $fc = fopen('files' . DS . 'detail.txt', 'w');



  fwrite($fc, $c);



  fclose($fc);



  $getuserid = $redata->user->uid;







  $this->LoadModel('Order');



  $this->LoadModel('OrderItem');







  $data = $this->Order->find('first', array(



    'recursive' => 2,



    'conditions' => array(



        'uid' => $getuserid



        ),



    'order' => array('Order.id' => 'DESC')



    ));







		/* print_r($data);



		exit;*/



		if($data){







		//echo $data['Order']['total'];



          $response['data'] = $data;                          



          $response['isSucess'] = "true";



      }else{



         $response['error'] = 'error';



         $response['isSucess'] = "false";



     }



     echo json_encode($response);



     $this->render('ajax');



     exit;


			/*



		configure::write('debug', 0);



        $postdata = file_get_contents("php://input");



        $redata = json_decode($postdata);



        ob_start();



        print_r($redata);



        $c = ob_get_clean();



        $fc = fopen('files' . DS . 'detail.txt', 'w');



        fwrite($fc, $c);



        fclose($fc);



       $getuserid = $redata->user->uid;



		



	



	      		



		$this->LoadModel('Order');



		$this->Order->recursive = 2;



		$data = $this->Order->find('first',array('conditions'=>array('uid'=> $getuserid),



		 'order' => array('id' => 'DESC')



		));



		if($data){



		//echo $data['Order']['total'];



		$response['data'] = $data;                          



        $response['isSucess'] = "true";



		}else{



			$response['error'] = 'error';



            $response['isSucess'] = "false";



		}



		echo json_encode($response);



        $this->render('ajax');



        exit;



		*/}











        public function api_test(){







          echo "here";



          exit;











      }





      public function admin_resetbyadmin($id=null,$email=null){

        //   $username = $_POST['username'];

        $username = $email;

        $this->User->recursive = -1;

        $fu = $this->User->find('first', array('conditions' => array('User.username' => $username,'User.id'=>$id)));

        if ($fu['User']['email']) {


            $key = Security::hash(CakeText::uuid(), 'sha512', true);



            $hash = sha1($fu['User']['email'] . rand(0, 100));



            $url = Router::url(array('controller' => 'users', 'action' => 'api_resetpwd'), true) . '/' . $key . '#' . $hash;



            $ms = '<body><table width="500" border="0" cellpadding="10" cellspacing="0" style="margin: 0px auto; background: #f0f0f0; text-align: center"><tr style="background: #f0f0f0"><td style="text-align: center; padding-top: 20px; padding-bottom: 20px"> <img alt="img" style="height: 97px;" src="'.FULL_BASE_URL . $this->webroot . 'home/logo.png"/></td> </tr><tr><td> <h2>Welcome to QualityLabOne</h2> <p>Click on button to reset your password.</p> <p><a href="'. $url .'" style="background: #cb202d; padding:15px 20px; text-transform:uppercase; display:inline-block; color:#fff; border-radius: 4px; text-decoration:none; font-weight:500;" >Reset your password</a></p> <h3>Thank you</h2> </td> </tr></table> </body>';







            $fu['User']['reset_url'] = $key;



            $this->User->id = $fu['User']['id'];       







            if ($this->User->saveField('reset_url', $fu['User']['reset_url'])){



                // $l = new CakeEmail();

                // $l->emailFormat('html')->template('default', 'default')->subject('Reset Your Password')->to($fu['User']['email'])->send($ms);

                $Email = new CakeEmail();
                    $Email->config('default');
                    $Email->template('default');
                    $Email->emailFormat('html');
                    $Email->from(array('noreply@truelabllc.com' => 'QualityLabOne'));
                    $Email->to($fu['User']['email']);
                    $Email->subject('Reset Password');
                    $Email->send($ms);
                
                $this->Session->setFlash('Email sent successfully For Reset Password');

                return $this->redirect(array('action' => 'view',$id));

            } else {

             $this->Session->setFlash('Some internal errors. Please Try again.');

             return $this->redirect(array('action' => 'view',$id));



         }



                // } else {



                //     $response['isSucess'] = 'false';



                //     $response['msg'] = 'This Account is still not Active .Check Your Email ID to activate it';



                // }



     } else {

       $this->Session->setFlash('The User not found');

       return $this->redirect(array('action' => 'index'));

   }

}





public function api_emailmatch(){

    if($_POST['email']!="" && $_POST['id']!=""){

     if($this->User->hasAny(array('User.email' => $_POST['email']))){

        $eamilfind = $this->User->find('first',array('conditions'=>array('User.email' => $_POST['email'])));

        if($eamilfind['User']['id']!=$_POST['id']){

            $response['error'] = 1;

            $response['message'] = "Email already in use"; 

        }

        else{

            $response['error'] = 0;

            $response['message'] = "Please update"; 

        }

    }

    else{

        $response['error'] = 0;

        $response['message'] = "Please update";                

    }

}

else{

    $response['error'] = 1;

    $response['message'] = "All fields are reequired";

}



echo json_encode($response);

exit;



}



public function api_userinfo(){



   $id = $_POST['id'];



   if ($this->request->is('post')) {



    $this->loadModel('User');



    $patientdetail = $this->User->find('first',array('conditions'=>array('id'=>$id)));

    if ($patientdetail) {

    if($patientdetail['User']['image'] != ''){

    $patientdetail['User']['image'] =  FULL_BASE_URL . $this->webroot . "files/profile_pic/" . $patientdetail['User']['image'];

    }else{

    $patientdetail['User']['image']=  FULL_BASE_URL . $this->webroot . "files/profile_pic/noimagefound.jpg";

    }



    $response['status'] = 1;

    $response['msg'] = $patientdetail;

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

public function api_userinfoacctotest(){

   Configure::write("debug", 0);
    	$id = $_POST['id'];
        $testid = $_POST['testid'];
        $patienttestid = $_POST['patienttestid'];

        if ($this->request->is('post')) {

            $this->loadModel('Patient');
            $this->loadModel('PatientTest');          
            $this->loadModel('Test');

            //$this->Patient->recursive = 2;
            $patientdetail = $this->Patient->find('first',array('conditions'=>array('id'=>$id)));
            //$this->PatientTest->recursive = 2;
            $Testdetail= $this->PatientTest->find('all',array('conditions'=>array('PatientTest.id'=>$patienttestid),'recursive' => 2,'contain'=>array('Test','User')));
            // print_r($Testdetail); die;
            $response['status'] = 1;

            $response['msg'] = $patientdetail;
            $response['msg1'] = $Testdetail;
            $response['error'] = 0; 
   	} else {

            $response['msg'] = 'Sorry please try again';

            $response['status'] =2;  

            $response['error'] = 1;   
    }

        echo json_encode($response);
        exit;
}


public function api_clientpatientlist(){
    Configure::write("debug", 0);
    $id = $_POST['id'];

    if ($this->request->is('post')) {
        $this->loadModel("Patient");
        $patientlists = $this->Patient->find("all", array('conditions' => array('Patient.doctorid' => $id,'Patient.history' => '0')));
		
        if(!empty($patientlists)) {  

            $response['msg'] = $patientlists;
            $response['error'] = 0; 
        }else{
            $response['msg'] = 'No Data Available';
            $response['error'] = 1; 
        }   

    }else{
        $response['msg'] = 'No Post Data Available';

        $response['error'] = 1; 
    }
    echo json_encode($response);
    exit;
    }



    public function api_patienttestlist(){

    Configure::write("debug", 0);

    $this->loadModel('PatientTest');

    $id = $_POST['id'];
    if ($this->request->is('post')) {
        $this->loadModel("api_patienttestlist");
        $patientlists = $this->PatientTest->find("all", array('conditions' => array('PatientTest.patientid' => $id)));
        if(!empty($patientlists)) {     
            $response['msg'] = $patientlists;
            $response['error'] = 0; 
        }else{
            $response['msg'] = 'No Data Available';
            $response['error'] = 1; 
        }   

    }else{

        $response['msg'] = 'No Post Data Available';
        $response['error'] = 1; 
    }
    echo json_encode($response);
    exit;

    }

    public function api_sendrequesttest(){

        Configure::write("debug", 0);
        $this->loadModel('Test');
        $this->loadModel('PatientTest');
        $this->loadModel('Patient');
		$this->loadModel('Agency');
        $testid = $_POST['testid'];
        $fasting = $_POST['fasting'];
        $testdiagnosis = $_POST['testdiagnosis'];
        $requestdate = $_POST['request_date'];
        $clientsignature = $_POST['clientsignature'];
        
        $data['patientid'] = $_POST['patientid'];
        $data['doctorid'] = $_POST['doctorid'];
        
       $testingid = explode(",",$testid);
       $fasting = explode(",",$fasting);
       
       
       if(strlen($testdiagnosis)==0){
          $testdiagnosis =array();  
          $requestdate =array();  
       }
       else{
           $testdiagnosis = explode("@ddddddddxsf@123",$testdiagnosis);
           $requestdate = explode(",",$requestdate);
       }
       
       if(strlen($_POST['testdiagnosisid'])==0){
          $testdiagnosisid =array();  
       }
       else{
           $testdiagnosisid = explode("@ddddddddxsf@123",$_POST['testdiagnosisid']);
       }
       
       require_once("../webroot/MPDF57/mpdf.php"); 
        $mpdf=new mPDF(); 
        $testdia="";
        $reqdate="";
        if ($this->request->is('post')) {
            
            foreach($testingid as $testid){  
           // foreach($testdiagnosis as $testdia){
            if($testid != ""){
                //echo $testid;
                if(count($testdiagnosisid)>0){ 
                    for($k=0;$k<count($testdiagnosisid);$k++){                    
                        if($testid==$testdiagnosisid[$k]){
                            $testdia = $testdiagnosis[$k];
                            $reqdate = $requestdate[$k];
                        }
                    }
                }
                else{
                    $testdia="";
                     $reqdate = "";
                }
//                
            $this->request->data['PatientTest']= array();
            $this->request->data['PatientTest']['doctorid'] = $_POST['doctorid']; 
            $this->request->data['PatientTest']['testid'] = $testid; 
            $this->request->data['PatientTest']['patientid'] = $_POST['patientid'];        
            $this->request->data['PatientTest']['testdiagnosis'] = $testdia; 
            $this->request->data['PatientTest']['request_date'] = $reqdate; 
            
            if($clientsignature != ""){
                $img = base64_decode($clientsignature);

                $im = imagecreatefromstring($img);

                if ($im !== false) {

                    $image = "1" . time() . ".png";

                    imagepng($im, WWW_ROOT . "files" . DS . "profile_pic" . DS . $image);

                    imagedestroy($im);
            
        
            }
            }

            $this->request->data['PatientTest']['clientsignature'] = FULL_BASE_URL.$this->webroot .'files/profile_pic/'.$image;
            $this->PatientTest->create();
            $this->PatientTest->save($this->request->data);  
            $lastid =  $this->PatientTest->getInsertID();
            }
            //}
            foreach($fasting as $fastingid){ 

                if($fastingid != ""){

                $this->PatientTest->updateAll(array('PatientTest.fasting' => 1),

                array('PatientTest.testid' => $fastingid,'PatientTest.patientid' => $_POST['patientid'],

                'PatientTest.doctorid' => $_POST['doctorid'],

                'PatientTest.status' => 0));

                }

            }   
            $patienttestdata = $this->PatientTest->find("first", array("conditions" => array("PatientTest.id" => $lastid)));
            $patientsignature = $patienttestdata['PatientTest']['patientsignature'];
           
            $patientdata = $this->Patient->find("first", array("conditions" => array("Patient.id" => $_POST['patientid'])));
            //$dob = $patientdata['Patient']['dob'];
			// $dob = date("Y-m-d", strtotime($patientdata['Patient']['dob']));
   //          $diff = date_diff(date_create($dob), date_create($today));

            $today = date("Y-m-d");
            $dob = $patientdata['Patient']['dob'];
            $dated = strtotime(date('Y-m-d',strtotime($dob))); 
            $diff = round((time()-strtotime($dob))/(3600*24*365.25));


            $doctordata = $this->User->find("first", array("conditions" => array("User.id" => $_POST['doctorid'])));
            $agencyname = $doctordata['User']['agencyname'];
            $currentdate = date('Y-m-d');
            if($agencyname != NULL){
                $agencies = $this->Agency->find("first", array("conditions" => array("Agency.agencyname" => $agencyname)));   
            }
            $testdata = $this->Test->find("all");
            $agencyname = $doctordata['User']['agencyname'];
            $clientsig = FULL_BASE_URL.$this->webroot .'files/profile_pic/'.$image;            
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
                    <td style="border:1px solid #bababa; border-right:none;">'.$patientdata['Patient']['lastname'].'</td>
                    <td style="border:1px solid #bababa; border-right:none;">REQUEST DATE :</td>
                    <td style="border:1px solid #bababa;">'.$currentdate.'</td>
                  </tr>
                  <tr>

                  <tr style="background:#f9f9f9;">
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">PATIENT FIRSTNAME:</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">'.$patientdata['Patient']['firstname'].'</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">CLINIC/AGENCY NAME :</td>
                    ';
                    if($agencyname != NULL){
                      $myhtml.='<td style="border:1px solid #bababa; border-top:none;">'.$agencyname.'</td>';
                    }else{
                      $myhtml.='<td style="border:1px solid #bababa; border-top:none;">'.$patientdata['Patient']['doctorname'].'</td>';  
                    }    
                  $myhtml.='</tr>
                  <tr style="background:#fff;">
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">DOB :</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">'.$patientdata['Patient']['dob'].'</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">OFFICE NUMBER :</td>';
                    if($agencyname != NULL){
                      $myhtml.='<td style="border:1px solid #bababa; border-top:none;">'.$doctordata['User']['agencyphonenumber'].'</td>';
                    }else{
                      $myhtml.='<td style="border:1px solid #bababa; border-top:none;">'.$doctordata['User']['phonenumber'].'</td>';  
                    }
                    
                  $myhtml.='</tr>

                  <tr style="background:#f9f9f9;">
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">AGE :</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">'.$diff.'</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">FAX NUMBER :</td>
                    ';
                    if($agencyname != NULL){
                      $myhtml.='<td style="border:1px solid #bababa; border-top:none;">'.$doctordata['User']['agencyfax'].'</td>';
                    }else{
                      $myhtml.='<td style="border:1px solid #bababa; border-top:none;">'.$doctordata['User']['fax'].'</td>';  
                    }
                    
                  $myhtml.='</tr>

                  <tr style="background:#fff;">
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">GENDER :</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">'.$patientdata['Patient']['sex'].'</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">ADDRESS :</td>
                    <td style="border:1px solid #bababa; border-top:none;">'.$doctordata['User']['address'].','.$doctordata['User']['address2'].'</td>
                  </tr>

                  <tr style="background:#f9f9f9;">
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">PHONE NUMBER :</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">'.$patientdata['Patient']['phonenumber'].'</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">CITY, STATE, ZIP CODE :</td>
                    <td style="border:1px solid #bababa; border-top:none;">'.$doctordata['User']['city'].','.$doctordata['User']['state'].','.$doctordata['User']['zipcode'].'</td>
                  </tr>

                  <tr style="background:#fff;">
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">ADDRESS :</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">'.$patientdata['Patient']['address2'].'</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">DOCTOR NAME :</td>
                    <td style="border:1px solid #bababa; border-top:none;">'.$doctordata['User']['firstname'].'</td>
                  </tr>

                  <tr style="background:#f9f9f9;">
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">ADDRESS2 :</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">'.$patientdata['Patient']['address2'].'</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">DOCTOR NPI NO. :</td>
                    <td style="border:1px solid #bababa; border-top:none;">'.$doctordata['User']['npi'].'</td>
                  </tr>

                  <tr style="background:#fff;">
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">PATIENT INSURANCE NAME :</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">'.$patientdata['Patient']['insurancename'].'</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">PATIENT INSURANCE NO. :</td>
                    <td style="border:1px solid #bababa; border-top:none;">'.$patientdata['Patient']['insurancenumber'].'</td>
                  </tr>


                  <tr style="background:#f9f9f9;">
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">CITY, STATE, ZIP CODE :</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">'.$patientdata['Patient']['city'].','.$patientdata['Patient']['state'].','.$patientdata['Patient']['zipcode'].'</td>
                    <td style="border:1px solid #bababa; border-right:none; border-top:none;">DOCTOR/REPRESENTATIVE SIGNATURE :</td>
                    <td style="border:1px solid #bababa; border-top:none;"><img src='.$clientsig.'></td>
                  </tr>

                  <tr style="background:#fff;">
                    <td colspan="2" style="border:1px solid #bababa; border-right:none; border-top:none;">DIAGNOSIS (ICD 10) :</td>
                    <td colspan="2" style="border:1px solid #bababa; border-top:none;">'.$testdia.'</td>
                  </tr>

                  <tr style="background:#f9f9f9;">
                    <td colspan="2" style="border:1px solid #bababa; border-right:none; border-top:none;">SPECIAL INSTRUCTION :</td>
                    <td colspan="2" style="border:1px solid #bababa;  border-top:none;">'.$patientdata['Patient']['diagnosis'].'</td>
                  </tr>

                  <tr>
                        <td colspan="4"><form id="form1" name="form1" method="post" action="">
                          <p>';
                          $checked="";
                          foreach($testdata as $tests){
                            if($testid == $tests['Test']['id']){
                              //  $checked = "checked";
                            
                            $myhtml.='<label>
                              <input type="checkbox" name="CheckboxGroup1" value="checkbox" checked="checked" id="CheckboxGroup1_0" />';
                            }else{
                             $myhtml.='<label>
                              <input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_0" />';   
                            }
                            
                            $myhtml.='<b style="font-size:12px">'.$tests['Test']['test'].'</b></label> <br/>';
                                } 
                            $myhtml.='</p>
                          </form>
                          </td>
                  </tr>
                  <tr>

                    <td style="border:1px solid #bababa; border-bottom:none;" colspan="4"><p>I AUTHORIZE THE RELEASE OF MY INSURANCE CARRIER OF ANY MEDICAL INFORMATION NECESSARY TO PROCESS THIS CLAIM AND I AUTHORIZE PAYMENT OF MEDICAL BENEFITS DIRECTLY TO TRUE LABORATORIES LLC.</p></td>
                  </tr>
                  <tr>
                        <td colspan="2" style="border:1px solid #bababa; border-right:none;">
                        PATIENTâ€™S SIGNATURE
                    </td>
                    <td style="border:1px solid #bababa;" colspan="2">
                        <img src="'.$patientsignature.'">
                    </td>
                  </tr>

                </table>

                    </td>
                  </tr>
                </table>


                </body>
                </html>';

            
                $nomFacture = time().".pdf";
                $filename = $nomFacture;

                $path = '../webroot/MPDF57/pdf';
                $file = $path . "/" . $filename;
  
                $mpdf->WriteHTML($myhtml);
                $mpdf->Output($file, 'F'); 
                $filesave = FULL_BASE_URL."/truelab/MPDF57/pdf/".$filename;
                $this->PatientTest->updateAll(array('PatientTest.paidreport' => "'$filesave'"),array('PatientTest.id' => $lastid));

                if ($agencyname != NULL) {
                       $ag = $agencyname;
                    }else{
                      $ag = $patientdata["Patient"]["doctorname"]; 
                    }
                    $tn = $testdata["Test"]["test"];
                    $tt = $tests['Test']['test'];
                    $trackingid = $patientdata["Patient"]["trackingid"];

                $ms = '<body><table width="500" border="0" cellpadding="10" cellspacing="0" style="margin: 0px auto; background: #f0f0f0; text-align: center"><tr style="background: #f0f0f0"><td colspan="2" style="text-align: center; padding-top: 20px; padding-bottom: 20px"><img alt="img" style="height: 97px;" src="' . FULL_BASE_URL . $this->webroot .'home/logo.png"/></td></tr><tr><b>New Test Added</b></tr><tr>New Test for '.$trackingid.' has been added successfully.</tr><tr>Agency Name : '.$ag.'</tr><tr>Test Name : '.$tt.'</tr></table></body>';

                    $Email = new CakeEmail();
                    $Email->config('default');
                    $Email->template('default');
                    $Email->emailFormat('html');
                    $Email->from(array('noreply@truelabllc.com' => 'QualityLabOne'));
                    $Email->to('notification@truelabllc.com');
                    $Email->subject('Add Test Added');
                    $Email->send($ms);


                    $Email = new CakeEmail();
                    $Email->config('default');
                    $Email->template('default');
                    $Email->emailFormat('html');
                    $Email->from(array('noreply@truelabllc.com' => 'QualityLabOne'));
                    $Email->to($doctordata['User']['email']);
                    $Email->subject('Add Test Added');
                    $Email->send($ms);    
        }
        }
        
        $response['status'] = 1;
            $response['msg'] = $_POST;
            $response['error'] = 0; 
        echo json_encode($response);
        exit;

    }
    
        
    public function api_deletepatient(){

        Configure::write("debug",2);
        $this->loadModel('Patient');
        $id = $_POST['id'];
        
        if ($this->request->is('post')) {
            $this->Patient->id = $id;
            $this->Patient->delete();
            $response['status'] = 1;
            $response['msg'] = $_POST;
            $response['error'] = 0; 
        }
        echo json_encode($response);
        exit;

    }
    
    public function api_search(){
        configure::write('debug', 0);
        $this->loadModel('Patient');

       
        $name = $_POST['name'];
        
        if($name){
        $conditions = array('Patient.name Like' =>'%'.$name.'%');
        $resp = $this->Patient->find('all',array('conditions'=>array($conditions),'limit'=>10));

        if ($resp) {
            $response['isSuccess'] = "true";
            $response['data'] = $resp;
        } else {
            $response['isSuccess'] = "false";
            $response['msg'] = "No Data Available";
        }
        } else {
            $response['isSuccess'] = "false";
            $response['msg'] = "Please select some other Patient";
        }
        
        echo json_encode($response);
        exit;
    
    }
    
    
    public function api_clienthistory(){
        Configure::write("debug", 0);
        $id = $_POST['id'];
        if ($this->request->is('post')) {
            $this->loadModel("Patient"); 
            $this->loadModel("StatusHistory");

            $patientlists = $this->StatusHistory->find("all", array('conditions' => array('StatusHistory.doctorid' => $id),'recursive' => 2,'contain'=>'Patient'));

            if(!empty($patientlists)) {     
               $response['msg'] = $patientlists;
                $response['error'] = 0; 

            }else{
                $response['msg'] = 'No Data Available';
                $response['error'] = 1; 
            }   

        }else{

            $response['msg'] = 'No Data Available';
           $response['error'] = 1; 
        }
        echo json_encode($response);
        exit;
    }

    public function admin_clienttestsdetails($id = null){
        Configure::write("debug", 0);
        $this->loadModel("PatientTest");
        $this->loadModel("Patient");
        $this->loadModel("Test");
        $finalarray = array();
        $clientsdetails = $this->PatientTest->find("all", array("conditions" => array("PatientTest.doctorid" => $id)));
        
        foreach($clientsdetails as $clientdetail){
            $patientname = $this->Patient->find('first', array('conditions' => array('Patient.id' => $clientdetail['PatientTest']['patientid'])));
            $doctorname = $this->User->find('first', array('conditions' => array('User.id' => $clientdetail['PatientTest']['doctorid'])));
            $tests = $this->Test->find('first', array('conditions' => array('Test.id' => $clientdetail['PatientTest']['testid'])));
            if($clientdetail['PatientTest']['status'] == 1){
                $finalstatus = 'Schedule';
                $date = $clientdetail['PatientTest']['schdueleddate'];
            }elseif($clientdetail['PatientTest']['status'] == 0){
                $finalstatus = 'UnSchedule';
                 $date = $clientdetail['PatientTest']['created'];
            }elseif($clientdetail['PatientTest']['status'] == 2){
                $finalstatus = 'Accepted';
                 $date = $clientdetail['PatientTest']['date'];
            }elseif($clientdetail['PatientTest']['status'] == 3){
                $finalstatus = 'declined';
                $date = $clientdetail['PatientTest']['declinedate'];
            }elseif($clientdetail['PatientTest']['status'] == 4){
                $finalstatus = 'Canceled';
                $date = $clientdetail['PatientTest']['canceldate'];
            }
            
            $finalarray[]['details'] = array(
                'id' => $clientdetail['PatientTest']['id'],
                'patientname' => $patientname['Patient']['firstname'] . ' ' . $patientname['Patient']['lastname'],
				'trackingid' => $patientname['Patient']['trackingid'],
                'doctorname' => $doctorname['User']['firstname'] . $doctorname['User']['lastname'],
                'testname' => $tests['Test']['test'],
                'finalstatus' => $finalstatus, 
                'date_staus' => date('Y-m-d', strtotime($date))   
                
            );
        }
        $this->set('patients', $finalarray);
        
    }
    
    public function admin_clienttestshistory($id = null){
        Configure::write("debug", 0);
        $this->loadModel("StatusHistory");
        $historypatients = $this->StatusHistory->find("all", array("conditions" => array("StatusHistory.doctorid" => $id)));
    }
    
    
    public function admin_patientlist($id = null){
        Configure::write("debug", 0);
        $this->loadModel("Patient");
        $patients_lists = $this->Patient->find("all", array("conditions" => array("Patient.doctorid" => $id)));
        //echo '<pre>'; print_r($patients_lists); echo '</pre>'; die;
        $this->set('patients', $patients_lists);
    }
    public function admin_phlebotomisttestdetails($id = null){
        Configure::write("debug", 2);
        $this->loadModel("PatientTest");
        $this->loadModel("Patient");
        $this->loadModel("Test");
        $finalarray = array();
        $clientsdetails = $this->PatientTest->find("all", array("conditions" => array("PatientTest.userid" => $id)));
       //echo '<pre>'; print_r($clientsdetails); echo '</pre>'; die;
        foreach($clientsdetails as $clientdetail){
            $patientname = $this->Patient->find('first', array('conditions' => array('Patient.id' => $clientdetail['PatientTest']['patientid'])));
            $doctorname = $this->User->find('first', array('conditions' => array('User.id' => $clientdetail['PatientTest']['doctorid'])));
            $tests = $this->Test->find('first', array('conditions' => array('Test.id' => $clientdetail['PatientTest']['testid'])));
            if($clientdetail['PatientTest']['status'] == 1){
                $finalstatus = 'Schedule';
                $date = $clientdetail['PatientTest']['schdueleddate'];
            }elseif($clientdetail['PatientTest']['status'] == 0){
                $finalstatus = 'UnSchedule';
                 $date = $clientdetail['PatientTest']['created'];
                 $date = $clientdetail['PatientTest']['date'];
            }elseif($clientdetail['PatientTest']['status'] == 2){
                $finalstatus = 'Accepted';
                 $date = $clientdetail['PatientTest']['date'];
            }elseif($clientdetail['PatientTest']['status'] == 3){
                $finalstatus = 'declined';
                $date = $clientdetail['PatientTest']['declinedate'];
            }elseif($clientdetail['PatientTest']['status'] == 4){
                $finalstatus = 'Canceled';
                $date = $clientdetail['PatientTest']['canceldate'];
            }
            
            $finalarray[]['details'] = array(
                'id' => $clientdetail['PatientTest']['id'],
                'trackingid' => $patientname['Patient']['trackingid'],
                'patientname' => $patientname['Patient']['firstname'] . ' ' . $patientname['Patient']['lastname'],
                'doctorname' => $doctorname['User']['firstname'] . $doctorname['User']['lastname'],
				'agencyname' => $doctorname['User']['agencyname'],
                'testname' => $tests['Test']['test'],
                'finalstatus' => $finalstatus, 
                'date_staus' => date('Y-m-d', strtotime($date))   
                
            );
        }
        //echo '<pre>'; print_r($finalarray); echo '</pre>'; die();
        $this->set('patients', $finalarray);
    }
	
	public function admin_payroll($id = null){
            
            Configure::write("debug", 0);
            $this->loadModel("PatientTest");
            $this->loadModel("Patient");
            $this->loadModel("Test");
            $finalarray = array();
            $clientsdetails = $this->PatientTest->find("all", array("conditions" => array("AND" => array("PatientTest.userid" => $id, "PatientTest.report !=" => ''))));
            $payrollcount = $this->PatientTest->find("count", array("conditions" => array("AND" => array("PatientTest.userid" => $id, "PatientTest.report !=" => ''))));
        
            foreach($clientsdetails as $clientdetail){
            $patientname = $this->Patient->find('first', array('conditions' => array('Patient.id' => $clientdetail['PatientTest']['patientid'])));
            $doctorname = $this->User->find('first', array('conditions' => array('User.id' => $clientdetail['PatientTest']['doctorid'])));
            $phelboname = $this->User->find('first', array('conditions' => array('User.id' => $id)));
            $tests = $this->Test->find('first', array('conditions' => array('Test.id' => $clientdetail['PatientTest']['testid'])));
           
            $finalarray[]['details'] = array(
                'id' => $clientdetail['PatientTest']['id'],
                'trackingid' => $patientname['Patient']['trackingid'],
				'phelboname' => $phelboname['User']['firstname'],
                'patientname' => $patientname['Patient']['firstname'] . ' ' . $patientname['Patient']['lastname'],
                'doctorname' => $doctorname['User']['firstname'] . $doctorname['User']['lastname'],
				'agencyname' => $doctorname['User']['agencyname'],
                'testname' => $tests['Test']['test'],
                'date' =>  $clientdetail['PatientTest']['date'],
				'report_date' =>  $clientdetail['PatientTest']['reportdate']
            );
        }
        
        $this->set('patients', $finalarray);
		$this->set('payrollcount', $payrollcount);
		
		/**********************************
										Missed Visit
												********************************************/
		
		
	    $finalarrayvisit = array();
            //$clientsdetailsvisit = $this->PatientTest->find("all", array("conditions" => array("OR" => array("PatientTest.status" => 2, "PatientTest.status" => 4)), array("AND" => array("PatientTest.userid" => $id, "PatientTest.patientreason !=" => ''))));
            $clientsdetailsvisit = $this->PatientTest->find("all",array( 'conditions' => array(
                                                                                            'PatientTest.userid' => $id,
                                                                                            'OR' =>array(
                                                                                                    array('PatientTest.status' => 2,'not' => array('PatientTest.patientreason' => null)),
                                                                                                    array('PatientTest.status' => 4,'not' => array('PatientTest.patientreason' => null)),
                                                                                                )
                                                                                            )));
            $payrollcountvisit = $this->PatientTest->find("count", array("conditions" => array("AND" => array("PatientTest.userid" => $id, "PatientTest.report !=" => ''))));
        
            foreach($clientsdetailsvisit as $clientdetailvisit){
            $patientnamevisit = $this->Patient->find('first', array('conditions' => array('Patient.id' => $clientdetailvisit['PatientTest']['patientid'])));
            $doctornamevisit = $this->User->find('first', array('conditions' => array('User.id' => $clientdetailvisit['PatientTest']['doctorid'])));
            $phelbonamevisit = $this->User->find('first', array('conditions' => array('User.id' => $id)));
            $testsvisit = $this->Test->find('first', array('conditions' => array('Test.id' => $clientdetailvisit['PatientTest']['testid'])));
           
            $finalarrayvisit[]['visit'] = array(
                'id' => $clientdetailvisit['PatientTest']['id'],
                'trackingid' => $patientnamevisit['Patient']['trackingid'],
				'phelboname' => $phelbonamevisit['User']['firstname'],
                'patientname' => $patientnamevisit['Patient']['firstname'] . ' ' . $patientnamevisit['Patient']['lastname'],
                'doctorname' => $doctornamevisit['User']['firstname'] . $doctornamevisit['User']['lastname'],
				'agencyname' => $doctornamevisit['User']['agencyname'],
                'testname' => $testsvisit['Test']['test'],
                'date' =>  $clientdetailvisit['PatientTest']['date'],
				'report_date' =>  $clientdetailvisit['PatientTest']['reportdate']
            );
        }
        
        $this->set('patientsvisits', $finalarrayvisit);
		
		
	}
	public function ajaxsearchdate(){
	$this->loadModel("PatientTest");
        $this->loadModel("Patient");
        $this->loadModel("Test");
		$finalarray = array();
		$start_date = $_REQUEST['datefrom'];
		$end_date = $_REQUEST['dateto'];
		//$conditions = array('PatientTest.date <=' => $from, 'PatientTest.date >=' => $to);
                $conditions="";
                if($start_date!="" && $end_date!=""){
                    $conditions = "WHERE date(PatientTest.date) BETWEEN '".$start_date."' AND '".$end_date."'";
                }
                else{
                    $conditions = "WHERE PatientTest.report !='' ";
                }

	$datesearch = $this->PatientTest->query('SELECT * FROM patient_tests as PatientTest  '.$conditions);
		
		foreach($datesearch as $clientdetail){
                $patientname = $this->Patient->find('first', array('conditions' => array('Patient.id' => $clientdetail['PatientTest']['patientid'])));
                $doctorname = $this->User->find('first', array('conditions' => array('User.id' => $clientdetail['PatientTest']['doctorid'])));
                $phelboname = $this->User->find('first', array('conditions' => array('User.id' => $clientdetail['PatientTest']['userid'])));
                $tests = $this->Test->find('first', array('conditions' => array('Test.id' => $clientdetail['PatientTest']['testid'])));
           
            $finalarray[]['details'] = array(
                'id' => $clientdetail['PatientTest']['id'],
                'trackingid' => $patientname['Patient']['trackingid'],
				'phelboname' => $phelboname['User']['firstname'],
                'patientname' => $patientname['Patient']['firstname'] . ' ' . $patientname['Patient']['lastname'],
                'doctorname' => $doctorname['User']['firstname'] . $doctorname['User']['lastname'],
				'agencyname' => $doctorname['User']['agencyname'],
                'testname' => $tests['Test']['test'],
                'date' =>  $clientdetail['PatientTest']['date'],
				'report_date' =>  $clientdetail['PatientTest']['reportdate']
            );
        }
        
         $body="";
         if(count($finalarray)>0){
        foreach ($finalarray as $patient){
            
            $body.="<tr><td>".$patient['details']['id']."</td><td>".$patient['details']['patientname']."</td>
                        <td>".$patient['details']['doctorname']."</td>
                        <td>".$patient['details']['agencyname']."</td>
                        <td>".$patient['details']['testname']."</td>
                        <td>".$patient['details']['phelboname']."</td>
                        <td>".$patient['details']['date']."</td>
                        <td>".$patient['details']['report_date']."</td>                    </tr>"; 
                
        }
         }
         else{
             $body="<tr><td colspan='8'>No Record Found</td></tr>";
         }

        echo $body;
		exit;
	}
        
        public function api_patient(){
          $this->loadModel("PatientTest");  
          $patienttest = $this->PatientTest->find("all", array("conditions" => array("PatientTest.id" => $_POST['id'])));
          
          $response['data'] = $patienttest;
    
         $response['status'] =2;  

         $response['error'] = 0;   
         echo json_encode($response);
         exit;

        }
        
        public function admin_myaccount(){
        Configure::write("debug", 0);
        $this->loadModel('User');
        $user=$this->User->find('first',array('conditions'=>array('User.id'=>$this->Auth->user('id'))));  
        $this->set(compact(user));
        }
        
        public function api_addagency(){
           Configure::write("debug", 0);
        $this->loadModel('Agency'); 
        
        $this->request->data['Agency']['agencyname'] = $_POST['agencyname'];
        
        $agency = $this->Agency->find('first',array('conditions'=>array('Agency.agencyname' => $_POST['agencyname'])));
        
        if($agency){
        $response['error'] = 0;  
        }else{
         $this->Agency->save($this->request->data);

        $response['error'] = 0;   
        }             
        
        echo json_encode($response);
         exit;
        }
		
		public function admin_myaccountedit($id = null) {

        	Configure::write("debug", 0);
        	$this->User->id = $id;
        	if (!$this->User->exists()) {
            	throw new NotFoundException('Invalid user');
        	}
        	// get saved page permissions
      		if ($this->request->is('post') || $this->request->is('put')) {
 				$image = $this->request->data['User']['image'];
				$uploadFolder = "profile_pic";
				$uploadPath = WWW_ROOT . '/files/' . $uploadFolder;
				if ($image['error'] == 0) {
					$imageName = $image['name'];
					if (file_exists($uploadPath . DS . $imageName)) {
						$imageName = date('His') . $imageName;
					}
					$full_image_path = $uploadPath . DS . $imageName;
					$this->request->data['User']['image'] = $imageName;
					move_uploaded_file($image['tmp_name'], $full_image_path);
				} else {
					$admin_edit = $this->User->find('first', array('conditions' => array('User.id' => $id)));
					$this->request->data['User']['image'] = !empty($admin_edit['User']['image']) ? $admin_edit['User']['image'] : 'noimagefound.jpg';
				}
				//echo '<pre>'; print_r($this->request->data); echo '</pre>'; die;
				if ($this->User->save($this->request->data)) {
					$this->Session->setFlash('The user has been saved');
					return $this->redirect(array('action' => 'myaccount'));
				} else {
					$this->Session->setFlash('The user could not be saved. Please, try again.');

				}
			
        }else {
		
            $this->request->data = $this->User->read(null, $id);
			//$this->set("profile_pic", $this->User->find("all", array("conditions" => array("User."))));
			//$this->set("profile_pic", $this->User->find('first', array('conditions'=>array('User.id'=>$id),'fields'=>array('image'))));
        }
    }
    
    public function api_agencydoctorlist(){
        
       Configure::write("debug", 2);
       
       $this->loadModel('User'); 
       
       $agencyname = $_POST['agencyname'];
       $userdata = $this->User->find('all',array('conditions' => array('User.agencyname' => $agencyname)));
       if($userdata){
              
            $response['msg'] = 'Doctor List';
            $response['data'] = $userdata;

            $response['error'] = 0; 

        } else {

           $response['msg'] = 'No doctor exists.';

            $response['error'] = 1; 

        }
         echo json_encode($response);
        exit;
        
    } 
	
	public function admin_activateuser($id = null){
		Configure::write("debug", 0);
		$useractivate = $this->User->updateAll(array("User.active" => 1), array("User.id" => $id));
		if($useractivate){
			if ($this->Auth->user('role') == 'admin') {
				$this->Session->setFlash(__('User Activate Successfully!!!'));
				return $this->redirect(array('action' => 'index'));
			}else{
				$this->Session->setFlash(__('User Activate Successfully!!!'));
				return $this->redirect(array('action' => 'index'));
			}
		}
	}
	
	public function admin_deactivateuser($id = null){
		Configure::write("debug", 0);
		$useractivate = $this->User->updateAll(array("User.active" => 0), array("User.id" => $id));
		if($useractivate){
			if ($this->Auth->user('role') == 'admin') {
				$this->Session->setFlash(__('User Deactivate Successfully!!!'));
				return $this->redirect(array('action' => 'index'));
			}else{
				$this->Session->setFlash(__('User Deactivate Successfully!!!'));
				return $this->redirect(array('action' => 'index'));
			}
		}
	}
    
	public function admin_activatephlebotomistuser($id = null){
		Configure::write("debug", 0);
		$useractivate = $this->User->updateAll(array("User.active" => 1), array("User.id" => $id));
		if($useractivate){
				$this->Session->setFlash(__('Phlebotomist Activate Successfully!!!'));
				return $this->redirect(array('action' => 'phlebotomistindex'));
		}
	}
	
	public function admin_deactivatephlebotomistuser($id = null){
		Configure::write("debug", 0);
		$useractivate = $this->User->updateAll(array("User.active" => 0), array("User.id" => $id));
		if($useractivate){
				$this->Session->setFlash(__('Phlebotomist Deactivate Successfully!!!'));
				return $this->redirect(array('action' => 'phlebotomistindex'));
		}
	}

	
	
}
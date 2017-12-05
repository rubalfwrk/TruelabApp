<?php

App::uses('AppModel', 'Model');

/**

 * Patient Model

 *

 * 

 */

class Patient extends AppModel {
  
  public $useTable = 'patients'; 

  public $hasMany = array(
        'PatientTest' => array(
            'className' => 'PatientTest',
            'foreignKey' => 'patientid',
            'dependent' => true,
        )
    );
	
	  public $belongsTo  = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'doctorid',
            'dependent' => true,
        )
    );


}


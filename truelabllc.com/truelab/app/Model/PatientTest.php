<?php



App::uses('AppModel', 'Model');



/**



 * Patient Model



 *



 * 



 */



class PatientTest extends AppModel {

  

	public $useTable = 'patient_tests'; 

	

	public $belongsTo = array(

           'Test' => array(

            'className' => 'Test',

            'foreignKey' => 'testid',

        ),

	'Patient' => array(

            'className' => 'Patient',

            'foreignKey' => 'patientid',

            

        ),

        

	'User' => array(

            'className' => 'User',

            'foreignKey' => 'doctorid',

            

        ),



	);

        

        

//        public $hasMany = array(

//        'Test' => array(

//            'className' => 'Test',

//            'foreignKey' => 'id',

//            'dependent' => true,

//        )

//    );



}




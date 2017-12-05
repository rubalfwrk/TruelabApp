<?php

App::uses('AppModel', 'Model');

class StatusCancel extends AppModel {
    public $useTable = 'status_cancels';
    
   public $belongsTo  = array(
        'Patient' => array(
            'className' => 'Patient',
            'foreignKey' => 'patientid',
            'dependent' => true,
        ),
        'Test' => array(
            'className' => 'Test',
            'foreignKey' => 'testid',
            'dependent' => true,
        ),
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'userid',
            'dependent' => true,
        )
    );
}
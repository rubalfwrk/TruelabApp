<?php
App::uses('AppModel', 'Model');
class User extends AppModel {

////////////////////////////////////////////////////////////

 public $useTable = 'users'; 

  public $hasMany = array(
        'PatientTest' => array(
            'className' => 'PatientTest',
            'foreignKey' => 'testid',
            'dependent' => true,
        )

      );
////////////////////////////////////////////////////////////

    public function beforeSave($options = array()) {
        if(isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
        return true;
    }

////////////////////////////////////////////////////////////

}

<?php
App::uses('AppModel', 'Model');
App::uses('District', 'Model');
/**
 * User Model
 *
 */
class School extends AppModel {
   /* public $hasOne = array(
            'Gcmreg' => array(
                    'className' => 'Gcmreg',
                    'foreignKey' => 'user_id',
                    'dependent' => true
            )
    );*/

 public $validate = array(
          'school_name' => array(
            'rule' => 'notEmpty',
            'message' => 'You have not entered your School.'
        ),
        'address' => array(
            'rule' => 'notEmpty',
            'message' => 'Please select any one.'
        ),
        'district_code' => array(
       'exists' => array(
            'rule' => array('isexist'),
            'message' => 'Please enter valid district code',
            'allowEmpty' => true
         )
        ),
       'email' => array(
        'notEmpty' => array(
            'rule' => 'notEmpty',
            'message' => 'Provide an email address'
        ),
        'validEmailRule' => array(
            'rule' => array('email'),
            'message' => 'Invalid email address'
        ),
        'uniqueEmailRule' => array(
            'rule' => 'isUnique',
            'message' => 'Email already registered'
         )
        )
     );
	public $hasMany = array(
'Teacher' => array(
                    'className' => 'Teacher',
                    'foreignKey' => 'school_id',
                    'dependent' => true
            )

		);


    function isexist($zipcode){
$Model_B = new District();
    $valid = $Model_B->find('count', array('conditions'=> array('District.district_code' =>$zipcode)));
    if ($valid == 1){
      return true;
    }
    else{
      return false;
    }
  }

}

<?php
App::uses('AppModel', 'Model');
App::uses('School', 'Model');
/**
 * Teacher Model
 *
 */
class Teacher extends AppModel {
 

 public $validate = array(
          'className' => array(
            'rule' => 'notEmpty',
            'message' => 'Class name is required.'
        ),
        'startDate' => array(
            'rule' => 'notEmpty',
            'message' => 'start date is requrired'
        ),
         'endDate' => array(
            'rule' => 'notEmpty',
            'message' => 'end date is requrired'
        ),
         'startTime' => array(
            'rule' => 'notEmpty',
            'message' => 'Start time is requrired'
        ),
         'endTime' => array(
            'rule' => 'notEmpty',
            'message' => 'end time is requrired'
        ),
         'repeatType' => array(
            'rule' => 'notEmpty',
            'message' => 'Selete any one please first'
        ),
        'school_code' => array(
        'exists' => array(
            'rule' => array('isexist'),
            'message' => 'Please enter valid school code',
            'allowEmpty' => true
         )
        )
     );


public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
 public  $hasOne =array(
      	 'RepeatClass' => array(
            'className' => 'RepeatClass',
            'foreignKey' => 'teacher_id',
            'dependent' => true
          )
      	);
public  $hasMany =array(
      	 'Student' => array(
            'className' => 'Student',
            'foreignKey' => 'teacher_id',
            'dependent' => true
          ),
         'Beacon' => array(
            'className' => 'Beacon',
            'foreignKey' => 'teacher_id',
            'dependent' => true
          )
      	);

function isexist($zipcode){
$Model_B = new School();
   
	    $valid = $Model_B->find('count', array('conditions'=> array('School.school_code' =>$zipcode)));
	    if ($valid == 1){
	      return true;
	    }
	    else{
	      return false;
	    }
   	

  }

}

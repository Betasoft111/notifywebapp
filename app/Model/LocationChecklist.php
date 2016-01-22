<?php
App::uses('AppModel', 'Model');
App::uses('District', 'Model');
/**
 * User Model
 *
 */
class LocationChecklist extends AppModel {
	/* public $hasOne = array(
		            'Gcmreg' => array(
		                    'className' => 'Gcmreg',
		                    'foreignKey' => 'user_id',
		                    'dependent' => true
		            )
	*/

	public $validate = array(
		'first_name' => array(
			'rule' => 'notEmpty',
			'message' => 'You have not entered first name.',
		),
		'last_name' => array(
			'rule' => 'notEmpty',
			'message' => 'You have not entered last name.',
		),
		'prefered_name' => array(

		),
		'address' => array(
			'rule' => 'notEmpty',
			'message' => 'Please enter the address',
		),
		'dob' => array(
			'rule' => 'notEmpty',
			'message' => 'Please enter the date of birth.',
		),
		'cognitive_loss',
		'hearing_loss',
		'visual_impairment',
		'ambulation',
		'assistive_devices',
		'toileting',
		'bathing',
		'dressing',
		'eating',
		'housekeeping',
		'shopping',
		'laundry',
		'interests',

	);
	// public $hasMany = array(
	// 	'Teacher' => array(
	// 		'className' => 'Teacher',
	// 		'foreignKey' => 'school_id',
	// 		'dependent' => true,
	// 	),

	// );

	// function isexist($zipcode) {
	// 	$Model_B = new District();
	// 	$valid = $Model_B->find('count', array('conditions' => array('District.district_code' => $zipcode)));
	// 	if ($valid == 1) {
	// 		return true;
	// 	} else {
	// 		return false;
	// 	}
	// }

}

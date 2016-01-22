<?php
App::uses('AppModel', 'Model');
App::uses('District', 'Model');
/**
 * User Model
 *
 */
class Location extends AppModel {
	/* public $hasOne = array(
		            'Gcmreg' => array(
		                    'className' => 'Gcmreg',
		                    'foreignKey' => 'user_id',
		                    'dependent' => true
		            )
	*/

	public $validate = array(
		'location_name' => array(
			'rule' => 'notEmpty',
			'message' => 'You have not entered your Location.',
		),
		'location_type' => array(
			'rule' => 'notEmpty',
			'message' => 'Please select the location setup',
		),
		'location_setup',
		'city',
		'state',
		'open_time' => array(
			'rule' => 'notEmpty',
			'message' => 'Please select open time.',
		),
		'close_time' => array(
			'rule' => 'notEmpty',
			'message' => 'Please select open time.',
		),
		// 'address' => array(
		// 	'rule' => 'notEmpty',
		// 	'message' => 'Please enter the address.',
		// ),
		'company_name',
		'company_code',
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

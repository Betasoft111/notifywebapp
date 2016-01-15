<?php
App::uses('AppModel', 'Model');
/**
 * Student Model
 *
 */
class EmployeeAttendance extends AppModel {
public $belongsTo = array(
		'Employee' => array(
			'className' => 'Employee',
			'foreignKey' => 'employee_id'
			
		)
	);
}

<?php
App::uses('AppModel', 'Model');
/**
 * Student Model
 *
 */
class StudentAttendance extends AppModel {
public $belongsTo = array(
		'Student' => array(
			'className' => 'Student',
			'foreignKey' => 'student_id'
			
		)
	);
}

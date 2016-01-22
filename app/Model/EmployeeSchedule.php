<?php
App::uses('AppModel', 'Model');
/**
 * Empoyee shedule Model
 *
 */
class EmployeeSchedule extends AppModel {
	public $validate = array(
		'employ_id' => array(
			'rule' => 'notEmpty',
			'message' => 'Please select the employee.',
		),
		'scheduletime' => array(
			'rule' => 'notEmpty',
			'message' => 'Please the schedule Time.',
		),
		'meeting_start_time' => array(
			'rule' => 'notEmpty',
			'message' => 'Please select meeting Start Time.',
		),
		'meeting_end_time' => array(
			'rule' => 'notEmpty',
			'message' => 'Please select meeting End Time.',
		),
		'scheduletime' => array(
			'rule' => 'notEmpty',
			'message' => 'Please select schedule time.',
		),
		'startTime' => array(
			'rule' => 'notEmpty',
			'message' => 'Please select schedule start time',
		),
		'endTime' => array(
			'rule' => 'notEmpty',
			'message' => 'Please select schedule end time',
		),
	);
}

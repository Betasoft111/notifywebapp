<?php
App::uses('AppModel', 'Model');

class EventeeAttendance extends AppModel {
public $belongsTo = array(
		'Eventee' => array(
			'className' => 'Eventee',
			'foreignKey' => 'eventee_id'
			
		)
	);
}

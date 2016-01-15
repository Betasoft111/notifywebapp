<?php
App::uses('AppModel', 'Model');
/**
 * Attendee Model
 *
 */
class Attendee extends AppModel {
public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'userid',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}

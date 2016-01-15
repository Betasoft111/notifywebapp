<?php
App::uses('AppModel', 'Model');
/**
 * Eventhost Model
 *
 */
class Eventhost extends AppModel {
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

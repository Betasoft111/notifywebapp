<?php
App::uses('AppModel', 'Model');
/**
 * Parrent Model
 *
 */
class Parrent extends AppModel {
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

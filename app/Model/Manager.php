<?php
App::uses('AppModel', 'Model');
/**
 * Manager Model
 *
 */
class Manager extends AppModel {
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

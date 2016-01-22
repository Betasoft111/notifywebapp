<?php
App::uses('AppModel', 'Model');
/**
 * Employee Model
 *
 */
/*class Employee extends AppModel {
public $belongsTo = array(
'User' => array(
'className' => 'User',
'foreignKey' => 'user_id',
'conditions' => '',
'fields' => '',
'order' => ''
)
);
}*/
class Employee extends AppModel {
	public $validate = array(
		'employee_name' => array(
			'rule' => 'notEmpty',
			'message' => 'You have not entered employee name.',
		),
		'employee_email' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Provide an email address',
			),
			'validEmailRule' => array(
				'rule' => array('email'),
				'message' => 'Invalid email address',
			),
			'uniqueEmailRule' => array(
				'rule' => 'isUnique',
				'message' => 'Email already registered',
			),

		),
	);

	function isexist($field = array(), $meetingCode = null, $id = null) {
		foreach ($field as $key => $value) {
			$v1 = $value;
			$v2 = $this->data[$this->name][$meetingCode];
			$v3 = null;
			if (isset($this->data[$this->name][$id])) {
				$v3 = $this->data[$this->name][$id];
			}
			if (!empty($v3)) {

				$valid = $this->find('count', array('conditions' => array('Employee.meetingCode' => $v2, 'Employee.employee_email' => $v1, 'Employee.id !=' => $v3)));

				if ($valid > '0') {
					return FALSE;
				} else {
					continue;
				}
			} else {
				$valid = $this->find('count', array('conditions' => array('Employee.meetingCode' => $v2, 'Employee.employee_email' => $v1)));

				if ($valid > '0') {
					return FALSE;
				} else {
					continue;
				}
			}
		}
		return TRUE;
	}

}

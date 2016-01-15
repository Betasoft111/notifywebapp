<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 */
class District extends AppModel {
   /* public $hasOne = array(
            'Gcmreg' => array(
                    'className' => 'Gcmreg',
                    'foreignKey' => 'user_id',
                    'dependent' => true
            )
    );*/
 public $validate = array(
         'district_name' => array(
        'notEmpty' => array(
            'rule' => 'notEmpty',
            'message' => 'Please enter district name.'
        ),
        'uniqueDistrictNameRule' => array(
            'rule' => 'isUnique',
            'message' => 'Name already exist'
         )
        ),
        'description' => array(
            'rule' => 'notEmpty',
            'message' => 'Please select any one.'
        ),
         'email' => array(
        'notEmpty' => array(
            'rule' => 'notEmpty',
            'message' => 'Provide an email address'
        ),
        'validEmailRule' => array(
            'rule' => array('email'),
            'message' => 'Invalid email address'
        ),
        'uniqueEmailRule' => array(
            'rule' => 'isUnique',
            'message' => 'Email already registered'
         )
        )
     );
	public $hasMany = array(
'School' => array(
                    'className' => 'School',
                    'foreignKey' => 'district_id',
                    'dependent' => true
            )

		);

}

<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 */
class Company extends AppModel {
   
	public $validate = array(
          'companyName' => array(
        'notEmpty' => array(
            'rule' => 'notEmpty',
            'message' => 'Please enter company name.'
        ),
        'uniqueCompanyNameRule' => array(
            'rule' => 'isUnique',
            'message' => 'Name already exist'
         )
        ),
        'startTime' => array(
            'rule' => 'notEmpty',
            'message' => 'Please select Start Time.'
        ),
        'endTime' => array(
            'rule' => 'notEmpty',
            'message' => 'Please select End Time.'
        ),
        'repeatType' => array(
            'rule' => 'notEmpty',
            'message' => 'Please select any one.'
        ),
         'companyCode' => array(
            'rule' => 'notEmpty',
            'message' => 'Please enter code for your company.'
        ),
         'address' => array(
            'rule' => 'notEmpty',
            'message' => 'Please enter your company address.'
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
'RepeatCompany' => array(
                    'className' => 'RepeatCompany',
                    'foreignKey' => 'company_id',
                    'dependent' => true
            ),
'Employee' => array(
                    'className' => 'Employee',
                    'foreignKey' => 'company_id',
                    'dependent' => true
            ),
'Beacon' => array(
                    'className' => 'Beacon',
                    'foreignKey' => 'company_id',
                    'dependent' => true
            )

		);

}

<?php
App::uses('AppModel', 'Model');
/**
* User Model
*
*/
class User extends AppModel {
/* public $hasOne = array(
'Gcmreg' => array(
'className' => 'Gcmreg',
'foreignKey' => 'user_id',
'dependent' => true
)
);*/
public $validate = array(
'password' => array(
'rule' => array('minLength', '8'),
'message' => 'Minimum 8 characters long'
),
're_password' => array(
'required' => array(
  'rule'      => array('between', 8, 40),
'message' => 'Both password fields must be filled out'
),
'compare'    => array(
                'rule'      => array('validate_passwords'),
                'message'   => 'The passwords you entered do not match.',
                'allowEmpty' => true
            ),
),
/*'first_name' => array(
'rule' => 'notEmpty',
'message' => 'You have not entered your First Name.'
),
'last_name' => array(
'rule' => 'notEmpty',
'message' => 'You have not entered your Last Name.'
),*/
'school' => array(
'rule' => 'notEmpty',
'message' => 'You have not entered your School.'
),
'userview' => array(
'rule' => 'notEmpty',
'message' => 'Please select any one.'
),
'question' => array(
'rule' => 'notEmpty',
'message' => 'You have not entered your question.'
),
'answer' => array(
'rule' => 'notEmpty',
'message' => 'You have not entered your answer.'
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
'Teacher' => array(
            'className' => 'Teacher',
            'foreignKey' => 'user_id',
                'dependent' => true,
                    'conditions' => '',
                        'fields' => '',
                        'order' => '',
                        'limit' => '',
                        'offset' => '',
                    'exclusive' => '',
                'finderQuery' => '',
                'counterQuery' => ''
            ),
'Gcmreg' => array(
'className' => 'Gcmreg',
'foreignKey' => 'user_id',
'dependent' => true
),
'Role' => array(
'className' => 'Role',
'foreignKey' => 'user_id',
'dependent' => true
),
'Company' => array(
'className' => 'Company',
'foreignKey' => 'user_id',
'dependent' => true
),
'Event' => array(
'className' => 'Event',
'foreignKey' => 'user_id',
'dependent' => true
)
        );
   public function validate_passwords() {
    return $this->data[$this->alias]['password'] === $this->data[$this->alias]['re_password'];
}
}
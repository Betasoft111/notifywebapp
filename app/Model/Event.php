<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 */
class Event extends AppModel {
   
	public $hasMany = array(
      'Eventee' => array(
			'className' => 'Eventee',
			'foreignKey' => 'event_id',
			'dependent' => true	
	      ),
      'Beacon' => array(
			'className' => 'Beacon',
			'foreignKey' => 'event_id',
			'dependent' => true	
	      ),
       'RepeatEvent' => array(
			'className' => 'RepeatEvent',
			'foreignKey' => 'event_id',
			'dependent' => true	
	      )

		);
	public $validate = array(
          'eventName' => array(
        'notEmpty' => array(
            'rule' => 'notEmpty',
            'message' => 'Event name is required'
        ),
         'uniqueEventNameRule' => array(
            'rule' => 'isUnique',
            'message' => 'Event name already registered'
         )
        ),
        'startDate' => array(
            'rule' => 'notEmpty',
            'message' => 'start date is requrired'
        ),
         'endDate' => array(
            'rule' => 'notEmpty',
            'message' => 'end date is requrired'
        ),
         'startTime' => array(
            'rule' => 'notEmpty',
            'message' => 'Start time is requrired'
        ),
         'endTime' => array(
            'rule' => 'notEmpty',
            'message' => 'end time is requrired'
        ),
         'repeatType' => array(
            'rule' => 'notEmpty',
            'message' => 'Selete any one please first'
        )
     );

}

<?php
App::uses('AppModel', 'Model');
/**
 * Student Model
 *
 */
class Eventee extends AppModel {
    public $validate = array(
       'eventee_email' => array(
        'notEmpty' => array(
            'rule' => 'notEmpty',
            'message' => 'Provide an email address'
        ),
        'validEmailRule' => array(
            'rule' => array('email'),
            'message' => 'Invalid email address'
        ),
        'isexist' => array( 
        'rule' => array('isexist', 'eventCode' ,'id'), 
        'message' => 'Email already exist' 
                ) 
        )
      
     );



    
 function isexist( $field=array(), $classCode=null, $id=null )  
    { 
        foreach( $field as $key => $value ){ 
            $v1 = $value; 
            $v2 = $this->data[$this->name][$classCode]; 
            $v3 = null;
            if (isset($this->data[$this->name][$id]))
            {
                $v3 = $this->data[$this->name][$id];
            }
            if(!empty($v3))
            {

    $valid = $this->find('count', array('conditions'=> array('Eventee.eventCode' =>$v2,'Eventee.eventee_email' =>$v1, 'Eventee.id !='=>$v3)));

            if($valid > '0') { 
                return FALSE; 
            } else { 
                continue; 
            } 
            }
            else
            {
               $valid = $this->find('count', array('conditions'=> array('Eventee.eventCode' =>$v2,'Eventee.eventee_email' =>$v1)));

            if($valid > '0') { 
                return FALSE; 
            } else { 
                continue; 
            }  
            }
        } 
        return TRUE; 
    } 



}

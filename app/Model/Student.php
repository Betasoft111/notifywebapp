<?php
App::uses('AppModel', 'Model');
/**
 * Student Model
 *
 */
class Student extends AppModel {
    public $validate = array(
       'student_email' => array(
        'notEmpty' => array(
            'rule' => 'notEmpty',
            'message' => 'Provide an email address'
        ),
        'validEmailRule' => array(
            'rule' => array('email'),
            'message' => 'Invalid email address'
        ),
        'isexist' => array( 
        'rule' => array('isexist', 'classCode' ,'id'), 
        'message' => 'Email already registered' 
                ) 
        )
      
     );



    
 function isexist( $field=array(), $classCode=null, $id=null )  
    { 
        foreach( $field as $key => $value ){ 
            $v1 = $value; 
            $v2 = $this->data[$this->name][$classCode]; 
            $v3 = $this->data[$this->name][$id];
            if(!empty($v3))
            {

    $valid = $this->find('count', array('conditions'=> array('Student.classCode' =>$v2,'Student.student_email' =>$v1, 'Student.id !='=>$v3)));

            if($valid > '0') { 
                return FALSE; 
            } else { 
                continue; 
            } 
            }
            else
            {
               $valid = $this->find('count', array('conditions'=> array('Student.classCode' =>$v2,'Student.student_email' =>$v1)));

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

<?php
App::uses('AppModel', 'Model');
App::uses('StudentCode', 'Model');
/**
 * User Model
 *
 */
class Children extends AppModel {
   /* public $hasOne = array(
            'Gcmreg' => array(
                    'className' => 'Gcmreg',
                    'foreignKey' => 'user_id',
                    'dependent' => true
            )
    );*/

 public $validate = array(
          'child_name' => array(
        'notEmpty' => array(
            'rule' => 'notEmpty',
            'message' => 'Provide an email address'
        ),
        'isexist' => array( 
        'rule' => array('isexistss', 'code' ,'user_id','id'), 
        'message' => 'You have already added this child' 
                ) 
        ),
        'code' => array(
        'notEmpty' => array(
            'rule' => 'notEmpty',
            'message' => 'Please enter Child code.'
        ),
        'exists' => array(
            'rule' => array('isexist'),
            'message' => 'Please enter valid child code'
         ),
        'isexistchild'=>array(
           'rule' => array('isexistchilds','user_id','mainstu_id','id'),
            'message' => 'You have already used this code'
          )
        )
     );



    function isexist($zipcode){
$Model_B = new StudentCode();
    $valid = $Model_B->find('count', array('conditions'=> array('StudentCode.code_for_parent' =>$zipcode)));
    if ($valid == 1){
      return true;
    }
    else{
      return false;
    }
  }
function isexistss( $field=array(), $code=null, $user_id=null, $id=null)  
    { 
        foreach( $field as $key => $value ){ 
            $v1 = $value; 
            $v2 = $this->data[$this->name][$code]; 
            $v3 = $this->data[$this->name][$user_id];
            $v4 = $this->data[$this->name][$id];
            if(!empty($v4))
            {

    $valid = $this->find('count', array('conditions'=> array('Children.child_name' =>$v1,'Children.code' =>$v2,'Children.user_id'=>$v3  ,'Children.id !='=>$v4)));

            if($valid > '0') { 
                return FALSE; 
            } else { 
                continue; 
            } 
            }
            else
            {
              $valid = $this->find('count', array('conditions'=> array('Children.child_name' =>$v1,'Children.code' =>$v2,'Children.user_id'=>$v3)));

            if($valid > '0') { 
                return FALSE; 
            } else { 
                continue; 
            }  
            }
        } 
        return TRUE; 
    }
    function isexistchilds($field=array(),$user_id=null,$stu_id=null ,$id=null)  
    { 
        foreach( $field as $key => $value ){ 
            $v1 = $value; 
            $v2 = $this->data[$this->name][$user_id]; 
            $v3 = $this->data[$this->name][$stu_id];
            $v4 = $this->data[$this->name][$id];
            if(!empty($v4))
            {

    $valid = $this->find('count', array('conditions'=> array('Children.code' =>$v1,'Children.user_id' =>$v2,'Children.mainstu_id'=>$v3  ,'Children.id !='=>$v4)));

            if($valid > '0') { 
                return FALSE; 
            } else { 
                continue; 
            } 
            }
            else
            {
              $valid = $this->find('count', array('conditions'=> array('Children.code' =>$v1,'Children.user_id' =>$v2,'Children.mainstu_id'=>$v3)));

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

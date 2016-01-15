<?php
App::uses('AppController', 'Controller');
/**
 * Teachers Controller
 *
 * @property Teacher $Teacher
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class TeachersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
    public $uses=array('Teacher','School','AllMessage','Student','Gcmreg','Message','User');
/**
 * index method
 *
 * @return void
 */
 public function beforeFilter() {
    parent::beforeFilter();
    // Allow users to register and logout.
    $this->Auth->allow();
}
public function classAdd($id= NULL) 
{
      $this->layout = 'home';
      if(!empty($id) && empty($this->request->data))
      {
    // echo 'hii'; die;
      $classdata=$this->Teacher->find('first',array('conditions'=>array('Teacher.id'=>$id)));
      $this->set('classdata',$classdata);
      }
	    if (!empty($this->request->data)) {
         //echo "<pre>"; print_r($this->request->data); die;
        $this->request->data['Teacher']['user_id']=$this->Session->read('Auth.User.User.id');
        if(!empty($this->request->data['Teacher']['school_code']))
         {
        $districtdata=$this->School->find('first',array('conditions'=>array('School.school_code'=>$this->request->data['Teacher']['school_code']),'fields'=>array('id','email'))); 
           if(!empty($districtdata))
           {
        $this->request->data['Teacher']['school_id']=$districtdata['School']['id'];
           }
           
         }
         else
           {
            $this->request->data['Teacher']['school_id']='0';
           }
          if(empty($this->request->data['Teacher']['id']))
        {
          $this->request->data['Teacher']['classCode']=$this->gen_uuid();
          $this->request->data['Teacher']['latitude']='0';
          $this->request->data['Teacher']['longitude']='0';
          $this->request->data['Teacher']['status']='1';
        }
       $saveddata=$this->Teacher->save($this->request->data);
        if($saveddata)
        {
            if($saveddata['Teacher']['repeatType']=='WEEKLY')
               {
                        
          if(!empty($this->request->data['Teacher']['id']))
                 {
                  $this->RepeatClass->deleteAll(array('RepeatClass.teacher_id'=>$saveddata['Teacher']['id'],'RepeatClass.user_id'=>$saveddata['Teacher']['user_id']));
                 }
                $setdata['RepeatClass']['teacher_id']=$saveddata['Teacher']['id'];
                $setdata['RepeatClass']['repeat_on']=$this->request->data['Teacher']['repeatDays'];

               if($this->RepeatClass->save($setdata))
               {

             $this->Session->setFlash(__('Successfully added class'));
             $this->redirect(array('controller'=>'teachers','action'=>'classList'));
               }
           }
           else
           {
            $this->Session->setFlash(__('Successfully added class'));
             $this->redirect(array('controller'=>'teachers','action'=>'classList'));
           }

        }
       }
      // echo "hii";
}
public function classList($id=NULL)
{
	$this->layout='home';
	if(!empty($id))
	{
		
        $this->paginate = array(
        'conditions' => array('Teacher.school_id' => $id),
        'limit' => 10,
        'order' => array('id' => 'desc')
    );
   
	}
	else
    {
       $user_id=$this->Session->read('Auth.User.User.id'); 
       $this->paginate = array(
        'conditions' => array('Teacher.user_id' => $user_id),
        'limit' => 10,
        'order' => array('id' => 'desc')
       );

    $datamsg=$this->AllMessage->find('all',array('conditions'=>array('AllMessage.receiver_id'=>$user_id),'order' => array('id' => 'desc')));
	  $this->set('datamsg',$datamsg);
  }

	 $classdata = $this->paginate('Teacher');
   
    $this->set('classdata',$classdata);
    
}
public function delete($id = NULL)
{ 
    if(!empty($id))
    {
        $this->layout='';
        $this->autoRender=false;
        $idde=explode(',', $id);
        $y=0;
       if($this->Teacher->deleteAll(array('Teacher.id'=>$idde)))
           {
            $y++;
           }
       if($y > 0)
        {
           
            $this->Session->setFlash(__('Successfully deleted classes'));
            $this->redirect(array('controller'=>'teachers','action'=>'classList'));
        }
    }
    else
    {
        $this->Session->setFlash(__('Please select any one first'));
       $this->redirect(array('controller'=>'teachers','action'=>'classList')); 
    }
}
public function sendMessageToStudent()
{
  define("GOOGLE_API_KEY", "AIzaSyA7e1MpMHE26kylM3M2HObOwsJlWfVc_qM");
  $this->layout='';
  $this->autoRender=false;
  $user_id=$this->Session->read('Auth.User.User.id');
  $distids=$this->Teacher->find('list',array('conditions'=>array('Teacher.user_id'=>$user_id),'fields'=>array('id'),'recursive'=>-1));
  if(!empty($distids) && !empty($_POST['message']))
  {
    $uniqids=array();
   $schOwnsId=$this->Student->find('all',array('conditions'=>array('Student.teacher_id'=>$distids),'fields'=>array('student_email','id','classCode'),'recursive'=>-1));
  //$uniqids=array_unique($schOwnsId);
 // echo "<pre>"; print_r($uniqids);die;
    if(!empty($schOwnsId))
    {  $y=0;
         foreach ($schOwnsId as $schOwnsIds) {
           $userdata=$this->User->find('first',array('conditions'=>array('User.email'=>$schOwnsIds['Student']['student_email']),'fields'=>array('id'),'recursive'=>-1));
           if(!empty($userdata))
           {
            $usid=$userdata['User']['id'];
            $gcm=$this->Gcmreg->find('first',array('conditions'=>array('Gcmreg.user_id'=>$usid)));
             
               if(!empty($gcm))
               {
                 $rggcm=$gcm['Gcmreg']['reg_id'];
                $msgfg=$_POST['message'];
                $vyyyy=$this->sendPushNotificationToAndroid($rggcm,$msgfg);
               }
              $mesdata['Message']['user_id']=$user_id;
              $mesdata['Message']['student_id']=$schOwnsIds['Student']['id'];
              $mesdata['Message']['student_email']=$schOwnsIds['Student']['student_email'];
              $mesdata['Message']['class_code']=$schOwnsIds['Student']['classCode'];
              $mesdata['Message']['message']=trim($_POST['message']);
              $this->Message->create();
             if($this->Message->save($mesdata))
             {
              $y++;
             } 
           }
         }
       
        if($y>'0')
        {
        echo json_encode(array('Message'=>'1')); die;
        }
    }
    else
    {
     echo json_encode(array('Message'=>'2')); die; 
    }
  }
  else
  {
     echo json_encode(array('Message'=>'3')); die; 
  }
}
public function exportAllClass($id=NULL) {
    $this->response->download("exportAllClass.csv");
    $data = $this->Teacher->find('all',array('conditions'=>array('Teacher.school_id'=>$id),'fields'=>array('id','user_id','className','classCode','school_code','startTime','endTime','startDate','endDate','repeatType','interval')));
    $this->set(compact('data'));
    $this->layout = 'ajax';
    return;
  }
  public function exportAllClassOwn() {
    $user_id=$this->Session->read('Auth.User.User.id');
    $this->response->download("exportAllClassOwn.csv");
    $data = $this->Teacher->find('all',array('conditions'=>array('Teacher.user_id'=>$user_id),'fields'=>array('id','user_id','className','classCode','school_code','startTime','endTime','startDate','endDate','repeatType','interval')));
    $this->set(compact('data'));
    $this->layout = 'ajax';
    return;
  }

	


}

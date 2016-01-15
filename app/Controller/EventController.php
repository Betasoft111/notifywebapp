<?php
App::uses('AppController', 'Controller');
/**
 * Eventhosts Controller
 *
 * @property Eventhost $Eventhost
 * @property PaginatorComponent $Paginator
 */
class EventController extends AppController {
public $helpers = array('Form', 'Html', 'Js', 'Time');
public $uses=array('RepeatEvent','Event','Gcmreg','Eventee','User','EventeeAttendance','Attendance','Message');
/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function eventHome() {
		$this->layout = 'home';
	}
public function addevent($id=NULL) {
		$this->layout = 'home';
      if(!empty($id))
      {
      $eventdata=$this->Event->find('first',array('conditions'=>array('Event.id'=>$id)));
      $this->set('eventdata',$eventdata);
      }
	    if ($this->request->is('post')) {
        $this->request->data['Event']['user_id']=$this->Session->read('Auth.User.User.id');
        
        
          if(empty($this->request->data['Event']['id']))
        {
          $this->request->data['Event']['eventCode']=$this->gen_uuid();
          
        }
        $saveddata=$this->Event->save($this->request->data);
        if($saveddata)
        {
        	if($saveddata['Event']['repeatType']=='WEEKLY')
               {
                        
        	if(!empty($this->request->data['Event']['id']))
                 {
                  $this->RepeatEvent->deleteAll(array('RepeatEvent.event_id'=>$saveddata['Event']['id'],'RepeatEvent.user_id'=>$saveddata['Event']['user_id']));
                 }
                $setdata['RepeatEvent']['event_id']=$saveddata['Event']['id'];
                $setdata['RepeatEvent']['repeat_on']=$this->request->data['Event']['repeatDays'];

               if($this->RepeatEvent->save($setdata))
               {

             $this->Session->setFlash(__('Successfully added event'));
             $this->redirect(array('controller'=>'event','action'=>'eventList'));
               }
           }
           else
           {
           	$this->Session->setFlash(__('Successfully added event'));
             $this->redirect(array('controller'=>'event','action'=>'eventList'));
           }
        }
       }
	}
	public function eventList() {
		$this->layout='home';
	    $user_id=$this->Session->read('Auth.User.User.id'); 
        $this->paginate = array(
        'conditions' => array('Event.user_id' => $user_id),
        'limit' => 10,
        'order' => array('id' => 'desc')
       );

       $eventdata = $this->paginate('Event');
       //echo "<pre>"; print_r($eventdata); die;
      $this->set('eventdata',$eventdata);
	}
	public function delete($id = NULL)
   { 
    if(!empty($id))
    {
        $this->layout='';
        $this->autoRender=false;
        $idde=explode(',', $id);
        $y=0;
       if($this->Event->deleteAll(array('Event.id'=>$idde)))
           {
            $y++;
           }
       if($y > 0)
        {
           
            $this->Session->setFlash(__('Successfully deleted events'));
            $this->redirect(array('controller'=>'event','action'=>'eventList'));
        }
    }
    else
    {
        $this->Session->setFlash(__('Please select any one first'));
       $this->redirect(array('controller'=>'event','action'=>'eventList')); 
    }
  }
public function AddEventee($eventid=NULL, $id=NULL) 
{
    $this->layout = 'home';
   App::uses('CakeEmail', 'Network/Email');
    if(!empty($id) && empty($this->request->data))
     {
      $eventeedata=$this->Eventee->findById($id);
         $eventCode=$eventeedata['Eventee']['eventCode'];
         $eventid=$eventeedata['Eventee']['event_id'];
         $this->set(compact('eventeedata','eventCode','eventid')); 
      //echo "<pre>";print_r($studentdata); die;
     }
    if(!empty($eventid))
    {
      //echo $classid; 
       $arra2=array();
       $arra2=explode(',', $eventid);
        if($arra2['0']=='EventId')
        {
        $data=$this->Event->find('first',array('conditions'=>array('Event.id'=>$arra2['1']),'recursive'=>-1));
        $eventCode=$data['Event']['eventCode'];
         $eventid=$data['Event']['id'];
         $this->set(compact('eventCode','eventid'));  
          if ($this->request->is('post')) {
           // echo "<pre>"; print_r($this->request->data); die;
            $this->request->data['Eventee']['user_id']=$this->Session->read('Auth.User.User.id'); 
            $this->request->data['Eventee']['status']='0'; 
             if(!empty($this->request->data['Eventee']['new_image']['name']))
              {
                $file_name = $this->request->data['Eventee']['new_image']['name'];
                $file_size = $this->request->data['Eventee']['new_image']['size'];
                $file_tmp =$this->request->data['Eventee']['new_image']['tmp_name'];
                $file_type=$this->request->data['Eventee']['new_image']['type'];  
                    if($file_size < 2097152){
                   $newname=uniqid().$file_name;
                   //echo $newname; die;
                   if(move_uploaded_file($file_tmp,WWW_ROOT.'img/'.$newname))
                       {
                      $this->request->data['Eventee']['image']= $newname; 
                       }
                    } 
                    else
                    {
                      $this->Session->setFlash(__('Image is exceed from 2MB please select another')); die;
                    }
              }
              else
              {
                $this->request->data['Eventee']['image']= $this->request->data['Eventee']['old_image']; 
              }
              //echo "<pre>"; print_r($this->request->data);die;
            if($this->Eventee->save($this->request->data))
            {
                  $Email = new CakeEmail();
                  if(!empty($this->request->data['parent_email']))
                 {
                    $Email->template('welcomeevent')->emailFormat('html')->from(array('notify-noreply@abdevs.com' => 'Attendance App'))->to(array(trim($this->request->data['Eventee']['eventee_email']),trim($this->request->data['Eventee']['parent_email'])))->viewVars(array('EventCode' =>$this->request->data['Eventee']['eventCode']))->subject('For conformation')->send('you have registered for belove Event Code');
                 }
                 else
                 {
                    $Email->template('welcomeevent')->emailFormat('html')->from(array('notify-noreply@abdevs.com' => 'Attendance App'))->to(array(trim($this->request->data['Eventee']['eventee_email'])))->viewVars(array('EventCode' => $this->request->data['Eventee']['eventCode']))->subject('For conformation')->send('you have registered for belove class Code');
                 }
                 $this->Session->setFlash(__('Successfully added Eventee'));
                 $this->redirect(array('controller'=>'event','action'=>'eventeeView/'.$this->request->data['Eventee']['event_id']));
            }
           }
        }
        else
        {
           

        }
      
    }
    
}
public function eventeeView($event_id=NULL) 
{
    $this->layout = 'home';
    if(!empty($event_id))
    {
      
      $this->Eventee->Behaviors->load('Containable');
              $this->Eventee->bindModel(array(
        'hasMany' => array(
            'EventeeAttendance' => array(
                'foreignKey' => 'Eventee_id'
            ))));
      $this->paginate = array(
              'conditions' => array('Eventee.event_id' => $event_id),
              'contain'=>array('EventeeAttendance'),
              'limit' => 10,
              'order' => array('id' => 'desc')
          );
          $eventeedata = $this->paginate('Eventee');
          //echo "<pre>"; print_r($studentdata); die;
          if(!empty($eventeedata))
          {
            $arr1=array();
            foreach ($eventeedata as $eventeedatas) {
             $arr1[]=$eventeedatas['Eventee']['eventee_email'];
            }
            $list=$this->User->find('list',array('conditions'=>array('User.email'=>$arr1),'fields'=>array('id')));

            $latdat=$this->Attendance->find('all',array('conditions'=>array('Attendance.user_id'=>$list)));
             // echo "<pre>"; print_r($latdat); die;
         
              foreach($latdat as $index => $latdata){
                //$y++;
                //print_r($latdata);
                //echo $latdata[$index]['Attendance']['user_id']; die;
                 $arra1=array();
              $vendorRecord = $this->User->findById($latdata['Attendance']['user_id']);
                $arra1=explode('@', $vendorRecord['User']['email']);
              $stuemail = $arra1['0'];
              $latdat[$index]['Attendance']['email'] = $stuemail;
              }
          }
       // echo "<pre>"; print_r($latdata); die;
        // echo $y; die;
       //echo "<pre>"; print_r($latdat); die;
          $this->set(compact('eventeedata','latdat'));
    }
    
  
}
public function deleteEventee($eid = NULL, $id=NULL)
{ 
    if(!empty($id))
    {
        $this->layout='';
        $this->autoRender=false;
        $idde=explode(',', $id);
        $y=0;
      if($this->Eventee->deleteAll(array('Eventee.id'=>$idde)))
           {
            $y++;
           }
       if($y > 0)
        {
           
            $this->Session->setFlash(__('Successfully deleted Eventee'));
            $this->redirect(array('controller'=>'event','action'=>'eventeeView/'.$eid));
        }
    }
    else
    {
        $this->Session->setFlash(__('Please select any one first'));
        $this->redirect(array('controller'=>'event','action'=>'eventeeView/'.$eid));
    }
}
public function sendMessageToEventee()
{
  define("GOOGLE_API_KEY", "AIzaSyA7e1MpMHE26kylM3M2HObOwsJlWfVc_qM");
  $this->layout='';
  $this->autoRender=false;
  $user_id=$this->Session->read('Auth.User.User.id');
  $distids=$this->Event->find('list',array('conditions'=>array('Event.user_id'=>$user_id),'fields'=>array('id'),'recursive'=>-1));
  if(!empty($distids) && !empty($_POST['message']))
  {
    $uniqids=array();
   $schOwnsId=$this->Eventee->find('all',array('conditions'=>array('Eventee.event_id'=>$distids),'fields'=>array('eventee_email','id','eventCode'),'recursive'=>-1));
  //$uniqids=array_unique($schOwnsId);
 // echo "<pre>"; print_r($uniqids);die;
    if(!empty($schOwnsId))
    {  $y=0;
         foreach ($schOwnsId as $schOwnsIds) {
           $userdata=$this->User->find('first',array('conditions'=>array('User.email'=>$schOwnsIds['Eventee']['eventee_email']),'fields'=>array('id'),'recursive'=>-1));
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
              $mesdata['Message']['eventee_id']=$schOwnsIds['Eventee']['id'];
              $mesdata['Message']['eventee_email']=$schOwnsIds['Eventee']['eventee_email'];
              $mesdata['Message']['eventCode']=$schOwnsIds['Eventee']['eventCode'];
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
public function eventeeExport($id=NULL) {
    $this->response->download("eventee_export.csv");
    $data = $this->Eventee->find('all',array('conditions'=>array('Eventee.event_id'=>$id)));
    $this->set(compact('data'));
    $this->layout = 'ajax';
    return;
  }





}

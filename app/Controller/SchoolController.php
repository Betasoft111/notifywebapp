<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class SchoolController extends AppController
 {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session','Auth','Gcm');
    public $helpers=array('Paginator','Html');
  public $uses=array('School','District','Gcmreg','AllMessage','Message','Teacher','Student','User','Attendance','StudentAttendance','Children','StudentCode');
/*public function beforeFilter() 
{
    parent::beforeFilter();
    // Allow users to register and logout.
    $this->Auth->allow();
}*/

public function schoolAdd($id= NULL) 
{
      $this->layout = 'home';
      if(!empty($id) && empty($this->request->data))
      {
      $schooldata=$this->School->find('first',array('conditions'=>array('School.id'=>$id), 'recursive'=>-1));
      $this->set('schooldata',$schooldata);
      }
	    if (!empty($this->request->data)) {
        $this->request->data['School']['user_id']=$this->Session->read('Auth.User.User.id');
        if(!empty($this->request->data['School']['district_code']))
        {
         $districtdata=$this->District->find('first',array('conditions'=>array('District.district_code'=>$this->request->data['School']['district_code']),'fields'=>array('id','email'))); 
         if(!empty($districtdata))
         {
          $this->request->data['School']['district_id']=$districtdata['District']['id'];
         }
        }
        else
         {
          $this->request->data['School']['district_id']='0';
         }
        if(empty($this->request->data['School']['id']))
        {
          $this->request->data['School']['school_code']=$this->gen_uuid();
         // $this->request->data['School']['district_id']=$districtdata['District']['id'];
        }
        if($this->School->save($this->request->data))
        {
             $this->Session->setFlash(__('Successfully added school'));
             $this->redirect(array('controller'=>'school','action'=>'schoolList'));
        }
       }
}
public function delete($id = NULL)
{ 
    if(!empty($id))
    {
        $this->layout='';
        $this->autoRender=false;
        $idde=explode(',', $id);
        $y=0;
       if($this->School->deleteAll(array('School.id'=>$idde)))
           {
            $y++;
           }
       if($y > 0)
        {
           
            $this->Session->setFlash(__('Successfully deleted school'));
            $this->redirect(array('controller'=>'school','action'=>'schoolList'));
        }
    }
    else
    {
        $this->Session->setFlash(__('Please select any one first'));
       $this->redirect(array('controller'=>'school','action'=>'schoolList')); 
    }
}
public function deleteChild($id = NULL)
{ 
    if(!empty($id))
    {
        $this->layout='';
        $this->autoRender=false;
        $idde=explode(',', $id);
        $y=0;
       if($this->School->deleteAll(array('Children.id'=>$idde)))
           {
            $y++;
           }
       if($y > 0)
        {
           
            $this->Session->setFlash(__('Successfully deleted Chilren'));
            $this->redirect(array('controller'=>'school','action'=>'childList'));
        }
    }
    else
    {
        $this->Session->setFlash(__('Please select any one first'));
       $this->redirect(array('controller'=>'school','action'=>'childList')); 
    }
}
public function deleteDistrict($id = NULL)
{ 
    if(!empty($id))
    {
        $this->layout='';
        $this->autoRender=false;
        $idde=explode(',', $id);
        $y=0;
       if($this->District->deleteAll(array('District.id'=>$idde)))
           {
            $y++;
           }
       if($y > 0)
        {
           
            $this->Session->setFlash(__('Successfully deleted District'));
            $this->redirect(array('controller'=>'school','action'=>'districtList'));
        }
    }
    else
    {
        $this->Session->setFlash(__('Please select any one first'));
       $this->redirect(array('controller'=>'school','action'=>'districtList')); 
    }
}
public function deleteStudent($cid = NULL, $id=NULL)
{ 
    if(!empty($id))
    {
        $this->layout='';
        $this->autoRender=false;
        $idde=explode(',', $id);
        $y=0;
      if($this->Student->deleteAll(array('Student.id'=>$idde)))
           {
            $y++;
           }
       if($y > 0)
        {
           
            $this->Session->setFlash(__('Successfully deleted Student'));
            $this->redirect(array('controller'=>'school','action'=>'studentView/'.$cid));
        }
    }
    else
    {
        $this->Session->setFlash(__('Please select any one first'));
        $this->redirect(array('controller'=>'school','action'=>'studentView/'.$cid));
    }
}
public function districtList() 
{
    $this->layout = 'home';
    $user_id=$this->Session->read('Auth.User.User.id'); 
    $this->paginate = array(
        'conditions' => array('District.user_id' => $user_id),
        'limit' => 10,
        'order' => array('id' => 'desc')
    );

    $districtdata = $this->paginate('District');
     //echo "<pre>"; print_r($districtdata); die;
    $this->set('districtdata',$districtdata);
	
}
public function districtAdd($id= NULL) 
{
    $this->layout = 'home';
    if(!empty($id))
      {
      $districtdata=$this->District->find('first',array('conditions'=>array('District.id'=>$id), 'recursive'=>-1));
      $this->set('districtdata',$districtdata);
      }
      if ($this->request->is('post')) {
        $this->request->data['District']['user_id']=$this->Session->read('Auth.User.User.id'); 
        if(empty($this->request->data['District']['id']))
        {
          $this->request->data['District']['district_code']=$this->gen_uuid();
          //echo $this->request->data['District']['district_code']; die;
        }
        if($this->District->save($this->request->data))
        {
             $this->Session->setFlash(__('Successfully added District'));
             $this->redirect(array('controller'=>'school','action'=>'districtList'));
        }
       }
  
}
public function schoolList($distid=NULL) 
{

    $this->layout = 'home';
    if(!empty($distid))
    {
      //echo $distid; die;
      $this->School->Behaviors->load('Containable');
      $this->Teacher->Behaviors->load('Containable');
         $this->Teacher->bindModel(array(
        'belongsTo' => array(
            'User' => array(
                'foreignKey' => 'user_id'
            ))));
          $this->paginate = array(
              'conditions' => array('School.district_id' => $distid),
              'contain'=>array('Teacher'=>array('User'=>array('fields'=>array('id','first_name','last_name','email','userview')),'Student')),
              'limit' => 10,
              'order' => array('id' => 'desc')
          );
          $schooldata = $this->paginate('School');
          $this->set('schooldata',$schooldata);
    }
    else
    {
      //echo $ownertype; die;
          $user_id=$this->Session->read('Auth.User.User.id'); 
         // $roledata=$this->Session->read('Auth.User.Role');
          //echo "<pre>"; print_r($roledata); die;
          /*$down=0;
          $sown=0;
          $teach=0;
          if(!empty($roledata))
          {
            foreach ($roledata as $roledatas) {
             if($roledatas['role']=='9')
             {
              $sown++;
             }
             if($roledatas['role']=='8')
             {
              $down++;
             }
             if($roledatas['role']=='1')
             {
              $teach++;
             }
            }
          }*/
          //echo $rl;die;
         // if($ownertype=='9')
         // {
$this->School->Behaviors->load('Containable');
$this->Teacher->Behaviors->load('Containable');
         $this->Teacher->bindModel(array(
        'belongsTo' => array(
            'User' => array(
                'foreignKey' => 'user_id'
            ))));
      $this->paginate = array(
              'conditions' => array('School.user_id' => $user_id),
              'contain'=>array('Teacher'=>array('User'=>array('fields'=>array('id','first_name','last_name','email','userview')),'Student')),
              'limit' => 10,
              'order' => array('id' => 'desc')
          );
          $schooldata = $this->paginate('School');

          $datamsg=$this->AllMessage->find('all',array('conditions'=>array('AllMessage.receiver_id'=>$user_id),'order' => array('id' => 'desc')));
          //echo "<pre>"; print_r($datamsg); die;
          $this->set(compact('schooldata','datamsg'));
          //}
          /*else if ($ownertype=='9') 
          {
            $this->redirect(array('controller'=>'school','action'=>'districtList')); 
          }
          else if($ownertype=='1')
          {
             $this->redirect(array('controller'=>'teachers','action'=>'classList'));
          } 
          else
          {
             $this->redirect(array('controller'=>'School','action'=>'studentView'));
          }*/
    }

   

    
}
public function studentView($class_id=NULL) 
{
    $this->layout = 'home';
    if(!empty($class_id))
    {
      
      $this->Student->Behaviors->load('Containable');
              $this->Student->bindModel(array(
        'hasMany' => array(
            'StudentAttendance' => array(
                'foreignKey' => 'student_id'
            ))));
      $this->paginate = array(
              'conditions' => array('Student.teacher_id' => $class_id),
              'contain'=>array('StudentAttendance'),
              'limit' => 10,
              'order' => array('id' => 'desc')
          );
          $studentdata = $this->paginate('Student');
          //echo "<pre>"; print_r($studentdata); die;
          if(!empty($studentdata))
          {
            $arr1=array();
            foreach ($studentdata as $studentdatas) {
             $arr1[]=$studentdatas['Student']['student_email'];
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
          $this->set(compact('studentdata','latdat'));
    }
    
	
}
public function school() 
{
    $this->layout = 'home';
    
}

public function AddStudent($classid=NULL, $id=NULL) 
{
    $this->layout = 'home';
   App::uses('CakeEmail', 'Network/Email');
    if(!empty($id) && empty($this->request->data))
     {
      $studentdata=$this->Student->findById($id);
         $classCode=$studentdata['Student']['classCode'];
         $classid=$studentdata['Student']['teacher_id'];
         $this->set(compact('studentdata','classCode','classid')); 
      //echo "<pre>";print_r($studentdata); die;
     }
    if(!empty($classid))
    {
      //echo $classid; 
       $arra2=array();
       $arra2=explode(',', $classid);
        if($arra2['0']=='ClassId')
        {
        $data=$this->Teacher->find('first',array('conditions'=>array('Teacher.id'=>$arra2['1']),'recursive'=>-1));
        $classCode=$data['Teacher']['classCode'];
         $classid=$data['Teacher']['id'];
         $this->set(compact('classCode','classid'));  
          if ($this->request->is('post')) {
           // echo "<pre>"; print_r($this->request->data); die;
            $this->request->data['Student']['user_id']=$this->Session->read('Auth.User.User.id'); 
            $this->request->data['Student']['status']='0'; 
             if(!empty($this->request->data['Student']['new_image']['name']))
              {
                $file_name = $this->request->data['Student']['new_image']['name'];
                $file_size = $this->request->data['Student']['new_image']['size'];
                $file_tmp =$this->request->data['Student']['new_image']['tmp_name'];
                $file_type=$this->request->data['Student']['new_image']['type'];  
                    if($file_size < 2097152){
                   $newname=uniqid().$file_name;
                   //echo $newname; die;
                   if(move_uploaded_file($file_tmp,WWW_ROOT.'img/'.$newname))
                       {
                      $this->request->data['Student']['image']= $newname; 
                       }
                    } 
                    else
                    {
                      $this->Session->setFlash(__('Image is exceed from 2MB please select another')); die;
                    }
              }
              else
              {
                $this->request->data['Student']['image']= $this->request->data['Student']['old_image']; 
              }
              //echo "<pre>"; print_r($this->request->data);die;
            if($this->Student->save($this->request->data))
            {
                  $Email = new CakeEmail();
                  if(!empty($this->request->data['parent_email']))
                 {
                    $Email->template('welcome')->emailFormat('html')->from(array('notify-noreply@abdevs.com' => 'Attendance App'))->to(array(trim($this->request->data['Student']['student_email']),trim($this->request->data['Student']['parent_email'])))->viewVars(array('ClassCode' =>$this->request->data['Student']['classCode']))->subject('For conformation')->send('you have registered for belove class Code');
                 }
                 else
                 {
                    $Email->template('welcome')->emailFormat('html')->from(array('notify-noreply@abdevs.com' => 'Attendance App'))->to(array(trim($this->request->data['Student']['student_email'])))->viewVars(array('ClassCode' => $this->request->data['Student']['classCode']))->subject('For conformation')->send('you have registered for belove class Code');
                 }
                 $this->Session->setFlash(__('Successfully added Student'));
                 $this->redirect(array('controller'=>'school','action'=>'studentView/'.$this->request->data['Student']['teacher_id']));
            }
           }
        }
        else
        {
           

        }
      
    }
    
}
public function childList()
{
  $this->layout = 'home';
      $user_id=$this->Session->read('Auth.User.User.id');
      $this->paginate = array(
              'conditions' => array('Children.user_id' => $user_id),
              'limit' => 10,
              'order' => array('id' => 'desc')
          );
          $studentdata = $this->paginate('Children');
          if(!empty($studentdata))
          {
            $arr1=array();
            foreach ($studentdata as $studentdatas) {
             $arr1[]=$studentdatas['Children']['mainstu_id'];
            }
           $latdat=$this->Attendance->find('all',array('conditions'=>array('Attendance.user_id'=>$arr1)));
             foreach($latdat as $index => $latdata)
              {
                $arra1=array();
                $vendorRecord = $this->Children->findByMainstuId($latdata['Attendance']['user_id']);
                $arra1=$vendorRecord['Children']['child_name'];
                $latdat[$index]['Attendance']['email'] = $arra1;
              }
          }
       $this->set(compact('studentdata','latdat'));
}
public function childView($id=NULL)
{
  $this->layout = 'home';
  if(!empty($id))
  {
    $childData=$this->Children->find('first',array('conditions'=>array('Children.id'=>$id)));
    $arr1=array();
    $arr1=explode(',', $childData['Children']['student_id']);
    $this->Student->Behaviors->load('Containable');
               $this->Student->bindModel(array(
        'belongsTo' => array(
            'Teacher' => array(
                'foreignKey' => 'teacher_id'
            ))));
          $this->Student->bindModel(array(
        'hasMany' => array(
            'StudentAttendance' => array(
                'foreignKey' => 'student_id'
            ))));
          $this->Teacher->bindModel(array(
        'belongsTo' => array(
            'User' => array(
                'foreignKey' => 'user_id'
            ))));
    $studata=$this->Student->find('all',array('conditions'=>array('Student.id'=>$arr1),'contain'=>array('Teacher'=>array('User'),'StudentAttendance')));
    //echo "<pre>"; print_r($studata); die;
    $this->set(compact('childData','studata'));

  }

}
public function addChild($id=NULL) 
{
    $this->layout = 'home';
    if(!empty($id))
      {
      $studentdata=$this->Children->find('first',array('conditions'=>array('Children.id'=>$id), 'recursive'=>-1));
      $this->set('studentdata',$studentdata);
      }
      if ($this->request->is('post')) {
        $this->request->data['Children']['user_id']=$this->Session->read('Auth.User.User.id');
        //if(empty($this->request->data['Children']['id']))
        //{
        $v5=$this->request->data['Children']['code']; 
        $dta=$this->StudentCode->find('first',array('conditions'=>array('StudentCode.code_for_parent'=>$v5)));
        if(empty($this->request->data['Children']['mainstu_id']))
        {
        $this->request->data['Children']['mainstu_id']=@$dta['StudentCode']['user_id'];
        }
        $userdata=$this->User->find('first',array('conditions'=>array('User.id'=>@$dta['StudentCode']['user_id']),'fields'=>array('id','email')));
        $studata=$this->Student->find('list',array('conditions'=>array('Student.student_email'=>@$userdata['User']['email']),'fields'=>array('id')));
        //echo "<pre>"; print_r($studata);die;
        $studata1= implode(",",$studata);
        if(empty($this->request->data['Children']['student_id']))
        {
        $this->request->data['Children']['student_id']=$studata1;
        }
//}
        //echo "<pre>"; print_r($this->request->data); die;
        if($this->Children->save($this->request->data))
        {
             $this->Session->setFlash(__('Successfully added Child'));
             $this->redirect(array('controller'=>'school','action'=>'childList'));
        }
       }
    
}
public function sendMessage($opt=NULL)
{
  $this->layout='';
  $this->autoRender=false;
   define("GOOGLE_API_KEY", "AIzaSyA7e1MpMHE26kylM3M2HObOwsJlWfVc_qM");
  $user_id=$this->Session->read('Auth.User.User.id');
  $distids=$this->District->find('list',array('conditions'=>array('District.user_id'=>$user_id),'fields'=>array('id'),'recursive'=>-1));
  if(!empty($distids) && !empty($_POST['message']))
  {

   $uniqids=array();
   $schOwnsId=$this->School->find('list',array('conditions'=>array('School.district_id'=>$distids),'fields'=>array('user_id'),'recursive'=>-1));
  $uniqids=array_unique($schOwnsId);
 // echo "<pre>"; print_r($uniqids);die;
    if(!empty($uniqids))
    {  
        if($opt=='2')
     {
      $y=0;
         foreach ($uniqids as $key => $uniqid) {
          $mesdata['AllMessage']['user_id']=$user_id;
            $mesdata['AllMessage']['receiver_id']=$uniqid;
            $mesdata['AllMessage']['message']=trim($_POST['message']);
            $this->AllMessage->create();
           if($this->AllMessage->save($mesdata))
           {
            $y++;
           } 
         }
     }
       else if($opt=='1')
       {
           $y=0;
         foreach ($uniqids as $key => $uniqid) {
          $mesdata1['AllMessage']['user_id']=$user_id;
            $mesdata1['AllMessage']['receiver_id']=$uniqid;
            $mesdata1['AllMessage']['message']=trim($_POST['message']);
            $this->AllMessage->create();
           if($this->AllMessage->save($mesdata1))
           {
            $y++;
           } 
         }
  $uniqids1=array();
   $schId=$this->School->find('list',array('conditions'=>array('School.district_id'=>$distids),'fields'=>array('id'),'recursive'=>-1));
   $schOwnsId=$this->Teacher->find('list',array('conditions'=>array('Teacher.school_id'=>$schId),'fields'=>array('user_id'),'recursive'=>-1));
   $uniqids1=array_unique($schOwnsId);
    if(!empty($uniqids1))
    {

        foreach ($uniqids1 as $key => $uniqid1) {
               $gcm=$this->Gcmreg->find('first',array('conditions'=>array('Gcmreg.user_id'=>$uniqid1)));
                
                 if(!empty($gcm))
                 {
                  $rggcm=$gcm['Gcmreg']['reg_id'];
                  $msgfg=$_POST['message'];
                  $vyyyy=$this->sendPushNotificationToAndroid($rggcm,$msgfg);
                 }

              $mesdata2['AllMessage']['user_id']=$user_id;
                $mesdata2['AllMessage']['receiver_id']=$uniqid1;
                $mesdata2['AllMessage']['message']=trim($_POST['message']);
                $this->AllMessage->create();
               if($this->AllMessage->save($mesdata2))
               {
                $y++;
               } 
             }
    }
           $classid=$this->Teacher->find('list',array('conditions'=>array('Teacher.school_id'=>$schId),'fields'=>array('id'),'recursive'=>-1));
            if(!empty($classid))
            {

            $studata=$this->Student->find('all',array('conditions'=>array('Student.teacher_id'=>$classid),'fields'=>array('student_email','id','classCode'),'recursive'=>-1));
            if(!empty($studata))
             {

                  foreach ($studata as $studatas) {
                   $userdata1=$this->User->find('first',array('conditions'=>array('User.email'=>$studatas['Student']['student_email']),'fields'=>array('id'),'recursive'=>-1));
                   if(!empty($userdata1))
                   {
                    $usid1=$userdata1['User']['id'];
                    $gcm1=$this->Gcmreg->find('first',array('conditions'=>array('Gcmreg.user_id'=>$usid1)));
                    if(!empty($gcm1))
                       {
                         $rggcm1=$gcm1['Gcmreg']['reg_id'];
                        $msgfg1=$_POST['message'];
                        $vyyyy=$this->sendPushNotificationToAndroid($rggcm1,$msgfg1);
                       }
                      $mesdata3['Message']['user_id']=$user_id;
                      $mesdata3['Message']['student_id']=$studatas['Student']['id'];
                      $mesdata3['Message']['student_email']=$studatas['Student']['student_email'];
                      $mesdata3['Message']['class_code']=$studatas['Student']['classCode'];
                      $mesdata3['Message']['message']=trim($_POST['message']);
                      $this->Message->create();
                     if($this->Message->save($mesdata3))
                     {
                      $y++;
                     } 
                   }
                 }
             }
            }
         }
         else if($opt=='3')
         { 
            $y=0;
             $uniqids1=array();
             $schId=$this->School->find('list',array('conditions'=>array('School.district_id'=>$distids),'fields'=>array('id'),'recursive'=>-1));
             $schOwnsId=$this->Teacher->find('list',array('conditions'=>array('Teacher.school_id'=>$schId),'fields'=>array('user_id'),'recursive'=>-1));
             $uniqids1=array_unique($schOwnsId);
              if(!empty($uniqids1))
              {

                  foreach ($uniqids1 as $key => $uniqid1) {
                         $gcm=$this->Gcmreg->find('first',array('conditions'=>array('Gcmreg.user_id'=>$uniqid1)));
                          
                           if(!empty($gcm))
                           {
                            $rggcm=$gcm['Gcmreg']['reg_id'];
                            $msgfg=$_POST['message'];
                            $vyyyy=$this->sendPushNotificationToAndroid($rggcm,$msgfg);
                           }

                        $mesdata['AllMessage']['user_id']=$user_id;
                          $mesdata['AllMessage']['receiver_id']=$uniqid1;
                          $mesdata['AllMessage']['message']=trim($_POST['message']);
                          $this->AllMessage->create();
                         if($this->AllMessage->save($mesdata))
                         {
                          $y++;
                         } 
                       }
              }
         }
         else
         {
          $y=0;
          $schId=$this->School->find('list',array('conditions'=>array('School.district_id'=>$distids),'fields'=>array('id'),'recursive'=>-1));
             $classid=$this->Teacher->find('list',array('conditions'=>array('Teacher.school_id'=>$schId),'fields'=>array('id'),'recursive'=>-1));
            if(!empty($classid))
            {

            $studata=$this->Student->find('all',array('conditions'=>array('Student.teacher_id'=>$classid),'fields'=>array('student_email','id','classCode'),'recursive'=>-1));
            if(!empty($studata))
             {

                  foreach ($studata as $studatas) {
                   $userdata1=$this->User->find('first',array('conditions'=>array('User.email'=>$studatas['Student']['student_email']),'fields'=>array('id'),'recursive'=>-1));
                   if(!empty($userdata1))
                   {
                    $usid1=$userdata1['User']['id'];
                    $gcm1=$this->Gcmreg->find('first',array('conditions'=>array('Gcmreg.user_id'=>$usid1)));
                    if(!empty($gcm1))
                       {
                         $rggcm1=$gcm1['Gcmreg']['reg_id'];
                        $msgfg1=$_POST['message'];
                        $vyyyy=$this->sendPushNotificationToAndroid($rggcm1,$msgfg1);
                       }
                      $mesdata['Message']['user_id']=$user_id;
                      $mesdata['Message']['student_id']=$studatas['Student']['id'];
                      $mesdata['Message']['student_email']=$studatas['Student']['student_email'];
                      $mesdata['Message']['class_code']=$studatas['Student']['classCode'];
                      $mesdata['Message']['message']=trim($_POST['message']);
                      $this->Message->create();
                     if($this->Message->save($mesdata))
                     {
                      $y++;
                     } 
                   }
                 }
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
public function sendMessageToTeacher($opt=NULL)
{
  $this->layout='';
  $this->autoRender=false;
  define("GOOGLE_API_KEY", "AIzaSyA7e1MpMHE26kylM3M2HObOwsJlWfVc_qM");
  $user_id=$this->Session->read('Auth.User.User.id');
  $distids=$this->School->find('list',array('conditions'=>array('School.user_id'=>$user_id),'fields'=>array('id'),'recursive'=>-1));
  if(!empty($distids) && !empty($_POST['message']))
  {
    $uniqids=array();
   $schOwnsId=$this->Teacher->find('list',array('conditions'=>array('Teacher.school_id'=>$distids),'fields'=>array('user_id'),'recursive'=>-1));
  $uniqids=array_unique($schOwnsId);
 // echo "<pre>"; print_r($uniqids);die;
    if(!empty($uniqids))
    {  $y=0;
           if($opt=='2' )
           {
              foreach ($uniqids as $key => $uniqid) {
               $gcm=$this->Gcmreg->find('first',array('conditions'=>array('Gcmreg.user_id'=>$uniqid)));
                if(!empty($gcm))
                {
                    $rggcm=$gcm['Gcmreg']['reg_id'];
                     if(!empty($rggcm))
                     {
                      $msgfg=$_POST['message'];
                      $vyyyy=$this->sendPushNotificationToAndroid($rggcm,$msgfg);
                     }
                }

              $mesdata['AllMessage']['user_id']=$user_id;
                $mesdata['AllMessage']['receiver_id']=$uniqid;
                $mesdata['AllMessage']['message']=trim($_POST['message']);
                $this->AllMessage->create();
               if($this->AllMessage->save($mesdata))
               {
                $y++;
               } 
             }
           }
           else if($opt=='1')
           {
            foreach ($uniqids as $key => $uniqid) {
               $gcm=$this->Gcmreg->find('first',array('conditions'=>array('Gcmreg.user_id'=>$uniqid)));
                if(!empty($gcm))
                {
                  $rggcm=$gcm['Gcmreg']['reg_id'];
                   if(!empty($rggcm))
                   {
                    $msgfg=$_POST['message'];
                    $vyyyy=$this->sendPushNotificationToAndroid($rggcm,$msgfg);
                   }
                }

              $mesdata['AllMessage']['user_id']=$user_id;
                $mesdata['AllMessage']['receiver_id']=$uniqid;
                $mesdata['AllMessage']['message']=trim($_POST['message']);
                $this->AllMessage->create();
               if($this->AllMessage->save($mesdata))
               {
                $y++;
               } 
             }
           $distids=$this->Teacher->find('list',array('conditions'=>array('Teacher.school_id'=>$distids),'fields'=>array('id'),'recursive'=>-1));
            if(!empty($distids))
            {

            $schOwnsId=$this->Student->find('all',array('conditions'=>array('Student.teacher_id'=>$distids),'fields'=>array('student_email','id','classCode'),'recursive'=>-1));
            if(!empty($schOwnsId))
             {

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
             }
            }
          }
          else
          {

             $distids=$this->Teacher->find('list',array('conditions'=>array('Teacher.school_id'=>$distids),'fields'=>array('id'),'recursive'=>-1));
            if(!empty($distids))
            {

            $schOwnsId=$this->Student->find('all',array('conditions'=>array('Student.teacher_id'=>$distids),'fields'=>array('student_email','id','classCode'),'recursive'=>-1));
            if(!empty($schOwnsId))
             {

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
public function gen_uuid() {
   $len=6;
    $hex = md5("abcdefghijklmnopqrstuvwxyz0123456789" . uniqid("", true));

    $pack = pack('H*', $hex);
    $tmp =  base64_encode($pack);

    $uid = preg_replace("#(*UTF8)[^a-z0-9]#", "", $tmp);

    $len = max(4, min(128, $len));

    while (strlen($uid) < $len)
        $uid .= $this->gen_uuid(22);
        
    return substr($uid, 0, $len);die;
}

public function export($id=NULL) {
    $this->response->download("export.csv");
    $data = $this->Student->find('all',array('conditions'=>array('Student.teacher_id'=>$id)));
    $this->set(compact('data'));
    $this->layout = 'ajax';
    return;
  }
  public function exportSchool($id=NULL) {
    $this->response->download("exportSchool.csv");
    $data = $this->School->find('all',array('conditions'=>array('School.district_id'=>$id),'fields'=>array('id','user_id','school_name','email','district_code','school_code','address','created'),'recursive'=>-1));
    $this->set(compact('data'));
    $this->layout = 'ajax';
    return;
  }
   public function exportSchoolown() {
   $user_id=$this->Session->read('Auth.User.User.id');
    $this->response->download("exportSchoolown.csv");
    $data = $this->School->find('all',array('conditions'=>array('School.user_id'=>$user_id),'fields'=>array('id','user_id','school_name','email','district_code','school_code','address','created'),'recursive'=>-1));
    $this->set(compact('data'));
    $this->layout = 'ajax';
    return;
  }
public function stuView($id=NULL,$class_id=NULL)
{
  $this->layout = 'home';
  if(!empty($id))
  {
    //$childData=$this->Children->find('first',array('conditions'=>array('Children.id'=>$id)));
  //  $arr1=array();
   // $arr1=explode(',', $childData['Children']['student_id']);
    /*$this->Student->Behaviors->load('Containable');
           
          $this->Student->bindModel(array(
        'hasMany' => array(
            'StudentAttendance' => array(
                'foreignKey' => 'student_id'
            ))));
          $this->Teacher->bindModel(array(
        'belongsTo' => array(
            'User' => array(
                'foreignKey' => 'user_id'
            ))));*/
    //$studata=$this->Student->find('all',array('conditions'=>array('Student.id'=>$id),'contain'=>array('StudentAttendance')));
    $studata=$this->StudentAttendance->find('all',array('conditions'=>array('StudentAttendance.student_id'=>$id,'StudentAttendance.teacher_id'=>$class_id),'recursive'=>-1));
    //echo "<pre>"; print_r($studata); die;
    $this->set(compact('studata','class_id'));

  }

}
public function exportAbsences($class_id=NULL) {
    $this->response->download("exportAbsences.csv");
    $data = $this->StudentAttendance->find('all',array('conditions'=>array('StudentAttendance.teacher_id'=>$class_id)));
    $this->set(compact('data'));
    $this->layout = 'ajax';
    return;
  }



}
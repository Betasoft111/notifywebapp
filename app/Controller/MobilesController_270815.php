<?php
App::uses('AppController', 'Controller');
/**
 * Teachers Controller
 *
 * @property Teacher $Teacher
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class MobilesController extends AppController {
   public $components=array('Sms');

public function beforeFilter() {
          parent::beforeFilter();
           $this->Auth->allow('login','gen_uuid','deleteClassByTeacher','notificationlist','editAttandence','deleteAttendanceByTeacher','sendPushNotificationToAndroid','export','sendNotificationToTeacher','customReport','schoollist','deleteChildParent','userRegistered','attandenceList','updateRole','sendPushNotificationToGCM','studentmsglist','saveRegId','addClassByStudent','addStudent','teacherdata','forgatpassword','addClassByTeacher','matchCode','updatePassword','addchild','studentAttendens','studentmsglist','getquestion','attendenceByStudent','deleteStudentByTeacher','attandenceListByStudent','addBeacons','addCodeForParent','attandenceListByParent','addRole','getlatlong','editChild','addEventByEventHost','addEventee','addCompanyByManager','addEmployee','addEventByEventee','addCompanyByEmployee','eventeeAttendens','employeeAttendens');
      }
  public function userRegistered()
  {
    if(!empty($_POST['email']) && !empty($_POST['school']) && !empty($_POST['userview']) && !empty($_POST['securityQuestion']) && !empty($_POST['securityQuestionAnswer']))
    {
      $this->loadModel('User');
      if(!isset($_POST['id']))
      {
        $count=$this->User->find('count',array('conditions'=>array('User.email'=>trim($_POST['email']))));
        if($count > '0')
        {
        echo json_encode(array('Error'=>'Email already exist.'));die;
        }  
      }
      else
      {
       $count=$this->User->find('count',array('conditions'=>array('User.email'=>trim($_POST['email']),'User.id !='=>$_POST['id'])));
        if($count > '0')
        {
        echo json_encode(array('Error'=>'Email already exist.'));die;
        } 
      }
      //$userdata['User']['first_name']=trim($_POST['name']);
      $userdata['User']['email']=trim($_POST['email']);
      if(!isset($_POST['id']) && !empty($_POST['password']))
      {
       $userdata['User']['password_dummy']=trim($_POST['password']);
       $userdata['User']['password']=hash('ripemd160',trim($_POST['password'])); 
      }
      if(isset($_POST['id']) && !empty($_POST['password']))
      {
         $userdata['User']['password_dummy']=trim($_POST['password']);
         $userdata['User']['password']=hash('ripemd160',trim($_POST['password']));
      }
      if(isset($_POST['id']))
      {
        $userdata['User']['id']=trim($_POST['id']);
      }

      $userdata['User']['school']=trim($_POST['school']);
      $userdata['User']['userview']=trim($_POST['userview']);
      $userdata['User']['question']=trim($_POST['securityQuestion']);
      $userdata['User']['answer']=trim($_POST['securityQuestionAnswer']);
      $userdata['User']['status']=trim($_POST['status']);
      $userdata['User']['fullname']=trim($_POST['fullname']);
      if(!isset($_POST['id']))
      {
            if(!empty($_POST['facebook_id']))
            {
             $count2=$this->User->find('count',array('conditions'=>array('User.facebook_id'=>trim($_POST['facebook_id']))));
                  if($count2 > '0')
                     {
                     echo json_encode(array('Error'=>'FacebookId already exist.'));die;
                     }
                   else
                     {
                      $userdata['User']['facebook_id']=trim($_POST['facebook_id']);
                     }
            
            }
            if(!empty($_POST['google_id']))
            {
               $count2=$this->User->find('count',array('conditions'=>array('User.google_id'=>trim($_POST['google_id']))));
                  if($count2 > '0')
                     {
                     echo json_encode(array('Error'=>'GoogleId already exist.'));die;
                     }
                     else
                     {
                     $userdata['User']['google_id']=trim($_POST['google_id']);
                     }
            
            }
            if(!empty($_POST['twitter_id']))
            {
                  $count2=$this->User->find('count',array('conditions'=>array('User.twitter_id'=>trim($_POST['twitter_id']))));
                  if($count2 > '0')
                     {
                     echo json_encode(array('Error'=>'TwitterId already exist.'));die;
                     }
                     else
                     {
                    $userdata['User']['twitter_id']=trim($_POST['twitter_id']);
                     }
            }
      }
      if(!isset($_POST['id']))
      {
          $userdata['User']['code']=uniqid('UC');
          $userdata['User']['device_token']=trim($_POST['deviceToken']);
      }
      
          $usdata=$this->User->save($userdata);
          $this->User->Behaviors->load('Containable');
          $data=$this->User->find('first',array('conditions'=>array('User.id'=>$usdata['User']['id']),'fields'=>array('id','username','email','school','userview','status','code','device_token','created'),'contain'=>array('Role'=>array('order' => array('Role.created' => 'ASC')))));
      if(!empty($data))
      {
        echo json_encode(array('Message'=>'Saved successfully','Data'=>$data)); die;
      }
      else
      {
        echo json_encode(array('Error'=>'Not Saved')); die; 
      }
      
    }
else
{
echo json_encode(array('Error'=>'All fields are required')); die;
}
  }
  public function updateRole()
  {
    if(!empty($_POST['id']) && !empty($_POST['role']))
    {
      $this->loadModel('User');
      $this->User->id=trim($_POST['id']);
     $updata=$this->User->saveField('role', trim($_POST['role']));
      if(!empty($updata))
      {
        $this->User->Behaviors->load('Containable');
        $data=$this->User->find('all',array('conditions'=>array('User.id'=>$updata['User']['id']),'fields'=>array('id','username','email','school','userview','role','status','code','device_token','created'),'contain'=>array('Teacher'=>array('Student'=>array('order' => array('Student.id' => 'DESC'))))));
        echo json_encode(array('Message'=>'Successfully updated your role','Data'=>$data)); die;
      }
      else
      {
       echo json_encode(array('Error'=>'Not successfully updated')); die; 
      }
    }
  }
  function sendPushNotificationToGCM() {
    //Google cloud messaging GCM-API url
      $this->loadModel('Gcmreg');
      $this->loadModel('User');
      $this->loadModel('Message');
      if(!empty($_POST['message']) && !empty($_POST['student_emails']) && !empty($_POST['class_unique_code']) && !empty($_POST['student_id']) && !empty($_POST['user_id']))
      {
        $emails=array();
        $studentids=array();
        $studentids=explode(',',  trim($_POST['student_id']));
        $emails=explode(',', trim($_POST['student_emails']));
        if(!empty($studentids) && !empty($_POST['message']))
        {
          $y=0;
           for ($i=0; $i <count($studentids) ; $i++) 
           { 
               $msgdata['Message']['user_id']=trim($_POST['user_id']);
               $msgdata['Message']['student_id']=$studentids[$i];
               $msgdata['Message']['student_email']=$emails[$i];
               $msgdata['Message']['class_code']=trim($_POST['class_unique_code']);
               $msgdata['Message']['message']=trim($_POST['message']);
               $this->Message->create();
               if($this->Message->save($msgdata))
               {
                $y++;
               }
           }
        }
        $this->User->Behaviors->load('Containable');
        $userids=$this->User->find('all',array('conditions'=>array('User.email'=>$emails),'fields'=>array('id','email','role'),'contain'=>array('Gcmreg')));
      if(!empty($userids))
      {
        $i=0;
       define("GOOGLE_API_KEY", "AIzaSyA7e1MpMHE26kylM3M2HObOwsJlWfVc_qM"); 
        foreach ($userids as $userid) 
        { 
               if(!empty($userid['Gcmreg'][$i]['reg_id']))
               {
               $url = 'https://android.googleapis.com/gcm/send';
            $fields = array(
                'registration_ids' => array($userid['Gcmreg'][$i]['reg_id']),
                'data' => array("m" => trim($_POST['message']),"classCode"=>trim($_POST['class_unique_code'])),

            );
        // Google Cloud Messaging GCM API Key
           
            $headers = array(
                'Authorization: key=' . GOOGLE_API_KEY,
                'Content-Type: application/json'
            );
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0); 
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            $result = curl_exec($ch);       
            if ($result === FALSE) {
                die('Curl failed: ' . curl_error($ch));
            }
            curl_close($ch);
            echo $result;
          }
            $i++; 
        }die;
      }die;

      }
     
        
    }
    public function studentmsglist()
    {
      $this->loadModel('Message');
      if(!empty($_POST['email']) && !empty($_POST['class_code']))
      {
        
        $data=$this->Message->find('all',array('conditions'=>array('Message.student_email'=>$_POST['email'],'Message.class_code'=>$_POST['class_code']),'order' => array('Message.id' => 'DESC')));
           if(!empty($data))
           {
            echo json_encode(array('Message'=>'List of students message.','Data'=>$data)); die;
           }
            else
           {
            echo json_encode(array('Error'=>'No notification found!')); die;
           }
      }
      if(!empty($_POST['user_id']) && !empty($_POST['class_code']))
      {
            $data=$this->Message->find('all',array('conditions'=>array('Message.user_id'=>$_POST['user_id'],'Message.class_code'=>$_POST['class_code']),'fields'=>array('DISTINCT Message.created','Message.message')));
           if(!empty($data))
           {
            echo json_encode(array('Message'=>'List of students message.','Data'=>$data)); die;
           }
            else
           {
            echo json_encode(array('Error'=>'No notification found!')); die;
           }
      }
    }
   public function saveRegId()
    {
      $this->loadModel('Gcmreg');
      if(!empty($_POST['reg_id']))
      {
        $this->Gcmreg->deleteAll(array('Gcmreg.user_id' => $_POST['user_id']));
        $regData['Gcmreg']['reg_id']=trim($_POST['reg_id']);
        $regData['Gcmreg']['user_id']=trim($_POST['user_id']);
        $regData['Gcmreg']['devtok']=trim($_POST['devtok']); 
        if($this->Gcmreg->save($regData))
        {
          echo json_encode(array('Message'=>'Successfully saved.')); die;
        }
      }
    }
  public function addClassByStudent()
   { 
      if(!empty($_POST['class_code']) && !empty($_POST['student_email']))
      { 
        $sats=$_POST['status'];
        $this->loadModel('Student');
        $this->loadModel('Teacher');
        $count=$this->Student->find('count',array('conditions'=>array('student_email' => $_POST['student_email'],'classCode' => $_POST['class_code'])));
        $teacherdata=$this->Teacher->find('first',array('conditions'=>array('Teacher.classCode'=>trim($_POST['class_code'])),'recursive'=>-1));
        $tecount=$this->Teacher->find('count',array('conditions'=>array('Teacher.classCode'=>trim($_POST['class_code'])))); 
        if($tecount=='0')
        {
        echo json_encode(array('Error'=>'Class is wrong Code.')); die;
        }
       if($count =='1')
          {
          $success=$this->Student->updateAll(array('status' => "'$sats'"), array('student_email' => $_POST['student_email'],'classCode' => $_POST['class_code']));    
          
             echo json_encode(array('Message'=>'Successfully added','Data'=>$teacherdata)); die;
          }
        else
        {       
              $datastu['Student']['user_id']=$teacherdata['Teacher']['user_id'];
              $datastu['Student']['classCode']=$_POST['class_code'];
              $datastu['Student']['student_email']=$_POST['student_email'];
              $datastu['Student']['status']='1';
              $datastu['Student']['teacher_id']=$teacherdata['Teacher']['id'];
              if($this->Student->save($datastu))
              {
             echo json_encode(array('Message'=>'Successfully added','Data'=>$teacherdata)); die;
              }
              else
              {
              echo json_encode(array('Error'=>'Not added successfully.')); die;
              }

        }  
      }
      else
      {
         echo json_encode(array('Error'=>'Please insert value first.')); die;
      }

   }
   public function addEventByEventee()
   { 
      if(!empty($_POST['event_code']) && !empty($_POST['eventee_email']) && !empty($_POST['status']))
      { 
        $sats=$_POST['status'];
        $this->loadModel('Eventee');
        $this->loadModel('Event');
       $success=$this->Eventee->updateAll(array('status' => "'$sats'"), array('eventee_email' => $_POST['eventee_email'],'eventCode' => $_POST['event_code']));    
      
         $teacherdata=$this->Teacher->find('first',array('conditions'=>array('Event.eventCode'=>trim($_POST['event_code'])),'recursive'=>-1));         
       if(!empty($success))
          {
             echo json_encode(array('Message'=>'Successfully added','Data'=>$teacherdata)); die;
          }  
      }

   }
   public function addCompanyByEmployee()
   { 
      if(!empty($_POST['company_code']) && !empty($_POST['employee_email']) && !empty($_POST['status']))
      { 
        $sats=$_POST['status'];
        $this->loadModel('Employee');
        $this->loadModel('Company');
        $count=$this->Employee->find('count',array('conditions'=>array('Employee.employee_email' => $_POST['employee_email'],'Employee.companyCode' => $_POST['company_code'])));
      if($count=='1')
      {
         $success=$this->Employee->updateAll(array('status' => "'$sats'"), array('employee_email' => $_POST['employee_email'],'companyCode' => $_POST['company_code']));    
      
         $teacherdata=$this->Company->find('first',array('conditions'=>array('Company.companyCode'=>trim($_POST['company_code'])),'recursive'=>-1));         
       if(!empty($success))
          {
             echo json_encode(array('Message'=>'Successfully added','Data'=>$teacherdata)); die;
          }  
      }
      else
      {
        echo json_encode(array('Error'=>'You have not added by Manager')); die;
      }
      
      }

   }
   
  /*public function login() {
     $this->loadModel('User');
    if (!empty($_POST['email']) && !empty($_POST['password'])) 
      {
       
       $pass=hash('ripemd160',trim($_POST['password'])); 
       $count=$this->User->find('count',array('conditions'=>array('User.email'=>trim($_POST['email']),'User.password'=>$pass)));
       $roledata=$this->User->find('first',array('conditions'=>array('User.email'=>trim($_POST['email']),'User.password'=>$pass),'fields'=>array('role'),'recursive'=>-1));
        if(!empty($roledata))
          {
$role=$roledata['User']['role'];
 //echo $role; die;
          }
       
//echo $count; die;
        if($count=='1')
        {
            if($role==1)
            {
              $this->User->Behaviors->load('Containable');
              $data=$this->User->find('all',array('conditions'=>array('User.email'=>trim($_POST['email']),'User.password'=>$pass),'fields'=>array('id','username','email','school','userview','role','status','code','device_token','created'),'contain'=>array('Teacher'=>array('Student'=>array('order' => array('Student.id' => 'DESC')),'order' => array('Teacher.id' => 'DESC')))));
                   if(!empty($data))
                   {
                    echo json_encode(array('Message'=>'Successfully login.','Data'=>$data)); die;
                   }   
            }
            else if($role==2)
            {
               $this->loadModel('Student');
               $this->loadModel('Teacher');
            $data=$this->User->find('all',array('conditions'=>array('User.email'=>trim($_POST['email']),'User.password'=>$pass),'fields'=>array('id','username','email','school','userview','role','status','code','device_token','created'),'recursive'=>-1));
                 $student_data=$this->Student->find('list',array('conditions'=>array('Student.student_email'=>trim($_POST['email']),'Student.status'=>'1'),'fields'=>array('teacher_id')));
//echo "<pre>"; print_r($student_data); die;
                $teacherdata=$this->Teacher->find('all',array('conditions'=>array('Teacher.id'=>$student_data),'recursive'=>-1));   $data=array_merge($data,$teacherdata);
                   if(!empty($data))
                   {
                    echo json_encode(array('Message'=>'Successfully login.','Data'=>$data)); die;
                   }   
            }
            else if($role==3)
            {
               $this->loadModel('Children');
               $this->loadModel('Student');
               $this->User->Behaviors->load('Containable');
               $this->User->bindModel(array(
        'hasMany' => array(
            'Children' => array(
                'foreignKey' => 'user_id'
            ))));
            $this->Children->bindModel(array(
        'belongsTo' => array(
            'Student' => array(
                'foreignKey' => 'student_id'
            ))));  
              $data=$this->User->find('all',array('conditions'=>array('User.email'=>trim($_POST['email']),'User.password'=>$pass),'fields'=>array('id','username','email','school','userview','role','status','code','device_token','created'),'contain'=>array('Children'=>array('Student'=>array('order' => array('Student.id' => 'DESC')),'order' => array('Children.id' => 'DESC')))));
                   if(!empty($data))
                   {
                    echo json_encode(array('Message'=>'Successfully login.','Data'=>$data)); die;
                   }
            }
            else
            {
               $data=$this->User->find('all',array('conditions'=>array('User.email'=>trim($_POST['email']),'User.password'=>$pass),'recursive'=>-1));
              echo json_encode(array('Message'=>'Successfully login.','Data'=>$data)); die;
            }
      
        
        }
           else
           {
            echo json_encode(array('Error'=>'Authentication failed')); die;
           }
      }
      else if(!empty($_POST['facebook_id']))
      {
          
       $count=$this->User->find('count',array('conditions'=>array('User.facebook_id'=>trim($_POST['facebook_id']))));
//echo $count; die;
       $roledata=$this->User->find('first',array('conditions'=>array('User.facebook_id'=>trim($_POST['facebook_id'])),'fields'=>array('role'),'recursive'=>-1));
       $role=$roledata['User']['role'];
        if($count=='1')
        {
          if($role==1)
            {
               $this->User->Behaviors->load('Containable');
               $data=$this->User->find('all',array('conditions'=>array('User.facebook_id'=>trim($_POST['facebook_id'])),'fields'=>array('id','username','email','school','userview','role','status','code','device_token','created'),'contain'=>array('Teacher'=>array('Student'=>array('order' => array('Student.id' => 'DESC')),'order' => array('Teacher.id' => 'DESC')))));
                 if(!empty($data))
                 {
                  echo json_encode(array('Message'=>'Successfully login.','Data'=>$data)); die;
                 }
            }
            else if($role==2)
            {
                 $this->loadModel('Student');
                 $this->loadModel('Teacher');
               $data=$this->User->find('all',array('conditions'=>array('User.facebook_id'=>trim($_POST['facebook_id'])),'fields'=>array('id','username','email','school','userview','role','status','code','device_token','created'),'recursive'=>-1));
//echo "<pre>"; print_r($data); die;
                $student_data=$this->Student->find('list',array('conditions'=>array('Student.student_email'=>$data['0']['User']['email'],'Student.status'=>'1'),'fields'=>array('teacher_id')));
//echo "<pre>"; print_r($student_data); die;
                $teacherdata=$this->Teacher->find('all',array('conditions'=>array('Teacher.id'=>$student_data),'recursive'=>-1));   $data=array_merge($data,$teacherdata);
                   if(!empty($data))
                   {
                    echo json_encode(array('Message'=>'Successfully login.','Data'=>$data)); die;
                   }  
            }
            else if($role==3)
            {
               $this->loadModel('Children');
               $this->loadModel('Student');
               $this->User->Behaviors->load('Containable');
               $this->User->bindModel(array(
        'hasMany' => array(
            'Children' => array(
                'foreignKey' => 'user_id'
            ))));
            $this->Children->bindModel(array(
        'belongsTo' => array(
            'Student' => array(
                'foreignKey' => 'student_id'
            ))));  
              $data=$this->User->find('all',array('conditions'=>array('User.facebook_id'=>trim($_POST['facebook_id'])),'fields'=>array('id','username','email','school','userview','role','status','code','device_token','created'),'contain'=>array('Children'=>array('Student'=>array('order' => array('Student.id' => 'DESC')),'order' => array('Children.id' => 'DESC')))));
                   if(!empty($data))
                   {
                    echo json_encode(array('Message'=>'Successfully login.','Data'=>$data)); die;
                   }
            } 
            else
            {
               $data=$this->User->find('all',array('conditions'=>array('User.facebook_id'=>trim($_POST['facebook_id'])),'recursive'=>-1));
              echo json_encode(array('Message'=>'Successfully login.','Data'=>$data)); die;

            }
        
        }
           else
           {
            echo json_encode(array('Error'=>'Authentication failed')); die;
           }   
      }
      else if(!empty($_POST['google_id']))
      {
            $count=$this->User->find('count',array('conditions'=>array('User.google_id'=>trim($_POST['google_id']))));
            $roledata=$this->User->find('first',array('conditions'=>array('User.google_id'=>trim($_POST['google_id'])),'fields'=>array('role'),'recursive'=>-1));
            $role=$roledata['User']['role'];
//echo $count; die;
        if($count=='1')
        {
          if($role==1)
            {
      $this->User->Behaviors->load('Containable');
      
       $data=$this->User->find('all',array('conditions'=>array('User.google_id'=>trim($_POST['google_id'])),'fields'=>array('id','username','email','school','userview','role','status','code','device_token','created'),'contain'=>array('Teacher'=>array('Student'=>array('order' => array('Student.id' => 'DESC')),'order' => array('Teacher.id' => 'DESC')))));
           if(!empty($data))
           {
            echo json_encode(array('Message'=>'Successfully login.','Data'=>$data)); die;
           }
         }
          else if($role==2)
            {
                 $this->loadModel('Student');
                 $this->loadModel('Teacher');
               $data=$this->User->find('all',array('conditions'=>array('User.google_id'=>trim($_POST['google_id'])),'fields'=>array('id','username','email','school','userview','role','status','code','device_token','created'),'recursive'=>-1));
                 $student_data=$this->Student->find('list',array('conditions'=>array('Student.student_email'=>$data['0']['User']['email'],'Student.status'=>'1'),'fields'=>array('teacher_id')));
//echo "<pre>"; print_r($student_data); die;
                $teacherdata=$this->Teacher->find('all',array('conditions'=>array('Teacher.id'=>$student_data),'recursive'=>-1));   $data=array_merge($data,$teacherdata);
                   if(!empty($data))
                   {
                    echo json_encode(array('Message'=>'Successfully login.','Data'=>$data)); die;
                   }  
            }
            else if($role==3)
            {
               $this->loadModel('Children');
               $this->loadModel('Student');
               $this->User->Behaviors->load('Containable');
               $this->User->bindModel(array(
        'hasMany' => array(
            'Children' => array(
                'foreignKey' => 'user_id'
            ))));
            $this->Children->bindModel(array(
        'belongsTo' => array(
            'Student' => array(
                'foreignKey' => 'student_id'
            ))));  
              $data=$this->User->find('all',array('conditions'=>array('User.google_id'=>trim($_POST['google_id'])),'fields'=>array('id','username','email','school','userview','role','status','code','device_token','created'),'contain'=>array('Children'=>array('Student'=>array('order' => array('Student.id' => 'DESC')),'order' => array('Children.id' => 'DESC')))));
                   if(!empty($data))
                   {
                    echo json_encode(array('Message'=>'Successfully login.','Data'=>$data)); die;
                   }
            } 
            else
            {
             $data=$this->User->find('all',array('conditions'=>array('User.google_id'=>trim($_POST['google_id'])),'recursive'=>-1));
              echo json_encode(array('Message'=>'Successfully login.','Data'=>$data)); die;

            }

        
        }
           else
           {
            echo json_encode(array('Error'=>'Authentication failed')); die;
           }  
      }
      else if(!empty($_POST['twitter_id']))
      {
            $count=$this->User->find('count',array('conditions'=>array('User.twitter_id'=>trim($_POST['twitter_id']))));
           $roledata=$this->User->find('first',array('conditions'=>array('User.twitter_id'=>trim($_POST['twitter_id'])),'fields'=>array('role'),'recursive'=>-1));
            $role=$roledata['User']['role'];
//echo $count; die;
        if($count=='1')
        {
          if($role==1)
            {
          $this->User->Behaviors->load('Containable');
          
           $data=$this->User->find('all',array('conditions'=>array('User.twitter_id'=>trim($_POST['twitter_id'])),'fields'=>array('id','username','email','school','userview','role','status','code','device_token','created'),'contain'=>array('Teacher'=>array('Student'=>array('order' => array('Student.id' => 'DESC')),'order' => array('Teacher.id' => 'DESC')))));
               if(!empty($data))
               {
                echo json_encode(array('Message'=>'Successfully login.','Data'=>$data)); die;
               }
            }
          else if($role==2)
            {
                 $this->loadModel('Student');
                 $this->loadModel('Teacher');
               $data=$this->User->find('all',array('conditions'=>array('User.twitter_id'=>trim($_POST['twitter_id'])),'fields'=>array('id','username','email','school','userview','role','status','code','device_token','created'),'recursive'=>-1));
                 $student_data=$this->Student->find('list',array('conditions'=>array('Student.student_email'=>$data['0']['User']['email'],'Student.status'=>'1'),'fields'=>array('teacher_id')));
//echo "<pre>"; print_r($student_data); die;
                $teacherdata=$this->Teacher->find('all',array('conditions'=>array('Teacher.id'=>$student_data),'recursive'=>-1));   $data=array_merge($data,$teacherdata);
                   if(!empty($data))
                   {
                    echo json_encode(array('Message'=>'Successfully login.','Data'=>$data)); die;
                   }  
            } 
             else if($role==3)
            {
               $this->loadModel('Children');
               $this->loadModel('Student');
               $this->User->Behaviors->load('Containable');
               $this->User->bindModel(array(
        'hasMany' => array(
            'Children' => array(
                'foreignKey' => 'user_id'
            ))));
            $this->Children->bindModel(array(
        'belongsTo' => array(
            'Student' => array(
                'foreignKey' => 'student_id'
            ))));  
              $data=$this->User->find('all',array('conditions'=>array('User.twitter_id'=>trim($_POST['twitter_id'])),'fields'=>array('id','username','email','school','userview','role','status','code','device_token','created'),'contain'=>array('Children'=>array('Student'=>array('order' => array('Student.id' => 'DESC')),'order' => array('Children.id' => 'DESC')))));
                   if(!empty($data))
                   {
                    echo json_encode(array('Message'=>'Successfully login.','Data'=>$data)); die;
                   }
            } 
            else
            {
              $data=$this->User->find('all',array('conditions'=>array('User.twitter_id'=>trim($_POST['twitter_id'])),'recursive'=>-1));
              echo json_encode(array('Message'=>'Successfully login.','Data'=>$data)); die;
            }
        
        }
           else
           {
            echo json_encode(array('Error'=>'Authentication failed')); die;
           }  
        
        }
        else
           {
          echo json_encode(array('Error'=>'Please enter your email and password or facebookId Or googleId or twitterId')); die;
           }  
        
           
     
   }*/
   public function login()
   {
      $this->layout='';
      $this->autoRander=false;
       $this->loadModel('User');
       $this->loadModel('Role');
    if (!empty($_POST['email']) && !empty($_POST['password'])) 
      {
       
       $pass=hash('ripemd160',trim($_POST['password'])); 
       $count=$this->User->find('count',array('conditions'=>array('User.email'=>trim($_POST['email']),'User.password'=>$pass)));
       if($count =='1')
       {
        $this->User->Behaviors->load('Containable');
        $roledata=$this->User->find('first',array('conditions'=>array('User.email'=>trim($_POST['email']),'User.password'=>$pass),'fields'=>array('id','username','email','school','userview','status','code','question',' answer','device_token','created'),'contain'=>array('Role'=>array('order' => array('Role.created' => 'ASC')))));
         if(!empty($roledata))
           {
            echo json_encode(array('Message'=>'Successfully login.','Data'=>$roledata)); die;
           }

       }
       else
       {
         echo json_encode(array('Error'=>'Authentication failed')); die;
       }  
       
      }
      else if(!empty($_POST['facebook_id']))
      {
         
       $count=$this->User->find('count',array('conditions'=>array('User.facebook_id'=>trim($_POST['facebook_id']))));
       if($count =='1')
       {
        $this->User->Behaviors->load('Containable');
        $roledata=$this->User->find('first',array('conditions'=>array('User.facebook_id'=>trim($_POST['facebook_id'])),'fields'=>array('id','username','email','school','userview','status','code','question',' answer','device_token','created'),'contain'=>array('Role'=>array('order' => array('Role.created' => 'ASC')))));
         if(!empty($roledata))
           {
            echo json_encode(array('Message'=>'Successfully login.','Data'=>$roledata)); die;
           }

       }
       else
       {
         echo json_encode(array('Error'=>'Authentication failed')); die;
       } 
      }
      else if(!empty($_POST['google_id']))
      {
         
       $count=$this->User->find('count',array('conditions'=>array('User.google_id'=>trim($_POST['google_id']))));
       if($count =='1')
       {
        $this->User->Behaviors->load('Containable');
        $roledata=$this->User->find('first',array('conditions'=>array('User.google_id'=>trim($_POST['google_id'])),'fields'=>array('id','username','email','school','userview','status','code','question',' answer','device_token','created'),'contain'=>array('Role'=>array('order' => array('Role.created' => 'ASC')))));
         if(!empty($roledata))
           {
            echo json_encode(array('Message'=>'Successfully login.','Data'=>$roledata)); die;
           }

       }
       else
       {
         echo json_encode(array('Error'=>'Authentication failed')); die;
       } 
      }
       else if(!empty($_POST['twitter_id']))
      {
         
       $count=$this->User->find('count',array('conditions'=>array('User.twitter_id'=>trim($_POST['twitter_id']))));
       if($count =='1')
       {
        $this->User->Behaviors->load('Containable');
        $roledata=$this->User->find('first',array('conditions'=>array('User.twitter_id'=>trim($_POST['twitter_id'])),'fields'=>array('id','username','email','school','userview','status','code','question',' answer','device_token','created'),'contain'=>array('Role'=>array('order' => array('Role.created' => 'ASC')))));
         if(!empty($roledata))
           {
            echo json_encode(array('Message'=>'Successfully login.','Data'=>$roledata)); die;
           }

       }
       else
       {
         echo json_encode(array('Error'=>'Authentication failed')); die;
       } 
      }
 else
     {
    echo json_encode(array('Error'=>'Please enter your email and password or facebookId Or googleId or twitterId')); die;
     }
   }


   public function teacherdata()
   {
     $this->loadModel('User');
    if (!empty($_POST['id']) && !empty($_POST['role'])) 
      {
       //$roledata=$this->User->find('first',array('conditions'=>array('User.id'=>$_POST['id']),'fields'=>array('role'),'recursive'=>-1));
      $role=trim($_POST['role']);
         if($role=='1')
         {
          $this->User->Behaviors->load('Containable');
          $data=$this->User->find('all',array('conditions'=>array('User.id'=>trim($_POST['id'])),'fields'=>array('id','username','email','school','userview','role','status','code','device_token','question',' answer','created'),'contain'=>array('Teacher'=>array('Student'=>array('order' => array('Student.id' => 'DESC')),'Beacon','order' => array('Teacher.id' => 'DESC')))));
           if(!empty($data))
           {
            echo json_encode(array('Message'=>'Successfully login.','Data'=>$data)); die;
           }
            else
           {
            echo json_encode(array('Error'=>'No record found')); die;
           }
         }
         else if($role=='2')
         {
            $this->loadModel('Student');
            $this->loadModel('Teacher');
            $data=$this->User->find('all',array('conditions'=>array('User.id'=>trim($_POST['id'])),'fields'=>array('id','username','email','school','userview','role','status','code','device_token','question',' answer','created'),'recursive'=>-1));

                 $student_data=$this->Student->find('list',array('conditions'=>array('Student.student_email'=>$data['0']['User']['email'],'Student.status'=>'1'),'fields'=>array('teacher_id')));
//echo "<pre>"; print_r($student_data); die;
                $teacherdata=$this->Teacher->find('all',array('conditions'=>array('Teacher.id'=>$student_data),'recursive'=>-1));   $data=array_merge($data,$teacherdata);
                   if(!empty($data))
                   {
                    echo json_encode(array('Message'=>'Successfully login.','Data'=>$data)); die;
                   }
                    else
                   {
                   echo json_encode(array('Error'=>'No record found')); die;
                   }
         }
         else if($role=='3')
         {
            $this->loadModel('Children');
               $this->loadModel('Student');
               $this->User->Behaviors->load('Containable');
               $this->User->bindModel(array(
        'hasMany' => array(
            'Children' => array(
                'foreignKey' => 'user_id'
            ))));
            $this->Children->bindModel(array(
        'belongsTo' => array(
            'Student' => array(
                'foreignKey' => 'student_id'
            ))));  
              $data=$this->User->find('all',array('conditions'=>array('User.id'=>trim($_POST['id'])),'fields'=>array('id','username','email','school','userview','role','status','code','question',' answer','device_token','created'),'contain'=>array('Children'=>array('Student'=>array('order' => array('Student.id' => 'DESC')),'order' => array('Children.id' => 'DESC')))));
                   if(!empty($data))
                   {
                    echo json_encode(array('Message'=>'Successfully login.','Data'=>$data)); die;
                   }
         }
          else if($role=='4')
         {
              $this->loadModel('Company');
               $this->loadModel('Employee');
               $this->loadModel('Beacon');
               $this->User->Behaviors->load('Containable');
               $data=$this->User->find('all',array('conditions'=>array('User.id'=>trim($_POST['id'])),'fields'=>array('id','username','email','school','userview','status','code','question',' answer','device_token','created'),'contain'=>array('Company'=>array('Employee'=>array('order' => array('Employee.id' => 'DESC')),'Beacon','order' => array('Company.id' => 'DESC')))));
                   if(!empty($data))
                   {
                    echo json_encode(array('Message'=>'Successfully login.','Data'=>$data)); die;
                   }
         }
         else if($role=='6')
         {
               $this->loadModel('Event');
               $this->loadModel('Beacon');
               $this->loadModel('Eventee');
               $this->User->Behaviors->load('Containable');
               $data=$this->User->find('all',array('conditions'=>array('User.id'=>trim($_POST['id'])),'fields'=>array('id','username','email','school','userview','status','code','question',' answer','device_token','created'),'contain'=>array('Event'=>array('Eventee'=>array('order' => array('Eventee.id' => 'DESC')),'Beacon','order' => array('Event.id' => 'DESC')))));
                   if(!empty($data))
                   {
                    echo json_encode(array('Message'=>'Successfully login.','Data'=>$data)); die;
                   }
         }
          else if($role=='5')
         {
            $this->loadModel('Employee');
            $this->loadModel('Company');
            $data=$this->User->find('all',array('conditions'=>array('User.id'=>trim($_POST['id'])),'fields'=>array('id','username','email','school','userview','role','status','code','question',' answer','device_token','created'),'recursive'=>-1));
            $student_data=$this->Employee->find('list',array('conditions'=>array('Employee.employee_email'=>$data['0']['User']['email'],'Employee.status'=>'1'),'fields'=>array('company_id')));
//echo "<pre>"; print_r($student_data); die;
                $teacherdata=$this->Company->find('all',array('conditions'=>array('Company.id'=>$student_data),'recursive'=>-1));  
                 $data=array_merge($data,$teacherdata);
                   if(!empty($data))
                   {
                    echo json_encode(array('Message'=>'Successfully login.','Data'=>$data)); die;
                   }
                    else
                   {
                   echo json_encode(array('Error'=>'No record found')); die;
                   }
         }
          else if($role=='7')
         {
            $this->loadModel('Eventee');
            $this->loadModel('Event');
            $data=$this->User->find('all',array('conditions'=>array('User.id'=>trim($_POST['id'])),'fields'=>array('id','username','email','school','userview','role','status','code','question',' answer','device_token','created'),'recursive'=>-1));

                 $student_data=$this->Eventee->find('list',array('conditions'=>array('Eventee.eventee_email'=>$data['0']['User']['email'],'Eventee.status'=>'1'),'fields'=>array('event_id')));
//echo "<pre>"; print_r($student_data); die;
                $teacherdata=$this->Event->find('all',array('conditions'=>array('Event.id'=>$student_data),'recursive'=>-1));   $data=array_merge($data,$teacherdata);
                   if(!empty($data))
                   {
                    echo json_encode(array('Message'=>'Successfully login.','Data'=>$data)); die;
                   }
                    else
                   {
                   echo json_encode(array('Error'=>'No record found')); die;
                   }
         }
         else
         {

         }
      
      }
  }

  public function addClassByTeacher()
   {
      $this->loadModel('Teacher');
      $kk=0;
      if(!empty($_POST))
      {
             $data['Teacher']['user_id']=trim($_POST['user_id']);
             
$data['Teacher']['className']=trim($_POST['className']);
if(!empty($_POST['id']))
{
   
    $count=$this->Teacher->find('count',array('conditions'=>array('Teacher.id !='=>$_POST['id'],'Teacher.user_id'=>$_POST['user_id'],'Teacher.startTime'=>date('h:i:s',strtotime(trim($_POST['startTime']))),'Teacher.endTime'=>date('h:i:s',strtotime(trim($_POST['endTime']))),'Teacher.repeatType'=>$_POST['repeatType'])));
    //echo $count; die;
    $count2=$this->Teacher->find('count',array('conditions'=>array('Teacher.id !='=>$_POST['id'],'Teacher.user_id'=>$_POST['user_id'],'Teacher.className'=>$_POST['className'])));
     if($count > 0)
    {
    echo json_encode(array('Error'=>'You have already added class on same time')); die;
    }
    if($count2 > 0)
    {
    echo json_encode(array('Error'=>'Class already exist')); die;
    }  
}
else
{
   $count3=$this->Teacher->find('count',array('conditions'=>array('Teacher.user_id'=>$_POST['user_id'])));
    if($count3 > 5 || $count3==5)
    {
      echo json_encode(array('Error'=>'You can not add class more than 5.')); die;
    }
    $count=$this->Teacher->find('count',array('conditions'=>array('Teacher.user_id'=>$_POST['user_id'],'Teacher.startTime'=>date('h:i:s',strtotime(trim($_POST['startTime']))),'Teacher.endTime'=>date('h:i:s',strtotime(trim($_POST['endTime']))),'Teacher.repeatType'=>$_POST['repeatType'])));
    //echo $count; die;
    $count2=$this->Teacher->find('count',array('conditions'=>array('Teacher.user_id'=>$_POST['user_id'],'Teacher.className'=>$_POST['className'])));
     if($count > 0)
    {
    echo json_encode(array('Error'=>'You have already added class on same time')); die;
    }
    if($count2 > 0)
    {
    echo json_encode(array('Error'=>'Class already exist')); die;
    }  
}

             $data['Teacher']['startTime']=date('h:i:s A',strtotime(trim($_POST['startTime'])));
             $data['Teacher']['endTime']=date('h:i:s A',strtotime(trim($_POST['endTime'])));
             $data['Teacher']['startDate']=date('Y-m-d',strtotime(trim($_POST['startDate'])));
             $data['Teacher']['endDate']=date('Y-m-d',strtotime(trim($_POST['endDate'])));
             $data['Teacher']['repeatType']=trim($_POST['repeatType']);
             $data['Teacher']['district']=trim($_POST['district']);
             $data['Teacher']['code']=trim($_POST['code']);
             //$data['Teacher']['beacon_id']=trim($_POST['beacon_id']);
             if(!isset($_POST['id']))
             {
               $uncode=$this->gen_uuid();
                 $count3=$this->Teacher->find('count',array('conditions'=>array('Teacher.classCode'=>$uncode)));
               while($count3>0)
               {
                $uncode=$this->gen_uuid();
                $count3=$this->Teacher->find('count',array('conditions'=>array('Teacher.classCode'=>$uncode)));
                
               }
              
               $data['Teacher']['classCode']=$uncode;
             }
              if(!empty($_POST['id']))
              {
                $data['Teacher']['id']=trim($_POST['id']);
              }
             $data['Teacher']['latitude']=trim($_POST['latitude']);
             $data['Teacher']['longitude']=trim($_POST['longitude']);
             $data['Teacher']['status']=trim($_POST['status']);
             $data['Teacher']['interval']=trim($_POST['interval']); 
             $saveddata=$this->Teacher->save($data); 
             if($saveddata)
             {
               if(!empty($_POST['beacon_id']))
               {  
                $this->loadModel('Beacon');
                  if(!empty($_POST['id']))
                 {
                  $this->Beacon->deleteAll(array('Beacon.teacher_id'=>$saveddata['Teacher']['id'],'Beacon.user_id'=>$saveddata['Teacher']['user_id']));
                 }
                    $beaconData=trim($_POST['beacon_id']);
                    $beaconData2=json_decode(stripslashes($beaconData), true);
                   
                     foreach($beaconData2 as $beacons) 
                  {
                    
                    $datasb['Beacon']['user_id']=$saveddata['Teacher']['user_id'];
                    $datasb['Beacon']['teacher_id']=$saveddata['Teacher']['id'];
                    $datasb['Beacon']['proximityUUID']=$beacons['proximityUUID'];
                    $datasb['Beacon']['name']=$beacons['name'];
                    $datasb['Beacon']['macAddress']=$beacons['macAddress'];
                    $datasb['Beacon']['major']=$beacons['major'];
                    $datasb['Beacon']['minor']=$beacons['minor'];
                    $datasb['Beacon']['measuredPower']=$beacons['measuredPower'];
                    $datasb['Beacon']['rssi']=$beacons['rssi'];
                    $this->Beacon->create();
                    $beaconData=$this->Beacon->save($datasb);
                    if(!empty($beaconData))
                    {
                      $kk++;                   
                    }   
  

                  }
               }
               if($saveddata['Teacher']['repeatType']=='WEEKLY')
               {
                        $this->loadModel('RepeatClass');
                 if(!empty($_POST['id']))
                 {
                  $this->RepeatClass->deleteAll(array('RepeatClass.teacher_id'=>$saveddata['Teacher']['id'],'RepeatClass.user_id'=>$saveddata['Teacher']['user_id']));
                 }
                $setdata['RepeatClass']['teacher_id']=$saveddata['Teacher']['id'];
                $setdata['RepeatClass']['repeat_on']=trim($_POST['repeatDays']);

               if($this->RepeatClass->save($setdata))
                {
                $this->Teacher->Behaviors->load('Containable');
                $saveclassdata=$this->Teacher->find('first',array('conditions'=>array('Teacher.id'=>$saveddata['Teacher']['id']),'contain'=>array('RepeatClass','Beacon')));
               
                echo json_encode(array('Message'=>'Saved successfully','Data'=>$saveclassdata),true); die; 
                        }
               }
              else
               {
                $this->Teacher->Behaviors->load('Containable');
                $saveclassdata=$this->Teacher->find('first',array('conditions'=>array('Teacher.id'=>$saveddata['Teacher']['id']),'contain'=>array('Beacon')));
               
                echo json_encode(array('Message'=>'Saved successfully','Data'=>$saveclassdata),true); die;
               }
               
             }
             else
             {
              echo json_encode(array('Error'=>'Not Saved')); die;
             }

      }
   }
/* public function teacherclass()
    {

     
      $this->loadModel('Teacher');
      $this->loadModel('User');
      $roledata=$this->User->find('first',array('conditions'=>array('User.id'=>$_POST['user_id']),'fields'=>array('role'),'recursive'=>-1));
      $role=$roledata['User']['role'];
      if($role=='1')
      {
         $teacherdata=$this->Teacher->find('all',array('conditions'=>array('Teacher.user_id'=>$_POST['user_id'])));
        if(!empty($teacherdata))
         {
         echo json_encode(array('data'=>$teacherdata)); die;
         }
        else
         {
          echo json_encode(array('Message'=>'No records')); die;
         } 
      }
      else if ($role=='2') 
      {
      
      }
      else
      {

      }
       

    }*/

     public function addStudent()
    {
    App::uses('CakeEmail', 'Network/Email');
      $this->loadModel('Student');
      if(!empty($_POST))
      {
        $studata['Student']['teacher_id']=trim($_POST['classId']);
   if(empty($_POST['id']))
{
$count=$this->Student->find('count',array('conditions'=>array('Student.classCode'=>$_POST['classCode'],'Student.student_email'=>$_POST['studentEmail'])));
 if($count > 0)
   {
echo json_encode(array('Error'=>'Student already added for same classCode')); die;
   }
}  
else
{
$count=$this->Student->find('count',array('conditions'=>array('Student.classCode'=>$_POST['classCode'],'Student.student_email'=>$_POST['studentEmail'],'Student.id !=' => $_POST['id'])));
 if($count > 0)
   {
echo json_encode(array('Error'=>'Student Email id is already used please try another.')); die;
   }
}  
       
       $studata['Student']['id']=trim($_POST['id']);
       $studata['Student']['classCode']=trim($_POST['classCode']);
        $studata['Student']['status']=trim($_POST['status']);
        if(!empty($_POST['parentEmail']))
         {
$studata['Student']['parent_email']=trim($_POST['parentEmail']);
         }
      if(!empty($_POST['image']))
      {
          /* if(!empty($_FILES['image']['name']))
            {
                $ext = substr(strtolower(strrchr($_FILES['image']['name'], '.')), 1); //get the extension
                $arr_ext = array('jpg', 'jpeg', 'gif'); //set allowed extensions
                if(in_array($ext, $arr_ext))
                {
                move_uploaded_file($_FILES['image']['tmp_name'], WWW_ROOT . 'img/' . $_FILES['image']['name']);
                $studata['Student']['image'] = $_FILES['image']['name'];
                }
                else
                {
                echo json_encode(array('Error'=>'Please upload jpg, jpeg or gif file only.')); die;
                }
            } */
                $img = $_POST['image'];
                $img = str_replace('data:image/png;base64,', '', $img);
                $img = str_replace(' ', '+', $img);
                $data = base64_decode($img);
                $nforsave=uniqid() . '.png';
                $file = WWW_ROOT . 'img/' . $nforsave;
                $success = file_put_contents($file, $data);
                $studata['Student']['image'] = $nforsave;
               //echo $success; die;
                /*if($success=='FALSE')
                {
                    echo json_encode(array('Error'=>'Image not uploaded successfully.')); die;
                }
                else
                {
                $studata['Student']['image'] = $nforsave; 
                }*/
      }
        $studata['Student']['student_email']=trim($_POST['studentEmail']);
       $data=$this->Student->save($studata);
        if(!empty($data))
        {
           
          $Email = new CakeEmail();
          if(!empty($_POST['parentEmail']))
         {
             $rr=array();
             $rr=explode(',', $_POST['parentEmail']);
             for ($i=0; $i <count($rr); $i++)
           { 
              $Email->template('welcome')->emailFormat('html')->from(array('notify-noreply@abdevs.com' => 'Attendance App'))->to(array(trim($rr[$i])))->viewVars(array('ClassCode' => $_POST['classCode']))->subject('For conformation')->send('you have registered for belove class Code');
           }
            
           
         }
        
            $Email->template('welcome')->emailFormat('html')->from(array('notify-noreply@abdevs.com' => 'Attendance App'))->to(array(trim($_POST['studentEmail'])))->viewVars(array('ClassCode' => $_POST['classCode']))->subject('For conformation')->send('you have registered for belove class Code');
          echo json_encode(array('Message'=>'Saved successfully','Data'=>$data)); die;
         
          

        }
        else
        {
          echo json_encode(array('Error'=>'Not Saved')); die;
        }
      }
    

    }

 public function addEventee()
    {
    App::uses('CakeEmail', 'Network/Email');
      $this->loadModel('Eventee');
      if(!empty($_POST))
      {
        $studata['Eventee']['event_id']=trim($_POST['event_id']);
   if(empty($_POST['id']))
{
$count=$this->Eventee->find('count',array('conditions'=>array('Eventee.eventCode'=>$_POST['eventCode'],'Eventee.eventee_email'=>$_POST['eventeeEmail'])));
 if($count > 0)
   {
echo json_encode(array('Error'=>'Eventee already added for same classCode')); die;
   }
}  
else
{
$count=$this->Eventee->find('count',array('conditions'=>array('Eventee.eventCode'=>$_POST['eventCode'],'Eventee.eventee_email'=>$_POST['eventeeEmail'],'Eventee.id !=' => $_POST['id'])));
 if($count > 0)
   {
echo json_encode(array('Error'=>'Eventee Email id is already used please try another.')); die;
   }
}  
        if(!empty($_POST['id']))
         {
       $studata['Eventee']['id']=trim($_POST['id']);
         }
        $studata['Eventee']['eventCode']=trim($_POST['eventCode']);
        $studata['Eventee']['status']=trim($_POST['status']);
        if(!empty($_POST['parentEmail']))
         {
$studata['Eventee']['parent_email']=trim($_POST['parentEmail']);
         }
      if(!empty($_POST['image']))
      {
        
                $img = $_POST['image'];
                $img = str_replace('data:image/png;base64,', '', $img);
                $img = str_replace(' ', '+', $img);
                $data = base64_decode($img);
                $nforsave=uniqid() . '.png';
                $file = WWW_ROOT . 'img/' . $nforsave;
                $success = file_put_contents($file, $data);
                $studata['Eventee']['image'] = $nforsave;
               
      }
        $studata['Eventee']['eventee_email']=trim($_POST['eventee_email']);
       $data=$this->Eventee->save($studata);
        if(!empty($data))
        {
           
          $Email = new CakeEmail();
          if(!empty($_POST['parentEmail']))
         {
            $Email->template('welcomeevent')->emailFormat('html')->from(array('notify-noreply@abdevs.com' => 'Attendance App'))->to(array(trim($_POST['eventeeEmail']),trim($_POST['parentEmail'])))->viewVars(array('EventCode' => $_POST['eventCode']))->subject('For conformation')->send('you have registered for belove Event Code');
          echo json_encode(array('Message'=>'Saved successfully','Data'=>$data)); die;
         }
         else
         {
            $Email->template('welcomeevent')->emailFormat('html')->from(array('notify-noreply@abdevs.com' => 'Attendance App'))->to(array(trim($_POST['eventeeEmail'])))->viewVars(array('EventCode' => $_POST['eventCode']))->subject('For conformation')->send('you have registered for belove Event Code');
          echo json_encode(array('Message'=>'Saved successfully','Data'=>$data)); die;
         }
          

        }
        else
        {
          echo json_encode(array('Error'=>'Not Saved')); die;
        }
      }
    

    }

 public function emailsend()
    {
  $num='9814203823';
 $value= $this->Sms->send(); 
echo $value; die;
     }

public function getquestion()
{
//echo  hash('ripemd160',uniqid()); die;
  if(!empty($_POST['email']))
  {
    $this->loadModel('User');
    $question=$this->User->find('first',array('conditions'=>array('User.email'=>$_POST['email']),'fields'=>array('question'),'recursive'=>-1));
     if(!empty($question))
     {
      echo json_encode(array('Message'=>'Successfully find your question','Data'=>$question));die;
     }
     else
     {
      echo json_encode(array('Error'=>'Please enter your right email Id.')); die;
     }
  }
  else
  {
      echo json_encode(array('Error'=>'Please enter your right email Id.')); die;
  }
}
/*public function forgatpassword()
{
 App::uses('CakeEmail', 'Network/Email');
     if(!empty($_POST['security_question']) && !empty($_POST['security_question_answer']) && !empty($_POST['email']))
     {
      $this->loadModel('User');
$count=$this->User->find('count',array('conditions'=>array('User.question'=>$_POST['security_question'],'User.answer'=>$_POST['security_question_answer'],'User.email'=>$_POST['email'])));
       if($count==1)
       {
         
          $passstring=uniqid();
          $pass=hash('ripemd160',$passstring);
     $this->User->id = $this->User->field('id', array('email' => $_POST['email']));
          if ($this->User->id) {
                   $this->User->saveField('password',$pass);
             }
           $Email = new CakeEmail();
          $Email->template('forpassword')->emailFormat('html')->from(array('notify-noreply@abdevs.com' => 'Attendance App'))->to(array(trim($_POST['email'])))->viewVars(array('Password' => $passstring))->subject('New Password')->send('Below password is system generated password...');
          //echo "<pre>"; print_r($value); die;
          echo json_encode(array('Message'=>'Please check your email for new password')); die;
       }
       else
        {
      echo json_encode(array('Error'=>'Please enter your right email Id, right question and right answer.')); die;
        }
     }
}*/
public function forgatpassword()
{
 App::uses('CakeEmail', 'Network/Email');
     if(!empty($_POST['security_question']) && !empty($_POST['security_question_answer']) && !empty($_POST['email']))
     {
      $this->loadModel('User');
$count=$this->User->find('count',array('conditions'=>array('User.question'=>$_POST['security_question'],'User.answer'=>$_POST['security_question_answer'],'User.email'=>$_POST['email'])));
       if($count==1)
       {
         
          $passstring=$this->gen_uuid();
          $forsent='Code:- '.$passstring.'  '.'Please use this code for reset to your password!';
          $this->User->id = $this->User->field('id', array('email' => $_POST['email']));
          if ($this->User->id) {
                   $this->User->saveField('code',$passstring);
             }
         
          $Email = new CakeEmail();
$Email->from(array('notify-noreply@abdevs.com' => 'Attendance App'))->to(trim($_POST['email']))->subject('Uniq Code For reset to password')->send($forsent);

          echo json_encode(array('Message'=>'Code has been sent to youe email.')); die;
       }
       else
        {
      echo json_encode(array('Error'=>'Please enter your right email Id, right question and right answer.')); die;
        }
     }
}
public function matchCode()
{
  $this->loadModel('User');
  if(!empty($_POST['code']))
  {
    $count=$this->User->find('count',array('conditions'=>array('User.code'=>trim($_POST['code']))));
    if($count=='1')
    {
    $data=$this->User->find('first',array('conditions'=>array('User.code'=>trim($_POST['code'])),'recursive'=>-1,'fields'=>array('email')));
     echo json_encode(array('Message'=>'Successfully verified your code','Data'=>$data)); die;  
    }
    else
    {
    echo json_encode(array('Error'=>'Entered code does not exist.')); die;
    }
  }
}
public function updatePassword()
{
  if(!empty($_POST['email']) && !empty($_POST['password']))
  {
     $this->loadModel('User');
     $passstring=$_POST['password'];
     $pass=hash('ripemd160',$passstring);
     $this->User->id = $this->User->field('id', array('email' => $_POST['email']));
   if ($this->User->id) {
                   if($this->User->save(array('User'=>array('password'=>$pass,'password_dummy'=>$passstring))))
                   {
                    echo json_encode(array('Message'=>'Successfully Changed your password.')); die;
                   }
                   else
                   {
                    echo json_encode(array('Message'=>'Not successfully Changed your password.')); die;
                   }
             }
    /*  $roledata=$this->User->find('first',array('conditions'=>array('User.email'=>trim($_POST['email']),'User.password'=>$pass),'fields'=>array('role'),'recursive'=>-1));
       $role=$roledata['User']['role'];
        if($role==1)
            {
              $this->User->Behaviors->load('Containable');
              $data=$this->User->find('all',array('conditions'=>array('User.email'=>trim($_POST['email']),'User.password'=>$pass),'fields'=>array('id','username','email','school','userview','role','status','code','device_token','created'),'contain'=>array('Teacher'=>array('Student'))));
                   if(!empty($data))
                   {
                    echo json_encode(array('Message'=>'Successfully Changed your password.','Data'=>$data)); die;
                   }   
            }
            else if($role==2)
            {
               $this->loadModel('Student');
               $this->loadModel('Teacher');
            $data=$this->User->find('all',array('conditions'=>array('User.email'=>trim($_POST['email']),'User.password'=>$pass),'fields'=>array('id','username','email','school','userview','role','status','code','device_token','created'),'recursive'=>-1));
                 $student_data=$this->Student->find('list',array('conditions'=>array('Student.student_email'=>trim($_POST['email']),'Student.status'=>'1'),'fields'=>array('teacher_id')));
//echo "<pre>"; print_r($student_data); die;
                $teacherdata=$this->Teacher->find('all',array('conditions'=>array('Teacher.id'=>$student_data),'recursive'=>-1));   $data=array_merge($data,$teacherdata);
                   if(!empty($data))
                   {
                    echo json_encode(array('Message'=>'Successfully Changed your password.','Data'=>$data)); die;
                   }   
            }
            else
            {
              
            }*/
       

  }
}

public function addchild()
{
  $this->loadModel('Children');
  $this->loadModel('StudentCode');
  $this->loadModel('User');
  $this->loadModel('Student');
    if(!empty($_POST['childName']) && !empty($_POST['user_id']) && !empty($_POST['code']))
    {

      $count=$this->StudentCode->find('count',array('conditions'=>array('StudentCode.code_for_parent'=>trim($_POST['code']))));
      if($count =='0')
      {
        echo json_encode(array('Message'=>'Code does not exist Please use right code to add child')); die; 
      }
      else
      {
      $data12=$this->StudentCode->find('first',array('conditions'=>array('StudentCode.code_for_parent'=>trim($_POST['code']))));
      $userdata=$this->User->find('first',array('conditions'=>array('User.id'=>$data12['StudentCode']['user_id']),'fields'=>array('id','email')));
      $studata=$this->Student->find('list',array('conditions'=>array('Student.student_email'=>$userdata['User']['email']),'fields'=>array('id')));
      $studata1= implode(",",$studata);
      //echo "<pre>"; print_r($studata); die;
      }
      $count123=$this->Children->find('count',array('conditions'=>array('Children.code'=>trim($_POST['code']),'Children.user_id'=>trim($_POST['user_id']))));
      if($count123 > '0')
      {
        echo json_encode(array('Message'=>'You have already added this child')); die;
      }
      $data['Children']['child_name']=trim($_POST['childName']);
      $data['Children']['id']=trim($_POST['id']);
      $data['Children']['code']=trim($_POST['code']);
      $data['Children']['user_id']=trim($_POST['user_id']);
      $data['Children']['student_id']=$studata1;
      $data['Children']['mainstu_id']=$data12['StudentCode']['user_id'];
      $childdata=$this->Children->save($data);
      if (!empty($childdata))
       {
        echo json_encode(array('Message'=>'Successfully add child','Data'=>$childdata)); die;
       }
       else
       {
        echo json_encode(array('Error'=>'Not add child successfully')); die;
       }
    }
}
public function editChild()
{
  if(!empty($_POST['id']) && !empty($_POST['child_name']))
  {
    $this->loadModel('Children');
    $childdata['Children']['id']=trim($_POST['id']);
    $childdata['Children']['child_name']=trim($_POST['child_name']);
    if($this->Children->save($childdata))
    {
      echo json_encode(array('Message'=>'Successfully Edit')); die;
    }
    else
    {
      echo json_encode(array('Message'=>'Not successfully Edit')); die;
    }
  }
}
public function deleteChildParent()
{
  if(!empty($_POST['id']))
  {
    $this->loadModel('Children');
    if($this->Children->delete($_POST['id']))
    {
      echo json_encode(array('Message'=>'Successfully deleted'));die;
    }
    else
    {
      echo json_encode(array('Error'=>'Not deleted')); die;
    }
  }
}
public function studentAttendens()
{
   if(!empty($_POST['user_id']) && !empty($_POST['student_id']) && !empty($_POST['class_code']) && !empty($_POST['type']))
   {
    $stuatt=array();
    $j=0;
    $this->loadModel('StudentAttendance');
    $this->loadModel('Attendance');
    $this->loadModel('Student');
    $this->loadModel('User');
    $this->loadModel('Beacon');
    $this->loadModel('BeaconStudent');
    $stuarr=explode(',',$_POST['student_id']);
    $teacherlatlogd=$this->Attendance->find('first',array('conditions'=>array('Attendance.user_id'=>$_POST['user_id'])));
    $teachlong=$teacherlatlogd['Attendance']['longitude'];
    $teachlat=$teacherlatlogd['Attendance']['latitude'];
    if($_POST['type']=='Automatic')
    {
     /* $cnt2=$this->StudentAttendance->find('count', array('conditions'=>array('StudentAttendance.user_id'=>$_POST['user_id'], 'StudentAttendance.created'=>date('Y-m-d'),'StudentAttendance.teacher_id'=>$_POST['class_id'])));
     if($cnt2 > '0')
     {
      echo json_encode(array('Error'=>'You have already taken attandence of students for today')); die;
     }*/
       if(!empty($stuarr))
       {  
          for ($i=0; $i < count($stuarr) ; $i++) 
        {
            $emaildata=$this->Student->find('first',array('conditions'=>array('Student.id'=>$stuarr[$i]))); 
            if(!empty($emaildata))
            {
            $email=$emaildata['Student']['student_email'];
            $stuid=$this->User->find('first',array('conditions'=>array('User.email'=>$email),'recursive'=>-1, 'fields'=>array('id','role')));
            }
            
            if(!empty($stuid))
            {
            $studentid=$stuid['User']['id'];
            $time=date('H:i:s');
           // $backtime=date('H:i:s', strtotime('-1 minutes', strtotime($time)));
           // $backtime2=date('H:i:s', strtotime('-2 minutes', strtotime($time)));
           // $backtime3=date('H:i:s', strtotime('-3 minutes', strtotime($time)));
            $backtime4=date('H:i:s', strtotime('-4 minutes', strtotime($time)));
            $currenttime=date('H:i:s');
            $count=$this->Attendance->find('count',array('conditions'=>array('Attendance.user_id'=>$studentid, 'Attendance.date'=>date('Y-m-d'), 'Attendance.time BETWEEN ? and ?'=>array($backtime4,$currenttime))));
            $stulatlogd=$this->Attendance->find('first',array('conditions'=>array('Attendance.user_id'=>$studentid)));
            if(!empty($stulatlogd))
            {
            $stulong=$stulatlogd['Attendance']['longitude'];
            $stulat=$stulatlogd['Attendance']['latitude'];
            $distance=$this->haversineGreatCircleDistance($teachlat,$teachlong,$stulat,$stulong); 
            $dis=$distance*3.28084; 
            }
            else
            {
              $count=='0'; 
            }
           
            
              if($dis < 200)
              {
               $count=='2'; 
              }
              else
              {
               $count=='0'; 
              }
            }
             else
             {
              $count='0';
             }           
             if($count > '0')
             {
                 $count123=$this->StudentAttendance->find('count', array('conditions'=>array('StudentAttendance.student_id'=>$stuarr[$i],'StudentAttendance.teacher_id'=>trim($_POST['class_id']),'StudentAttendance.user_id'=>$_POST['user_id'], 'StudentAttendance.created'=>date('Y-m-d'))));
                 if($count123 =='0')
                {
                    $stuatt['StudentAttendance']['user_id']=trim($_POST['user_id']);
                    $stuatt['StudentAttendance']['student_id']=$stuarr[$i];
                    $stuatt['StudentAttendance']['classCode']=trim($_POST['class_code']);
                    $stuatt['StudentAttendance']['teacher_id']=trim($_POST['class_id']);
                    $stuatt['StudentAttendance']['attend']='P';
                    $this->StudentAttendance->create();
                    if($this->StudentAttendance->save($stuatt))
                    {
                     $j++;
                    }
                }
                else
                {
                  $this->StudentAttendance->id = $this->StudentAttendance->field('id', array('StudentAttendance.student_id'=>$stuarr[$i],'StudentAttendance.teacher_id'=>trim($_POST['class_id']),'StudentAttendance.user_id'=>$_POST['user_id'], 'StudentAttendance.created'=>date('Y-m-d')));
                      if ($this->StudentAttendance->id) {
                          $this->StudentAttendance->saveField('attend', 'P');
                          $j++;
                      }
                }
             }
             else
             {
               $count1234=$this->StudentAttendance->find('count', array('conditions'=>array('StudentAttendance.student_id'=>$stuarr[$i],'StudentAttendance.teacher_id'=>trim($_POST['class_id']),'StudentAttendance.user_id'=>$_POST['user_id'], 'StudentAttendance.created'=>date('Y-m-d'))));
                 if($count1234 =='0')
                {
                  $stuatt['StudentAttendance']['user_id']=trim($_POST['user_id']);
                  $stuatt['StudentAttendance']['student_id']=$stuarr[$i];
                  $stuatt['StudentAttendance']['teacher_id']=trim($_POST['class_id']);
                  $stuatt['StudentAttendance']['attend']='A';
                  $stuatt['StudentAttendance']['classCode']=trim($_POST['class_code']);
                  $this->StudentAttendance->create();
                  if($this->StudentAttendance->save($stuatt))
                  {
                   $j++;
                  }
                }
                else
                {
                    $count12345=$this->StudentAttendance->find('first', array('conditions'=>array('StudentAttendance.student_id'=>$stuarr[$i],'StudentAttendance.teacher_id'=>trim($_POST['class_id']),'StudentAttendance.user_id'=>$_POST['user_id'], 'StudentAttendance.created'=>date('Y-m-d'))));
                  $ap=$count12345['StudentAttendance']['attend'];
                  if($ap=='A')
                  {
                      $this->StudentAttendance->id = $this->StudentAttendance->field('id', array('StudentAttendance.student_id'=>$stuarr[$i],'StudentAttendance.teacher_id'=>trim($_POST['class_id']),'StudentAttendance.user_id'=>$_POST['user_id'], 'StudentAttendance.created'=>date('Y-m-d')));
                      if ($this->StudentAttendance->id) {
                          $this->StudentAttendance->saveField('attend', 'A');
                          $j++;
                      }
                  }
                  else
                  {
                    $this->StudentAttendance->id = $this->StudentAttendance->field('id', array('StudentAttendance.student_id'=>$stuarr[$i],'StudentAttendance.teacher_id'=>trim($_POST['class_id']),'StudentAttendance.user_id'=>$_POST['user_id'], 'StudentAttendance.created'=>date('Y-m-d')));
                      if ($this->StudentAttendance->id) {
                          $this->StudentAttendance->saveField('attend', 'P');
                          $j++;
                      }
                  }
                  
                } 

             }
          }
        }
      }
      else if($_POST['type']=='Manual')
      {  
            if(!empty($stuarr))
         {  
          for ($i=0; $i < count($stuarr) ; $i++) 
           {
                $count12=$this->StudentAttendance->find('count', array('conditions'=>array('StudentAttendance.student_id'=>$stuarr[$i],'StudentAttendance.teacher_id'=>trim($_POST['class_id']),'StudentAttendance.user_id'=>$_POST['user_id'], 'StudentAttendance.created'=>date('Y-m-d'))));
                if($count12 =='0')
                {
                    $stuatt['StudentAttendance']['user_id']=trim($_POST['user_id']);
                    $stuatt['StudentAttendance']['student_id']=$stuarr[$i];
                    $stuatt['StudentAttendance']['classCode']=trim($_POST['class_code']);
                    $stuatt['StudentAttendance']['teacher_id']=trim($_POST['class_id']);
                    $stuatt['StudentAttendance']['attend']='P';
                    $this->StudentAttendance->create();
                    if($this->StudentAttendance->save($stuatt))
                    {
                     $j++;
                    }
                }
                else
                {
                      $this->StudentAttendance->id = $this->StudentAttendance->field('id', array('StudentAttendance.student_id'=>$stuarr[$i],'StudentAttendance.teacher_id'=>trim($_POST['class_id']),'StudentAttendance.user_id'=>$_POST['user_id'], 'StudentAttendance.created'=>date('Y-m-d')));
                      if ($this->StudentAttendance->id) {
                          $this->StudentAttendance->saveField('attend', 'P');
                          $j++;
                      }
                }
            }
       }
      }
      else
      {
         if(!empty($stuarr))
       {  
          for ($i=0; $i < count($stuarr) ; $i++) 
        {
            $emaildata=$this->Student->find('first',array('conditions'=>array('Student.id'=>$stuarr[$i]))); 
            if(!empty($emaildata))
            {
            $email=$emaildata['Student']['student_email'];
            $stuid=$this->User->find('first',array('conditions'=>array('User.email'=>$email),'recursive'=>-1, 'fields'=>array('id','role')));
            }
            
            if(!empty($stuid))
            {
            $studentid=$stuid['User']['id'];
            $stubeacon=$this->BeaconStudent->find('list',array('conditions'=>array('BeaconStudent.user_id'=>$studentid,'BeaconStudent.date'=>date('Y-m-d')),'fields'=>array('macAddress')));
              if(!empty($stubeacon))
              {
              	$cnt=$this->Beacon->find('count',array('conditions'=>array('Beacon.macAddress'=>$stubeacon,'Beacon.teacher_id'=>trim($_POST['class_id']),'Beacon.user_id'=>trim($_POST['user_id']))));
                //echo $cnt; die;
              }
              else
              {
              	$cnt='0';
              }
              if($cnt>'0')
              {
                  $stuatt['StudentAttendance']['user_id']=trim($_POST['user_id']);
                  $stuatt['StudentAttendance']['student_id']=$stuarr[$i];
                  $stuatt['StudentAttendance']['teacher_id']=trim($_POST['class_id']);
                  $stuatt['StudentAttendance']['attend']='P';
                  $stuatt['StudentAttendance']['classCode']=trim($_POST['class_code']);
                  $this->StudentAttendance->create();
                  if($this->StudentAttendance->save($stuatt))
                  {
                   $j++;
                  }
              }
              else
              {
                  $stuatt['StudentAttendance']['user_id']=trim($_POST['user_id']);
                  $stuatt['StudentAttendance']['student_id']=$stuarr[$i];
                  $stuatt['StudentAttendance']['teacher_id']=trim($_POST['class_id']);
                  $stuatt['StudentAttendance']['attend']='A';
                  $stuatt['StudentAttendance']['classCode']=trim($_POST['class_code']);
                  $this->StudentAttendance->create();
                  if($this->StudentAttendance->save($stuatt))
                  {
                   $j++;
                  }
              }

            
            }
         }
        }	
      }
      if($j>'0')
       {
        $data=$this->StudentAttendance->find('all',array('conditions'=>array('StudentAttendance.user_id'=>trim($_POST['user_id']),'StudentAttendance.teacher_id'=>trim($_POST['class_id']),'StudentAttendance.created'=>date('Y-m-d'))));
    echo json_encode(array('Message'=>'Successfully attended','Data'=>$data)); die;
       }
       else
       {
        echo json_encode(array('Error'=>'Not attended')); die;
       }  
   }
}
public function eventeeAttendens()
{
   if(!empty($_POST['user_id']) && !empty($_POST['eventee_id']) && !empty($_POST['event_code']) && !empty($_POST['type']))
   {
    $stuatt=array();
    $j=0;
    $this->loadModel('EventeeAttendance');
    $this->loadModel('Attendance');
    $this->loadModel('Eventee');
    $this->loadModel('User');
    $this->loadModel('Beacon');
    $this->loadModel('BeaconStudent');
    $stuarr=explode(',',$_POST['eventee_id']);
    $teacherlatlogd=$this->Attendance->find('first',array('conditions'=>array('Attendance.user_id'=>$_POST['user_id'])));
    $teachlong=$teacherlatlogd['Attendance']['longitude'];
    $teachlat=$teacherlatlogd['Attendance']['latitude'];
    if($_POST['type']=='Automatic')
    {
     /* $cnt2=$this->StudentAttendance->find('count', array('conditions'=>array('StudentAttendance.user_id'=>$_POST['user_id'], 'StudentAttendance.created'=>date('Y-m-d'),'StudentAttendance.teacher_id'=>$_POST['class_id'])));
     if($cnt2 > '0')
     {
      echo json_encode(array('Error'=>'You have already taken attandence of students for today')); die;
     }*/
       if(!empty($stuarr))
       {  
          for ($i=0; $i < count($stuarr) ; $i++) 
        {
            $emaildata=$this->Eventee->find('first',array('conditions'=>array('Eventee.id'=>$stuarr[$i]))); 
            if(!empty($emaildata))
            {
            $email=$emaildata['Eventee']['eventee_email'];
            $stuid=$this->User->find('first',array('conditions'=>array('User.email'=>$email),'recursive'=>-1, 'fields'=>array('id','role')));
            }
            
            if(!empty($stuid))
            {
            $studentid=$stuid['User']['id'];
            $time=date('H:i:s');
           // $backtime=date('H:i:s', strtotime('-1 minutes', strtotime($time)));
           // $backtime2=date('H:i:s', strtotime('-2 minutes', strtotime($time)));
           // $backtime3=date('H:i:s', strtotime('-3 minutes', strtotime($time)));
            $backtime4=date('H:i:s', strtotime('-4 minutes', strtotime($time)));
            $currenttime=date('H:i:s');
            $count=$this->Attendance->find('count',array('conditions'=>array('Attendance.user_id'=>$studentid, 'Attendance.date'=>date('Y-m-d'), 'Attendance.time BETWEEN ? and ?'=>array($backtime4,$currenttime))));
            $stulatlogd=$this->Attendance->find('first',array('conditions'=>array('Attendance.user_id'=>$studentid)));
            if(!empty($stulatlogd))
            {
            $stulong=$stulatlogd['Attendance']['longitude'];
            $stulat=$stulatlogd['Attendance']['latitude'];
            $distance=$this->haversineGreatCircleDistance($teachlat,$teachlong,$stulat,$stulong); 
            $dis=$distance*3.28084; 
            }
            else
            {
              $count=='0'; 
            }
           
            
              if($dis < 200)
              {
               $count=='2'; 
              }
              else
              {
               $count=='0'; 
              }
            }
             else
             {
              $count='0';
             }           
             if($count > '0')
             {
                 $count123=$this->EventeeAttendance->find('count', array('conditions'=>array('EventeeAttendance.eventee_id'=>$stuarr[$i],'EventeeAttendance.event_id'=>trim($_POST['event_id']),'EventeeAttendance.user_id'=>$_POST['user_id'], 'EventeeAttendance.created'=>date('Y-m-d'))));
                 if($count123 =='0')
                {
                    $stuatt['EventeeAttendance']['user_id']=trim($_POST['user_id']);
                    $stuatt['EventeeAttendance']['eventee_id']=$stuarr[$i];
                    $stuatt['EventeeAttendance']['eventCode']=trim($_POST['event_code']);
                    $stuatt['EventeeAttendance']['event_id']=trim($_POST['event_id']);
                    $stuatt['EventeeAttendance']['attend']='P';
                    $this->EventeeAttendance->create();
                    if($this->EventeeAttendance->save($stuatt))
                    {
                     $j++;
                    }
                }
                else
                {
                  $this->EventeeAttendance->id = $this->EventeeAttendance->field('id', array('EventeeAttendance.eventee_id'=>$stuarr[$i],'EventeeAttendance.event_id'=>trim($_POST['event_id']),'EventeeAttendance.user_id'=>$_POST['user_id'], 'EventeeAttendance.created'=>date('Y-m-d')));
                      if ($this->EventeeAttendance->id) {
                          $this->EventeeAttendance->saveField('attend', 'P');
                          $j++;
                      }
                }
             }
             else
             {
               $count1234=$this->EventeeAttendance->find('count', array('conditions'=>array('EventeeAttendance.eventee_id'=>$stuarr[$i],'EventeeAttendance.event_id'=>trim($_POST['event_id']),'EventeeAttendance.user_id'=>$_POST['user_id'], 'EventeeAttendance.created'=>date('Y-m-d'))));
                 if($count1234 =='0')
                {
                  $stuatt['EventeeAttendance']['user_id']=trim($_POST['user_id']);
                  $stuatt['EventeeAttendance']['eventee_id']=$stuarr[$i];
                  $stuatt['EventeeAttendance']['event_id']=trim($_POST['event_id']);
                  $stuatt['EventeeAttendance']['attend']='A';
                  $stuatt['EventeeAttendance']['eventCode']=trim($_POST['event_code']);
                  $this->EventeeAttendance->create();
                  if($this->EventeeAttendance->save($stuatt))
                  {
                   $j++;
                  }
                }
                else
                {
                    $count12345=$this->EventeeAttendance->find('first', array('conditions'=>array('EventeeAttendance.eventee_id'=>$stuarr[$i],'EventeeAttendance.event_id'=>trim($_POST['event_id']),'EventeeAttendance.user_id'=>$_POST['user_id'], 'EventeeAttendance.created'=>date('Y-m-d'))));
                  $ap=$count12345['EventeeAttendance']['attend'];
                  if($ap=='A')
                  {
                      $this->EventeeAttendance->id = $this->EventeeAttendance->field('id', array('EventeeAttendance.eventee_id'=>$stuarr[$i],'EventeeAttendance.event_id'=>trim($_POST['event_id']),'EventeeAttendance.user_id'=>$_POST['user_id'], 'EventeeAttendance.created'=>date('Y-m-d')));
                      if ($this->EventeeAttendance->id) {
                          $this->EventeeAttendance->saveField('attend', 'A');
                          $j++;
                      }
                  }
                  else
                  {
                    $this->EventeeAttendance->id = $this->EventeeAttendance->field('id', array('EventeeAttendance.eventee_id'=>$stuarr[$i],'EventeeAttendance.event_id'=>trim($_POST['event_id']),'EventeeAttendance.user_id'=>$_POST['user_id'], 'EventeeAttendance.created'=>date('Y-m-d')));
                      if ($this->EventeeAttendance->id) {
                          $this->EventeeAttendance->saveField('attend', 'P');
                          $j++;
                      }
                  }
                  
                } 

             }
          }
        }
      }
      else if($_POST['type']=='Manual')
      {  
            if(!empty($stuarr))
         {  
          for ($i=0; $i < count($stuarr) ; $i++) 
           {
                $count12=$this->EventeeAttendance->find('count', array('conditions'=>array('EventeeAttendance.eventee_id'=>$stuarr[$i],'EventeeAttendance.event_id'=>trim($_POST['event_id']),'EventeeAttendance.user_id'=>$_POST['user_id'], 'EventeeAttendance.created'=>date('Y-m-d'))));
                if($count12 =='0')
                {
                    $stuatt['EventeeAttendance']['user_id']=trim($_POST['user_id']);
                    $stuatt['EventeeAttendance']['eventee_id']=$stuarr[$i];
                    $stuatt['EventeeAttendance']['eventCode']=trim($_POST['event_code']);
                    $stuatt['EventeeAttendance']['event_id']=trim($_POST['event_id']);
                    $stuatt['EventeeAttendance']['attend']='P';
                    $this->EventeeAttendance->create();
                    if($this->EventeeAttendance->save($stuatt))
                    {
                     $j++;
                    }
                }
                else
                {
                      $this->EventeeAttendance->id = $this->EventeeAttendance->field('id', array('EventeeAttendance.eventee_id'=>$stuarr[$i],'EventeeAttendance.event_id'=>trim($_POST['event_id']),'EventeeAttendance.user_id'=>$_POST['user_id'], 'EventeeAttendance.created'=>date('Y-m-d')));
                      if ($this->EventeeAttendance->id) {
                          $this->EventeeAttendance->saveField('attend', 'P');
                          $j++;
                      }
                }
            }
       }
      }
      else
      {
         if(!empty($stuarr))
       {  
          for ($i=0; $i < count($stuarr) ; $i++) 
        {
            $emaildata=$this->Eventee->find('first',array('conditions'=>array('Eventee.id'=>$stuarr[$i]))); 
            if(!empty($emaildata))
            {
            $email=$emaildata['Eventee']['eventee_email'];
            $stuid=$this->User->find('first',array('conditions'=>array('User.email'=>$email),'recursive'=>-1, 'fields'=>array('id')));
            }
            
            if(!empty($stuid))
            {
            $studentid=$stuid['User']['id'];
            $stubeacon=$this->BeaconStudent->find('list',array('conditions'=>array('BeaconStudent.user_id'=>$studentid,'BeaconStudent.date'=>date('Y-m-d')),'fields'=>array('macAddress')));
              if(!empty($stubeacon))
              {
                $cnt=$this->Beacon->find('count',array('conditions'=>array('Beacon.macAddress'=>$stubeacon,'Beacon.event_id'=>trim($_POST['event_id']),'Beacon.user_id'=>trim($_POST['user_id']))));
                //echo $cnt; die;
              }
              else
              {
                $cnt='0';
              }
              if($cnt>'0')
              {
                  $stuatt['EventeeAttendance']['user_id']=trim($_POST['user_id']);
                  $stuatt['EventeeAttendance']['eventee_id']=$stuarr[$i];
                  $stuatt['EventeeAttendance']['event_id']=trim($_POST['event_id']);
                  $stuatt['EventeeAttendance']['attend']='P';
                  $stuatt['EventeeAttendance']['eventCode']=trim($_POST['event_code']);
                  $this->EventeeAttendance->create();
                  if($this->EventeeAttendance->save($stuatt))
                  {
                   $j++;
                  }
              }
              else
              {
                  $stuatt['EventeeAttendance']['user_id']=trim($_POST['user_id']);
                  $stuatt['EventeeAttendance']['eventee_id']=$stuarr[$i];
                  $stuatt['EventeeAttendance']['event_id']=trim($_POST['event_id']);
                  $stuatt['EventeeAttendance']['attend']='A';
                  $stuatt['EventeeAttendance']['eventCode']=trim($_POST['event_code']);
                  $this->EventeeAttendance->create();
                  if($this->EventeeAttendance->save($stuatt))
                  {
                   $j++;
                  }
              }

            
            }
         }
        } 
      }
      if($j>'0')
       {
        $data=$this->EventeeAttendance->find('all',array('conditions'=>array('EventeeAttendance.user_id'=>trim($_POST['user_id']),'EventeeAttendance.event_id'=>trim($_POST['event_id']),'EventeeAttendance.created'=>date('Y-m-d'))));
    echo json_encode(array('Message'=>'Successfully attended','Data'=>$data)); die;
       }
       else
       {
        echo json_encode(array('Error'=>'Not attended')); die;
       }  
   }
}
public function employeeAttendens()
{
   if(!empty($_POST['user_id']) && !empty($_POST['employee_id']) && !empty($_POST['company_code']) && !empty($_POST['type']))
   {
    $stuatt=array();
    $j=0;
    $this->loadModel('EmployeeAttendance');
    $this->loadModel('Attendance');
    $this->loadModel('Employee');
    $this->loadModel('User');
    $this->loadModel('Beacon');
    $this->loadModel('BeaconStudent');
    $stuarr=explode(',',$_POST['employee_id']);
    $teacherlatlogd=$this->Attendance->find('first',array('conditions'=>array('Attendance.user_id'=>$_POST['user_id'])));
    $teachlong=$teacherlatlogd['Attendance']['longitude'];
    $teachlat=$teacherlatlogd['Attendance']['latitude'];
    if($_POST['type']=='Automatic')
    {
     /* $cnt2=$this->StudentAttendance->find('count', array('conditions'=>array('StudentAttendance.user_id'=>$_POST['user_id'], 'StudentAttendance.created'=>date('Y-m-d'),'StudentAttendance.teacher_id'=>$_POST['class_id'])));
     if($cnt2 > '0')
     {
      echo json_encode(array('Error'=>'You have already taken attandence of students for today')); die;
     }*/
       if(!empty($stuarr))
       {  
          for ($i=0; $i < count($stuarr) ; $i++) 
        {
            $emaildata=$this->Employee->find('first',array('conditions'=>array('Employee.id'=>$stuarr[$i]))); 
            if(!empty($emaildata))
            {
            $email=$emaildata['Employee']['empyolee_email'];
            $stuid=$this->User->find('first',array('conditions'=>array('User.email'=>$email),'recursive'=>-1, 'fields'=>array('id','role')));
            }
            
            if(!empty($stuid))
            {
            $studentid=$stuid['User']['id'];
            $time=date('H:i:s');
           // $backtime=date('H:i:s', strtotime('-1 minutes', strtotime($time)));
           // $backtime2=date('H:i:s', strtotime('-2 minutes', strtotime($time)));
           // $backtime3=date('H:i:s', strtotime('-3 minutes', strtotime($time)));
            $backtime4=date('H:i:s', strtotime('-4 minutes', strtotime($time)));
            $currenttime=date('H:i:s');
            $count=$this->Attendance->find('count',array('conditions'=>array('Attendance.user_id'=>$studentid, 'Attendance.date'=>date('Y-m-d'), 'Attendance.time BETWEEN ? and ?'=>array($backtime4,$currenttime))));
            $stulatlogd=$this->Attendance->find('first',array('conditions'=>array('Attendance.user_id'=>$studentid)));
            if(!empty($stulatlogd))
            {
            $stulong=$stulatlogd['Attendance']['longitude'];
            $stulat=$stulatlogd['Attendance']['latitude'];
            $distance=$this->haversineGreatCircleDistance($teachlat,$teachlong,$stulat,$stulong); 
            $dis=$distance*3.28084; 
            }
            else
            {
              $count=='0'; 
            }
           
            
              if($dis < 200)
              {
               $count=='2'; 
              }
              else
              {
               $count=='0'; 
              }
            }
             else
             {
              $count='0';
             }           
             if($count > '0')
             {
                 $count123=$this->EmployeeAttendance->find('count', array('conditions'=>array('EmployeeAttendance.employee_id'=>$stuarr[$i],'EmployeeAttendance.company_id'=>trim($_POST['company_id']),'EmployeeAttendance.user_id'=>$_POST['user_id'], 'EmployeeAttendance.created'=>date('Y-m-d'))));
                 if($count123 =='0')
                {
                    $stuatt['EmployeeAttendance']['user_id']=trim($_POST['user_id']);
                    $stuatt['EmployeeAttendance']['employee_id']=$stuarr[$i];
                    $stuatt['EmployeeAttendance']['companyCode']=trim($_POST['company_code']);
                    $stuatt['EmployeeAttendance']['company_id']=trim($_POST['company_id']);
                    $stuatt['EmployeeAttendance']['attend']='P';
                    $this->EmployeeAttendance->create();
                    if($this->EmployeeAttendance->save($stuatt))
                    {
                     $j++;
                    }
                }
                else
                {
                  $this->EmployeeAttendance->id = $this->EmployeeAttendance->field('id', array('EmployeeAttendance.employee_id'=>$stuarr[$i],'EmployeeAttendance.company_id'=>trim($_POST['company_id']),'EmployeeAttendance.user_id'=>$_POST['user_id'], 'EmployeeAttendance.created'=>date('Y-m-d')));
                      if ($this->EmployeeAttendance->id) {
                          $this->EmployeeAttendance->saveField('attend', 'P');
                          $j++;
                      }
                }
             }
             else
             {
               $count1234=$this->EmployeeAttendance->find('count', array('conditions'=>array('EmployeeAttendance.employee_id'=>$stuarr[$i],'EmployeeAttendance.company_id'=>trim($_POST['company_id']),'EmployeeAttendance.user_id'=>$_POST['user_id'], 'EmployeeAttendance.created'=>date('Y-m-d'))));
                 if($count1234 =='0')
                {
                  $stuatt['EmployeeAttendance']['user_id']=trim($_POST['user_id']);
                  $stuatt['EmployeeAttendance']['employee_id']=$stuarr[$i];
                  $stuatt['EmployeeAttendance']['company_id']=trim($_POST['company_id']);
                  $stuatt['EmployeeAttendance']['attend']='A';
                  $stuatt['EmployeeAttendance']['companyCode']=trim($_POST['company_code']);
                  $this->EmployeeAttendance->create();
                  if($this->EmployeeAttendance->save($stuatt))
                  {
                   $j++;
                  }
                }
                else
                {
                    $count12345=$this->EmployeeAttendance->find('first', array('conditions'=>array('EmployeeAttendance.employee_id'=>$stuarr[$i],'EmployeeAttendance.company_id'=>trim($_POST['company_id']),'EmployeeAttendance.user_id'=>$_POST['user_id'], 'EmployeeAttendance.created'=>date('Y-m-d'))));
                  $ap=$count12345['EmployeeAttendance']['attend'];
                  if($ap=='A')
                  {
                      $this->EmployeeAttendance->id = $this->EmployeeAttendance->field('id', array('EmployeeAttendance.employee_id'=>$stuarr[$i],'EmployeeAttendance.company_id'=>trim($_POST['company_id']),'EmployeeAttendance.user_id'=>$_POST['user_id'], 'EmployeeAttendance.created'=>date('Y-m-d')));
                      if ($this->EmployeeAttendance->id) {
                          $this->EmployeeAttendance->saveField('attend', 'A');
                          $j++;
                      }
                  }
                  else
                  {
                    $this->EmployeeAttendance->id = $this->EmployeeAttendance->field('id', array('EmployeeAttendance.employee_id'=>$stuarr[$i],'EmployeeAttendance.company_id'=>trim($_POST['company_id']),'EmployeeAttendance.user_id'=>$_POST['user_id'], 'EmployeeAttendance.created'=>date('Y-m-d')));
                      if ($this->EmployeeAttendance->id) {
                          $this->EmployeeAttendance->saveField('attend', 'P');
                          $j++;
                      }
                  }
                  
                } 

             }
          }
        }
      }
      else if($_POST['type']=='Manual')
      {  
            if(!empty($stuarr))
         {  
          for ($i=0; $i < count($stuarr) ; $i++) 
           {
                $count12=$this->EmployeeAttendance->find('count', array('conditions'=>array('EmployeeAttendance.employee_id'=>$stuarr[$i],'EmployeeAttendance.company_id'=>trim($_POST['company_id']),'EmployeeAttendance.user_id'=>$_POST['user_id'], 'EmployeeAttendance.created'=>date('Y-m-d'))));
                if($count12 =='0')
                {
                    $stuatt['EmployeeAttendance']['user_id']=trim($_POST['user_id']);
                    $stuatt['EmployeeAttendance']['employee_id']=$stuarr[$i];
                    $stuatt['EmployeeAttendance']['companyCode']=trim($_POST['company_code']);
                    $stuatt['EmployeeAttendance']['company_id']=trim($_POST['company_id']);
                    $stuatt['EmployeeAttendance']['attend']='P';
                    $this->EmployeeAttendance->create();
                    if($this->EmployeeAttendance->save($stuatt))
                    {
                     $j++;
                    }
                }
                else
                {
                      $this->EmployeeAttendance->id = $this->EmployeeAttendance->field('id', array('EmployeeAttendance.employee_id'=>$stuarr[$i],'EmployeeAttendance.company_id'=>trim($_POST['company_id']),'EmployeeAttendance.user_id'=>$_POST['user_id'], 'EmployeeAttendance.created'=>date('Y-m-d')));
                      if ($this->EmployeeAttendance->id) {
                          $this->EmployeeAttendance->saveField('attend', 'P');
                          $j++;
                      }
                }
            }
       }
      }
      else
      {
         if(!empty($stuarr))
       {  
          for ($i=0; $i < count($stuarr) ; $i++) 
        {
            $emaildata=$this->Employee->find('first',array('conditions'=>array('Employee.id'=>$stuarr[$i]))); 
            if(!empty($emaildata))
            {
            $email=$emaildata['Employee']['employee_email'];
            $stuid=$this->User->find('first',array('conditions'=>array('User.email'=>$email),'recursive'=>-1, 'fields'=>array('id')));
            }
            
            if(!empty($stuid))
            {
            $studentid=$stuid['User']['id'];
            $stubeacon=$this->BeaconStudent->find('list',array('conditions'=>array('BeaconStudent.user_id'=>$studentid,'BeaconStudent.date'=>date('Y-m-d')),'fields'=>array('macAddress')));
              if(!empty($stubeacon))
              {
                $cnt=$this->Beacon->find('count',array('conditions'=>array('Beacon.macAddress'=>$stubeacon,'Beacon.event_id'=>trim($_POST['event_id']),'Beacon.user_id'=>trim($_POST['user_id']))));
                //echo $cnt; die;
              }
              else
              {
                $cnt='0';
              }
              if($cnt>'0')
              {
                  $stuatt['EmployeeAttendance']['user_id']=trim($_POST['user_id']);
                  $stuatt['EmployeeAttendance']['employee_id']=$stuarr[$i];
                  $stuatt['EmployeeAttendance']['company_id']=trim($_POST['company_id']);
                  $stuatt['EmployeeAttendance']['attend']='P';
                  $stuatt['EmployeeAttendance']['companyCode']=trim($_POST['company_code']);
                  $this->EmployeeAttendance->create();
                  if($this->EmployeeAttendance->save($stuatt))
                  {
                   $j++;
                  }
              }
              else
              {
                  $stuatt['EmployeeAttendance']['user_id']=trim($_POST['user_id']);
                  $stuatt['EmployeeAttendance']['employee_id']=$stuarr[$i];
                  $stuatt['EmployeeAttendance']['company_id']=trim($_POST['company_id']);
                  $stuatt['EmployeeAttendance']['attend']='A';
                  $stuatt['EmployeeAttendance']['companyCode']=trim($_POST['company_code']);
                  $this->EmployeeAttendance->create();
                  if($this->EmployeeAttendance->save($stuatt))
                  {
                   $j++;
                  }
              }

            
            }
         }
        } 
      }
      if($j>'0')
       {
        $data=$this->EmployeeAttendance->find('all',array('conditions'=>array('EmployeeAttendance.user_id'=>trim($_POST['user_id']),'EmployeeAttendance.company_id'=>trim($_POST['company_id']),'EmployeeAttendance.created'=>date('Y-m-d'))));
    echo json_encode(array('Message'=>'Successfully attended','Data'=>$data)); die;
       }
       else
       {
        echo json_encode(array('Error'=>'Not attended')); die;
       }  
   }
}
public function attendenceByStudent()
{
   if(!empty($_POST['user_id']) && !empty($_POST['longitude']) && !empty($_POST['latitude']))
   {
  
            $this->loadModel('Attendance');
           // $time=date('H:i:s');
            //$backtime=date('H:i:s', strtotime('-10 minutes', strtotime($time)));
           /* $this->Attendance->deleteAll(array('Attendance.user_id' => $_POST['user_id'],'Attendance.created <=' => date('Y-m-d H:i:s', strtotime('-10 minutes'))));*/
$this->Attendance->deleteAll(array('Attendance.user_id' => $_POST['user_id']));
            $stuatt['Attendance']['user_id']=trim($_POST['user_id']);
            $stuatt['Attendance']['date']=date('Y-m-d');
            $stuatt['Attendance']['time']=date("h:i:s");
            $stuatt['Attendance']['longitude']=trim($_POST['longitude']);
            $stuatt['Attendance']['latitude']=trim($_POST['latitude']);
            $this->Attendance->create();
            if($this->Attendance->save($stuatt))
       {
        echo json_encode(array('Message'=>'Successfully attended')); die;
       }
       else
       {
        echo json_encode(array('Error'=>'Not attended')); die;
       }  
   }
}

public function testing()
{
//$conarr = preg_replace('/[^0-9^A-Z^a-z]+/',' ',$_POST['contact_list']);

echo date('Y-m-d H:i:s', strtotime('-24 hours')); die;
//$value = json_decode(stripslashes($_POST['beacon_id']),true);
//echo $string; die;
//$data2=json_decode($string,true);
	//echo date('Y-m-d h:i:s'); die;
//echo "<pre>"; print_r($value); die;
//echo base64_encode($_FILES['name']); die;
/*$uniq=$this->gen_uuid();
echo $uniq;die;
echo $_POST['jjs']; die;
$string = str_replace(' ', '\', $_POST['jjs']);
echo $string; die;
$jsd=json_decode($_POST['jjs'],true);
echo json_encode($jsd); die;
echo json_encode(array('firstvar'=>$this->passedArgs['abc'],'secondvar'=>$this->passedArgs['bbd'])); die;*/
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
public function attandenceList()
{
  if(!empty($_POST['user_id']) &&  !empty($_POST['class_id']))
  {
    $this->loadModel('StudentAttendance');
    $data=$this->StudentAttendance->find('all',array('conditions'=>array('StudentAttendance.user_id'=>trim($_POST['user_id']),'StudentAttendance.teacher_id'=>trim($_POST['class_id'])),'order'=>array('StudentAttendance.created'=>'DESC')));
    if(!empty($data))
    {
      echo json_encode(array('Message'=>'Data successfully retrive','Data'=>$data)); die;
    }
    else
    {
        echo json_encode(array('Error'=>'Data is not available')); die; 
    }
  }
}

public function deleteStudentByTeacher()
{
  if(!empty($_POST['student_id']))
  {
    $this->loadModel('Student');
    $this->loadModel('StudentAttendance');
    if($this->Student->delete($_POST['student_id']))
    {
      if($this->StudentAttendance->deleteAll(array('StudentAttendance.student_id' =>$_POST['student_id'])))
      {
      echo json_encode(array('Message'=>'Successfully deleted')); die;
      }
    }
    else
    {
     echo json_encode(array('Error'=>'Not successfully deleted')); die;
    }
  }die;
}

public function deleteClassByTeacher()
{
  if(!empty($_POST['class_id']))
  {
    $this->loadModel('Teacher');
    $this->loadModel('StudentAttendance');
    if($this->Teacher->delete($_POST['class_id']))
    {
      $this->StudentAttendance->deleteAll(array('StudentAttendance.teacher_id' =>$_POST['class_id']));
      
      echo json_encode(array('Message'=>'Successfully deleted')); die;
      
    }
    else
    {
     echo json_encode(array('Error'=>'Not successfully deleted')); die;
    }
  }die;
}
public function attandenceListByStudent()
{
  if(!empty($_POST['email']) &&  !empty($_POST['class_id']))
  {
    $this->loadModel('StudentAttendance');
                $this->loadModel('Student');
              $stuidata=$this->Student->find('first',array('conditions'=>array('Student.student_email'=>$_POST['email']),'fields'=>array('id')));
              $stuid=$stuidata['Student']['id'];
  $this->StudentAttendance->unbindModel( array('belongsTo' => array('Student')));
$this->StudentAttendance->bindModel(
        array('belongsTo' => array(
                'User' => array(
                    'className' => 'User',
                    'foreignKey' => 'user_id'
                )
            )
        )
    );
$data=$this->StudentAttendance->find('all',array('conditions'=>array('StudentAttendance.student_id'=>$stuid,'StudentAttendance.teacher_id'=>trim($_POST['class_id']))));
    if(!empty($data))
    {
      echo json_encode(array('Message'=>'Data successfully retrive','Data'=>$data)); die;
    }
    else
    {
        echo json_encode(array('Error'=>'Data is not available')); die; 
    }
  }
}

public function haversineGreatCircleDistance(
  $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
{
  // convert from degrees to radians
  $latFrom = deg2rad($latitudeFrom);
  $lonFrom = deg2rad($longitudeFrom);
  $latTo = deg2rad($latitudeTo);
  $lonTo = deg2rad($longitudeTo);

  $latDelta = $latTo - $latFrom;
  $lonDelta = $lonTo - $lonFrom;

  $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
    cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
  return $angle * $earthRadius;
}
public function addBeacons()
{
	$this->loadModel('BeaconStudent');
    if(!empty($_POST['user_id']) && !empty($_POST['macAddress']))
    {
      $j='0';
      $this->BeaconStudent->deleteAll(array('BeaconStudent.user_id' => $_POST['user_id']));
      $macadd=explode(',',$_POST['macAddress']);
      //echo "<pre>"; print_r($macadd); die;
      for ($i=0; $i < count($macadd); $i++) 
      { 

      $data['BeaconStudent']['user_id']=trim($_POST['user_id']);
      $data['BeaconStudent']['macAddress']=$macadd[$i];
      $data['BeaconStudent']['date']=date('Y-m-d');
      $data['BeaconStudent']['time']=date("h:i:s");
       $this->BeaconStudent->create();
        if($this->BeaconStudent->save($data))
        {
        	$j++;
        }
      }
      if($j>'0')
      {
        echo json_encode(array('Message'=>'Successfully add beacon')); die;
      }
    }
    else if(!empty($_POST['user_id']) && $_POST['macAddress']=='')
     {
     	$becdelete=$this->BeaconStudent->deleteAll(array('BeaconStudent.user_id' => $_POST['user_id']));
        if($becdelete)
        {
        echo json_encode(array('Message'=>'Successfully exit from beacon region')); die;	
        }
     }
     else
     {
     	die;
     }
}
public function addCodeForParent()
{
  if(!empty($_POST['user_id']))
  {
    $this->loadModel('StudentCode');
    $this->loadModel('User');
    $this->loadModel('Student');
    $userdata=$this->User->find('first',array('conditions'=>array('User.id'=>$_POST['user_id']),'fields'=>array('id','email')));
    $count=$this->Student->find('count',array('conditions'=>array('Student.student_email'=>$userdata['User']['email'])));
    if($count=='0')
    {
      echo json_encode(array('Error'=>'You can not generate this code untill you added in any class')); die;
    }
    $uncode=$this->gen_uuid();
    $this->StudentCode->deleteAll(array('StudentCode.user_id' => $_POST['user_id']));
    $data['StudentCode']['user_id']=trim($_POST['user_id']);
    $data['StudentCode']['code_for_parent']=$uncode;
    if($this->StudentCode->save($data))
    {
      echo json_encode(array('Message'=>'successfully created code for parent', 'Code'=>$uncode));die;
    }
  }
}
public function deleteAfter24H()
{
  $this->loadModel('StudentCode');
   //date('Y-m-d H:i:s', strtotime('+24 hours'));
  $this->StudentCode->deleteAll(array('StudentCode.created <=' => date('Y-m-d H:i:s', strtotime('-24 hours')))); die;
}
public function attandenceListByParent()
{
  if(!empty($_POST['student_id']))
  {
   // $stuarray=array();
    //$stuarray=explode(',', $_POST['student_id']);
    $this->loadModel('StudentAttendance');
    $this->loadModel('Teacher');
    $this->loadModel('Student');
    $this->loadModel('User');
    $emaildata=$this->User->find('first',array('conditions'=>array('User.id'=>$_POST['student_id']),'fields'=>array('email','id'),'recursive'=>-1));
    $student_id=$this->Student->find('list',array('conditions'=>array('Student.student_email'=>$emaildata['User']['email']),'fields'=>array('id'),'recursive'=>-1));
   //echo "<pre>"; print_r($student_id); die;
    $this->StudentAttendance->Behaviors->load('Containable');
               $this->StudentAttendance->bindModel(array(
        'belongsTo' => array(
            'Teacher' => array(
                'foreignKey' => 'teacher_id'
            ))));
           $data=$this->StudentAttendance->find('all',array('conditions'=>array('StudentAttendance.student_id'=>$student_id),'contain'=>array('Teacher'=>array('fields'=>array('id','user_id','className','classCode','latitude','longitude')))));
  if(!empty($data))
  {
    echo json_encode(array('Message'=>'successfully found','Data'=>$data));die;
  }
  else
  {
    echo json_encode(array('Error'=>'Record not found')); die;
  }
  }
}
public function addRole()
{
  if (!empty($_POST['role']) && !empty($_POST['user_id'])) 
  {
     $this->loadModel('Role');
     $this->loadModel('User');
     $this->Role->deleteAll(array('Role.user_id' => $_POST['user_id'],'Role.role' => $_POST['role']));
     $rdata['Role']['user_id']=trim($_POST['user_id']);
     $rdata['Role']['role']=trim($_POST['role']);  
     if($this->Role->save($rdata))
     {
      $this->User->Behaviors->load('Containable');
        $roledata=$this->User->find('first',array('conditions'=>array('User.id'=>trim($_POST['user_id'])),'fields'=>array('id','username','email','school','userview','status','code','device_token','created'),'contain'=>array('Role'=>array('order' => array('Role.created' => 'ASC')))));
         if(!empty($roledata))
           {
            echo json_encode(array('Message'=>'successfully add role','Data'=>$roledata)); die;
           }
      
     }
     else
     {
      echo json_encode(array('Error'=>'Not successfully add role'));die;
     }
  }
}
public function getlatlong()
{
  if(!empty($_POST['mainstu_id']))
  {
    $this->loadModel('Attendance');
    $latlongdata=$this->Attendance->find('all',array('conditions'=>array('Attendance.user_id'=>$_POST['mainstu_id'])));
    if(!empty($latlongdata))
    {
      echo json_encode(array('Message'=>'Successfully fond','Data'=>$latlongdata));die;
    }
    else
    {
     echo json_encode(array('Error'=>'Not fond'));die; 
    }
  }
}

public function addEventByEventHost()
   {
      $this->loadModel('Event');
      $kk=0;
      if(!empty($_POST))
      {
       $data['Event']['user_id']=trim($_POST['user_id']);
       $data['Event']['eventName']=trim($_POST['eventName']);
      /*$count3=$this->Event->find('count',array('conditions'=>array('Event.user_id'=>$_POST['user_id'])));
      if($count3 > 5 || $count3==5)
      {
        echo json_encode(array('Error'=>'You can not add class more than 5.')); die;
      }*/
      $count=$this->Event->find('count',array('conditions'=>array('Event.user_id'=>$_POST['user_id'],'Event.startTime'=>date('h:i:s',strtotime(trim($_POST['startTime']))),'Event.endTime'=>date('h:i:s',strtotime(trim($_POST['endTime']))),'Event.repeatType'=>$_POST['repeatType'])));
      $count2=$this->Event->find('count',array('conditions'=>array('Event.user_id'=>$_POST['user_id'],'Event.eventName'=>$_POST['eventName'])));
       if($count > 0)
      {
      echo json_encode(array('Error'=>'You have already added Event on same time')); die;
      }
      if($count2 > 0)
      {
      echo json_encode(array('Error'=>'Event already exist')); die;
      }
             $data['Event']['startTime']=date('h:i:s A',strtotime(trim($_POST['startTime'])));
             $data['Event']['endTime']=date('h:i:s A',strtotime(trim($_POST['endTime'])));
             $data['Event']['startDate']=date('Y-m-d',strtotime(trim($_POST['startDate'])));
             $data['Event']['endDate']=date('Y-m-d',strtotime(trim($_POST['endDate'])));
             $data['Event']['repeatType']=trim($_POST['repeatType']);
             $data['Event']['district']=trim($_POST['district']);
             $data['Event']['code']=trim($_POST['code']);
             //$data['Event']['beacon_id']=trim($_POST['beacon_id']);
               $uncode=$this->gen_uuid();
              $count3=$this->Event->find('count',array('conditions'=>array('Event.eventCode'=>$uncode)));
             while($count3>0)
             {
              $uncode=$this->gen_uuid();
              $count3=$this->Event->find('count',array('conditions'=>array('Event.eventCode'=>$uncode)));
              
             }
              
             $data['Event']['eventCode']=$uncode;
             $data['Event']['latitude']=trim($_POST['latitude']);
             $data['Event']['longitude']=trim($_POST['longitude']);
             $data['Event']['status']=trim($_POST['status']);
             $data['Event']['interval']=trim($_POST['interval']); 
             $saveddata=$this->Event->save($data); 
             if($saveddata)
             {
               if(!empty($_POST['beacon_id']))
               { 
                    $beaconData=trim($_POST['beacon_id']);
                    $beaconData2=json_decode(stripslashes($beaconData), true);
                    $this->loadModel('Beacon');
                     foreach($beaconData2 as $beacons) 
                  {
                    
                    $datasb['Beacon']['user_id']=$saveddata['Event']['user_id'];
                    $datasb['Beacon']['event_id']=$saveddata['Event']['id'];
                    $datasb['Beacon']['proximityUUID']=$beacons['proximityUUID'];
                    $datasb['Beacon']['name']=$beacons['name'];
                    $datasb['Beacon']['macAddress']=$beacons['macAddress'];
                    $datasb['Beacon']['major']=$beacons['major'];
                    $datasb['Beacon']['minor']=$beacons['minor'];
                    $datasb['Beacon']['measuredPower']=$beacons['measuredPower'];
                    $datasb['Beacon']['rssi']=$beacons['rssi'];
                    $this->Beacon->create();
                    $beaconData=$this->Beacon->save($datasb);
                    if(!empty($beaconData))
                    {
                      $kk++;                   
                    }   
  

                  }
               }
               if($saveddata['Event']['repeatType']=='WEEKLY')
               {
                        $this->loadModel('RepeatClass');
                $setdata['RepeatEvent']['event_id']=$saveddata['Event']['id'];
                $setdata['RepeatEvent']['repeat_on']=trim($_POST['repeatDays']);
                if($this->RepeatClass->save($setdata))
                {
                echo json_encode(array('Message'=>'Saved successfully','Data'=>$saveddata),true); die; 
                        }
               }
              else
               {
                echo json_encode(array('Message'=>'Saved successfully','Data'=>$saveddata),true); die;
               }
               
             }
             else
             {
              echo json_encode(array('Error'=>'Not Saved')); die;
             }

      }
   }
public function addCompanyByManager()
   {
      $this->loadModel('Company');
      
      $kk=0;
      if(!empty($_POST))
      {
       $data['Company']['user_id']=trim($_POST['user_id']);
       $data['Company']['companyName']=trim($_POST['companyName']);
      
      //$count=$this->Company->find('count',array('conditions'=>array('Company.user_id'=>$_POST['user_id'],'Company.startTime'=>date('h:i:s',strtotime(trim($_POST['startTime']))),'Company.endTime'=>date('h:i:s',strtotime(trim($_POST['endTime']))),'Company.repeatType'=>$_POST['repeatType'])));
      $count2=$this->Company->find('count',array('conditions'=>array('Company.user_id'=>$_POST['user_id'],'Company.companyName'=>$_POST['companyName'])));
     /*  if($count > 0)
      {
      echo json_encode(array('Error'=>'You have already added Company on same time')); die;
      }*/
      if($count2 > 0)
      {
      echo json_encode(array('Error'=>'Company already exist')); die;
      }
             //$data['Company']['startTime']=date('h:i:s A',strtotime(trim($_POST['startTime'])));
            // $data['Company']['endTime']=date('h:i:s A',strtotime(trim($_POST['endTime'])));
             $data['Company']['repeatType']=trim($_POST['repeatType']);
             $data['Company']['district']=trim($_POST['district']);
             $data['Company']['code']=trim($_POST['code']);
             //$data['Company']['beacon_id']=trim($_POST['beacon_id']);
               $uncode=$this->gen_uuid();
              $count3=$this->Company->find('count',array('conditions'=>array('Company.companyCode'=>$uncode)));
             while($count3>0)
             {
              $uncode=$this->gen_uuid();
              $count3=$this->Company->find('count',array('conditions'=>array('Company.companyCode'=>$uncode)));
              
             }
              
             $data['Company']['companyCode']=$uncode;
             $data['Company']['latitude']=trim($_POST['latitude']);
             $data['Company']['longitude']=trim($_POST['longitude']);
             $data['Company']['status']=trim($_POST['status']);
             $data['Company']['interval']=trim($_POST['interval']); 
             $saveddata=$this->Company->save($data); 
             if($saveddata)
             {
               if(!empty($_POST['beacon_id']))
               { 
                    $beaconData=trim($_POST['beacon_id']);
                    $beaconData2=json_decode(stripslashes($beaconData), true);
                    $this->loadModel('Beacon');
                     foreach($beaconData2 as $beacons) 
                  {
                    
                    $datasb['Beacon']['user_id']=$saveddata['Company']['user_id'];
                    $datasb['Beacon']['company_id']=$saveddata['Company']['id'];
                    $datasb['Beacon']['proximityUUID']=$beacons['proximityUUID'];
                    $datasb['Beacon']['name']=$beacons['name'];
                    $datasb['Beacon']['macAddress']=$beacons['macAddress'];
                    $datasb['Beacon']['major']=$beacons['major'];
                    $datasb['Beacon']['minor']=$beacons['minor'];
                    $datasb['Beacon']['measuredPower']=$beacons['measuredPower'];
                    $datasb['Beacon']['rssi']=$beacons['rssi'];
                    $this->Beacon->create();
                    $beaconData=$this->Beacon->save($datasb);
                    if(!empty($beaconData))
                    {
                      $kk++;                   
                    }   
  

                  }
               }
               if($saveddata['Company']['repeatType']=='WEEKLY')
               {
                        $this->loadModel('RepeatCompany');
                $setdata['RepeatCompany']['company_id']=$saveddata['Company']['id'];
                $setdata['RepeatCompany']['repeat_on']=trim($_POST['repeatDays']);
                if($this->RepeatCompany->save($setdata))
                {
                echo json_encode(array('Message'=>'Saved successfully','Data'=>$saveddata),true); die; 
                        }
               }
              else
               {
                echo json_encode(array('Message'=>'Saved successfully','Data'=>$saveddata),true); die;
               }
               
             }
             else
             {
              echo json_encode(array('Error'=>'Not Saved')); die;
             }

      }
   }
public function addEmployee()
    {
    App::uses('CakeEmail', 'Network/Email');
      $this->loadModel('Employee');
      if(!empty($_POST))
      {
        $studata['Employee']['company_id']=trim($_POST['company_id']);
   if(empty($_POST['id']))
{
$count=$this->Employee->find('count',array('conditions'=>array('Employee.companyCode'=>$_POST['companyCode'],'Employee.employee_email'=>$_POST['employeeEmail'])));
 if($count > 0)
   {
echo json_encode(array('Error'=>'Eventee already added for same companyCode')); die;
   }
}  
else
{
$count=$this->Employee->find('count',array('conditions'=>array('Employee.companyCode'=>$_POST['companyCode'],'Employee.employee_email'=>$_POST['employeeEmail'],'Employee.id !=' => $_POST['id'])));
 if($count > 0)
   {
echo json_encode(array('Error'=>'Eventee Email id is already used please try another.')); die;
   }
}  
        if(!empty($_POST['id']))
         {
       $studata['Employee']['id']=trim($_POST['id']);
         }
        $studata['Employee']['companyCode']=trim($_POST['companyCode']);
        $studata['Employee']['status']=trim($_POST['status']);
        if(!empty($_POST['parentEmail']))
         {
$studata['Employee']['parent_email']=trim($_POST['parentEmail']);
         }
      if(!empty($_POST['image']))
      {
        
                $img = $_POST['image'];
                $img = str_replace('data:image/png;base64,', '', $img);
                $img = str_replace(' ', '+', $img);
                $data = base64_decode($img);
                $nforsave=uniqid() . '.png';
                $file = WWW_ROOT . 'img/' . $nforsave;
                $success = file_put_contents($file, $data);
                $studata['Employee']['image'] = $nforsave;
               
      }
        $studata['Employee']['employee_email']=trim($_POST['employeeEmail']);
       $data=$this->Employee->save($studata);
        if(!empty($data))
        {
           
          $Email = new CakeEmail();
          if(!empty($_POST['parentEmail']))
         {
            $Email->template('welcomecompany')->emailFormat('html')->from(array('notify-noreply@abdevs.com' => 'Attendance App'))->to(array(trim($_POST['employeeEmail']),trim($_POST['parentEmail'])))->viewVars(array('CompanyCode' => $_POST['companyCode']))->subject('For conformation')->send('you have registered for belove Event Code');
          echo json_encode(array('Message'=>'Saved successfully','Data'=>$data)); die;
         }
         else
         {
            $Email->template('welcomecompany')->emailFormat('html')->from(array('notify-noreply@abdevs.com' => 'Attendance App'))->to(array(trim($_POST['employeeEmail'])))->viewVars(array('CompanyCode' => $_POST['companyCode']))->subject('For conformation')->send('you have registered for belove Event Code');
          echo json_encode(array('Message'=>'Saved successfully','Data'=>$data)); die;
         }
          

        }
        else
        {
          echo json_encode(array('Error'=>'Not Saved')); die;
        }
      }
    

    }
    public function schoollist()
    {
      $this->loadModel('School');
      $data=$this->School->find('all',array('recursive'=>-1));
      if(empty($data))
      {
        echo json_encode(array('Message'=>'Successfully found','Data'=>$data)); die;
      }
      else
      {
        echo json_encode(array('Error'=>'Not found')); die; 
      }
    }

    public function deleteAttendanceByTeacher()
    {
      if(!empty($_POST['studentAttendance_id']))
      { 
           $this->loadModel('StudentAttendance');
          if($this->StudentAttendance->delete($_POST['studentAttendance_id']))
          {
            echo json_encode(array('Message'=>'Successfully deleted')); die;
          }
          else
          {
            echo json_encode(array('Error'=>'Not deleted')); die; 
          }
      }
    }
    public function export() 
    {
      if(!empty($_POST['class_id']))
      {
      $this->loadModel('Student');
      $this->loadModel('StudentAttendance');
      $data = $this->StudentAttendance->find('all',array('conditions'=>array('StudentAttendance.teacher_id'=>$_POST['class_id'])));
     //echo "<pre>"; print_r($data);die;
    /* foreach($data as $index => $datas){
                $vendorRecord = $this->Student->findById($datas['StudentAttendance']['student_id']);
                $arra1=$vendorRecord['Student']['student_email'];
                $data[$index]['StudentAttendance']['student_email'] = $arra1;
              }*/
     $data2="";
     $data2 .= "Email".","."Date".","."Attendance"."\n";
     foreach ($data as $datase) {
     $data2 .= $datase['Student']['student_email'].",".$datase['StudentAttendance']['created'].",".$datase['StudentAttendance']['attend']."\n";
     }
      $file = 'file.csv';
      chmod($file, 0777);
      if(file_put_contents($file, $data2))
      {
        $link='file.csv';
        echo json_encode(array('Message'=>'Csv successfully saved','link'=>$link)); die;
      }   
   

      }
   
    }
    public function customReport()
    {
      if(!empty($_POST['class_id']) && !empty($_POST['date']))
      {
      $this->loadModel('Student');
      $this->loadModel('StudentAttendance');
      $date2=date('Y-m-d',strtotime($_POST['date']));
      $data = $this->StudentAttendance->find('all',array('conditions'=>array('StudentAttendance.teacher_id'=>$_POST['class_id'],'StudentAttendance.created'=>$date2)));
        if(!empty($data))
        {
          echo json_encode(array('Message'=>'Data successfully found','Data'=>$data)); die;
        }
        else
        {
          echo json_encode(array('Error'=>'Data not found')); die;
        }
      }
    }
    public function sendNotificationToTeacher()
    {
      if(!empty($_POST['user_id']) && !empty($_POST['email']))
      {
        define("GOOGLE_API_KEY", "AIzaSyA7e1MpMHE26kylM3M2HObOwsJlWfVc_qM");
        $this->loadModel('Teacher');
        $this->loadModel('Student');
        $this->loadModel('Gcmreg');
        $this->loadModel('Notification');
          $teacherdata=$this->Student->find('list',array('conditions'=>array('Student.student_email'=>$_POST['email']),'fields'=>array('teacher_id')));
           if(!empty($teacherdata))
           {
            $date=date('Y-m-d');
            $time=date('H:i:s');
            //echo $date.'/'.$time;die;
               $conditions = array(
        'conditions' => array(
        'and' => array(
                        array('Teacher.startDate <= ' => $date,
                              'Teacher.endDate >= ' => $date
                             ),
                        array('Teacher.startTime <= ' => $time,
                              'Teacher.endTime >= ' => $time
                             ),

            'Teacher.id'=>$teacherdata,
          
            )),'fields'=>array('user_id','classCode','id'),'recursive'=>-1);
             $classData=$this->Teacher->find('all',$conditions);
           if (!empty($classData)) 
              {
                foreach ($classData as $classDatas) {
                  //echo $classDatas['Teacher']['user_id'];
                  $regid=$this->Gcmreg->find('first',array('conditions'=>array('Gcmreg.user_id'=>$classDatas['Teacher']['user_id'])));
                    $rg_id=$regid['Gcmreg']['reg_id'];
                     if(!empty($rg_id))
                     {   
                         $eml=$_POST['email'];
                         $clcode=$classDatas['Teacher']['classCode'];
                         $msg=$eml.' '.'is using phone at this time';
                         $notidata['Notification']['user_id']=$_POST['user_id'];
                         $notidata['Notification']['tech_id']=$classDatas['Teacher']['user_id'];
                         $notidata['Notification']['teacher_id']=$classDatas['Teacher']['id'];
                         $notidata['Notification']['message']=$msg;
                         $notidata['Notification']['classCode']=$clcode;
                         $this->Notification->create();
                         $this->Notification->save($notidata);
                         $pushToAnd=$this->sendPushNotificationToAndroid($rg_id,$msg,$clcode);
                     }
                }die;
              }
           }die;
          // echo "<pre>"; print_r($classData); die;
      }die;
    }
    public function editAttandence()
    {
      if(!empty($_POST['studentAttendance_id']) && !empty($_POST['attend']))
      {
        $this->loadModel('StudentAttendance');
         $this->StudentAttendance->id = $_POST['studentAttendance_id'];
          if($this->StudentAttendance->saveField('attend',$_POST['attend']))
          {
             echo json_encode(array('Message'=>'Successfully updated')); die;
          }
          else
          {
             echo json_encode(array('Error'=>'Not updated')); die;
          }
      }
    }
 public function sendPushNotificationToAndroid($gcmid, $message,$clcode)
{
  
   $url = 'https://android.googleapis.com/gcm/send';
            $fields = array(
                'registration_ids' => array($gcmid),
                'data' => array("m" =>$message,"classCode"=>trim($clcode)),
                
            );
        // Google Cloud Messaging GCM API Key
           
                  $headers = array(
                      'Authorization: key=' . GOOGLE_API_KEY,
                      'Content-Type: application/json'
                  );
                  $ch = curl_init();
                  curl_setopt($ch, CURLOPT_URL, $url);
                  curl_setopt($ch, CURLOPT_POST, true);
                  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                  curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0); 
                  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
                  $resu = curl_exec($ch); 
                                    //echo "<pre>"; print_r($result); die;      
                  if ($resu === FALSE) {
                                        
                      die('Curl failed: ' . curl_error($ch));
                  }
                  curl_close($ch);
                   //return $resu;
}
public function notificationlist()
{
  if(!empty($_POST['user_id']) && !empty($_POST['class_id']))
  {
    $this->loadModel('Notification');
    $data=$this->Notification->find('all',array('conditions'=>array('Notification.tech_id'=>$_POST['user_id'],'Notification.teacher_id'=>$_POST['class_id'])));
    if(!empty($data))
    {
      echo json_encode(array('Message'=>'Successfully found','Data'=>$data)); die;
    }
    else
    {
      echo json_encode(array('Message'=>'Data Not found')); die;
    }
  }
}





}

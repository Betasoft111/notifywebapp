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

/*public function beforeFilter() {
          parent::beforeFilter();
           $this->Auth->allow('addClassByTeacher');
      }*/
  public function userRegistered()
  {
    if(!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['school']) && !empty($_POST['userview']) && !empty($_POST['securityQuestion']) && !empty($_POST['securityQuestionAnswer']))
    {
      $this->loadModel('User');
      $count=$this->User->find('count',array('conditions'=>array('User.email'=>trim($_POST['email']))));
      if($count > '0')
      {
        echo json_encode(array('Error'=>'Email already exist.'));die;
      }
      $userdata['User']['email']=trim($_POST['email']);
      $userdata['User']['password']=hash('ripemd160',trim($_POST['password'])); 
      $userdata['User']['school']=trim($_POST['school']);
      $userdata['User']['userview']=trim($_POST['userview']);
      $userdata['User']['question']=trim($_POST['securityQuestion']);
      $userdata['User']['answer']=trim($_POST['securityQuestionAnswer']);
      $userdata['User']['status']=trim($_POST['status']);
      $userdata['User']['code']=uniqid('UC');
      $userdata['User']['device_token']=trim($_POST['deviceToken']);
      if($this->User->save($userdata))
      {
        echo json_encode(array('Message'=>'Saved successfully')); die;
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
  public function login() {
    if (!empty($_POST['email']) && !empty($_POST['password'])) 
      {
        $this->loadModel('User');
       $pass=hash('ripemd160',trim($_POST['password'])); 
       $count=$this->User->find('count',array('conditions'=>array('User.email'=>trim($_POST['email']),'User.password'=>$pass)));
//echo $count; die;
        if($count=='1')
        {
      $this->User->Behaviors->load('Containable');
      
       $data=$this->User->find('all',array('conditions'=>array('User.email'=>trim($_POST['email']),'User.password'=>$pass),'fields'=>array('id','username','email','school','userview','role','status','code','device_token','created'),'contain'=>array('Class'=>array('Student'))));
           if(!empty($data))
           {
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
        echo json_encode(array('Error'=>'Please enter your username and password.')); die;
      }
   }

  public function addClassByTeacher()
   {
      $this->loadModel('Class');
      if(!empty($_POST))
      {
             $data['Class']['user_id']=trim($_POST['user_id']);
             
$data['Class']['className']=trim($_POST['className']);
      $count=$this->Class->find('count',array('conditions'=>array('Class.user_id'=>$_POST['user_id'],'Class.startTime'=>date('h:i:s',strtotime(trim($_POST['startTime']))),'Class.endTime'=>date('h:i:s',strtotime(trim($_POST['endTime']))),'Class.repeatType'=>$_POST['repeatType'])));
//echo $count; die;
$count2=$this->Class->find('count',array('conditions'=>array('Class.user_id'=>$_POST['user_id'],'Class.className'=>$_POST['className'])));
 if($count > 0)
{
echo json_encode(array('Error'=>'You have already added class on same time')); die;
}
if($count2 > 0)
{
echo json_encode(array('Error'=>'Class already exist')); die;
}
             $data['Class']['startTime']=date('h:i:s A',strtotime(trim($_POST['startTime'])));
             $data['Class']['endTime']=date('h:i:s A',strtotime(trim($_POST['endTime'])));
             $data['Class']['startDate']=date('Y-m-d',strtotime(trim($_POST['startDate'])));
             $data['Class']['endDate']=date('Y-m-d',strtotime(trim($_POST['endDate'])));
             $data['Class']['repeatType']=trim($_POST['repeatType']);
             $data['Class']['district']=trim($_POST['district']);
             $data['Class']['code']=trim($_POST['code']);
             $data['Class']['classCode']=uniqid('CC');
             $data['Class']['latitude']=trim($_POST['latitude']);
             $data['Class']['longitude']=trim($_POST['longitude']);
             $data['Class']['status']=trim($_POST['status']);
              
             $saveddata=$this->Class->save($data); 
             if($saveddata)
             {
               if($saveddata['Class']['repeatType']=='REPEAT_DATE')
               {
                        $this->loadModel('RepeatClass');
                $setdata['RepeatClass']['class_id']=$saveddata['Class']['id'];
                $setdata['RepeatClass']['repeat_on']=trim($_POST['repeatDates']);
                if($this->RepeatClass->save($setdata))
                {
                echo json_encode(array('Message'=>'Saved successfully','ClassCode'=>$saveddata['Class']['classCode'],'ClassId'=>$saveddata['Class']['id'])); die; 
                        }
               }
               else if($saveddata['Class']['repeatType']=='REPEAT_DAY')
               {
                $this->loadModel('RepeatClass');
                $setdata['RepeatClass']['class_id']=$saveddata['Class']['id'];
                $setdata['RepeatClass']['repeat_on']=trim($_POST['repeatDays']);
                if($this->RepeatClass->save($setdata))
                {
                echo json_encode(array('Message'=>'Saved successfully','ClassCode'=>$saveddata['Class']['classCode'],'ClassId'=>$saveddata['Class']['id'])); die; 
                        }
               }
                 else
               {
                echo json_encode(array('Message'=>'Saved successfully','ClassCode'=>$saveddata['Class']['classCode'],'ClassId'=>$saveddata['Class']['id'])); die;
               }
               
             }
             else
             {
              echo json_encode(array('Error'=>'Not Saved')); die;
             }

      }
   }
 public function teacherclass()
    {

     //echo hash('ripemd160','Abc1234'); die;
    $this->loadModel('Class');
//echo "hii"; die;
   $teacherdata=$this->Class->findBy('all',array('conditions'=>array('')));
      if(!empty($teacherdata))
       {
       echo json_encode(array('data'=>$teacherdata)); die;
       }
     else
      {
      echo json_encode(array('Message'=>'No records')); die;
      }     

    }

     public function addStudent()
    {
    App::uses('CakeEmail', 'Network/Email');
      $this->loadModel('Student');
      if(!empty($_POST))
      {
        $studata['Student']['class_id']=trim($_POST['classId']);
       $count=$this->Student->find('count',array('conditions'=>array('Student.classCode'=>$_POST['classCode'],'Student.student_email'=>$_POST['studentEmail'])));
 if($count > 0)
{
echo json_encode(array('Error'=>'Student already added for same classCode')); die;
}

        $studata['Student']['classCode']=trim($_POST['classCode']);
        $studata['Student']['status']=trim($_POST['status']);
        $studata['Student']['parent_email']=trim($_POST['parentEmail']);
        $studata['Student']['student_email']=trim($_POST['studentEmail']);
        if($this->Student->save($studata))
        {
           
          $Email = new CakeEmail();
          $Email->template('welcome')->emailFormat('html')->from(array('sachin_kumar@rvtechnologies.info' => 'Attendance App'))->to(array(trim($_POST['studentEmail']),trim($_POST['parentEmail'])))->viewVars(array('ClassCode' => $_POST['classCode']))->subject('For conformation')->send('you have registered for belove class Code');
          echo json_encode(array('Message'=>'Saved successfully')); die;

        }
        else
        {
          echo json_encode(array('Message'=>'Not Saved')); die;
        }
      }
    

    }
  
 public function emailsend()
    {
     //echo uniqid('CC',TRUE); die;
       App::uses('CakeEmail', 'Network/Email');
       $Email = new CakeEmail();
       $Email->template('welcome')->emailFormat('html')->from(array('sachin_kumar@rvtechnologies.info' => 'sachin saini'))->to('sachin_kumar@rvtechnologies.info')->viewVars(array('value' => 12345))->attachments(array('http://www.abdevs.com/attendance/img/cake.power.gif'))->subject('Testing by cakephp')->send('dskfjkdjf idfjkd dsjfkdsjfk dkfdjfk dskfd fkdjfkdsf dkfdkf dksfjkdsf hkdf');die;
     }
}

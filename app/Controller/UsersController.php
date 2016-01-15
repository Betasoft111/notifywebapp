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
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session','Auth','Gcm','AjaxMultiUpload.Upload');
  public $helper=array('Session','AjaxMultiUpload.Upload'); 
  //var $helpers = array('AjaxMultiUpload.Upload'); 
  public $uses=array('Role','User','School');
  public function beforeFilter() {
    parent::beforeFilter();
    // Allow users to register and logout.
    $this->Auth->allow('login','signup','contactUs','gen_uuid','logout','getquestion','forgatpassword','matchCode','updatePassword');
}

public function login($userInfo=NULL) {

if($this->Auth->loggedIn()){
  $this->redirect('/management');
}
   
   $this->layout='home'; 
   //echo "hii"; die;
     // echo "<pre>"; print_r($userInfo);
     if(!empty($userInfo))
     {
     	//echo $userInfo['email']; die;
     	$this->User->Behaviors->load('Containable');
        $options = array(
            'conditions' => array(
                'User.email' => $userInfo['email'],
                'User.password' => $userInfo['password']
            ),
            'fields' => array(
                'User.id',
                'User.email',
                'User.school',
                'User.username'
                // other fields you need
            ),'contain'=>array('Role')
        );

        $userData = $this->User->find('first', $options);
        //echo "<pre>"; print_r($userData); die;
        if (!empty($userData) && $this->Auth->login($userData)) {
            $this->Session->setFlash(__('Successfully signup'));
            //$this->redirect($this->Auth->redirectUrl());
            $this->redirect(array('controller'=>'users','action'=>'profile'));
        }/* else {
            $this->Session->setFlash(__('Email, and/or password are incorrect'));
        }*/

     }
    if ($this->request->is('post')) {
        //echo "<pre>"; print_r($this->request->data);die;
      $this->User->Behaviors->load('Containable');
        $options = array(
            'conditions' => array(
                'User.email' => $this->request->data['User']['email'],
                'User.password' => hash('ripemd160',$this->request->data['User']['password'])
            ),
            'fields' => array(
                'User.id',
                'User.email',
                'User.school',
                'User.username'
                // other fields you need
            ),'contain'=>array('Role')
        );

        $userData = $this->User->find('first', $options);
        //echo "<pre>"; print_r($userData); die;
        if (!empty($userData) && $this->Auth->login($userData)) {
            $this->Session->setFlash(__('Successfully logged In'));
            //$this->redirect($this->Auth->redirectUrl());
            //$this->redirect(array('controller'=>'users','action'=>'profile'));
              $this->redirect('/management');
        } else {
            $this->Session->setFlash(__('Email, and/or password are incorrect'));
        }
    }
}
 
public function signup($id=NULL) {
   $this->layout='home';
     if(!empty($id))
     {
      $id=base64_decode($id);
      $userdatass=$this->User->find('first',array('conditions'=>array('User.id'=>$id),'recursive'=>-1));
      //echo "<pre>"; print_r($userdatass); die;
      $this->set('userdatass',$userdatass);
     }
    if ($this->request->is('post')) {
      //echo "<pre>"; print_r($this->request->data);die;

           if ($this->data['User']['password'] === $this->data['User']['re_password'])
      {
        unset($this->request->data['User']['re_password']);
      $this->request->data['User']['password_dummy']=$this->request->data['User']['password'];
       $this->request->data['User']['password']=hash('ripemd160',trim($this->request->data['User']['password']));
        $userdata=$this->User->save($this->request->data);
    }else{
      $userdata=$this->User->save($this->request->data);
    }
     
      //echo "<pre>"; print_r($this->request->data);die;
        
        if($userdata)
        { if($this->request->data['User']['id']=='')
            {
               if($this->request->data['User']['userview']=='School')
               {
                $roledata['Role']['user_id']=$userdata['User']['id'];
                $roledata['Role']['role']=$this->request->data['User']['usertype'];
                $this->Role->save($roledata);
               }
               elseif ($this->request->data['User']['userview']=='Event') {
                $roledata['Role']['user_id']=$userdata['User']['id'];
                $roledata['Role']['role']='6';
                $this->Role->save($roledata);
               }
               elseif ($this->request->data['User']['userview']=='Healthcare') {
                $roledata['Role']['user_id']=$userdata['User']['id'];
                $roledata['Role']['role']='10';
                $this->Role->save($roledata);
               }
               else
               {
                $roledata['Role']['user_id']=$userdata['User']['id'];
                $roledata['Role']['role']='4';
                $this->Role->save($roledata);
               }
              $this->Session->setFlash(__('Successfully Registerd'));
              $userInfo=array();
              $userInfo['email']=$userdata['User']['email'];
              $userInfo['password']=$userdata['User']['password'];
              $this->login($userInfo);
             //$this->redirect(array('controller'=>'users','action'=>'profile'));
            }
            else
            {
           $this->Session->setFlash(__('Successfully updated your profile'));
           $this->redirect(array('controller'=>'users','action'=>'profile'));
            }
           
        }
    }
   //echo "hii"; die;
}
public function getquestion($email = NULL)
{
//echo  hash('ripemd160',uniqid()); die;
  $this->layout='';
  $this->autoRender=false;
  //echo $email; die;
  if(!empty($email))
  {
    
    $question=$this->User->find('first',array('conditions'=>array('User.email'=>$email),'fields'=>array('question','email'),'recursive'=>-1));
     if(!empty($question))
     {
      echo json_encode(array('Message'=>'1','Data'=>$question));die;
     }
     else
     {
      echo json_encode(array('Message'=>'0')); die;
     }
  }
  else
  {
      echo json_encode(array('Message'=>'0')); die;
  }
}
public function forgatpassword($email = NULL)
{
  
  $this->layout='';
  $this->autoRender=false;
 App::uses('CakeEmail', 'Network/Email');
     if(!empty($_POST['secqestion']) && !empty($_POST['newanswer']) && !empty($email))
     {
     //echo $secq.'#'.$seca.'#'.$email; die;
$count=$this->User->find('count',array('conditions'=>array('User.question'=>trim($_POST['secqestion']),'User.answer'=>trim($_POST['newanswer']),'User.email'=>trim($email))));
       if($count==1)
       {
         
          $passstring=$this->gen_uuid();
          $forsent='Code:- '.$passstring.'  '.'Please use this code for reset to your password!';
          $this->User->id = $this->User->field('id', array('email' => $email));
          if ($this->User->id) {
                   $this->User->saveField('code',$passstring);
             }
         
          $Email = new CakeEmail();
        $emailda=$Email->from(array('noreply@abdevs.com' => 'Attendance App'))->to(trim($email))->subject('Uniq Code For reset to password')->send($forsent);
   
          echo json_encode(array('Message'=>'1','Data'=>$emailda)); die;
       }
       else
        {
      echo json_encode(array('Message'=>'0')); die;
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
  $this->layout='';
  $this->autoRender=false;
  if(!empty($_POST['uncode']) && !empty($_POST['newpass']))
  {
    $count=$this->User->find('count',array('conditions'=>array('User.code'=>trim($_POST['uncode']))));
     if($count=='1')
     {
       $passstring=$_POST['newpass'];
     $pass=hash('ripemd160',$passstring);
     $this->User->id = $this->User->field('id', array('code' => $_POST['uncode']));
   if ($this->User->id) {
                   if($this->User->save(array('User'=>array('password'=>$pass,'password_dummy'=>$passstring))))
                   {
                    echo json_encode(array('Message'=>'1')); die;
                   }
                   else
                   {
                    echo json_encode(array('Message'=>'0')); die;
                   }
             }
     }
     else
     {
      echo json_encode(array('Message'=>'0')); die;
     }
    
  }
}
public function profile() {
   $this->layout='home';
   //echo "hii"; die;
   $authdata=$this->Session->read('Auth.User.User.id');
  $parentData=$this->User->findById($authdata); 
  $this->set('parentData',$parentData); 
  //echo "<pre>"; print_r($parentData); die;
}
public function uploadProfile($id=NULL) {
        $this->layout = 'ajax';
        $this->autoRender=false;
        $errors=array();
      
        $file_name = $_FILES['image']['name'];
        $file_size =$_FILES['image']['size'];
        $file_tmp =$_FILES['image']['tmp_name'];
        $file_type=$_FILES['image']['type'];  
            if($file_size > 2097152){
          $errors[]='File size must be less than 2 MB';
            }
            if(empty($errors)==true){
               $namechange=time().$file_name;
               $data=WWW_ROOT.'bss_files/'.$namechange;
               $url="http://abdevs.com/attendance/bss_files/".$namechange;
                if(move_uploaded_file($file_tmp,$data))
                {
                   $datauser=$this->User->find('first',array('conditions'=>array('User.id'=>$id),'fields'=>array('id','profile_pic'),'recursive'=>-1));
                       if(!empty($datauser['User']['profile_pic']))
                       {
                       unlink(WWW_ROOT."/bss_files/".$datauser['User']['profile_pic']);
                       }
                     $this->User->id =$id;
       if ($this->User->id) {
                   if($this->User->save(array('User'=>array('profile_pic'=>$namechange))))
                   {
                    echo json_encode(array('Message'=>'1','url'=>$url)); die;
                   }
                   else
                   {
                    echo json_encode(array('Message'=>'0')); die;
                   }
                  }
                 }
               }else{
                    echo json_encode(array('Message'=>$errors)); die;
            }




        
           
            
    }
public function logout() {
    return $this->redirect($this->Auth->logout());
}

  public function contactUs()
  {
    $this->layout="home";
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
public function addRole($role=NULL)
{     
       $authdata=$this->Session->read('Auth.User.User.id');
       $this->layout = 'ajax';
        $this->autoRender=false;
        $data['Role']['user_id']=$authdata;
        $data['Role']['role']=$role;
      if($this->Role->save($data))
      {
        $this->User->Behaviors->load('Containable');
        $options = array(
            'conditions' => array(
                'User.id' => $authdata
              ),
            'fields' => array(
                'User.id',
                'User.email',
                'User.school',
                'User.username'
                // other fields you need
            ),'contain'=>array('Role')
        );
        $userData = $this->User->find('first', $options);
        //echo "<pre>"; print_r($userData); die;
        $this->Session->write('Auth.User', $userData);
         echo json_encode(array('Message'=>'1')); die;
        
      }  
      else
      {
        echo json_encode(array('Message'=>'0')); die;
      }
}
public function deleteRole($id=NULL)
{
  if($this->Role->delete($id))
  {       
          $authdata=$this->Session->read('Auth.User.User.id');  
           $this->User->Behaviors->load('Containable');
           $options = array(
            'conditions' => array(
                'User.id' => $authdata
              ),
            'fields' => array(
                'User.id',
                'User.email',
                'User.school',
                'User.username'
                // other fields you need
            ),'contain'=>array('Role')
        );
        $userData = $this->User->find('first', $options);
        $this->Session->write('Auth.User', $userData);
        $this->Session->setFlash(__('Successfully deleted Role'));
        $this->redirect(array('controller'=>'users','action'=>'profile'));

  }
}
}
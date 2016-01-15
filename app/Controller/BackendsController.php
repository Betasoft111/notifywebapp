<?php
	ob_start();
	class BackendsController extends AppController{

	public $helpers = array('Session','Html','Js','Form','SubString');
	public $components = array('Session','Email','RequestHandler','Cookie');

	function beforefilter(){
		 parent::beforeFilter();
           $this->Auth->allow('admin_login','admin_logout','admin_edit_user','admin_view_user','admin_delete_user','admin_uemail_check','admin_add_member','admin_uname_check','admin_change_password','admin_dashboard','admin_manageMenber','admin_forgot_password');
		if($this->Session->read('Admin.uname') && ($this->request->action == 'admin_login'))
		{ 

			$this->redirect(array('controller'=>'backends','action'=>'dashboard','admin'=>true));
		}
	}

	public function admin_login(){
		$this->layout="admin";
		$this->loadModel('Admin');
        $formData = $this->data;
        if(isset($formData) && !empty($formData)){
            $userName = $formData['username'];
            $password = $formData['password'];
			$adminData = $this->Admin->find('all');
			if(($adminData[0]['Admin']['username'] == $userName) && ($adminData[0]['Admin']['password'] == $password)){
				$this->Session->write('Admin.uname',$adminData[0]['Admin']['username']);
				$this->Session->write('Admin.email',$adminData[0]['Admin']['email']);
				$this->Session->write('Admin.fname',$adminData[0]['Admin']['fname']);
				$this->Session->write('Admin.id',$adminData[0]['Admin']['id']);
				$this->redirect(array('controller'=>'backends','action'=>'dashboard','admin'=>true));
			}
			else{
				$this->Session->setFlash('Authentication Failed!','error');
				$this->redirect(array('controller'=>'backends','action'=>'login','admin'=>true));
			}
        }
    }
    public function admin_logout() 
	{
		$this->layout="admin";
		$this->Session->delete('Admin');
		$this->redirect(array('controller'=>'backends','action'=>'login','admin'=>true));
	}
	function admin_dashboard()
	{	
		$this->layout="admin";	
		if(!$this->Session->read('Admin'))
		{
		 $this->redirect(array('controller'=>'backends','action'=>'login','admin'=>true));
		}
	}
	function admin_manageMenber(){
		$this->layout="admin";
		$this->loadModel('User');
	 	$result = $this->User->find('all');

        $this->paginate = array(
        	'limit' => 30,
       		 'order' => array('id' => 'desc')
    	);
   		$result = $this->paginate('User');
   		/*echo "<pre>";
   		print_r($result);
   		echo "</pre>";
   		exit;*/
		$this->set(compact('result'));
		if($this->RequestHandler->isAjax())
		{		
			$this->layout = '';
			$this->autoRender = false;			
			$this->render('admin_manageMenber');
		}
	}
	function admin_forgot_password(){
		$this->layout="admin";
		$this->loadModel('Admin');
		$userName = $this->data;
		$adminData = $this->Admin->find('all',array('conditions'=>array('Admin.username'=>$userName),'fields'=>array('email','username','password')));
		if(!empty($adminData)){
			//$email = $adminData[0]['Admin']['email'];
			$email = "jitendra_kumar@rvtechnologies.info";
			$name = $adminData[0]['Admin']['username'];
			$password = $adminData[0]['Admin']['password'];
			
			/*$Email = new CakeEmail();
			$Email->from(array('admin@gmail.com' => 'Attendance System'))
    			->to($email)
    			->subject('Your Password')
    			->send('Hello '. $name .'Your Password is '.$password);*/

    			$headers = 'From: admin@gmail.com' . "\r\n";
                $headers .= 'Cc: aa@example.com' . "\r\n";
    			$to = $email;
    			//$from = "admin@gmail.com";
    			$subject = "Password";
    			$message = 'Hello '. $name .'Your Password is '.$password;
    			mail($to,$subject,$message,$headers);
    		$this->Session->setFlash('password has been sent to your email' .$password,'success');
    		$this->redirect(array('controller'=>'backends','action'=>'login', 'admin' =>'true'));
		}
		else{
			$this->Session->setFlash('Username does not exist...!!','error');
		}
		$this->redirect('/admin/backends/login#recover');
	}
	function admin_change_password($id=NULL){
		$this->layout="admin";
		$this->loadModel('Admin');
		$formData = $this->data;
		$adminData = $this->Admin->find('all',array('conditions'=>array('Admin.id'=>$id), 'fields'=>array('id','password')));
		if(isset($this->data) && !empty($this->data)){
			$formData = $this->data;
			if(($formData['Admin']['old']) == ($adminData[0]['Admin']['password'])){
				$adminData[0]['Admin']['password'] = $formData['Admin']['new'];
				//$this->Admin->save($adminData);
				$this->Admin->updateAll(array('Admin.password' =>$adminData[0]['Admin']['password']), 
                      array('Admin.id' => $formData['Admin']['id']));
				$this->Session->setFlash('Password has been changed successfully.','success');
				$this->redirect($this->referer());
			}
			else{
				$this->Session->setFlash('Please enter the correct password.','error');
				$this->redirect($this->referer());
			}
		}
	}
	function admin_add_member(){
		$this->layout="admin";
		$this->loadModel('User');
		$formData = $this->data;
        
       
        if($this->request->is('post') && !empty($formData) && isset($formData)){
        	$formData['User']['created'] = date('Y-m-d');
        	$formData['User']['password'] = md5($formData['User']['password']);
        	$formData['User']['status'] = 1;	
        	if($this->User->save($formData)){
        		$this->Session->setFlash('Member added successfully', 'default', array(), 'success');;
        		$this->redirect(array('controller'=>'backends','action'=>'manageMenber','admin'=>true));
        	}
        }
	}
	function admin_uname_check(){
		$this->layout="";
		$this->loadModel('User');
		$userName = $_POST['uname'];
		$useData = $this->User->find('all',array('conditions'=>array('User.username'=>$userName)));
	    if(!empty($useData)){
	    	echo 'true';
	    }
	    else{
	    	echo 'false';
	    }
	    die;
	}
	function admin_uemail_check(){
		$this->layout="";
		$this->loadModel('User');
		$userEmail = $_POST['uemail'];
		$userData = $this->User->find('all',array('conditions'=>array('User.email'=>$userEmail)));
		if(!empty($userData)){
			echo "true";
		}
		else{
			echo "false";
		}
		die;
	}
	function admin_delete_user(){
		$this->layout="";
		$this->loadModel('User');
		$userId = $_POST['uid'];
		if($this->User->delete($userId)){
			echo "Member has been deleted successfully";
		}
		else{
			echo "false";
		}
		die;
	}
	function admin_view_user($uid=NULL){
		$this->layout="admin";
		$this->loadModel('User');
		$userData = $this->User->find('first',array('conditions'=>array('User.id'=>$uid)));
		$this->set(compact('userData'));
	}
	function admin_edit_user($uid=NULL){
		$this->layout="admin";
		$this->loadModel('User');
		$formData = $this->data;
        $user_result = $this->User->find('first',array('conditions'=>array('User.id'=>$uid),'recursive'=>-1));
        /*echo "<pre>";
        print_r($user_result);
        echo "</pre>";
        die;*/
        $this->set(compact('user_result'));

	}
}

?>
<?php
App::uses('AppController', 'Controller');
/**
 * Managers Controller
 *
 * @property Manager $Manager
 * @property PaginatorComponent $Paginator
 */
class ManagersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	 public $components = array('Paginator', 'Session','Auth','Gcm');
    public $helpers=array('Paginator');
   public $uses=array('Company');
/**
 * index method
 *
 * @return void
 */
	
	public function company() 
  {
    $this->layout = 'home';
    
  }
  public function addcompany($id=NULL) 
  {
    $this->layout = 'home';
    if(!empty($id))
    {
    $companydata=$this->Company->find('first',array('conditions'=>array('Company.id'=>$id)));
    //echo "<pre>"; print_r($companydata); die;
    $this->set('companydata',$companydata);

    }
    if ($this->request->is('post')) {
      //echo "<pre>"; print_r($this->request->data); die;
       $this->request->data['Company']['user_id']=$this->Session->read('Auth.User.User.id'); 
       $this->request->data['Company']['companyCode']=$uncode=$this->gen_uuid();
       $savdata=$this->Company->save($this->request->data);
        if(!empty($savdata))
        {
           if($savdata['Company']['repeatType']=='WEEKLY')
           {
                $this->loadModel('RepeatCompany');
                $this->RepeatCompany->deleteAll(array('RepeatCompany.company_id'=>$savdata['Company']['id']));
                $setdata['RepeatCompany']['company_id']=$savdata['Company']['id'];
                $setdata['RepeatCompany']['repeat_on']=trim($this->request->data['repeadDay']);
                if($this->RepeatCompany->save($setdata))
                {
                $this->Session->setFlash(__('Successfully added'));
                $this->redirect(array('controller'=>'managers','action'=>'companylist'));
                 }
           }
           else
           {
               $this->Session->setFlash(__('Successfully added'));
                $this->redirect(array('controller'=>'managers','action'=>'companylist'));
           }
           
          
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
       if($this->Company->deleteAll(array('Company.id'=>$idde)))
           {
            $y++;
           }
        if($y > 0)
        {
           
            $this->Session->setFlash(__('Successfully deleted Company'));
            $this->redirect(array('controller'=>'managers','action'=>'companylist'));
        }
    }
    else
    {
        $this->Session->setFlash(__('Please select any one first'));
       $this->redirect(array('controller'=>'managers','action'=>'companylist')); 
    }
}
  public function companylist() 
  {
    $this->layout = 'home';
    $user_id=$this->Session->read('Auth.User.User.id'); 
    $this->paginate = array(
        'conditions' => array('Company.user_id' => $user_id),
        'limit' => 10,
        'order' => array('id' => 'desc')
    );
    $companydata = $this->paginate('Company');
    $this->set('companydata',$companydata);
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

}

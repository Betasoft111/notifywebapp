<?php App::uses('AppController', 'Controller');
/** * Users Controller * *
 *  @property User $User *
 *  @property PaginatorComponent $Paginator *
 *  @property SessionComponent $Session */
class TestsController extends AppController {
    /** * Components * * @var array */ 
    /** * index method * * @return void */ 
    public $components = array('Paginator', 'Session','Auth');  
    public function beforeFilter() {
        parent::beforeFilter();  
    $this->Auth->Allow(array('test','index','ios','main','ios_godhelp'));  
    }     
    public function index() {
        $indexInfo['description'] = "App user Registration(post method)(2-d array) ";
        $indexInfo['url'] = FULL_BASE_URL.$this->webroot."Users/app_userregistration";	
        $indexInfo['parameters'] = '<b>data[User][username]</b>-  username<br>'	
                .'<b>data[User][email]</b>-User email<br>'
                . '<b>data[User][password]</b>- password<br>'
                . '<b>data[User][school]</b><br>'
                . '<b>data[User][userview]</b><br>'
                . '<b>data[User][question]</b><br>	'
                . '<b>data[User][answer]</b><br>'
                . '<b>data[User][code]</b><br> 	'
                . '<b>data[User][role]</b>--- student/teacher/parent/eventhost/attendee/manager/employee<br> 	'
                . '<b>data[User][device_token]</b>- device token<br>'
                . '<b>======For Teacher======== </b>- (optional)<br>'
                . '<b>data[Teacher][classname]</b>- class name<br>'
                . '<b>data[Teacher][starttime]</b>- start time<br>'
                . '<b>data[Teacher][endtime]</b>- device token<br>'
                . '<b>data[Teacher][fromdate]</b>- end time<br>'
                . '<b>data[Teacher][enddate]</b>- end date<br>'
                . '<b>data[Teacher][days]</b>- days<br>'
                . '<b>data[Teacher][classcode]</b>- class code<br>'
                . '<b>data[Teacher][district]</b>- district<br>'
                . '<b>data[Teacher][latitude]</b>- latitude<br>'
                . '<b>data[Teacher][logitude]</b>- logitude<br>'
                . '<b>======== For Student===========</b>- (Optional)<br>'
                . '<b>data[Student][classname]</b>- classname<br>'
                . '<b>data[Student][teachercode]</b>- teachercode<br>'
                . '<b>data[Student][classcode]</b>- class code<br>'
                . '<b>======== For Parent===========</b>- (Optional)<br>'
                . '<b>data[Parrent][childname]</b>- childname<br>'
                . '<b>data[Parrent][teachercode]</b>- teachercode<br>'
                . '<b>data[Parrent][classcode]</b>- class code<br>'
                . '<b>===========Event Host=============</b>- (optional)<br>'
                .'<b>data[Eventhost][eventname] - </b>eventname<br>'
                .'<b>data[Eventhost][starttime] - </b>starttime<br>'
                .'<b>data[Eventhost][endtime] - </b>endtime<br>'
                .'<b>data[Eventhost][fromdate] - </b>fromdate<br>'
                .'<b>data[Eventhost][enddate] - </b>enddate<br>'
                .'<b>data[Eventhost][days] - </b>days<br>'
                .'<b>data[Eventhost][district] - </b>district<br>'
                .'<b>data[Eventhost][eventcode] - </b>eventcode<br>'
                .'<b>data[Eventhost][companyname] - </b>companyname<br>'
                .'<b>data[Eventhost][latitude] - </b>latitude<br>'
                .'<b>data[Eventhost][logitude] - </b>logitude<br>'
                . '<b>===========attendee=============</b>- (optional)<br>'
                .'<b>data[Attendee][eventname] - </b>eventname<br>'
                .'<b>data[Attendee][eventcode] - </b>eventcode<br>'
                .'<b>data[Attendee][eventhostcode] - </b>eventhostcode<br>'
                . '<b>===========Manager=============</b>- (optional)<br>'
                .'<b>data[Manager][location] - </b>eventname<br>'
                .'<b>data[Manager][starttime] - </b>starttime<br>'
                .'<b>data[Manager][endtime] - </b>endtime<br>'
                .'<b>data[Manager][fromdate] - </b>fromdate<br>'
                .'<b>data[Manager][enddate] - </b>enddate<br>'
                .'<b>data[Manager][days] - </b>days<br>'
                .'<b>data[Manager][district] - </b>district<br>'
                .'<b>data[Manager][locationcode] - </b>locationcode<br>'
                .'<b>data[Manager][companyname] - </b>companyname<br>'
                .'<b>data[Manager][latitude] - </b>latitude<br>'
                .'<b>data[Manager][logitude] - </b>logitude<br>'
                . '<b>===========Employee=============</b>- (optional)<br>'
                .'<b>data[Employee][locationname] - </b>locationname<br>'
                .'<b>data[Employee][locationcode] - </b>locationcode<br>'
                .'<b>data[Employee][managercode] - </b>managercode<br>';
        $indexarr[] = $indexInfo;	
        $indexInfo['description'] = "App user login(2-d array) ";
        $indexInfo['url'] = FULL_BASE_URL.$this->webroot."Users/app_userlogin";
        $indexInfo['parameters'] ='<b>data[User][username] - </b>email<br>'
                . '<b>data[User][password]</b>- password<br>';
        $indexarr[] = $indexInfo;
        $indexInfo['description'] = "App Forgot password(2-d array) ";	
        $indexInfo['url'] = FULL_BASE_URL.$this->webroot."Users/app_userforgotpwd"; 
        $indexInfo['parameters'] =
                '<b>data[User][email] - </b>email<br>';
        $indexarr[] = $indexInfo;
        $indexInfo['description'] = "App Forgot password(2-d array) ";
        $indexInfo['url'] = FULL_BASE_URL.$this->webroot."Users/app_userreset";
        $indexInfo['parameters'] =
                '<b>data[User][email] - </b>email<br>';
        $indexarr[] = $indexInfo;
        $indexInfo['description'] = "App List student code by teacher code(2-d array) ";
        $indexInfo['url'] = FULL_BASE_URL.$this->webroot."Users/list_studentby_Teachercode/(teachercode)";
        $indexInfo['parameters'] ='';	           
        $indexarr[] = $indexInfo;				
        $indexInfo['description'] = "App List classes by teacher id(2-d array) ";
        $indexInfo['url'] = FULL_BASE_URL.$this->webroot."Users/allclass_byteacher/(userid)";
        $indexInfo['parameters'] ='';	          
        $indexarr[] = $indexInfo;		
        $indexInfo['description'] = "App List classes joined by student id(2-d array) ";
        $indexInfo['url'] = FULL_BASE_URL.$this->webroot."Users/app_allclass_bystudent/(userid)"; 
        $indexInfo['parameters'] ='';	              
        $indexarr[] = $indexInfo;				
        $indexInfo['description'] = "App List student by parent id(2-d array) ";
        $indexInfo['url'] = FULL_BASE_URL.$this->webroot."Users/app_allclass_byparent/(userid)";   
        $indexInfo['parameters'] ='';	       
        $indexarr[] = $indexInfo;		
        $indexInfo['description'] = "App Invitation Student or parent(2-d array) ";
        $indexInfo['url'] = FULL_BASE_URL.$this->webroot."Users/app_invitation/";     
        $indexInfo['parameters'] ='<b>data[classcode] - </b>classcode<br><b>data[email] - </b>email->pranabesh@avaindotech.com,sarbu@avainfotech.com,saman@avainfotech.com<br>';
        $indexarr[] = $indexInfo;	
        $indexInfo['description'] = "App Edit Profile(2-d array) ";	
        $indexInfo['url'] = FULL_BASE_URL.$this->webroot."Users/app_editprofile/(userid)";  
        $indexInfo['parameters'] ='';	     
        $indexarr[] = $indexInfo;	
        $indexInfo['description'] = "App add class by  teacher(2-d array) ";
        $indexInfo['url'] = FULL_BASE_URL.$this->webroot."Users/app_addTeacher_class";     
        $indexInfo['parameters'] =
                '<b>data[Teacher][userid] - </b>userid<br>'
                .'<b>data[Teacher][classname] - </b>classname<br>'
                .'<b>data[Teacher][starttime] - </b>starttime<br>'
                .'<b>data[Teacher][endtime] - </b>endtime<br>'
                .'<b>data[Teacher][fromdate] - </b>fromdate<br>'
                .'<b>data[Teacher][enddate] - </b>enddate<br>'
                .'<b>data[Teacher][days] - </b>days<br>'
                .'<b>data[Teacher][district] - </b>district<br>'
                .'<b>data[Teacher][code] - </b>code<br>'
                .'<b>data[Teacher][classcode] - </b>classcode<br>'
                .'<b>data[Teacher][latitude] - </b>latitude<br>'
                .'<b>data[Teacher][logitude] - </b>logitude<br>';
        $indexarr[] = $indexInfo;				
        $indexInfo['description'] = "App add class by  Parent(2-d array) ";	
        $indexInfo['url'] = FULL_BASE_URL.$this->webroot."Users/add_addParrent"; 
        $indexInfo['parameters'] =
                '<b>data[Parrent][userid] - </b>userid<br>'
                .'<b>data[Parrent][childname] - </b>childname<br>'
                .'<b>data[Parrent][teachercode] - </b>teachercode<br>'
                .'<b>data[Parrent][classcode] - </b>classcode<br>';
        $indexarr[] = $indexInfo;					
        $indexInfo['description'] = "App add class by  Student(2-d array) ";
        $indexInfo['url'] = FULL_BASE_URL.$this->webroot."Users/add_addStudent";  
        $indexInfo['parameters'] =
                '<b>data[Student][userid] - </b>userid<br>'
                .'<b>data[Student][classname] - </b>classname<br>'
                .'<b>data[Student][teachercode] - </b>teachercode<br>'
                .'<b>data[Student][classcode] - </b>classcode<br>';
        $indexarr[] = $indexInfo;					
        $indexInfo['description'] = "App add Event(2-d array) ";	
        $indexInfo['url'] = FULL_BASE_URL.$this->webroot."Users/add_eventhost";   
        $indexInfo['parameters'] =
                '<b>data[Eventhost][userid] - </b>userid<br>'
                .'<b>data[Eventhost][eventname] - </b>eventname<br>'
                .'<b>data[Eventhost][starttime] - </b>starttime<br>'
                .'<b>data[Eventhost][endtime] - </b>endtime<br>'
                .'<b>data[Eventhost][fromdate] - </b>fromdate<br>'
                .'<b>data[Eventhost][enddate] - </b>enddate<br>'
                .'<b>data[Eventhost][days] - </b>days<br>'
                .'<b>data[Eventhost][district] - </b>district<br>'
                .'<b>data[Eventhost][eventcode] - </b>code<br>'
                .'<b>data[Eventhost][eventhostcode] - </b>eventhostcode<br>'
                .'<b>data[Eventhost][companyname] - </b>companyname<br>'
                .'<b>data[Eventhost][latitude] - </b>latitude<br>'
                .'<b>data[Eventhost][logitude] - </b>logitude<br>';
        $indexarr[] = $indexInfo;				
        $indexInfo['description'] = "App all Event by id(2-d array) ";	
        $indexInfo['url'] = FULL_BASE_URL.$this->webroot."Users/add_show_eventhostbyid/(userid)";  
        $indexInfo['parameters'] ='';	             
        $indexarr[] = $indexInfo;		
        $indexInfo['description'] = "App add attendee(2-d array) ";	       
        $indexInfo['url'] = FULL_BASE_URL.$this->webroot."Users/add_attendee";  
        $indexInfo['parameters'] =
                '<b>data[Attendee][userid] - </b>userid<br>'
                .'<b>data[Attendee][eventname] - </b>eventname<br>'
                .'<b>data[Attendee][eventhostcode] - </b>eventhostcode<br>'
                .'<b>data[Attendee][eventcode] - </b>eventcode<br>';	   
        $indexarr[] = $indexInfo;					
        $indexInfo['description'] = "App all Attendee by id(2-d array) ";
        $indexInfo['url'] = FULL_BASE_URL.$this->webroot."Users/add_list_attendeebyid/(userid)";  
        $indexInfo['parameters'] ='';	           
        $indexarr[] = $indexInfo;		
        $indexInfo['description'] = "App Invitation Attendee by Event host(2-d array) ";
        $indexInfo['url'] = FULL_BASE_URL.$this->webroot."Users/app_invitation_attendee";   
        $indexInfo['parameters'] ='<b>data[locationcode] - </b>locationcode<br>'
                .'<b>data[email] - </b>email->pranabesh@avaindotech.com,sarbu@avainfotech.com,saman@avainfotech.com<br>';
        $indexarr[] = $indexInfo;					
        $indexInfo['description'] = "App add Manager(2-d array) ";	  
        $indexInfo['url'] = FULL_BASE_URL.$this->webroot."Users/add_manager";  
        $indexInfo['parameters'] =
                '<b>data[Manager][userid] - </b>userid<br>'
                .'<b>data[Manager][location] - </b>eventname<br>'
                .'<b>data[Manager][starttime] - </b>starttime<br>'
                .'<b>data[Manager][endtime] - </b>endtime<br>'
                .'<b>data[Manager][fromdate] - </b>fromdate<br>'
                .'<b>data[Manager][enddate] - </b>enddate<br>'
                .'<b>data[Manager][days] - </b>days<br>'
                .'<b>data[Manager][district] - </b>district<br>'
                .'<b>data[Manager][managercode] - </b>managercode<br>'
                .'<b>data[Manager][locationcode] - </b>locationcode<br>'
                .'<b>data[Manager][companyname] - </b>companyname<br>'
                .'<b>data[Manager][latitude] - </b>latitude<br>'
                .'<b>data[Manager][logitude] - </b>logitude<br>';
        $indexarr[] = $indexInfo;				
        $indexInfo['description'] = "App all Manager by id(2-d array) ";
        $indexInfo['url'] = FULL_BASE_URL.$this->webroot."Users/add_list_managerbyid/(userid)"; 
        $indexInfo['parameters'] ='';	               
        $indexarr[] = $indexInfo;			
        $indexInfo['description'] = "App add employee(2-d array) ";
        $indexInfo['url'] = FULL_BASE_URL.$this->webroot."Users/add_employee";
        $indexInfo['parameters'] =
                '<b>data[Employee][userid] - </b>userid<br>'
                .'<b>data[Employee][locationname] - </b>locationname<br>'
                .'<b>data[Employee][locationcode] - </b>locationcode<br>'
                .'<b>data[Employee][managercode] - </b>managercode<br>';
        $indexarr[] = $indexInfo;
        $indexInfo['description'] = "App all Employee by id(2-d array) ";
        $indexInfo['url'] = FULL_BASE_URL.$this->webroot."Users/add_list_employeeebyid/(userid)";
        $indexInfo['parameters'] ='';	          
        $indexarr[] = $indexInfo;		
        $indexInfo['description'] = "App Invitation Employee by Manager(2-d array) ";
        $indexInfo['url'] = FULL_BASE_URL.$this->webroot."Users/app_invitation_employee";  
        $indexInfo['parameters'] ='<b>data[locationcode] - </b>locationcode<br>'
                . '<b>data[email] - </b>email->pranabesh@avaindotech.com,sarbu@avainfotech.com,saman@avainfotech.com<br>';
        $indexarr[] = $indexInfo;
        
        $indexInfo['description'] = "App Event search by eventcode(2-d array) ";
        $indexInfo['url'] = FULL_BASE_URL.$this->webroot."Users/app_searchevent/(eventcode)";  
        $indexInfo['parameters'] ='';	     
        $indexarr[] = $indexInfo;  
        
        $indexInfo['description'] = "App Event search by location code(2-d array) ";
        $indexInfo['url'] = FULL_BASE_URL.$this->webroot."Users/app_searchemployee/(locationcode)";  
        $indexInfo['parameters'] ='';	     
        $indexarr[] = $indexInfo;
        
        
        /* $indexInfo['description'] = "Add Teacher information "; 
          $indexInfo['url'] = FULL_BASE_URL.$this->webroot."/Users/app_add/userid";	
          $indexInfo['parameters'] = 	
                  '<b>data[Teacher][classname] - </b>Username<br>'
                  . '<b>data[Teacher][starttime]</b>- password<br>'
                  . '<b>data[Teacher][endtime]</b>-User email<br> '
                  . '<b>data[Teacher][fromdate]</b><br>'
                  . '<b>data[Teacher][enddate]</b><br>'
                  . '<b>data[Teacher][days]</b><br>	'
                  . '<b>data[Teacher][district]</b><br>'
                  . '<b>data[Teacher][code]</b><br> 	'
                  . '<b>data[Teacher][latitude]</b><br> 	'
                  . '<b>data[Teacher][logitude]</b><br> 	';
          $indexarr[] = $indexInfo;	*/
          $this->set('IndexDetail',$indexarr);}	
          }
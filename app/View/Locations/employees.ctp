<div class="top-cont">
  <div class="top-left"><a href="<?php echo HTTP_ROOT;?>"><img src="<?php echo HTTP_ROOT;?>images/notify-img.png" alt=""></a></div>
  <div class="top-right"><a href="<?php echo HTTP_ROOT."users/profile"; ?>"><img style="width:25px;height:25px;border-radius:10px;" id="profilepic" src="<?php if($parentData['User']['profile_pic']!=''){echo HTTP_ROOT.'bss_files/'.$parentData['User']['profile_pic'];}else{ echo HTTP_ROOT.'img/images/Profile-pic.png'; }?>"> <?php echo $parentData['User']['first_name']!=''?@$parentData['User']['first_name']:'--------------';  ?> <?php echo $parentData['User']['last_name']!=''?@$parentData['User']['last_name']:'---------------';  ?></a></div>
  <h2>Management</h2>
</div>

<div class="bread-crumb">
    <ul>
        <li><a href="<?php echo HTTP_ROOT;?>management">Home</a></li>
        <li><img src="<?php echo HTTP_ROOT;?>images/arrow.png" alt=""></li>
        <li><a href="<?php echo HTTP_ROOT;?>management" class="active">Healthcare</a></li>
        <li><img src="<?php echo HTTP_ROOT;?>images/arrow.png" alt=""></li>
        <li><a href="<?php echo HTTP_ROOT;?>locations/view/<?php echo $id; ?>" class="active">Location</a></li>
        <li><img src="<?php echo HTTP_ROOT;?>images/arrow.png" alt=""></li>
        <li><a href="javascript:void(0)" class="active">Employee List</a></li>
    </ul>
</div>  
<div class="mid-management-cont">
  <div class="wrapper">
      <h2>Employee list for the location ?</h2>
      <p>As a successfully logged in user, You are allowed to access the options below. Please select the right one regarding to your requirements and click to run it.</p>
      <div class="options-cont">

      <a href="<?php echo HTTP_ROOT; ?>locations/addemployee/<?php echo $id; ?>">
        <div class="options-cont1">
           <span>
              		<div class="add-employee-cont">                	
               	   </div>
                </span>
            <h3>Add New</h3>
            <p>Add new employee for the location</p>
        </div>
      </a>

      	<?php foreach($employees as $key => $employee) { ?>
          <a href="<?php echo HTTP_ROOT; ?>locations/employeesview/<?php echo $id; ?>/<?php echo $employees[$key]['Employee']['id']; ?>">

            <div class="options-cont1">
                 <span>
              		<div class="employee-loc-cont">                	
               	   </div>
                </span>
                <h3><?php echo $employees[$key]['Employee']['employee_name']; ?></h3>
                <p><?php echo $employees[$key]['Employee']['employee_email']; ?></p>
            </div>
          </a>
          <?php } ?>
      </div>
  </div>
</div>  
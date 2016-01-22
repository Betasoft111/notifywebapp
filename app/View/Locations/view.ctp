<div class="top-cont">
  <div class="top-left"><a href="<?php echo HTTP_ROOT;?>"><img src="<?php echo HTTP_ROOT;?>images/notify-img.png" alt=""></a></div>
  <div class="top-right"><a href="<?php echo HTTP_ROOT."users/profile"; ?>"><img style="width:25px;height:25px;border-radius:10px;" id="profilepic" src="<?php if($parentData['User']['profile_pic']!=''){echo HTTP_ROOT.'bss_files/'.$parentData['User']['profile_pic'];}else{ echo HTTP_ROOT.'img/images/Profile-pic.png'; }?>"> <?php echo $parentData['User']['first_name']!=''?@$parentData['User']['first_name']:'--------------';  ?> <?php echo $parentData['User']['last_name']!=''?@$parentData['User']['last_name']:'---------------';  ?></a></div>
  <h2>Healthcare</h2>
</div>

<div class="bread-crumb">
    <ul>
        <li><a href="<?php echo HTTP_ROOT; ?>management">Home</a></li>
        <li><img src="<?php echo HTTP_ROOT; ?>images/arrow.png" alt=""></li>
        <li><a href="<?php echo HTTP_ROOT; ?>management" class="active">Healthcare</a></li>
        <li><img src="<?php echo HTTP_ROOT; ?>images/arrow.png" alt=""></li>
        <li><a href="<?php echo HTTP_ROOT; ?>management" class="active">Locations</a></li>
        <li><img src="<?php echo HTTP_ROOT; ?>images/arrow.png" alt=""></li>
        <li><a href="<?php echo HTTP_ROOT; ?>locations/locationslist" class="active">List</a></li>
        <li><img src="<?php echo HTTP_ROOT; ?>images/arrow.png" alt=""></li>
        <li><a href="javascript:void(0)" class="active">Manage Location</a></li>
    </ul>
</div>  
<div class="mid-management-cont">
  <div class="wrapper">
      <h2>Manager Your Location</h2>
      <!-- <p>As a successfully logged in user, You are allowed to access the options below. Please select the right one regarding to your requirements and click to run it.</p> -->
      <div class="options-cont">
          
          <a href="<?php echo HTTP_ROOT; ?>locations/edit/<?php echo $id; ?>">
            <div class="options-cont1">
                 <span>
                <div class="edit-loc-cont">                 
                </div>
                </span>
                <h3>Edit</h3>
                <p>Update the details about the location.</p>
            </div>
          </a>

          <a href="<?php echo HTTP_ROOT; ?>locations/view/<?php echo $id; ?>">
             <div class="options-cont1">
                <span>
                <div class="manager-cont">                  
                </div>
                </span>
                <h3>Add Manager</h3>
                <p>Add Manager to the location.</p>
            </div>
          </a>  


          <a href="<?php echo HTTP_ROOT; ?>locations/employees/<?php echo $id; ?>">
            <div class="options-cont1">
                 <span>
                <div class="employee-cont">                 
                </div>
                </span>
                <h3>Employees</h3>
                <p>Manage the employees for the location.</p>
            </div>
          </a>


          <a href="<?php echo HTTP_ROOT; ?>locations/view/<?php echo $id; ?>">
            <div class="options-cont1">
                <span>
                <div class="notification-cont">                 
                </div>
                </span>
                <h3>Notifications</h3>
                <p>Check the notifications about the location.</p>
            </div>
          </a>  

          <a href="<?php echo HTTP_ROOT; ?>locations/view/<?php echo $id; ?>">
            <div class="options-cont1">
                <span>
                <div class="reports-cont">                  
                </div>
                </span>
                <h3>Reports</h3>
                <p>See your reports.</p>
            </div>
          </a>

          <a href="<?php echo HTTP_ROOT; ?>locations/meetings/<?php echo $id; ?>">
            <div class="options-cont1">
                <span>
                  <div class="scheduling-cont">                 
                   </div>
                </span>
                <h3>Scheduling</h3>
                <p>Schedule the meetings for the location.</p>
            </div>
          </a>

          <a href="<?php echo HTTP_ROOT; ?>locations/checklists/<?php echo $id; ?>">
            <div class="options-cont1">
               <span>
                  <div class="checklist1-cont">                 
                   </div>
                </span>
                <h3>Checklist</h3>
                <p>Manage the checklist for the location.</p>
            </div>
          </a>

         <!--  <a href="<?php echo HTTP_ROOT; ?>locations/view/">
            <div class="options-cont1">
                <span>
                    <img src="<?php echo HTTP_ROOT; ?>images/option-img1.png" alt="" class="option-img">
                    <img src="<?php echo HTTP_ROOT; ?>images/option-img01.png" alt="" class="option-img1">
                </span>
                <h3>Messages</h3>
                <p>Send messages to associated peoples.</p>
            </div>
          </a> -->

      </div>
  </div>
</div>  
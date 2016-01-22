<div class="top-cont">
  <div class="top-left"><a href="<?php echo HTTP_ROOT;?>"><img src="<?php echo HTTP_ROOT;?>images/notify-img.png" alt=""></a></div>
  <div class="top-right"><a href="<?php echo HTTP_ROOT."users/profile"; ?>"><img style="width:25px;height:25px;border-radius:10px;" id="profilepic" src="<?php if($parentData['User']['profile_pic']!=''){echo HTTP_ROOT.'bss_files/'.$parentData['User']['profile_pic'];}else{ echo HTTP_ROOT.'img/images/Profile-pic.png'; }?>"> <?php echo $parentData['User']['first_name']!=''?@$parentData['User']['first_name']:'--------------';  ?> <?php echo $parentData['User']['last_name']!=''?@$parentData['User']['last_name']:'---------------';  ?></a></div>
  <h2>Management</h2>
</div>

<div class="bread-crumb">
    <ul>
        <li><a href="/attendance/management">Home</a></li>
        <li><img src="images/arrow.png" alt=""></li>
        <li><a href="/attendance/management" class="active">Management</a></li>
    </ul>
</div>  
<div class="mid-management-cont">
  <div class="wrapper">
      <h2>What would you like to do ?</h2>
      <p>As a successfully logged in user, You are allowed to access the options below. Please select the right one regarding to your requirements and click to run it.</p>
      <div class="options-cont">
          <div class="options-cont1">
              <span>
              	<div class="acounts-cont">                	
                </div>
              </span>
              <h3>Accounts</h3>
              <p>Manage the accounts.</p>
          </div>
         

          <a href="<?php echo HTTP_ROOT; ?>locations">

            <div class="options-cont1">
                <span>
              	<div class="location-cont">                	
                </div>
              </span>
                <h3>Locations</h3>
                <p>Manage Locations.</p>
            </div>
          </a>
      </div>
  </div>
</div>  
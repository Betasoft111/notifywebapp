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
        <li><a href="<?php echo HTTP_ROOT; ?>locations" class="active">Locations</a></li>
    </ul>
</div>  
<div class="mid-management-cont">
  <div class="wrapper">
      <h2>Your locations list is below</h2>
      <!-- <p>As a successfully logged in user, You are allowed to access the options below. Please select the right one regarding to your requirements and click to run it.</p> -->
      <div class="options-cont">

        <a href="<?php echo HTTP_ROOT; ?>locations/add">
            <div class="options-cont1">
                 <span>
                <div class="locationadd-cont">                  
                </div>
                </span>
                <h3>Add Location</h3>
                <p>Add new Location</p>
            </div>
          </a>

          <a href="<?php echo HTTP_ROOT; ?>locations/locationslist">
            <div class="options-cont1">
               <span>
                <div class="locationview-cont">                 
                </div>
                </span>
                <h3>View Locations</h3>
                <p>See all your locations</p>
            </div>
          </a>
          <!-- <a href="<?php echo HTTP_ROOT; ?>locations/add">
            <div class="options-cont1">
                <span>
                    <img src="<?php echo HTTP_ROOT; ?>images/option-img1.png" alt="" class="option-img">
                    <img src="<?php echo HTTP_ROOT; ?>images/option-img01.png" alt="" class="option-img1">
                </span>
                <h3>Add Location</h3>
                <p>Add new Location</p>
            </div>
          </a>

          <a href="<?php echo HTTP_ROOT; ?>locations/locationslist">
            <div class="options-cont1">
                <span>
                    <img src="<?php echo HTTP_ROOT; ?>images/option-img1.png" alt="" class="option-img">
                    <img src="<?php echo HTTP_ROOT; ?>images/option-img01.png" alt="" class="option-img1">
                </span>
                <h3>View Locations</h3>
                <p>See all your locations</p>
            </div>
          </a>
 -->      </div>
  </div>
</div>  
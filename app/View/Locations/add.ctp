<!doctype html>
<html lang="en">
  <head>
    
    <title>Home Page</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script type="text/javascript">

    $(function() {                       
      $(".clickable").click(function() {  
      $(this).parent().parent().find('label.lable_item').addClass('active');
  });
  //$('body')
  $(".clickable").focusout(function () {
    $(".clickable").each(function () {
      if($(this).val() !=='') {
      }else {
        $(this).parent().parent().find('label.lable_item').removeClass('active');
      }
  });
  });
});
    </script>
  </head>
  <body>
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
        <li><a href="<?php echo HTTP_ROOT; ?>locations/add" class="active">Add New</a></li>
    </ul>
</div> 

    <div class="main_wrapper">
      <?php //echo $this->element('header');?>
      <!--end of header-->
      <section>
        <div class="table">
          
          <?php echo $this->Form->create('Location'); ?>
          <fieldset>
           <!--  <legend><?php //echo __('Add Location'); ?></legend> -->
           <div class="form">
            <label class="lable_item">Location Name</label>
            <?php
            echo $this->Form->input('location_name', array('class' => 'clickable', 'label' => false )); ?>
            </div>
            <?php $sizes = array(''=>'Select','manuall_address' => 'Add Address', 'beacon_location' => 'Add Beacon');
            echo $this->Form->input(
            'location_type', array('options' => $sizes, 'default' => 'Select', 'label' => 'Location Setup')
            );
            ?>

            <div id="locationAddress" class="location_setup">
               <div class="form">
                <label class="lable_item">Address</label>
                  <?php echo $this->Form->input('location_Setup', array('class' => 'clickable', 'label' => false)); ?>
                </div>
                 <div class="form">
                  <label class="lable_item">City</label>
                  <?php echo $this->Form->input('city', array('class' => 'clickable', 'label' => false)); ?>
                </div>
                <div class="form">
                  <label class="lable_item">State</label>
                  <?php echo $this->Form->input('state', array('class' => 'clickable', 'label' => false)); ?>
                </div>

            </div>
            <div id="addBeacon" class="location_setup">
              <label>Select Beacon</label>
              <select name="data[Location][Beacon]">
                <option value="">Select Beacon</option>
                <?php foreach($beacons as $beacon) {  ?>                 
                  <option value="<?php echo $beacon['Beacon']['id']; ?>"><?php echo $beacon['Beacon']['name']; ?></option>

                  <?php } ?>
              </select>
            </div>
            <?php
            // echo $this->Form->input('location_type');
            echo $this->Form->input('open_time');
            echo $this->Form->input('close_time'); ?>
           
            <div class="form">
             <label class="lable_item">company Name</label>
            <?php
            echo $this->Form->input('company_name', array('class' => 'clickable', 'label' => false));
            ?>
          </div>
           <div class="form buttonss">
            <a href="<?php echo HTTP_ROOT;?>locations">Cancel</a>
          <?php echo $this->Form->end(__('Submit')); ?>

          
        </div>
          </fieldset>

        </div>
      </section>
      <?php echo $this->element('footer');?>
    </div>
    
  </body>
  <script type="text/javascript">
    $(document).ready(function () {
      $('.location_setup').hide();
      $('#LocationLocationType').change(function () {
        if($(this).val() === 'manuall_address') {
          $('#locationAddress').show('slow');
          $('#addBeacon').hide('slow');
        }else if($(this).val() === 'beacon_location') {
          $('#locationAddress').hide('slow');
          $('#addBeacon').show('slow');
        }else {
          $('.location_setup').hide('slow');
        }
      });
    });
  </script>
</html>
<script type="text/javascript" src="/attendance/js/main.js"></script>
<link rel="stylesheet" type="text/css" href="/attendance/css/main1.css" />
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
        <li><a href="<?php echo HTTP_ROOT; ?>locations/view/<?php echo $id; ?>" class="active">Location</a></li>        
        <li><img src="<?php echo HTTP_ROOT; ?>images/arrow.png" alt=""></li>
        <li><a href="javascript:void(0)" class="active">Checklist</a></li>
    </ul>
</div>  
<div class="checklist-cont">
<div class="main_wrapper">
      <?php //echo $this->element('header');?>
      <!--end of header-->
    
        <div class="table">
          
          <?php echo $this->Form->create('LocationChecklist'); ?>
          <fieldset>
           <!--  <legend><?php //echo __('Add Location'); ?></legend> -->
           <div class="input text">
           
            <?php
            echo $this->Form->input('first_name', array('class' => 'clickable')); ?>
            </div>

            <div class="input text">
      
            <?php
            echo $this->Form->input('last_name', array('class' => 'clickable' )); ?>
            </div>

            <div class="input text">
           
            <?php
            echo $this->Form->input('prefered_name', array('class' => 'clickable' )); ?>
            </div>

            <div class="input text">
           
            <?php
            echo $this->Form->input('address', array('class' => 'clickable' )); ?>
            </div>

            <div class="input text">
          
            <?php
            echo $this->Form->input('dob', array('class' => 'clickable')); ?>
            </div>


            <div class="input text">
          
            <?php
            echo $this->Form->input('cognitive_loss', array('class' => 'clickable' )); ?>
            </div>

            <div class="input text">
            
            <?php
            echo $this->Form->input('hearing_loss', array('class' => 'clickable' )); ?>
            </div>

            <div class="input text">
         
            <?php
            echo $this->Form->input('visual_impairment', array('class' => 'clickable')); ?>
            </div>  

            <div class="input text">
          
            <?php
            echo $this->Form->input('ambulation', array('class' => 'clickable' )); ?>
            </div>  

            <div class="input text">
            
            <?php
            echo $this->Form->input('assistive_devices', array('class' => 'clickable' )); ?>
            </div>        

            <div class="input text">
           
            <?php
            echo $this->Form->input('toileting', array('class' => 'clickable' )); ?>
            </div>    

            <div class="input text">
            
            <?php
            echo $this->Form->input('bathing', array('class' => 'clickable')); ?>
            </div>    

            <div class="input text">
            
            <?php
            echo $this->Form->input('dressing', array('class' => 'clickable' )); ?>
            </div>    

            <div class="input text">
           
            <?php
            echo $this->Form->input('eating', array('class' => 'clickable' )); ?>
            </div>  

            <div class="input text">
            
            <?php
            echo $this->Form->input('housekeeping', array('class' => 'clickable' )); ?>
            </div>  

            <div class="input text">
            
            <?php
            echo $this->Form->input('shopping', array('class' => 'clickable')); ?>
            </div>  

            <div class="input text">
           
            <?php
            echo $this->Form->input('laundry', array('class' => 'clickable' )); ?>
            </div>         

            <div class="input text">
          
            <?php
            echo $this->Form->input('interests', array('class' => 'clickable' )); ?>
            </div>         

          <!--   <div id="locationAddress" class="location_setup"> -->

              <?php //echo $this->Form->input('location_Setup', array('class' => 'clickable')); ?>
           <!--  </div> -->
            <!-- <div id="addBeacon" class="location_setup">
              <label>Select Beacon</label>
              <select name="data[Location][Beacon]">
                <option value="">Select Beacon</option>
                <?php foreach($beacons as $beacon) {  ?>                 
                  <option value="<?php echo $beacon['Beacon']['id']; ?>"><?php echo $beacon['Beacon']['name']; ?></option>

                  <?php } ?>
              </select>
            </div> -->
            <?php
            // echo $this->Form->input('location_type');
         //   echo $this->Form->input('open_time');
          //  echo $this->Form->input('close_time'); ?>
           
           <!--  <div class="input text">
             <label class="lable_item">company Name</label>
            <?php
            echo $this->Form->input('company_name', array('class' => 'clickable'));
            ?>
          </div> -->
           <div class="form buttonss">
            <a href="<?php echo HTTP_ROOT;?>locations">Cancel</a>
          <?php echo $this->Form->end(__('Submit')); ?>

          
        </div>
          </fieldset>

        </div>
      
      <?php echo $this->element('footer');?>
    </div>
</div>
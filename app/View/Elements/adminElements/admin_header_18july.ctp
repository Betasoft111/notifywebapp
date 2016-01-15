<style>
.welcome span
{
	color:#FFF;
}
</style>
<div id="page-header-wrapper">
  <div id="top">
    <span class="logo">
      <?php echo $this->Html->link(__(WEBSITE),'/admin/backends/dashboard',array('style'=>'color:#FFFFFF'))?> 
    </span>
    <div class="welcome">
      <span class="note" style="font-weight:bold">
        <a style="color: #FFFFFF;"href="<?php echo HTTP_ROOT.'admin/backends/edit_admins/'.$this->Session->read('Admin.id')?>">
          <?php echo 'Welcome';?> 
          <?php echo $this->Session->read('Admin.uname');?>
        </a>
      </span>
      <a class="btn ui-state-default ui-corner-all" href="<?php echo HTTP_ROOT.'admin/backends/change_password/'.base64_encode(convert_uuencode(@$_SESSION['Admin']['id']))?>">
        <span class="ui-icon ui-icon-wrench"></span>
        <?php echo('Settings');?>
      </a>
      <a class="btn ui-state-default ui-corner-all" href="<?php echo HTTP_ROOT.'admin/backends/logout'?>">
        <span class="ui-icon ui-icon-power"></span>
        <?php echo('Logout');?> 
      </a>						
    </div>
	</div>
  <ul id="navigation" class="sf-js-enabled">
    <li>
      <a href="<?php echo HTTP_ROOT.'admin/backends/dashboard'?>" class="sf-with-ul">
        <?php echo('DASHBOARD');?>
      </a>
		</li>
		<li>
      <a href="<?php echo HTTP_ROOT.'admin/backends/manageMenber'?>" class="sf-with-ul"><?php echo('Members'); ?></a>
		</li>
    <li>
      <a href="javacript:void(0)" class="sf-with-ul"><?php echo('Cms'); ?></a>
      <ul>
        <li>
          <a href="#" class="sf-with-ul">
            <?php echo('Footer1'); ?>
          </a>
        </li>
        <li>
          <a href="#" class="sf-with-ul">
            <?php echo('Footer2'); ?>
          </a>
        </li>
        <li>
          <a href="#" class="sf-with-ul">
            <?php echo('Footer3'); ?>
          </a>
        </li>
        <li>
          <a href="#" class="sf-with-ul">
            <?php echo('Footer4'); ?>
          </a>
        </li>
      </ul>
    </li>
    <li>
      <a href="#" class="sf-with-ul">
        <?php echo('News Letter')?>
      </a>
    </li>
  </ul>
</div>
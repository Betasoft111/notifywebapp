<?php  echo $this->Html->script('tablesorter.js');?>
<?php  echo $this->Html->script('tablesorter-pager.js');?>

<div style="font-size: 20px; color: #4c3000; text-shadow: 1px 1px 0 #fff; margin-left:25px;">
    <h1>Members</h1>
</div>
<div id="sub-nav">
	<div id="top-buttons">		
        <a href="#" class="btn ui-state-default ui-corner-all">Add User</a>
    </div>
</div>
<div id="page-layout">
	<div id="page-content" class="data">
		<?php  echo $this->element('adminElements/members/member_list');?>
        <div class="clear"></div>			
    </div>
</div>

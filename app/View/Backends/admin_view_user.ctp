<div style="font-size: 20px; color: #4c3000; text-shadow: 1px 1px 0 #fff; margin-left:25px;">
    <h1>Member Details</h1>
</div>
<div id="sub-nav">
    <div class="page-title">
       <h1>View</h1>
    </div>
	<div id="top-buttons">		
        <a style="margin-bottom:10px;" class="ui-state-default ui-corner-all float-right ui-button" href="javascript:history.go(-1)">Back</a>
    </div>
     <div id="top-but" style="float: right; margin-top: -2px; margin-right: 10px;">	
    	<a href="<?php echo HTTP_ROOT.'admin/backends/add_member'?>" class="btn ui-state-default ui-corner-all">Add User</a>
    </div>
</div>
<div id="page-layout">
	<div id="page-content">
        <div id="page-content-wrapper" class="no-bg-image wrapper-full">           
            <?php echo $this->Session->flash();?>
            <div class="hastable">
			<form name="myform" id="tableForm" class="pager-form" >
                <table id="sort-table"> 
                    <thead> 
                    	<tr>
							<th class="header1" title="Sort">User Name</th>
                            <th class="header1" title="Sort">UserFull Name</th>
							<th class="header1" title="Sort">Email</th>
							<th class="header1" title="Sort">Role</th>
							<th class="header1" title="Sort">Created Date</th>
					 	</tr> 
                    </thead> 
                    <tbody> 
						
                    		<tr>
                    			<td>
	                  				<?php if(!empty($userData['User']['username'])) {?>
	                  					<?php echo $userData['User']['username']?>
	                  				<?php } else { ?>
	                  					<?php echo "n/a";?>
	                   				<?php } ?>
	                  			</td>
								<td>
				                  	<?php if(!empty($userData['User']['fullname'])) {?>
				                  		<?php echo $userData['User']['fullname']?>
				                  	<?php } else { ?>
				                  		<?php echo "n/a";?>
				                   	<?php } ?>
			                  	</td>
			                  	<td>
				                  	<?php if(!empty($userData['User']['email'])) {?>
				                  		<?php echo $userData['User']['email']?>
				                  	<?php } else { ?>
				                  		<?php echo "n/a";?>
				                   	<?php } ?>
			                  	</td> 
				                <td>
				                  	<?php if(!empty($userData['User']['role'])) {
				                  		if($userData['User']['role'] == 1){
				                  			echo "Teacher";
				                  			}
				                  			elseif($userData['User']['role'] == 2){
				                  				echo "Student";
				                  			}
				                  			elseif($userData['User']['role'] == 3){
                                               echo "Parent";
				                  			}
				                  		
				                  	} else { ?>
				                  	<?php echo "n/a" ; }?>
			                  	</td>
			                  	<td>
				                  	<?php $date = strtotime($userData['User']['created']);
                                      echo date('Y-m-d',$date);
				                  	?>
			                  	</td> 
                    		</tr>
                    	
                    </tbody>
                </table>
            </form>		
        	<div class="clear"></div>
       	</div>
    </div>
    <div class="clear"></div>			
</div>
</div>

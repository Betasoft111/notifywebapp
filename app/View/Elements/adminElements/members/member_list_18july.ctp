<div id="page-content-wrapper" class="no-bg-image wrapper-full">  
    <div class="hastable">
		<form name="myform" id="tableForm" class="pager-form" method="post" action="#">
            <table id="sort-table"> 
                <thead> 
                 	<tr>
					 	<th class="header1" title="Sort">S.NO.</th>
				        <th class="header1" title="Sort">Name</th>
						<th class="header1" title="Sort">User Name</th>
						<th class="header1" title="Sort">Email</th>
						<th class="header1" title="Sort">Created Date</th>
						<th class="" style="width:134px">Action</th> 
					 </tr> 
                </thead> 
                <tbody> 
					<?php
					if(empty($result))
					{
						echo '<tr><td colspan="12"><span class="no_record">No record found...</span></td></tr>';
					}
					else{
                         $i=1;
                     	foreach($result as $user_result) {?>
				    		<tr>
                  				<td>
                  					<?php echo $i; ?>
                  				</td> 
                  				<td>
                  					<?php if(!empty($user_result['User']['fullname'])) {?>
                  						<?php echo $user_result['User']['fullname']; ?>
                  					<?php } else { ?>
                  						<?php echo "n/a";?>
                  					 <?php } ?>
                  				</td>
				   				<td>
                  					<?php if(!empty($user_result['User']['username'])) {?>
                  						<?php echo $user_result['User']['username']; ?>
                  					<?php } else { ?>
                  						<?php echo "n/a";?>
                   					<?php } ?>
                  				</td>
								<td>
									<?php if(!empty($user_result['User']['email'])) {?>
										<?php echo $user_result['User']['email']; ?>
									<?php } else { ?>
                						<?php echo "n/a";?>
                  					<?php } ?>
								</td>
								<td>
									<?php $date = $user_result['User']['created']; 
									   $newDate = date('Y-m-d',strtotime($date)); 
                                     echo $newDate;
									?>
								</td>
								<td>
									<a href="#">Edit</a>
									<a href="#">View</a>
									<a href="#">Delete</a>
								</td>
                    		</tr>

                    	<?php $i++; }?>
                    <?php } ?>
                </tbody>
            </table>
        </form>
        <!--<div id="pager" style="margin-top:-3px;">
			<?php// echo $this->element('adminElements/table_head'); ?>
		</div>-->		
    <div class="clear"></div>
</div>
    
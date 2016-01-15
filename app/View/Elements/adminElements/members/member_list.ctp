<div id="page-content-wrapper" class="no-bg-image wrapper-full">  
  <?php echo $this->Session->flash('success'); ?>
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
									<a id="editUser"  href="<?php echo HTTP_ROOT .'admin/backends/edit_user/'.$user_result['User']['id']; ?>">
                      Edit
                  </a>
									<a id="viewUser" href="<?php echo HTTP_ROOT.'admin/backends/view_user/'.$user_result['User']['id']; ?>">
                      View
                  </a>
									<a class="deleteUser" user-id="<?php echo $user_result['User']['id'] ;?>" href="javascript:void(0);">
                    Delete
                  </a>
								</td>
              </tr>
            <?php $i++; }?>
          <?php } ?>
        </tbody>
      </table>
    </form> 
    <?php echo $this->Paginator->numbers(); ?>
    <?php echo $this->Paginator->prev('« Previous', null, null, array('class' => 'disabled')); ?>
    <?php echo $this->Paginator->next('Next »', null, null, array('class' => 'disabled')); ?>
    <?php echo $this->Paginator->counter(); ?>
    <div class="clear"></div>
</div>
<script>
  jQuery(document).ready(function($){
    $('.deleteUser').click(function(){
      var id = $(this).attr('user-id');
      var val =$(this);
      $.ajax({
        type : "POST",
        data : ({'uid' : id}),
        url:ajax_url+"admin/backends/delete_user",
        success:function(responce){
          if(responce == 'Member has been deleted successfully')
          {
            val.closest('tr').hide();
          }
        }
      });
    });
  });
</script>
    
<div class="top-cont">
  <div class="top-left"><a href="<?php echo HTTP_ROOT;?>"><img src="<?php echo HTTP_ROOT;?>images/notify-img.png" alt=""></a></div>
  <div class="top-right"><a href="<?php echo HTTP_ROOT."users/profile"; ?>"><img style="width:25px;height:25px;border-radius:10px;" id="profilepic" src="<?php if($parentData['User']['profile_pic']!=''){echo HTTP_ROOT.'bss_files/'.$parentData['User']['profile_pic'];}else{ echo HTTP_ROOT.'img/images/Profile-pic.png'; }?>"> <?php echo $parentData['User']['first_name']!=''?@$parentData['User']['first_name']:'--------------';  ?> <?php echo $parentData['User']['last_name']!=''?@$parentData['User']['last_name']:'---------------';  ?></a></div>
  <h2>Management</h2>
</div>

<div class="bread-crumb">
    <ul>
        <li><a href="<?php echo HTTP_ROOT;?>management">Home</a></li>
        <li><img src="<?php echo HTTP_ROOT;?>images/arrow.png" alt=""></li>
        <li><a href="<?php echo HTTP_ROOT;?>management" class="active">Management</a></li>
        <li><img src="<?php echo HTTP_ROOT;?>images/arrow.png" alt=""></li>
        <li><a href="<?php echo HTTP_ROOT;?>locations/view/<?php echo $locationid; ?>" class="active">Location</a></li>
        <li><img src="<?php echo HTTP_ROOT;?>images/arrow.png" alt=""></li>
        <li><a href="<?php echo HTTP_ROOT;?>locations/employees/<?php echo $locationid; ?>" class="active">Employee List</a></li>
        <li><img src="<?php echo HTTP_ROOT;?>images/arrow.png" alt=""></li>
        <li><a href="<?php echo HTTP_ROOT;?>locations/employeesview/<?php echo $locationid; ?>/<?php echo $empid; ?>" class="active">Employee</a></li>
    </ul>
</div>  
<div class="mid-management-cont">
  <div class="wrapper">
      <h2>Update the details for the employee</h2>
      <!-- <p>As a successfully logged in user, You are allowed to access the options below. Please select the right one regarding to your requirements and click to run it.</p> -->
      <div class="options-cont">

          <a href="<?php echo HTTP_ROOT; ?>locations/emplyeeupdate/<?php echo $locationid; ?>/<?php echo $empid; ?>">
            <div class="options-cont1">
                <span>
              		<div class="edit-loc-cont">                	
               	   </div>
                </span>
                <h3>Edit Details</h3>
                <p>Update the details of the employee</p>
            </div>
          </a>

          <a href="javascript:void(0)" onclick="deleteEmp('<?php echo $empid; ?>', '<?php echo $locationid; ?>')">
            <div class="options-cont1">
                <span>
              		<div class="delete-cont">                	
               	   </div>
                </span>
                <h3>Delete</h3>
                <p>Delete this employee.</p>
            </div>
          </a>

      </div>
  </div>
</div> 
<script>
function deleteEmp(id, locid) {
	swal({   
		title: 'Are you sure?',
		text: 'You want to remove the employee!',   
		type: 'warning',   
		showCancelButton: true,   
		confirmButtonColor: '#3085d6',   
		cancelButtonColor: '#d33',   
		confirmButtonText: 'ok, deleted!',   
		closeOnConfirm: false }, 
		function() {
		  
			$.ajax({
				url: '<?php echo HTTP_ROOT; ?>locations/delete_emp/' + id,
				type: 'get',
				dataType: 'json',
				success: function (response) {
					if(response.success) {
						swal({   
							title: 'Removed!',
							text: 'Employee is removed',   
							type: 'success',   
							showCancelButton: false,   
							confirmButtonColor: '#3085d6',   
							cancelButtonColor: '#d33',   
							confirmButtonText: 'ok, deleted!',   
							closeOnConfirm: true 
						}, 
							function() {
							 window.location.href='<?php echo HTTP_ROOT; ?>locations/employees/' + locid;
						});
					}
				},error: function(err) {
					console.log('Error eleting the employee', err);
				}

			});
					
	});
}
</script>
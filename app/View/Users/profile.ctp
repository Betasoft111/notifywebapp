<!doctype html>
<html class="no-js" lang="en">
<style>
.reveal-modal {
    left: 0;
    margin: 0 auto;
    max-width: 36.5em;
    right: 0;
    width: 80%;
}
.right.linkedit > a {
  color: #fff;
}
#profilepic {
    height: 118px;
    padding: 0 !important;
    width: 200px;
}
.loadimg {
  background: none repeat scroll 0 0 rgba(0, 0, 0, 0.3);
  height: 100%;
  left: 0;
  pointer-events: none;
  position: absolute;
  right: 0;
  top: 0;
  width: 100%;
  z-index: 2147483647;
}
.loadimg img {
  display: block;
  margin: 277px auto;
  width: 100px;
}
</style>
  <head>
   <title>Profile Page</title>
  </head>

  <body>
      <div class="main_wrapper">
      <?php echo $this->element('header');?>
<!--end of header-->
<section>
<div class="loadimg" style="display:none">
<img src="<?php echo HTTP_ROOT;?>/img/loading.gif"/>
</div>
<div class="main_content">
<div class="row Heading">
   <?php 
//$vardd= base64_encode(1);
//echo $vardd;
//echo base64_decode($vardd);
$prm=$this->params['action'];
$roledata=$this->Session->read('Auth.User.Role');
$sesdat=$this->Session->read('Auth');
//echo "<pre>"; print_r($sesdat); die;
          $down=0;
          $sown=0;
          $teach=0;
          $parent=0;
          if(!empty($roledata))
          {
            foreach ($roledata as $roledatas) {
             if($roledatas['role']=='9')
             {
              $sown=$roledatas['role'];
             }
             if($roledatas['role']=='8')
             {
              $down=$roledatas['role'];
             }
             if($roledatas['role']=='1')
             {
              $teach=$roledatas['role'];
             }
             if($roledatas['role']=='3')
              {
               $parent=$roledatas['role'];
              }
            }
          }
?>
<h1>My Account</h1>
<div class="all_content">
<div class="large-12 large-centered columns Profile_information">Profile information<span class="right linkedit"><a href="<?php echo HTTP_ROOT."users/signup/".base64_encode(@$parentData['User']['id']); ?>">Edit Profile</a></span></div>
<br/>
<div class="large-6 small-12 columns">
<div class="profile_back">
<div class="large-4 medium-4 small-12 columns Profile_img"><img id="profilepic" src="<?php if($parentData['User']['profile_pic']!=''){echo HTTP_ROOT.'bss_files/'.$parentData['User']['profile_pic'];}else{ echo HTTP_ROOT.'img/images/Profile-pic.png'; }?>">
<div class="edit_image" style="display:none">
<form role="form" action="" name="devis" id="devis" method="post" enctype="multipart/form-data">
<input id="UserImage" type="file" name="image">
</form>
</div>
</div>
<div class="large-3 medium-3 small-12 columns profile_info">First Name</div>
<div class="large-5 medium-5 small-12 columns profilefull_info"><?php echo $parentData['User']['first_name']!=''?@$parentData['User']['first_name']:'--------------';  ?></div>
<div class="large-3 medium-3 small-12 columns profile_info">Last Name</div>
<div class="large-5 medium-5 small-12 columns profilefull_info"><?php echo $parentData['User']['last_name']!=''?@$parentData['User']['last_name']:'---------------';  ?></div>
<div class="large-3 medium-3 small-12 columns profile_info">Email</div>
<div class="large-5 medium-5 small-12 columns profilefull_info"><?php echo $parentData['User']['email']!=''?@$parentData['User']['email']:'---------------';  ?></div>
<div class="large-3 medium-3 small-12 columns profile_info">User View</div>
<div class="large-5 medium-5 small-12 columns profilefull_info"><?php echo $parentData['User']['userview']!=''?@$parentData['User']['userview']:'------------';  ?></div>
<a class="editprofile" href="javascript:void(0)">Edit Profile Image</a>
</div>
<div class="large-6 large-centered medium-6 small-12 medium-centered columns" style="clear:both">

 <?php if($down=='8') {?>
              <a class="Submit_button <?php if($prm=='districtList' || $prm=='districtAdd') { echo "active"; }else {echo "";}?>" href="<?php echo HTTP_ROOT."school/districtList"; ?>">Districts</a>
              <?php } if($sown=='9') {?>
              <a class="Submit_button <?php if($prm=='schoolList' || $prm=='schoolAdd') { echo "active"; }else {echo "";}?>" href="<?php echo HTTP_ROOT."school/schoolList"; ?>">Schools</a>
              <?php } if($teach=='1') {?>
              <a class="Submit_button <?php if($prm=='classList' || $prm=='classAdd') { echo "active"; }else {echo "";}?>" href="<?php echo HTTP_ROOT."teachers/classList"; ?>">Classes</a>
              <?php } if($parent=='3') {?>
              <a class="Submit_button <?php if($prm=='childList' || $prm=='addChild') { echo "active"; }else {echo "";}?>" href="<?php echo HTTP_ROOT."school/childList"; ?>">Students</a>
              <?php } ?>
</div>
</div>
<div class="large-6 small-12 columns">
  
  <table>
    <thead>
      <tr>
         <th>Role</th>
         <th>Action</th>
      </tr>
    </thead>
      <tbody>
           <?php if(!empty($parentData['Role'])) { foreach ($parentData['Role'] as $parentDatas) {?>
           <tr>
             <td><?php if($parentDatas['role']=='3') { echo "Parent"; } elseif ($parentDatas['role']=='1') {
               echo "Teacher";
               
             } elseif ($parentDatas['role']=='2') {
              echo "Student";
             } elseif ($parentDatas['role']=='4') {
               echo "Manager";
             } elseif ($parentDatas['role']=='5') {
               echo "Employee";
             } elseif ($parentDatas['role']=='6') {
               echo "Event Host";
             } elseif ($parentDatas['role']=='7') {
               echo "Eventee";
             } elseif ($parentDatas['role']=='8') {
               echo "District Owner";
             }elseif ($parentDatas['role']=='10') {
               echo "Company";
             } else {
               echo "School Owner";
             }?></td>
             <td><a onclick="return confirm('Do you really want to delete this role?')" href="<?php echo HTTP_ROOT."users/deleteRole/".@$parentDatas['id']; ?>">Delete</a></td>
           </tr>

           <?php }}?>
      </tbody>
  </table> 
  <input type="button" id="addroleuser" class="right Submit_button" value="Add Role" data-reveal-id="messagemodel">
</div>

</div>

</div>
  </div>
</section>
<?php echo $this->element('footer');?>

      </div>




    
  </body>
  <div id="messagemodel" class="reveal-modal large-5 large-centered" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
  <h2 id="modalTitle">Add any one Role</h2>
<div id="secdiv">
<select id="optionselect">
  <option value="">Select</option>
<?php if(!empty($parentData['Role']))
$t='0';$s='0';$m='0';$em='0';$eh='0';$ev='0';$do='0';$so='0';$p='0';
 { foreach ($parentData['Role'] as $parentDatas) {?>
<?php if($parentDatas['role']=='3') { $p++; } elseif ($parentDatas['role']=='1') {
              
               $t++;
             } elseif ($parentDatas['role']=='2') {
              $s++;
             } elseif ($parentDatas['role']=='4') {
               $m++;
             } elseif ($parentDatas['role']=='5') {
              $em++;
             } elseif ($parentDatas['role']=='6') {
               $eh++;
             } elseif ($parentDatas['role']=='7') {
               $ev++;
             } elseif ($parentDatas['role']=='8') {
              $do++;
             } else {
               $so++;
             }?>
<?php }} ?>
<option value="8" style="display:<?php echo $do=='1'?'none':'block'; ?>"><?php echo "District Owner";?></option>

  <option value="9" style="display:<?php echo $so=='1'?'none':'block'; ?>">School Owner</option>
 
  <option value="1" style="display:<?php echo $t=='1'?'none':'block'; ?>">Teacher</option>
 
  <option value="3" style="display:<?php echo $p=='1'?'none':'block'; ?>">Parent</option>

  <option value="2" style="display:<?php echo $s=='1'?'none':'block'; ?>">Student</option>

  <option value="7" style="display:<?php echo $ev=='1'?'none':'block'; ?>">Eventee</option>
 
  <option value="6" style="display:<?php echo $eh=='1'?'none':'block'; ?>">Event Host</option>

  <option value="4" style="display:<?php echo $m=='1'?'none':'block'; ?>">Manager</option>
  <option value="5" style="display:<?php echo $em=='1'?'none':'block'; ?>">Employee</option>
</select>
<span class="errmsg star" style="display:none">Please select any one first</span>
</div>
<div id="submitdiv">
<input type="button" value="Add" class="Submit_button" id="sendMessage">
</div>
<a class="close-reveal-modal" aria-label="Close">&#215;</a>
</div>
</html>
<script>
$(document).ready(function(){
        var proto=window.location.protocol;
        var host=window.location.host;
        var ajaxUrl=proto+'//'+host+'/attendance';
$('#UserImage').on('change', function () {
    ajaxFileUpload();
});
$('.editprofile').on('click',function(){
 
 var txxt=$(this).text();
if(txxt=='Edit Profile Image')
{
$('.edit_image').show();
$(this).text('Back');
}
else
{
$('.edit_image').hide();
$(this).text('Edit Profile Image');
}
});
function ajaxFileUpload() {
   var id="<?php echo @$parentData['User']['id']; ?>";
   var file=[];
  $('.loadimg').show();
  
    $.ajax({
        type: "POST",
        url:ajaxUrl+'/users/uploadProfile/'+id,
        data: new FormData($('#devis')[0]),
          processData: false,
          contentType: false,
          dataType: 'json',
        success: function (data, status) {
            //console.log(data);
            if(data.Message=='1')
              {
               
                $('#profilepic').attr('src', data.url);
                 $('.loadimg').hide();
                $('.edit_image').hide();
              }
             else
              {
              alert('Not updated');
              $('.edit_image').show();
                $('.loadimg').hide();
              }
            
        },
        error: function (data, status, e) {
            alert(e);
        }
    })
    return false;
}
$("#sendMessage").on('click',function(){
   //var mess=$('#message').val();
   var opt=$('#optionselect').val();
   if(opt=='')
{
$('.errmsg').show();
return false;
}
else
{
$('.errmsg').hide();
$('.loadimg').show();
$.ajax({
            async:false,
            url: ajaxUrl+'/users/addRole/'+opt,
            dataType: 'json',
            success:function(data){
                if(data!='')
                {
                     if(data.Message=='1')
                      {
                       $('#secdiv').hide();
                       $('#modalTitle').text('Successfully add role');
                       $('#submitdiv').hide();
                         $('.loadimg').hide();
                          setTimeout(function(){
                                 window.location.reload();
                            }, 2000);
                      }
                     else
                     {
                       $('#secdiv').show();
                      $('#submitdiv').show();
                       $('#modalTitle').text('Add any one Role');
                       $('.loadimg').hide();
                     }
                 }
            }
        });

}
});
});
</script>

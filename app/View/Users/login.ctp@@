
      <div class="main_wrapper">
    
<!--end of header-->
<?php /*
<section>
<div class="loadimg" style="display:none">
<img src="<?php echo HTTP_ROOT;?>/img/loading.gif"/>
</div>
<div class="main_content">

<div class="row Heading">
<h1>login</h1>
<div class="all_content">
<h2>User Details</h2>
<br/>
<div class="large-6 medium-6 columns">
<?php echo $this->Form->create('User'); ?>

<label>Email</label>
<?php echo $this->Form->input('email',array('label'=>false)); ?>
  <!-- <input type="text" placeholder=""> -->

<label>Password</label>
<!-- <input type="text" placeholder=""> -->
  <?php echo $this->Form->input('password',array('label'=>false)); ?>

<?php echo $this->Form->end(array('class'=>'Submit_button','label'=>'Login')); ?>
<a href="#" class="forgote" data-reveal-id="forgote123">Forgot password?</a>
</div>

</div>

</div>
  </div>
</section>

*/?>
<section class="login-cont">
  <?php echo $this->Form->create('User'); ?>
  <div class="login-top-cont"><img src="<?php echo HTTP_ROOT;?>/images/notify-img.png" alt=""></div>
    <h2><img src="<?php echo HTTP_ROOT;?>/images/tick-mark.png" alt=""><?php echo $msg = $this->element('header');?> Successfully logged out</h2>
    <div class="login-form">
      <p><label><img src="<?php echo HTTP_ROOT;?>/images/mail-icon.png" alt=""></label>
       <?php echo $this->Form->input('email',array('label'=>false)); ?>
        <p><label><img src="<?php echo HTTP_ROOT;?>/images/password-icon.png" alt="">
        </label>  <?php echo $this->Form->input('password',array('label'=>false)); ?></p>
        <a href="#" class="login"><?php echo $this->Form->end(array('label'=>'Login')); ?><img src="<?php echo HTTP_ROOT;?>/images/login-icon.png" alt=""></a>
        <p><img src="<?php echo HTTP_ROOT;?>/images/key-icon.png" alt="" class="key-icon"><a href="#" class="forget" data-reveal-id="forgote123">Forgot your password?</a></p>    
    </div>    
</section>
<?php echo $this->element('footer');?>

      </div>


<div id="forgote123" class="reveal-modal large-5 large-centered" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
  <h2 id="modalTitle">Enter Your Email</h2>
<div id="firstdiv">
<input type="email" id="useremail" name="email">
<span class="star" id="email_error" style="display:none;">Please enter a valid email address</span>
</div>
<div id="seconddiv" style="display:none;">
<input type="hidden" id="question123" value="" disabled>
<input type="text" id="userans">
<span class="star" id="ans_error" style="display:none;">Please enter valid answer</span>
</div>
<div id="thirddiv" style="display:none;">
<input type="text" id="unicode" placeholder="enter 6 digit Code..">
<input type="password" id="userpass" placeholder="New Password..">
<span class="star" id="code_error" style="display:none;">Please enter right code.</span>
</div> 
<div id="submitdiv">
<input type="button" value="Submit" class="Submit_button" id="sendemail">
</div>
  <a class="close-reveal-modal" aria-label="Close">&#215;</a>
</div>

<script> 
$(document).ready(function(){
        var proto=window.location.protocol;
        var host=window.location.host;
        var ajaxUrl=proto+'//'+host+'/attendance';
 $('#sendemail').on('click', function(){
var email = $("#useremail").val();  
var newans= $('#userans').val();
var uncode= $('#unicode').val();
var newpass= $('#userpass').val();
if (email !== "" && newans == '' && uncode=='' && newpass=='') {  // If something was entered
    if (!isValidEmailAddress(email)) {
        $("#email_error").show(); //error message
        $("#useremail").focus();   //focus on email field
        return false;  
    }
    else
    {
    // alert('hii');
   $("#email_error").hide();
        //var fftt="sdfdjfgjd";
      $('.loadimg').show();
     $.ajax({
            async:false,
            url: ajaxUrl+'/users/getquestion/'+email,
            dataType: 'json',
            success:function(data){
                if(data!='')
                {
                     if(data.Message=='1')
                      {
                        $('.loadimg').hide();
                        $('#firstdiv').hide();
                        $('#seconddiv').show();
                        $('#modalTitle').text('Enter your security Answer');
                        $('#question123').val(data.Data.User.question);
                        $('#question123').prop('type', 'text');
                      }
                     else
                      {
                         $('.loadimg').hide();
                         $("#email_error").show();
                      }
                   //alert(data.Data.User.question);
                   
                }
            }
        });
    }
} 
else if (newans != '' && uncode=='' && newpass=='') {
   var secqus=$('#question123').val();
$('.loadimg').show();
  $.ajax({
            async:false,
            type:"POST",
            data:{secqestion:secqus,newanswer:newans},
            url: ajaxUrl+'/users/forgatpassword/'+email,
            dataType: 'json',
            success:function(data){
                if(data!='')
                {
                     if(data.Message=='1')
                      {
                     $('.loadimg').hide();
                      $('#modalTitle').text('Enter Code that you recieved in your Email');
                       $('#seconddiv').hide();
                       $('#thirddiv').show();
                       $("#ans_error").hide();
                      }
                     else
                      {
                         $("#ans_error").show();
                      }
                   //alert(data.Data.User.question);
                   
                }
            }
        });  
 
}
else if (uncode !='' && newpass !='') {
$('.loadimg').show();
   var secqus=$('#question123').val();
  $.ajax({
            async:false,
            type:"POST",
            data:{uncode:uncode,newpass:newpass},
            url: ajaxUrl+'/users/updatePassword/',
            dataType: 'json',
            success:function(data){
                if(data!='')
                {
                     if(data.Message=='1')
                      {
                     $('.loadimg').hide();
                      $('#modalTitle').text('You have Successfully updated your Password.');
                       $('#thirddiv').hide();
                       $('#submitdiv').hide();
                       $("#code_error").hide();
                              setTimeout(function(){
                                 window.location.reload();
                            }, 2000);
                     
                      }
                     else
                      {
                        $('.loadimg').hide();
                         $("#code_error").show();
                      }
                   //alert(data.Data.User.question);
                   
                }
            }
        });  
 
}
else
{
return false;
}

});


});
function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^(("[\w-+\s]+")|([\w-+]+(?:\.[\w-+]+)*)|("[\w-+\s]+")([\w-+]+(?:\.[\w-+]+)*))(@((?:[\w-+]+\.)*\w[\w-+]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][\d]\.|1[\d]{2}\.|[\d]{1,2}\.))((25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\.){2}(25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\]?$)/i);
    return pattern.test(emailAddress);
};
</script>




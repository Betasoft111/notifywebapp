
      <div class="main_wrapper">
      <?php echo $this->element('header'); ?>
<!--end of header-->
<section>
<div class="main_content">
<div class="row">
<div class="large-4 medium-4 small-8 columns school_heading">
<h1>Employee Name</h1>
</div>
<div class="large-3 medium-4 small-12 right columns midle_social_icon">
  <ul>
    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
    <li><a href="#"><i class="fa fa-plus"></i></a></li>
    <li><a href="#"><i class="fa fa-envelope"></i></a></li>
  </ul>
<div class="shadow"><img src="<?php echo HTTP_ROOT; ?>img/images/blog_list_shadow.png"></div>
</div>
</div>
<div class="row">
  <div class="large-4 columns">
      <div class="school_image img">
      <img id="profilepic" src="
  <?php if($employee['Employee']['image']!=''){
    echo HTTP_ROOT.'bss_files/'.$employee['Employee']['image'];
}
  else{ 
    echo HTTP_ROOT.'img/images/Profile-pic.png';
     }?>">
      </div>
      <br/>
      <br/>
      <address>
      <h1>Location</h1>
        Baner - Mhalunge Road,<br/>
        Baner, Pune,<br/>
        Maharashtra<br/>
        411045<br/>
        <br/>
        <strong>Phone number:</strong> +91 12345 6789<br/>
        <strong>Web Site:</strong> www.schoolname.com
      </address>
  </div>
  <div class="large-8 columns">
  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
  <br/>
  <div class="school_map img"><img src="<?php echo HTTP_ROOT; ?>img/images/school-page-map.jpg"></div>

  </div>
</div>

<br/>



</div>
</section>
<?php echo $this->element('footer'); ?>

      </div>


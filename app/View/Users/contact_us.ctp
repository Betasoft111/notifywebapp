
<!doctype html>
<html class="no-js" lang="en">
  <head>

    <title>Contact Us</title>
 

  </head>

  <body>
      <div class="main_wrapper">
  <?php echo $this->element('header'); ?>
<!--end of header-->
<section>
<div class="main_content">
<div class="row Heading">
<h1>Contact Us</h1>
<div class="all_content">

<div class="large-7 medium-7 columns">
<h2>Send Message</h2>
<label>Name
  <input type="text" placeholder="">
</label>
<label>Email
  <input type="text" placeholder="">
</label>
<label>Subject
  <input type="text" placeholder="">
</label>
<label>Massege
  <textarea type="text" class="massege_box"></textarea> 
</label>

<a href="#" class="Submit_button right">Submit</a>
</div>

<div class="large-5 medium-5 columns contact_map">
<h2>Our Address</h2>
<img src="<?php echo HTTP_ROOT; ?>img/images/main-map.jpg">
<br/>
<br/>
<address>
        Baner - Mhalunge Road,<br/>
        Baner, Pune,<br/>
        Maharashtra<br/>
        411045<br/>
        <br/>
        <strong>Phone number:</strong> +91 12345 6789<br/>
        <strong>Web Site:</strong> www.schoolname.com
      </address>

</div>

</div>

</div>
  </div>
</section>
<?php echo $this->element('footer'); ?>

      </div>
  </body>
</html>

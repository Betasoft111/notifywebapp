<!doctype html>
<html class="no-js" lang="en">
  <head>

    <script src="js/vendor/modernizr.js"></script>

  </head>

  <body>
      <div class="main_wrapper">
     <?php echo $this->element('header'); ?> 
<!--end of header-->
<section>
<div class="main_content">
<div class="row Heading">
<h1>My Account</h1>
<div class="all_content">
<div class="tab_nav">
  <ul>
    <li><a href="<?php echo HTTP_ROOT."beacons/beaconsInformation"; ?>">Beacons Information</a></li>
    <li><a href="<?php echo HTTP_ROOT."beacons/beaconsUser"; ?>">Beacons User</a></li>
    <li><a class="active" href="<?php echo HTTP_ROOT."beacons/schoolsListBeacon"; ?>">Beacons Functionality</a></li>
 </ul>
</div>
<br/>
<div class="large-6 large-centered medium-6 medium-centered small-12 columns">
<br/>
<h2>Add Beacons</h2>
<label>Beacons Name
  <input type="text" placeholder="">
</label>
<label>School Name
  <input type="text" placeholder="">
</label>
<label>Class Room
  <input type="text" placeholder="">
</label>
<a href="#" class="Submit_button">Submit</a>
</div>

</div>

</div>
  </div>
</section>
<?php echo $this->element('footer'); ?> 

      </div>



  
  </body>
</html>

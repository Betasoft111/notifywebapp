<!doctype html>
<html class="no-js" lang="en">
  <head>

    <title>Home Page</title>
  
  </head>

  <body>
      <div class="main_wrapper">
     <?php echo $this->element('header');?>
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
<div class="beacons_content">
  <div class="large-8 medium-8 small-12 columns">
    <p>Estimote Beacons and Stickers are small wireless sensors that you can attach to any location or object. They broadcast tiny radio signals which your smartphone can receive and interpret, unlocking micro-location and contextual awareness.</p>
    <p>With the Estimote SDK, apps on your smartphone are able to understand their proximity to nearby locations and objects, recognizing their type, ownership, approximate location, temperature and motion. Use this data to build a new generation of magical mobile apps that connect the real world to your smart device.</p>
    <p>Estimote Beacons are certified Apple iBeacon™ compatible as well as support Eddystone™, an open beacon format from Google.</p>

    <ul class="bottom_services">
      <li><i class="fa fa-hand-o-right"></i> User can learn about beacons</li>
      <li><i class="fa fa-hand-o-right"></i> Best way to use them</li>
      <li><i class="fa fa-hand-o-right"></i> Purchase them</li>
    </ul>

  </div>
  <div class="large-4 medium-4 small-12 columns"><img src="<?php echo HTTP_ROOT; ?>img/images/Beacons-Information-right-image.jpg"></div>
</div>


</div>

</div>
  </div>
</section>
<?php echo $this->element('footer');?>

      </div>



  </body>
</html>

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
<h1>Beacon</h1>
<div class="all_content">
<div class="tab_nav">
  <ul>
    <li><a href="<?php echo HTTP_ROOT."beacons/beaconsInformation"; ?>">Beacons Information</a></li>
    <li><a href="<?php echo HTTP_ROOT."beacons/beaconsUser"; ?>">Beacons User</a></li>
    <li><a class="active" href="<?php echo HTTP_ROOT."beacons/schoolsListBeacon"; ?>">Beacons Functionality</a></li>
  </ul>
</div>
<div class="row">
  <div class="large-6 medium-6 small-12 columns">
  <h6><a class="active" href="<?php echo HTTP_ROOT."beacons/addbeacon"; ?>">+ Add Beacons</a></h6>
    <table class="main_table">
  <thead>
    <tr>
      <th class="checkbox"><input type="checkbox"></th>
      <th>Beacons Name</th>
      <th >Actions</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class="checkbox"><input type="checkbox"></td>
      <td>Beacon 1</td>
      <td class="actions"><span><a href="#">View / </a></span><span><a href="#">Delete</a></span></td>
    </tr>
    <tr>
      <td class="checkbox"><input type="checkbox"></td>
      <td>Beacon 2</td>
      <td class="actions"><span><a href="#">View / </a></span><span><a href="#">Delete</a></span></td>
    </tr>
    <tr>
      <td class="checkbox"><input type="checkbox"></td>
      <td>Beacon 3</td>
      <td class="actions"><span><a href="#">View / </a></span><span><a href="#">Delete</a></span></td>
    </tr>
    <tr>
      <td class="checkbox"><input type="checkbox"></td>
      <td>Beacon 4</td>
      <td class="actions"><span><a href="#">View / </a></span><span><a href="#">Delete</a></span></td>
    </tr>
    <tr>
      <td class="checkbox"><input type="checkbox"></td>
      <td>Beacon 5</td>

      <td class="actions"><span><a href="#">View / </a></span><span><a href="#">Delete</a></span></td>
    </tr>
    <tr>
      <td class="checkbox"><input type="checkbox"></td>
      <td>Beacon 6</td>
      <td class="actions"><span><a href="#">View / </a></span><span><a href="#">Delete</a></span></td>
    </tr>
  </tbody>
</table>
<div class="large-4 medium-12 columns padding"><a href="#" class="Submit_button full_width">Submit</a></div>
<div class="large-8 medium-12 columns right">
<ul class="pagination">
  <li class="arrow unavailable"><a href="">&laquo;</a></li>
  <li class="current"><a href="">1</a></li>
  <li><a href="">2</a></li>
  <li class="unavailable"><a href="">&hellip;</a></li>
  <li><a href="">12</a></li>
  <li><a href="">13</a></li>
  <li class="arrow"><a href="">&raquo;</a></li>
</ul>
</div>
  </div>

<div class="large-6 medium-6 small-12 columns">
<h6>Attendance</h6>
    <table class="main_table">
  <thead>
    <tr>
      <th class="checkbox"><input type="checkbox"></th>
      <th>Students Name</th>
      <th class="actions">Actions</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class="checkbox"><input type="checkbox"></td>
      <td>Student 1</td>
      <td class="actions_arrow"><img src="<?php echo HTTP_ROOT; ?>img/images/right-mark-icon.png"></td>
    </tr>
    <tr>
      <td class="checkbox"><input type="checkbox"></td>
      <td>Student 2</td>
      <td class="actions_arrow"><img src="<?php echo HTTP_ROOT; ?>img/images/wrong-mark-icon.png"></td>
    </tr>
    <tr>
      <td class="checkbox"><input type="checkbox"></td>
      <td>Student 3</td>
      <td class="actions_arrow"><img src="<?php echo HTTP_ROOT; ?>img/images/wrong-mark-icon.png"></td>
    </tr>
    <tr>
      <td class="checkbox"><input type="checkbox"></td>
      <td>Student 4</td>
      <td class="actions_arrow"><img src="<?php echo HTTP_ROOT; ?>img/images/right-mark-icon.png"></td>
    </tr>
    <tr>
      <td class="checkbox"><input type="checkbox"></td>
      <td>Student 5</td>
      <td class="actions_arrow"><img src="<?php echo HTTP_ROOT; ?>img/images/right-mark-icon.png"></td>
    </tr>
    <tr>
      <td class="checkbox"><input type="checkbox"></td>
      <td>Student 6</td>
      <td class="actions_arrow"><img src="<?php echo HTTP_ROOT; ?>img/images/wrong-mark-icon.png"></td>
    </tr>
  </tbody>
</table>
<div class="large-8 medium-12 columns right">
<ul class="pagination">
  <li class="arrow unavailable"><a href="">&laquo;</a></li>
  <li class="current"><a href="">1</a></li>
  <li><a href="">2</a></li>
  <li class="unavailable"><a href="">&hellip;</a></li>
  <li><a href="">12</a></li>
  <li><a href="">13</a></li>
  <li class="arrow"><a href="">&raquo;</a></li>
</ul>
</div>
  </div>



</div>
</div>

</div>
  </div>
</section>
<?php echo $this->element('footer');?>

      </div>



 
  </body>
</html>

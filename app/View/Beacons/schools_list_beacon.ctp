<!doctype html>
<html class="no-js" lang="en">
  <head>
   
    <title>Home Page</title>
    
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
<h2>Beacons > Schools</h2>
<table class="main_table">
  <thead>
    <tr>
      <th class="checkbox"><input type="checkbox"></th>
      <th>School Name</th>
      <th class="Employe_Name" style="text-align:center">Class Room</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class="checkbox"><input type="checkbox"></td>
      <td>School 1</td>
      <td style="text-align:center">9</td>
      <td class="actions2"><span><a href="#">View Page / </a></span><span><a href="#">Edit / </a></span><span><a href="#">Delete</a></span></td>
    </tr>
    <tr>
      <td class="checkbox"><input type="checkbox"></td>
      <td>School 2</td>
      <td style="text-align:center">5</td>
      <td class="actions2"><span><a href="#">View Page / </a></span><span><a href="#">Edit / </a></span><span><a href="#">Delete</a></span></td>
    </tr>
    <tr>
      <td class="checkbox"><input type="checkbox"></td>
      <td>School 3</td>
      <td style="text-align:center">8</td>
      <td class="actions2"><span><a href="#">View Page / </a></span><span><a href="#">Edit / </a></span><span><a href="#">Delete</a></span></td>
    </tr>
    <tr>
      <td class="checkbox"><input type="checkbox"></td>
      <td>School 4</td>
      <td style="text-align:center">4</td>
      <td class="actions2"><span><a href="#">View Page / </a></span><span><a href="#">Edit / </a></span><span><a href="#">Delete</a></span></td>
    </tr>
    <tr>
      <td class="checkbox"><input type="checkbox"></td>
      <td>School 5</td>
      <td style="text-align:center">2</td>
      <td class="actions2"><span><a href="#">View Page / </a></span><span><a href="#">Edit / </a></span><span><a href="#">Delete</a></span></td>
    </tr>
    <tr>
      <td class="checkbox"><input type="checkbox"></td>
      <td>School 6</td>
      <td style="text-align:center">6</td>
      <td class="actions2"><span><a href="#">View Page / </a></span><span><a href="#">Edit / </a></span><span><a href="#">Delete</a></span></td>
    </tr>
  </tbody>
</table>
    <div class="large-5 columns right">
<ul class="pagination">
  <li class="arrow unavailable"><a href="">&laquo;</a></li>
  <li class="current"><a href="">1</a></li>
  <li><a href="">2</a></li>
  <li><a href="">3</a></li>
  <li><a href="">4</a></li>
  <li class="unavailable"><a href="">&hellip;</a></li>
  <li><a href="">12</a></li>
  <li><a href="">13</a></li>
  <li class="arrow"><a href="">&raquo;</a></li>
</ul>
    </div>

</div>

</div>
  </div>
</section>
<?php echo $this->element('footer'); ?>

      </div>



 
  </body>
</html>

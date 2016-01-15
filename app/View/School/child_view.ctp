<!doctype html>
<style>
thead, tbody { display: block; }

tbody {
    height: 150px;       
    overflow-y: auto;    
    overflow-x: hidden; 
}
</style>
<html class="no-js" lang="en">
  <head>

    <title>Home Page</title>
   
  </head>

  <body>
<style>
.row .box_border{border:solid 1px #ccc; padding:10px; margin:5px 0px;}
</style>


      <div class="main_wrapper">
      <?php echo $this->element('header');?>
<!--end of header-->
<section>
<div class="main_content">
<div class="row Heading">
<h1>Child Infomation</h1>
<div class="all_content">
<h6><a href="<?php echo HTTP_ROOT."school/childList"; ?>">List</a></h6>

<?php if(!empty($studata)) { foreach ($studata as $studatas) {?>
<div class="row box_border">
<div class="large-5 columns">
   <h5><strong>Class Name:</strong><?php echo @$studatas['Teacher']['className']; ?></h5>
   <h5><strong>Teacher Name:</strong><?php echo @$studatas['Teacher']['User']['first_name']; ?></h5>
   <h5><strong>Teacher Email:</strong><?php echo @$studatas['Teacher']['User']['email']; ?></h5>
</div>
    <div class="large-7 columns">
     <p><strong>Attendance Info</strong></p>
      <table class="main_table">
        <thead>
        <tr>
        <th>Date</th>
        <th>Attendance</th>  
        </tr>
         </thead>
        <tbody>
        <?php foreach ($studatas['StudentAttendance'] as $studatass) {?>
         <tr>
           <td><?php echo @$studatass['created']; ?></td>
           <td><?php echo @$studatass['attend']; ?></td>
         </tr> 
         <?php }?>
        </tbody>
      </table>
    </div>

</div>

<?php }} ?>











</div>

</div>
  </div>
</section>
 <?php echo $this->element('footer');?>

      </div>
   </body>
</html>
<script>
$(document).ready(function(){

});

</script>

<!doctype html>
<style>
/*thead, tbody { display: block; }

tbody {
    height: 150px;       
    overflow-y: auto;    
    overflow-x: hidden; 
}*/
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
<h1>Student Infomation</h1>
<div class="all_content">
<?php //echo "<pre>"; print_r($this->params); ?>
<h6><a href="<?php echo HTTP_ROOT."school/studentView/".@$class_id; ?>">List</a>
<a class="right" href="<?php echo  "http://abdevs.com".$this->Html->url('exportAbsences', array('controller' => 'school', 'action' => 'exportAbsences','ext' => 'csv'))."/".$this->params['pass'][0]."/".$this->params['pass'][1]; ?>">Absences CSV Export</a>
</h6>


<div class="row box_border">
<!--div class="large-5 columns">
   <h5><strong>Class Name:</strong><?php echo @$studatas['Teacher']['className']; ?></h5>
   <h5><strong>Teacher Name:</strong><?php echo @$studatas['Teacher']['User']['first_name']; ?></h5>
   <h5><strong>Teacher Email:</strong><?php echo @$studatas['Teacher']['User']['email']; ?></h5>
</div-->
    <div class="">
     <p><strong>Attendance Info</strong></p>
      <table class="main_table">
        <thead>
        <tr>
        <th>Date</th>
        <th>Attendance</th>  
        </tr>
         </thead>
        <tbody>
        <?php foreach ($studata as $studatass) {?>
         <tr>
           <td><?php echo @$studatass['StudentAttendance']['created']; ?></td>
           <td><?php echo @$studatass['StudentAttendance']['attend']; ?></td>
         </tr> 
         <?php }?>
        </tbody>
      </table>
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
<script>
$(document).ready(function(){

});

</script>

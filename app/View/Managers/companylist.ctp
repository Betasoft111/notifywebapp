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
<h1>Companies List</h1>
<div class="all_content">
<h6><a href="<?php echo HTTP_ROOT."managers/addcompany"; ?>">Add</a><a class="deletelink" href="<?php echo HTTP_ROOT."managers/delete/"; ?>">|Delete</a></h6>
<?php $paginator = $this->Paginator; ?>
<br/>
<table class="main_table">
  <thead>
    <tr>
      <th class="checkbox"><input type="checkbox" id="checkAll"></th>
      <?php echo "<th>" . $paginator->sort('companyName', 'Company Name') . "</th>"; ?>
      <th class="Employe_Name">Employees</th>
      <th >Actions</th>
    </tr>
  </thead>
  <tbody>

  <?php if(!empty($companydata)){foreach ($companydata as $companydatas) {?>
   
     <tr>
      <td class="checkbox"><input type="checkbox" class="check" value="<?php echo $companydatas['Company']['id']; ?>"></td>
      <td><a href="<?php echo HTTP_ROOT."managers/company"; ?>"><?php echo $companydatas['Company']['companyName']; ?></a> </td>
      <td>2</td>
      <td class="actions"><span><a href="<?php echo HTTP_ROOT."managers/addcompany/".$companydatas['Company']['id']; ?>">Edit / </a></span><span><a href="#">View / </a></span><span><a href="<?php echo HTTP_ROOT."managers/delete/".$companydatas['Company']['id']; ?>">Delete</a></span></td>
    </tr>
    <?php }} else {?>
    <td class="checkbox"><input type="checkbox"></td>
    <td>Record Not Found</td>
    <td></td>
    <td></td>
    <?php }?>
  </tbody>
</table>
   <?php 

echo "<div class='paging large-5 columns right'>";
 
        // the 'first' page button
        echo $paginator->first("First");
         
        // 'prev' page button, 
        // we can check using the paginator hasPrev() method if there's a previous page
        // save with the 'next' page button
        if($paginator->hasPrev()){
            echo $paginator->prev("Prev");
        }
         
        // the 'number' page buttons
        echo $paginator->numbers(array('modulus' => 2));
         
        // for the 'next' button
        if($paginator->hasNext()){
            echo $paginator->next("Next");
        }
         
        // the 'last' page button
        echo $paginator->last("Last");
     
    echo "</div>";



?>

</div>

</div>
  </div>
</section>
 <?php echo $this->element('footer'); ?>

      </div>
 </body>
</html>
<script>
$(document).ready(function(){
$("#checkAll").change(function () {
      $(".check").prop('checked', $(this).prop("checked"));
   //alert(chh);  
     var allVals = [];
     $('.check:checked').each(function() {
        
      allVals.push($(this).val());
    });
    $('.deletelink').attr('href','http://abdevs.com/attendance/managers/delete/'+allVals); //alert(allVals);
});
$(".check").change(function () {
     // $(".check").prop('checked', $(this).prop("checked"));
   //alert(chh);  
     var allVals = [];
     $('.check:checked').each(function() {
        
      allVals.push($(this).val());
    });
    $('.deletelink').attr('href','http://abdevs.com/attendance/managers/delete/'+allVals); //alert(allVals);
});
});

</script>

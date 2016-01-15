<!doctype html>
<style>
.exportlink > a {
    margin-left: 39%;
}
.formap{
margin-right:-2%;
}
</style>
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
<h1>Childrens</h1>
<div class="all_content">
<?php //echo "<pre>"; print_r($this->params['pass'][0]); ?>
<?php $sown=0; $roledata=$this->Session->read('Auth.User.Role');  foreach ($roledata as $roledatas) {
             if($roledatas['role']=='3')
             {
              $sown++;
             }
    }
if($sown=='1'){
?>
<h6><a href="<?php echo HTTP_ROOT."school/addChild"; ?>">Add Child</a><a class="deletelink" href="<?php echo HTTP_ROOT."school/deleteChild"; ?>">|Delete</a></h6>
<?php } ?>
<br/>
<div class="large-6 medium-6 small-12 columns">
<?php $paginator = $this->Paginator; ?>
  <table class="main_table">
  <thead>
    <tr>
      <th class="checkbox"><input id="checkAll" type="checkbox"></th>
      <?php echo "<th>" . $paginator->sort('child_name', 'Child Name') . "</th>"; ?>
      <th >Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php if(!empty($studentdata)) foreach ($studentdata as $studentdatas) {{?>
    <tr>
      <td class="checkbox"><input class="check" type="checkbox" value="<?php echo $studentdatas['Children']['id']; ?>"></td>
      <td><?php echo @$studentdatas['Children']['child_name']; ?></td>
      <td class="actions"><span><a href="<?php echo HTTP_ROOT."school/childView/".@$studentdatas['Children']['id']; ?>">View / </a></span><?php if($sown=='1'){ ?><span><a href="<?php echo HTTP_ROOT."school/addChild/".@$studentdatas['Children']['id']; ?>">Edit / </a></span><span><a href="<?php echo HTTP_ROOT."school/deleteChild/".@$studentdatas['Children']['id']; ?>">Delete</a></span><?php } ?></td>
    </tr>
  <?php }} else {?>
  <td class="checkbox"></td>
      <td>No Record Found</td>
      <td class="actions"></td>
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
    <div class="formap large-6 medium-6 small-12 columns">
     <div id="Map" style="width: 400px; height: 300px;">
    </div>

</div>

</div>
  </div>
</section>
 <?php echo $this->element('footer'); ?>

      </div>

  </body>
</html>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
var arra1=[]; 
 arra1=<?php echo json_encode($latdat); ?>;
//alert(arra1);

  var contentstring = [];
  var regionlocation = [];
  var markers = [];
  var iterator = 0;
  var areaiterator = 0;
  var map;
  var infowindow = [];
  geocoder = new google.maps.Geocoder();
  
  $(document).ready(function () {
    setTimeout(function() { initialize(); }, 400);
  });
  
  function initialize() {           
    infowindow = [];
    markers = [];
    GetValues();
    iterator = 0;
    areaiterator = 0;
    region = new google.maps.LatLng(regionlocation[areaiterator].split(',')[0], regionlocation[areaiterator].split(',')[1]);
    map = new google.maps.Map(document.getElementById("Map"), { 
      zoom: 18,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      center: region,
    });
    drop();
  }
  
  function GetValues() {
    //Get the Latitude and Longitude of a Point site : http://itouchmap.com/latlong.html
   var ij=0;
    $.each(arra1, function (index) {
    
    contentstring[ij] = arra1[index].Attendance.email;
    regionlocation[ij] = arra1[index].Attendance.latitude+','+arra1[index].Attendance.longitude;

  ij++;
});
  

  }
       
  function drop() {
    for (var i = 0; i < contentstring.length; i++) {
      setTimeout(function() {
        addMarker();
      }, 800);
    }
  }
 
  function addMarker() {
    var address = contentstring[areaiterator];
    var icons = 'http://maps.google.com/mapfiles/ms/icons/red-dot.png';
    var templat = regionlocation[areaiterator].split(',')[0];
    var templong = regionlocation[areaiterator].split(',')[1];
    var temp_latLng = new google.maps.LatLng(templat, templong);
    markers.push(new google.maps.Marker(
    {
      position: temp_latLng,
      map: map,
      icon: icons,
      draggable: false
    }));            
    iterator++;
    info(iterator);
    areaiterator++;
  }
 
  function info(i) {
    infowindow[i] = new google.maps.InfoWindow({
      content: contentstring[i - 1]
    });
    infowindow[i].content = contentstring[i - 1];
    google.maps.event.addListener(markers[i - 1], 'click', function() {
      for (var j = 1; j < contentstring.length + 1; j++) {
        infowindow[j].close();
      }
      infowindow[i].open(map, markers[i - 1]);
    });
  }
</script>
<script>
$(document).ready(function(){

$("#checkAll").change(function () {
      $(".check").prop('checked', $(this).prop("checked"));
   //alert(chh); 
    
     var allVals = [];
     $('.check:checked').each(function() {
        
      allVals.push($(this).val());
    });
    $('.deletelink').attr('href','http://abdevs.com/attendance/school/deleteChild/'+allVals); //alert(allVals);
});
$(".check").change(function () {
     // $(".check").prop('checked', $(this).prop("checked"));
   //alert(chh);  
     var allVals = [];
     $('.check:checked').each(function() {
        
      allVals.push($(this).val());
    });
    $('.deletelink').attr('href','http://abdevs.com/attendance/school/deleteChild/'+allVals); //alert(allVals);
});
});

</script>

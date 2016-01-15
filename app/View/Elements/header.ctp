<?php
$prm=$this->params['action'];
$roledata=$this->Session->read('Auth.User.Role');
$down=0;
$sown=0;
$teach=0;
$parent=0;
$manager=0;
$employee=0;
$eventHost=0;
$eventee=0;
if(!empty($roledata))
{
foreach ($roledata as $roledatas) {
if($roledatas['role']=='9')
{
$sown=$roledatas['role'];
}
if($roledatas['role']=='8')
{
$down=$roledatas['role'];
}
if($roledatas['role']=='1')
{
$teach=$roledatas['role'];
}
if($roledatas['role']=='3')
{
$parent=$roledatas['role'];
}
if($roledatas['role']=='4')
{
$manager=$roledatas['role'];
}
if($roledatas['role']=='5')
{
$employee=$roledatas['role'];
}
if($roledatas['role']=='6')
{
$eventHost=$roledatas['role'];
}
if($roledatas['role']=='7')
{
$eventee=$roledatas['role'];
}
if($roledatas['role']=='10')
{
$company=$roledatas['role'];
}
}
?>
<header>
  <div class="top-cont">
    <div class="top-left"><img src="<?php echo HTTP_ROOT;?>/images/notify-img.png" alt=""></div>
    <div class="top-right"><img src="<?php echo HTTP_ROOT;?>/images/admin-img.png" alt=""> Notify Admin</div>
    <?php
    $route =$this->here;
    //echo $route;
    switch ($route) {
    case "/attendance/users/profile":
    $urlroute='Profile';
    break;
    case "/attendance/teachers/classList":
    $urlroute='Class List';
    break;
    case "/attendance/school/schoolList":
    $urlroute='School List';
    break;
    case "/attendance/beacons/beaconsList":
    $urlroute='beacons List';
    break;
    case "/attendance/users/signup":
    $urlroute='Signup';
    break;
    default:
    $urlroute='';
    break;
    }
    ?>
    <h2><?php echo $urlroute;?></h2>
  </div>
  <div class="bread-crumb">
    
    <ul>
      <li><?php echo $this->Html->getCrumbs(' > ', 'Home'); ?></li>
      <li><img src="<?php echo HTTP_ROOT;?>/images/arrow.png" alt=""></li>
      <li><a href="#" class="active"><?php echo $urlroute;?></a></li>
    </ul>
  </div>
  <!--        <div class="row">
    <div class="large-4 medium-6 small-12  right columns">
      <br/>
      <div class="row collapse">
        <div class="large-10 medium-10 small-8 columns"><input type="text" placeholder="Search"></div>
        <div class="large-2 medium-2  small-4 columns"><div class="go_search"><a href="#">GO</a></div></div>
      </div>
    </div>
  </div> -->
  <div class="toggle_button">
    <span></span>
    <span></span>
    <span></span>
  </div>
  
  <nav class="main_navigation" >
    <div class="navigation_width toolbarGlobal">
      <nav class="main_navigation">
        <ul>
          <li>
            <a class="<?php echo $prm=='profile'?'active':''; ?>" href="<?php echo HTTP_ROOT."users/profile"; ?>">Profile</a>
          </li>
          <?php if($parent !='1')
          { ?>
          <li><a class="<?php if($prm=='schoolList' || $prm=='schoolAdd'|| $prm=='districtList' || $prm=='districtAdd' || $prm=='schoolList' || $prm=='studentView' || $prm=='AddStudent'|| $prm=='childList' || $prm=='childView' || $prm=='addChild' || $prm=='classList' ){echo "active"; }else { echo "";} ?>" href="javascript:void(0);">District/Schools</a>
          <ul>
            <?php if($down=='8') {?>
            <li><a class="<?php if($prm=='districtList' || $prm=='districtAdd') { echo "active"; }else {echo "";}?>" href="<?php echo HTTP_ROOT."school/districtList"; ?>">As District Owner</a></li>
            <?php } if($sown=='9') {?>
            <li><a class="<?php if($prm=='schoolList' || $prm=='schoolAdd') { echo "active"; }else {echo "";}?>" href="<?php echo HTTP_ROOT."school/schoolList"; ?>">As School Owner</a></li>
            <?php } if($teach=='1') {?>
            <li><a class="<?php if($prm=='classList' || $prm=='classAdd') { echo "active"; }else {echo "";}?>" href="<?php echo HTTP_ROOT."teachers/classList"; ?>">As Teacher</a></li>
            <?php } if($parent=='3') {?>
            <li><a class="<?php if($prm=='childList' || $prm=='addChild') { echo "active"; }else {echo "";}?>" href="<?php echo HTTP_ROOT."school/childList"; ?>">As Parent</a></li>
            <?php } ?>
          </ul>
        </li>
        <?php } ?>
        <li><a class="<?php if($prm=='companylist' || $prm=='addcompany') { echo "active"; }else {echo "";}?>" href="Javascript:void(0);">Companies/Manager</a>
        <ul>
          <?php if($company=='10') {?>
          <li><a class="<?php if($prm=='managerlist' || $prm=='addmanager') { echo "active"; }else {echo "";}?>" href="<?php echo HTTP_ROOT."company/mangerlist"; ?>">As Company</a>
          </li>
          <?php } if($manager=='4') {?>
          <li><a class="<?php if($prm=='companylist' || $prm=='addcompany') { echo "active"; }else {echo "";}?>" href="<?php echo HTTP_ROOT."managers/companylist"; ?>">As Manager</a></li>
          <?php } if($employee=='5') {?>
          <li><a class="<?php if($prm=='schoolList' || $prm=='schoolAdd') { echo "active"; }else {echo "";}?>" href="<?php echo HTTP_ROOT."school/schoolList"; ?>">As Employee</a></li>
          <?php }?>
        </ul>
      </li>
      <li><a class="<?php if($prm=='eventList' || $prm=='addevent' || $prm=='eventeeView' || $prm=='AddEventee') { echo "active"; }else {echo "";}?>" href="Javascript:void(0);">Event</a>
      <ul>
        <?php if($eventHost=='6') {?>
        <li><a class="<?php if($prm=='eventList' || $prm=='addevent' || $prm=='eventeeView' || $prm=='AddEventee') { echo "active"; }else {echo "";}?>" href="<?php echo HTTP_ROOT."event/eventList"; ?>">As EventHost</a></li>
        <?php } if($eventee=='7') {?>
        <li><a class="<?php if($prm=='schoolList' || $prm=='schoolAdd') { echo "active"; }else {echo "";}?>" href="<?php echo HTTP_ROOT."school/schoolList"; ?>">As Eventee</a></li>
        <?php }?>
      </ul>
    </li>
    <li><a class="<?php echo $prm=='signup'?'active':''; ?>" href="<?php echo HTTP_ROOT."users/signup"; ?>">Join</a></li>
    <?php $uid=$this->Session->read('Auth.User.User.id'); if(empty($uid)){ ?>
    <li><a class="<?php echo $prm=='login'?'active':''; ?>" href="<?php echo HTTP_ROOT."users/login"; ?>">Login</a></li>
    <?php } else {?>
    <li><a href="<?php echo HTTP_ROOT."users/logout"; ?>">Logout</a></li>
    <?php }?>
    <li><a class="<?php echo $prm=='beaconsList'?'active':''; ?>" href="<?php echo HTTP_ROOT."beacons/beaconsList"; ?>">Beacons</a></li>
  </ul>
</nav>
</div>
</nav>
<?php }?>
<a href="javascript:void(0)"><?php echo $this->Session->flash(); ?></a>
<a href="javascript:void(0)"><?php echo $this->Session->flash('auth');?></a>
</header>
<script>
$(document).ready(function(){
$(".toggle_button").click(function(){
$(".main_navigation").slideToggle("slow");
});
$('#flashMessage').on('click',function(){
//$(this).fadeOut();
$(this).slideUp(2000);
});
$('#authMessage').on('click',function(){
//$(this).fadeOut();
$(this).slideUp(2000);
});
});
</script>
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
<div class="row">
<div class="large-4 medium-4 small-8 columns school_heading">
<h1>Company Name</h1>
</div>
<div class="large-3 medium-4 small-12 right columns midle_social_icon">
  <ul>
    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
    <li><a href="#"><i class="fa fa-plus"></i></a></li>
    <li><a href="#"><i class="fa fa-envelope"></i></a></li>
  </ul>
<div class="shadow"><img src="<?php echo HTTP_ROOT; ?>img/images/blog_list_shadow.png"></div>
</div>
</div>
<div class="row">
  <div class="large-4 columns">
      <div class="school_image img"><img src="<?php echo HTTP_ROOT; ?>img/images/company_image_.jpg"></div>
      <br/>
      <br/>
      <address>
      <h1>Location</h1>
        Baner - Mhalunge Road,<br/>
        Baner, Pune,<br/>
        Maharashtra<br/>
        411045<br/>
        <br/>
        <strong>Phone number:</strong> +91 12345 6789<br/>
        <strong>Web Site:</strong> www.schoolname.com
      </address>
  </div>
  <div class="large-8 columns">
  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
  <br/>
  <div class="school_map img"><img src="<?php echo HTTP_ROOT; ?>img/images/school-page-map.jpg"></div>

  </div>
</div>

<div class="row">
  <h1>Photos</h1>
<ul class="clearing-thumbs small-block-grid-2 large-block-grid-5 medium-block-grid-5" data-clearing>
  <li><a href="<?php echo HTTP_ROOT; ?>img/images/photo-1.jpg"><img data-caption="caption here..." src="<?php echo HTTP_ROOT; ?>img/images/photo-1.jpg"></a></li>
  <li><a href="<?php echo HTTP_ROOT; ?>img/images/photo-2.jpg"><img data-caption="caption 2 here..." src="<?php echo HTTP_ROOT; ?>img/images/photo-2.jpg"></a></li>
  <li><a href="<?php echo HTTP_ROOT; ?>img/images/photo-3.jpg"><img data-caption="caption 3 here..." src="<?php echo HTTP_ROOT; ?>img/images/photo-3.jpg"></a></li>
  <li><a href="<?php echo HTTP_ROOT; ?>img/images/photo-4.jpg"><img data-caption="caption 3 here..." src="<?php echo HTTP_ROOT; ?>img/images/photo-4.jpg"></a></li>
  <li><a href="<?php echo HTTP_ROOT; ?>img/images/photo-5.jpg"><img data-caption="caption 3 here..." src="<?php echo HTTP_ROOT; ?>img/images/photo-5.jpg"></a></li>
  <li><a href="<?php echo HTTP_ROOT; ?>img/images/photo-2.jpg"><img data-caption="caption here..." src="<?php echo HTTP_ROOT; ?>img/images/photo-2.jpg"></a></li>
  <li><a href="<?php echo HTTP_ROOT; ?>img/images/photo-3.jpg"><img data-caption="caption 2 here..." src="<?php echo HTTP_ROOT; ?>img/images/photo-3.jpg"></a></li>
  <li><a href="<?php echo HTTP_ROOT; ?>img/images/photo-4.jpg"><img data-caption="caption 3 here..." src="<?php echo HTTP_ROOT; ?>img/images/photo-4.jpg"></a></li>
  <li><a href="<?php echo HTTP_ROOT; ?>img/images/photo-5.jpg"><img data-caption="caption 3 here..." src="<?php echo HTTP_ROOT; ?>img/images/photo-5.jpg"></a></li>
</ul>
</div>
<br/>
<div class="row">
  <h1>Videos</h1>
<ul class="small-block-grid-2 large-block-grid-5 medium-block-grid-5">
<li><a href="#" data-reveal-id="videoModal"><img src="<?php echo HTTP_ROOT; ?>img/images/video-1.jpg"></a></li>
<li><a href="#" data-reveal-id="videoModal2"><img src="<?php echo HTTP_ROOT; ?>img/images/video-2.jpg"></a></li>
<li><a href="#" data-reveal-id="videoModal3"><img src="<?php echo HTTP_ROOT; ?>img/images/video-3.jpg"></a></li>
<li><a href="#" data-reveal-id="videoModal4"><img src="<?php echo HTTP_ROOT; ?>img/images/video-4.jpg"></a></li>
<li><a href="#" data-reveal-id="videoModal5"><img src="<?php echo HTTP_ROOT; ?>img/images/video-5.jpg"></a></li>
</ul>
<div id="videoModal" class="reveal-modal large" data-reveal aria-labelledby="videoModalTitle" aria-hidden="true" role="dialog">
  <h2 id="videoModalTitle">This modal has video 1</h2>
  <div class="flex-video widescreen vimeo">
    <iframe width="800" height="600" src="//www.youtube.com/watch?v=LKqllf30mMY" frameborder="0" allowfullscreen></iframe>
  </div>
  <a class="close-reveal-modal" aria-label="Close">&#215;</a>
</div>

<div id="videoModal2" class="reveal-modal large" data-reveal aria-labelledby="videoModalTitle" aria-hidden="true" role="dialog">
  <h2 id="videoModalTitle">This modal has video 2</h2>
  <div class="flex-video widescreen vimeo">
    <iframe width="800" height="600" src="//www.youtube.com/watch?v=_1Ys4JdAAKg" frameborder="0" allowfullscreen></iframe>
  </div>
  <a class="close-reveal-modal" aria-label="Close">&#215;</a>
</div>

<div id="videoModal3" class="reveal-modal large" data-reveal aria-labelledby="videoModalTitle" aria-hidden="true" role="dialog">
  <h2 id="videoModalTitle">This modal has video 3</h2>
  <div class="flex-video widescreen vimeo">
    <iframe width="800" height="600" src="//www.youtube.com/watch?v=i7Vqbrm1ATo" frameborder="0" allowfullscreen></iframe>
  </div>
  <a class="close-reveal-modal" aria-label="Close">&#215;</a>
</div>

<div id="videoModal4" class="reveal-modal large" data-reveal aria-labelledby="videoModalTitle" aria-hidden="true" role="dialog">
  <h2 id="videoModalTitle">This modal has video 4</h2>
  <div class="flex-video widescreen vimeo">
    <iframe width="800" height="600" src="//www.youtube.com/watch?v=YxlpNB1vwFw" frameborder="0" allowfullscreen></iframe>
  </div>
  <a class="close-reveal-modal" aria-label="Close">&#215;</a>
</div>

<div id="videoModal5" class="reveal-modal large" data-reveal aria-labelledby="videoModalTitle" aria-hidden="true" role="dialog">
  <h2 id="videoModalTitle">This modal has video 5</h2>
  <div class="flex-video widescreen vimeo">
    <iframe width="800" height="600" src="//www.youtube.com/watch?v=5vp-3hqR_T4" frameborder="0" allowfullscreen></iframe>
  </div>
  <a class="close-reveal-modal" aria-label="Close">&#215;</a>
</div>
</div>


</div>
</section>
<?php echo $this->element('footer'); ?>

      </div>
  </body>
</html>

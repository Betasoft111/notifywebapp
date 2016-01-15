<?php
$content = explode("\n", $content);

foreach ($content as $line):
	echo '<p> ' . $line . "</p>\n";
endforeach;
?>
<body>
    <div class="comtemp" style="display:none;">
<p>Your Class Code is: <b><?php echo $ClassCode; ?></b></p>
     <p><strong>Welcome to our App</strong></p>
     <p><strong>this email is system generated please do not reply good luck.</strong></p>
     <p><strong>Attendence.com</strong></p>
</div>
</body>
<script>
//alert('hii');
$(document).ready(function(){
 $('.onthiscl').on('click',function(){
   $('.comtemp').show();
});
});
<script>
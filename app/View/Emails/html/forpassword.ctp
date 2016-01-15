<?php
$content = explode("\n", $content);

foreach ($content as $line):
	echo '<p> ' . $line . "</p>\n";
endforeach;
?>
<body>
<p>Your new password is: <b><?php echo $Password; ?></b></p>
     <p><strong>Welcome to our App</strong></p>
     <p><strong>this email is system generated please do not reply good luck.</strong></p>
     <p><strong>Attendence.com</strong></p>

</body>

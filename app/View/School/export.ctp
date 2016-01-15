"ID","Class ID","User ID","classCode","status","Parent Email","Student Email","Student Name","image","Created","Modified"
<?php 
foreach ($data as $row):
	foreach ($row['Student'] as &$cell):
		// Escape double quotation marks
		$cell = '"' . preg_replace('/"/','""',$cell) . '"';
	endforeach;
	echo implode(',', $row['Student']) . "\n";
endforeach;
?>

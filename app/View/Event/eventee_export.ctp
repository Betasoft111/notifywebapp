"ID","Event ID","User ID","eventCode","status","Parent Email","Eventee Email","Eventee Name","image","Created","Modified"
<?php 
foreach ($data as $row):
	foreach ($row['Eventee'] as &$cell):
		// Escape double quotation marks
		$cell = '"' . preg_replace('/"/','""',$cell) . '"';
	endforeach;
	echo implode(',', $row['Eventee']) . "\n";
endforeach;
?>
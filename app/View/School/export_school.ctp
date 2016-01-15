"ID","User Id","School Name","Email","District Code","School Code","Address","Date Time"
<?php 
foreach ($data as $row):
	foreach ($row['School'] as &$cell):
		// Escape double quotation marks
		$cell = '"' . preg_replace('/"/','""',$cell) . '"';
	endforeach;
	echo implode(',', $row['School']) . "\n";
endforeach;
?>
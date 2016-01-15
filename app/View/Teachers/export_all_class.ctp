"id","User Id","Class Name","Class Code","School Code","Start Time","End Time","Start Date","End Date","Repeat Type","Interval"
<?php 
foreach ($data as $row):
	foreach ($row['Teacher'] as &$cell):
		// Escape double quotation marks
		$cell = '"' . preg_replace('/"/','""',$cell) . '"';
	endforeach;
	echo implode(',', $row['Teacher']) . "\n";
endforeach;
?>
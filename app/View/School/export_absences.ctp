"Email","Date","Attendance"
<?php 
/*foreach ($data as $row):
	foreach ($row['Teacher'] as &$cell):
		// Escape double quotation marks
		$cell = '"' . preg_replace('/"/','""',$cell) . '"';
	endforeach;
	echo implode(',', $row['Teacher']) . "\n";
endforeach;*/

     foreach ($data as $datase) {
     echo  $datase['Student']['student_email'].",".$datase['StudentAttendance']['created'].",".$datase['StudentAttendance']['attend']."\n";
     }
 
?>

<?php
use MicroForce\Model\Student;
?>
<!DOCTYPE>
<html>
<head>
<title>Room Access</title>
</head>
<body>
	<h1>Hello everybody</h1>
	<table>
		<thead>
			<tr>
				<th>Firstname</th>
				<th>Lastname</th>
				<th>Accessible rooms</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($students as $student) { ?>
			<tr>
				<td><?= $view->escape($student->getFirstname()); ?> </td>
				<td><?= $view->escape($student->getLastname()); ?> </td>
				
				<td>
    				<?php foreach ($student->roomAccess() as $room) {?>
    					<?= $view->escape($room['label']);?>
    						<img width="100" alt="ste" src="../public/img/DaBoyStefano.jpeg">
    				<?php } ?>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>

</body>
</html>

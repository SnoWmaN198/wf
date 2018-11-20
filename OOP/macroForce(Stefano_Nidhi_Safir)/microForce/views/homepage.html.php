<!DOCTYPE>
<html>
<head>
<title>Hello world</title>
</head>
<body>
	<h1>Hello everybody</h1>
	
	<img alt="ste" src="../public/img/DaBoyStefano.jpeg">
	<table>
		<thead>
			<tr>
				<th>Firstname</th>
				<th>Lastname</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($students as $student) { ?>
			<tr>
				<td><?= $view->escape($student->getFirstname()); ?> </td>
				<td><?= $view->escape($student->getLastname()); ?> </td>
			</tr>
			<?php } ?>
		</tbody>
	</table>

	<p>lorem Errare Humanum Est sed perseverare diabolicum l orem Errare
		Humanum Est sed perseverare diabolicum lorem Errare Humanum Est sed
		perseverare diabolicum lorem Errare Humanum Est sed perseverare
		diabolicum lorem Errare Humanum Est sed perseverare diabolicum lorem
		Errare Humanum Est sed perseverare diabolicum</p>

</body>
</html>

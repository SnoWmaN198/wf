<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>microForce</title>
        
    </head>
    <body>
		<h1>Hello World</h1>
		
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
						<td><?= $view->escape($student->getFirstname()); ?></td>						<!-- $view->(escape) = JavaScript will be transformed into text and not loaded  -->
						<td><?= $view->escape($student->getLastname()); ?></td>
					</tr>
				<?php } ?>		
			</tbody>	
		</table>
		
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam scelerisque, sapien eget dictum bibendum, risus orci ultricies sapien, eu facilisis tortor neque non dui.
		<br/>
			Curabitur maximus nunc felis, luctus fringilla dui eleifend pretium. Praesent aliquet tortor orci, vitae sollicitudin augue dapibus nec. Duis rhoncus nisl sit amet purus consectetur rutrum. Integer hendrerit condimentum libero, vitae feugiat mi. Nam eget orci suscipit, malesuada massa quis, posuere ligula. Mauris ut massa id mi pretium porta vitae non purus.
		</p>
		<img alt="random" src="https://picsum.photos/500/500/?random">
		<p>
			Pellentesque at rhoncus ipsum. Aenean mi velit, dapibus eu blandit ut, venenatis quis odio. Proin pretium lacus in lacus condimentum hendrerit. Fusce pellentesque massa a dolor porttitor iaculis. Nulla facilisi. Sed augue enim, bibendum a rutrum nec, finibus sit amet ipsum. Sed mi felis, euismod nec magna sit amet, sagittis molestie leo. Nulla facilisi.
		</p>
   	</body>

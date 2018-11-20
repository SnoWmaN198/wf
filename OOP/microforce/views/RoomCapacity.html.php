<?php
use MicroForce\Model\Room;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>microForce Room Capacity</title>
        
    </head>
    <body>
		<h1>Room Capacity</h1>
		
		<table border>
			<thead>
				<tr>
					<th>Name</th>
					<th>Students</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				/**
				 * @var $room Room
				 */
				foreach ($rooms as $room) { ?>
					<tr>
						<td><?= $room->getName(); ?></td>						<!-- $view->(escape) = JavaScript will be transformed into text and not loaded  -->
						<td><?php for($i=0;$i<count($room->showRelation());$i++){
						    
						//each($room->showRelation() as $student){
						    echo $room->showRelation()[$i]['firstname'].' '.$room->showRlation()[$i]['lastname'];
						    if($i<count($room->showRelation())-1){echo ' | ';}
						}?></td>
					</tr>
				<?php } ?>		
			</tbody>	
		</table>
	
   	</body>

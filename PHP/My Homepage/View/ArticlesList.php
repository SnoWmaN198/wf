<!DOCTYPE html>
<html>
    <head>
        <meta charset= "UTF-8">
        <title>Tag be sill home page</title>
    </head>
    <body>
        <h1>Tag be sill</h1>
        
        <p>
        	The actuel time is 
            <?php 
            
            echo (new DateTime())->format('Y-m-d H:i:s');
            
            ?>
        </p>
        <table border>
        		<?php 
        		echo '<tr>'; 
        		echo '<th> </th>';
        		foreach ($articles[0] as $key=>$header){
        		    if($key != 'img'){ 
        		        echo "<th> $key </th>"; 
        		    }
        		}
                echo '</tr>';
                
        		foreach ($articles as $article){
        		    echo '<tr>';
        		    echo "<td><img src=' ".$article['img']."'/>"."</td>";
        		    echo "<td> ".$article['id']." </td>";
        		    echo "<td> ".$article['pubDate']." </td>";
        		    echo "<td> ".$article['title']." </td>";
        		    echo "<td> ".$article['description']." </td>";
        		    echo '</tr>';
        		}
        		
        		?> 		
        </table>
    </body>
</html>
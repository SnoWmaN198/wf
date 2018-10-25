<?php 
    //Articles : id, pub_date, img, title, description
    $articles = [
        [
            'id' => 1,
            'pub_date' => '2018-06-21 11:43:12',
            'img' => 'https://picsum.photos/100/100/?random',
            'title' => 'Title 1',
            'description' => 'Lorem ipsum sit amet'
        ],
        [
            'id' => 2,
            'pub_date' => '2018-06-22 09:33:17',
            'img' => 'https://picsum.photos/100/100/?random',
            'title' => 'Title 2',
            'description' => 'Lorem ipsum sit amet et net'
        ]
    ];
?>
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
        		    echo "<td> ".$article['pub_date']." </td>";
        		    echo "<td> ".$article['title']." </td>";
        		    echo "<td> ".$article['description']." </td>";
        		    echo '</tr>';
        		}
        		
        		?> 		
        </table>
    </body>
</html>







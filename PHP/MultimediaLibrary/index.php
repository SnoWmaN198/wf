<?php
// connection to database
try {

    $DB = [
        'host'     => '127.0.0.1',
        'name'     => 'BoardgamesLibrary',
        'user'     => 'root',
        'password' => null
    ];

    $connection = new PDO(
        'mysql:host='.$DB['host'].';dbname='.$DB['name'],   
        $DB['user'],                                        
        $DB['password']                                    
    );

} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    exit();
}

// functions to add a new game with all the details
function addGame(
     string $title, 
     DateTime $publishingDate, 
     string $image,
     int $playingTime, 
     string $numOfPlayers,
     int $age,
     int $rating,
     string $designer,
     string $publisher,
     string $category,
     string $mechanismus
    ) {
        global $connection;
        $queryGame = 'insert into Boardgames(title, publishingDate, image, playingTime, numberOfPlayers, age, rating, designerId) 
                        value (:title, :publishingDate, :image, :playingTime, :numberOfPlayers, :age, :rating, :designer)';
        
        $publishingDate = (new DateTime())->format('Y-m-d H:i:s');
        
        $stmt = $connection->prepare($queryGame);
        $stmt->bindValue('title', $title);
        $stmt->bindValue('publishingDate', $publishingDate);
        $stmt->bindValue('image', $image);
        $stmt->bindValue('playingTime', $playingTime);
        $stmt->bindValue('numberOfPlayers', $numOfPlayers);
        $stmt->bindValue('age', $age);
        $stmt->bindValue('rating', $rating);
        
        try {
            $designerId = getDesginerId($designer);
        } catch (Exception $e) {
            echo 'An error occured with the designerId : '.$e->getMessage();
            exit;
        }
        
        if ($designerId) {
            $stmt->bindValue('designer', $designerId);
        } else {
            $queryDesigner = 'insert into Designer(`name`) value ($designer)';
            $designerResult = $connection->query($queryDesigner);
        }
        
        $result = $stmt->execute();
        if ($result === false) {
            throw new Exception(print_r($stmt->errorInfo(), true));
        }
}

function getDesginerId(string $name) : int{
    global $connection;
    $queryDesigner = 'select id from Designer where `name` = :name';
    
    $stmt = $connection->prepare($queryDesigner);
    $stmt->bindValue('name', $name);
    
    $result = $stmt->execute();
    
    if ($result === false) {
        throw new Exception(print_r($stmt->errorInfo(), true));
    }
    
    if ($result) {
       return $result;
    } else {
        return null;
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Multimedia Library</title>
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="/css/main.css"/>
    </head>
    <body>
        <div class="container">
    	<form method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label for="title">Boardgame</label>
            <input type="text" class="form-control" id="title" name="title">
            <small id="titleHelp" class="form-text text-muted">What is the name of the game you want to add?</small>
          </div>
          <div class="form-group">
              <label for="description">Description</label>
              <textarea class="form-control" id="description" name="description" rows="3"></textarea>
          </div>
          <div class="form-group">
            <label for="image">Upload an image</label>
            <input type="file" class="form-control-file" id="image" name="image">
          </div>
          <button type="submit" class="btn btn-primary">Upload</button>
        </form>
        </div>
    	
    	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
   	</body>
</html>
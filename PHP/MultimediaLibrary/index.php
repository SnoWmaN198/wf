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
     array $publishers,
     array $categories,
     array $mechanismus
    ) : void {                                                      // : void to respect PHP 7
        global $connection;
        $queryGame = 'insert into Boardgames(title, publishingDate, image, playingTime, numberOfPlayers, age, rating, designerId) 
                        value (:title, :publishingDate, :image, :playingTime, :numberOfPlayers, :age, :rating, :designer)';
               
        $stmt = $connection->prepare($queryGame);
        $stmt->bindValue('title', $title);
        $stmt->bindValue('publishingDate', $publishingDate->format('Y-m-d H:i:s'));
        $stmt->bindValue('image', $image);
        $stmt->bindValue('playingTime', $playingTime);
        $stmt->bindValue('numberOfPlayers', $numOfPlayers);
        $stmt->bindValue('age', $age);
        $stmt->bindValue('rating', $rating);
        
        try {
            $designerId = getDesginerId($designer);
        } catch (Exception $e) {
            echo 'An error occured : '.$e->getMessage();
            exit;
        }
        
        if ($designerId == null) {
            $result = $connection->prepare('insert into designer (name) value (:designer)');
            $result->bindValue('designer', $designer);
            $queryresult = $result->execute();
            if ($queryresult === false) {
                throw new Exception(print_r($result->errorInfo(), true));
            }
            
            $designerId = intval($connection->lastInsertId());
        }
        $stmt->bindValue('designer', $designerId);
        $result = $stmt->execute();
        
        if ($result === false) {
            throw new Exception(print_r($stmt->errorInfo(), true));
        }
        
        $gameId = $connection->lastInsertId();
        
        foreach ($publishers as $publisher) {
            try {
                $publisherId = getPublisherId($publisher);
            } catch (Exception $e) {
                echo 'An error occured : '.$e->getMessage();
                exit;
            }
            
            if ($publisherId == null) {
                $result = $connection->prepare('insert into Publisher (name) value (:publisher)');
                $result->bindValue('publisher', $publisher);
                $queryresult = $result->execute();
                if ($queryresult === false) {
                    throw new Exception(print_r($result->errorInfo(), true));
                }
                
                $publisherId = $connection->lastInsertId();
            }
            $result = $connection->prepare('insert into GamePublisher (gameId, publisherId) value (:gameId, :publisherId)');
            $result->bindValue('gameId', $gameId);
            $result->bindValue('publisherId', $publisherId);
            $queryresult = $result->execute();
            if ($queryresult === false) {
                throw new Exception(print_r($result->errorInfo(), true));
            }
        }
        
        foreach ($categories as $category) {

            $queryCategory = 'insert into GameCategory (gameId, categoryId) VALUE(:gameId, :categoryId)';
            $stmt = $connection->prepare($queryCategory);
            $stmt->bindValue('gameId', $gameId);
            $stmt->bindValue('categoryId', $category);
            $queryresult = $stmt->execute();
            if ($queryresult === false) {
                throw new Exception(print_r($stmt->errorInfo(), true));
            }  
        }
        
        foreach ($mechanismus as $mechan) {
            
            $queryMechanismus = 'insert into GameMechanismus (gameId, mechanismusId) VALUE(:gameId, :mechanismusId)';
            $stmt = $connection->prepare($queryMechanismus);
            $stmt->bindValue('gameId', $gameId);
            $stmt->bindValue('mechanismusId', $mechan);
            $queryresult = $stmt->execute();
            if ($queryresult === false) {
                throw new Exception(print_r($stmt->errorInfo(), true));
            }
        }
}

function getDesginerId(string $name) : ?int{
    global $connection;
    $queryDesigner = 'select id from Designer where `name` = :name';
    
    $stmt = $connection->prepare($queryDesigner);
    $stmt->bindValue('name', $name);
    
    $result = $stmt->execute();
    
    if ($result === false) {
        throw new Exception(print_r($stmt->errorInfo(), true));
    }
    
    $result = $stmt->fetch()['id'];
    
    if ($result) {
       return $result;
    } else {
        return null;
    }
}

function getPublisherId(string $name) : ?int{
    global $connection;
    $queryPublisher = 'select id from Publisher where `name` = :name';
    
    $stmt = $connection->prepare($queryPublisher);
    $stmt->bindValue('name', $name);
    
    $result = $stmt->execute();
    
    if ($result === false) {
        throw new Exception(print_r($stmt->errorInfo(), true));
    }
    
    $result = $stmt->fetch()['id'];
    
    if ($result) {
        return $result;
    } else {
        return null;
    }
}

function findAllCategories() {
    global $connection;
    $statement = 'SELECT * FROM Category';
    $statusList = $connection->query($statement)->fetchAll();
    if ($statusList === false) {
        throw new Exception(print_r($connection->errorInfo(), true));
    }
    
    return $statusList;
}

function findAllMechanismus() {
    global $connection;
    $statement = 'SELECT * FROM Mechanismus';
    $statusList = $connection->query($statement)->fetchAll();
    if ($statusList === false) {
        throw new Exception(print_r($connection->errorInfo(), true));
    }
    
    return $statusList;
}

// select indexes from the different databases
function getAllGames() : ?array {
    global $connection;
    $statement = 'SELECT * FROM Boardgames as g
                  INNER JOIN Designer as d ON d.id = g.designerId';
    $games = $connection->query($statement)->fetchAll();
    if ($games === false) {
        throw new Exception($connection->errorCode());
    }
    
    foreach ($games as $key => $game) {
        $statement = '
            SELECT * FROM Publisher as p
            INNER JOIN GamePublisher as gp ON p.id = gp.publisherId
            WHERE gp.gameId = '.$game['id'];
        $publishers = $connection->query($statement)->fetchAll();
        //var_dump($publishers);
        if ($publishers === false) {
            throw new Exception($connection->errorCode());
        }
        
        $game['publisher'] = $publishers;
        $games[$key] = $game;
    }
    
    return $games;
    
    foreach ($games as $key => $game) {
        $statement = '
            SELECT c.id, c.label FROM Category as c
            INNER JOIN GameCategory as gc ON c.id = gc.categoryId
            WHERE gc.gameId = '.$game['id'];
        $categories = $connection->query($statement)->fetchAll();
        var_dump($categories);
        if ($categories === false) {
            throw new Exception($connection->errorCode());
        }
        
        $game['category'] = $categories;
        $games[$key] = $game;
    }
    
    return $games;
    
    foreach ($games as $key => $game) {
        $statement = '
            SELECT m.id, m.label FROM Mechanismus as m
            INNER JOIN GameMechanismus as gm ON m.id = gm.mechanismusId
            WHERE gm.gameId = '.$game['id'];
        $mechanismus = $connection->query($statement)->fetchAll();
        var_dump($mechanismus);
        if ($mechanismus === false) {
            throw new Exception($connection->errorCode());
        }
        
        $game['mechanismus'] = $mechanismus;
        $games[$key] = $game;
    }
    
    return $games;
}

// display all the boardgames
$content = '<div class="container">';
$content .= '<div class="row">';

try {
    $boardgames = getAllGames();
} catch (Exception $e) {
    echo 'An error occured with code : '.$e->getMessage();
    exit;
}

//var_dump($boardgames);

/*foreach ($boardgames as $key => $game) {
    $title = $game['title'];
    $pubDate = $game['publishingDate'];
    $img = $game['image'];
    $playingTime = $game['playingTime'];
    $numberOfPlayers = $game['numberOfPlayers'];
    $age = $game['age'];
    $rating = $game['rating'];
    
    $categories = [];
    foreach ($game['category'] as $category) {
        $categories[] = $category['label'];
    }
    $categories = implode(' | ', $categories);
    
    $mechanismus = [];
    foreach ($game['mechanismus'] as $mecha) {
        $mechanismus[] = $mecha['label'];
    }
    $mechanismus = implode(' | ', $mechanismus);
    
    $content .= <<<EOT
    <div class="col-md-6 col-lg-3 my-3">
        <div class="card">
          <img class="card-img-top bg-secondary" src="$img" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">
                $title
                <span class="badge badge-danger">$age</span>
            </h5>
            <p class="card-text">$numberOfPlayers</p>
            <p class="card-text"><small class="text-muted">$pubDate</small></p>
            <p class="card-text"><span class="badge badge-info">$categories</span></p>
            <p class="card-text"><span class="badge badge-info">$mechanismus</span></p>
            <p class="card-text"><span class="badge badge-info">$rating</span></p>
          </div>
        </div>
    </div>
EOT;
}

$content .= '</div>';
$content .= '</div>';*/
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
          </div>
          <div class="form-group">
            <label for="image">Upload an image</label>
            <input type="file" class="form-control-file" id="image" name="image">
          </div>
          <div class="form-group">
            <label for="publishingDate">Publishingdate</label>
            <input type="date" class="form-control" id="publishingDate" name="publishingDate">
          </div>
          <div class="form-group">
            <label for="playingTime">Playing time</label>
            <input type="text" class="form-control" id="playingTime" name="playingTime">
          </div>
          <div class="form-group">
            <label for="age">Age</label>
            <input type="text" class="form-control" id="age" name="age">
          </div>
          <div class="form-group">
            <label for="publisher">Publisher</label>
            <input type="text" class="form-control" id="publisher" name="publisher">
          </div>          
          <div class="form-group">
            <label for="exampleFormControlSelect1">Mechanismus</label>
            <select multiple class="form-control" id="exampleFormControlSelect1">
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
            </select>
          </div>
          <div class="form-group">
            <label for="exampleFormControlSelect2">Category</label>
            <select multiple class="form-control" id="exampleFormControlSelect2">
              <option>a</option>
              <option>b</option>
              <option>c</option>
              <option>d</option>
              <option>e</option>
            </select>
          </div>
          <fieldset class="form-group">
            <div class="row">
              <legend class="col-form-label col-sm-2 pt-0">Number of players</legend>
              <div class="col-sm-10">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                  <label class="form-check-label" for="gridRadios1">
                    2 Players
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                  <label class="form-check-label" for="gridRadios2">
                    2-4 Players
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="option3">
                  <label class="form-check-label" for="gridRadios3">
                    2-6 Players
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios4" value="option4">
                  <label class="form-check-label" for="gridRadios4">
                    2-8 Players
                  </label>
                </div>
              </div>
            </div>
          </fieldset>
          <fieldset class="form-group">
          <div class="row">
              <legend class="col-form-label col-sm-2 pt-0">Rating</legend>
    		  <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
              <label class="form-check-label" for="inlineRadio1">1</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
              <label class="form-check-label" for="inlineRadio2">2</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3">
              <label class="form-check-label" for="inlineRadio3">3</label>
            </div>
        </div>
        </fieldset>
        <div>
        	<button type="submit" class="btn btn-primary">Submit</button>
        </div>     
        </form>
        </div>
    	
    	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
   	</body>
</html>
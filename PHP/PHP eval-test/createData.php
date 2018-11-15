<?php
try {
    $connection = new PDO("mysql:dbname=eval;host=127.0.0.1", 'root');
} catch (PDOException $exception) {
    echo 'Error : '.$exception->getMessage();
    exit();
}

$errors = [];
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (empty($_POST['name'])) {
        $errors['name'] = "Please provide a name";
    }
    if (!empty($_FILES['picture'])) {
        if ($_FILES['picture']['error'] !== UPLOAD_ERR_OK) {
            $errors['picture'] = "An error occured during upload";
        } else if (substr($_FILES['picture']['type'], 0, 6) !== 'image/') {
            $errors['picture'] = "Please provide an image";
        }
    }
    
    if (empty($errors)) {
        // We want the image name to be "beatbox_XX.png", XX will be the ID of the beatbox record
        $image = null;
        if (!empty($_FILES['picture'])) {
            $image = __DIR__ . uniqid() . '.png';
            move_uploaded_file($_FILES['picture']['tmp_name'], $image);
        }
        $stmt = 'INSERT INTO beatbox(name, picture) VALUE(:name, :pict)';
        $stmt = $connection->prepare($stmt);
        $stmt->bindValue('name', $_POST['name']);
        $stmt->bindValue('pict', $image);
        $result = $stmt->execute();
        
        $pictureId = $connection->lastInsertId();
        
        $stmt = 'UPDATE picture SET picture= :pict where id = :id';
        
        if (!$result) {
            print_r($stmt->errorInfo());
            exit();
        }
    }
}

//$statement = "INSERT INTO beatbox VALUE "
//$connection->query($statement)
?>

<form method="post" enctype="multipart/form-data">
	<input type="text" name="name">
	<input type="file" name="picture">
	<button type="submit">Send me your track</button>
</form>

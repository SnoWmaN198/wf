<?php 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    extract($_FILES['image']);
    
    if ($size > 1000000) {
        echo 'The allowed size is 1Mb';
    } else if ($error !== UPLOAD_ERR_OK) {
        echo 'An error occured';
    } else if (!preg_match('#^image/.+#', $type)) {
        echo 'Please provide an image';
    } else {
        $image = imagecreatefromstring(file_get_contents($tmp_name));
        
        header('Content-type: image/png');
        imagepng(imagescale($image, 150, 150));
        exit;
    }
    
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Image Manipulation</title>
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="/css/main.css"/>
    </head>
    <body>
    	<div class="container">
    	<form method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label for="title">Image Title</label>
            <input type="text" class="form-control" id="title" name="title">
            <small id="imageHelp" class="form-text text-muted">Please give a title to your image.</small>
          </div>
          <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" id="description" name="description">
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

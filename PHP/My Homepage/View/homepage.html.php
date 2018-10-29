<?php
$projects;
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<!--<meta name="viewport" content="width=device-width, initial-scale=1.0">   -->
<!-- <meta http-equiv="X-UA-Compatible" content="ie=edge"> -->
<link rel="stylesheet"
	href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
	integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
	crossorigin="anonymous">
<title>Homepage</title>
</head>
<style>
section {
	display: flex;
	justify-content: space-around;
	margin: 2rem;
}
</style>
<body>
	<header>
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<a class="navbar-brand" href="#">ProjectManager</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse"
				data-target="#navbarSupportedContent"
				aria-controls="navbarSupportedContent" aria-expanded="false"
				aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active"><a class="nav-link" href="#">Home <span
							class="sr-only">(current)</span></a></li>
					<li class="nav-item"><a class="nav-link" href="#">My Projects</a></li>
					<li class="nav-item"><a class="nav-link" href="#">All projects</a>
					</li>
					<li class="nav-item"><a class="nav-link" href="#">Help</a></li>
				</ul>
				<form class="form-inline my-2 my-lg-0">
					<input class="form-control mr-sm-2" type="search"
						placeholder="Search" aria-label="Search">
					<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
				</form>
			</div>
		</nav>
	</header>
	<section>
		<article>
        <?php
        foreach ($projects as $project) {
        ?>
          <div class="card" style="width: 18rem;">

				<img class="card-img-top" src="https://picsum.photos/80/80/?random"
					alt="Projects image">
				<div class="card-body">
        		<?php
  
        echo "<h3> " . $project['title'] . "</h3>";
        switch ($project['label']){
            case 'Analysis':
                echo "<p class='bg-primary col-md-auto'> " . $project['label'] . "</p>";
                break;
            case 'In progress':
                echo "<p class='bg-success col-sm-5'> " . $project['label'] . "</p>";
                break;
            case 'Blocked':
                echo "<p class='bg-danger col-sm-5'> " . $project['label'] . "</p>";
                break;
            case 'Finished':
                echo "<p class='bg-info col-sm-5'> " . $project['label'] . "</p>";
                break;
            default:
                echo "<p class='bg-secondary'> " . $project['label'] . "</p>";
                break;
        };
        echo "<p> " . $project['description'] . "</p>";
        echo "<span> " . $project['publishingDate'] . "</span>";

        ?> 		
            </div>
			</div>
		</article>
		<?php 
        }           // to be able to use bootstrap we need to close the foreach at the end 
		?>

	</section>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
		integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
		crossorigin="anonymous"></script>
	<script
		src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
		integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
		crossorigin="anonymous"></script>
	<script
		src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
		integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
		crossorigin="anonymous"></script>
</body>
</html>
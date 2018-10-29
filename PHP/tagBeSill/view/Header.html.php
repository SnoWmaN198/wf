<header class="container mb-5">
	<div class="row">
    	<div class="col-sm-3">
    		<img alt="Logo" src="/img/logo.png" class="img-fluid">
    	</div>
    	<div class="col align-self-end">
    		<h1>
    			<strong class="fs-important">
    				<span class="c-red">Tag</span><span class="c-green">Be</span><span class="c-blue">Sill</span>
    			</strong>
    			<span class="fs-05">Project management system</span>
    		</h1>
    	</div>
	</div>
	<hr>
	<nav class="nav justify-content-center">
	  <a class="nav-link <?php if ($_SERVER['REQUEST_URI'] == '/'){?>disabled<?php }?>" href="/">Home</a>
      <a class="nav-link <?php if ($_SERVER['REQUEST_URI'] == '/register.php'){?>disabled<?php }?>" href="/register.php">Register</a>
      <a class="nav-link <?php if ($_SERVER['REQUEST_URI'] == '/log'){?>disabled<?php }?>" href="#">Log in</a>
    </nav>
</header>

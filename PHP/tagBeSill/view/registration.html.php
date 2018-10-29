<?php 
$title = 'Tag be sill registration';


$content = <<<EOT
<div class="container">
<form>
  <div class="form-group">
    <label for="exampleInputUser">Username</label>
    <input type="text" class="form-control" id="exampleInputUser" placeholder="Enter a username">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
    <div class="form-group">
    <label for="exampleInputPassword2">Confirm Password</label>
    <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Confirm Password">
  </div>
  <button type="submit" class="btn btn-primary">Register</button>
  <a href="/" data-comment=" / is used to go to the root page">                                                          
  <button type="button" class="btn btn-info">Back</button>
  </a>  
</form>
</div>
EOT;


include __DIR__ . '/Base.html.php';




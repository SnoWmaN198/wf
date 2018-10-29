<?php 

$title = 'Tag be sill login';

$successText = '';

if (isset($success) && $success) {
    $successText = '<p class="alert alert-success">Login successful</p>';
} else if (isset($success)) {
    $successText = '<p class="alert alert-warning">Login failed, check your credentials</p>';
}

$content = <<<EOT
<div class="container">
    $successText
    <form method="POST">
      <div class="form-group">
        <label for="nickname">Username</label>
        <input type="text" class="form-control" name="nickname" id="nickname">
        <small id="userHelp" class="form-text text-muted">Enter your username</small>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" id="password">
        <small id="passwordHelp" class="form-text text-muted">Enter your password</small>
      </div>
      <button type="submit" class="btn btn-primary">Log In</button>
      <a href="/" data-comment=" / is used to go to the root page">
      <button type="button" class="btn btn-info">Back</button>
      </a>
    </form>
</div>
EOT;

include __DIR__ . '/Base.html.php';
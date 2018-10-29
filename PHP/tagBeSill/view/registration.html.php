<?php 
$title = 'Tag be sill registration';

// error message display (view folder)

$nicknameError = '';

if (!empty($errors['username'])) {
    $nicknameError = '<ul class="alert alert-danger" role="alert">';
    foreach ($errors['username'] as $errorText) {
        $nicknameError .= '<li>' . $errorText . '</li>';
    }
    $nicknameError .= '</ul>';
}

$passwordError = '';

if (!empty($errors['password1'])) {
    $passwordError = '<ul class="alert alert-danger" role="alert">';
    foreach ($errors['password1'] as $errorText) {
        $passwordError .= '<li>' . $errorText . '</li>';
    }
    $passwordError .= '</ul>';
}

$confirmError = '';

if (!empty($errors['password2'])) {
    $confirmError = '<ul class="alert alert-danger" role="alert">';
    foreach ($errors['password2'] as $errorText) {
        $confirmError .= '<li>' . $errorText . '</li>';
    }
    $confirmError .= '</ul>';
}

$nickname = $_POST['nickname'] ?? '';

if (isset($success) && $success) {
    $success = '<p class="alert alert-success">Registration succesful</p>';
} else {
    $success = '';
}

// register form

$content = <<<EOT
<div class="container">
  $success  
<form method="POST">
  <div class="form-group">
    <label for="nickname">Username</label>
    <input type="text" value="$nickname" class="form-control" name="nickname" id="nickname">
    <small id="userHelp" class="form-text text-muted">Enter a username</small>
    $nicknameError
  </div>
  <div class="form-group">
    <label for="password1">Password</label>
    <input type="password" class="form-control" name="password1" id="password1">
    <small id="passwordHelp" class="form-text text-muted">Enter a password</small>
    $passwordError
  </div>
    <div class="form-group">
    <label for="password2">Confirm Password</label>
    <input type="password" class="form-control" name="password2" id="password2">
    <small id="confirmHelp" class="form-text text-muted">Confirm your password</small>
    $confirmError
  </div>
  <button type="submit" class="btn btn-primary">Register</button>
  <a href="/" data-comment=" / is used to go to the root page">                                                          
  <button type="button" class="btn btn-info">Back</button>
  </a>  
</form>
</div>
EOT;


include __DIR__ . '/Base.html.php';




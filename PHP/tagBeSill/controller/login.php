<?php 

require_once __DIR__ . '/../model/User.php';

// error message

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if (!isset($_POST['nickname']) || empty($_POST['nickname']) || !isset($_POST['password'])) {
        $success = false;
    }
       
    try {
        $user = getUser($_POST['nickname']);
    } catch (Exception $e) {
        $success = false;
    }
    
    if ($user && $_POST['password'] == $user['password']) {
        logInUser($user);
        $success = true;
    } else {
        $success = false;
    }
}

// link with the login form

include __DIR__ . '/../view/login.html.php';

if (session_status() === PHP_SESSION_ACTIVE) {
    session_write_close();
}

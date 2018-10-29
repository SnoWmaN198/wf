<?php

$errors = [];

    // error message for null values
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        if (!isset($_POST['username'])) {
            $errors['username'] = ['A username must be provided'];
        }
        if (!isset($_POST['password1'])) {
            $errors['password1'] = ['A password must be provided'];
        }
        if (!isset($_POST['password2'])) {
            $errors['password2'] = ['Confirm your password'];
        }
        
        // error message for empty fields or different passwords
        
        if (empty($_POST['username'])) {
            if (!isset($errors['username'])) {
                $errors['username'] = [];
            }
            $errors['username'][] = 'Please provide a username';
        }
        if (empty($_POST['password1'])) {
            if (!isset($errors['password1'])) {
                $errors['password1'] = [];
            }
            $errors['password1'][] = 'Please provide a password';
        }
        if ($_POST['password1'] !== $_POST['password2']) {
            if (!isset($errors['password2'])) {
                $errors['password2'] = [];
            }
            $errors['password2'][] = 'Please repeat your password';
        }
    }
    
// link with the registration form

include __DIR__ . '/../view/registration.html.php';
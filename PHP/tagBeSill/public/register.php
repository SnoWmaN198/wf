<?php

$config = include __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../model/User.php';

$errors = [];

    // error message for null values
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        
        if (!isset($_POST['nickname'])) {
            $errors['nickname'] = ['A username must be provided'];
        }
        if (!isset($_POST['password1'])) {
            $errors['password1'] = ['A password must be provided'];
        }
        if (!isset($_POST['password2'])) {
            $errors['password2'] = ['Confirm your password'];
        }
        
        // error message for empty fields or different passwords
        
        if (empty($_POST['nickname'])) {
            if (!isset($errors['nickname'])) {
                $errors['nickname'] = [];
            }
            $errors['nickname'][] = 'Please provide a username';
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
        if (empty($errors)) {
            
            try {
                createUser($_POST['nickname'], $_POST['password1']);
                $success = true;
            } catch (Exception $e) {
                echo 'An error occured with code : '.$e->getMessage();
                exit;
            }
        }
    }
    

// link with the registration form

include __DIR__ . '/../view/registration.html.php';

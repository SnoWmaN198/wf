<?php 

require_once __DIR__ . '/connection.php';

/**
 * Create a new user
 * 
 * This function creates a new entry in the database and returns the id of the inserted element
 * 
 * @param string $username  The new entry for username
 * @param string $password  The new entry for password

 * @return int 
 */

function createUser(string $nickname, string $password, int $roleId = 1) : int {

    global $connection;
    $query = "INSERT INTO User(nickname, `password`, roleId) VALUE ('$nickname', '$password', '$roleId')";
    $user = $connection->exec($query);
    
    if (!$user) {
        throw new RuntimeException(print_r($connection->errorInfo(), true));
    }
    
    return $connection->lastInsertId();
}
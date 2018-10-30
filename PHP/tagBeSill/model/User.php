<?php 

require_once __DIR__ . '/connection.php';

/**
 * Create a new user
 * 
 * This function creates a new entry in the database and returns the id of the inserted element
 * 
 * @param string $nickname  The new entry for username
 * @param string $password  The new entry for password

 * @return int 
 */

function createUser(string $nickname, string $password, int $roleId = 1) : int {

    global $connection;
    
    
    $query = 'INSERT INTO User(nickname, `password`, roleId) VALUE (:nickname, :password, :roleId)';
    $stmt = $connection->prepare($query);
    $stmt->bindValue('nickname', $nickname);
    $stmt->bindValue('password', $password);
    $stmt->bindValue('roleId', $roleId);
    $result = $stmt->execute();
    
    if (!$result) {
        throw new RuntimeException(print_r($connection->errorInfo(), true));
    }
    
    return $connection->lastInsertId();
}

function getUser(string $nickname) : ?array {
    
    /**
     * @var PDO $connection
     */
    
    global $connection;
    
    $preparedQuery = $connection->prepare('SELECT * FROM User WHERE nickname = :name');
    $preparedQuery->bindValue('name', $nickname);
    $result = $preparedQuery->execute();
    
    if ($result === false) {
        throw new RuntimeException(print_r($connection->errorInfo(), true));
    }
    
    $result = $preparedQuery->fetch();
    if ($result) {
        return $result;
    }
    return null;
}

/**
 *
 * Open a session for the user
 * 
 * User information will be stored in the session superglobal. Return true on success, false on failure
 * 
 * @param array $user
 * @return bool
 */

function logInUser(array $user) : bool {
    
    $_SESSION['USER'] = $user;
    
    return true;
}

/**
 * 
 * Get current user
 * 
 * Return the current logged user if exists in the session. If not, return null
 * 
 * @return array|NULL
 */

function getCurrentUser() : ?array {
    
    return $_SESSION['USER'] ?? null;
}

/**
 * 
 * Logout 
 * 
 * Remove the session storage. Return true on success, false on failure
 * 
 * @return bool
 */

function logout() : bool {
    
    $_SESSION = [];
    session_destroy();
    
    return true;
    
}

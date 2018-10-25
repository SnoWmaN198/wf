<?php 

    require __DIR__ . '/../Model/connection.php';
    
    function getAllProjects() {
        /**
         *  @var PDO $connection
         */
        
        global $connection;
        $statement = 'select * from Project';
        $projects = $connection->query($statement);
        
        if ($projects === false) {
            throw new Exception($connection->errorCode());
            
        }
        
        return $projects;
    }
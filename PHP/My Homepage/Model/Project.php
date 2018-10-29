<?php 

    require __DIR__ . '/../Model/connection.php';
    
    function getAllProjects() {
        global $connection;
        $statement = 'select p.*, s.label from Project as p 
                      inner join Status as s on s.id = p.statusId';
        $projects = $connection->query($statement)->fetchAll();
        
        if ($projects === false) {
            throw new Exception($connection->errorCode()); 
        }
        
        foreach ($projects as $key => $project) {
            $statement = '
                    select c.label from Category as c
                    inner join ProjectCategory as pc on c.id = pc.categoryId
                    where pc.projectId = ' .$project['id'];
            $categories = $connection->query($statement)->fetchAll();
            
            if ($categories === false) {
                throw new Exception($connection->errorCode());
            }
            
            $project['categories'] = $categories;
            $project[$key] = $project;
            
        }
        
        return $projects;
    }
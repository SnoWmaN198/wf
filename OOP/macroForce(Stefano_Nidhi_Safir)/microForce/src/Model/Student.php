<?php
namespace MicroForce\Model;

use MicroForce\Connection\ConnectionSingleton;

class Student
{
    private $id;
    
    private $firstname;
    
    private $lastname;
    
    

    public function getId()
    {
        return $this->id;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    public function create(string $firstname, string $lastname) : ?Student
    {
        $connection = ConnectionSingleton::getConnection();
        try {
            $stmt = $connection->prepare('INSERT INTO students(firstname, lastname) VALUE (:firstname, :lastname);');
            $stmt->execute(['firstname' => $firstname, 'lastname' => $lastname]);
            
            $this->id = $connection->lastInsertId();
            $this->firstname = $firstname;
            $this->lastname = $lastname;
        } catch (\Exception $e) {
            return null;
        }
        
        return $this;
    }

    public function update() : Student
    {
        $connection = ConnectionSingleton::getConnection();
        $stmt = $connection->prepare(
            'UPDATE students SET firstname = :firstname, lastname = :lastname WHERE id = :id'
        );
        $stmt->bindValue('firstname', $this->firstname);
        $stmt->bindValue('lastname', $this->lastname);
        $stmt->bindValue('id', $this->id);
        $stmt->execute();
        
        return $this;
    }
    
    public function delete() : bool
    {
        $connection = ConnectionSingleton::getConnection();
        $stmt = $connection->prepare('DELETE FROM students WHERE id = :id');
        $stmt->execute(['id' => $this->id]);
        return true;
    }

    static public function findAll() : array
    {
        $connection = ConnectionSingleton::getConnection();
        $stmt = $connection->query('SELECT * FROM students');
        return $stmt->fetchAll(\PDO::FETCH_CLASS, Student::class);
        // HERE WE REPLACE  __CLASS__ BY Student::class but IDK fking why
    }
    
    public function roomAccess() : array
    {
        $connection = ConnectionSingleton::getConnection();
        $stmt = $connection->prepare('SELECT r.label FROM Rooms as r 
            INNER JOIN StudentRoom as sr ON r.id = sr.roomId
            WHERE sr.studentId = :id');
        $stmt->bindValue('id', $this->id);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}


















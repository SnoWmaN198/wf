<?php
namespace MicroForce\Model;

use MicroForce\Connection\ConnectionSingleton;

class Room
{
    private $id;
    private $name;
    private $capacity;
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $capacity
     */
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;
    }

    public function create(string $name, int $capacity) : ?Room
    {
        $connection = ConnectionSingleton::getConnection();
        try {
            $stmt = $connection->prepare('INSERT INTO rooms(name, capacity) VALUE(:name, :capacity)');
            $stmt->bindValue('name', $name);
            $stmt->bindValue('capacity', $capacity);
            $stmt->execute();
          
            $this->id = $connection->lastInsertId();
            $this->name = $name;
            $this->capacity = $capacity;
        } catch (\Exception $e) {
            
            return null;
        }
        
        return $this;
    }
    
    public function update() : Room
    {
        $connection = ConnectionSingleton::getConnection();
        $stmt = $connection->prepare('UPDATE rooms SET name = :name, capacity = :capacity WHERE id = :id');
        $stmt->execute(['name' => $this->name, 'capacity' => $this->capacity, 'id' => $this->id]);
        
        return $this;
    }
    
    public function delete() : bool
    {
        $connection = ConnectionSingleton::getConnection();
        $stmt = $connection->prepare('DELETE FROM rooms WHERE id = :id');
        $stmt->execute(['id' => $this->id]);
        return true;
    }
    
    static public function findAll() : array
    {
        $connection = ConnectionSingleton::getConnection();
        $stmt = $connection->query('SELECT * FROM rooms');
        return $stmt->fetchAll(\PDO::FETCH_CLASS, __CLASS__);
    }
    
    public function showRelation() : ?array
    {
        $connection = ConnectionSingleton::getConnection();
        $stmt = $connection->query("SELECT students.firstname, students.lastname FROM students 
                                    INNER JOIN studentRoom as sr ON students.Id = sr.studentId 
                                    INNER JOIN rooms ON rooms.id = sr.roomId 
                                    WHERE sr.roomId = $this->id
                                     order by rooms.name;
                                    ");
        $result= $stmt->fetchAll();
        if (!$result){
            return null;
        }
        return $result;
    }
    
}


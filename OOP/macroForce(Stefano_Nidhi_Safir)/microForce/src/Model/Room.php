<?php
namespace MicroForce\Model;

use MicroForce\Connection\ConnectionSingleton;

class Room
{
    private $id;
    private $label;
    private $description;
    public function getId()
    {
        return $this->id;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setLabel($label)
    {
        $this->label = $label;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function create(string $label, string $description) : ?Room
    {
        $connection = ConnectionSingleton::getConnection();
        try {
            $stmt = $connection->prepare('INSERT INTO rooms(label, description) VALUE (:label, :desc);');
            $stmt->execute(['label' => $label, 'desc' => $description]);
            
            $this->id = $connection->lastInsertId();
            $this->label = $label;
            $this->description = $description;
        } catch (\Exception $e) {
            return null;
        }
        
        return $this;
    }
    
    public function update() : Room
    {
        $connection = ConnectionSingleton::getConnection();
        $stmt = $connection->prepare(
            'UPDATE rooms SET label = :label, description = :desc WHERE id = :id'
            );
        $stmt->bindValue('label', $this->label);
        $stmt->bindValue('desc', $this->description);
        $stmt->bindValue('id', $this->id);
        $stmt->execute();
        
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
        return $stmt->fetchAll(\PDO::FETCH_CLASS, Room::class);
    }
}


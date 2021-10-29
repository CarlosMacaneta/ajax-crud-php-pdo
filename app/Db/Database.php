<?php

namespace App\Db;

use PDO;
use PDOStatement;

abstract class Database 
{
    private $table;
    private $connection;

    public function __construct($table = null)
    {
        $this->table = $table;
        $this->setConnection();
    }

    private function setConnection(): void
    {
        try {
            $this->connection = new PDO(
                getenv('DB_CONNECTION').':host='.getenv('DB_HOST').';
                dbname='.getenv('DB_DATABASE'),
                getenv('DB_USERNAME'),
                getenv('DB_PASSWORD'),
                array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4')
            );
            $this->connection->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
        } catch (\PDOException $e) {
            die('ERROR: '.$e->getMessage());
        }
    }

    private function executeQuery($query, $params = []): PDOStatement
    {
        try {
            $stmt = $this->connection->prepare($query);
            $stmt->execute($params);

            return $stmt;
        } catch (\PDOException $e) {
            die('ERROR: '.$e->getMessage());
        }
    }

    public function insert($data): int
    {
        $fields = array_keys($data);
        $bind   = array_pad([], count($fields), '?');

        $query = "INSERT INTO $this->table (". implode(',', $fields) .") 
            VALUES (". implode(',', $bind) .")";
        
        $this->executeQuery($query, array_values($data));       
        
        return $this->connection->lastInsertId();
    }

    public function getByFields($fields = '*', $where=null, $order=null, 
        $limit=null, $fetchAll=true)
    {
        $where = strlen($where) ? "WHERE $where"    : '';
        $order = strlen($order) ? "ORDER BY $order" : '';
        $limit = strlen($limit) ? "LIMIT $limit"    : '';

        $query = "SELECT $fields FROM $this->table $where $order $limit";
        
        
        return $fetchAll ? $this->executeQuery($query)->fetchAll(PDO::FETCH_CLASS, static::class) : 
            $this->executeQuery($query)->fetchObject(static::class);
    }

    public function getAll(): array | false
    {
        return $this->getByFields();
    }

    public function getById($id, $fields = '*')
    {   
        return $this->getByFields($fields,  "id = $id", null, null, false);
    }

    public function update($data, $where): void
    {
        $fields = array_keys($data);
        $query  = "UPDATE $this->table SET ". implode('=?,', $fields) ."=? WHERE $where";

        $this->executeQuery($query, array_values($data));
    }

    public function delete($where): void
    {
        $this->executeQuery("DELETE FROM $this->table WHERE $where");
    }

    public function deleteById($id): void
    {
        $this->delete("id = $id");
    }
}
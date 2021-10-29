<?php 

namespace App\Model;

use App\Db\Database;

abstract class Model extends Database
{
    private $data = [];

    public function __construct($tableName)
    {
        parent::__construct($tableName);
    }

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function __get($name)
    {
        if (!array_key_exists($name, $this->data)) {
            return null;
        }

        return $this->data[$name];
    }

    public function __isset($name): bool
    {
        return isset($this->data[$name]);
    }

    public function __unset($name): void
    {
        unset($this->data[$name]);
    }

    public function getData(): array
    {
        return $this->data;
    }
}
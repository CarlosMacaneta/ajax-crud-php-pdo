<?php

namespace App\Model;

class SoldVehicles extends Model
{
    public function __construct()
    {
        parent::__construct('sold_vehicle');
    }

    public function getClient(): array
    {
        return (new Client())->getById($this->client_id);
    }

    public function getVehicle(): array
    {
        return (new Vehicle())->getById($this->vehicle_id);
    }

    public function getCount(): int
    {
        return count($this->getAll());
    }
}
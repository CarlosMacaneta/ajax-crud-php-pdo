<?php

namespace App\Model;

use App\Model\Model;

class Client extends Model
{
    public function __construct()
    {
        parent::__construct('client');
    }

    public function getTotalVehiclesBought(): void
    {
        # code...
    }
}
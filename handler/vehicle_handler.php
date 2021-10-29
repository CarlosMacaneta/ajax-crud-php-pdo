<?php
require_once __DIR__.'../../bootstrap/app.php';
use App\Controllers\VehicleController;

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'save':
            VehicleController::create([
                'brand' => $_POST['brand'],
                'model' => $_POST['model'],
                'year'  => $_POST['year']
            ]);
            break;
        case 'fetchSingle':
            VehicleController::findById($_POST['id']);
            break;
        case 'find':
            VehicleController::find($_POST['query']);
            break;
        case 'update':
            VehicleController::update($_POST['hidden_id'], [
                'brand' => $_POST['brand'],
                'model' => $_POST['model'],
                'year'  => $_POST['year']
            ]);
            break;
        case 'delete':
            VehicleController::destroy($_POST['id']);
            break;
        default:
            VehicleController::index();
            break;
    }
}

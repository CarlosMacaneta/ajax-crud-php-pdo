<?php 
namespace App\Controllers;

use App\Model\Vehicle;

class VehicleController
{
    private static function tableRow($vehicle): string
    {
        return '<tr>
            <th scope="row">'. $vehicle->id .'</th>
            <td>'. $vehicle->brand .'</td>
            <td>'. $vehicle->model .'</td>
            <td>'. $vehicle->year  .'</td>
            <td>
                <button class="btn btn-primary btn-sm edit" id="'.$vehicle->id.'" name="edit">
                    Editar
                </button>
            </td>
            <td>
                <button class="btn btn-danger btn-sm delete" id="'.$vehicle->id.'" name="delete">
                    Remover
                </button>
            </td>
        </tr>';
    }

    public static function index(): void
    {
        $vehicles = (new Vehicle())->getAll();
        $dataTable = '';

        if (count($vehicles) > 0) {
            foreach($vehicles as $vehicle) {
                $dataTable .= self::tableRow($vehicle);
            }
        } else {
            $dataTable = '<tr>
                <td colspan="6" align="center">Não existem viaturas registadas.</td>
            <tr>';
        }

        echo json_encode($dataTable);
    }

    public static function create($data): void
    {   
        $vehicle = new Vehicle;
        $vehicle->insert($data);

        echo '<p class="text-center">Veículo salvo com sucesso.</p>';
    }

    public static function findById($id): void
    {
        $vehicle = (new Vehicle())->getById($id);

        $data['brand'] = $vehicle->brand;
        $data['model'] = $vehicle->model;
        $data['year']  = $vehicle->year;

        echo json_encode($data);
    }

    public static function find($query): void
    {
        $dataTable = '';
        if (!empty($query)) {
            if (is_numeric($query)) {
                $vehicles = (new Vehicle())->getByFields('*', "id = $query or year = $query");
            }else{
                $vehicles = (new Vehicle())->getByFields('*', "brand like '%$query%' or model like '%$query%'");
            }   

            if (count($vehicles) > 0) {
                foreach($vehicles as $vehicle) {
                    $dataTable .= self::tableRow($vehicle);
                }
            } else {
                $dataTable = '<tr>
                    <td colspan="6" align="center">Nenhuma viatura foi encontrada.</td>
                <tr>';
            }
        }

        echo json_encode($dataTable);
    }

    public static function update($id, $data): void
    {
        (new Vehicle())->update($data, "id = $id");

        echo '<p class="text-center">Veículo atualizado com sucesso.</p>';
    }

    public static function destroy($id): void
    {
        (new Vehicle())->deleteById($id);

        echo '<p class="text-center">Veículo removido com sucesso.</p>';
    }
}
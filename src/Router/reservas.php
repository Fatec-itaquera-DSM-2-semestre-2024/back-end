<?php

namespace App\reservas;
require "../../vendor/autoload.php";

use App\Controller\ReservaController;

$reserva = new ReservaController();

$body = json_decode(file_get_contents('php://input'), true);
$id=isset($_GET['id'])?$_GET['id']:'';
switch($_SERVER["REQUEST_METHOD"]){
    case "POST";
        $resultado = $reserva->insert($body);
        echo json_encode(['status'=>$resultado]);
    break;
    case "GET";
        if(!isset($_GET['id'])){
            $resultado = $reserva->select();
            echo json_encode(["reservas"=>$resultado]);
        }else{
            $resultado = $reserva->selectId($id);
            echo json_encode(["status"=>true,"reservas"=>$resultado[0]]);
        }
       
    break;
    case "PUT";
        $resultado = $reserva->update($body,intval($_GET['id']));
        echo json_encode(['status'=>$resultado]);
    break;
    case "DELETE";
        $resultado = $reserva->delete(intval($_GET['id']));
        echo json_encode(['status'=>$resultado]);
    break;  
}
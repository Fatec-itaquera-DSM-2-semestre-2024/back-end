<?php

namespace App\Router;
require "../../vendor/autoload.php";

use App\Controller\SoftwareController;

$software = new SoftwareController();

$body = json_decode(file_get_contents('php://input'), true);
$id = isset($_GET['id'])?$_GET['id']:'';
switch($_SERVER["REQUEST_METHOD"]){
    case "POST";
        $resultado = $software->insert($body);
        echo json_encode(['status'=>$resultado]);
    break;
    case "GET";
        if(!isset($_GET['id'])){
            $resultado = $software->select();
            echo json_encode(["software"=>$resultado]);
        }else{
            $resultado = $software->selectId($id);
            echo json_encode(["status"=>true,"software"=>$resultado[0]]);
        }
       
    break;
    case "PUT";
        $resultado = $software->update($body,intval($_GET['id']));
        echo json_encode(['status'=>$resultado]);
    break;
    case "DELETE";
        $resultado = $software->delete(intval($_GET['id']));
        echo json_encode(['status'=>$resultado]);
    break;  
}


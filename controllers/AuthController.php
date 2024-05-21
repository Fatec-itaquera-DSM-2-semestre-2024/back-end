<?php
namespace App\Controllers;

use Firebase\JWT\JWT;
use App\Models\User;

include_once __DIR__ . '/../config/database.php';
include_once __DIR__ . '/../config/jwt.php';
include_once __DIR__ . '/../models/User.php';

class AuthController {

    public function register() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $user = new User();
            $user->create($username, $password);
            echo "Usuário registrado com sucesso";
        } else {
            include '../views/auth/register.php';
        }
    }

    public function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = new User();
            $userData = $user->findByUsername($username);

            if ($userData && password_verify($password, $userData['password'])) {
                    $iss = "your_issuer";
                    $aud = "your_audience";
                    $iat = time();
                    $nbf = $iat + 10;
                    $key = "your_secret_key";

                    $token = array(
                        "iss" => $iss,
                        "aud" => $aud,
                        "iat" => $iat,
                        "nbf" => $nbf,
                        "data" => array(
                            "id" => $userData['id'],
                            "username" => $userData['username']
                        )
                    );
                    $jwt = JWT::encode($token, $key, 'HS256');
                $jwt = JWT::encode($token, $key, 'HS256');
                echo json_encode(
                    array(
                        "message" => "Login bem-sucedido",
                        "jwt" => $jwt
                    )
                );
            } else {
                echo json_encode(array("message" => "Usuário ou senha incorretos"));
            }
        } else {
            include '../views/auth/login.php';
        }
    }
}
?>

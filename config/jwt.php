<?php
require 'vendor/autoload.php';

use Firebase\JWT\JWT;

$key = "example_key"; 
$iss = "http://localhost"; 
$aud = "http://localhost"; 
$iat = time(); 
$nbf = $iat; 
?>

<?php

require  '/var/www/html/app/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable('/var/www/html/app');
$dotenv->load();
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function generateJwtToken($username, $email, $user_id) {
    $key = $_ENV['secret_key']; 
    $payload = array(
        "username" => $username,
        "email" => $email,
        'user_id' => $user_id,
        "exp" => time() + (60 * 60 * 24 * 7),
    );
    try {
        $token = JWT::encode($payload, $key, 'HS256');
        return $token;
    }catch (Exception $e){
        echo "Error: " . $e->getMessage();
    }
}

    

function jwtDecode ($jwt_token){
    $key = $_ENV['secret_key'];
    $algorithm = 'HS256';
    try{
        $decoded = JWT::decode($jwt_token, new Key($key, 'HS256'));
        return $decoded;
    }catch (Exception $e){
        echo "Error: " . $e->getMessage();
    }
}


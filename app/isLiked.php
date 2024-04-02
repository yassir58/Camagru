<?php

require  '/var/www/html/app/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable('/var/www/html/app');
$dotenv->load();
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require_once '/var/www/html/app/models/Image.php';
$imageModel = new ImageModel  ();
$image_id = $_GET['image_id'];
$key = $_ENV['secret_key'];
$jwt_token = $_COOKIE['jwt_token'];
$algorithm = 'HS256';
$decoded = JWT::decode($jwt_token, new Key($key, 'HS256'));
$isLiked = $imageModel->isLikedByUser ($image_id, $decoded);
$json = json_encode($isLiked);
echo $json;
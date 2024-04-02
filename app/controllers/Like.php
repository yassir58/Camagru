<?php
require  '/var/www/html/app/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable('/var/www/html/app');
$dotenv->load();
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class _Controller {

    public function __construct (){
        $key = $_ENV['secret_key'];
        $jwt_token = $_COOKIE['jwt_token'];
        $algorithm = 'HS256';
        try{
            $this->decoded = JWT::decode($jwt_token, new Key($key, 'HS256'));
        }catch (Exception $e){
            echo "Error: " . $e->getMessage();
        }
    }

    
    public function like ($image_id){
        require_once '/var/www/html/app/models/Image.php';
        $imageModel = new ImageModel ();
        $user = $this->decoded;
        $err = $imageModel->addLike ($image_id, $user);
        if ($err == 0)
        {
            header("Location: /");
            exit();
        }
        else
            echo 'Err: failed to create like' ;
    }
}

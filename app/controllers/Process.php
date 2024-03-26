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

    public function process (){

        if (isset($_POST['imageData'])) {
            // Decode and save the image data to a file
        $imageData = $_POST['imageData'];
        $encodedData = substr($imageData, strpos($imageData, ',') + 1);
        $decodedData = base64_decode($encodedData);
        $hash = substr (hash('sha256', time ()), 0, 32);
        $photoName = "/var/www/html/app/uploads/" . $hash . ".png";
        file_put_contents($photoName, $decodedData);
        require_once '/var/www/html/app/models/Image.php';
        $imageModel = new _Controller ();
        $fileSrc = "/images/" .$hash . ".png";
        require_once "/var/www/html/app/models/Image.php";
        $imageModel = new ImageModel ();
        $err = $imageModel->addImage ($fileSrc, $this->decoded);
        if (!$err)
            echo 'Image record created successfully!';
        else 
            echo 'Failed to create image record';
        //TODO : upload photo to server an push photo url to database
        echo "Photo saved successfully!";
        } else {
            echo "No image data received!";
        }
        return $imageData;
    }
}

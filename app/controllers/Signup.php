<?php
require  '/var/www/html/app/vendor/autoload.php';



use Firebase\JWT\JWT;
use Firebase\JWT\Key;
$dotenv = Dotenv\Dotenv::createImmutable('/var/www/html/app');
$dotenv->load();

function generateJwtToken($username, $email) {
    $key = $_ENV['secret_key']; 
    $payload = array(
        "username" => $username,
        "email" => $email,
        "exp" => time() + (60 * 60 * 24 * 7),
    );
    try {
        $token = JWT::encode($payload, $key, 'HS256');
        return $token;
    }catch (Exception $e){
        echo "Error: " . $e->getMessage();
    }
}



class _Controller {

    public function __construct (){
        require_once '/var/www/html/app/models/Database.php';
        $this->db = new Database ();
    }

    public function index (){
        if (isset($_COOKIE['jwt_token']))
        {
            //TODO check if jwt_token is valid
            header("Location: /");
            exit(); 
        }
        else
            require_once '/var/www/html/app/views/signup.php';
    }
    public function post ($username, $email, $password){
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $err = $this->db->create_user ($username, $email, $hashed_password);
        if ($err == 0){
            $jwt_token = generateJwtToken($username, $email);
            setcookie('jwt_token', $jwt_token, time() + (60 * 60 * 24), '/');
            header("Location: /");
            exit(); 
        }
    }
}
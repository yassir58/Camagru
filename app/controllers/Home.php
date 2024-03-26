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
    public function index() {
        // Load model
        require_once '/var/www/html/app/models/User.php';
        $userModel = new UserModel();
        $users = $userModel->getAllUsers();
        require_once '/var/www/html/app/views/home.php';
    }


    public function middleware (){
        //TODO check if jwt_token is valid
        if (isset($_COOKIE['jwt_token']))
        {
            require_once '/var/www/html/app/models/User.php';
            $userModel = new UserModel ();
            if ($userModel->getUserByEmail ($this->decoded->email))
                require_once '/var/www/html/app/views/home.php';
            else
            {
                setcookie('jwt_token', '', time() - 1, '/');
                header("Location: /login");
                exit();
            }
        }
        else{
            header("Location: /login");
            exit(); 
        }
    }

    
}
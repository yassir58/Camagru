<?php
class _Controller {
    public function index() {
        // Load model
        require_once '/var/www/html/app/models/User.php';
        $userModel = new UserModel();

        // Get data from model
        $users = $userModel->getAllUsers();

        // Load view
        require_once '/var/www/html/app/views/home.php';
    }

    public function middleware (){
        //TODO check if jwt_token is valid
        if (isset($_COOKIE['jwt_token']))
            require_once '/var/www/html/app/views/home.php';
        else{
            header("Location: /login");
            exit(); 
        }
    }

    
}
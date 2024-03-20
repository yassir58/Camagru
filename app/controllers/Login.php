<?php

require '/var/www/html/app/utils/helpers.php';

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
            require_once '/var/www/html/app/views/login.php';  
    }

    public function post ($email, $password){
        require_once '/var/www/html/app/models/User.php';
        $userModel = new UserModel ();
        $user = $userModel->getUserByEmail ($email);
        $err = [
            'error' => "No user found with this email" ,
        ];
        if ($user)
        {
            if (password_verify ($password, $user->password)){
                $jwt_token = generateJwtToken($user->username, $user->email);
                setcookie('jwt_token', $jwt_token, time() + (60 * 60 * 24), '/');
                header("Location: /");
                exit(); 
            }
            return null;
        }
        else
            return null;
    }
}
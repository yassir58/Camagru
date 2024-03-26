<?php

class _Controller {
    public function post (){
        setcookie('jwt_token', '', time() - 1, '/');
        header("Location: /login");
        exit();
    }
}
<?php

class Database {
    private $host = 'camagru-db';
    private $username = 'camagru-user';
    private $password = 'test@123@123';
    private $db_name = 'camagru-db';
    private $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function create_user ($username, $email, $password){
        $sql = "INSERT INTO Users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $username, $email, $password);

        if ($stmt->execute())
            return 0;
        else 
            return -1;
        $stmt->close();
    }

    public function getConnection (){
        return $this->conn;
    }
    public function query($sql) {
        return $this->conn->query($sql);
    }

    public function close() {
        $this->conn->close();
    }
}

?>
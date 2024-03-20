<?php
class UserModel {

    public function __construct (){
        require_once '/var/www/html/app/models/Database.php';
        $this->db = new Database ();
    }

    public function getAllUsers() {
        // Replace with actual database query
        return [
            ['id' => 1, 'name' => 'John Doe'],
            ['id' => 2, 'name' => 'Jane Smith']
        ];
    }
    
        public function createUser ($username, $email, $password){
    
        }

        public function getUserByName ($username){

        }

        public function getUserByEmail ($email){
            $sql = "SELECT * FROM Users WHERE email = ?";
            $connection = $this->db->getConnection ();
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0){
                $user = $result->fetch_object();
                return $user;
            }
            return null;
        }

        public function verifyCredentials ($email, $password){

        }
}

?>

<?php

class ImageModel {

    public function __construct (){
        require_once "/var/www/html/app/models/Database.php";
        $this->db = new Database ();
    }
    public function AddImage ($image_url, $user){
        $connection = $this->db->getConnection ();
        $user_id = $user->user_id;
        $sql = "INSERT INTO Images (user_id, image_url) VALUES (?, ?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("is", $user_id, $image_url);
        if ($stmt->execute() === TRUE) {
            return 0;
        } else {
            return -1;
        }
        $stmt->close();
    }

    public function getAllImages (){
        $connection = $this->db->getConnection ();
        $sql = "SELECT * FROM Images";
        $result = $connection->query($sql);
        if ($result->num_rows > 0){
            $images = array();
            while ($row = $result->fetch_assoc()) {
                $images[] = $row;
            }
            return $images;
        }
        return null;
    }
}

?>

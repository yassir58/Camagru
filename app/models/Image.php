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

    public function AddComment ($image_id, $user, $comment_text){
        $connection = $this->db->getConnection ();
        $user_id = $user->user_id;
        $sql = "INSERT INTO Comments (user_id, image_id, comment_text) VALUES (?, ?, ?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("iis", $user_id, $image_id, $comment_text);
        if ($stmt->execute() === TRUE) {
            return 0;
        } else {
            return -1;
        }
        $stmt->close();
    }

    public function isLikedByUser ($image_id, $user){
        $connection = $this->db->getConnection ();
        $user_id = $user->user_id;
        $sql = "SELECT * FROM Likes WHERE user_id = ? AND image_id = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ii", $user_id, $image_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $userLiked = $result->num_rows > 0;
        $stmt->close();
        return $userLiked;
    }

    public function AddLike ($image_id, $user){
        $connection = $this->db->getConnection ();
        $user_id = $user->user_id;
        $sql = "INSERT INTO Likes (user_id, image_id) VALUES (?, ?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ii", $user_id, $image_id);
        if ($stmt->execute() === TRUE) {
            return 0;
        } else {
            return -1;
        }
        $stmt->close();
    }


    public function getImageComments ($image_id){
        $connection = $this->db->getConnection ();
        $sql = "SELECT * FROM Comments WHERE image_id = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("i", $image_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $comments = array();
        while ($row = $result->fetch_assoc()) {
            $comments[] = $row;
        }
        $stmt->close();
        return $comments;
    }

    public function getImageLikes ($image_id){
        $connection = $this->db->getConnection ();
        $sql = "SELECT * FROM Likes WHERE image_id = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("i", $image_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $likes = array();
        while ($row = $result->fetch_assoc()) {
            $likes[] = $row;
        }
        $stmt->close();
        return $likes;
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

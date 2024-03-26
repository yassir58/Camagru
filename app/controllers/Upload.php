<?php

class _Controller {

    public function post ($_FILE){
        require_once '/var/www/html/app/models/User.php';
        require  '/var/www/html/app/utils/helpers.php';
        $jwt_token = $_COOKIE['jwt_token'];
        $decoded = jwtDecode ($jwt_token);
        $userModel = new UserModel ();
        $user = $userModel->getUserByEmail ($decoded->email);
        $targetDirectory = "/var/www/html/app/uploads/";
        $targetPath ='/images/';
        $targetFile = $targetDirectory . basename($_FILE["name"]);
        $fileSrc = $targetPath . basename($_FILE["name"]);
        $check = getimagesize($_FILE["tmp_name"]);
        if ($check !== false) {
            if (file_exists($targetFile)) {
                echo "Sorry, file already exists.";
            } else {
                if (move_uploaded_file($_FILE["tmp_name"], $targetFile)) {
                    echo "The file " . htmlspecialchars(basename($_FILE["name"])) . " has been uploaded.";
                    require_once "/var/www/html/app/models/Image.php";
                    $imageModel = new ImageModel ();
                    $err = $imageModel->addImage ($fileSrc, $user);
                    if (!$err)
                        echo 'Image record created successfully!';
                    else 
                        echo 'Failed to create image record';
                    header("Location: /");
                    exit(); 
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }
        else {
            echo "File is not an image.";
        }
    }
}
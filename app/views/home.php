<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?php 
    require  '/var/www/html/app/utils/helpers.php';
    $jwt_token = $_COOKIE['jwt_token'];
    $decoded = jwtDecode ($jwt_token);
?>


    <h1>Welcome back <?= $decoded->username ?> </h1>
    <h2>Upload Image</h2>
    <form action="/upload" method="post" enctype="multipart/form-data">
        <input type="file" name="image">
        <input type="submit" name="submit" value="Upload">
    </form>

<div>
    <?php
        require_once "/var/www/html/app/models/Image.php";
        $imageModel = new ImageModel ();
        $images = $imageModel->getAllImages();
        foreach ($images as $image){
            echo "<div>";
            echo "<p>Image ID: " . $image["image_id"] . "</p>";
            echo "<p>User ID: " . $image["user_id"] . "</p>";
            echo "<img src='" . $image["image_url"] . "' alt='Image'>";
            echo "<p>Created At: " . $image["created_at"] . "</p>";
            echo "</div>";
        }
    ?>
</div>        
</body>
</html>
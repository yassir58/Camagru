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
    
    <form method="post" action='/logout'>
    <input type="submit" name="submit" value="Logout">
    </form>
    <h2>Upload Image</h2>
    <form action="/upload" method="post" enctype="multipart/form-data">
        <input type="file" name="image">
        <input type="submit" name="submit" value="Upload">
    </form>
    <h1>Take Photo</h1>
    <video id="video" autoplay></video>
    <button id="snap">Snap Photo</button>
    <canvas id="canvas" style="display: none;"></canvas>
    <script>
        // Access the webcam and display video stream
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(function(stream) {
                var video = document.getElementById('video');
                video.srcObject = stream;
                video.play();
            })
            .catch(function(err) {
                console.log("An error occurred: " + err);
            });

        // Capture and display the photo when the snap button is clicked
        document.getElementById('snap').addEventListener('click', function() {
            var video = document.getElementById('video');
            var canvas = document.getElementById('canvas');
            var context = canvas.getContext('2d');
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            var imageData = canvas.toDataURL('image/png');

            // Send the image data to a PHP script for processing or storage
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/process', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('imageData=' + encodeURIComponent(imageData));
        });
    </script>

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
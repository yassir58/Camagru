<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"  type="text/css" href="/css/styles.css">
    <link rel="stylesheet"  type="text/css" href="/css/icono.min.css">
    <script src="/js/index.js"></script>
    <title>Document</title>
</head>
<body>
    
    <?php 
    require  '/var/www/html/app/utils/helpers.php';
    $jwt_token = $_COOKIE['jwt_token'];
    $decoded = jwtDecode ($jwt_token);
?>


    <section class="root" id='root'>
        <header class='header'>
            <a href="/" class='logo'>
                UnslashBox
            </a>
           <div class="nav">
           <button class='primaryBtn borderGradiant'><?= $decoded->username ?></button>
            <small-button></small-button>  
            <upload-modal></upload-modal>
            <form method="post" action='/logout'>
            <input type="submit" name="submit" value="Logout" class='darkButton'>
            </form>
           </div>
        </header>
    <main class='main'> 
        <div class="gradiantSection">
            <search-form></search-form>
        </div>
    
<div class='gallery'>
    <?php
        require_once "/var/www/html/app/models/Image.php";
        $imageModel = new ImageModel ();
        $images = $imageModel->getAllImages();
        foreach ($images as $image){
            echo "<post-card image_id='" . $image["image_id"] . "' src='" . $image["image_url"] . "' alt='Image' ></post-card>";
        }
    ?>
</div>  
    </main>    
    </section>  
</body>
</html>
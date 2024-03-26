<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Variables</title>
</head>
<body>
    <?php
		$url = $_SERVER['REQUEST_URI'];
        $controller_name = 'Home';
        $action_name = 'index';
        
        if (preg_match('/\/([a-z]+)/i', $url, $matches))
            $controller_name = ucfirst($matches[1]);
        if (preg_match('/\/([a-z]+)/i', $url, $matches))
            $action_name = $matches[1];
        $controller_file = 'controllers/' . $controller_name . '.php';
        if (file_exists($controller_file))
        {
            require_once $controller_file;
            $homeController = new _Controller();
             if ($_SERVER["REQUEST_METHOD"] == 'POST'){
                if ($controller_name == 'Signup'){
                    if (!empty($_POST)) 
                        $homeController->post ($_POST['username'], $_POST['email'], $_POST['password']);
                    else 
                        echo "No data submitted via POST method.";
                }else if ($controller_name == 'Upload'){
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
                        require_once "/var/www/html/app/controllers/Upload.php";
                        $homeController = new _Controller ();
                        $homeController->post ($_FILES['image']);
                    }
                } else if ($controller_name == 'Logout'){
                    require_once '/var/www/html/app/controllers/Logout.php';
                    $homeController = new _Controller ();
                    $homeController->post ();
                }
                else{
                    if (!empty ($_POST)){
                       $status = $homeController->post ($_POST['email'], $_POST['password']);
                       if (!$status){
                        echo "User not found";
                       }
                    }
                }
             }else if ($controller_name == 'Home')
                $homeController->middleware ();
            else
                $homeController->index();
        }
        else
            include ('not-found.php');
	?>
    
</body>
</html>
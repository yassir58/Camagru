<?php

$image_id = $_GET['image_id'];
require_once '/var/www/html/app/models/Image.php';
$imageModel = new ImageModel  ();
$data = $imageModel->getImageComments ($image_id);
$json = json_encode($data);
header('Content-Type: application/json');
echo $json;
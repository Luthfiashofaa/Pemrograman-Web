<?php

include 'Traits/ResponseFormatter.php'; // Menggunakan include
include 'WebKos/Kos.php'; // Menggunakan include
include 'WebKos/KosPutra.php'; // Menggunakan include
include 'WebKos/KosPutri.php'; // Menggunakan include
include 'Controllers/KosController.php'; // Menggunakan include

use Controller\KosController;

$kosController = new KosController();
header('Content-Type: application/json');


$response = $kosController->getAllKos();


echo $response;
?>

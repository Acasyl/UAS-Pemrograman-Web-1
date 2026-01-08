<?php
session_start();

$url = $_GET['url'] ?? 'home';
$url = explode('/', $url);

require_once 'config/database.php';

switch ($url[0]) {
    case 'login':
        require 'controllers/AuthController.php';
        (new AuthController)->login();
        break;

    case 'register':
        require 'controllers/AuthController.php';
        (new AuthController)->register();
        break;

    case 'profile':
        require 'controllers/profile_Controller.php';
        if (isset($url[1]) && $url[1] === 'update-photo') {
            (new ProfileController)->updatePhoto();
        } elseif (isset($url[1]) && $url[1] === 'update-name') {
            (new ProfileController)->updateName();
        } else {
            (new ProfileController)->index();
        }
        break;

    case 'logout':
        session_destroy();
        header('Location: login');
        break;

    case 'admin':
        require 'controllers/KonserController.php';
        (new KonserController)->index();
        break;

    case 'pesanan-saya':
        require 'controllers/PesananController.php';
        (new PesananController)->my();
        break;

    case 'pesan':
        require 'controllers/PesananController.php';
        (new PesananController)->pesan($url[1]);
        break;

    default:
        require 'controllers/KonserController.php';
        (new KonserController)->home();
}
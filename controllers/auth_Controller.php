<?php
require_once 'models/user.php';

class AuthController {
    public function login() {
        // If already logged in, go to the appropriate page
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user']['role'] === 'admin') {
                header('Location: /Tiket_konser/admin');
                exit;
            }
            header('Location: /Tiket_konser/');
            exit;
        }
        if ($_POST) {
            $user = (new User)->login($_POST['email']);

            if ($user && password_verify($_POST['password'], $user['password'])) {
                $_SESSION['user'] = $user;
                // Redirect based on role
                if ($user['role'] === 'admin') {
                    header('Location: /Tiket_konser/admin');
                } else {
                    header('Location: /Tiket_konser/');
                }
                exit;
            } else {
                $error = "Login gagal!";
            }
        }
        require 'views/auth/login.php';
    }

    public function register() {
        if ($_POST) {
            (new User)->register([
                $_POST['nama'],
                $_POST['email'],
                password_hash($_POST['password'], PASSWORD_DEFAULT),
                'user'
            ]);
            header('Location: /Tiket_konser/login');
            exit;
        }
        require 'views/auth/register.php';
    }
}

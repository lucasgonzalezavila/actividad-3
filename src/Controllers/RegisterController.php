<?php

namespace App\Controllers;

use App\Request;
use App\Controller;
use App\View;
use App\Registry;
use App\Database\QueryBuilder;

class RegisterController extends Controller {
    public function __construct($session, $request) {
        parent::__construct($session, $request); 
    }

    public function index(){
        if ($this->request->isPost()) {
            $username = isset($_POST['username']) ? $_POST['username'] : null;
            $password = isset($_POST['password']) ? $_POST['password'] : null;
            $email = isset($_POST['email']) ? $_POST['email'] : null;
            $role = isset($_POST['role']) ? $_POST['role'] : null;
            if (empty($username) || empty($email) || empty($password)) {
                echo "Por favor, completa todos los campos correctamente.";
                return;
            }
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $fechaExpiracionSuscription = date('Y-m-d', strtotime('+30 days'));
            $db = Registry::get('database');
            $queryBuilder = new QueryBuilder($db);
            $existingUser = $queryBuilder->select('User',['email' => $email],['id']);

            if ($existingUser) {
                echo "El nombre de usuario o el correo electrónico ya están en uso.";
                return;
            }
            $success = $queryBuilder->insert('User', [
                'username' => $username,
                'password' => $hashedPassword,
                'email' => $email,
                'role' => $role, 
                'subscription_end_date' => $fechaExpiracionSuscription
            ]);

            if ($success) {
                echo "Registro exitoso. ¡Bienvenido, $username!";
                header('Location: catalog');
            } else {
                echo "Error al registrar el usuario. Por favor, inténtalo de nuevo.";
            }
        } else {
            echo View::render('register');
        }
    }
}

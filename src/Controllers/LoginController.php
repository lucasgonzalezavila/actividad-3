<?php

namespace App\Controllers;

use App\Controller;
use App\View;
use App\Database\QueryBuilder;
use App\Registry;

class LoginController extends Controller
{
    public function __construct($session, $request)
    {
        parent::__construct($session, $request);
    }

    public function index()
    {
        if ($this->request->getMethod() === 'POST') {
            $correo = isset($_POST['correo']) ? trim($_POST['correo']) : null;
            $password = isset($_POST['password']) ? trim($_POST['password']) : null;

            if (!empty($correo) && !empty($password)) {
                $db = Registry::get('database');
                $queryBuilder = new QueryBuilder($db);
                $users = $queryBuilder->select('User', ['email' => $correo]);

                if ($users) {
                    $user = $users[0];
                    if (password_verify($password, $user->password)) {
                        $_SESSION['user_id'] = $user->id;
                        header('Location: catalog');
                        exit();
                    } else {
                        echo "Credenciales incorrectas";
                    }
                } else {
                    echo "El usuario no existe o las credenciales son incorrectas";
                }
            } else {
                echo "Por favor, ingrese correo y contraseña";
            }
        } else {
            echo View::render('login');
        }
    }
}


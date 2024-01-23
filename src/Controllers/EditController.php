<?php

namespace App\Controllers;

use App\Controller;
use App\View;
use App\Registry;
use App\Database\QueryBuilder;

class EditController extends Controller{
    public function __construct($session, $request) {
        parent::__construct($session, $request); 
    }

    public function index(){
        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
            $db = Registry::get('database');
            $queryBuilder = new QueryBuilder($db);
            $user = $queryBuilder->select('User',['id' => $userId]);
            $user = $user[0];
            if ($user) {
                if ($this->request->isPost()) {
                    if ($password === $repeatPassword) {
                        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                        $queryBuilder->update('User', ['password' => $hashedPassword], ['id' => $userId]);
                        echo "Contraseña cambiada exitosamente";
                        header('Location: catalog');
                    } else {
                        echo "Las contraseñas no coinciden";
                    }
                }
                echo View::render('edit', ['user' => $user]);
            } else {
                echo "Usuario no encontrado";
            }
        } else {
            header('Location: /login');
            exit();
        }
    }
}

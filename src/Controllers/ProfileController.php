<?php
    namespace App\Controllers;

    use App\Request;
    use App\Controller;
    use App\View;
    use App\Registry;
    use App\Database\QueryBuilder;

    class ProfileController extends Controller {
        function __construct($session,$request){
            parent::__construct($session,$request); 
        }
        public function index()
    {
        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
            $db = Registry::get('database');
            $queryBuilder = new QueryBuilder($db);

            $user = $queryBuilder->select('User',['id' => $userId]);
            $user= $user[0];
            echo View::render('profile', ['user' => $user]);
        } else {
            header('Location: /login');
            exit();
        }
    }       
    }
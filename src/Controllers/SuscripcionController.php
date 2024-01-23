<?php
    namespace App\Controllers;

    use App\Request;
    use App\Controller;
    use App\View;
    use App\Registry;
    use App\Database\QueryBuilder;

class SuscripcionController extends Controller{

    public function __construct($session, $request) {
        parent::__construct($session, $request); 
    }

    public function index(){
        $db = Registry::get('database');
        $queryBuilder = new QueryBuilder($db);
        if ($this->request->isPost()) {
            $userId = $_SESSION['user_id'];

            if ($queryBuilder !== null) {
                $currentDate = date('Y-m-d H:i:s');
                $subscriptionEndDate = date('Y-m-d H:i:s', strtotime($currentDate . ' + 30 days'));
                $queryBuilder->update('User',['subscription_end_date' => $subscriptionEndDate], ['id' => $userId]);
                header("Location: catalog");
                exit();
            } else {
                echo "Error: El objeto QueryBuilder es nulo.";
            }
        }
        echo View::render('suscripcion');
    }
}

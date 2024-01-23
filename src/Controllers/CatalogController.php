<?php

namespace App\Controllers;

use App\Controller;
use App\View;
use App\Database\Connection;
use App\Database\QueryBuilder;
use App\Registry;

class CatalogController extends Controller
{
    function __construct($session, $request)
    {
        parent::__construct($session, $request);
    }

    function index(){
        if ($this->isUserSubscribed()) {
            $db = Registry::get('database');
            $books = $db->selectAll('Book');

            echo View::render('catalog', ['books' => $books]);
        } else {
            header('Location: suscripcion');
            exit();
        }
    }

    private function isUserSubscribed() {
        $userId = $_SESSION['user_id'];

        if ($userId) {
            $db = Registry::get('database');
            $queryBuilder = new QueryBuilder($db);

            $field=['subscription_end_date'];
            $subscriptionEndDate = $queryBuilder->select('User', ['id' => $userId], ['subscription_end_date']);
            $subscriptionEndDate=$subscriptionEndDate[0];
            if ($subscriptionEndDate && strtotime($subscriptionEndDate->subscription_end_date) >= time()) {
                return true;
            }
        }
        return false;
    }
}

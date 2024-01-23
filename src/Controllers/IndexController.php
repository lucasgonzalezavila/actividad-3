<?php

namespace App\Controllers;

use App\Request;
use App\Controller;
use App\View;
use App\Database\Connection;

class IndexController extends Controller {

    function index(){
        

        echo View::render('home');
    }
    
}

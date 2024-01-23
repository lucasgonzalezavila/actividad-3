<?php

namespace App\Controllers;

use App\Request;
use App\Controller;
use App\View;
use App\Database\Connection;
use App\Database\QueryBuilder;
use App\Registry;

class BookController extends Controller {

    public function read() {
        $id = $this->request->getParam();

        if (is_numeric($id)) {
            $db = Registry::get('database');
            $queryBuilder = new QueryBuilder($db);

            $book = $queryBuilder->select('Book',['id' => $id]);
            $book = $book[0];

            if ($book) {
                echo View::render('book', ['book' => $book]);
            } else {
                echo "Book not found.";
            }
        } else {

            echo "Invalid parameter. Please provide a numeric ID.";
        }
    }

    // ...
}

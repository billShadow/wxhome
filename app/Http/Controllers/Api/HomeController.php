<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $dbs = new \PDO('mysql:host=127.0.0.1;dbname=wxsmall','wxsmall','wxsmall!@#');
        var_dump($dbs);
    }
}

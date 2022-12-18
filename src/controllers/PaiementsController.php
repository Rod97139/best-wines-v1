<?php

namespace App\Controllers;

use Core\Controller;



class PaiementsController extends Controller
{

    public function index()
    {

        $this->renderView('employe/paiements/index');
    }
}

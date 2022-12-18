<?php

namespace App\Controllers;

use Core\Controller;



class OrderTrackingController extends Controller
{

    public function showAll()
    {

        $this->renderView('employe/commandes/index');
    }
    public function showOne()
    {

        $this->renderView('employe/commandes/details');
    }
}

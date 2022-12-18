<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\User;
use App\Models\Sale;
use App\Models\Invoice;
use Core\Partials\CheckLog;


class InvoiceController extends Controller{

// Function qui rencoit l'historique des commandes pour un utilisateur
public function showOrders(){
    CheckLog::checkClientIsLogged();
    $invoice = new Invoice();
    $all_invoices = $invoice->findInvoiceByUser();

    
    $this->renderView('user/compte', compact('all_invoices'));
}



}

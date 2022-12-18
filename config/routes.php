<?php

use App\Controllers\ProductController;
use Core\Router;

//Home
Router::register('/', 'HomeController::showLast');

// show all products 
Router::register('/nos-vins', 'ProductController::showAllWines');
Router::register('/nos-coffrets', 'ProductController::showAllboxes');

// product wines
Router::register('/nos-vins/blanc', 'ProductController::showAllWhiteWines');
Router::register('/nos-vins/rouge', 'ProductController::showAllRedWines');
Router::register('/nos-vins/nos-champagnes', 'ProductController::showAllChampagne');
Router::register('/nos-vins/detail', 'ProductController::showOne');

//product cart
Router::register('/cart', 'CartController::index');
Router::register('/cart/add', 'CartController::addProduct');
Router::register('/cart/remove', 'CartController::removeProduct');
Router::register('/cart/empty', 'CartController::emptyCart');


// Fournisseur 
Router::register('/nos-fournisseurs', 'SupplierController::showFournisseur');
Router::register('/nos-fournisseurs/details', 'SupplierController::showOne');
Router::register('/nos-fournisseurs/insert', 'SupplierController::insertSupplier');
Router::register('/nos-fournisseurs/edit', 'SupplierController::EditSupplier');

// Qui-sommes-nous
Router::register('/nous-contacter', 'PresentationController::showContact');
Router::register('/faq', 'PresentationController::showFaq');
Router::register('/mentions-legales', 'PresentationController::showMention');
Router::register('/presse', 'PresentationController::showPresse');
Router::register('/qui-sommes-nous', 'PresentationController::showAboutUS');

// Blog / articles
Router::register('/blog', 'BlogController::showArticle');
Router::register('/blog/insert', 'BlogController::insertArticle');
Router::register('/blog/edit', 'BlogController::editArticle');
Router::register('/blog/details', 'BlogController::detailArticle');

// user
Router::register('/login', 'UserController::login');
Router::register('/register', 'UserController::insert');
Router::register('/logout', 'UserController::logout');
Router::register('/region', 'StockController::showAllRegion');

// Accueil espace employé
Router::register('/employe', 'StockController::index');

// Accueil espace client
Router::register('/mon-compte', 'InvoiceController::showOrders');
Router::register('/mon-compte/details', 'SaleController::showSales');

// espace employé Commandes
Router::register('/employe/commandes', 'OrderTrackingController::showAll');
Router::register('/employe/commandes/details', 'OrderTrackingController::showOne');

// Gestion des paiements
Router::register('/employe/paiements', 'PaiementsController::index');
Router::register('/pay', 'PayController::index');
Router::register('/pay/paypal', 'PayController::paypal');
Router::register('/pay/stripe', 'PayController::stripePayment');
Router::register('/pay/success', 'PayController::success');
Router::register('/pay/stripe-webhook', 'PayController::webhook');



// Gestion des stocks
Router::register('/employe/stock', 'StockController::showAll');
Router::register('/employe/stock/insert', 'StockController::insert');
Router::register('/employe/stock/edit', 'StockController::edit');
Router::register('/employe/stock/delete', 'StockController::delete');

// Gestion des codes promos
Router::register('/employe/promotion', 'PromotionController::showAll');
Router::register('/employe/promotion/insert', 'PromotionController::insert');
Router::register('/employe/promotion/edit', 'PromotionController::edit');

// Gestion des salariés
Router::register('/administrateur', 'AdminController::showAll');
Router::register('/administrateur/insert', 'AdminController::insertEmployee');
Router::register('/administrateur/edit', 'AdminController::edit');
Router::register('/administrateur/delete', 'AdminController::delete');

// A rajouter & | à modifier
//
// - Home (http://bestwines.fr)
// - Nos vins (http://bestwines.fr/nos-vins)
// - Nos coffrets (http://bestwines.fr/nos-coffrets)
// - Nos fournisseurs (http://bestwines.fr/nos-fournisseurs)
// - Qui sommes-nous ? (http://bestwines.fr/qui-sommes-nous)
// - Blog (http://bestwines.fr/blog)
// - Espace Client (http://bestwines.fr/mon-compte)
// En plus de ces pages principales, les pages suivantes doivent être accessibles depuis le footer :
// - Nos vins (http://bestwines.fr/nos-vins)
// o Nos rouges
// o Nos blancs
// o Nos champagnes
// - Nos coffrets (http://bestwines.fr/nos-coffrets)
// - Aide
// o FAQ
// o Mentions légales (http://bestwines.fr/mentions-legales)
// o Contact (http://bestwines.fr/nous-contacter)
// - Presse (http://bestwines.fr/presse)
// - Qui sommes-nous ? (http://bestwines.fr/qui-sommes-nous)
// - Blog (http://bestwines.fr/blog)

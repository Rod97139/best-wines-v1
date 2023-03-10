<?php

namespace App\Controllers;

use Core\Controller;

use App\Models\Region;
use App\Models\Cepage;
use App\Models\Taste;
use App\Models\Association;
use App\Models\TypeProduct;
use App\Models\Product;

class ProductController extends Controller
{
    //Tous les coffrets 
    public function showAllBoxes()
    {
        $product = new Product();
        $products = $product->findAllProductBy(['id_type' => 4]);
        $this->renderView('product/Boxs/boxAllProduct', compact('products'));
    }

    //Tous les vins
    public function showAllWines()
    {

        
        $product = new Product();
        $id_products = $product->findAll();
        $products = $product->findAllProduct();


        $this->renderView('product/wines/allProductWines', compact('products', 'id_products'));
    }

    // tous les vins rouges  id_type = 2 
    public function showAllRedWines()
    {
        $product = new Product();
        $products = $product->findAllProductBy(['id_type' => 2]);
        $this->renderView('product/wines/allProductRed', compact('products'));
    }


    // tous les vins blancs
    public function showAllWhiteWines()
    {
        $product = new Product();
        $products = $product->findAllProductBy(['id_type' => 1]);
        $this->renderView('product/wines/allProductWhite', compact('products'));
    }

    // tous les champagnes
    public function showAllChampagne()
    {
        $product = new Product();
        $products = $product->findAllProductBy(['id_type' => 3]);
        $this->renderView('product/wines/allProductChampagnes', compact('products'));
    }


    public function showLast()
    {
        $product = new Product();
        $lastWhiteWine = $product->findLastBy(['id_type' => 1]);
        $lastRedWine = $product->findLastBy(['id_type' => 2]);
        $lastChampagne = $product->findLastBy(['id_type' => 3]);
        $lastBox = $product->findLastBy(['id_type' => 4]);
        $this->renderView('home/index', compact('lastWhiteWine', 'lastRedWine', 'lastChampagne', 'lastBox'));
    }
    public function showOne()
    {   
        $id = $_GET['id'];
        $product = new Product();

        $lastWhiteWine = $product->findLastBy(['id_type' => 1]);
        $lastRedWine = $product->findLastBy(['id_type' => 2]);
        $lastChampagne = $product->findLastBy(['id_type' => 3]);
        $lastBox = $product->findLastBy(['id_type' => 4]);


        $products = $product->findOneBy(['id' => $id]);

        $this->renderView('product/details', compact('products', 'lastWhiteWine', 'lastRedWine', 'lastChampagne', 'lastBox'));
    }
}

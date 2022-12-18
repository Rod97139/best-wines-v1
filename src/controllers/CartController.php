<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\Product;



class CartController extends Controller
{

	public function index()
    {
        $this->renderView('cart/index');
    }

    public function addProduct()
    { 
        $product = new Product; 

        $id = $_GET['id'];
        
        if(!empty($_POST["qty"])) {
			$productById = $product->findOneItemBy(['id' => $id]);
			

			$itemArray = array($productById->name => array('name'=>$productById->name, 'id'=>$productById->id, 'quantity'=>$_POST["qty"], 'price'=>$productById->price, 'image'=>$productById->photo));

			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productById->name,array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v ) {
							if($productById->name == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["qty"];
							}
					}
					
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}

		header('Location: /best-wines/cart');
		exit;
       
    }


    public function removeProduct()
    {		
        if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["id"] == $v['id'])
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}

        header('Location: /best-wines/cart');
		exit;
       
    }

    public function emptyCart()
    {
		unset($_SESSION["cart_item"]);
	
		header('Location: /best-wines/cart');
		exit;
    }

}

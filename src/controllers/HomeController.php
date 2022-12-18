<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\Product;
use App\Models\Article;
class HomeController extends Controller
{



    public function showLast()
    {
        
        $product = new Product();
        $lastarticles = new Article;
        $articles = $lastarticles->findLast();
        
    

        $lastWhiteWine = $product->findLastBy(['id_type' => 1]);
        $lastRedWine = $product->findLastBy(['id_type' => 2]);
        $lastChampagne = $product->findLastBy(['id_type' => 3]);
        $lastBox = $product->findLastBy(['id_type' => 4]);


        $featuredWhiteWine = $product->findFeaturedBy(['id_type' => 1, ]);
        $featuredRedWine = $product->findFeaturedBy(['id_type' => 2]);
        $featuredChampagne = $product->findFeaturedBy(['id_type' => 3]);
        $featuredBox = $product->findFeaturedBy(['id_type' => 4]);
        $this->renderView('home/index', compact('articles','lastWhiteWine','featuredWhiteWine', 'featuredRedWine','featuredChampagne', 'featuredBox','lastRedWine', 'lastChampagne', 'lastBox'));

        if (isset($_REQUEST["term"])) {
            // Prepare a select statement
            $sql = "SELECT * FROM product WHERE name LIKE ?";
        
            if ($stmt = $this->pdo->prepare($sql)) {
                // Bind variables to the prepared statement as parameters
               
               
                // Set parameters
                $param_term = $_REQUEST["term"] . '%';
                $stmt->bindParam($stmt, "s", $param_term);
        
                // Attempt to execute the prepared statement
                if (  $stmt->execute) {
                    $result = $stmt;
        
                    // Check number of rows in the result set
                    if($stmt->rowCount() > 0){
                        while($row = $stmt->fetchAll()){
                            echo "<p>" . $row["name"] . "</p>";
                        }
                    } else{
                        echo "<p>No matches found</p>";
                    }
            }
        
           
        }
        
      

    }
    }
}

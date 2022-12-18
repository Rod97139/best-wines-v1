<?php

namespace App\Models;

use Core\Model;

class Sale extends Model
{

    private int $id;
    private int $id_product;
    private int $id_user;
    private int $quantity_sold;
    private float $price_total_product;
    protected string $table_name = "Sale";

    /**
     * Get the value of id
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get the value of id_product
     * @return int
     */
    public function getId_product(): int
    {
        return $this->id_product;
    }

    /**
     * Set the value of id_product
     * @param int $id_product
     *
     * @return void
     */
    public function setId_product(int $id_product): void
    {
        $this->id_product = $id_product;
    }

    /**
     * Get the value of id_user
     * @return int
     */
    public function getId_user(): int
    {
        return $this->id_user;
    }

    /**
     * Set the value of id_user
     * @param int $id_user
     * @return void
     */
    public function setId_user(int $id_user): void
    {
        $this->id_user = $id_user;
    }

    /**
     * Get the value of quantity_sold
     * @return int
     */
    public function getQuantity_sold(): int
    {
        return $this->quantity_sold;
    }

    /**
     * Set the value of quantity_sold
     * @param int $quantity_sold
     * @return  void
     */
    public function setQuantity_sold(int $quantity_sold): void
    {
        $this->quantity_sold = $quantity_sold;
    }

    /**
     * Get the value of $price_total_product
     * @return float
     */
    public function getPrice_Total_Product(): float
    {
        return $this->price_total_product;
    }

    /**
     * Set the value of price_total_product
     * @param float $price_total_product
     *
     * @return  void
     */
    public function setPrice_Total_Product(float $price_total_product): void
    {
        $this->$price_total_product = $price_total_product;
    }


    public function findProductBySale()
    {
        $sql_query = "SELECT * FROM {$this->table_name} JOIN product ON sale.id_product= product.id";
        $stmt = $this->pdo->prepare($sql_query);
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);
        $stmt->execute();
        return $stmt->fetchAll();
    
    }
}

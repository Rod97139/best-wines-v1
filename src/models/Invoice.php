<?php

namespace App\Models;


use Core\Model;

class Invoice extends Model
{

    private int $id;
    private string $date; //date ?
    private float $total_price;
    private int $id_sale;
    protected string $table_name = "invoice";

    /**
     * Get the value of id
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get the value of date
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * Set the value of date
     * 
     * @param string $date
     *
     * @return  void
     */
    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    /**
     * Get the value of total_price
     * 
     * @return float
     */
    public function getTotal_price(): float
    {
        return $this->total_price;
    }

    /**
     * Set the value of total_price
     * @param float $total_price
     *
     * @return void
     */
    public function setTotal_price(float $total_price): void
    {
        $this->total_price = $total_price;
    }

    /**
     * Get the value of id_sale
     * @return int
     */
    public function getId_sale(): int
    {
        return $this->id_sale;
    }

    /**
     * Set the value of id_sale
     *@param int $id_sale
     * @return void
     */
    public function setId_sale(int $id_sale): void
    {
        $this->id_sale = $id_sale;
    }

    public function findInvoiceByUser()
    {
        $sql_query = "SELECT * FROM {$this->table_name} JOIN sale ON invoice.id_sale = sale.id JOIN user ON sale.id_user = user.id";
        $stmt = $this->pdo->prepare($sql_query);
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);
        $stmt->execute();
        return $stmt->fetchAll();
    
    }




}

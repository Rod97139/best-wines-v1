<?php

namespace App\Models;

use Core\Model;

class Product extends Model
{

    private int $id;
    private string $name;
    private string $description;
    private float $note; //float ?
    private string $photo;
    private int $stock;
    private float $alcohol_percentage;
    private int $id_region;
    private int $id_cepage;
    private int $id_taste;
    private int $id_association;
    private int $id_comment;
    private int $id_type;
    private float $price;
    private bool $is_featured;
    protected string $table_name = "product";


    /**
     * Get the value of id
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get the value of name
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     * @param string $name
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Get the value of description
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set the value of description
     * 
     * @param string $description
     *
     * @return void
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * Get the value of note
     * @return float
     */
    public function getNote(): float
    {
        return $this->note;
    }

    /**
     * Set the value of note
     * 
     * @param float $note
     *
     * @return void
     */
    public function setNote(float $note): void
    {
        $this->note = $note;
    }

    /**
     * Get the value of photo
     * @return string
     */
    public function getPhoto(): string
    {
        return $this->photo;
    }

    /**
     * Set the value of photo
     * 
     * @param string $photo
     *
     * @return void
     */
    public function setPhoto(string $photo): void
    {
        $this->photo = $photo;
    }

    /**
     * Get the value of stock
     * 
     * @return int 
     */
    public function getStock(): int
    {
        return $this->stock;
    }

    /**
     * Set the value of stock
     * 
     * @param int $stock
     *
     * @return void
     */
    public function setStock(string $stock): void
    {
        $this->stock = $stock;
    }

    /**
     * Get the value of alcohol_percentage
     * @return float
     */
    public function getAlcohol_percentage(): float
    {
        return $this->alcohol_percentage;
    }

    /**
     * Set the value of alcohol_percentage
     *
     * @param float $alcohol_percentage
     * @return void
     */
    public function setAlcohol_percentage(float $alcohol_percentage): void
    {
        $this->alcohol_percentage = $alcohol_percentage;
    }

    /**
     * Get the value of id_region
     * 
     * @return int
     */
    public function getId_region(): int
    {
        return $this->id_region;
    }

    /**
     * Set the value of id_region
     *
     * @param int $id_region
     * @return void
     */
    public function setId_region(int $id_region): void
    {
        $this->id_region = $id_region;
    }

    /**
     * Get the value of id_cepage
     * @retunr int
     */
    public function getId_cepage(): int
    {
        return $this->id_cepage;
    }

    /**
     * Set the value of id_cepage
     * @param int $id_cepage
     *
     * @return void
     */
    public function setId_cepage(int $id_cepage): void
    {
        $this->id_cepage = $id_cepage;
    }

    /**
     * Get the value of id_taste
     * @return int
     */
    public function getId_taste(): int
    {
        return $this->id_taste;
    }

    /**
     * Set the value of id_taste
     * 
     * @param int $id_taste
     *
     * @return void
     */
    public function setId_taste(int $id_taste): void
    {
        $this->id_taste = $id_taste;
    }

    /**
     * Get the value of id_association
     * @return int
     */
    public function getId_association(): int
    {
        return $this->id_association;
    }

    /**
     * Set the value of id_association
     * 
     * @return int $id_association
     *
     * @return void
     */
    public function setId_association(int $id_association): void
    {
        $this->id_association = $id_association;
    }

    /**
     * Get the value of id_comment
     * @retunr int
     */
    public function getId_comment(): int
    {
        return $this->id_comment;
    }

    /**
     * Set the value of id_comment
     * 
     * @param int $id_comment
     *
     * @return  void
     */
    public function setId_comment(int $id_comment): void
    {
        $this->id_comment = $id_comment;
    }

    /**
     * Get the value of id_type
     * @return int 
     */
    public function getId_type(): int
    {
        return $this->id_type;
    }

    /**
     * Get the value of price
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * Set the value of price
     * @param float $price
     *
     * @return void
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }
    /**
     * Get the value of is_featured
     * @return bool
     */
    public function getIsFeatured(): bool
    {
        return $this->is_featured;
    }

    /**
     * Set the value of is_featured
     * @param bool is_featured
     *
     * @return bool
     */
    public function setIsFeatured(bool $is_featured): void
    {
        $this->is_featured = $is_featured;
    }
    /**
     * Set the value of id_type
     * @param int $id_type
     * @return void
     */
    public function setId_type(int $id_type): void
    {
        $this->id_type = $id_type;
    }
    /**
     * Ins??rer un produit dans la BDD
     * @return int|false  l'id du dernier ??l??ment ins??r?? ou false dans le cas d'??chec
     */
    public function insert(): int|false
    {
        $stmt = $this->pdo->prepare("INSERT INTO product (`name`,`description`,`photo`,`stock`,`alcohol_percentage`,`id_region`,`id_cepage`,`id_taste`,`id_association`,`id_type`,`price`, `is_featured`) VALUES (:name,:description,:photo,:stock,:alcohol_percentage,:id_region,:id_cepage,:id_taste,:id_association,:id_type,:price,:is_featured)");

        $stmt->execute([
            "name" => $this->name,
            "description" => $this->description,
            "photo" => $this->photo,
            "stock" => $this->stock,
            "alcohol_percentage" => $this->alcohol_percentage,
            "id_region" => $this->id_region,
            "id_cepage" => $this->id_cepage,
            "id_taste" => $this->id_taste,
            "id_association" => $this->id_association,
            "id_type" => $this->id_type,
            "price" => $this->price,
            "is_featured" => $this->is_featured

        ]);
        return $this->pdo->lastInsertId();
    }
    public function findFeaturedBy(array $criteria): object|array|false
    {
        if (empty($criteria)) {
            throw  new \Exception("Il faut passer au moins un crit??re");
        }
        $sql_query = "SELECT * FROM {$this->table_name} JOIN {$this->regionJoin} JOIN {$this->cepage} JOIN {$this->association}  JOIN {$this->taste}  WHERE ";
        $count = 0;
        foreach ($criteria as $key => $value) {
            $count++;
            if ($count > 1) {
                $sql_query .= " AND ";
            }
            $sql_query .= " $key = :$key ";
        }

        $sql_query2 = $sql_query . "AND is_featured = 1 ORDER BY product.id ASC LIMIT 1";
        $stmt = $this->pdo->prepare($sql_query2);
        foreach ($criteria as $key => $value) {
            $stmt->bindParam(":$key", $value);
        }
        // if ($is_array)
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);
        // else
        //     $stmt->setFetchMode(\PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();
        return $stmt->fetch();
    }
}

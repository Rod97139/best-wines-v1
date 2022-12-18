<?php
//todo
namespace Core;

abstract class Model
{
    protected \PDO $pdo;

    protected string $table_name;
    protected string $regionJoin = 'region ON product.id_region=region.id_region';
    protected string $cepage = 'cepage ON product.id_cepage=cepage.id_cepage';
    protected string $association = 'association ON product.id_association=association.id_association';
    protected string $type_product = 'type_product ON product.id_type=type_product.id_type';
    protected string $taste = 'taste ON product.id_taste=taste.id_taste';

    public function __construct()
    {
        $this->pdo = Database::getPdo();
    }



    /**
     * @param int $id l'identifiant de l'élément à afficher
     * @param boolean $is_array s'il est à true on aura les résultats sous format d'un tableau associatif, si non c'est le format du model
     * @return array|object|false
     */
    public function find(int $id, bool $is_array = false): array|object|false
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table_name} WHERE id = :id ");
        $stmt->bindParam(':id', $id);
        // if ($is_array)
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);
        // else
        //     $stmt->setFetchMode(\PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();
        return $stmt->fetch();
    }

    /**
     * get all elements
     * @param boolean $is_array s'il est à true on aura les résultats sous format d'un tableau associatif, si non c'est le format du model
     * @return array
     */
    public function findAll(): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM {$this->table_name}"

        );
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);

        $stmt->execute();
        return $stmt->fetchAll();
       
    }

    public function findAllProduct(): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM {$this->table_name} JOIN {$this->regionJoin} JOIN {$this->cepage} JOIN {$this->association} JOIN {$this->type_product} JOIN {$this->taste}"

        );
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);


        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * delete an item
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        $stmt = $this->pdo->prepare("DELETE FROM {$this->table_name} WHERE id = :id ");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    /**
     * permet de récupérer plusieurs éléments selon un ou plusieurs critères de recherche
     * @param array $criteria les critères de recherche
     * @param boolean $is_array s'il est à true on aura les résultats sous format d'un tableau associatif, si non c'est le format du model
     * @return array|false
     */
    public function findAllBy(array $criteria,): array
    {
        if (empty($criteria)) {
            throw  new \Exception("Il faut passer au moins un critère");
        }

        $sql_query = "SELECT * FROM {$this->table_name} WHERE ";
        $count = 0;
        foreach ($criteria as $key => $value) {
            $count++;
            if ($count > 1) {
                $sql_query .= " AND ";
            }
            $sql_query .= " $key = :$key ";
        }

        $stmt = $this->pdo->prepare($sql_query);

        $stmt->setFetchMode(\PDO::FETCH_ASSOC);
        $stmt->execute($criteria);
        return $stmt->fetchAll();
    }

    public function findAllProductBy(array $criteria,): array
    {
        if (empty($criteria)) {
            throw  new \Exception("Il faut passer au moins un critère");
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

        $stmt = $this->pdo->prepare($sql_query);

        $stmt->setFetchMode(\PDO::FETCH_ASSOC);
        $stmt->execute($criteria);
        return $stmt->fetchAll();
    }

    /**
     * Récupérer un élément avec un ou plusieurs critères
     * @param array $criteria
     * @param boolean $is_array s'il est à true on aura les résultats sous format d'un tableau associatif, si non c'est le format du model
     * @return object|array|false
     * @throws Exception
     */
    public function findOneBy(array $criteria, bool $is_array = false): object|array|false
    {
        if (empty($criteria)) {
            throw  new \Exception("Il faut passer au moins un critère");
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

        $stmt = $this->pdo->prepare($sql_query);
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

    public function findLastBy(array $criteria): object|array|false
    {
        if (empty($criteria)) {
            throw  new \Exception("Il faut passer au moins un critère");
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

        $sql_query2 = $sql_query . "ORDER BY product.id DESC LIMIT 1";

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
    
    public function findOneForEdit(array $criteria, bool $is_array = false): object|array|false
    {
        if (empty($criteria)) {
            throw  new \Exception("Il faut passer au moins un critère");
        }
        // erreur edit stock
        $sql_query = "SELECT * FROM {$this->table_name}   WHERE ";

        $count = 0;
        foreach ($criteria as $key => $value) {
            $count++;
            if ($count > 1) {
                $sql_query .= " AND ";
            }
            $sql_query .= " $key = :$key ";
        }

        $stmt = $this->pdo->prepare($sql_query);
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
    public function findOneItemBy(array $criteria, bool $is_array = false): object|array|false
    {
        if (empty($criteria)) {
            throw  new \Exception("Il faut passer au moins un critère");
        }
        // erreur edit stock
        $sql_query = "SELECT * FROM {$this->table_name} WHERE ";

        $count = 0;
        foreach ($criteria as $key => $value) {
            $count++;
            if ($count > 1) {
                $sql_query .= " AND ";
            }
            $sql_query .= " $key = :$key ";
        }

        $stmt = $this->pdo->prepare($sql_query);
        foreach ($criteria as $key => $value) {
            $stmt->bindParam(":$key", $value);
        }

        // if ($is_array)
        $stmt->setFetchMode(\PDO::FETCH_OBJ);
        // else
        //     $stmt->setFetchMode(\PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();
        return $stmt->fetch();
    }

    

    public function edit(int $to_edit)
    {

        $stmt = $this->pdo->prepare("UPDATE product SET `name` = :new_name, `description` = :new_description,`photo`=:new_photo, `stock` = :new_stock,`alcohol_percentage` = :new_alcohol_percentage, `id_region`= :new_id_region,`id_cepage`=:new_id_cepage, `id_taste`=:new_id_taste, `id_association`=:new_id_association,`id_type`=:new_id_type,`price`=:new_price, `is_featured`=:new_is_featured WHERE id = :id");

        $stmt->execute(array(
            'new_name' => $_POST['name'],
            'new_description' => $_POST['description'],
            'new_photo' => $_FILES['image']['name'],
            'new_stock' => $_POST['stock'],
            'new_alcohol_percentage' => $_POST['alcohol_percentage'],
            'new_id_region' => $_POST['id_region'],
            'new_id_cepage' => $_POST['id_cepage'],
            'new_id_taste' => $_POST['id_taste'],
            'new_id_association' => $_POST['id_association'],
            'new_id_type' => $_POST['id_type'],
            'new_price' => $_POST['price'], 
            'new_is_featured' => $_POST['is_featured'],
            'id' => $to_edit
           
        ));

        $stmt = $this->pdo->prepare("SELECT * FROM product WHERE id = :id");
        $stmt->execute([
            'id' => $to_edit
        ]);
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);
        return $stmt->fetch();
    }

    public function searchProduct(){
    
        $stmt = $this->pdo->prepare("SELECT * FROM product WHERE `name` LIKE :term");
       
        $stmt->execute(array(
            'term'=>$_REQUEST["term"]. '%'
        ));
       
        if($stmt->rowCount() > 0){
            while($row = $stmt->fetch()){
                echo "<p>" . $row["name"] . "</p>";
            }
        } else{
            echo "<p>No matches found</p>";
        }
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }
}


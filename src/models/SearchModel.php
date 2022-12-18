<?php
namespace Phppot;

class SearchModel
{

    private $ds;

    private $perPage;

    function __construct()
    {
        require_once __DIR__ . '/../../core/DataSource.php';
        $con = new DataSource();
        $this->ds = $con->getConnection();
    }

    function getCount($search_keyword = "")
    {
        if(!empty($search_keyword)) {
            $sql = 'SELECT * FROM product WHERE id LIKE :keyword';
        } else {
            $sql = 'SELECT * FROM product';
        }
        $pdo_statement = $this->ds->prepare($sql);
        if(!empty($search_keyword)) {
        $pdo_statement->bindValue(':keyword', '%' . $search_keyword . '%', \PDO::PARAM_STR);
        }
        $pdo_statement->execute();
        $row_count = $pdo_statement->rowCount();
        return $row_count;
    }

    function getAllPosts($start, $perPage, $search_keyword = "")
    {
        if(!empty($search_keyword)) {
            $sql = 'SELECT * FROM product WHERE id LIKE :keyword ORDER BY id ASC LIMIT ' . $start . ',' . $perPage;
        } else {
            $sql = 'SELECT * FROM product ORDER BY id ASC LIMIT ' . $start . ',' . $perPage;
        }
        $pdo_statement = $this->ds->prepare($sql);
        if(!empty($search_keyword)) {
            $pdo_statement->bindValue(':keyword', '%' . $search_keyword . '%', \PDO::PARAM_STR);
        }
        $pdo_statement->execute();
        $result = $pdo_statement->fetchAll();
        return $result;
    }
}
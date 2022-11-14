<?php

class ProductModel {

    private $db;

    function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=bd_tiendaropa;charset=utf8', 'root', '');
    }
    function getAllProducts($filterby, $mark, $filter, $column, $order, $limit, $page) {
        $params = [];
        $query = "SELECT * FROM product JOIN category ON product.id_category = category.id_category";
        
        if($filterby != null && $filter != null){
            if ($mark == null){
                $query .= " WHERE  $filterby = ?"; 
                array_push($params, $filter);
            } else{
                $query .= " WHERE $filterby $mark ?";
                array_push($params, $filter);
            }     
        }
        if($column != null){
            var_dump("la columna" . $column);
            $query .= " ORDER BY $column $order";
        }
        if($page == null){
            $page=1;
        }
        if($limit != null){
            $offset = $page * $limit - $limit;
            $query .= " LIMIT  $limit OFFSET $offset";
        }
        $query = $this->db->prepare($query);
        $query->execute($params);
        $products = $query->fetchAll(PDO::FETCH_OBJ); 
        return $products;
    } 
    function getProduct($id) {
        $query = $this->db->prepare( "SELECT * FROM product JOIN category ON product.id_category = category.id_category WHERE id_product=?" );
        $query->execute(array($id));
        $product = $query->fetch(PDO::FETCH_OBJ);
        return $product;
    }
    function deleteProduct($id) {
        $query = $this->db->prepare('DELETE FROM product WHERE id_product = ?');
        $query->execute([$id]);
    }

    function insertProduct($description, $price, $size, $id_category) {
        $query = $this->db->prepare("INSERT INTO product (description, price, size, id_category) VALUES (?, ?, ?, ?)");
        $params = array($description, $price, $size, $id_category);
        $query->execute($params);
        return $this->db->lastInsertId();
    }
}

 
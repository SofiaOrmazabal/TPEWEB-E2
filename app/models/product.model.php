<?php

class ProductModel {

    private $db;

    function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=bd_tiendaropa;charset=utf8', 'root', '');
    }
   
    function getAllProducts() {
        $query = $this->db->prepare("SELECT * FROM product JOIN category ON product.id_category = category.id_category ");
        $query->execute();
        $products = $query->fetchAll(PDO::FETCH_OBJ);
        return $products;
    }
    function getProductsByFilter($filter, $mark, $value) {
        $query = $this->db->prepare("SELECT * FROM product JOIN category ON product.id_category = category.id_category WHERE $filter $mark $value ");
        $query->execute();
        $products = $query->fetchAll(PDO::FETCH_OBJ);
        return $products;
    }
    function getAllOrderBy($order, $direction) {
        $query = $this->db->prepare("SELECT * FROM product JOIN category ON product.id_category = category.id_category ORDER BY $order $direction");
        $query->execute();
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

 
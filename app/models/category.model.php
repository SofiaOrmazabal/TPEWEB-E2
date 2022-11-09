<?php
class CategoryModel {

    private $db;

    function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=bd_tiendaropa;charset=utf8', 'root', '');
    }

    function getAllCategories() { 
        $query = $this->db->prepare("SELECT * FROM category");
        $query->execute();
        $categories = $query->fetchAll(PDO::FETCH_OBJ);
        return $categories;
    }

    function nameCategory($id_category) {
        
        $query = $this->db->prepare("SELECT name FROM category WHERE id_category=?");
        $query->execute(array($id_category));
        $nameCategory = $query->fetchAll(PDO::FETCH_OBJ);
        return $nameCategory;
    }



}



<?php
require_once './app/models/product.model.php';
require_once './app/models/category.model.php';
require_once './app/views/api.view.php';

class ProductApiController {
    private $modelProduct;
    private $modelCategory;
    private $view;
    private $data;

    public function __construct() {
        $this->modelProduct = new ProductModel();
        $this->modelCategory = new CategoryModel();
        $this->view = new ApiView();
        $this->data = file_get_contents("php://input");
    }
    public function getProducts() {
        $column = $_GET['column'] ?? null;
        $order = $_GET['order'] ?? null;
        $limit = $_GET['limit'] ?? null;
        $page =  $_GET['page'] ?? null;
        $mark = $_GET['mark'] ?? null;
        $filterby = $_GET['mark'] ?? null;
        $valueFilter = $_GET['value'] ?? null;
        
        if ($column){
            if (strtolower($_GET['column']) == "id_product" || strtolower($_GET['column']) == "description" || strtolower($_GET['column']) == "price" || strtolower($_GET['column']) == "size" || strtolower($_GET['column']) == "id_category" || strtolower($_GET['column']) == "namecategory" ){
                $column = $_GET['column'];
            } else {
                $column = null;
                $this->view->response("No existe esa columna en la base de datos", 404);
                die(); 
            }
        }
        if ($filterby){
            if (strtolower($_GET['filterby']) == "id_product" || strtolower($_GET['filterby']) == "description" || strtolower($_GET['filterby']) == "price" || strtolower($_GET['filterby']) == "size" || strtolower($_GET['filterby']) == "id_category" || strtolower($_GET['filterby']) == "namecategory" ){
                $filterby = $_GET['filterby'];
            } else {
                $filterby = null;
                $this->view->response("No existe esa columna en la base de datos", 404);
                die(); 
            }
        }
        if ($order){
            if ($order === "asc" || $order === "desc"){
                $order = $_GET['order'];
            }else {
                $order = null; 
                $this->view->response("El dato ingresado no es una forma de ordenamiento valida, por favor ingrece 'asc' o 'desc' ", 404);
                die(); 
            }
        }
        if ($mark){
            if ($mark != ">" && $mark != "<" && $mark != "<=" && $mark != ">=" && $mark != '='){
                $mark = null;  
                $this->view->response("El dato ingresado no es un símbolo valido, por favor ingrese '>', '<', '=', '>=' o '<=' ", 404);
                die();
            }
        }    

        $params = $this->modelProduct->getAllProducts($filterby, $mark, $valueFilter, $column, $order, $limit, $page);

        if($params){
            return $this->view->response($params, 200);
        }else{
            $this->view->response("No hay productos en la base de datos que coincidan", 404);
        } 
     }              
    
    public function getProduct($params = null) {
        $id = $params[':ID'];
        $product = $this->modelProduct->getProduct($id);
        if ($product)
            $this->view->response($product, 200);
        else 
            $this->view->response("El producto con el id=$id no existe en la base de datos", 404);
    }

    public function deleteProduct($params = null) {
        $id = $params[':ID'];
        $product = $this->modelProduct->getProduct($id);
        if ($product) {
            $this->modelProduct->deleteProduct($id);
            $this->view->response("El producto con el id=$id fue eliminado con éxito", 200);
        } else 
            $this->view->response("El producto con el id=$id no existe en la base de datos", 404);
    }

    private function getData() {
        return json_decode($this->data);
    }
    
    public function insertProduct() {
        $product = $this->getData();
        if (empty($product->description) || empty($product->price) || empty($product->size)|| empty($product->id_category)) {
            $this->view->response("Por favor, complete todos los datos", 400);
        } else {
            $categories = $this->modelCategory->getAllCategories();

            $existeCat = false;
            foreach ($categories as $category){
                if (($product->id_category) == $category->id_category){
                    $existeCat = true;
                }    
            }
            if (!$existeCat){
                $this->view->response("La categoría insertada no existe ", 404);
            } else{
                $id = $this->modelProduct->insertProduct($product->description, $product->price, $product->size, $product->id_category);
                $this->view->response("La tarea se insertó con éxito con el id=$id", 201);
            }
            
        }
    }
}
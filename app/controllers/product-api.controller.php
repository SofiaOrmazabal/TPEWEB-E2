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
    public function getProducts($params = null) {
        $order =  null;
        $direction = null;
        $filter = null;
        $value = null;
        $mark = null;
        if (isset($_GET['sort'])) {
            $order = $_GET['sort'];
            if (isset($_GET['order'])) {
                $direction = $_GET['order']; 
            }
            if (($order === 'id_product')||($order === 'description')||($order === 'price')||($order === 'size')||($order === 'id_category')||($order === 'nameCategory')){
                $products = $this->modelProduct->getAllOrderBy($order, $direction);
                $this->view->response($products, 200);
            } else{
                
                $this->view->response("La categoría insertada no existe ", 404);
            }
        }else if (isset($_GET['filter'])) {
            $filter = $_GET['filter'];
            if (isset($_GET['value'])) {
                $value = $_GET['value']; 
            }
            if (isset($_GET['mark'])) {
                $mark = $_GET['mark']; 
            }        
            if (($filter === 'id_product')||($filter === 'description')||($filter === 'price')||($filter === 'size')||($filter === 'id_category')||($filter === 'nameCategory')){
                $products = $this->modelProduct->getProductsByFilter($filter, $mark,$value);
                $this->view->response($products, 200);
            } else{
                
                $this->view->response("La categoría insertada no existe ", 404);
            }
        }else{
            $products = $this->modelProduct->getAllProducts();
            if ($products){
                $this->view->response($products, 200);
                
            } else{
                $this->view->response("No existen productos en la base de datos", 204);
            } 
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
            $this->view->response("Complete los datos", 400);
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
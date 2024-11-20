<?php
require_once 'ProductModel.php';
class ProductController
{
    private $model;

    public function __construct()
    {
        $this->model = new ProductModel();  // Inicializa el modelo
    }

    public function displayProducts()
    {
        $products = $this->model->getAllProducts();  // Obtiene los productos
        require 'productView.php';  // Muestra la vista con los productos
    }
}

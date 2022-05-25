<?php
class ProductController{

	function __construct(){
		require_once("models/ProductsModel.php");
		$this -> ProductModel = new ProductsModel();
	}

	public function listProducts(){
		$result = $this -> ProductModel -> listProducts();
		$arrayProducts = array();
		while($line = $result->fetch_assoc())
		{
			array_push($arrayProducts,$line); 
		}
		
		header('Content-Type: application/json');
		echo json_encode($arrayProducts);	
	}

	public function consultProduct($idProduct){
		$result = $this -> ProductModel -> consultProduct($idProduct);
		
		$product = $result->fetch_assoc();			

		header('Content-Type: application/json');
		echo json_encode($product);
	}
	public function consultProductsCategory($idCategory){
		
		$result = $this -> ProductModel -> consultProductsCategory($idCategory);
		$arrayProducts = array();
		while($line = $result->fetch_assoc()){
			array_push($arrayProducts,$line); 
		}
		
		header('Content-Type: application/json');
		echo json_encode($arrayProducts);	
	}
}
?>

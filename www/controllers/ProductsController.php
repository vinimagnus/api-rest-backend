<?php
class ProductsController
{
	function __construct()
	{
		require_once("models/ProductsModel.php");
		$this -> ProductModel = new ProductsModel();
	}

	public function listProducts(){
		$this -> ProductModel -> listProducts();
		$result = $this -> ProductModel -> getConsult();
		
		$arrayProducts = array();
		
		while($line = $result->fetch_assoc())
		{
			array_push($arrayProducts,$line); 
		}
		
		header('Content-Type: application/json');
		echo json_encode($arrayProducts);	
	}

	public function consultProduct($idProduct)
	{
				
		$this -> ProductModel -> consultProduct($idProduct);
		$result = $this -> ProductModel -> getConsult();
		
		$product = $result->fetch_assoc();			

		header('Content-Type: application/json');
		echo json_encode($product);
	}
	public function consultProductsCategory($idCategory){
		$this -> ProductModel -> consultProductsCategory($idCategory);
		$result = $this -> ProductModel -> getConsult();
		
		$arrayProducts = array();
		
		while($line = $result->fetch_assoc())
		{
			array_push($arrayProducts,$line); 
		}
		
		header('Content-Type: application/json');
		echo json_encode($arrayProducts);	

	}

	
	
	
	

}

?>

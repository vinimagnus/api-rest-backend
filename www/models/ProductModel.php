<?php		
class ProductsModel{
	
	var $Connection;

	function __construct(){
		require_once('db/ConnectClass.php');
        $ConnectClass = new ConnectClass();
        $ConnectClass -> openConnect();
        $this -> Connection = $ConnectClass -> getConnection();
	}
			
	public function listProducts(){
		$sql = "SELECT * FROM products";			
		return $this -> Connection -> query($sql);	
	}

	public function consultProduct($idProduct){
		$sql = "
			SELECT * FROM products 
			WHERE idProduct = {$idProduct}
		;";	
		return $this -> Connection -> query($sql);			
	}

	public function consultProductsCategory($idCategory){
		$sql = "
			SELECT * FROM products 
			WHERE idCategory = {$idCategory}
		;";	
		return $this -> Connection -> query($sql);			
	}
}
?>

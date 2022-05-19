<?php		
class ProductsModel{
	var $result;
	var $conn;

	function __construct(){
		require_once("db/ConnectClass.php");
		$Oconn = new ConnectClass();
		$Oconn -> openConnect();
		$this -> conn = $Oconn -> getConnect();
	}
			
	public function listProducts(){
		$sql = "SELECT * FROM products";			
		$this -> result = $this -> conn -> query($sql);	
			
	}

	public function consultProduct($idProduct){
		$sql = "
			SELECT * FROM products 
			WHERE idProduct = {$idProduct}
		;";	
		$this -> result = $this -> conn -> query($sql);			
	}

	public function consultProductsCategory($idCategory){
		$sql = "
			SELECT * FROM products 
			WHERE idCategory = {$idCategory}
		;";	
		$this -> result = $this -> conn -> query($sql);			
	}

	
	public function getConsult()
	{
		return $this -> result;
	}
}
?>

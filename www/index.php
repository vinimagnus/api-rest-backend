<?php 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

$request_method = $_SERVER["REQUEST_METHOD"];
$local = $_SERVER['SCRIPT_NAME'];
$uri = $_SERVER['PHP_SELF']; 
$rout = str_replace($local, "", $uri);
$uriSegments = explode("/", $rout);

require_once("controllers/UserController.php");
$user = new UserController();

if(isset($uriSegments[1])){	
	switch($uriSegments[1]){
		case 'contact':
			require_once("controllers/ContactController.php");
			$contact = new ContactController();
			switch($request_method){
				case 'GET':
					if(!isset($uriSegments[2])|| $uriSegments[2]==''){
						$contact -> listContacts();
					}elseif(intval($uriSegments[2])){
						$contact -> consultContact($uriSegments[2]);
					}elseif($uriSegments[2]=='search' && isset($uriSegments[3])){
						$contact -> listContacts($uriSegments[3]);
					}
				break;
				case 'POST':
						$contact -> insertContact();
				break;
				case 'PUT':
					if(intval($uriSegments[2])){
						$contact -> updateContact($uriSegments[2]);
					}
				break;
				case 'DELETE':
					if(intval($uriSegments[2])){
						$contact -> deleteContact($uriSegments[2]);
					}
				break;
			}
		break;	

		case 'client':
			require_once("controllers/ClientController.php");
			$client = new ClientController();
			switch($request_method){
				case 'GET':
					if(!isset($uriSegments[2])|| $uriSegments[2]==''){
						$client -> listClients();
					}elseif(intval($uriSegments[2])){
						$client -> consultClient($uriSegments[2]);
					}elseif($uriSegments[2]=='search' && isset($uriSegments[3])){
						$client -> listClients($uriSegments[3]);
					}
				break;
				case 'POST':	
						$client -> insertClient();		
				break;
				case 'PUT':
					if(intval($uriSegments[2])){
						$client -> updateClient($uriSegments[2]);
					}
				break;
				case 'DELETE':
					if(intval($uriSegments[2])){
						$client -> deleteClient($uriSegments[2]);
					}
				break;
			}
		break;	

		case 'product':
			require_once("controllers/ProductController.php");
			$productController = new ProductController();
			
			switch($request_method){
				case 'GET':
					if(!isset($uriSegments[2]) || $uriSegments[2] =='' ){
						$productController -> listProducts();	
					}elseif ($uriSegments[2] == 'category'){
						if(intval($uriSegments[3]))
							$productController -> listProductsCategory($uriSegments[3]);
					}elseif(intval($uriSegments[2])){
						$productController -> listProduct($uriSegments[2]);
					}
				break;
				case 'POST':
					$product -> insertProduct($uriSegments[2]);
				break;
				case 'PUT':
					$product -> updateProduct($uriSegments[2]);
				break;
				case 'DELETE':
					//$product -> deleteProduct($uriSegments[2]);
				break;
			}
		break;

		case 'page':
			require_once("controllers/SiteController.php");
			$siteController = new SiteController();
			switch($request_method){
				case 'GET':
					if(!isset($uriSegments[2])|| $uriSegments[2]==''){
						$siteController -> listSites();	
					}elseif(intval($uriSegments[2])){
						$siteController -> consultSite($uriSegments[2]);
					}
				break;
				case 'POST':
					//$site -> insertProduct($uriSegments[2]);
				break;
				case 'PUT':
					//$site -> updateProduct($uriSegments[2]);
				break;
				case 'DELETE':
					//$site -> deleteProduct($uriSegments[2]);
				break;
			}
		break;

		case 'user':
			
			require_once("controllers/UserController.php");
			$userController = new UserController();
			switch($request_method){
				case 'GET':
					if(!isset($uriSegments[2]) || $uriSegments[2] =='' ){
						//$user -> listUsers();	
					}elseif ($uriSegments[2] == 'login'){
						$userController -> login();
					}
				break;
				case 'POST':
					if(!isset($uriSegments[2]) || $uriSegments[2] =='' ){
						//$user -> listUsers();	
					}elseif ($uriSegments[2] == 'login'){
						$userController -> login();	
					}	
				break;
			
			}
		break;
	}
}



?>


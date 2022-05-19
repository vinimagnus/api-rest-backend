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

if(isset($uriSegments[1])){	
	switch($uriSegments[1]){
		case 'contacts':
			require_once("controllers/ContactsController.php");
			$contact = new ContactsController();
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

		case 'clients':
			require_once("controllers/ClientsController.php");
			$client = new ClientsController();
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

		case 'products':
			require_once("controllers/ProductsController.php");
			$product = new ProductsController();
			
			switch($request_method){
				case 'GET':
					if(!isset($uriSegments[2]) || $uriSegments[2] =='' ){
						$product -> listProducts();	
					}elseif ($uriSegments[2] == 'category'){
						if(intval($uriSegments[3]))
							$product -> consultProductsCategory($uriSegments[3]);
					}elseif(intval($uriSegments[2])){
						$product -> consultProduct($uriSegments[2]);
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

		case 'pages':
			require_once("controllers/SitesController.php");
			$site = new SitesController();
			switch($request_method){
				case 'GET':
					if(!isset($uriSegments[2])|| $uriSegments[2]==''){
						$site -> listSites();	
					}elseif(intval($uriSegments[2])){
						$site -> consultSite($uriSegments[2]);
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

		case 'users':
			require_once("controllers/UsersController.php");
			$user = new UsersController();
			switch($request_method){
				case 'GET':
					if(!isset($uriSegments[2]) || $uriSegments[2] =='' ){
						//$user -> listUsers();	
					}elseif ($uriSegments[2] == 'login'){
						$user -> login();
					}
				break;
				case 'POST':
					if(!isset($uriSegments[2]) || $uriSegments[2] =='' ){
						//$user -> listUsers();	
					}elseif ($uriSegments[2] == 'login'){
						$user -> login();
						
					}	
				break;
			
			}
		break;
	}
}
?>


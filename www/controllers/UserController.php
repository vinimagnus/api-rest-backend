<?php 
class UserController{

	function __construct(){
		require_once("models/UserModel.php");
		$this -> UserModel = new UserModel();
	}

	public function login(){
		$userData = json_decode(file_get_contents("php://input"));
		if(isset($userData -> userName) && isset($userData -> password)){
			$result = $this -> UserModel -> consultUser($userData -> userName);
			if ($user = $result->fetch_assoc()){	
				if ($user['password'] == $userData -> password){			
					
					$token = $this -> createJWT($user);
					header('Content-Type: application/json');	
					echo ('{"access":"true","token":"'.$token.'"}');
					
				}
				else{ 				 
					header('Content-Type: application/json');	
					echo ('{"access":"false","message":"senha inválida"}');
				}	
			}else{ 
				header('Content-Type: application/json');	
				echo ('{"access":"false","message":"usuário inválido"}');
			}	
		}else{
			header('Content-Type: application/json');	
			echo ('{"access":"false","message":"faltam dados de acessos"}');
		}
	}

	public function createJWT($user){
		$header = [
			'alg' => 'HS256',
			'typ' => 'JWT'
		 ];
		 $header = json_encode($header);
		 $header = base64_encode($header);
		 $header = str_replace(['+', '/', '='], ['-', '_', ''], $header); //base64url
		 
		 $payload = [
			'iss' => 'localhost',
			'name' => "{$user['name']}",
			'user' => "{$user['user']}",
			'admin' => "{$user['admin']}"
		 ];
		 $payload = json_encode($payload);
		 $payload = base64_encode($payload);
		 $payload = str_replace(['+', '/', '='], ['-', '_', ''], $payload); //base64url
		 
		 $signature = hash_hmac('sha256',"$header.$payload",'minha-senha',true);
		 $signature = base64_encode($signature);
		 $signature = str_replace(['+', '/', '='], ['-', '_', ''], $signature); //base64url
		 $token = $header . "." . $payload . "." . $signature;
		 return $token;
		
	}

	public function checkJWT($headers){
		if(isset($headers['Authorization'])){
			
			$token = $headers['Authorization'];
			$token = str_replace("Bearer ", "", $token); //se tiver o prefixo "Bearer" remover

			$part = explode(".",$token);
			$header = $part[0];
			$payload = $part[1];
			$signature = $part[2];
			
			$valid = hash_hmac('sha256',"$header.$payload",'minha-senha',true);
			$valid = base64_encode($valid);
			$valid = str_replace(['+', '/', '='], ['-', '_', ''], $valid); //base64url

			if($signature == $valid){
				return true;
			}else{
				print ("assinatura inválida <br>");
				return false;
			}
		}else{
			return false;
		}

	}

	public function isAdmin(){
		
		$headers = apache_request_headers();
		
		if($this->checkJWT($headers)){
			
			$token = $headers['Authorization'];
			$token = str_replace("Bearer ", "", $token); 
			$part = explode(".",$token);
			$payload = $part[1];
			$payload = base64_decode($payload);
			$payload = json_decode($payload);
			
		
			if($payload -> admin == 1){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
} 
?>
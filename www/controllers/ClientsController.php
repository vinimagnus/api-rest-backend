<?php
class ClientsController{
	var $ClientModel;

	function __construct(){
		require_once("models/ClientsModel.php");
		$this -> ClientModel = new ClientsModel();
	}
	
	
	public function listClients($search = null){
		$this -> ClientModel -> listClients($search);
		$result = $this -> ClientModel -> getConsult();
		
		$arrayClients = array();
		while($line = $result->fetch_assoc()){
			array_push($arrayClients,$line); 
		}
		header('Content-Type: application/json');
		echo json_encode($arrayClients);
	}

	public function consultClient($idClient){
		$this -> ClientModel -> consultClient($idClient);
		$result = $this -> ClientModel -> getConsult();
		
		$client = $result->fetch_assoc();			

		header('Content-Type: application/json');
		echo json_encode($client);
	}


	public function insertClient(){
		$contact = json_decode(file_get_contents("php://input"));
		$arrayClient["name"] = $contact -> name;
		$arrayClient["address"] = $contact -> address;
		$arrayClient["phone"] = $contact -> phone;
		$arrayClient["email"] = $contact -> email;
		
		$this -> ClientModel -> insertClient($arrayClient);
		$isertedId = $this -> ClientModel -> getConsult();
		$this -> consultClient($isertedId);
	}
	
	
	public function updateClient($idClient){
		$contact = json_decode(file_get_contents("php://input"));
		$arrayClient["idClient"] = $idClient;
		$arrayClient["name"] = $contact -> name;
		$arrayClient["address"] = $contact -> address;
		$arrayClient["phone"] = $contact -> phone;
		$arrayClient["email"] = $contact -> email;
	
		$this -> ClientModel -> updateClient($arrayClient);
		$this -> consultClient($arrayClient["idClient"]);
		
	}

	public function deleteClient($idClient){
		$this -> ClientModel -> deleteClient($idClient);
		$this -> consultClient($idClient);
	}
}
?>
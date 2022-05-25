<?php
class ClientController{
	var $ClientModel;

	function __construct(){
		require_once("models/ClientModel.php");
		$this -> ClientModel = new ClientModel();
	}
	
	public function listClients($search = null){
		$result = $this -> ClientModel -> listClients($search);
		$arrayClients = array();
		while($line = $result->fetch_assoc()){
			array_push($arrayClients,$line); 
		}
		header('Content-Type: application/json');
		echo json_encode($arrayClients);
	}

	public function consultClient($idClient){
		$result = $this -> ClientModel -> consultClient($idClient);
		$client = $result->fetch_assoc();
		header('Content-Type: application/json');
		echo json_encode($client);
	}

	public function insertClient(){
		$client = json_decode(file_get_contents("php://input"));
		$arrayClient = array(
            'name' => $client -> name,
            'phone' => $client -> phone,
            'email' => $client -> email,
            'address' => $client -> address
        );
		
		$isertedId = $this -> ClientModel -> insertClient($arrayClient);
		$this -> consultClient($isertedId);
	}
	
	public function updateClient($idClient){
		$client = json_decode(file_get_contents("php://input"));
		$arrayClient = array(
            'idClient' => $idClient,
            'name' => $client -> name,
            'phone' => $client -> phone,
            'email' => $client -> email,
            'address' => $client -> address
        );
	
		$this -> ClientModel -> updateClient($arrayClient);
		$this -> consultClient($arrayClient["idClient"]);
		
	}

	public function deleteClient($idClient){
		$this -> ClientModel -> deleteClient($idClient);
		$this -> consultClient($idClient);
	}
}
?>
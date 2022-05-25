<?php
class ContactController{
	function __construct(){
		require_once("models/ContactModel.php");
		$this -> ContactModel = new ContactModel();
	}

	public function listContacts($search = null){
		
		$result = $this -> ContactModel -> listContacts($search);
		$arrayContacts = array();
		while($line = $result->fetch_assoc()){
			array_push($arrayContacts,$line); 
		}
		
		header('Content-Type: application/json');
		echo json_encode($arrayContacts);
	}

	public function consultContact($idContact){	
		$result = $this -> ContactModel -> consultContact($idContact);
		$contact = $result->fetch_assoc();
		
		header('Content-Type: application/json');
		echo json_encode($contact);
	}

	public function insertContact(){
		$contact = json_decode(file_get_contents("php://input"));
		$arrayContact = array(
			'name' => $contact -> name,
			'message' => $contact -> message,
			'email' => $contact -> email
		);
		
		$isertedId = $this -> ContactModel -> insertContact($arrayContact);
		$this -> consultContact($isertedId);
	}
	
	public function updateContact($idContact) {
		$contact = json_decode(file_get_contents("php://input"));
		$arrayContact = array(
			'idContact' => $idContact,
			'status' => $contact -> status,
			'description' => $contact -> description
		);
		$this -> ContactModel -> updateContact($arrayContact);	
		$this -> consultContact($arrayContact["idContact"]);
	}

	public function deleteContact($idContact){
		$this -> ContactModel -> deleteContact($idContact);
		$this -> consultContact($idContact);	
	}
}
?>

<?php
class ContactsController{
	function __construct(){
		require_once("models/ContactsModel.php");
		$this -> ContactModel = new ContactsModel();
	}

	public function listContacts($search = null){
		$this -> ContactModel -> listContacts($search);
			$result = $this -> ContactModel -> getConsult();
			$arrayContacts = array();
			while($line = $result->fetch_assoc())
			{
				array_push($arrayContacts,$line); 
			}
			header('Content-Type: application/json');
			echo json_encode($arrayContacts);
	}

	public function consultContact($idContact){	
		
		$this -> ContactModel -> consultContact($idContact);
		$result = $this -> ContactModel -> getConsult();
		
		$contact = $result->fetch_assoc();			

		header('Content-Type: application/json');
		echo json_encode($contact);
	}

	
	public function insertContact()
	{
		$contact = json_decode(file_get_contents("php://input"));
		$arrayContact["name"] = $contact -> name;
		$arrayContact["message"] = $contact -> message;
		$arrayContact["email"] = $contact -> email;
	
		$this -> ContactModel -> insertContact($arrayContact);
		$isertedId = $this -> ContactModel -> getConsult();
		
		$this -> ContactModel -> consultContact($isertedId);
		$result = $this -> ContactModel -> getConsult();
			
		$contact = $result->fetch_assoc();			

		header('Content-Type: application/json');
		echo json_encode($contact);
	}
	
	public function updateContact($idContact) {
		$contact = json_decode(file_get_contents("php://input"));
		$arrayContact["idContact"] = $idContact;
		$arrayContact["status"] = $contact -> status;
		$arrayContact["description"] = $contact -> description;
		$this -> ContactModel -> updateContact($arrayContact);	
		$this -> consultContact($arrayContact["idContact"]);
	}

	public function deleteContact($idContact){
		$this -> ContactModel -> deleteContact($idContact);
		$this -> consultContact($idContact);	
	}
}
?>

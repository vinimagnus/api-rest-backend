<?php		
class ContactsModel{
	var $result;
	var $conn;

	function __construct(){
		require_once("db/ConnectClass.php");
		$Oconn = new ConnectClass();
		$Oconn -> openConnect();
		$this -> conn = $Oconn -> getConnect();
	}
			
	public function listContacts($search){
		if($search == null){
			$sql = "SELECT * FROM contacts";
		}else{
			$sql = "SELECT * FROM contacts WHERE idContact LIKE '%{$search}%'
			OR name LIKE '%{$search}%'
			OR email LIKE '%{$search}%'
			OR message LIKE '%{$search}%'
			OR description LIKE '%{$search}%'
			";
		}			
		$this -> result = $this -> conn -> query($sql);				
	}

	public function consultContact($idContact){
		$sql = "
			SELECT * FROM contacts 
			WHERE idContact = {$idContact}
		;";	
		$this -> result = $this -> conn -> query($sql);			
	}

	public function insertContact($arrayContact){
		$sql = "
			INSERT INTO contacts (name, email, message, status, description) 
			VALUES (
				'{$arrayContact['name']}', 
				'{$arrayContact['email']}', 
				'{$arrayContact['message']}',
				'0',
				''

			)
		;";		
		$this -> conn -> query($sql);
		
		$this -> result = $this -> conn -> insert_id;
	}

	public function updateContact($arrayContact)
	{
		$sql = "
			UPDATE contacts SET 
				status = {$arrayContact['status']},
				description = '{$arrayContact['description']}'
			WHERE
				idContact = {$arrayContact['idContact']}
		;";		
		$this -> conn -> query($sql);
		
	}

	public function deleteContact($idContact){
		$sql = "
			DELETE FROM contacts
			WHERE
				idContact = {$idContact}
		;";		

		$this -> conn -> query($sql);
	}

	public function getConsult()
	{
		return $this -> result;
	}
}
?>

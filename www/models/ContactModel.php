<?php		
class ContactModel{
	
	var $Connection;

	function __construct(){
		require_once('db/ConnectClass.php');
        $ConnectClass = new ConnectClass();
        $ConnectClass -> openConnect();
        $this -> Connection = $ConnectClass -> getConnection();
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
		return $this -> Connection -> query($sql);				
	}

	public function consultContact($idContact){
		$sql = "
			SELECT * FROM contacts 
			WHERE idContact = {$idContact}
		;";	
		return $this -> Connection -> query($sql);			
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
		$this -> Connection -> query($sql);
		return $this -> Connection -> insert_id;
	}

	public function updateContact($arrayContact){
		$sql = "
			UPDATE contacts SET 
				status = {$arrayContact['status']},
				description = '{$arrayContact['description']}'
			WHERE
				idContact = {$arrayContact['idContact']}
		;";		
		$this -> Connection -> query($sql);
	}

	public function deleteContact($idContact){
		$sql = "
			DELETE FROM contacts
			WHERE
				idContact = {$idContact}
		;";		
		$this -> Connection -> query($sql);	
	}
}
?>

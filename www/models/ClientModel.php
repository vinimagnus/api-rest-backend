<?php		
class ClientModel{
	
	var $Connection;

	function __construct(){
		require_once('db/ConnectClass.php');
        $ConnectClass = new ConnectClass();
        $ConnectClass -> openConnect();
        $this -> Connection = $ConnectClass -> getConnection();
	}
			
	public function listClients($search){
		if($search == null){
			$sql = "SELECT * FROM clients";	
		}else{
			$sql = "SELECT * FROM clients WHERE idClient LIKE '%{$search}%'
			OR name LIKE '%{$search}%' 
			OR email LIKE '%{$search}%'
			OR phone LIKE '%{$search}%'
			OR address LIKE '%{$search}%'
			";
		}
		return $this -> Connection -> query($sql);			
	}

	public function consultClient($idClient){
		$sql = "
			SELECT * FROM clients 
			WHERE idClient = {$idClient}
		;";	
		return $this -> Connection -> query($sql);			
	}

	public function insertClient($arrayClient){
		$sql = "
			INSERT INTO clients (name, phone, email, address) 
			VALUES (
				'{$arrayClient['name']}', 
				'{$arrayClient['phone']}', 
				'{$arrayClient['email']}', 
				'{$arrayClient['address']}'
			)
		;";		
		$this -> Connection -> query($sql);
		return $this -> Connection -> insert_id;
	}

	public function updateClient($arrayClient){
		$sql = "
			UPDATE clients 
				set 
					name='{$arrayClient['name']}',
					email='{$arrayClient['email']}', 
					phone='{$arrayClient['phone']}', 
					address='{$arrayClient['address']}' 
				where 
					idClient={$arrayClient['idClient']}
		;";
		
		return $this -> Connection -> query($sql);	
	}		

	public function deleteClient($idClient){
		$sql = "
			DELETE FROM clients 
			where 
				idClient={$idClient};
		";
		return $this -> Connection -> query($sql);
	}			
}
?>

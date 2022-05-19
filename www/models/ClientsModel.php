<?php		
class ClientsModel{
	var $result;
	var $conn;

	function __construct(){
		require_once("db/ConnectClass.php");
		$Oconn = new ConnectClass();
		$Oconn -> openConnect();
		$this -> conn = $Oconn -> getConnect();
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

		$this -> result = $this -> conn -> query($sql);	
				
	}

	public function consultClient($idClient){
		$sql = "
			SELECT * FROM clients 
			WHERE idClient = {$idClient}
		;";	

		$this -> result = $this -> conn -> query($sql);			
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
		
		$this -> conn -> query($sql);

		$this -> result = $this -> conn -> insert_id;
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
		
		$this -> result = $this -> conn-> query($sql);	
	}		

	public function deleteClient($idClient){
		$sql = "
			DELETE FROM clients 
			where 
				idClient={$idClient};
		";
		$this -> result = $this -> conn -> query($sql);
	}			
	
	public function getConsult()
	{
		return $this -> result;
	}
}
?>

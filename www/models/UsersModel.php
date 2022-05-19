<?php	
class UsersModel{
		
	var $result;

	public function __construct(){
		require_once("db/ConnectClass.php");
		$Oconn = new ConnectClass();
		$Oconn -> openConnect();
		$this -> conn = $Oconn -> getConnect();
	}
	
	public function consultUser($user){
		$sql = "
			SELECT * FROM users WHERE user='{$user}'
		";
		$this -> result = $this -> conn -> query($sql);
	}
	
	public function getConsult(){
		return $this -> result;
	}
}
?>
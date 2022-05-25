<?php	
class UserModel{
		
	var $Connection;

	public function __construct(){
		require_once('db/ConnectClass.php');
        $ConnectClass = new ConnectClass();
        $ConnectClass -> openConnect();
        $this -> Connection = $ConnectClass -> getConnection();
	}
	
	public function consultUser($user){
		$sql = "
			SELECT * FROM users 
			WHERE user='{$user}'
		";
		return $this -> Connection -> query($sql);
	}
	
	
}
?>
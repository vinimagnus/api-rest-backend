<?php		
class SiteModel{

	var $Connection;

	function __construct(){
		require_once('db/ConnectClass.php');
        $ConnectClass = new ConnectClass();
        $ConnectClass -> openConnect();
        $this -> Connection = $ConnectClass -> getConnection();
	}
			
	public function listSites(){
		$sql = "SELECT * FROM pages";			
		return $this -> Connection -> query($sql);		
	}

	public function consultSite($idSite){
		$sql = "
			SELECT * FROM pages 
			WHERE idPage = {$idSite}
		;";	
		return $this -> Connection -> query($sql);			
	}
}
?>

<?php		
class SitesModel{
	var $result;
	var $conn;

	function __construct(){
		require_once("db/ConnectClass.php");
		$Oconn = new ConnectClass();
		$Oconn -> openConnect();
		$this -> conn = $Oconn -> getConnect();
	}
			
	public function listSites(){
		$sql = "SELECT * FROM pages";			
		$this -> result = $this -> conn -> query($sql);		
		
	}

	public function consultSite($idSite){
		$sql = "
			SELECT * FROM pages 
			WHERE idPage = {$idSite}
		;";	
		$this -> result = $this -> conn -> query($sql);			
	}
	public function getConsult()
	{
		return $this -> result;
	}
}
?>

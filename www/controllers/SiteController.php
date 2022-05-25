<?php
class SiteController{

	function __construct(){
		require_once("models/SiteModel.php");
		$this -> SiteModel = new SiteModel();
	}

	public function listSites(){
		$result = $this -> SiteModel -> listSites();
		
		$arraySites = array();
		
		while($line = $result->fetch_assoc())
		{
			array_push($arraySites,$line); 
		}
	
		header('Content-Type: application/json');
		echo (json_encode($arraySites));	
	}

	public function consultSite($idSite){
		$result = $this -> SiteModel -> consultSite($idSite);
		$site = $result->fetch_assoc();			

		header('Content-Type: application/json');
		echo json_encode($site);
	}
}
?>

<?php
class SitesController
{
	function __construct()
	{
		require_once("models/SitesModel.php");
		$this -> SiteModel = new SitesModel();
	}

	public function listSites(){
		$this -> SiteModel -> listSites();
		$result = $this -> SiteModel -> getConsult();
		
		$arraySites = array();
		
		while($line = $result->fetch_assoc())
		{
			array_push($arraySites,$line); 
		}
	
		header('Content-Type: application/json');
		echo (json_encode($arraySites));	
	}

	public function consultSite($idSite)
	{
				
		$this -> SiteModel -> consultSite($idSite);
		$result = $this -> SiteModel -> getConsult();
		
		$site = $result->fetch_assoc();			

		header('Content-Type: application/json');
		echo json_encode($site);
	}

	

}

?>

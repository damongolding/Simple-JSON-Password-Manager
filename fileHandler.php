<?php

	class FileHandler
	{
		public $siteName;
		public $serverName;
		public $userName;
		public $password;
		public $toDelete;
		public $theFile;
		public $selector;
		public $rusult = "SUCCESS";
		
		function __construct()
		{
			if(isset($_GET['siteName'])){ $this->siteName = $_GET['siteName']; $this->theFile = "json/" . $this->siteName . ".json";}
			if(isset($_GET['serverName'])) { $this->serverName = $_GET['serverName']; }
			if(isset($_GET['userName'])) { $this->userName = $_GET['userName']; }
			if(isset($_GET['password'])) { $this->password = $_GET['password']; }
			if(isset($_GET['toDelete'])) { $this->toDelete = $_GET['toDelete']; }

			$this->selector = $_GET['selector'];
			
			switch($this->selector)
			{
				case "addSite":
					$this->addSite();
					break;
				
				case "deleteSite":
					$this->deleteSite();
					break;
					
				case "addServer":
					$this->addServer();
					break;
					
				case "deleteServer":
					$this->deleteServer();
					break;
			}
				

		}
		public function __destruct()
		{
			echo $this->result;
		}
		
		// get raw file data
		public function getFileData()
		{
			$JSON = file_get_contents($this->theFile,true);
			return $rawData = json_decode($JSON,true); 
		}
		
		// save file with new content
		public function saveFile($newContent)
		{
			$contentToSave = json_encode($newContent);
			$openFile = fopen($this->theFile,"w");
			fwrite($openFile,$contentToSave);
			fclose($openFile);
		}
		
		//add a new site
		public function addSite()
		{			
			if(file_exists($this->theFile))
			{
				$this->result = "EXISTS";
			}
			else
			{
				$newServerOrSite = array(
					$this->serverName => array(
						"serverName" => $this->serverName,
						"username" => $this->userName,
						"password" => $this->password
					)
				);
				$this->saveFile($newServerOrSite);
			}
			
		}
		
		//delete a site
		public function deleteSite()
		{
			if(file_exists($this->theFile))
			{
				unlink($this->theFile);

			}
			else
			{
				$this->result = "MISSING";	
			}

		}
		
		// add a new server
		public function addServer()
		{	
			$newServerOrSite = array(
				$this->serverName => array(
					"serverName" => $this->serverName,
					"username" => $this->userName,
					"password" => $this->password
				)
			);
			//get file contents and merge them to the end of the array
			$addedServer = array_merge($this->getFileData(),$newServerOrSite);
			//save file
			$this->saveFile($addedServer);
		}
		
		// delete a server
		public function deleteServer()
		{
			//get file contents
			$rawData = $this->getFileData();
			
			unset($rawData[$this->toDelete]);
			echo $this->toDelete;
			var_dump($rawData);
			
			//save file
			$this->saveFile($rawData);
		}
	}
	
	$obj = new FileHandler;
	
?>
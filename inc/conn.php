<?php

Class Database{
 
	private $server = "mysql:host=localhost;dbname=amablog";
	private $username = "root";
	private $password = ""; 
	
	// private $server = "mysql:host=sql112.ezyro.com;dbname=ezyro_28103224_amablog";
	// private $username = "ezyro_28103224";
	// private $password = "xp8oc776"; 
	
	private $options  = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,);
	protected $conn;
 	
	public function open(){
 		try{
 			$this->conn = new PDO($this->server, $this->username, $this->password, $this->options);
 			return $this->conn;
 		}
 		catch (PDOException $e){
 			echo "There is a problem in connection: " . $e->getMessage();
 		}
 
    }
 
	public function close(){
   		$this->conn = null;
 	}
 
}

$pdo = new Database();
 
?>
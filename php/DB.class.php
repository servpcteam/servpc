<?php
require_once('DBconfig.class.php');

class DBconnector {
	private $DBhost;
	private $DBlogin;
	private $DBpassword;
	private $DBname;
	private $db;

	public function __construct(){
		$this->DBhost = DBconfig::host;
		$this->DBlogin = DBconfig::login;
		$this->DBpassword = DBconfig::password;
		$this->DBname = DBconfig::database;
		$this->connect();
	}

	public function connect(){
        $this->db = new mysqli($this->DBhost, $this->DBlogin, $this->DBpassword, $this->DBname);
		if ($this->db->connect_errno) {
		    echo "Failed to connect to MySQL: (" . $this->db->connect_errno . ") " . $this->db->connect_error;
		}
		$this->execute('SET NAMES utf8');
	}

	public function execute($stmt) {
	
		$res = $this->db->query($stmt);
		if (!$res) {
		    throw new Exception("Database Error [{$this->db->errno}] {$this->db->error}");
		}
		return $res;
	}

	public function get_array($stmt){
		$res = $this->db->query($stmt);
		if (!$res) {
		    throw new Exception("Database Error [{$this->db->errno}] {$this->db->error}");
		}
		$data = array();
		$res->data_seek(0);
		while ($row = $res->fetch_assoc()) {
    		array_push($data, $row);
		}
		return $data;
	}

}
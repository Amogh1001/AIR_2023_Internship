<?php
require __DIR__.'/Database.php';
class rest{
	private $mysqli;
	private $db_connection;
	private $table = "hr";
	
	public function __construct() {
		$this->db_connection = new Database();
		$this->mysqli = new mysqli($this->db_connection->servername, $this->db_connection->username, $this->db_connection->password, $this->db_connection->dbname);
	}

	public function create($getName, $getNum, $getemail, $getaddress, $getlogin, $getpwd, $getdate){
		$query = "INSERT INTO hr(name, mobile_number, email, address, login_name, pwd, dt_creation) VALUES (?, ?, ?, ?, ?, ?, ?)";
		if ($this->mysqli->execute_query($query, [$getName, $getNum, $getemail, $getaddress, $getlogin, $getpwd, $getdate]) === TRUE) {
			return 1;
		} else {
			return 0;
		}
	}

	public function read($getlogin, $getpwd) {
		$query = "SELECT * FROM `$this->table` WHERE login_name = ? AND pwd = ?";
        $result = $this->mysqli->execute_query($query, [$getlogin, $getpwd]);
		$techarray = array();
		while($row =mysqli_fetch_assoc($result)){
			$techarray[] = $row;
		}
		return json_encode($techarray);
	}

	public function delete($getid) {
		$query = "DELETE FROM `$this->table` WHERE id = ?";
		if ($this->mysqli->execute_query($query, [$getid]) === TRUE) {
			return 1;
		} else {
			return 0;
		}	
	}
}
?>
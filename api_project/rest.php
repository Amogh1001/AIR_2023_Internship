<?php

require __DIR__.'/database.php';

class rest{
	private $mysqli;
	private $db_connection;
	private $table = "hr";
	
	public function __construct() {
		$this->db_connection = new Database();
		$this->mysqli = new mysqli($this->db_connection->servername, $this->db_connection->username, $this->db_connection->password, $this->db_connection->dbname);
	}

	public function create($getName, $getNum, $getemail, $getaddress, $getlogin, $getpwd, $getdate){
		$getpwd = password_hash($getpwd, PASSWORD_BCRYPT);
		$query = "INSERT INTO hr(name, mobile_number, email, address, login_name, pwd, dt_creation) VALUES (?, ?, ?, ?, ?, ?, ?)";
		if ($this->mysqli->execute_query($query, [$getName, $getNum, $getemail, $getaddress, $getlogin, $getpwd, $getdate]) === TRUE) {
			return 1;
		} else {
			return 0;
		}
	}

	public function login($getlogin, $getpwd) {
		$query = "SELECT * FROM `$this->table` WHERE login_name = ?";
		$result = $this->mysqli->execute_query($query, [$getlogin]);
		if($result->num_rows == 0){
			echo "Invalid username or password";
			exit();
		}
		$user = $result->fetch_assoc();
		if (password_verify($getpwd, $user["pwd"])) {
			$token = bin2hex(random_bytes(32));
			$updateQuery = "UPDATE hr SET token=? WHERE id=?";
			$this->mysqli->execute_query($updateQuery, [$token, $user["id"]]);
			$_SESSION["token"] = $token;
			return 1;
		} else {
			return 0;
		}
	}

	public function read($token) {
		$query = "SELECT * FROM `$this->table` WHERE token = ?";
        $result = $this->mysqli->execute_query($query, [$token]);
		$techarray = array();
		while($row =mysqli_fetch_assoc($result)){
			$techarray[] = $row;
			unset($techarray[0]["token"]);
		}
		$techarray = json_encode($techarray);
		return $techarray;
	}

	public function update($token, $getName, $getNum, $getemail, $getaddress, $getlogin, $getpwd) {
		$getdate = date("Y-m-d H:i:s");
		$getpwd = password_hash($getpwd, PASSWORD_BCRYPT);
		$query = "UPDATE `$this->table` SET name = ?, mobile_number = ?, email = ?, address = ?, login_name = ?, pwd = ?, dt_creation = ? WHERE token = ?";
		if ($this->mysqli->execute_query($query, [$getName, $getNum, $getemail, $getaddress, $getlogin, $getpwd, $getdate, $token]) === TRUE) {
			return 1;
		} else {
			return 0;
		}
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
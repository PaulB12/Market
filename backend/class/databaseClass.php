<?php
//An class that should handle database related stuff
class databaseConnection {
    //Database information
    private $db_servername	= "77.72.0.102";
	private $db_username	= "evocityi_market2";
 	private $db_password	= "mU89yqgwqMyA";
	private $db_name 		= "evocityi_market2";
    public $conn;


    public function sanatize($input) {
        $output = preg_replace('/[^A-Za-z0-9 !@#$%^&*():._]/u','', strip_tags($input));
        $output = htmlspecialchars($output);
        $output = mysqli_real_escape_string($this->conn,$output);
        return $output;
    }

    public function sanatize2($input) {
        $output = htmlspecialchars($input);
        $output = mysqli_real_escape_string($this->conn,$output);
        return $output;
    }

    public function __construct() {
		    $this->conn = new mysqli($this->db_servername, $this->db_username, $this->db_password, $this->db_name);
		    if ($this->conn->connect_error) {
		        die("Connection failed: " . $this->conn->connect_error);
		    }
	  }

	  public function insert($table, $cols, $vals) {
		    $status = $this->conn->query("INSERT INTO `".$table."` (".join(', `', preg_split('/,\s+/', $cols)).") VALUES (".join("', '", preg_split('/,\s+/', $vals)).")");

		    if (!$status){
			    die('Error: '.$this->conn->error);
		    }
		    return $this->conn->insert_id;
	  }

	public function select($cols, $table, $expression='')
	{
        //echo "SELECT ".$cols." FROM ".$table." ".$expression;
		$result = $this->conn->query("SELECT ".$cols." FROM ".$table." ".$expression);
		if (!$result){
			die('Error: '.$this->conn->error);
		}
		return $result;
	}

    public function update($cols, $table, $vals, $expression='')
    {
        $result = $this->conn->query("UPDATE `".$table."` SET ".join(', `', preg_split('/,\s+/', $cols))." = ".join("', '", preg_split('/,\s+/', $vals))." ".$expression);
        if (!$result){
			die('Error: '.$this->conn->error);
		}
    }
}
?>

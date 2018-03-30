<?php 

/**
 * summary
 */
class Database 
{
    /**
     * summary
     */
    private $dbHost = 'localhost';
    private $dbUser = 'root';
    private $dbPword = '';
    private $dbName = 'test';

    protected $conn;

    public function dbConnect(){

    	$this->conn = null;

        try{
            $this->conn = new PDO("mysql:host=".$this->dbHost.";dbname=".$this->dbName, $this->dbUser, $this->dbPword);
            $this->conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $this->conn;
            
        }catch(PDOException $e){
        	file_put_contents("dberror.log", "Date: " . date('M-j-Y - h:i:A') . " == Error: " . $e->getMessage().PHP_EOL, FILE_APPEND);
            die("Failed to connect to the database: {$e->getMessage()}");
        }

    }
   
}

/**
 * summary
 */
class Message extends Database
{
    //properties for message
    private $name;
    private $msg;

    //db connection
    protected $conn;

    //inherits db connection from parent 'Database'
    public function __construct()  {
         $this->conn = parent::dbConnect();
    }

    public function insert($name, $msg) {

    	$this->name = $name;
    	$this->msg = $msg;

    	$query = "INSERT INTO chat (name, msg) VALUES (:name, :msg)";


    	//prepare statement
		$stmt = $this->conn->prepare($query);
 
        // bind parameters
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':msg', $this->msg);
        
     
        // execute the query
		$stmt->execute();
    
    }

    public function readAll() {
    	$query = "SELECT name, msg, created_at AS date FROM chat "; //ORDER BY id DESC";
    	$stmt = $this->conn->prepare($query);
        $stmt->execute();

        //fetch data
        $res = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $res;
    }
    public function readLastRow() {
    	$query = "SELECT name, msg FROM chat ORDER BY id DESC LIMIT 1";
    	$stmt = $this->conn->prepare($query);
        $stmt->execute();

        //fetch data
        $res = $stmt->fetch(PDO::FETCH_OBJ);
        return $res;
    }

    //snippet
    public function timeAgo($timestamp){
      
      date_default_timezone_set("Asia/Manila");         
      $time_ago        = strtotime($timestamp);
      $current_time    = time();
      $time_difference = $current_time - $time_ago;
      $seconds         = $time_difference;
      
      $minutes = round($seconds / 60); // value 60 is seconds  
      $hours   = round($seconds / 3600); //value 3600 is 60 minutes * 60 sec  
      $days    = round($seconds / 86400); //86400 = 24 * 60 * 60;  
      $weeks   = round($seconds / 604800); // 7*24*60*60;  
      $months  = round($seconds / 2629440); //((365+365+365+365+366)/5/12)*24*60*60  
      $years   = round($seconds / 31553280); //(365+365+365+365+366)/5 * 24 * 60 * 60
                    
      if ($seconds <= 60){

        return "Just Now";

      } else if ($minutes <= 60){
      	
        if ($minutes == 1){

          return "1 minute ago";

        } else {

          return "$minutes minutes ago";

        }

      } else if ($hours <= 24){

        if ($hours == 1){

          return "1 hour ago";

        } else {

          return "$hours hrs ago";

        }

      } else if ($days <= 7){

        if ($days == 1){

          return "yesterday";

        } else {

          return "$days days ago";

        }

      } else if ($weeks <= 4.3){

        if ($weeks == 1){

          return "a week ago";

        } else {

          return "$weeks weeks ago";

        }

      } else if ($months <= 12){

        if ($months == 1){

          return "1 month ago";

        } else {

          return "$months months ago";

        }

      } else {
        
        if ($years == 1){

          return "1 year ago";

        } else {

          return "$years years ago";

        }
      }
    }
 
}

?>
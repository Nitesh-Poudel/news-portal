<?php
class Database{
    private$password = '';
    private$username = 'root';
    private$db = 'newsportal';
    private$host='Localhost';
    private$mysqli='';
    private$message=array();
  

    private$con ;

    public function __construct(){
       $this->con=mysqli_connect($this->host, $this->username, $this->password, $this->db);

       if (!$this->con) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    public function getConnection() {
        return $this->con;
    }

    public function insert($table,$parameters=array()){
         
        if($this->tableExist($table)){

            $fields=implode(', ', array_keys($parameters));
            $values=implode("', '",$parameters);
            $sql="INSERT INTO $table ($fields)VALUES ('$values')";

            if($sql){
                $insertqry=mysqli_query($this->con,$sql);
                if($insertqry){
                    echo"Insert_sucessfully";
                }
                else{
                    echo"failed_to_insert";
                }
            }
        }
        
        else{

        }
    
    }

    private function tableExist($table){
        $sql="SHOW TABLES FROM $this->db LIKE '$table'";
        $table=mysqli_query($this->con,$sql);
        if($table->num_rows==1){
            echo"yesssssssssssssssss";
            return true;
        }
        else{
           // $message = $table . " table not exists"; // Creating the error message
        //$this->message[] = $message; // Assuming $this->messages is an array property
        echo"table_not_exist";
        return false;
        
        }

    }


}



$con=new Database;
   
?>

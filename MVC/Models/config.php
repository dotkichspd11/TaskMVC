<?php 
class DB{
    public $conn = NULL;
    public $result = NULL;
    public $servername = "localhost";
    public $username = "root";
    public $password = "";
    public $dbname = "testmvc";

    
    function connect(){
        $this->conn = mysqli_connect($this->servername, $this->username, $this->password, $this->password);
        mysqli_select_db($this->conn, $this->dbname);
        if($this->conn === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        } else {
            mysqli_query($this->conn, "SET NAMES 'utf8'");
            
        }
        return $this->conn;
    }


    public function execute($sql){
        $this->result = $this->conn->query($sql);
        return $this->result;
    }

    public function getData(){
        if($this->result){
            $data = mysqli_fetch_array($this->result);
        } else {
            $dato = 0;
        }
        return $data;
    }

    public function getDataID($table, $id){
        $sql = "SELECT * FROM $table WHERE id = '$id'";
        $this->execute($sql);
        if($this->result->num_rows != 0){
            $data = mysqli_fetch_array($this->result);
        }else {
            $data = 0;
        }
        return $data;
    }

    public function getAllData(){
        if(!$this->result){
            $data = 0;
        } else {
            while($datas = $this->getData()){
                $data[] = $datas; 
            }
        }
        return $data;
    }

    public function addData( $fullname, $email, $phone, $dateofbirth){
        $sql = "INSERT INTO customer(id, fullname, email, phone, dateofbirth) VALUES (null, '$fullname', '$email', '$phone', '$dateofbirth')";
        return $this->execute($sql);
    }

    public function updateData($id, $fullname, $email, $phone, $dateofbirth){
        $sql = "UPDATE customer SET fullname = '$fullname', email = '$email', phone = '$phone', dateofbirth = '$dateofbirth' where id = '$id'";
        return $this->execute($sql);
    }

    public function deleteData($id,$table){
        $sql = "DELETE FROM $table WHERE id = '$id'";
        return $this->execute($sql);
    }
}

    
?>
<?php

class Database{
    private $host = "localhost";
    private $db_name = "shadivivah";
    private $user = "root";
    private $password = "";

    protected function connect(){
        $conn = null;

        try{
            $conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->user, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo "Connection Error: " . $e->getMessage();
        }

        return $conn;
    }
}

class query extends Database{
    public function getData($table, $fields = '*', $conditionArr){
          $condition = "";
            foreach($conditionArr as $key => $value){
                $condition .= "$key = :$key AND ";
            }
            $condition = rtrim($condition, " AND ");
            $sql = "SELECT $fields FROM $table WHERE $condition";
            $stmt = $this->connect()->prepare($sql);
            foreach($conditionArr as $key => $value){
                $stmt->bindValue(":$key", $value);
            }
            $stmt->execute();
            return $stmt;        
    }

    public function insertData($table, $data){
        $fields = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        $sql = "INSERT INTO $table ($fields) VALUES ($placeholders)";
        $stmt = $this->connect()->prepare($sql);
        foreach($data as $key => $value){
            $stmt->bindValue(":$key", $value);
        }
        return $stmt->execute();
    }
    public function updateData($table, $data, $conditionArr){
        $set = "";
        foreach($data as $key => $value){
            $set .= "$key = :$key, ";
        }
        $set = rtrim($set, ", ");
        $condition = "";
        foreach($conditionArr as $key => $value){
            $condition .= "$key = :cond_$key AND ";
        }
        $condition = rtrim($condition, " AND ");
        $sql = "UPDATE $table SET $set WHERE $condition";
        $stmt = $this->connect()->prepare($sql);
        foreach($data as $key => $value){
            $stmt->bindValue(":$key", $value);
        }
        foreach($conditionArr as $key => $value){
            $stmt->bindValue(":cond_$key", $value);
        }
        return $stmt->execute();

    }

    public function deleteData($table, $conditionArr)
    {
        $condition = "";
        foreach ($conditionArr as $key => $value) {
            $condition .= "$key = :$key AND ";
        }
        $condition = rtrim($condition, " AND ");
        $sql = "DELETE FROM $table WHERE $condition";
        $stmt = $this->connect()->prepare($sql);
        foreach ($conditionArr as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        return $stmt->execute();
    }
    
    public function searchData($table, $searchArr, $fields = '*'){
        $condition = "";
        foreach($searchArr as $key => $value){
            $condition .= "$key LIKE :$key OR ";
        }
        $condition = rtrim($condition, " OR ");
        $sql = "SELECT $fields FROM $table WHERE $condition";
        $stmt = $this->connect()->prepare($sql);
        foreach($searchArr as $key => $value){
            $stmt->bindValue(":$key", "%$value%");
        }
        $stmt->execute();
        return $stmt;
    }

   

   
}



?>
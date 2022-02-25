<?php
    class dbconn {
        public function connect()
        {
            $host = 'localhost';
            $user = 'root';
            $pass = '';
            $db = 'libtest01';
        
            $statement = "mysql:host=$host;dbname=$db;charset=UTF8;";
            try {
                $conn = new PDO($statement,$user,$pass);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $conn;
            } catch (PDOException $e) {
                echo "Connection failed : ".$e->getMessage();
            }
        }
    }
?>
<?php
///wG}y+a1{YE8/Sr/ senha do webhost
    class Database
    {
        private $host = 'localhost';
        private $db_name = 'Codificando';
        private $username = 'root';
        private $password = '';
        private $conn;
        // DB Connect
        public function connect() {
          $this->conn = null;
          try { 
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          } catch(PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
          }
          return $this->conn;
        }
    }
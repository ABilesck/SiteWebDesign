<?php
    class Perfil
    {
        private $conn;
        private $nomeTabela = '`tblPerfil`';

        public $id;
        public $nome;
        public $bio;
        public $senha;

        public function __construct($db)
        {
            $this->conn = $db;
            $this->id = 0;
            $this->nome = "";
            $this->bio = "";
            $this->senha = "";
        }

        public function create()
        {
            $querry = 'INSERT INTO ' . $this->nomeTabela .
            ' (`usuario`, `bio`, `senha`) VALUES (?, ?, ?)';

            $stmt = $this->conn->prepare($querry);

            $this->nome = htmlspecialchars(strip_tags($this->nome));
            $this->bio = htmlspecialchars(strip_tags($this->bio));
            $this->senha = htmlspecialchars(strip_tags($this->senha));

            $stmt->bindParam(1, $this->nome);
            $stmt->bindParam(2, $this->bio);
            $stmt->bindParam(3, $this->senha);

            if($stmt->execute())
            {
                return true;
            }
            
            printf("Erro :%s\n", $stmt->error);
            return false;
        }

        public function read(){
            $query = 'SELECT `id_perfil`, `usuario`, `bio`, `senha` FROM '.$this->nomeTabela;

        $stmt = $this->conn->prepare($query);
        // Execute query
        $stmt->execute();
        return $stmt;
        }

        public function read_single(){
            $query = 'SELECT
                id_perfil,
                usuario,
                bio,
                senha
            FROM '.$this->nomeTabela .
            ' Where 
            id_perfil = ?
            LIMIT 0,1';

            $stmt = $this->conn->prepare($query);
          // Bind ID
          $stmt->bindParam(1, $this->id);
          // Execute query
          $stmt->execute();
          $row = $stmt->fetch(PDO::FETCH_ASSOC);
          // Set properties
          $this->nome = $row['usuario'];
          $this->bio = $row['bio'];
          $this->senha = $row['senha'];

          $resposta = array(
            'id' => (int)$this->id,
            'nome' => $this->nome,
            'bio' => $this->bio,
            'senha' => $this->senha
          );
  
          return $resposta;
        }

        public function read_name(){
          $query = 'SELECT
              id_perfil,
              usuario,
              bio,
              senha
          FROM '.$this->nomeTabela .
          ' Where 
          usuario = ?
          LIMIT 0,1';

          $stmt = $this->conn->prepare($query);
        // Bind ID
        $stmt->bindParam(1, $this->nome);
        // Execute query
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // Set properties
        $this->id = $row['id_perfil'];
        $this->nome = $row['usuario'];
        $this->bio = $row['bio'];
        $this->senha = $row['senha'];
        
        $resposta = array(
          'id' => (int)$this->id,
          'nome' => $this->nome,
          'bio' => $this->bio,
          'senha' => $this->senha
        );

        return $resposta;
      }

        public function login(){
          $query = 'SELECT
              id_perfil,
              usuario,
              bio,
              senha
          FROM '.$this->nomeTabela .
          ' Where 
          usuario = ? AND senha = ?';

          $stmt = $this->conn->prepare($query);
        // Bind ID
        $stmt->bindParam(1, $this->nome);
        $stmt->bindParam(2, $this->senha);
        // Execute query
        if($stmt->execute())
        {
          $row = $stmt->fetch(PDO::FETCH_ASSOC);
          // Set properties
          $this->id = $row['id_perfil'];
          $this->nome = $row['usuario'];
          $this->bio = $row['bio'];
          $this->senha = $row['senha'];
          

          $resposta = array(
            'id' => (int)$this->id,
            'nome' => $this->nome,
            'bio' => $this->bio,
            'senha' => $this->senha
          );
  
        }else{
          $resposta = array(
            'id' => 0,
            'nome' => "",
            'bio' => "",
            'senha' => ""
          );
        }
        return $resposta;
        
        
      }

        public function update() {
            // Create query
            $query = 'UPDATE ' . $this->nomeTabela . '
                                  SET usuario = :nome, bio = :bio, senha = :senha
                                  WHERE id_perfil = :id';
            // Prepare statement
            $stmt = $this->conn->prepare($query);
            // Clean data
            $this->nome = htmlspecialchars(strip_tags($this->nome));
            $this->telefone = htmlspecialchars(strip_tags($this->telefone));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->id = htmlspecialchars(strip_tags($this->id));
            // Bind data
            $stmt->bindParam(':nome', $this->nome);
            $stmt->bindParam(':bio', $this->bio);
            $stmt->bindParam(':senha', $this->senha);
            $stmt->bindParam(':id', $this->id);
            // Execute query
            if($stmt->execute()) {
              return true;
            }
            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);
            return false;
      }

      public function delete() {
        // Create query
        $query = 'DELETE FROM ' . $this->nomeTabela . ' WHERE id_perfil = :id';
        // Prepare statement
        $stmt = $this->conn->prepare($query);
        // Clean data
        $this->id = htmlspecialchars(strip_tags($this->id));
        // Bind data
        $stmt->bindParam(':id', $this->id);
        // Execute query
        if($stmt->execute()) {
          return true;
        }
        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);
        return false;
  }
    }
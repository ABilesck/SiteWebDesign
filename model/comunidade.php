<?php

    class Comunidade
    {
        public $conn;
        private $nomeTabela = '`tblComunidade`';

        public $id;
        public $nome;
        public $descricao;
        public $tema;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function create()
        {
            $querry = 'INSERT INTO ' . $this->nomeTabela .
            ' (`nome`, `descricao`, `tema`) VALUES (?, ?, ?)';

            $stmt = $this->conn->prepare($querry);

            $this->nome = htmlspecialchars(strip_tags($this->nome));
            $this->descricao = htmlspecialchars(strip_tags($this->descricao));
            $this->tema = htmlspecialchars(strip_tags($this->tema));

            $stmt->bindParam(1, $this->nome);
            $stmt->bindParam(2, $this->descricao);
            $stmt->bindParam(3, $this->tema);

            if($stmt->execute())
            {
                return true;
            }

            printf("Erro :%s\n", $stmt->error);
            return false;
        }

        public function read(){
            $query = 'SELECT `id_comunidade`, `nome`, `descricao`, `tema` FROM '.$this->nomeTabela;

        $stmt = $this->conn->prepare($query);
        // Execute query
        $stmt->execute();
        return $stmt;
        }

        public function PesquisarPorNome()
        {
              $query = 'SELECT
                id_comunidade,
                nome,
                descricao,
                tema 
              FROM '.$this->nomeTabela .
            '  Where 
            nome LIKE ?';

            $stmt = $this->conn->prepare($query);
            // Bind ID
            $stmt->bindParam(1, $this->nome);
            // Execute query
            $stmt->execute();

            $Resultado = array();
            $Resultado['comunidades'] = array();
            // Set properties
            while($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {
              extract($row);
      
              $item = array(
                'idComunidade' => $row['id_comunidade'],
                'comunidade' => $row['nome'],
                'tema' => $row['tema'],
                'descricao' => $row['descricao']
              );
      
              array_push($Resultado['comunidades'], $item);
            }

            return $Resultado['comunidades'];
          }

          public function PesquisarPorTema()
        {
              $query = 'SELECT
                id_comunidade,
                nome,
                descricao,
                tema 
              FROM '.$this->nomeTabela .
            '  Where 
            tema LIKE ?';

            $stmt = $this->conn->prepare($query);
            // Bind ID
            $stmt->bindParam(1, $this->nome);
            // Execute query
            $stmt->execute();

            $Resultado = array();
            $Resultado['comunidades'] = array();
            // Set properties
            while($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {
              extract($row);
      
              $item = array(
                'idComunidade' => $row['id_comunidade'],
                'comunidade' => $row['nome'],
                'tema' => $row['tema'],
                'descricao' => $row['descricao']
              );
      
              array_push($Resultado['comunidades'], $item);
            }

            return $Resultado['comunidades'];
          }

        public function read_by_name()
        {
            $query = 'SELECT
              id_comunidade,
              nome,
              descricao,
              tema 
            FROM '.$this->nomeTabela .
          '  Where 
          nome = ?';

          $stmt = $this->conn->prepare($query);
        // Bind ID
        $stmt->bindParam(1, $this->nome);
        // Execute query
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // Set properties
        $this->id = $row['id_comunidade'];
        $this->nome = $row['nome'];
        $this->bio = $row['descricao'];
        $this->senha = $row['tema'];
        
        $resposta = array(
          'id' => (int)$this->id,
          'nome' => $this->nome,
          'bio' => $this->bio,
          'senha' => $this->senha
        );

        return $resposta;
        }

        public function read_by_id()
        {
            $query = 'SELECT
              id_comunidade,
              nome,
              descricao,
              tema 
            FROM '.$this->nomeTabela .
          '  Where 
          id_comunidade = ?';

          $stmt = $this->conn->prepare($query);
        // Bind ID
        $stmt->bindParam(1, $this->id);
        // Execute query
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // Set properties
        $this->id = $row['id_comunidade'];
        $this->nome = $row['nome'];
        $this->tema = $row['descricao'];
        $this->descricao = $row['tema'];
        
        $resposta = array(
          'id' => (int)$this->id,
          'nome' => $this->nome,
          'tema' => $this->tema,
          'descricao' => $this->descricao
        );

        return $resposta;
        }
    }
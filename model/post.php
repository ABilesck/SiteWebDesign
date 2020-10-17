<?php
    class Post
    {

        private $conn;

        public $id;
        public $texto;
        public $autor;
        public $comunidade;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function postar()
        {
            $querry = 'INSERT INTO tblPost (`texto`, `perfil`, `comunidade`) VALUES (?, ?, ?)';

            $stmt = $this->conn->prepare($querry);

            $this->texto = htmlspecialchars(strip_tags($this->texto));
            $this->autor = htmlspecialchars(strip_tags($this->autor));
            $this->comunidade = htmlspecialchars(strip_tags($this->comunidade));

            $stmt->bindParam(1, $this->texto);
            $stmt->bindParam(2, $this->autor);
            $stmt->bindParam(3, $this->comunidade);

            if($stmt->execute())
            {
                return true;
            }
            
            printf("Erro :%s\n", $stmt->error);
            return false;
        }

        public function PostsDaComunidade()
        {
            $query = 'select * from tblPost INNER JOIN tblPerfil on tblPost.perfil = tblPerfil.id_perfil 
            INNER JOIN tblComunidade on tblPost.comunidade = tblComunidade.id_comunidade 
             where tblComunidade.id_comunidade = ? ORDER BY id_post DESC';

             $stmt = $this->conn->prepare($query);
             // Bind ID
             $stmt->bindParam(1, $this->comunidade);
             // Execute query
             $stmt->execute();
             
             $num = $stmt->rowCount();
     
             if($num > 0)
             {
                 $Posts = array();
                 $Posts['posts'] = array();
     
                 while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                 {
                     extract($row);
     
                     $item = array(
     
                         'idAutor' => $row['id_perfil'],
                         'autor' => $row['usuario'],
                         'bioAutor' => $row['bio'],
                         'texto' => $row['texto'],
                         'idComunidade' => $row['id_comunidade'],
                         'nomeComunidade' => $row['nome'],
                         'tema' => $row['tema'],
                         'descricao' => $row['descricao']
                     );
     
                     array_push($Posts['posts'], $item);
                 }
     
                 return $Posts['posts'];
             }
        }

        public function PostsDoPerfil()
        {
            $query = 'select * from tblPost INNER JOIN tblPerfil on tblPost.perfil = tblPerfil.id_perfil 
            INNER JOIN tblComunidade on tblPost.comunidade = tblComunidade.id_comunidade 
             where tblPerfil.id_perfil = ?';
        }

    }
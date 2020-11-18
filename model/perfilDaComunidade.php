<?php 
    class PerfilDaComunidade
    {
        private $conn;
        private $nomeTabela = '`tblPerfisDaComunidade`';

        public $id_Perfil;
        public $id_Comunidade;
        public $nomePerfil;
        public $bio;
        public $NomeComunidade;
        public $descricao;
        public $tema;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function Ingressar()
        {
            $querry = 'INSERT INTO ' . $this->nomeTabela .
            ' (`perfil`, `comunidade`) VALUES (?, ?)';

            $stmt = $this->conn->prepare($querry);

            $this->id_Perfil = htmlspecialchars(strip_tags($this->id_Perfil));
            $this->id_Comunidade = htmlspecialchars(strip_tags($this->id_Comunidade));

            $stmt->bindParam(1, $this->id_Perfil);
            $stmt->bindParam(2, $this->id_Comunidade);

            if($stmt->execute())
            {
                return true;
            }
            
            printf("Erro :%s\n", $stmt->error);
            return false;
        }

        public function createFromLastID()
        {
            $querry = 'INSERT INTO ' . $this->nomeTabela .
            ' (`perfil`, `comunidade`) VALUES (?, ?)';

            $stmt = $this->conn->prepare($querry);

            $this->id_Perfil = htmlspecialchars(strip_tags($this->id_Perfil));
            $this->id_Comunidade = htmlspecialchars(strip_tags($this->id_Comunidade));

            $stmt->bindParam(1, $this->id_Perfil);
            $stmt->bindParam(2, $this->conn->lastInsertId());

            if($stmt->execute())
            {
                return $this->conn->lastInsertId();
            }
            
            printf("Erro :%s\n", $stmt->error);
            return false;
        }

        public function LerPorPerfil()
        {
            $query = '
            select * from tblPerfisDaComunidade  
            Inner JOIN tblPerfil on tblPerfisDaComunidade.perfil = tblPerfil.id_perfil 
            LEFT JOIN tblComunidade on tblPerfisDaComunidade.comunidade = tblComunidade.id_comunidade 
            where tblPerfisDaComunidade.perfil = ?';

        $stmt = $this->conn->prepare($query);
        // Bind ID
        $stmt->bindParam(1, $this->id_Perfil);
        // Execute query
        $stmt->execute();
        
        $num = $stmt->rowCount();

        if($num > 0)
        {
            $ComunidadesDoPerfil = array();
            $ComunidadesDoPerfil['data'] = array();

            while($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                extract($row);

                $item = array(

                    'perfil' => $row['perfil'],
                    'comunidade' => $row['comunidade'],
                    'usuario' => $row['usuario'],
                    'bio' => $row['bio'],
                    'nomeComunidade' => $row['nome'],
                    'tema' => $row['tema'],
                    'descricao' => $row['descricao']
                );

                array_push($ComunidadesDoPerfil['data'], $item);
            }

            return $ComunidadesDoPerfil['data'];
            }
        }

        public function VerificarPerfil()
        {
                $query = '
                select * from tblPerfisDaComunidade  
                Inner JOIN tblPerfil on tblPerfisDaComunidade.perfil = tblPerfil.id_perfil 
                LEFT JOIN tblComunidade on tblPerfisDaComunidade.comunidade = tblComunidade.id_comunidade 
                where tblPerfisDaComunidade.perfil = ?';

            $stmt = $this->conn->prepare($query);
            // Bind ID
            $stmt->bindParam(1, $this->id_Perfil);
            // Execute query
            $stmt->execute();
            
            $num = $stmt->rowCount();

            if($num > 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        public function LerPorComunidade()
        {
            $query = '
            select * from tblPerfisDaComunidade  
            Inner JOIN tblPerfil on tblPerfisDaComunidade.perfil = tblPerfil.id_perfil 
            LEFT JOIN tblComunidade on tblPerfisDaComunidade.comunidade = tblComunidade.id_comunidade 
            where tblPerfisDaComunidade.comunidade = ?';

        $stmt = $this->conn->prepare($query);
        // Bind ID
        $stmt->bindParam(1, $this->id_Comunidade);
        // Execute query
        $stmt->execute();
        
        $num = $stmt->rowCount();

        if($num > 0)
        {
            $ComunidadesDoPerfil = array();
            $ComunidadesDoPerfil['data'] = array();

            while($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                extract($row);

                $item = array(

                    'perfil' => $row['perfil'],
                    'comunidade' => $row['comunidade'],
                    'usuario' => $row['usuario'],
                    'bio' => $row['bio'],
                    'nomeComunidade' => $row['nome'],
                    'tema' => $row['tema'],
                    'descricao' => $row['descricao']
                );

                array_push($ComunidadesDoPerfil['data'], $item);
            }

            return $ComunidadesDoPerfil['data'];
        }
    }
}
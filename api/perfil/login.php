<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  include_once '../../config/Banco.php';
  include_once '../../model/Perfil.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog post object
  $usuario = new Perfil($db);
  // Get ID
  $data = json_decode(file_get_contents("php://input"));
  $usuario->nome = $data->nome;
  $usuario->senha = $data->senha;
  // Get post
  if($usuario->login())
    {
        $resposta = array(
            'id' => (int)$usuario->id,
            'nome' => $usuario->nome,
            'bio' => $usuario->bio,
            'senha' => $usuario->senha
          );
          // Make JSON
          print_r(json_encode($resposta));
    }
  
  // Create array
  
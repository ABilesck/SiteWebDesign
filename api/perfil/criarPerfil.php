<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
  include_once '../../config/Banco.php';
  include_once '../../model/Perfil.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog post object
  $usuario = new Perfil($db);
  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));
  $usuario->nome = $data->nome;
  $usuario->bio = $data->bio;
  $usuario->senha = $data->senha;
  // Create post
  if($usuario->create()) {
    echo json_encode(
      array('message' => 'Post Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Post Not Created')
    );
  }
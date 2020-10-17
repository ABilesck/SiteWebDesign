<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include_once '../../config/banco.php';
include_once '../../model/perfil.php';

$database = new Database();
$db = $database->Connect();

$usuario = new Perfil($db);

$result = $usuario->read();

$num = $result->rowCount();

if($num > 0){
    $usuarios = array();
    $usuarios["data"] = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $item = array(
            'id_perfil' => (int)$id_perfil,
            'nome' => $usuario,
            'bio' => $bio,
            'senha' => $senha
        );
        array_push($usuarios["data"], $item);
    }
    echo json_encode($usuarios);
}else{
    echo json_encode(
        array('message' => 'nenhum usuario foi encontrado')
    );
}
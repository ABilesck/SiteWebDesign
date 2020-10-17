<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include_once '../../config/banco.php';
include_once '../../model/comunidade.php';

$database = new Database();
$db = $database->Connect();

$comunidade = new Comunidade($db);

$result = $comunidade->read();

$num = $result->rowCount();

if($num > 0){
    $comunidades = array();
    $comunidades['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $item = array(
            'id_comunidade' => (int)$id_comunidade,
            'nome' => $nome,
            'descricao' => $descricao,
            'tema' => $tema
        );
        array_push($comunidades['data'], $item);
    }
    echo json_encode($comunidades['data']);
}else{
    echo json_encode(
        array('message' => 'nenhuma comunidade foi encontrado')
    );
}
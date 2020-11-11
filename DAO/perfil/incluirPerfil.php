<?php

    $nome = $_POST['nome'];
    $bio = 'minha primeira bio';
    $senha = $_POST['senha'];

    include_once '../../config/Banco.php';
    include_once '../../model/Perfil.php';

    $database = new Database();
    $db = $database->connect();
    $usuario = new Perfil($db);
    $usuario->nome = $nome;
    $usuario->bio = $bio;
    $usuario->senha = $senha;

    if($usuario->create())
    {
        echo 'cadastrado com sucesso!';
        header('location: ../../view/login.html');
        
    }

?>
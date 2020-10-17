<?php

    session_start();

    $nome = $_POST['nome'];
    $descricao = $_POST['desc'];
    $tema = $_POST['tema'];

    include_once '../../config/banco.php';
    include_once '../../model/comunidade.php';
    include_once '../../model/perfilDaComunidade.php';

    $database = new Database();
    $db = $database->connect();
    $comunidade = new Comunidade($db);
    $perfilMembro = new PerfilDaComunidade($db);
    $comunidade->nome = $nome;
    $comunidade->descricao = $descricao;
    $comunidade->tema = $tema;


    if($comunidade->create())
    {
        //echo 'cadastrado com sucesso!';
        $perfilMembro->id_Perfil = $_SESSION['Id_Perfil'];
        echo $perfilMembro->createFromLastID();
        //header('location: ../../view/visualizarPerfil.php');
    }else{
        echo 'deu ruim';
    }


?>
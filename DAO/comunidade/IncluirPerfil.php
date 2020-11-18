<?php

    session_start();

    $perfil = $_POST['perfil'];
    $comunidade = $_POST['comunidade'];
    $url = $_POST['url'];

    include_once '../../config/banco.php';
    include_once '../../model/perfilDaComunidade.php';

    $database = new Database();
    $db = $database->connect();
    $perfilMembro = new PerfilDaComunidade($db);
    $perfilMembro->id_Perfil = $perfil;
    $perfilMembro->id_Comunidade = $comunidade;


    if($perfilMembro->Ingressar())
    {
        //echo 'cadastrado com sucesso!';
        header('location:' .$url);
    }else{
        echo 'deu ruim';
    }


?>
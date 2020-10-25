<?php

    include_once '../../config/banco.php';
    include_once '../../model/perfil.php';

    session_start();
    
    $perfil = $_POST['nome'];
    $senha = $_POST['senha'];
    
    $_SESSION['nome'] = $perfil;
    
    $database = new Database();
    $db = $database->connect();
    $usuario = new Perfil($db);
    
    $usuario->nome = $perfil;
    $usuario->senha = $senha;
    
    $dados = $usuario->login();

    $_SESSION['id'] = $dados['id'];

    print(implode(", ",$dados));

    if($dados['id'] != 0)
    {
        echo 'Usuário logado com sucesso!';
        header('Location: ../../view/visualizarPerfil.php?id=' . $dados['id']);
    }
    else
    {
        echo '<script> alert("Credenciais estão incorretas") </script>';
        header('location: ../../view/criarPerfilTeste.html');
    }
    

?>
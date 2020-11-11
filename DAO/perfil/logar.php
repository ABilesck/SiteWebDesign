<?php
    include_once '../../config/banco.php';
    include_once '../../model/perfil.php';

    session_start();
    
    $perfil = $_POST['nome'];
    $senha = $_POST['senha'];
    
    
    
    $database = new Database();
    $db = $database->connect();
    $usuario = new Perfil($db);
    
    $usuario->nome = $perfil;
    $usuario->senha = $senha;
    
    $dados = $usuario->login();

    

    print(implode(", ",$dados));

    if($dados['id'] != 0)
    {
        //setcookie('id', $dados['id']);
        //setcookie('login', $dados['nome']);
        $_SESSION['id'] = $dados['id'];
        $_SESSION['login'] = $dados['nome'];
        echo '<br>' . $_SESSION['id'];
        echo '<br>' . $_SESSION['login'];
        header('Location: ../../index.php');
    }
    else
    {
        echo '<script> alert("Credenciais estão incorretas") </script>';
        //header('location: ../../view/criarPerfilTeste.html');
    }
    

?>
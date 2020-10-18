<?php
session_start();

include_once '../config/banco.php';
include_once '../model/perfil.php';
include_once '../model/perfilDaComunidade.php';

$database = new Database();
$db = $database->connect();
$usuario = new Perfil($db);
$perfilMembro = new PerfilDaComunidade($db);
$usuario->id = $_GET['id'];

$dados = $usuario->read_single();

$id = $_GET['id'];
$loggedId = $_SESSION['id'];

$perfilMembro->id_Perfil = $dados['id'];

$url = 'http://localhost/sitewebdesign/view/visualizarComunidade.php?com=';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/stylesComum.css">
    <title>Document</title>
</head>
<body>
    <h1>Meu Perfil</h1>
    <br/>
    <label>Nome: </label><?php echo $dados['nome'] ?>
    <br/>
    <label>Bio: </label><?php echo $dados['bio'] ?>
    <br/><br/>
    <?php 

        if($id == $loggedId)
        {?>
            <a href="criarComunidadeTeste.html">Criar Comunidade</a>
            <br/><br/>
        <?php
        }?>
    
    
    <h2>Minhas comunidades</h2>

    <table>
        <tr>
            <th>Comunidade</th> <th>Descrição</th> <th>Tema</th>
        </tr>
    <?php 
        $dados = $perfilMembro->LerPorPerfil();

        foreach ($dados as $d) { ?>

            <tr>
                <td>  <?php echo $d['nomeComunidade'] ?>  </td>
                <td>  <?php echo $d['descricao'] ?>  </td>
                <td>  <?php echo $d['tema'] ?>  </td>
                <td> <a href="<?php echo $url . $d['comunidade']?>">visualizar Comunidade</a>
            </tr>
        
        <?php
        }
        ?> -->

    </table>


    <footer class="ftr">
        <p>This site is an academic project</p>
        <p>Copyright © 2020 - All rights reserved - Codificando</p>
    </footer>   
</body>
</html>
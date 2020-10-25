<?php
session_start();

include_once '../config/banco.php';
include_once '../model/comunidade.php';
include_once '../model/perfilDaComunidade.php';
include_once '../model/post.php';

$database = new Database();
$db = $database->connect();
$comunidade = new Comunidade($db);
$perfisDaComunidade = new PerfilDaComunidade($db);
$posts = new Post($db);

$id_com = $_GET['com'];

$comunidade->id = $id_com;
$perfisDaComunidade->id_Comunidade = $id_com;
$posts->comunidade = $id_com;

$dados = $comunidade->read_by_id();

$url = 'http://localhost/sitewebdesign/view/visualizarPerfil.php?id=';

?>

<!DOCTYPE html>
<html lang="pt-BR" class="htm">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comunidades</title>
    <link rel="stylesheet" href="./assets/css/styleVisualizarComunidade.css">
    <link rel="icon" type="image/gif" href="./assets/img/favicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" 
    integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>

<body class="bd">
    <header class="formComunidade">
        <div class="card">
            <div class="card-top">
                <div class="texto">
                    <img class="imgLogin" src="./assets/img/CodificandoLogo.png" alt="Logo">
                    <h2 class="titulo">Codificando</h2>
                </div>
                <div class="botoes">
                    <a href="login.html">
                        <input class="botao" type="button" value="Fazer Login"></input>
                    </a>
                </div>
            </div>
        </div>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <img src="./assets/img/favicon.png" width="30" height="30" class="d-inline-block align-top pad" alt="Logo" loading="lazy">
            <a class="navbar-brand" href="./index.html">Codificando</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" href="./visualizarPerfil.php">Perfis <span class="sr-only">(current)</span></a>
                    <a class="nav-link" href="./visualizarComunidade.php">Comunidades</a>
                    <a class="nav-link" href="#">Sobre</a>
                </div>
            </div>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Digite a sua pesquisa" aria-label="Search">
                <button class="bottao my-2 my-sm-0" type="submit">Procurar</button>
            </form>
        </nav>
    </header>


    <section class="escopo">
        <article class="card">

        <div class="comunidadeLista">
            <ul class="list-group lista">
                <li class="list-group-item active listaLi">Comunidade</li>
                <li style="margin-top: 0px;" class="list-group-item listaLi">Nome</li> <?php echo $dados['nome'] ?>
                <li class="list-group-item listaLi">Assunto</li> <?php echo $dados['tema'] ?>
                <li class="list-group-item listaLi">Descrição</li> <?php echo $dados['descricao'] ?>
            </ul>
        </div>

        <div class="comunidadeLista">
            <ul class="list-group lista">
                <li class="list-group-item active listaLi">Membros da comunidade</li>
                <li style="margin-top: 0px;" class="list-group-item listaLi">Nome de usuario</li> 
                <?php
                $membros = $perfisDaComunidade->LerPorComunidade();
                foreach ($membros as $m) { ?>
                         <?php echo $m['usuario'] ?> 
                <?php } ?>

                <li class="list-group-item listaLi">Biografia</li>
                <?php
                $membros = $perfisDaComunidade->LerPorComunidade();
                foreach ($membros as $m) { ?>
                         <?php echo $m['bio'] ?> 
                <?php } ?> 
            </ul>
        </div>
            <p>

                <fieldset>
                    <legend>Novo post</legend>
                    <form action="../DAO/post/novoPost.php" method="POST">
                        <input type="text" name="texto" id="texto" /> <input type="submit" value="Postar" />
                        <input type="hidden" id="autor" name="autor" value="<?php echo $_SESSION['Id_Perfil'] ?>">
                        <input type="hidden" id="comunidade" name="comunidade" value="<?php echo $id_com ?>">
                    </form>
                </fieldset>

                <h2>Todos os posts</h2>

                <?php

                $TodosOsPosts = $posts->PostsDaComunidade();
                if (count($TodosOsPosts) != 0)
                    foreach ($TodosOsPosts as $p) { ?>

                    <article>
                        <h3><a href="<?php echo $url . $p['idAutor'] ?>"> <?php echo $p['autor'] ?> </a></h3>
                        <br />
                        <?php echo $p['texto'] ?>
                        <br />
                    </article>
                    <br />

                <?php } ?>
        </article>
    </section>

    <footer class="ftr">
        <p>This site is an academic project</p>
        <p>Copyright © 2020 - All rights reserved - Codificando</p>
    </footer>


</body>

</html>
<?php
    session_start();

    include_once './config/banco.php';
    include_once './model/comunidade.php';
    include_once './model/perfilDaComunidade.php';
    include_once './model/post.php';

    $urlPerfil = 'http://localhost/sitewebdesign/view/visualizarPerfil.php?id=';
    $urlComunidade = 'http://localhost/sitewebdesign/view/visualizarComunidade.php?com=';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.9">
    <link rel="stylesheet", href="./view/css/mainStyle.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Codificando</title>
</head>
<body>

    <?php
    if(isset($_SESSION['id']))
    {
        ?>
        
            <nav>
                <input type="checkbox" id="check">
                <label for="check" class="checkbtn">
                    <i class="fas fa-bars" style="font-size: 30px; line-height: 100px;"></i>
                </label>
                <img src="./view/imagem/CodificandoLogo3.png" class="logo">
                <ul>
                    <li>
                    <form action="./view/pesquisa.php" method="get">
                        <input type="text" id="busca" name="busca" placeholder="Digite sua pesquisa aqui" class="searchBox">
                        <!-- <input type="submit" value="pesquisar"> -->
                        <button type="submit" class="btnPesquisa">
                            <i class="fas fa-search"></i>
                            Pesquisar
                    </button>
                    </form>
                    </li>
                    <li><a href="#">Meu perfil</a></li>
                    <li><a href="#">Minhas Comunidades</a></li>
                    <li><a href="./DAO/perfil/deslogar.php">Sair</a></li>
                </ul>
            </nav>

            <div class="fundo">

                <h2>Bem vindo de volta, <?php echo $_SESSION['login'] ?>!</h2>
                <br>

                <?php

                    $database = new Database();
                    $db = $database->connect();
                    $post = new Post($db);
                    $TodosOsPosts = $post->TodosOsPosts($_SESSION['id']);

                    if(count($TodosOsPosts) != 0)
                    foreach ($TodosOsPosts as $p) { ?>
                        
                        <article class="post">
                            <p class="postText">
                                <a href = <?php echo $urlPerfil . $p["idAutor"] ?> class="postLink"> <?php echo $p['autor'] ?> </a> 
                                @ 
                                <a href = <?php echo $urlComunidade . $p["idComunidade"] ?> class="postLink"> <?php echo $p['comunidade'] ?> </a>
                            </p>
                            <br/>
                            <p>
                                <?php echo $p['texto'] ?>
                            </p>
                            <br/>
                        </article>
                        <br/>

                <?php } ?>
            </div>

        <?php
    }
    else
    {
    ?>
        <div class="fundo">
            <div class="form">
                <div class="titulo">
                    <h1>Codificando</h1>
                    <p>
                        Uma rede social de desenvolvedores para desenvolvedores!
                    </p>
                    <br>
                    <h3>Entrar</h3>
                </div>
                <form method="POST", action="./DAO/perfil/logar.php">
                    <div class="formItem">
                        <i class="fas fa-user"></i>
                        <input type="text" class="input" id="nome" name="nome" placeholder="Usuário">
                    </div>
                    
                    <div class="formItem">
                        <i class="fas fa-lock"></i>
                        <input type="password" class="input" id="senha" name="senha" placeholder="Senha">
                    </div>
                    
                    <button type="submit" class="btnPrimario">
                        entrar
                        <i class="fas fa-arrow-right"></i>
                    </button>
                    <hr style="margin-top: 27px; margin-bottom: 27px;">
                    <button type="button" class="btnSecundario">
                        Criar conta
                        <i class="fas fa-user-plus"></i>
                    </button>
                </form>
            </div>
        </div>
    <?php
    }

    ?>

</body>
</html>
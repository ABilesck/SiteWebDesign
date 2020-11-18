<?php

    session_start();

    include_once('../config/banco.php');
    include_once('../model/comunidade.php');
    include_once('../model/perfil.php');

    $palavraChave = $_GET['busca'];

    $database = new Database();
    $db = $database->connect();
    
    $comunidade = new Comunidade($db);
    $perfil = new Perfil($db);

    $urlPerfil = 'http://localhost/sitewebdesign/view/visualizarPerfil.php?id=';
    $urlComunidade = 'http://localhost/sitewebdesign/view/visualizarComunidade.php?com=';

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.9">
    <title>Codificando</title>
    <link rel="stylesheet", href="./css/mainStyle.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                <a href="../index.php"><img src="./imagem/CodificandoLogo3.png" class="logo"></a>
                <ul>
                    <li>
                    <form action="" method="post">
                        <input type="text" placeholder="Digite sua pesquisa aqui" class="searchBox">
                        <!-- <input type="submit" value="pesquisar"> -->
                        <button type="submit" class="btnPesquisa">
                            <i class="fas fa-search"></i>
                            Pesquisar
                    </button>
                    </form>
                    </li>
                    <li><a href=<?php echo $urlPerfil . $_SESSION['id'] ?>>Meu perfil</a></li>
                    <li><a href="../index.php">Linha do tempo</a></li>
                    <li><a href="../DAO/perfil/deslogar.php">Sair</a></li>
                </ul>
            </nav>

            <div class="fundo2">

                <h2>Resultados da sua busca por "<?php echo $palavraChave?>":</h2>

                <h3 style="line-height: 50px;">Comunidades com nome "<?php echo $palavraChave?>": </h3>

                <?php

                    $comunidade->nome =  "%" . $palavraChave . "%";
                    $comunidadesPorNome = $comunidade->PesquisarPorNome();

                    if(count($comunidadesPorNome) != 0)
                    foreach ($comunidadesPorNome as $com) { ?>
                        
                        <article class="post">
                            <p class="postText">
                                <a href = <?php echo $urlComunidade . $com["idComunidade"] ?> class="postLink"> 
                                <?php echo $com['comunidade'] ?> </a>
                            </p>
                            <p>
                                <?php echo $com["tema"] ?>
                            </p>
                            <br>
                            <p>
                                <?php echo $com["descricao"] ?>
                            </p>
                        </article>
                        <br/>

                    <?php } ?>

                    <h3 style="line-height: 50px;">Comunidades com tema "<?php echo $palavraChave?>": </h3>

                    <?php

                    $comunidade->tema =  "%" . $palavraChave . "%";
                    $comunidadesPorTema = $comunidade->PesquisarPorTema();

                    if(count($comunidadesPorTema) != 0)
                    foreach ($comunidadesPorTema as $com) { ?>
                        
                        <article class="post">
                            <p class="postText">
                                <a href = <?php echo $urlComunidade . $com["idComunidade"] ?> class="postLink"> 
                                <?php echo $com['comunidade'] ?> </a>
                            </p>
                            <p>
                                <?php echo $com["tema"] ?>
                            </p>
                            <br>
                            <p>
                                <?php echo $com["descricao"] ?>
                            </p>
                        </article>
                        <br/>

                    <?php } ?>

                    <h3 style="line-height: 50px;">Usuarios com nome "<?php echo $palavraChave?>": </h3>

                    <?php

                    $perfil->nome =  "%" . $palavraChave . "%";
                    $perfisPorNome = $perfil->PesquisarPorNome();

                    if(count($perfisPorNome) != 0)
                    foreach ($perfisPorNome as $perfil) { ?>
                        
                        <article class="post">
                            <p class="postText">
                                <a href = <?php echo $urlPerfil . $perfil["idPerfil"] ?> class="postLink"> 
                                <?php echo $perfil['usuario'] ?> </a>
                            </p>
                            <br>
                            <p>
                                <?php echo $perfil["bio"] ?>
                            </p>
                        </article>
                        <br/>

                    <?php } ?>
                
            </div>
        <?php
        }
    
    ?>
    
</body>
</html>
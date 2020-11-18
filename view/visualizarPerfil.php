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

$perfilMembro->id_Perfil = $dados['id'];

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

<?php if(isset($_SESSION['id']))
        {
        ?>
            <nav>
                <input type="checkbox" id="check">
                <label for="check" class="checkbtn">
                    <i class="fas fa-bars" style="font-size: 30px; line-height: 100px;"></i>
                </label>
                <img src="./imagem/CodificandoLogo3.png" class="logo">
                <ul>
                    <li>
                    <form action="./view/pesquisa.php" method="get">
                        <input type="text" id="busca" name="busca" placeholder="Digite sua pesquisa aqui" class="searchBox" required>
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
        <?php
        }
        else
        {
        ?>

            <nav>
                <input type="checkbox" id="check">
                <label for="check" class="checkbtn">
                    <i class="fas fa-bars" style="font-size: 30px; line-height: 100px;"></i>
                </label>
                <img src="./imagem/CodificandoLogo3.png" class="logo">
                <ul>
                    <li>
                    <form action="./pesquisa.php" method="get">
                        <input type="text" id="busca" name="busca" placeholder="Digite sua pesquisa aqui" class="searchBox">
                        <!-- <input type="submit" value="pesquisar"> -->
                        <button type="submit" class="btnPesquisa">
                            <i class="fas fa-search"></i>
                            Pesquisar
                    </button>
                    </form>
                    </li>
                    <li><a href="#">Criar conta</a></li>
                    <li><a href="../index.php">Entrar</a></li>
                </ul>
            </nav>
            
        <?php
        }
        ?>

    <div class="fundo2">

        <h1 class="nome"><?php echo $dados['nome'] ?></h1>
        <p class="bio">
            <?php echo $dados['bio'] ?>
        </p>

        <?php if(isset($_SESSION['id']))
        {
        ?>

            <h3 style="padding: 5px 5px;"><?php echo $dados['nome'] ?> participa das comunidades: </h3>

            <?php 
                $dados = $perfilMembro->LerPorPerfil();

                foreach ($dados as $d) { ?>

                    <article class="post">
                        <p class="postText">
                            <a href = <?php echo $urlComunidade . $d["comunidade"] ?> class="postLink"> 
                            <?php echo $d['nomeComunidade'] ?> </a>
                        </p>
                        <p>
                            <?php echo $d["tema"] ?>
                        </p>
                        <br>
                        <p>
                            <?php echo $d["descricao"] ?>
                        </p>
                    </article>
                <?php
                }
                ?>

        <?php
        }
        else
        {
        ?>
            <p>
                <a href="#">Entre</a> para visualizar todas as informações do perfil
            </p>
            
        <?php
        }
        ?>
    </div>
    
</body>
</html>
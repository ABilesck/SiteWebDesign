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
                        <input type="text" id="busca" name="busca" placeholder="Digite sua pesquisa aqui" class="searchBox">
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
                    <li><a href="./criarPerfil.php">Criar conta</a></li>
                    <li><a href="../index.php">Entrar</a></li>
                </ul>
            </nav>
            
        <?php
        }
        ?>

        <div class="fundo2">

        <h1 class="nome"><?php echo $dados['nome'] ?></h1>
        <h2><?php echo $dados['tema'] ?></h2>
        <p class="bio">
            <?php echo $dados['descricao'] ?>
        </p>

        <?php if(isset($_SESSION['id']))
        {
            $perfisDaComunidade->id_Perfil = $_SESSION['id'];
            if($perfisDaComunidade->VerificarPerfil())
        {

        ?>

            <details>
                <summary style="font-size: 20px; font-weight: bold;">Membros</summary>
                <?php 

                    $membros = $perfisDaComunidade->LerPorComunidade();

                    foreach ($membros as $m) { ?>
                    <article class="post">
                        <p class="postText">
                            <a href = <?php echo $urlPerfil . $m['perfil'] ?> class="postLink"> 
                            <?php echo $m['usuario'] ?> </a>
                        </p>
                        <p>
                            <?php echo $m['bio'] ?>
                        </p>
                        <br>
                    </article>
                <?php } ?>
            </details>

        <div class="form">
                <div class="titulo">
                    <h4 style="text-align: center;">Novo post</h4>
                </div>
                <form method="POST", action="../DAO/post/novoPost.php">
                    <input type="hidden" id="autor" name="autor" value="<?php echo $_SESSION['id'] ?>">
                    <input type="hidden" id="comunidade" name="comunidade" value="<?php echo $id_com ?>">
                    <div class="formItem">
                        <textarea class="input message" name="texto" id="texto" cols="30" rows="5" placeholder="Escreva seu post aqui" required></textarea>
                    </div>
                    
                    <button type="submit" class="btnSecundario">
                        Postar
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </form>
            </div>
        <?php
        }
        else
        {
        ?>
            <p>
                Você não participa desta comunidade!
            </p>
            <br>
            <form action="../DAO/comunidade/incluirPerfil.php" method="POST">
                <input type="hidden" id="perfil" name="perfil" value=<?php echo $_SESSION['id']?>>
                <input type="hidden" id="comunidade" name="comunidade" value=<?php echo $_GET['com']?>>
                <input type="hidden" id="url" name="url" value=<?php echo $urlComunidade . $_GET['com']?>>

                <button type="submit" class="btnSecundario">
                    Participar
                </button>
            </form>
            
        <?php
        }
        ?>

            <h3 style="padding: 5px 5px;">Todos os posts: </h3>

            <?php
    
            $TodosOsPosts = $posts->PostsDaComunidade();
            if(isset($TodosOsPosts))
            foreach ($TodosOsPosts as $p) { ?>
                
                <article class="post">
                        <p class="postText">
                            <a href = <?php echo $urlPerfil . $p["idAutor"] ?> class="postLink"> 
                            <?php echo $p['autor'] ?> </a>
                        </p>
                        <br>
                        <p>
                            <?php echo $p["texto"] ?>
                        </p>
                    </article>

           <?php } ?>

        <?php
        }
        else
        {
        ?>
            <p>
                <a href="#">Entre</a> para visualizar todas as informações da comunidade
            </p>
            
        <?php
        }
        ?>
        </div>
    
</body>
</html>
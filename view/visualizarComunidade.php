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
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h1>Comunidade</h1>
    <br/>
    <label>Nome: </label><?php echo $dados['nome'] ?>
    <br/>
    <label>Tema: </label><?php echo $dados['tema'] ?>
    <br/>
    <label>Descrição: </label><?php echo $dados['descricao'] ?>

    <h2>Membros da comunidade</h2>
    <table>
        <tr>
            <th>Nome de usuario</th> <th>Bio</th>
        </tr>

        <?php 

        $membros = $perfisDaComunidade->LerPorComunidade();
        
        foreach ($membros as $m) { ?>
            
            <tr>
                <td>  <?php echo $m['usuario'] ?>  </td>
                <td>  <?php echo $m['bio'] ?>  </td>
            </tr>

        <?php } ?>
    </table>

    <p>

    <fieldset>
        <legend>Novo post</legend>
        <form action="../DAO/post/novoPost.php" method="POST">
            <input type="text" name="texto" id="texto"/> <input type="submit" value="Postar"/>
            <input type="hidden" id="autor" name="autor" value="<?php echo $_SESSION['Id_Perfil'] ?>">
            <input type="hidden" id="comunidade" name="comunidade" value="<?php echo $id_com ?>">
        </form>
    </fieldset>

    <h2>Todos os posts</h2>

    <?php
    
            $TodosOsPosts = $posts->PostsDaComunidade();
            if(count($TodosOsPosts) != 0)
            foreach ($TodosOsPosts as $p) { ?>
                
                <article>
                    <h3><a href="<?php echo $url . $p['idAutor'] ?>"> <?php echo $p['autor'] ?> </a></h3>
                    <br/>
                    <?php echo $p['texto'] ?>
                    <br/>
                </article>
                <br/>

           <?php } ?>
    
</body>
</html>
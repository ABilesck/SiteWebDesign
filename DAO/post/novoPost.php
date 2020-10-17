<?php

    include_once '../../config/banco.php';
    include_once '../../model/post.php';

    $database = new Database();
    $db = $database->connect();
    $post = new Post($db);

    $post->autor = $_POST['autor'];
    $post->comunidade = $_POST['comunidade'];
    $post->texto = $_POST['texto'];

    if($post->postar())
    {
        $url = 'http://localhost/sitewebdesign/view/visualizarComunidade.php?com=' . $post->comunidade;
        header('Location: ' . $url);
    }



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include_once("navbar.php") ?>
    <br/>
    <form method="POST", action="../DAO/perfil/logar.php" class="form">
    
        <label for="nome">Nome: </label>
        <input type="text" name="nome" id="nome"/>
        <br/>
        <label for="senha">Senha: </label>
        <input type="password" name="senha" id="senha"/>
        <p>
        <input type="submit" value="entrar"/>
    
    </form>
</body>
</html>
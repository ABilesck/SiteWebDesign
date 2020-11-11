<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/fornStyle.css">
    <title>Criar Perfil</title>
</head>
<body>
    <?php include_once("navbar.php") ?>
    <!-- <form method="POST", action="../DAO/perfil/incluirPerfil.php">
        
        <label for="nome">Nome: </label>
        <input type="text" name="nome" id="nome"/>
        <br/>
        <label for="bio">Biografia: </label>
        <input type="text" name="bio" id="bio"/>
        <br/>
        <label for="senha">Senha: </label>
        <input type="password" name="senha" id="senha"/>
        <p>
        <input type="submit"/>
    </form>
    <br/>
    Já possui um perfil? <a href="login.php">Faça login aqui!</a>-->

    <div class="pnlLogin">
        <div class="titulo">
            <h1>Criar perfil</h1>
        </div>

        <div class="form">

            <div class="formItem">
                <i class="fas fa-user"></i>
                <input type="text" class="input" id="usuario" name="usuario" placeholder="Usuário">
            </div>
            
            <div class="formItem">
                <i class="fas fa-lock"></i>
                <input type="password" class="input" id="senha" name="senha" placeholder="Senha">
            </div>

            <div class="formItem">
                <textarea class="input message" name="bio" id="bio" cols="30" rows="10" placeholder="Escreva sobre você..."></textarea>
            </div>

            <div class="btnSubmit">
                Submit
                <i class="fas fa-arrow-right"></i>
            </div>
        </div>

    </div>

</body>
</html>
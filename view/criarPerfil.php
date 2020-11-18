<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.9">
    <link rel="stylesheet", href="./css/mainStyle.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Codificando</title>
</head>
<body>

    <div class="fundo">
            <div class="form">
                <div class="titulo">
                    <h3>Criar conta</h3>
                </div>
                <form method="POST", action="../DAO/perfil/incluirPerfil.php">
                    <div class="formItem">
                        <i class="fas fa-user"></i>
                        <input type="text" class="input" id="nome" name="nome" placeholder="Usuário" required>
                    </div>
                    
                    <div class="formItem">
                        <i class="fas fa-lock"></i>
                        <input type="password" class="input" id="senha" name="senha" placeholder="Senha" required>
                    </div>
                    <div class="formItem">
                        <textarea class="input message" name="bio" id="bio" cols="30" rows="10" placeholder="Escreva sobre você..." required></textarea>
                    </div>
                    
                    <button type="submit" class="btnPrimario">
                        criar conta
                        <i class="fas fa-arrow-right"></i>
                    </button>
                    <hr style="margin-top: 27px; margin-bottom: 27px;">
                    <button type="button" class="btnSecundario" onclick="window.location.href='../index.php'">
                        Voltar
                        <i class="fas fa-arrow-left"></i>
                    </button>
                </form>
            </div>
        </div>

</body>
</html>
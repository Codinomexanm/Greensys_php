<!DOCTYPE html>

<html>
    <!--    pagina de login-->
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="../css/login.css">
        <link rel="shortcut icon" href="../images/cons.ico">
        <title>Login</title>
    </head>

    <body>

        <!--CABEÇALHO-->
        <header>
        </header>
        <article>

            <div class="form">

                <form name="login" action="../controler/controlerLogin.php" method="post">
                    <div align="center">
                        <?php
                        /* AQUI ESPERA-SE UMA MENSAGEM VINDA VIA GET
                          SE ESTÁ VAZIA NÃO FAZ NADA, SENÃO EXIBE-A */
                        echo(empty($_GET['a'])) ? '' : $_GET['a'] . '<br>';
                        ?>
                        Usuário: <input type="text" name="nome" class="forulario">
                        <br><br>
                        Senha: <input type="password" name="senha" class="forulario">
                        <br><br>
                        <input type="submit" value="Entrar" class="enviar">
                        <br><br><br><br>
                        <?php
                        /* AQUI ESPERA-SE UMA MENSAGEM VINDA VIA GET
                          SE ESTÁ VAZIA NÃO FAZ NADA, SENÃO EXIBE-A */
                        echo(empty($_GET['msg'])) ? '' : $_GET['msg'] . '<br>';
                        ?>
                    </div>
                    <a href="user/alterarSenha.php" class="senha">Não lembra sua senha?</a>
            </div>
        </form>
        <p class="conheca"><a href="sobreNos.php">Conheça-nos</a></p>
    </article>
</body>
</html>

<?php
/* inclui o arquivo validalogin, que verifica se existe uma sessão
 * caso não exista o usuário é redimensionado para a tela de login!
 */
require_once '../../acess/usuarioDAO.php';
require_once '../../acess/residuosDAO.php';
include 'validalogin.php';
include 'verificaPerfilUsr.php';
?>
<!DOCTYPE html>
<!--
PAGINA QUE ABRIGA LINKS PARA AS APLICAÇÕES PRINCIPAIS DE ALTERAÇÃO AVANÇADA DOS DADOS DO USUÁRIO

-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Greensys-Configurações Avançadas</title>
        <link rel="stylesheet" type="text/css" href="../../css/conteudo.css">
    </head>
    <body>
        <section>

            <div align="center">
                <h3>Configurações avançadas</h3>
                <hr>
            </div>
            <div align='center'>
                <p>Para alterar senha, clique
                    <a href="alterSenha.php" class="alter">Aqui</a></p>
                <?php echo (empty($_GET['m1'])) ? "" : $_GET['m1']; ?>
                <hr>

                <p>Para alterar tipo de usuário, clique
                    <a href="alterTipoUsr.php" class="alter">Aqui</a></p>
                <?php echo (empty($_GET['m2'])) ? "" : $_GET['m2']; ?>
                <hr>

                <p>Para altera sua localização, clique 
                    <a href="alterEstado.php" class="alter">Aqui</a></p>
                <?php echo (empty($_GET['m3'])) ? "" : $_GET['m3']; ?>
                <hr>
                 <p>Para altera suas configurações de colaboração, clique 
                     <a href="alterColaboracao.php" class="alter">Aqui</a></p>
                <?php echo (empty($_GET['m4'])) ? "" : $_GET['m4']; ?>
                <hr>
            </div>
        </section>
    </body>
</html>

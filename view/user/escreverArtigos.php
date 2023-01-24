<?php
require_once '../../acess/forunDAO.php';
include './validalogin.php';
include './verificaPerfilUsr.php';
?>
<!DOCTYPE html>
<html>
    <!--    PÁGINA DE CRIAÇÃO DE ARTIGOS-->
    <head>
        <meta charset="UTF-8">
        <title>Greensys-Cadastro de Usuário</title>
        <link rel="stylesheet" type="text/css" href="../../css/conteudo.css">
        <script src="../../js/jquery.js"></script>
        <script src="../../js/jquery-ui.custom.js"></script>
        <script type="text/javascript" src="../../js/tinymce/js/tinymce/tinymce.min.js"></script>
        <script type="text/javascript">
            tinymce.init({selector: 'textarea'});
        </script>
    </head>
    <body>
        <!--        FORMULARIO DE CRIAÇÃO -->
        <section>
            <div align="center">
                <h3>Artigos</h3>
                <hr>
            </div>
            <div align='center'>
                <form action="../../controler/usr/controlerEscreverArtigos.php" method="post">
                    <p class="titulo"> Titulo</p>
                    <br>
                    <input type="text" name="titulo" size="50%">
                    <br><br>
                    <p class="titulo">Texto</p>
                    <textarea name="texto" cols="99" rows="20"></textarea>
                    <br>
                    <?php /* SE NÃO ESTIVER VAZIO $_GET['i'] exibe uma mensagem */ echo (empty($_GET['i'])) ? "" : $_GET['i']; ?>
                    <input type="submit" value="publicar" class="enviar">
                </form>        


            </div>
        </section>

    </body>
</html>

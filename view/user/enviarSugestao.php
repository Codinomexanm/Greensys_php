<?PHP
require_once './validalogin.php';
?>
<!DOCTYPE html>
<!--
FORMULÁRIO DE ENVIO DE DADOS
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="../../css/conteudo.css">
    </head>
    <body>
        <form method="post" action="../../controler/usr/controlerSugestao.php">
            <center>
                <br>
                <h3>Escreva a sua sugestão:</h3>
            <hr>
            <textarea cols="90" rows="20" name="sugestao"></textarea>
            <br><br>
            <input type="submit" value="Enviar" class="enviar">  
            
<?php /* SE NÃO ESTIVER VAZIO $_GET['i'] exibe uma mensagem */ echo (empty($_GET['i'])) ? "" : $_GET['i']; ?>
            </center>
            
        </form>
    </body>
</html>

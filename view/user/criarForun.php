<?php
include 'validalogin.php';
include 'verificaPerfilUsr.php';
?>
<!DOCTYPE html>
<html>
    <!--    PÁGINA DE CRIAÇÃO DE FÓRUN-->
    <head>
        <meta charset="UTF-8">
        <title>Greensys-Fórun</title>
        <link rel="stylesheet" type="text/css" href="../../css/conteudo.css">
        <script>
            //FUNÇÃO QUE FOCA NO PRIMEIRO CAMPO DO FORMULÁRIO ASSM QUE A PÁGINA É CARREGADA
            function foco() {
                document.formForun.topico.focus();
            }
        </script>
    </head>
    <body onload="foco();">
        <div align="center">
            <h3>Fóruns</h3>
            <hr>
        </div>
        <!--        FORMULARIO DE CRIAÇÃO-->
        <section>
            <div align='center'>
                <form name='formForun' action="../../controler/usr/controlerSalvarForun.php " method="post">
                    <table>
                        <thead>Novo Tópico</thead>

                        <tr>
                            <td>Assunto</td>
                            <td><input type="text" name="topico"></td>
                        </tr>
                        <tr>
                            <td>Dúvida</td>
                            <td><textarea name="duvida" rows="10" cols="60"></textarea></td>
                        </tr>
                    </table>
                    <?php echo(empty($_GET['a'])) ? '' : $_GET['a']; ?>
                    <hr>
                    <input type="submit" value='OK' class="enviar">
                </form>
            </div>
        </section>

    </body>
</html>

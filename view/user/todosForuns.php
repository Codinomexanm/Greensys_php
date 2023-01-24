<?php
//REQUER FORUNDAO E INCLUI PÁGINA DE VALIDAÇÃO DE OGIN
require_once '../../acess/forunDAO.php';
include 'validalogin.php';
include 'verificaPerfilUsr.php';
?>
<!DOCTYPE html>
<html>
    <!--PÁGINA DE LISTAGEM DE TODOS OS TÓPICOS DE FÓRUN-->
    <head>
        <meta charset="UTF-8">
        <title>Greensys-Fórun</title>
        <link rel="stylesheet" type="text/css" href="../../css/conteudo.css">
    </head>
    <body>
        <!--  EXIBE TODOS OS FÓRUNS-->
        <section>
            <?php $tempo = date('Y-m-d H:i:s'); ?>
            <div align="center">
                <h3>Todos os fóruns</h3>
                <hr>
            </div>
            <div align='center'>
                <table class="alunoAp">
                <?php
                //INTANCIA FORUNSDAO
                $forun = new ForunDAO();
                //LISTA TODOS OS FÓRUNS
                $todos = $forun->listarForunsAntigos();
                //APRESNETA OS RESULTADOS GERAIS
                echo '<tr>';
                foreach ($todos as $valor) {
                    //AUTOR
                    echo '<td>Escrito por:' . $valor['nome'].'</td>';
                    //DATA
                    echo '<td>Em:' . $forun->converterData($valor['dataPublicacao']) .'</td>';
                    //LINK DO POST
                    echo "<td><a href='foruns.php?i=" . $valor['idForun'] . "'>" . $valor['topico'] . "</a></td>";

                    echo '<tr>';
                }if(empty($todos)){
                    echo 'Não há nenhum fórum até o momento. =,(';
                }
                ?>
                    </table>
            </div>
        </section>

    </body>
</html>

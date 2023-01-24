<?php
include '../../view/user/validalogin.php';
 include './verificaPerfilAdm.php';
 require_once '../../acess/artigosDAO.php';
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
        <!--  EXIBE TODOS OS ARTIGOS-->
        <section>
             <div align="center">
                <h3>Todos os artigos</h3>
                <hr>
            </div>
            <?php $tempo = date('Y-m-d H:i:s'); ?>
            <div align='center'>
                <br><br><br><br>
                <table class="alunoAp">
                <?php
                //INTANCIA FORUNSDAO
                $artigo = new artigosDAO();
                //LISTA TODOS OS ARTIGOS
                $todos = $artigo->listarArtigosAntigos();
                //APRESNETA OS RESULTADOS GERAIS
                echo '<tr>';
                foreach ($todos as $valor) {
                    //AUTOR
                    echo '<td>Escrito por:  ' . $valor['nome'].'</td>';
                    //DATA
                    echo '<td>Em:  ' . $artigo->converterData($valor['dataPub']) . '<td>';
                    //LINK DO POST
                    echo "<td><a href='artigosAdm.php?i=" . $valor['idArtigo'] . "'>" . $valor['titulo'] . "</a></td>";

                    echo '<tr>';
                }if(empty($todos)){
                    echo 'não há artigos publicados =,(';
                }
                ?>
                    </table>
            </div>
        </section>

    </body>
</html>

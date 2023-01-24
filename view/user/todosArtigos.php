<?php
//REQUER ARTIGOSDAO E INCLUI PÁGINAS DE VALIDAÇÃO DE LOGIN E VERIFICAÇÃO DE PERFIL
require_once '../../acess/artigosDAO.php';
include 'validalogin.php';
include 'verificaPerfilUsr.php';
?>
<!DOCTYPE html>
<html>
    <!--PÁGINA DE LISTAGEM DE TODOS OS ARTIGOS DO SISTEMA-->
    <head>
        <meta charset="UTF-8">
        <title>Greensys-Fórun</title>
        <link rel="stylesheet" type="text/css" href="../../css/conteudo.css">
    </head>
    <body>
        <!--  EXIBE TODOS OS ARTIGOS-->
        <section>
            <?php $tempo = date('Y-m-d H:i:s'); ?>
            <div align="center">
                <h3>Todos os Artigos</h3>
                <hr>
            </div>
            <div align='center'>
                <table class="alunoAp">
                    <?php
                    //INTANCIA ARTIGOSDAO
                    $artigo = new artigosDAO();
                    //LISTA TODOS OS ARTIGOS
                    $todos = $artigo->listarArtigosAntigos();
                    //APRESNETA OS RESULTADOS GERAIS
                    echo '<tr>';
                    foreach ($todos as $valor) {
                        //AUTOR
                        echo '<td>Escrito por:  ' . $valor['nome'] . '</td>';
                        //DATA
                        echo '<td>Em: ' . $artigo->converterData($valor['dataPub']) . '</td>';
//LINK DO POST
                        echo "<td><a href='listarArtigos.php?i=" . $valor['idArtigo'] . "'>" . $valor['titulo'] . "</a></td>";

                        echo '</tr>';
                    }if (empty($todos)) {
                        echo 'nao ha artigos escritos até agora =,(';
                        echo '<br>';
                        echo 'Colabore, escrevendo um artigo ';
                        echo '<a href="escreverArtigos.php"><font color="green">clicando aqui</font></a>';
                        }
                    ?>
                </table>
            </div>
        </section>

    </body>
</html>

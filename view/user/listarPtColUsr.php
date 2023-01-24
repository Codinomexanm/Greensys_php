<?php
/* inclui o arquivo validalogin, que verifica se existe uma sessão
 * caso não exista o usuário é redimensionado para a tela de login!
 */
//REQURER PONTOSDECOLETADAO
require_once '../../acess/pontosDeColetaDAO.php';
include 'validalogin.php';
include 'verificaPerfilUsr.php';
?>
<!DOCTYPE html>
<!--
PÁGINA DE BUSCA FILTRADA POR PONTOS DE COLETA, A APLICAÇÃO NECESSITA DE PREENCHIMENTO DE FORMULARIO

-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Greensys-Procurar Companheiros</title>
        <link rel="stylesheet" type="text/css" href="../../css/conteudo.css">
    </head>
    <body>
        <section>

            <div align="center">
                <h3>Procurar pontos de coleta</h3>
                <hr>
            </div>
            <div align='center'>
                <form name="formPesquisa" action="" method="post">
                    Pesquisar por:
                    <br>
                    <br>
                    Estado <input type="radio" name="tpesq" value="estado">
                    Tipo de resíduo <input type="radio" name="tpesq" value="tresiduo">
                    Cidade<input type="radio" name="tpesq" value="cidade">
                    <br>
                    <input type="text" name="pesquisa" onkeyup="this.value = this.value.replace(/[''çÇáÁàÀÂâéèÊêÉÈíìÍÌóòÓÒúùÚÙñÑ~@&]/g, '');">
                    <input  type="submit" value="Pesquisar" class="pesquisar">

                    </div>
                    <hr>
                </form>
                <div align='center'>
                    <table class="aluno">


                        <?php
                        //SE OS CAMPOS DO FORM NÃO ESTIVEREM VAZIOS, RECEBE OS DADOS
                        if (
                                (!empty($_POST['tpesq'])) ? $tpes = $_POST['tpesq'] : '' and
                                        (!empty($_POST['pesquisa'])) ? $pesq = $_POST['pesquisa'] : ''
                        ) {
                            //INSTANCIA PONTOSDECOLETADAO
                            $pesquisa = new PontosDeColetaDAO();
                            //CHAMA A FUNCAO DE BUSCA E ARMAZENA OS RESULTADOS NA VARIAVEL $BUSCA
                            $busca = $pesquisa->BuscaComParam($tpes, $pesq);
                            //SE $busca NAO ESTIVER VAZIA
                            if ($busca) {
                                //EXIBE OS RESULTADOS
                                echo"<h4>Resutados</h4>";
                                echo "<th>Local</th>
                        <th>Estado</th>
                        <th>Cidade</th>
                        <th>Telefone</th>
                        <th>Tipo de resíduo</th>
                        <th>Nome do local</th>
                        <tr>";
                                foreach ($busca as $v) {
                                    echo '<tr>';
                                    echo "<td>" . $v['local'] . "</td>";
                                    echo "<td>" . $v['estado'] . "</td>";
                                    echo "<td>" . $v['nomecidade'] . "</td>";
                                    echo "<td>" . $v['telefone'] . "</td>";
                                    echo "<td>" . $v['tipoRes'] . "</td>";
                                    echo "<td>" . $v['nomeEstab'] . "</td>";

                                    echo "</tr>";
                                }
                            }//SE $BUSCA EESTIVER VAZIA EXIBE UMA MENSAGEM INFORMANDO QUE NAO FORAM ENCONTRADOS RESULTADOS
                            else {
                                echo 'não foram encontrados resultados para a busca';
                            }
                        }//SE AO MENOS ALGUM CAMPO NAO ESTIVER PREENCHIDO, 
                        else {
                            //PEDE PARA QUE TODOS OS CAMPOS SEJAM PREENCHIDOS
                            echo 'Preencha todos os campos, por favor!';
                        }
                        ?>
                    </table>
                </div>          
        </section>


    </body>
</html>

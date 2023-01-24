<?php
/* inclui o arquivo validalogin, que verifica se existe uma sessão
 * caso não exista o usuário é redimensionado para a tela de login!
 * E REQUER PONTOSDECOLETADAO PARA O FUNCIONAMENTO CORRETO DA APLICAÇÃO
 */
include 'validalogin.php';
include 'verificaPerfilUsr.php';
require_once '../../acess/pontosDeColetaDAO.php';
?>
<!DOCTYPE html>
<!--
PÁGINA DE BUSCA INTELIGENTE POR PONTOS DE COLETA, INFORMA AO USUARIO SE EXISTE PONTOS DE COLETA CADASTRADOS PERTO DO LOCAL
AONDE ELE MORA

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
                <h3>O greennsys recomenda</h3>
                <hr>
            </div>
            <div align='center'>
                <table class="aluno">


                    <?php
                    //PEGA O ID DO USUARIO DA SESSÃO
                    $id = $_SESSION['id'];
                    //INSTANCIA PONTOSDECOLETADAO
                    $pesquisa = new PontosDeColetaDAO();
                    //CHAMA O METODO DE BUSCA AVANÇADA E ARMAZENA OS RESUTADOS DENTRO DE $BUSCA
                    $busca = $pesquisa->buscarPtColAvancado($id);
                    
                    //SE $BUSCA NÃO ESTIVER VAZIO, 
                    if ($busca) {
                        //EXIBE OS RESULTADOS
                        echo"<h4>Locais proxímos de você</h4>";
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
                    }//SENÃO, INFORMA QUE NÃO HÁ LOCAIS PRÓXIMOS AO USUÁRIO
                    else {
                        echo 'pareçe que não há locais próximos a você =,( <br>. Caso você conheça algum,<br><a href="cadstrarPtCol.php"  class="propaganda">Recomende aqui</a>  ';
                    }
                    ?>
                </table>
            </div>          
        </section>
    </body>
</html>

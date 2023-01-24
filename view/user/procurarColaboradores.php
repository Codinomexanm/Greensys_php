<?php
/* inclui o arquivo validalogin, que verifica se existe uma sessão
 * caso não exista o usuário é redimensionado para a tela de login!
 * requer outras duas classes para funcionar corretamente
 */
require_once '../../acess/usuarioDAO.php';
require_once '../../acess/residuosDAO.php';
include 'validalogin.php';
include 'verificaPerfilUsr.php';
?>
<!DOCTYPE html>
<!--
PAGINA DE PESQUISA FILTRADA POR COLABORADORES DO SISTEMA
!-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Greensys-Procurar Companheiros</title>
        <link rel="stylesheet" type="text/css" href="../../css/conteudo.css">
        <!-- CHAMA AS LIVRARIAS JAVA SCRIPT NECESSÁRIAS PARA A EXECUÇÃO DE ALGUMAS FUNCIONALIDADES DA PÁGINA-->
        <script src="../../js/jquery.js" ></script>
        <script src="../../js/jquery.maskedinput.js"></script>

        <script>
            //FUNÇÃO JQUERY E AJAX PARA BUSCAR ESTADOS NO BANCO DE DADOS E ATRAVÉS DOS MESMOS AS SUAS RESPECTIVAS CIDADES
            function buscar_cidades() {
                var estado = $('#estado').val();
                if (estado) {
                    var url = '../../controler/usr/buscar_cidades.php?estado=' + estado;
                    $.get(url, function(dataReturn) {
                        $('#load_cidades').html(dataReturn);
                    });
                }
            }

        </script>
    </head>
    <body>
        <section>

            <div align="center">
                <h3>Procurar doadores e coletores</h3>
                <hr>
            </div>
            <div align='center'>
                <form name="formPesquisa" action="" method="post">
                    <table name="t1">
                        <thead>Pesquisar por :</thead> 
                        <tr>
                            <td>Doadores<br><input id="doar" type="radio" name="acao" value="doador"></td>
                            <td>Coletores   <br><input id="colher" type="radio" name="acao" value="coletor" ></td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td>
                                Estado:   
                            </td>
                            <td>
                                <select  name="uf" id="estado" onchange="buscar_cidades()">
                                    <?php
                                    //fazer uma lista de opções busca-las do banco de dados para jogar opções aqui. 
                                    $listar = new UsuarioDAO();
                                    $lista = $listar->listarEstados();
                                    foreach ($lista as $op) {

                                        echo"<option  value=" . $op['uf'] . ">" . $op['uf'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Cidade:   
                            </td>
                            <!--                        nessa td serão lançadas as opções(cidades) referentes a escolha do usuário
                                                    obs: as opções estão salvas no script buscar_cidades-->
                            <td id="load_cidades" >
                                <select name="cidade">
                                    <option>escolha uma opção</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                    Tipo de resíduo:<br>
                    <select name="opcao">
                        <?php
                        $r = new residuosDAO();
                        $res = $r->listarTipos();
                        foreach ($res as $v) {

                            echo "<option value=" . $v['tipoRes'] . ">" . $v['tipoRes'] . "</otion>";
                        }
                        ?>
                    </select>


                    <?php
                    echo (empty($_GET['a'])) ? '' : $_GET['a'];
                    echo '<br>';
                    ?>  
                    <br>
                    <br>
                    <input type="submit" value="pesquisar" class="enviar">

                    </div>
                    <hr>
                </form>
                <div align='center'>
                    <h4>Resutados</h4>

                    <?php
                    $msg = "";
                    //SE OS CAMPOS DO FORMULARIO NAO ESTIVEREM VAZIOS,
                    if (!empty($_POST['acao']) and !empty($_POST['uf']) and !empty($_POST['cidade']) and !empty($_POST['opcao'])) {
                        //RECEBE OS DADOS
                        $ac = $_POST['acao'];
                        $est = $_POST['uf'];
                        $cid = $_POST['cidade'];
                        $op = $_POST['opcao'];
                        //INSTACIA RESIDUOSDAO
                        $lista = new residuosDAO();
                        //CHAMA A FUNCAO DE BUSCA E ARMAZENA O RETORNO EM $RESULT
                        $result = $lista->listarAgentes($ac, $est, $cid, $op);
                        //SE NÃO ESTIVER VAZIA A VARIAVEL $RESULT
                        if (!empty($result)) {
                            echo '<h4>Entre em contato com:</h4>';
                            //EXIBE OS CAMPOS EM FORMA TABULADA
                            echo '<table border="1">';
                            echo '<th>Nome</th>';
                            echo '<th>Ação</th>';
                            echo '<th>Tipo de Residuo</th>';
                            echo '<th>Email</th>';
                            echo '<th>Telefone</th>';
                            echo '<tr>';

                            foreach ($result as $v) {
                                echo '<td>' . $v['nome'] . '</td>';
                                echo '<td>' . $v['acao'] . '</td>';
                                echo '<td>' . $v['tipoRes'] . '</td>';
                                echo '<td>' . $v['email1'] . '</td>';
                                echo '<td>' . $v['telefone1'] . '</td>';
                                echo '<tr>';
                            }

                            echo '</table>';
                        }//SE A VARIAVEL ESTIVER VAZIA, EXIBE UMA MENSAGEM INFORMANDO QUE NAO FORAM ENCONTRADOS RESULTADOS PARA PESUISA
                        else {
                            $msg = 'não foram encontrados resultados para essa busca, verifique '
                                    . 'se todos os campos estão selecionados.';
                            echo $msg;
                        }
                    }//SE AO MENOS ALGUM CAMPO ESTIVER VAZIO E $RESULT TAMBEM, EXIBE UMA MENSAGEM PARA PREENCER TODOS OS CAMPO
                    //OBS: SE AO INVEZ DE AND, ESCREVER-SE OR EM $EMPTY($RESULT) DUAS CONDIÇÕES SAO SATISTEITAS E EXIBE A MENSGEM DE
                    //PREENCHIMENTO E A MENSAGEM DE BUSCA->ISSO NÃO SERIA LEGAL oO
                    if (empty($_POST['acao']) or empty($_POST['uf']) or empty($_POST['cidade']) or empty($_POST['opcao']) and empty($result)) {
                        echo 'selcione todos os campos, por favor';
                    }
                    ?>

                </div>
        </section>
    </body>
</html>

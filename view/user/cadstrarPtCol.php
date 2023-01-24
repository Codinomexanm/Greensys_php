<?php
/* inclui o arquivo validalogin, que verifica se existe uma sessão
 * caso não exista o usuário é redimensionado para a tela de login!
 */
require_once '../../acess/usuarioDAO.php';
require_once '../../acess/pontosDeColetaDAO.php';
require_once '../../acess/residuosDAO.php';
include 'validalogin.php';
include 'verificaPerfilUsr.php';
?>
<!DOCTYPE html>
<!--
página de cadastro de pontos de coleta

-->
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
//FUNÇÃO QUE FOCA NO PRIMEIRO CAMPO DO FORMULÁRIO ASSM QUE A PÁGINA É CARREGADA
            function foco() {
                document.formCadPtCol.nome.focus();
            }
            jQuery(function($) {
                $("#telefone").mask("(99)9999-9999");
            });
        </script>
    </head>
    <body onload="foco()">
        <section>

            <div align="center">
                <h3>Cadastrar Pontos de Coleta</h3>
                <hr>
            </div>
            <div align='center'>
                <form name="formCadPtCol" action="../../controler/usr/controlerPtCol.php" method="post">

                    <table>
                        <tr>
                            <td>
                                Nome do Estabelecimento:
                            </td>
                            <td>
                                <input type="text" name="nome">
                            </td>
                        </tr>
                        <tr>
                            <Td>
                                Local: 
                            </Td>
                            <td>
                                <input type="text" name="local">
                            </td>
                        </tr>
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
                        <tr>
                            <td>
                                Tipo de resíduo:            
                            </td>
                            <td>
                                <select name="opcao">
                                    <?php
                                    $r = new residuosDAO();
                                    $res = $r->listarTipos();
                                    foreach ($res as $v) {

                                        echo "<option value=" . $v['tipoRes'] . ">" . $v['tipoRes'] . "</otion>";
                                    }
                                    ?>
                                </select> 
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Telefone de Contato:
                            </td>
                            <td>
                                <input type="tel" name="telefone" id="telefone">
                            </td>
                        </tr>
                    </table>
                    <?php
                    echo (empty($_GET['a'])) ? '' : $_GET['a'];
                    echo '<br>';
                    ?>  

                    <input type="submit" value="salvar" class="enviar">

                    </div>
                    <hr>
                </form>

        </section>
    </body>
</html>

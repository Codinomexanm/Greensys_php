<?php
/* inclui o arquivo validalogin, que verifica se existe uma sessão
 * caso não exista o usuário é redimensionado para a tela de login!
 */
require_once '../../acess/residuosDAO.php';
include '../.././view/user/validalogin.php';
include './verificaPerfilUsr.php';
?>
<!DOCTYPE html>
<!--PÁGINA  DE CADASTRO DE USUARIOS PARA COLABORAÇÃO COM A COLETA OU DOAÇÃO DE RESÍDUOS

-->
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Compartilhando com o meio ambiente</title>
        <link rel="stylesheet" type="text/css" href="../../css/conteudo.css">
    </head>
    <body onload="focos();">
        <section>

            <div align="center">
                <h3>Colabore com o meio-ambiente</h3>
                <hr>
                <samp class="proposta">
    O greensys desenvolveu um projeto de integração entre membros do sistema.
A nossa ideia de planejamento se baseou no perfil dos usuários-pessoas Físicas
e Jurídicas preocupadas com questões ambientais e dispostas a colaborarem entre sí. 
Uma dessas formas de colaboração é o cadastro desta página, cujo objetivo é interligar
 membros que tenham algúm tipo de resíduo para doar e mebros que coletem o mesmo tipo. <br>
O cadastro é simples e rápido. Mas caso você não queira se cadstrar a opção de procurar
 por colaboradores registratos ainda está disponível <a href="procurarColaboradores.php">nesta página.</a>
                </samp>
                <form name="formares" method="post" action="../../controler/usr/controlerCadastrarRes.php">
                    <hr>
                    Você gostaria de :
                    <table  name="t1">
                        <tr>
                            <td>Doar<br><input id="doar" type="radio" name="acao" value="doador"></td>
                            <td>Colher <br><input id="colher" type="radio" name="acao" value="coletor" ></td>
                        </tr>
                    </table>
                    <div>
                        <select name="opcao">
                            <?php
                            $r = new residuosDAO();
                            $res = $r->listarTipos();
                            foreach ($res as $v) {

                                echo "<option value=" . $v['tipoRes'] . ">" . $v['tipoRes'] . "</otion>";
                            }
                            ?>
                        </select>

                    </div>
                    <?php
                    echo (empty($_GET['a'])) ? '' : $_GET['a'];
                    echo '<br>';
                    ?>
                    <hr>
                    <input type="submit" value="OK" class="enviar">

                </form>
            </div>

        </section>

    </body>
</html>

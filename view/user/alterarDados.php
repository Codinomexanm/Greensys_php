<?php
/* inclui o arquivo validalogin, que verifica se existe uma sessão
 * caso não exista o usuário é redimensionado para a tela de login!
 */
require_once '../../acess/usuarioDAO.php';
include 'validalogin.php';
include 'verificaPerfilUsr.php';
?>
<!DOCTYPE html>
<!--
página inicial do sistema, nela apresentam-se algumas funções básicas do sistema

-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Greensys-Alterar Dados</title>
        <link rel="stylesheet" type="text/css" href="../../css/conteudo.css">
        <script src="../../js/jquery.js"></script>
        <script src="../../js/jquery.maskedinput.js"></script>
        <script>

            function focos() {
                document.formAlterar.nome.focus();
            }
            //JQUERY PARA MÁSCARAS NOS CAMPOS ESPECÍFICADOS
            jQuery(function($) {

                $("#tel1").mask("(99)9999-9999");

            });
        </script>
    </head>
    <body onload="focos();">
        <section>
            <?php
            $usuarioDto = new UsuarioDAO();
            $id = $_SESSION['id'];
            $usr = $usuarioDto->listarUsr($id); /* print_r($usr); */ foreach ($usr as $v)
                
                ?>
            <div align="center">
                <h3>Alterar Dados</h3>
                <hr>
            </div>
            <div align='center'>
                <form name='formAlterar'  action="../../controler/usr/controleAlterarDados.php" method="post">
                    <table>
                        <tr>
                            <td>Nome:</td>
                            <td ><input  type="text" name="nome" id="nomeUsuario" maxlength="50" value="<?php echo $v['nome'] ?>"></td>
                        </tr>
                        <tr>
                            <td>
                                Email para  Login:
                            </td>
                            <td>
                                <input type="text" name="login" value="<?php echo $v['login'] ?>">

                            </td>

                        </tr>

                        <tr>
                            <td>
                                Email para contato:   
                            </td>
                            <td>
                                <input type="text" name="email" id="email1" value="<?php echo $v['email1'] ?>">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                Telefone para contato:   
                            </td>
                            <td>
                                <input type="text" name="telefone" id="tel1" maxlength="14" value="<?php echo $v['telefone1'];?>">
                            </td>
                        </tr>
                    </table>
                    <?php
                    if (!empty($_GET['a'])) {
                        echo $_GET['a'];
                    }
                    ?>
                    <br><br>
                    <input type="submit" value='Alterar' class="enviar" >
                    <div align="right"><a href="configuracoesAvancadas.php">Alterações avançadas</a>&nbsp;&nbsp;</div>
                    <br>    
                </form>
            </div>
        </section>
    </body>
</html>

<?php
require_once '../../acess/usuarioDAO.php';
include 'validalogin.php';
include 'verificaPerfilUsr.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Alterar Senha</title>
        <link rel="stylesheet" type="text/css" href="../../css/conteudo.css">
        <script>
      //FUNÇÃO QUE VERIFICA SE AS SENHAS COINCIDEM
            function confirmarSenha() {
                var senha1 = document.formAlterar.senha.value;
                var senha2 = document.formAlterar.senha2.value;
                if (senha1 == senha2) {

                } else {
                    window.alert("as senhas não coincidem, por favor redigite-as");
                    document.formAlterar.senha.focus();
                }
            }
            //FUNÇÃO QUE DEIXA O FOCO NO CAMPO DE ALTERAÇÃO DE SENHA
            function foco() {
                document.formAlterar.senha.focus();
            }
        </script>
    </head>
    <!--    CABEÇALHO-->
    <header>
        <h1><center>Greensys</center></h1>
        <hr>
    </header>
    <body onload="foco();">
        <!--        FORMULÁRIO DE ALTERAÇÃO DE CAMPOS-->
        <form name="formAlterar" action="" method="post"><center>
                <table>
                    <tr>
                        <td>
                            Senha: 
                        </td>
                        <td>
                            <input type="password" name="senha" id="senhaCad" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Confirme sua Senha: 
                        </td>
                        <td  id="senha2">
                            <input type="password" name="senha2"  onblur="confirmarSenha();">
                        </td>
                    </tr>
                </table>
<br><br>
            </center>
            <center><input type="submit" value="pronto" class="env"><br><br></center></form>
        <hr>
        <?php
        //SE A SENHA NÃO ESTIVER VAZIA
        if (!empty($_POST['senha'])) {
            //CODIFICA A SENHA
            $senha = md5($_POST['senha']);
            //PEGA O ID DA SESSÃO
            $id = $_SESSION['id'];
            //INSTANCIA USUARIODAO
            $alterar = new UsuarioDAO();
            //CHAMA O MÉTODO DE ALTERA A SENHA
            $alterar->alterarSenha($senha, $id);
                //REDIMENSIONA PARA A PAGINA ANTERIOR E EXIBE UMA MENSAGEM
                $msg = "senha alterada com sucesso";
                echo "<script>
        window.location='http://localhost/greensys/view/user/configuracoesAvancadas.php?m1=$msg';
        </script>";
          
        }//SE A SENHA ESTIVER VAZIA, PEDE PARA O USUARIO ALTERAR A SENHA
        else {
            echo '<center>Altere sua senha</center>';
        }
        ?>

    </body>
</html>

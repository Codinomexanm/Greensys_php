<?php
/* ALGUMAS FUNÇÕES PHP DESTA PÁGINA NECESSITAM DA CLASSE DE ACESSO USUARIODAO */
require_once '../../acess/usuarioDAO.php';
?>
<!DOCTYPE html>
<!--
PÁGINA DE ALTERAÇÃO DE SENHA DO USUÁRIO
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="../../css/conteudo.css">
        <link rel="shortcut icon" href="../../images/cons.ico">
        <title>Alteração de Senha</title>
        <!--incluir bibliotecas js -->
        <script src="../../js/jquery.js"></script>
        <script src="../../js/jquery.maskedinput.js"></script>
        <script src="../../js/jquery.validate.js"></script>
        <style type="text/css">
            #pf{
                display:none;

            }
            #pj{
                display:none;

            }
        </style>
        <script type="text/javascript">
            //JQUERY PARA MÁSCARAS NOS CAMPOS ESPECÍFICADOS
            jQuery(function($) {
                $("#cpf").mask("999.999.999-99");
                $("#dataNasc").mask("99/99/9999");
                $("#cnpj").mask("99.999.999/9999-99");
                $("#tel1").mask("(99)9999-9999");

            });
            //FUNÇÃO PARA EXIBIR CAMPOS DIFERENTES DE CADASTRO, ESSA É A FUNÇÃO QUE ATUA JUNTO COM O PRIMEIRO STYLE DA PÁGINA
            function pessoa(tipoUsr) {
                switch (tipoUsr) {
                    case 'fisica':

                        document.getElementById("pf").style.display = "inline";
                        document.getElementById("pj").style.display = "none";
                        break;
                    case 'juridica':
                        document.getElementById("pj").style.display = "inline";
                        document.getElementById("pf").style.display = "none";
                }

            }
            //FUNÇÃO QUE VERIFICA SE AS SENHAS COINCIDEM
            function confirmarSenha() {
                var senha1 = document.formAlterarSenha.senha.value;
                var senha2 = document.formAlterarSenha.senha2.value;
                if (senha1 == senha2) {

                } else {
                    window.alert("as senhas não coincidem, por favor redigite-as");
                    document.formAlterarSenha.senha.focus();
                }
            }
            //FUNÇÃO QUE DEIXA O FOCO NO CAMPO DE ALTERAÇÃO DE SENHA



        </script> 

    </head>
    <body>
        <header class="cadastro">
        </header>
        <div align='center'>
            <br><br>
            <label>Alterar Senha </label>
            <form name='formAlterarSenha' id='cadastro' action="" method="post" class="cad">
<br>
                Email de   Login:
                <input type="email" name="login" id="loginCad">
                <br><br>
                Tipo de Pessoa:
                <input type="radio" name="tipoUsr" value="fisica" onclick="pessoa(this.value);">Pessoa física

                <input type="radio" name="tipoUsr" value="juridica" onclick="pessoa(this.value);" >Pessoa jurídica
                <br><br>
                <div id="pf">
                    CPF:
                    <input type="text" name="cpf" id="cpf" maxlength="14" >
                    <br><br>
                    Data de nascimento: <input type='date'name="data" id="dataNasc"maxlength="">
                    <br>
                </div>
                <div id="pj">
                    CNPJ:
                    <input type="text" name="cnpj" id="cnpj" maxlength="18">
                    <br>
                </div>

                <br>
                Nova Senha: 
                <input type="password" name="senha" id="senhaCad" onblur="regraSenha(this.value);">
                <br><br>
                Confirme sua Senha: 
                <input type="password" name="senha2"  onblur="confirmarSenha();">
                <br><br>
                <input type="submit" value="Alterar Senha" class="enviar">
            </form>
        </div>
        <?php
        if (!empty($_POST['login']) and !empty($_POST['tipoUsr'])) {
            $login = $_POST['login'];
            $pessoa = $_POST['tipoUsr'];
//se pf vier vazio->num pessoa=pj
            if (empty($_POST['cpf'])) {
                $numpessoa = $_POST['cnpj'];
            } else {
                $numpessoa = $_POST['cpf'];
            }

//se os campos não estão vazios, atribui os valores do formulário a eles, senão valor nulo
            (empty($_POST['data'])) ? $data = 'nulo' : $data = $_POST['data'];
            /* (empty($_POST['login'])) ? $login = 'nulo' : */ $login = $_POST['login'];
            (empty($_POST['senha'])) ? $senha = 'nulo' : $senha = $_POST['senha'];



//instancia UsuarioDTO e usa seus metdos set(pegar)
            $usuarioDto = new UsuarioDTO();
            $usuarioDto->setLogin($login);
            $usuarioDto->setTipoPessoa($pessoa);
            $usuarioDto->setNumpessoa($numpessoa);
            $usuarioDto->setDataNasc($data);
            $Pass = $usuarioDto->criptografarSenha($senha);
            $usuarioDto->setSenha($Pass);
            $sn = $usuarioDto->getSenha();
            // intancia UsuarioDAO
            $usuarioDAO = new UsuarioDAO();
            //VERIFICA SE JA EXISTE ALGUEM CADASTRADO COM ESSE LOGIN
            $usua = $usuarioDAO->verificarDados($usuarioDto);
            if (empty($usua)) {
                echo '<center><center><font color="red">Não há usuário cadstrado com esses dados</font></center>';
            }
            $u = $usua['id'];
            $usuarioDAO->alterarSenha($sn, $u);
            $msg = "Sua senha foi alterada, realize o login com a nova senha!<br>";
            echo "<script>
        window.location='http://localhost/greensys/view/login.php?a=$msg';
        </script>";
        } else {
            echo '<br><br><center>preencha todos os campos</center>';
        }
        ?>
    </body>
</html>

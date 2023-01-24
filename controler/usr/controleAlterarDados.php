<?php
require_once '../../acess/usuarioDAO.php';
include '../../view/user/validalogin.php';
?><!DOCTYPE html>
<!--
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        //recebe os dados de alteração
        $nome = $_POST['nome'];
        $login = $_POST['login'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $ses = $_SESSION['Usuario'];
        $id = $_SESSION['id'];


        //INSTÂNCIAR USUARIODTO E VERIFICAR SE ALGÚM CAMPO ESTÁ VAZIO
        $usuarioDto = new UsuarioDTO();
        //SE NÃO ESTIVER VAZIO,
        if (!empty($nome)) {
            //CHAMO SETNOME 
            $usuarioDto->setNomeUsuario($nome);
        }//ok
        if (!empty($email)) {
            $usuarioDto->setEmail1($email);
        }
        if (!empty($telefone)) {
            $usuarioDto->setTelefone1($telefone);
        }
        $usuarioDto->setId($id);
        //INSTANCIAR USUARIODAO
        $usariodao = new UsuarioDAO();

        $verifica = $usariodao->verificarExistLogin($login);
        if (empty($verifica) OR $login == $ses) {
            if (!empty($login)) {
                $usuarioDto->setLogin($login);
            }
        } else {
            $msg = "já existe um usuário com esse nome de login" . "<br>";
            echo "<script>
        window.location='http://localhost/greensys/controler/usr/alterarDados.php?a=$msg';
        </script>";
        }
        echo $usuarioDto->getNomeUsuario();
        echo '<br>';
        echo $usuarioDto->getLogin();
        echo '<br>';
        echo $usuarioDto->getEmail1();
        echo '<br>';
        echo $usuarioDto->getTelefone1();
        echo '<br>';
        $usuarioDto->getId();
        $usariodao->alterarDados($usuarioDto);
        echo 'ok';
        $msg = "alterações efetuadas com sucesso" . "<br>";
        echo "<script>
        window.location='http://localhost/greensys/view/user/alterarDados.php?a=$msg';
        </script>";
        ?>
    </body>
</html>

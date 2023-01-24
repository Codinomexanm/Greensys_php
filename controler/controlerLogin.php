<?php require_once '../transfer/loginDTO.php'; ?>
<!DOCTYPE html>
<!--AO SER LOGADO OS DADOS DO USUARIO SAO PROCESSADOS AQUI-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        //RECEBE  NOME DE LOGIN
        $n = $_POST['nome'];
        //RECEBE E APLICA CRIPTOGRAFIA A SENHA
        $s = md5($_POST['senha']);
        //INSTANCIA A CLASSE LOGIN
        $user = new LoginDTO();
        //CHAMA O MÉTODO LOGAR
        $result = $user->logar($n, $s);
        //PEGA O ID DO USUÁRIO 
        $id = $user->getId($n, $s);
        //VERIFICA O PERFIL DO USUÁRIO
        $ver = $user->verificarPerfil($id['id']);
        //PEGA O NOME DO USUARIO
        $nomeUsr=$user->getNomeUsr($id['id']);
        //SE $RESULT NÃO ESTIVER VÁZIO, SINAL QUE ENCONTROU RESULTADO, LOGA
        if (!empty($result)) {
            //SE O PERFIL FOI IGUAL A 1, USUÁRIO NORMAL
            if ($ver['perfil'] == 1) {
                //INICIA SESSÃO
                session_start();
                //PEGA O NOME DE LOGIN DO USUÁRIO
                $_SESSION['Usuario'] = $n;
                //PEGA  O NOME DE CADASTRO DO USUÁRIO
                $_SESSION['nome']=$nomeUsr['nome'];
                //PEGA O TIPO DE USUÁRIO (ADM/USR)
                $_SESSION['perfil']=$ver['perfil'];
                //PEGA O ID DO USUÁRIO
                $_SESSION['id'] = $id['id'];
                //REDIMENSIONA PARA PÁGINA INICIAL DE USUÁRIO
                echo "<script>
        window.location='http://localhost/greensys/index.php';
        </script>";
            }
            //SE O PERFIL FOR IGUAL A ZERO, ADMINISTRADOR
            else if ($ver['perfil'] == 0) {
                //INICIA SESSÃO
                session_start();
                //PEGA O NOME DO ADMIN
                $_SESSION['Usuario'] = $n;
                 //PEGA O TIPO DE USUÁRIO (ADM/USR)
                $_SESSION['perfil']=$ver['perfil'];
                //PEGA A SENHA DO ADMIN
                $_SESSION['id'] = $id['id'];
                //REDIMENSIONA PARA A PÁGINA INICIAL DO ADMIN
                echo "<script>
        window.location='http://localhost/greensys/view/admin/indexAdmin.php';
        </script>";
            }
        }//SE NÃO FOR ENCONTRADO RESULTADO EXIBE UMA MENSGAGEM DE ERRO
        else {
            $msg = "Usuário ou senha incorretos";
            echo "<script>
        window.location='http://localhost/greensys/view/login.php?msg=$msg';
        </script>";
        }
       
      
        ?>
        <!--http://www.phpmais.com/sistema-de-login-e-senha-em-php-o-banco-de-dados/ !-->
    </body>
</html>

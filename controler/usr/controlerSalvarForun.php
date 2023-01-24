<?php require_once '../../acess/forunDAO.php';
include '../../view/user/validalogin.php'; ?>
<!DOCTYPE html>
<!--
PÁGINA QUE RECEBE OS DADOS DE CADASTRO DO FÓRUN E SALVA-SO NO BANCO DE DADOS
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        //SE NÃO ESTIVEREZ VAZIOS OS VALORES DOS CAMPOS TÓPICO E DÚVIDA
        if (!empty($_POST['topico']) and !empty($_POST['duvida'])) {
            //RECEBE OS VALORES DOS MESMOS
            $topico = $_POST['topico'];
            $duvida = $_POST['duvida'];
            //PEGA O ID DO USUÁRIO DA SESSAO
            $autor = $_SESSION['id'];
            //PEGA A DATA DO DIA
            $data = date('Y-m-d');
            //INTANCIA FORUNDTO
            $dados = new ForunDTO();
            //SETA OS RESULTADOS
            $dados->setAutorDuvida($autor);
            $dados->setTopico($topico);
            $dados->setDuvida($duvida);
            $dados->setDataPublicacao($data);
            //INSTANCIA FORUNDAO
            $forun = new ForunDAO();
            //SALVA OS DADOS
            $forun->salvarForun($dados);
            //REDIRECIONA PARA A PÁGINA ANTERIOR E INFORMA QUE A DÚVIDA FOI ADCIONADA
            $msg = "Dúvida postada!";
            echo"<script>window.location='http://localhost/greensys/view/user/criarForun.php?a=$msg'</script>";
        }//SE ALGUM CAMPO NÃO ESTIVER PREENCHIDO PEDE PARA QUE SEJA PREENCHIDO
        else {
            $msg = "Preencha todos os campos, por favor ";
            echo"<script>window.location='http://localhost/greensys/view/user/criarForun.php?a=$msg'</script>";
        }
        ?>
    </body>
</html>

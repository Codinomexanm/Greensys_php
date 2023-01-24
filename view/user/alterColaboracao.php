<?php
require_once '../../acess/residuosDAO.php';
include 'validalogin.php';
include 'verificaPerfilUsr.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Alterar Senha</title>
        <link rel="stylesheet" type="text/css" href="../../css/conteudo.css">
    </head>
    <!--    CABEÇALHO-->
    <header>
        <h1><center>Greensys</center></h1>
        <hr>
    </header>
    <body>
        <form  action="" method="post">
            <center>

                <?php
                //PEGA O ID DO USUARIO DA SESSAO
                $id = $_SESSION['id'];
                //INSTANCIA RESIDUOSDAO
                $colaboracao = new residuosDAO();
                //CHAMA A FUNCAO DE VERIFICAR SE O USUARIO ESTA COLABORANDO E ARMAZENA EM $RESUTADO
                $resultado = $colaboracao->listarColaboracao($id);
                //SE NAO ESTIVER VAZIA $RESUTADO
                if (!empty($resultado)) {
                    //EXIBE OS DADOS
                    echo 'Atualmente você esta cadastrado como:<br><br>';
                    foreach ($resultado as $v) {
                        echo $v['acao'] . '      De Resíduo        ' . $v['tipoRes'] . '<br>';
                    }
                    //EXIBE A OPÇÃO DE DESFAZER A COLABORAÇÃO
                    echo '<br><a href="?i=' . $v['id_usr'] . '""><font color="red">Desfazer Colaboração</a></font><br>';
                }//SE NÃO HÁ DADOS EM $RESUTADO, EXIBE UMA MENSAGEN 
                else {
                    echo 'pareçe que você não está cadastrado como como colaborador, cadastre-se acessado o menu de cadastro, caso queira ajudar.';
                }
                ?>
            </center>
        </form>
        <hr>
        <?php
        if (!empty($_GET['i'])) {
            $id = $_GET['i'];
            $colaboracao->desfazerColaboracao($id);
            $msg = "alterações realizadas";
            echo "<script>
       window.location='http://localhost/greensys/view/user/configuracoesAvancadas.php?m4=$msg';
       </script>";
        }
        ?>

    </body>
</html>

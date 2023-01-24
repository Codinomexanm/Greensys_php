<?php
require_once '../../acess/usuarioDAO.php';
include 'validalogin.php'; 
include 'verificaPerfilUsr.php';
?>
<!DOCTYPE html>
<!--ALTERAR ESTADO-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Alterar dados-estado e cidade</title>
        <link rel="stylesheet" type="text/css" href="../../css/conteudo.css">
        <!--            CHAMA A LIVRARIA JQUERY-->
        <script src="../../js/jquery.js"></script>
        <script>
            //FUNÇÃO PARA BUSCAR CIDADES NO BD
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
    <!--    CABEÇALHO-->
    <header>
        <h1><center>Greensys</center></h1>
        <hr>
    </header>
    <body>
    <center>
<?PHP
$id=$_SESSION['id'];
$cidade=new UsuarioDAO();
$r=$cidade->listarNomeEstCid($id);
foreach ($r as $v){
echo 'Estado Atual: '.$v['nome'];
echo '<br>';
echo 'cidade Atual: '.$v['nomecidade'];
}
?>
        <hr>Altere aqui Sua Localização
    </center>
        <form name="form1" action="" method="post"><center>
                <table class="aluno">

                    <tr>
                        <td>
                            Estado:   
                        </td>
                        <td>
                            <select  name="uf" id="estado" onchange="buscar_cidades()">
                                <?php
                                //fazer uma lista de opções buscadas do banco de dados para jogar opções aqui. 
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
                        <td>Endereço: </td>
                        <td><input type="text" name="endereco"></td>
                    </tr>
                </table>
                <br><br>
                <input type="submit" value="alterar" class="env">
                <br><br>
            </center>
        </form>

        <?php
        echo '<hr>';
        //SE NÃO ESTIVER VAZIA A UF E A CIDADE E O ENDERECO
        if (!empty($_POST['uf']) || !empty($_POST['cidade']) || !empty($_POST['endereco'])) {
            //RECEBE A UF
            echo $est = $_POST['uf'];
            echo '<br>';
            //RECEBE A CIDADE
            echo $cid = $_POST['cidade'];
            //RECEBE O ENDERECO
            echo $end = $_POST['endereco'];
            //PEGA O ID DO USR
            echo $id = $_SESSION['id'];
            //INSTACIA USUARIODAO
            $us = new UsuarioDAO();
            //ALTERA DADOS
            $us->alterarEstadoCidade($est, $cid, $end, $id);
            //REDIMENSIONA PARA A PÁGINA ANTERIOR
            $msg = "Dados alterados com sucesso";
            echo "<script>
        window.location='http://localhost/greensys/view/user/configuracoesAvancadas.php?m3=$msg';
        </script>";
        }//SE ALGUM CAMPO ESTIVER VAZIO, EXIBE MENSAGEM DE ERRO 
        else {
            echo '<center>Todos os campos devem ser preenchidos para que a alteração seja efetuada</center>';
        }
        ?>



    </body>
</html>

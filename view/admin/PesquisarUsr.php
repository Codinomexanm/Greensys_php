<?php
require_once '../../acess/adminiDAO.php';
include '../../view/user/validalogin.php';
 include './verificaPerfilAdm.php';
?>
<!DOCTYPE html>
<!--PÁGINA DE PESQUISA DE USUÁRIOS-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Grennsys-pesquisar usuários</title>
        <link rel="stylesheet" type="text/css" href="../../css/conteudo.css">
    </head>
    <body>

        <!--        SECTION, APRESENTA OS RESULTADOS-->
        <section>
            <center>
                <h3>Pesquisar por</h3>
                <form name="formPesqu" action="" method="post">
                    Nome:<input type="radio" name="valor" value="nome"> 
                    ID: <input type="radio" name="valor" value="id">
                    login: <input type="radio" name="valor" value="login">
                    <br><br>
                    <input type="text" size="30px" name="pesquisa">
                    <br>
                    <input type="submit" value="Pesquisar" class="pesquisar">

                </form>
           <?php
                    if (isset($_POST['pesquisa']) and isset($_POST['valor'])) {

                        $pesq = $_POST['pesquisa'];
                        $val = $_POST['valor'];
                        $lista = new AdminiDAO;
                        $listagem = $lista->pesquisarPorPar($pesq, $val);
                        // print_r($listagem);
                        if (empty($listagem)) {
                            echo 'não foram encontrados resultados';
                        }
                        echo'     <h3>Resultados</h3>
                <table class="aluno">
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Idade</th>
                    <th>Sexo</th>
                    <th>Tipo de Pessoa</th>
                    <th>Número de identificação</th>
                    <th>Login</th>
                    <th>Email</th>
                   <th>Telefone</th>
                    <th>Estado</th>
                    <th>Cidade</th>
                    <th>Endereço</th>
                    <th>Excluir</th>';
                        foreach ($listagem as $campo) {
                            echo '<tr>';
                            echo '<td>' . $campo['id'] . '</td>';
                            echo '<td>' . $campo['nome'] . '</td>';
                            if (!empty($campo['dataNasc'])) {
                                echo '<td>' . $lista->obterIdade($campo['dataNasc']) . '</td>';
                            } else {

                                echo '<td>Null</td>';
                            }
                            echo '<td>' . $campo['sexo'] . '</td>';
                            echo '<td>' . $campo['tipoPessoa'] . '</td>';
                            echo '<td>' . $campo['numpessoa'] . '</td>';
                            echo '<td>' . $campo['login'] . '</td>';
                            echo '<td>' . $campo['email1'] . '</td>';
                          
                            echo '<td>' . $campo['telefone1'] . '</td>';
                           
                            echo '<td>' . $campo['estado'] . '</td>';
                            echo '<td>' . $campo['nomecidade'] . '</td>';
                            echo '<td>' . $campo['endereco'] . '</td>';
                            echo "<td><a href='../../controler/adm/controlerDeletarUsr.php?idUsr={$campo['id']}'>Excluir</a></td>";
                            echo '</tr>';
                        }
                    } else
                        echo 'escolha uma opção de pesquisa';
                    ?> 
                </table>
            </center>
        </section>
    </body>
</html>

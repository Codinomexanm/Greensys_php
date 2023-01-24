<?php
require_once '../../acess/adminiDAO.php';
include '../../view/user/validalogin.php';
 include './verificaPerfilAdm.php';
 ?>
<!DOCTYPE html>
<!--LISTAR OS USUÁRIIOS-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Greensys-listar usuários</title>
        <link rel="stylesheet" type="text/css" href="../../css/conteudo.css">
        <script>
	    function confirmar(id){
	      var resposta= confirm("deseja mesmo excluir?");
	    if (resposta == true){
		window.location.href = "../../controler/adm/controlerDeletarUsr.php?idUsr="+id;
	    }
	    }
	</script>
    </head>
    <body>
        <!--        SESSÃO, APRESENTA OS RESULTADOS-->
        <section>
            <center>
                <h3>Resultados</h3>
                <hr>
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
                    <th>Excluir</th>


                    <?php
                    //CRIA UMA INSTÂNCIA DO AOBJETO ADMINDAO
                    $lista = new AdminiDAO;
                    //LISTA OS RESUTLTADOS, ESTES VEM EM UM ARRAY E O FOREACH VARRE-O
                    $listagem = $lista->listarUsr();
                    //print_r($listagem);
                    foreach ($listagem as $campo) {
                        echo '<tr>';
                        echo '<td>' . $campo['id'] . '</td>';
                        echo '<td>' . $campo['nome'] . '</td>';
                        //SE O CAMPO DATA DE NASCIMENTO NÃO ESTIVER VÁZIO EXIBE A IDADE, SENAO EXIBE COMO NULO
                        if (!empty($campo['dataNasc'])and $campo['dataNasc']!='nulo') {
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
                        echo "<td><a href='javascript:func()' onClick='confirmar(".$campo['id'].");'>Excluir</a></td>";
                        echo '</tr>';
                    }
                    ?> 
                </table>
            </center>
        </section>

    </body>
</html>

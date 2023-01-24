<?php
/* inclui o arquivo validalogin, que verifica se existe uma sessão
 * caso não exista o usuário é redimensionado para a tela de login!
 */
include '../../view/user/validalogin.php';
include './verificaPerfilAdm.php';
require_once '../../acess/sugestaoDAO.php';


require_once '../../acess/pontosDeColetaDAO.php';
//include '../.././view/user/validalogin.php';
?>
<!DOCTYPE html>
<!--
página de cadastro de pontos de coleta

-->

<!-- 
USUÁRIO CADASTRA UM POSSÍVEL PONTO DE COLETA E O ADMIN VERIFICA A AUTENTICIDADE DE LOCAL PARA DEPOIS DEPOIS LIBERAR 
PARA VISUALIZAÇÃO DO SISTEMA
    QUANTO A PESQUISA PODE SER:
A)-PESQUISA POR BASE NOS DADOS DO USUÁRIO
B)-PESQUISA APURADA

*CRIAR UMA FUNÇÃO DE ENVIO DE MENSAGENS NO SISTEMA ENTRE  USUÁRIOS PARA QUE ELES POSSAM SE COMUNICAR 
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Greensys-Procurar Companheiros</title>
        <link rel="stylesheet" type="text/css" href="../../css/conteudo.css">
        <script>
	    function confirmar(id){
	      var resposta= confirm("deseja mesmo excluir?");
	    if (resposta == true){
		window.location.href = "http://localhost/greensys/controler/adm/controlerDeletarPtcol.php?i="+id;
	    }
	    }
	</script>
    </head>
    <body>
        <section>

            <center>
                <h3>Pontos de Coleta</h3>
                <hr>
                <table class="aluno">
                <?php
                echo (empty($_GET['i'])) ? '' : $_GET['i'];
                $result = new PontosDeColetaDAO();
                $lista = $result->buscarPtCol();
                if (!empty($lista)) {
                    echo '<th>Local</th>';
                    echo '<th>Estado</th>';
                    echo '<th>Cidade</th>';
                    echo ' <th>Telefone para<br> contato</th>';
                    echo '   <th>tipo de resíduo</th>';
                    echo ' <th>Nome do<br> estabelecimento</th>';
                    echo '<th>Excluir</th>';
                    echo '<tr>';
                    foreach ($lista as $v) {
                        echo "<td>" . $v['local'] . "</td>";
                        echo "<td>" . $v['estado'] . "</td>";
                        echo "<td>" . $v['nomecidade'] . "</td>";
                        echo "<td>" . $v['telefone'] . "</td>";
                        echo "<td>" . $v['tipoRes'] . "</td>";
                        echo "<td>" . $v['nomeEstab'] . "</td>";
                        echo "<td><a href='javascript:func()' onClick='confirmar(".$v['idPtCol'].");'>Excluir</a></td>";

                        echo "</tr>";
                    }
                } else {
                    echo 'nada encontrado!';
                }
                ?>
                </table>
            </center>
        </section>
    </body>
</html>


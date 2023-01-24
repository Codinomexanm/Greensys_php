<?php
include '../../view/user/validalogin.php';
include './verificaPerfilAdm.php';
require_once '../../acess/forunDAO.php';
?>
<!DOCTYPE html>
<html>
    <!-- PÁGINA PRINCIPAL DE FÓRUNS
    AQUI SÃO EXIBIDAS AS MENSAGENS E RESPOSTAS DOS FÓRUNS-->
    <head>
        <meta charset="UTF-8">
        <title>Greensys-Fóruns</title>
        <link rel="stylesheet" type="text/css" href="../../css/conteudo.css">
        <script>
	    function confirmar(id){
	      var resposta= confirm("deseja mesmo excluir?");
	    if (resposta == true){
		window.location.href = "../../controler/adm/controlerExcluirForun.php?i="+id;
	    }
	    }
	</script>
    </head>
    <body>
        <!-- EXIBIÇÃO DE RESUTADOS-->
        <section>
            <?php
            $tempo = date('Y-m-d H:i:s');
            //ESTA VARIÁEL RECEBE A DATA ATUAL
            ?>
            <div align='center'>

                <table class="alunoAp" width="900px">
                    <?php
                    //SE A VARIAVEL $_GET['I'] NÃO ESTIVER VAZIA 
                    if (!empty($_GET['i'])) {
                        $idFor = $_GET['i'];
                        //INSTANCIA FORUNDAO
                        $foruns = new ForunDAO();
                        //PESQUISA O FORUN PELO ID INSERIDO EM GET
                        $lista = $foruns->listarForunsAtuais($idFor);
                        //EXIBE OS RESULTADOS
                        echo '<tr>';
                        foreach ($lista as $v) {
                            echo "<center><h3>" . $v['topico'] . "</h3></center>";
                            echo "<th>Postado por:" . $v['nome'] . "</th><tr><td> Dúvida: " . $v['duvida'] . '</td></tr>';
                            //echo "<tr><td><a href='../../controler/adm/controlerExcluirForun.php?i=" . $v['idForun'] . "'>Excluir fórun</a></td></tr> ";
                            echo "<tr><td><a href='javascript:func()' onClick='confirmar(".$v['idForun'].");'>Excluir</a></td></tr>";
                            ////criar um link que envie  id da página e o id do artido
                            //id do artigo para excluir o mesmo e o id da página para rerornar a ela
                        }
                        echo '<th>Respostas:</th>';
                        $res = $foruns->listarRespostas($idFor);
                        //EXIBE AS RESOSTAS
                        foreach ($res as $val) {
                            echo '<tr><td>Resposta postada por:<b> ' . $val['nome'] . '</td></tr>';
                            echo '<tr><td>' . $val['resposta'] . '</td></tr>';
                            echo "<tr><td><a href='../../controler/adm/controlerExcluirRespForum.php"
                            . "?i=" . $val['idResp'] . "&j=$idFor '>Excluir resposta</a></td>";
                            echo '</tr>';
                        }
                    }
                    ?>
                </table>
            </div>
        </section>

    </body>
</html>

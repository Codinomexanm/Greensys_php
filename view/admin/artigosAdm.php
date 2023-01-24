<?php
 
/* inclui o arquivo validalogin, que verifica se existe uma sessão
 * caso não exista o usuário é redimensionado para a tela de login!
 */
include '../../view/user/validalogin.php';
 include './verificaPerfilAdm.php';
//REQURER PONTOSDECOLETADAO
require_once '../../acess/artigosDAO.php';
?>
<!DOCTYPE html>
<!--
PÁGINA DE BUSCA FILTRADA POR PONTOS DE COLETA, A APLICAÇÃO NECESSITA DE PREENCHIMENTO DE FORMULARIO

-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Greensys-Artigos</title>
        <link rel="stylesheet" type="text/css" href="../../css/conteudo.css">
        <script>
	    function confirmar(id){
	      var resposta= confirm("deseja mesmo excluir?");
	    if (resposta == true){
		window.location.href = "../../controler/adm/controlerExcluirArtigo.php?i="+id;
	    }
	    }
	</script>
    </head>
    <body>
        <section>

            <div align="center">
                <h3>Procurar Artigos</h3>
            </div>
            <div align='right'>
                <form name="formPesquisa" action="" method="post">
                    Pesquisar por:

                    <input type="text" name="pesquisa" onkeyup="this.value = this.value.replace(/[''çÇáÁàÀÂâéèÊêÉÈíìÍÌóòÓÒúùÚÙñÑ~@&]/g, '');">
                    <input  type="submit" value="Pesquisar" class="pesquisar">&nbsp;

                    </div>
                    <hr>
                </form>
                <div align='center'>
                    <?php
                    //SE NÃO ESTIVER VÁZIO $_POST['PESQUISA']
                    if (!empty($_POST['pesquisa'])) {
                        echo 'Resultados';
                        //$PESQU RECEBE O SEU VALOR
                        $pesqu = $_POST['pesquisa'];
                        //INTANCIA ARTIGODAO
                        $artigo = new artigosDAO();
                        //CHAMA A FUNÇÃO DE BUSC POR PARAETROS
                        $resutado = $artigo->pesquisarArtigos($pesqu);
                        foreach ($resutado as $v) {
                            //APRESENTA OS RESULTADOS
                            echo '<br><a href="artigosAdm.php?i=' . $v['idArtigo'] . '">' . $v['titulo'] . '</a>';
                        }
                    }
                    ?>
                    <?php
                    //SE A VARIAVEL $_GET['I'] ESTIVER VAZIA
                    if (!empty($_GET['i'])) {
                        //$ID RECEBE O SEU VALOR
                        $id = $_GET['i'];
                        //INSTANCIA ARTIGOSDAO
                        $pesquisa = new artigosDAO();
                        //CHAMA A FUNCAO VISUALIZARARTIGOS
                        $r = $pesquisa->visualizarArtigos($id);
                        //EXIBE RESULTADOS
                        foreach ($r as $v) {
                            echo '<center><h3>' . $v['titulo'].'</h3></center>';
                            echo '<div align="left">';
                            echo 'Escrito por: ' . $v['nome'].'<br>';
                            echo 'Em: ' . $pesquisa->converterData($v['dataPub']).'<br><br>';
                            echo $v['texto'];
                           //parte de excluir artigp
                          /* echo "<a href='../../controler/adm/controlerExcluirArtigo.php?i=" . $v['idArtigo'] . "'>"
                                        . "Excluir artigo</a>"; */
                                      echo "<a href='javascript:func()' onClick='confirmar(".$v['idArtigo'].");'>";
                                      echo 'Excluir Artigo</a>';
                        }
                        echo '</tr>';
                        echo '</table>';
                        echo '<h4>Respostas:</h4><hr>';
                        $res = $pesquisa->listarRespostas($id);

                        //EXIBE AS RESOSTAS
                        foreach ($res as $val) {
                            echo 'Resposta postada por:<b> ' . $val['nome'] . '</b>';
                            if ($val['idAutor'] == $_SESSION['id']) {
                                //arrumar funçao
                                echo "<br><a href='../../controler"
                                . "/usr/controlerExcluirComentArt.php?i=" . $val['idResp'] . "&j=$id'>**Excluir resposta**</a>";
                            }
                            echo '<br>' . $val['resposta'];
                            echo '<hr>';
                        }
                    }
                    ?>
                </div>          
        </section>
    </body>
</html>

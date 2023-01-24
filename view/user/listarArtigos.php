<?php
/* inclui o arquivo validalogin, que verifica se existe uma sessão
 * caso não exista o usuário é redimensionado para a tela de login!
 */
//REQURER ARTIGOSDAO
require_once '../../acess/artigosDAO.php';
include './validalogin.php';
include './verificaPerfilUsr.php';
?>
<!DOCTYPE html>
<!--
PÁGINA DE BUSCA FILTRADA POR ARTIGOS
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
		window.location.href = "../../controler/usr/controlerExcluirArtigo.php?i="+id;
	    }
	    }
	</script>
    </head>
    <body>
        <section>

            <div align="center">
                <h3>Procurar Artigos</h3>
                <hr>
            </div>
            <div class="divPesquisar" align="right">
                <form name="formPesquisa" action="" method="post">
                    <span>Pesquisar</span>
                    <input type="text" name="pesquisa" onkeyup="this.value = this.value.replace(/[''çÇáÁàÀÂâéèÊêÉÈíìÍÌóòÓÒúùÚÙñÑ~@&]/g, '');">
                    <input  type="submit" value="pesquisar" class="pesquisar" >

                    </div>
                    <hr>
                </form>
                                <div align='center'>

                    <?php
                    //SE NÃO ESTIVER VÁZIO $_POST['PESQUISA']
                    if (!empty($_POST['pesquisa'])) {
                        //$PESQU RECEBE O SEU VALOR
                        $pesqu = $_POST['pesquisa'];
                        //INTANCIA ARTIGODAO
                        $artigo = new artigosDAO();
                        //CHAMA A FUNÇÃO DE BUSC POR PARAETROS
                        $resutado = $artigo->pesquisarArtigos($pesqu);
                        foreach ($resutado as $v) {
                            //APRESENTA OS RESULTADOS
                            echo '<br><a href="listarArtigos.php?i=' . $v['idArtigo'] . '">' . $v['titulo'] . '</a>';
                        }if(empty($resutado)){
                            
                        echo 'Não foram encotrados resultados para a sua busca.';
                        echo '<br>';
                        echo 'Colabore, escrevendo um artigo ';
                        echo '<a href="escreverArtigos.php"><font color="green">clicando aqui</font></a>';
                        }
                    }
                    ?>
                    <?php
                    $tempo = date('Y-m-d H:i:s');
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
                            if ($v['id'] == $_SESSION['id']) {
                               // echo "<a href='../../controler/usr/controlerExcluirArtigo.php?i=" . $v['idArtigo'] . "'>"
                                 //       . "**Excluir artigo**</a>";
                                echo "<br><br><a href='javascript:func()' onClick='confirmar(".$v['idArtigo'].");'>Excluir Artigo</a><hr>";
                            }
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
                        //CAMPO DE INSERÇAO DE RESPOSTA
                        echo '<div align="center">';
                        echo '<form method="post" action="">';
                        echo'Digite sua resposta:<br> <textarea name="resposta" cols="50" rows="10"></textarea>';

                        echo '<br><input type="submit" value="publicar" class="enviar">';
                        echo '</form>';
                        echo '</div>';
                        echo '</div>';
                    }//SE NÃO ESTIVER VAZIA $_POST['RESPOSTA']
                    if (!empty($_POST['resposta'])) {
                        //RECEBE A RESPOSTA
                        $resposta = $_POST['resposta'];
                        //RECEBE O ID DO AUTOR DA RESPOSTA
                        $autorRes = $_SESSION['id'];
                        //INTANCIA FORUNDTO
                        $dados = new ArtigosDTO();
                        //SETA OS VALORES 
                        $dados->setAutor($autorRes);
                        $dados->setResposta($resposta);
                        $dados->setDataPub($tempo);
                        $dados->setId($id);
                        //SALVA AS RESPOSTAS
                        $pesquisa->SalvarRespostas($dados);
                        //APLICA VALOR NULO à VARIÁVE $RESPOSTA, POIS CASO O USUÁRIO CLIQUE NO BOTÃO SUBMIT NOVAMENTE
                        //ISSO NÃO ACARRETARA ENVIO DE DADOS DUPLICADOS
                        $resposta = null;
                        //REDIMENSIONA O USUÁRIO PARA A PRÓRPIA PÁGINA, DESSA FORMA A SUA RESPOSTA É CARREGADA E EXIBIDA
                        //'AUTOMATICAMENTE'
                        //arrumar aqui
                        echo"<script>window.location='listarArtigos.php?i=" . $id . "'</script>";
                    }
                    ?>
                       
                </div>          
        </section>
    </body>
</html>

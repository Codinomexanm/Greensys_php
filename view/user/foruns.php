<?php
//REQUER FORUMDAO E INCLUI A PÁGINA DE VALIDAÇÃO DE LOGIN
require_once '../../acess/forunDAO.php';
include './validalogin.php';
include './verificaPerfilUsr.php';
?>
<!DOCTYPE html>
<html>
    <!-- PÁGINA PRINCIPAL DE FÓRUNS
    AQUI SÃO EXIBIDAS AS MENSAGENS E RESPOSTAS DOS FÓRUNS-->
    <head>
        <meta charset="UTF-8">
        <title>Greensys-Fóruns</title>
        <link rel="stylesheet" type="text/css" href="../../css/conteudo.css">
</head>
    <body>
        <!-- EXIBIÇÃO DE RESUTADOS-->
        <section>
            <?php
            $tempo = date('Y-m-d H:i:s');
            //ESTA VARIÁEL RECEBE A DATA ATUAL
            ?>
            <div align='left'>

                <?php
                //SE A VARIAVEL $_GET['I'] NÃO ESTIVER VAZIA 
                if (!empty($_GET['i'])) {
                    $idFor = $_GET['i'];
                    //INSTANCIA FORUNDAO
                    $foruns = new ForunDAO();
                    //PESQUISA O FORUN PELO ID INSERIDO EM GET
                        $lista = $foruns->listarForunsAtuais($idFor);
                    //EXIBE OS RESULTADOS
                    foreach ($lista as $v) {
                        echo "<center><h3>" . $v['topico'] . "</h3></center>";
                        echo "<table width='669px'><th> Dúvida: " . $v['duvida'].'</th>';
                        echo "<tr><td>Postado por: <b>" . $v['nome'] . "</b></td></tr>";
                        if($v['id']==$_SESSION['id']){
                        echo "<tr><td><a href='../../controler/usr/controlerxcluirForun.php?i=". $v['idForun']."'>   **Excluir fórum**</a></td></tr> ";}
echo '</table><hr>';
                    }//tabela aqui
                    $res = $foruns->listarRespostas($idFor);
                    //EXIBE AS RESOSTAS
                    foreach ($res as $val) {
                        
                    echo '<table class="alunoAp" width="669px">';
                        echo '<th>' . $val['nome'] . '</th>';
                        if($val['idAutorResp']==$_SESSION['id']){
                        echo "<tr><td><a href='../../controler/usr/controlerExcluirComent.php?i=". $val['idResp']."&j=$idFor '>Excluir resposta</a></td>";
                       }
                        echo '<tr><td>' . $val['resposta'].'</td></tr>';
                        echo '</table>';
                    }
                    //CAMPO DE INSERÇAO DE RESPOSTA 
                    echo '<form method="post" action="">';
                    echo'<center><br><br>Digite sua resposta:<br> <textarea name="resposta" cols="50" rows="10"></textarea>';

                    echo '<br><input type="submit" value="publicar" ></center>';
                    echo '</form>';
                }
                //SE NÃO ESTIVER VAZIA $_POST['RESPOSTA']
                if (!empty($_POST['resposta'])) {
                    //RECEBE A RESPOSTA
                    $resposta = $_POST['resposta'];
                    //RECEBE O ID DO AUTOR DA RESPOSTA
                    $autorRes = $_SESSION['id'];
                    //INTANCIA FORUNDTO
                    $dados = new ForunDTO();
                    //SETA OS VALORES 
                    $dados->setAutoResposta($autorRes);
                    $dados->setRespostas($resposta);
                    $dados->setId($idFor);
                    $dados->setDataPublicacao($tempo);
                    //SALVA AS RESPOSTAS
                    $foruns->SalvarRespostas($dados);
                    //APLICA VALOR NULO à VARIÁVE $RESPOSTA, POIS CASO O USUÁRIO CLIQUE NO BOTÃO SUBMIT NOVAMENTE
                    //ISSO NÃO ACARRETARA ENVIO DE DADOS DUPLICADOS
                    $resposta = null;
                    //REDIMENSIONA O USUÁRIO PARA A PRÓRPIA PÁGINA, DESSA FORMA A SUA RESPOSTA É CARREGADA E EXIBIDA
                    //'AUTOMATICAMENTE'
                    echo"<script>window.location='foruns.php?i=" . $v['idForun'] . "'</script>";
                }
                ?>
            </div>
        </section>
    </body>
</html>

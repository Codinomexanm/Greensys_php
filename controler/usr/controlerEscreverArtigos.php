<?php
//REQUER ARTIGOSDAO E  INCLUI VALIDALOGIN
require_once '../../acess/artigosDAO.php';
include '../../view/user/validalogin.php';
?>
<!DOCTYPE html>
<!--
CONTROLERESCREVERDADOS 
AQUI RECEBE-SE OS DADOS VINDOS DE ESCREVERARTIGOS, VALIDA-S E SALVA NO BANCO DE DADOS
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        //SE NÃO ESTIVER VAZIO $TITULO E $TEXTO 
        if(!empty($_POST['titulo'])and !empty($_POST['texto'])){
            //RECEBE OS VALORES
        $tit=$_POST['titulo'];
        $txt=$_POST['texto'];
        $autor=$_SESSION['id'];
        $data = date('Y-m-d');
        //INSTACIA ARTIGOSDTO
        $dados=new ArtigosDTO();
        //SETA VALORES
        $dados->setTitulo($tit);
        $dados->setTexto($txt);
        $dados->setAutor($autor);
        $dados->setDataPub($data);
        //INTÂNCIA ARTIGOSDAO
        $artigos=new artigosDAO();
        $artigos->postarArtigo($dados);
        //AO CADASTRAR ENVIA UMA MENSAGE AO USUÁRIO AO MESMO TEMPO QUE O REDIMENSIONA PARA PÁGINA ANTERIOR
        $msg="seu artigo foi publicado com sucesso<br>";
            echo "<script>"
            . "window.location='http://localhost/greensys/view/user/escreverArtigos.php?i=$msg'"
            . "</script>";
        
        }//SE ALGUM CAMPO ESTIVER VAZIO
        else{$msg="preencha todos os campos<br>";
            echo "<script>"
            . "window.location='http://localhost/greensys/view/user/escreverArtigos.php?i=$msg'"
            . "</script>";
        }
        ?>
                
    </body>
</html>

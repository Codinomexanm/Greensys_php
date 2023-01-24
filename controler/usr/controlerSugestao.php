<?php

//REQUER SUGESTAODAO
require_once '../../acess/sugestaoDAO.php';
//INCLUI VALIDALOGIN
include '../../view/user/validalogin.php';
//SE NÃO ESTIVER VAZIA $_POST['SUGESTAO']
if (!empty($_POST['sugestao'])) {
    //PEGA O ID DO REMETETE
    $autor = $_SESSION['id'];
    //PEGA A SUGESTAO
    $sugest = $_POST['sugestao'];
    //PEGA A DATA E A HORA DE ENVIO
    $data=$tempo = date('Y-m-d H:i:s');
    //INSTANCIA SUGESTAODTO
    $dados = new sugestaoDTO();
    //PEGA O ID DO USR E A SUGESTAO
    $dados->setAutor($autor);
    $dados->setSugestao($sugest);
    $dados->setData($data);
    //INSTANCIA SUGESTAODAO
    $sugestao = new sugestaoDAO();
    //ENVIA A SUGESTAO
    $sugestao->postarArtigo($dados);
    //EXIBE UMA MENSAGEN E REDIMENSIONA PARA PÁGINA ANTERIOR
    $msg = "<br>Sugestão Enviada! obrigado<br>";
    echo "<script>"
    . "window.location='http://localhost/greensys/view/user/enviarSugestao.php?i=$msg'"
    . "</script>";
}//SE $_POST['SUGESTAO'] ESTIVER VAZIO 
else {
    //REDIMENSIONA E ENVIA UMA MENSAGENS INFORMANDO O ERRO
    $msg = "<br>O campo está vazio, preencha-o<br>";
    echo "<script>"
    . "window.location='http://localhost/greensys/view/user/enviarSugestao.php?i=$msg'"
    . "</script>";
}
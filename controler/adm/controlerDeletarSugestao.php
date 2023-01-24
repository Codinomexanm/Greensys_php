<?php
require_once '../../acess/sugestaoDAO.php';
if(!empty($_GET['i'])){
    //RECEBER O ID DO PONTO DE COLETA
    $id=$_GET['i'];
    //INSTANCIAR UM OBJETO DA CLASSE SUGESTAODAO
   $sugestao=new sugestaoDAO();
//CHAMAR A FUNÇÃO DE EXCLUIR
   $sugestao->excluirSugestoes($id);
//APÓS EXCLUIR, RETORNAR A PÁGINA ANTERIOR   E ENVIA UMA MENSAGEM
   $msg='excluido, com sucesso!';
echo "<script>";
echo "   window.location='../../view/admin/sugestoes.php?i=$msg'";
echo "</script>";    
    
}
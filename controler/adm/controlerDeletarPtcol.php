<?php
require_once '../../acess/adminiDAO.php';

/* 
SCRIPT PARA DELETAR PONTOS DE COLETA
 */




//SE NÃO ESTIVER VAZIA $_GET['I']
if(!empty($_GET['i'])){
    //RECEBER O ID DO PONTO DE COLETA
    $id=$_GET['i'];
    //INSTANCIAR UM OBJETO DA CLASSE ADMINDAO
   $exPtCol=new AdminiDAO();
//CHAMAR A FUNÇÃO DE EXCLUIR
   $exPtCol->deletarPtcol($id);
//APÓS EXCLUIR, RETORNAR A PÁGINA ANTERIOR   E ENVIA UMA MENSAGEM
   $msg='excluido, com sucesso!';
echo "<script>";
echo "window.location='../../view/admin/listarPtCol.php?i=$msg'";
echo "</script>";    
    
}


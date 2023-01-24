<?php
require_once '../../acess/forunDAO.php';

/* 
SCRIPT PARA DELETAR PONTOS DE COLETA
 */




//SE NÃO ESTIVER VAZIA $_GET['I']
if(!empty($_GET['i'])and !empty($_GET['j'])){
    //RECEBER O ID DO PONTO DE COLETA
     $id=$_GET['i'];
     $valor=$_GET['j'];
    //INSTANCIAR UM OBJETO DA CLASSE FORUNDAO
  $delForun=new ForunDAO();
//CHAMAR A FUNÇÃO DE EXCLUIR
$delForun->deletarResp($id);
//APÓS EXCLUIR, RETORNAR A PÁGINA ANTERIOR   E ENVIA UMA MENSAGEM
   
echo "<script>";
echo "   window.location='../../view/admin/verForunAdm.php?i=".$valor."'";
echo "</script>";
    
}
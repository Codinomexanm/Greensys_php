<?php
require_once '../../acess/artigosDAO.php';

/* 
SCRIPT PARA DELETAR PONTOS DE COLETA
 */




//SE NÃO ESTIVER VAZIA $_GET['I']
if(!empty($_GET['i'])and !empty($_GET['j'])){
    //RECEBER O ID Da resposta
     $id=$_GET['i'];
     $valor=$_GET['j'];
    //INSTANCIAR UM OBJETO DA CLASSE FORUNDAO
  $delArt=new artigosDAO();
//CHAMAR A FUNÇÃO DE EXCLUIR
$delArt->deletarResp($id);  
//APÓS EXCLUIR, RETORNAR A PÁGINA ANTERIOR   E ENVIA UMA MENSAGEM
   
echo "<script>";
echo "   window.location='../../view/user/listarArtigos.php?i=".$valor."'";
echo "</script>";
    
}

<?php
require_once '../../acess/artigosDAO.php';

/* 
SCRIPT PARA DELETAR PONTOS DE COLETA
 */




//SE NÃO ESTIVER VAZIA $_GET['I']
if(!empty($_GET['i'])){
    //RECEBER O ID DO PONTO DE COLETA
     $id=$_GET['i'];
    //INSTANCIAR UM OBJETO DA CLASSE FORUNDAO
  $delArt=new artigosDAO();
//CHAMAR A FUNÇÃO DE EXCLUIR
$delArt->deletarArtigo($id);
//APÓS EXCLUIR, RETORNAR A PÁGINA ANTERIOR   E ENVIA UMA MENSAGEM
   
echo "<script>";
echo "   window.location='../../view/user/todosArtigos.php'";
echo "</script>";
    
}
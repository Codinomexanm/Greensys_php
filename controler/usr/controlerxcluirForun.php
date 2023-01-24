<?php
require_once '../../acess/forunDAO.php';

/* 
SCRIPT PARA DELETAR PONTOS DE COLETA
 */




//SE NÃO ESTIVER VAZIA $_GET['I']
if(!empty($_GET['i'])){
    //RECEBER O ID DO PONTO DE COLETA
    $id=$_GET['i'];
    //INSTANCIAR UM OBJETO DA CLASSE FORUNDAO
  $delForun=new ForunDAO();
//CHAMAR A FUNÇÃO DE EXCLUIR
$delForun->deletarForun($id);
//APÓS EXCLUIR, RETORNAR A PÁGINA ANTERIOR   E ENVIA UMA MENSAGEM
   
echo "<script>";
echo "   window.location='../../view/user/todosForuns.php";
echo "</script>";
}
<?php
require_once '../../acess/adminiDAO.php';
//FUNÇÃO PARA DELETAR USUÁRIO
//RECEBE O ID DO USUÁRIO
$id=$_GET['idUsr'];
//INSTÂNCIA UM OBJETO 
$del=new AdminiDAO();
//CHAMA O MÉTODO PARA DELETAR
$del->deletarUsr($id);
//REDIMENSIONA PARA A PÁGINA DE LISTA
echo "<script>";
echo "   window.location='../../view/admin/listarusr.php'";
echo "</script>";

?>
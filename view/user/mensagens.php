<?php 
include '../../view/user/validalogin.php';
require_once '../../acess/mensagensDAO.php';
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
        <?php
        //SE NÃO ESTIVER VAZIA $_GET['I']
       if(!empty($_GET['i'])){
           //RECEBE O SEU VALOR EM $RECEPTOR
           $receptor=$_GET['i'];
           //RECEBE O ID DO EMISSOR
           $emisor=$_SESSION['id'];
           echo '<form  action="" method="post">';
           echo 'Mensagem:';
           echo '<br>';
           echo '<textarea name="mensagem" cols="70" rows="10"></textarea>';
           echo '<br>';
           echo '<input type="submit" value="enviar mensagem">';
       echo '</form>';
       //RECEBE A MENSAGEM EM $MENSAGEM
       if(!empty($_POST['mensagem'])){
       $mensagem=$_POST['mensagem'];
       //ARMAZENA A HORA DE RECEPCAO
       $tempo = date('Y-m-d H:i:s');
//INSTANCIA MENSAGENSDTO
$msm=new MensagensDTO();

//SETA OS VALORES DE EMISSOR,RECEPTOR,MENSAGEM,HORA
  $msm->setEmisor($emisor);
  $msm->setReceptor($receptor);
  $msm->setHora($tempo);
  $msm->setMensagen($mensagem);
//INTANCIA MENSAGENSDAO
$msg=new MensagensDAO();
//SALVA A MENSAGEM
$msg->enviarMensagem($msm);
echo 'Mensagem enviada';
       }
       }
        ?>
    </body>
</html>

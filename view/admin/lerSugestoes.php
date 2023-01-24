<?php 
include '../../view/user/validalogin.php';
 include './verificaPerfilAdm.php';
 require_once '../../acess/sugestaoDAO.php';
require_once '../../acess/sugestaoDAO.php';?>
<!DOCTYPE html>
<!---->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="../../css/conteudo.css">
    </head>
    <body>
    <center>
       
                <?php
                if(!empty($_GET['i'])){
                        $id=$_GET['i'];
   $sugestao=new sugestaoDAO();
            $retorno=$sugestao->lerSugestoes($id);
            //print_r($retorno);
            echo '<table class="aluno">';
            
            echo ' <th>Enviado por</th>'; 
            echo ' <th>Data</th>';   
            
            echo '<tr>';
            foreach ($retorno as $v) {
                echo "<td>".$v['nome']."</td>";
                echo "<td>".$v['hora']."</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td colspan='2'>".$v['sugestao']."</td>";
                echo "</tr>";
            }  
            echo '</table>';
            echo '<a href="../../view/admin/sugestoes.php">Voltar</a>';
            echo '<br>';
            echo "<A href='http://localhost/greensys/controler/adm/controlerDeletarSugestao.php?i=".$v['idSugestao']."'>Excluir</A>";
                }  else {
                    echo 'Não há suegstões';    
                }
                
                ?>
          
    </center>
    
    </body>
</html>

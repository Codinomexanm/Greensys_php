<?php
include '../../view/user/validalogin.php';
include './verificaPerfilAdm.php';
require_once '../../acess/sugestaoDAO.php';
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
        <link rel="stylesheet" type="text/css" href="../../css/conteudo.css">
    </head>
    <body>
        <div align="center">
            <h3>Todas os sugestões</h3>
            <hr>
        </div>
        <div align='center'>
            <br><br><br><br>
            <center>
                <?php
                $sugestao = new sugestaoDAO();
                $retorno = $sugestao->listarSugestoes();



                if (!empty($retorno)) {
                    echo '<table class="aluno">';
                    echo '<th>Enviado Por</th>';
                    echo '<th>Data</th>';
                    echo '<th>Ler</th>';
                    echo '<th>Excluir</th>';
                    echo '<tr>';
                    foreach ($retorno as $v) {
                        echo "<td>" . $v['nome'] . "</td>";
                        echo "<td>" . $v['hora'] . "</td>";
                        echo "<td><A href='http://localhost/greensys/view/admin/lerSugestoes.php?i=" . $v['idSugestao'] . "'>Ler</A></td>";
                        echo "<td><A href='http://localhost/greensys/controler/adm/controlerDeletarSugestao.php?i=" . $v['idSugestao'] . "'>Excluir</A></td>";
                        echo "</tr>";
                    }
                } else {
                    echo 'Não há suegstões =,(';
                }
                ?>
                </table>
                <?php echo (empty($_GET['i'])) ? '' : $_GET['i']; ?>
            </center>
    </body>
</html>

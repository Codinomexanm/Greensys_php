<?php
/* inclui o arquivo validalogin, que verifica se existe uma sessão
 * caso não exista o usuário é redimensionado para a tela de login!
 */
include '../../view/user/validalogin.php';
include './verificaPerfilAdm.php';
require_once '../../acess/residuosDAO.php';
?><!DOCTYPE html>
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
            <h3>Todos os colaboradores</h3>
            <hr>
        </div>
        <div align='center'>
            <br><br><br><br>
            <?php
            $msg = "";
            //SE OS CAMPOS DO FORMULARIO NAO ESTIVEREM VAZIOS,
            //INSTACIA RESIDUOSDAO
            $lista = new residuosDAO();
            //CHAMA A FUNCAO DE BUSCA E ARMAZENA O RETORNO EM $RESULT
            $result = $lista->listarColaboradores();
            //SE NÃO ESTIVER VAZIA A VARIAVEL $RESULT
            if (!empty($result)) {
                echo '
            <h3>Resutados</h3><hr>';
                //EXIBE OS CAMPOS EM FORMA TABULADA
                echo '<table class="aluno">';
                echo '<th>Nome</th>';
                echo '<th>Ação</th>';
                echo '<th>Tipo de Residuo</th>';
                echo '<th>Email</th>';
                echo '<th>Telefone</th>';
                echo '<tr>';

                foreach ($result as $v) {
                    echo '<td>' . $v['nome'] . '</td>';
                    echo '<td>' . $v['acao'] . '</td>';
                    echo '<td>' . $v['tipoRes'] . '</td>';
                    echo '<td>' . $v['email1'] . '</td>';
                    echo '<td>' . $v['telefone1'] . '</td>';
                    echo '<tr>';
                }

                echo '</table>';
            }//SE A VARIAVEL ESTIVER VAZIA, EXIBE UMA MENSAGEM INFORMANDO QUE NAO FORAM ENCONTRADOS RESULTADOS PARA PESUISA
            else {
                $msg = 'Não ha colaboradores no Greensys =,(';
                echo $msg;
            }
            ?>

        </div> 
    </body>
</html>

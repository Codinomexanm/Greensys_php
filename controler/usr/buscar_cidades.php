<?php require_once '../../acess/usuarioDAO.php';?>
<!DOCTYPE html>
<!--
script para realizar busca das cidades no bd, atravéz de interação com ajax
o ajxar armazena uma escolha de estado em uma variável e lança aqui, via get
a variável $uf a recebe e aplica seu valor no método listarCidades(uf)
depois a busca e retornada para o selectbox da página de cadastro
-->
<html>
    <head>
        <title></title>
        <meta charset="UTF-8">
    </head>
    <body>
        
       <select id="cidades" name="cidade"> 
    <?php
            //instancia a classe UsuariDAO
            $lista = new UsuarioDAO();
            //pega a escolha do usuario via ger
            $uf = $_GET['estado'];
            //chama a função
            $list2 = $lista->listarCidades($uf);
            //exibe as opções de acordo com a busca
            print_r($list2);
           
            foreach ($list2 as $cidade) {
                echo "<option value=".$cidade['id'].">".$cidade['nomecidade']."</option>";
         }
         
            ?>
        </select>
            
        
        
    </body>
</html>

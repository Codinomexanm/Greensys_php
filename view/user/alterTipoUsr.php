<?php 
require_once '../../acess/usuarioDAO.php';
include 'validalogin.php';
include 'verificaPerfilUsr.php';
?><!DOCTYPE html>
<!--SCRIPT PARA ALTERAR O TIPO DE USR-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Alterar Dados-tipo de usuário</title>
        <link rel="stylesheet" type="text/css" href="../../css/conteudo.css">
<!--        ESTILO DE FORMATAÇÃO DE CAMPOS PARA AÇÃO COM JAVA SCRIPT-->
            <style type="text/css">
            #pf{
                display:none;
                
            }
            #pj{
                display:none;
                
            }
        </style>
<!--        CHAMA LIVRARIAS JQUERY-->
        <script src="../../js/jquery.js"></script>
        <script src="../../js/jquery.maskedinput.js"></script>
        <script src="../../js/jquery.validate.js" ></script>
        <script src="../../js/jquery-ui.custom.js"></script>
         
        
       <script>
            //FUNÇÃO QUE TRABALHA EM HARMONIA COM O CSS ACIMA
            function pessoa(tipoUsr){
         switch(tipoUsr){
    case 'fisica':
        
                 document.getElementById("pf").style.display="inline";
                 document.getElementById("pj").style.display="none";
                break;
            case 'juridica':
                document.getElementById("pj").style.display="inline";
                 document.getElementById("pf").style.display="none";
            }     
            
            }
            //FUNÇÃO PARA APLICAR MÁSCARAS NOS CAMPOS ESPECÍFICOS
            jQuery(function($){
                $("#cpf1").mask("999.999.999-99");
                $("#dataNasc1").mask("99/99/9999");
                $("#cnpj1").mask("99.999.999/9999-99"); 
            });
          
            
        </script>
    </head>
<!--    CABEÇALHO-->
     <header>
         <h1><center>Greensys</center></h1>
         <hr>
     </header>
    <body>
<!--        FORMULÁRIO DE ALTERAÇÃO DE CAMPOS-->
        <form name="form1" action="" method="post"><center>
        <table>
         <tr>
                        <td>
                            Tipo de Pessoa:
                        </td>
                        <td>
                            <input type="radio" name="tipoUsr" value="fisica" onclick="pessoa(this.value);">Pessoa física

                            <input type="radio" name="tipoUsr" value="juridica" onclick="pessoa(this.value);" >Pessoa jurídica
                        </td>
                    </tr>
                </tabl>
                <table id="pf">
                    <tr>
                        <td>
                            CPF:
                        </td>
                        <td>
                            
                            <input type="text" name="cpf" id="cpf1" maxlength="14" >
                        </td>
                    </tr>

                    <td> Sexo:</td>

                    <td>
                        <select name="sexo"  id="sexo">
                            <option value="masculino">Masculino</option>
                            <option value="feminino">Feminino</option>
                            <option value="outro">Outro</option>
                        </select>
                    </td>

                    </tr>

                    <tr>
                        <td>Data de nascimento:</td>
                        <td> <input type='date'name="data" id="dataNasc1"maxlength=""></td>

                    </tr>
                    </table>
                    <table id="pj">
                    <tr>
                        <td>
                            CNPJ:
                        </td>
                        <td>
                            <input type="text" name="cnpj" id="cnpj1" maxlength="18">
                        </td>
                    </tr>
                    </table>
                
</center>
            <center><br><br><input type="submit" value="pronto" class="env"><br><br></center></form>
        <hr>
        <?php
        //SE NÃO ESTIVER VÁZIO O TIPO DE USUÁRIO
        if(!empty($_POST['tipoUsr'])){
            //$TIPO RECEBE O CONTEÚDO
        $tipo=$_POST['tipoUsr'];
        //SE O TIPO FOR IGUAL A PF
        if($tipo=='fisica' and $_POST['cpf']!=' '){
            //RECEBE CPF
             $num=$_POST['cpf'];
             //RECEBE DATA
        $data=$_POST['data'];
        //RECEBE SEXO
        $sex=$_POST['sexo'];
        }
        //SE FOR IGUAL A JÚRIDICA 
        if($tipo=='juridica' and $_POST['cnpj']!=' '){
            //RECEBE CNPJ
             $num=$_POST['cnpj'];
             $data=$_POST['data'];
        $sex=$_POST['sexo'];
        }
       
       //PEGA O ID DA SESSÃO, LOGO O ID DO USUÁRIO 
        $id=$_SESSION['id'];
        //INSTANCIA USUARIO DAO
       $us=new UsuarioDAO();
       //ALTERA OS CAMPOS
       $us->alterarTipoUsr($tipo, $num, $data, $sex, $id);
       //REDIMENSIONA PARA A PÁGINA ANTERIOR
       $msg="Alterações realizadas  com sucesso";
        echo "<script>
        window.location='http://localhost/greensys/view/user/configuracoesAvancadas.php?m2=$msg';
        </script>";

           
       
        }
        ?>
    </body>
</html>

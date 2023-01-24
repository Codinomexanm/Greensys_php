<?php
/* ALGUMAS FUNÇÕES PHP DESTA PÁGINA NECESSITAM DA CLASSE DE ACESSO USUARIODAO */
require_once '../../acess/usuarioDAO.php';
?>
<!DOCTYPE html>
<html>
    <!--    página de cadastro do usuário-->
    <head>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="../../images/cons.ico">
        <link rel="stylesheet" href="../../css/conteudo.css">

        <title>Greensys-Cadastro de Usuário</title> 
        <!--        APLICA UMA FORMATAÇÃO NULA DE DISPLAY NAS  ID'S PF E PJ
                ISSO AJUDARÁ EM UMA FUNÇÃO JAVA SCRIPT MAIS ABAIXO-->
        <style type="text/css">
            #pf{
                display:none;

            }
            #pj{
                display:none;

            }
        </style>
        <!-- CHAMA AS LIVRARIAS JAVA SCRIPT NECESSÁRIAS PARA A EXECUÇÃO DE ALGUMAS FUNCIONALIDADES DA PÁGINA-->
        <script src="../../js/jquery.js" ></script>
        <script src="../../js/jquery.maskedinput.js"></script>


        <script>
            //FUNÇÃO JQUERY E AJAX PARA BUSCAR ESTADOS NO BANCO DE DADOS E ATRAVÉS DOS MESMOS AS SUAS RESPECTIVAS CIDADES
            function buscar_cidades() {
                var estado = $('#estado').val();
                if (estado) {
                    var url = '../../controler/usr/buscar_cidades.php?estado=' + estado;
                    $.get(url, function(dataReturn) {
                        $('#load_cidades').html(dataReturn);
                    });
                }
            }

//FUNÇÃO PARA EXIBIR CAMPOS DIFERENTES DE CADASTRO, ESSA É A FUNÇÃO QUE ATUA JUNTO COM O PRIMEIRO STYLE DA PÁGINA
            function pessoa(tipoUsr) {
                switch (tipoUsr) {
                    case 'fisica':

                        document.getElementById("pf").style.display = "inline";
                        document.getElementById("pj").style.display = "none";
                        break;
                    case 'juridica':
                        document.getElementById("pj").style.display = "inline";
                        document.getElementById("pf").style.display = "none";
                }

            }


        </script>

        <script type="text/javascript">
            //JQUERY PARA MÁSCARAS NOS CAMPOS ESPECÍFICADOS
            jQuery(function($) {
                $("#cpf").mask("999.999.999-99");
                $("#dataNasc").mask("99/99/9999");
                $("#cnpj").mask("99.999.999/9999-99");
                $("#tel1").mask("(99)9999-9999");

            });
        </script> 
        <script>
//FUNÇÃO QUE INFORMA QUE UM CAMPO DE SENHA NÃO PODE FICAR EM BRANCO
            function regraSenha(senha) {
                var sen = senha;
                if (sen == '') {
                    alert('A senha é obrigatória');
                }

            }
        </script>

        <script>
            //FUNÇÃO QUE FOCA NO PRIMEIRO CAMPO DO FORMULÁRIO ASSM QUE A PÁGINA É CARREGADA
            function foco() {
                document.formCadastro.nome.focus();
            }
        </script>
    </head>
    <body onload="foco();" class="corpoCad">


        <!--        cabeçalho-->
        <header class="cadastro">
        </header>
        <!--        FORMULARIO DE CADASTRO-->
        <div align='center' class="divCad">
            <form name='formCadastro' id='cadastro' action="../../controler/usr/controlerCadastro.php" method="post" class="cad">
                <h3>Informações Básicas</h3>
                <table>
                    <tr> 
                        <td>Nome:</td>
                        <td ><input  type="text" name="nome" id="nomeUsuario" maxlength="50"></td>
                    </tr>

                    <tr>
                        <td>
                            Tipo de Pessoa:
                        </td>
                        <td>
                            <input type="radio" name="tipoUsr" value="fisica" onclick="pessoa(this.value);">Pessoa física

                            <input type="radio" name="tipoUsr" value="juridica" onclick="pessoa(this.value);" >Pessoa jurídica
                        </td>
                    </tr>
                </table>
                <table id="pf">
                    <tr>
                        <td>
                            CPF:
                        </td>
                        <td>

                            <input type="text" name="cpf" id="cpf" maxlength="14" >
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
                        <td> <input type='date'name="data" id="dataNasc"maxlength=""></td>

                    </tr>
                </table>
                <table id="pj">
                    <tr>
                        <td>
                            CNPJ:
                        </td>
                        <td>
                            <input type="text" name="cnpj" id="cnpj" maxlength="18">
                        </td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td>
                            Email para  Login:
                        </td>
                        <td>
                            <input type="email" name="login" id="loginCad">

                        </td>

                    </tr>
                    <tr>
                        <td>
                            Senha: 
                        </td>
                        <td>
                            <input type="password" name="senha" id="senhaCad" onblur="regraSenha(this.value);">
                        </td>
                    </tr>

                </table>
                <h3>Informações de contato</h3>
                <table>
                    <tr>
                        <td>
                            Email para contato:   
                        </td>
                        <td>
                            <input type="email" name="email" id="email1">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            Telefone para contato:   
                        </td>
                        <td>
                            <input type="tel" name="telefone" id="tel1" maxlength="14">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Estado:   
                        </td>
                        <td>
                            <select  name="uf" id="estado" onchange="buscar_cidades()">
                                <?php
                                //fazer uma lista de opções busca-las do banco de dados para jogar opções aqui. 
                                $listar = new UsuarioDAO();
                                $lista = $listar->listarEstados();
                                foreach ($lista as $op) {

                                    echo"<option  value=" . $op['uf'] . ">" . $op['uf'] . "</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Cidade:   
                        </td>
                        <!--                        nessa td serão lançadas as opções(cidades) referentes a escolha do usuário
                                                obs: as opções estão salvas no script buscar_cidades-->
                        <td id="load_cidades" >
                            <select name="cidade">
                                <option>escolha uma opção</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Endereço:   
                        </td>
                        <td>
                            <input type="text" name="endereco" id="endereco">
                        </td>
                    </tr>

                </table>
                <?php echo(empty($_GET['m'])) ? '' :'<font color="red">'. $_GET['m'].'</font>'; ?>
                <hr> 
                <input type="submit" value='cadastrar'id="cadastrar" class="enviar">
            </form>
        </div>
        <!-- RODAPÉ!-->
        <footer class="fotCad">
            <center>
                <p>desenvolvido por:  <span>HORDA SOFTWARES</span></p>
                <a href="../termosDoGreensys.php" target="conteudo">Políticas de uso e privacidade</a>
            </center>    
        </footer>
    </body>
</html>

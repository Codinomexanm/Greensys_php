<?php
/* inclui o arquivo validalogin, que verifica se existe uma sessão
 * caso não exista o usuário é redimensionado para a tela de login!
 */
require_once './acess/forunDAO.php';
require_once './acess/artigosDAO.php';
include './view/user/validalogin.php';
include './view/user/verificaPerfilUsr.php';
?>
<!DOCTYPE html>
<!--
página inicial do sistema, nela apresentam-se algumas funções básicas do sistema

-->
<html>
    <head>
        <meta charset="UTF-8">  
        <title>Página Inicial</title>
            <link rel="shortcut icon" href="images/cons.ico">
            <link rel="stylesheet" type="text/css" href="css/estiloBasico.css">
    </head>
    <body>

        <!--CABEÇALHO!-->
        <header>
            <!--PEQUENO MENEU DE EXIBIÇÃO DE FUNÕES BÁSICAS DE USUÁRIO!-->
            <div class="usr">
                <?php /* EXIBE O NOME DO USUÁRIO DA SESSÃO */echo "Usuário: " . $_SESSION['nome']; ?>
                <?php ECHO '<br>hoje:   '.date('d-m-Y'); ?>
                <hr>
                <br>
                <div class="menuUsr">
                <a href="view/user/alterarDados.php" target="conteudo">Alterar dados</a>
                <hr>
                <a href="controler/sair.php">Sair</a>
                </div>
            </div>
            
        </header>

        <!--        links para as aplicações-->
        <nav>
            <div align='center'>
            <ul class='menu'>
                <li>
                    <p>Artigos</p>
                    <ul>
                        <li><a href='view/user/escreverArtigos.php' target="conteudo">Escrever artigos</a>
                        </li>
                        <li><a href='view/user/listarArtigos.php' target="conteudo">Ler artigos</a>
                        </li>
                        <li> <a href="view/user/todosArtigos.php" target="conteudo">Todos os artigos</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <p>Fóruns</p>
                    <ul>
                        <li><a href='view/user/criarForun.php' target="conteudo">Criar fórum</a>
                        </li>
                        <li><a href='view/user/todosForuns.php' target="conteudo">Todos os fóruns</a>
                        </li>

                    </ul>
                </li>

                <li>
                    <p>Pontos de coleta</p> 
                    <ul>
                        <li> <a href='view/user/cadstrarPtCol.php' target="conteudo">Cadastrar pontos de coleta</a></li>
                        <li>        <a href='view/user/listarPtColUsr.php' target="conteudo">Pesquisar Pontos de coleta</a></li>

                        <li>        <a href='view/user/listarPtColUsrAvanc.php' target="conteudo">Pontos de coleta proxímos a você</a></li>

                    </ul>
                </li>

                <li>
                   <p>Colabore</p> 
                    <ul>

                        <li><a href='view/user/cadstrarResiduos.php' target="conteudo">Cadastre-se como doador ou coletor de algúm tipo de resíduo</a></li>

                        <li>        <a href='view/user/procurarColaboradores.php' target="conteudo">Ache colaboradores</a></li>

                    </ul>
                </li>
            </ul>
        </div>
        </nav>  
        
        <aside>
            <div align='center'>
                <p>Artigos recentes</p>
            
            <?php
            //INTANCIA ARTIGOSDAO
            $artigo = new artigosDAO();
            //CHAMA FUNCAO QUE LISTA FORUNS
            $resutado = $artigo->listarArtigos();
            //APRESENTA RESULTADOS
            echo '<div class="us">';
            foreach ($resutado as $v) {
                $y = 0;
                echo '<br><a target="conteudo" href="view/user/listarArtigos.php?i=' . $v['idArtigo'] . '">' . $v['titulo'] . '</a>';
                $y++;
                echo '<hr width="120px">';
                if ($y == 5) {
                    break;
                }if ($y == 0) {
                    echo 'não há artigos postados até agora';
                }
            }if(empty($resutado)){
                    echo 'não há artigos postados até agora';
                
            }
            echo '</div>';
            ?>
            </div>
            <div align='center'>
                <p> Fóruns recentes</p>
            
            <?php
            //INSTANCIA FORUNDAO
            $forun = new ForunDAO();
            //LISTA FÓRUNS
            $r = $forun->listarForuns();
            echo '<div class="us">';
            //echo 'Posts de hoje:';
            $v=NULL;
            foreach ($r as $v) {
                //SE A DATA FOR IGUAL A DO DIA ATUAL
                if ($v['dataPublicacao'] == date('Y-m-d')) {
                    //$X RECEBE  VALOR 0
                    $x = 0;
                    //LINKA TODOS OS POSTS DO DIA ATUAL
                    echo "<br><a href='view/user/foruns.php?i=". $v['idForun'] . "'target='conteudo'>" . $v['topico'] . "</a>";
                    echo '<hr width="120px">';
                    //ADICIONA +1  A $X EM A CADA NOVO LINK EXIBIDO
                    $x++;
                    //SE $X=5
                    if ($x == 5) {
                        //QUEBRA O CICLO
                        break;
                    }//SE $X FOR IGUAL A 0, EXIBE UMA MENSAGEM
                    }
                        
            }if(($v['dataPublicacao']== date('Y-m-d'))==NULL){
                echo 'Ainda não foram postadas dúvidas hoje';
            }
            /*echo 'Posts mais antigos:<hr>';
            foreach ($r as $v) {
                //AQUI TODOS OS CAMPOS SEGUEM A MESMA LÓGICA ANTERIOR
                //COM O DIFERENCIAL DO DIA QUE AQUI SE APLICA AOS DIAS ANTERIORES
                if ($v['dataPublicacao'] != date('Y-m-d')) {

                    $x = 0;
                    echo "<a href='foruns.php?i=" . $v['idForun'] . "'>" . $v['topico'] . "</a>";
                    $x++;
                    if ($x == 5) {
                        break;
                    }if ($x == 0) {
                        echo 'Ainda não foram postadas notícias hoje';
                    }
                }
            }
            echo '</div>';
            */?>
            </div>

        </aside>
        <iframe name="conteudo" width="100%" height="630px" src="view/greensys.php"></iframe>
       
        <!-- RODAPÉ!-->
        <footer>
            <p>Desenvolvido por:<span> HORDA SOFTWARES</span></p> 
                <a href="view/user/enviarSugestao.php" target="conteudo">Dúvidas ou sugestões</a>
               
                <a href="view/termosDoGreensys.php" target="conteudo">Políticas de uso e privacidade</a>
                
                
        </footer>

    </body>
</html>

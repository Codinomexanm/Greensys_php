<?php
include '../../view/user/validalogin.php';
include './verificaPerfilAdm.php';
?>
<!DOCTYPE html>
<!--PÁGINA INICIAL DE VISUALIZAÇÃO DO ADMINISTRADOR-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Página Inicial-ADMIN</title>
        <link rel="shortcut icon" href="../../images/cons.ico">
        <link rel="stylesheet" type="text/css" href="../../css/estiloBasicoAdm.css">
    </head>
    <body>
        <!--        cabeçalho!-->
        <header>
            <div align="right" class="usr">
                <?php
                echo "Usuário: " . $_SESSION['Usuario'].'   /';
                echo '<a href="../../controler/sair.php">Sair</a>';
                ?>  
            </div>
        </header>
        <!--        links para as aplicações-->
        <nav>
            <div align='center'>
                <ul class='menu'>
                    <li>
                        <p>Usuário</p>
                        <ul>
                            <li><a href='PesquisarUsr.php' target="conteudo">Pesquisar</a>
                            </li>
                            <li><a href='listarusr.php' target="conteudo">Listar</a>
                            </li>
                            <li><a href="../../view/admin/sugestoes.php" target="conteudo">Sugestões</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <p>Pontos de coleta</p>
                        <ul>
                            <li><a href='listarPtCol.php' target="conteudo">Listar pontos de coleta</a>
                            </li>
                            <li><a href="pesquisarPtCol.php" target="conteudo">Pesquisar pontos de coleta</a>
                            </li>

                        </ul>
                    </li>

                    <li>
                        <p>Fóruns</p> 
                        <ul>
                            <li> 
                                <a href="forunsAdm.php" target="conteudo">ver Fóruns</a></li>
                        </ul>
                    </li>

                    <li>
                        <p>Artigos</p> 
                        <ul>

                            <li><a href="verArtigosAdm.php" target="conteudo">Listar artigos</a></li>
                        </ul>
                    </li>
                    <li>
                        <p>Colaboradores</p> 
                        <ul>
                            <li><a href="listarDoadoresColetores.php" target="conteudo">procurar Doadores/coletores</a></li>

                            <li><a href="doadoresColetores.php" target="conteudo">listar Doadores/coletores</a></li>
                        </ul>
                    </li>

                </ul>
            </div>
        </nav>  
        <!--AGREGADOR DE CONTEÚDO!-->
        <section>
            <iframe name="conteudo" width="100%" height="100%" src="../greensys.php"></iframe>
        </section>
        <!--RODAPÉ!-->
        <footer>
            <p>desenvolvido por:  <span>HORDA SOFTWARES</span></p>
            <a href="../termosDoGreensys.php" target="conteudo">Políticas de uso e privacidade</a>
        </footer>
    </body>
</html>

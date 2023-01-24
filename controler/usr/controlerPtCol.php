<?PHP
//REQUER PONTOSCOLETADAO PARA FUNCIONAR CORRETAMENTE
require_once '../../acess/pontosDeColetaDAO.php';
?>
<!DOCTYPE html>
<html>
    <!--
    PAGINA DE CONTROLE DE CADASTRO DOS PONTOS DE COLETA
    !-->
    <head>
        <meta charset="UTF-8">
        <title>Greensys-Procurar Companheiros</title>
    </head>
    <body>
        <?php
//SE OS CAMPOS DO FORMULARIO NAO ESTIVEREM VAZIOS,
        if (!empty($_POST['nome']) and !empty($_POST['local']) and !empty($_POST['uf']) and !empty($_POST['cidade']) and !empty($_POST['opcao']) and !empty($_POST['telefone'])
        ) {
            //RECEBE OS DADOS
            $nome = $_POST['nome'];
            $local = $_POST['local'];
            $estado = $_POST['uf'];
            $cidade = $_POST['cidade'];
            $tipo = $_POST['opcao'];
            $telefone = $_POST['telefone'];
            //INSTANCIA CLASSE PONTOSDECOLETADTO
            $dados = new PontosDeColetaDTO();
//PEGA OS DADOS RECEBIDOS DO FORM
            $dados->setNome($nome);
            $dados->setLocal($local);
            $dados->setEstado($estado);
            $dados->setCidade($cidade);
            $dados->setTipoRes($tipo);
            $dados->setTelefone($telefone);
//INSTANCIA PONTOSDECOLETADAO
            $cadastro = new PontosDeColetaDAO();
//CADASTRA OS DADOS
            $cadastro->cadastrarPtCol($dados);
//REDIMENSIONA PARA A PAGINA DE CADASTRO E INFORMA QUE OCORREU TUDO BEM
            $msg = "Ponto de coleta salvo! =)";
            echo "<script>
        window.location='http://localhost/greensys/view/user/cadstrarPtCol.php?a=$msg';
        </script>";
        }//SE AO MENOS ALGUM CAMPO NÃO ESTIVER PREENCHIDO, 
        else {
            //RETORNA A PAGINA ANTERIOR E PEDE PARA QUE TODOS SEJM CADASTRADOS
            $msg = "Preencha todos os campos, por favor";
            echo "<script>
        window.location='http://localhost/greensys/view/user/cadstrarPtCol.php?a=$msg';
        </script>";
        }
        ?>
    </body>
</html>
<?php

//REQUER A CLASSE RESIDUOS DAO, CLASSE QUE CONTÉM ATRIBUTOS GETS E SETS
require_once '../../acess/residuosDAO.php';
//INCLUI O SCRIPT DE VALIDAÇÃO DE LOGIN, QUE CONTÉM VERIFICAÇÃO DE SESSÃO
include '../../view/user/validalogin.php';

//PRIMEIRO, PEGA O ID DA SESSÃO
$id = $_SESSION['id'];
//VERIFICA SE O CAMPO ACÃO E O CAMPO OPÇÃO NÃO ESTÃO VAZIOS
if (!empty($_POST['acao']) and !empty($_POST['opcao'])) {
    //SE NÃO ESTIVEREM RECEBE O VALOR DA ACAO(DOADOR OU COLETOR)
    $ac = $_POST['acao'];
    //RECEBE O VALOR DA OPÇÃO(TIPOS DE RESÍDUOS)
    $tipo = $_POST['opcao'];
    //INSTANCIA RESIDUSDTO
    $dados = new ResiduosDTO();
    //SETA AÇÃO
    $dados->setAcao($ac);
    //SETA TIPO DE RESIDUO
    $dados->setTipo($tipo);
    //SETA O ID DO USARIO DA SESSAO
    $dados->setIdUsr($id);
//INSTÂNCIA RESIDUOS DAO
    $cadastro = new residuosDAO();
    //CHAMA A FUNÇÃO QUE BUSCA OS CONTATOS DO USUÁRIO. ARMAZENA O VALOR EM $A;
    $a = $cadastro->verificarCadastro($id);
    //VARRE O ARRAY EM BUSCA DE RESUTADOS
    foreach ($a as $v) {
        //ARMAZENA O VALOR DE EMAIL EM $C1
        $c1 = $v['email1'];
        //ARMAZENA O VALOR DO TELEFONE EM $C2
        $c2 = $v['telefone1'];
    }
//SE $C1 E $C2 ESTIVEREM COM VALOR NULO
    if ($c1 == 'nulo' and $c2 == 'nulo') {
        //REDIMENSIONA PARA PÁGINA DE CADASTRO DE RESÍDUOS E ENVIA UMA MENSAGEM INFORMANDO PARA ALTERAR OS DADOS
        $msg = "Sem dados de contato, altere seus dados em configurações da    conta ";
        echo"<script>window.location='http://localhost/greensys/view/user/cadstrarResiduos.php?a=$msg'</script>";
    }//SE PELO MENOS UM DOS CAMPOS ESTIVEREM PREENCHIDOS  
    else {
        //CADASTRA O USUÁRIO COMO COLABORADOR
        $cadastro->cadastraAgentes($dados);
        //REDIMENSIONA PARA PÁGINA ANTERIOR E ENVIA UMA MENSAGEM DE SUCESSO 
        $msg = "Você foi cadastrado com sucesso, continue colaborando com o meio ambiente ";
        echo"<script>window.location='http://localhost/greensys/view/user/cadstrarResiduos.php?a=$msg'</script>";
    }//SE OS CAPOS NÃO ESTIVEREM PREENCHIDOS PEDE PRO USUÁRIO PREENCHE-LOS, OS DOIS
} else {
    $msg = "Selecione os dois campos, por favor";
    echo"<script>window.location='http://localhost/greensys/view/user/cadstrarResiduos.php?a=$msg'</script>";
}
?>


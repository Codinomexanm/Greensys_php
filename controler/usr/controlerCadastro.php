<?PHP
require_once '../../acess/usuarioDAO.php';
session_start();
?>
<!DOCTYPE html>
<!--CONTROLE DE CADASTRO-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title> 
    </head>
    <body>
        <header>
            <h1>Greensys</h1>
            <hr>
        </header>
        <hr>
    <center>  
        <?php
        if (!empty($_POST['nome']) and !empty($_POST['login'])
                and !empty($_POST['tipoUsr'])
                and !empty($_POST['senha']) and !empty($_POST['email'])
                and !empty($_POST['telefone'])
                and !empty($_POST['uf'])
                and !empty($_POST['cidade'])
                and !empty($_POST['endereco'])
        ) {
            //recebe os valores vindos dos form
            $nome = $_POST['nome'];

            $pessoa = $_POST['tipoUsr'];

//se pf vier vazio->num pessoa=pj
            if (empty($_POST['cpf'])) {
                $numpessoa = $_POST['cnpj'];
            } else {
                $numpessoa = $_POST['cpf'];
            }
            if ($numpessoa == $_POST['cnpj']) {
                $sexo = 'indefinido';
            } else {
                $sexo = $_POST['sexo'];
            }

            /* todos os campos devem receber algum valor, mesmo sendo 'nulo'
             * valor 'nulo' != de zero
             * valor=zero ocasiona em erro nas ações com bd
             */
//se os campos não estão vazios, atribui os valores do formulário a eles, senão valor nulo
            (empty($_POST['data'])) ? $data = 'nulo' : $data = $_POST['data'];
            /* (empty($_POST['login'])) ? $login = 'nulo' : */ $login = $_POST['login'];
            (empty($_POST['senha'])) ? $senha = 'nulo' : $senha = $_POST['senha'];
            (empty($_POST['email'])) ? $email = 'nulo' : $email = $_POST['email'];
            (empty($_POST['telefone'])) ? $telefone = 'nulo' : $telefone = $_POST['telefone'];
            (empty($_POST['uf'])) ? $estado = 'nulo' : $estado = $_POST['uf'];
            (empty($_POST['cidade'])) ? $cidade = 'nulo' : $cidade = $_POST['cidade'];
            (empty($_POST['endereco'])) ? $endereco = 'nulo' : $endereco = $_POST['endereco'];



//instancia UsuarioDTO e usa seus metdos set(pegar)
            $usuarioDto = new UsuarioDTO();
            $usuarioDto->setNomeUsuario($nome);
            $usuarioDto->setTipoPessoa($pessoa);
            $usuarioDto->setNumpessoa($numpessoa);
            $usuarioDto->setSexo($sexo);
            $usuarioDto->setDataNasc($data);
            $usuarioDto->setLogin($login);
            $usuarioDto->setEmail1($email);
            $usuarioDto->setTelefone1($telefone);
            $usuarioDto->setEstado($estado);
            $usuarioDto->setCidade($cidade);
            $usuarioDto->setEndereco($endereco);
            $Pass = $usuarioDto->criptografarSenha($senha);
            $usuarioDto->setSenha($Pass);

            // intancia UsuarioDAO
            $usuarioDAO = new UsuarioDAO();
            //VERIFICA SE JA EXISTE ALGUEM CADASTRADO COM ESSE LOGIN
            $usua = $usuarioDAO->verificarExistLogin($login);
            //SE NAO HOUVER, 
            if (empty($usua)) {
                //CADASTRA
                $usuarioDAO->Cadastrar($usuarioDto);
                //REDIMENSIONA PARA A PAGINA DE LOGIN
                $msg2 = "agora você já pode fazer login, seja Bem vindo!<br>";
                echo "<script>
        window.location='http://localhost/greensys/view/login.php?a=$msg2';
        </script>";
            } else {
                //SE EXISTE ALGUEM CADASTRADO COM O LOGIN EXIBE UMA MENSAGEM DE ERRO
                $msg = "já existe um usuário com esse nome de login. Escolha outro!";
                //REDIMENSIONA PARA A PAGINA DE CADASTRO
                echo "<script>
        window.location='http://localhost/greensys/view/user/cadastroUsr.php?m=$msg';
        </script>";
            }
        }//se o nome ou login estão vázios
        else {
            $msg = "Por favor, preencha todos os campos";
            //REDIMENSIONA PARA A PAGINA DE CADASTRO E EXIBE UMA MENSAGEN
            echo "<script>
        window.location='http://localhost/greensys/view/user/cadastroUsr.php?m=$msg';
        </script>";
        }
        ?>
    </center>



</body>
</html>

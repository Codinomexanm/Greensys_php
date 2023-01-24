<?php

require_once 'conexao/conexao.php';

/**
 * Description of adminiDAO
 * essa classe contém todos os métodos da classe  administrador
 *
 * @author diogenes
 */
class AdminiDAO {

    public $pdo = null;

    function __construct() {
        $this->pdo = Conexao::obterConexao();
    }

    //método para listar pontos de coleta 
    public function listarPtCol() {
        try {
            $sql = 'SELECT * FROM pontosColeta';
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function deletarPtcol($idpt) {
        try {

            //SET foreign_key_checks = 0
            $sql = "DELETE  FROM pontosColeta WHERE idPtCol = '$idpt'";
            $consulta = $this->pdo->prepare($sql);
            $consulta->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    //listar todas as informações do usuário, assim como método excluir
    public function listarUsr() {
        try {
            $sql = 'SELECT  usuario.nome, usuario.sexo, usuario.dataNasc, usuario.id,
                usuario.login, usuario.tipoPessoa, usuario.numpessoa, contato.email1,
                contato.telefone1,  contato.estado, tb_cidades.nomecidade, contato.endereco
FROM tb_cidades
JOIN contato
JOIN usuario
ON(contato.cidade=tb_cidades.id AND contato.id_usr=usuario.id)';
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function listarResiduos() {
        try {

            $sql = "SELECT * FROM residuos";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $list = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $list;
        } catch (PDOException $ex) {
            $ex->getMessage();
        }
    }

    public function obterIdade($dataNasc) {
        $data = explode('/', $dataNasc);
        $ano = date("Y");
        $idade = $ano - $data[2];
        return $idade;
    }

    public function deletarUsr($idUsr) {
        try {
            $id = $idUsr;

            $sql2 = "SET foreign_key_checks = 0;DELETE  FROM contato WHERE id_Usr='$id';DELETE  FROM usuario WHERE id = '$id'";
            $consulta2 = $this->pdo->prepare($sql2);
            $consulta2->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function pesquisarPorPar($pesquisa, $valor) {

        try {



            $sql = "SELECT  usuario.nome, usuario.sexo, usuario.dataNasc, usuario.id,
                usuario.login, usuario.tipoPessoa, usuario.numpessoa, contato.email1, 
                contato.telefone1, contato.estado, tb_cidades.nomecidade, contato.endereco
FROM tb_cidades
JOIN contato
JOIN usuario 
ON(contato.cidade=tb_cidades.id AND contato.id_usr=usuario.id";


            switch ($valor) {
                case "nome":
                    $sql = $sql . " AND usuario.nome LIKE '%{$pesquisa}%')";
                    break;
                case "id":
                    $sql = $sql . " AND usuario.id LIKE '%{$pesquisa}%')";
                    break;
                case "login":
                    $sql = $sql . " AND usuario.login LIKE '%{$pesquisa}%')";
                    break;
            }
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();

            $p = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $p;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

}

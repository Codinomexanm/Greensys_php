<?php

require_once 'conexao/conexao.php';
require_once '/opt/lampp/htdocs/greensys/transfer/residuosDTO.php';
/*
  AQUI TEM-SE OS MÉTODOS DE ACESSO DA CLASSE RESIDUO
 */

/**
 * Description of residuosDAO
 *
 * @author diogenes
 */
class residuosDAO {

    public $pdo = null;

    function __construct() {
        $this->pdo = Conexao::obterConexao();
    }

    public function listarTipos() {
        try {


            $sql = "SELECT * FROM tipoResiduo";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $resutado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resutado;
        } catch (PDOException $ex) {
            $ex->getMessage();
        }
    }

    public function verificarCadastro($id) {
        try {


            $sql = "SELECT `email1`, `telefone1` FROM `contato` WHERE id_usr=?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(1, $id);
            $stmt->execute();
            $resutado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resutado;
        } catch (PDOException $ex) {
            $ex->getMessage();
        }
    }

    public function cadastraAgentes(ResiduosDTO $dados) {
        try {


            $ac = $dados->getAcao();
            $tipo = $dados->getTipo();
            $id = $dados->getIdUsr();

            $sql1 = "INSERT INTO residuos VALUES ('$ac','$tipo','','$id')";
            $consulta1 = $this->pdo->prepare($sql1);
            $consulta1->execute();
        } catch (PDOException $ex) {
            $ex->getMessage();
        }
    }

    public function listarAgentes($agente, $estado, $cidade, $tipoLix) {
        try {


            $a = $agente;
            $e = $estado;
            $c = $cidade;
            $t = $tipoLix;
            $sql = " SELECT usuario.id, usuario.nome, residuos.acao, residuos.tipoRes, contato.email1, contato.telefone1
FROM usuario
JOIN contato
JOIN residuos
ON(
usuario.id=contato.id_usr 
    AND residuos.id_usr=usuario.id
    AND residuos.acao='$a'
    AND residuos.tipoRes='$t'
    AND contato.estado='$e'
    AND contato.cidade='$c'
);";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (PDOException $ex) {
            $ex->getMessage();
        }
    }

    public function listarColaboracao($id) {
        try {


            $sql = "SELECT acao, tipoRes, id_usr  FROM residuos WHERE id_usr='$id'";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (PDOException $ex) {
            $ex->getMessage();
        }
    }

    public function desfazerColaboracao($id) {
        try {


            $sql = "DELETE FROM `residuos` WHERE id_usr='$id'";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
        } catch (PDOException $ex) {
            $ex->getMessage();
        }
    }

    public function listarColaboradores() {
        try {


            $sql = " SELECT usuario.id, usuario.nome, residuos.acao, residuos.tipoRes, contato.email1, contato.telefone1
FROM usuario
JOIN contato
JOIN residuos
ON(
usuario.id=contato.id_usr 
    AND residuos.id_usr=usuario.id)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (PDOException $ex) {
            $ex->getMessage();
        }
    }

}

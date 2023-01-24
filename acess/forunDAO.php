<?php

require_once 'conexao/conexao.php';
require_once '/opt/lampp/htdocs/greensys/transfer/forunDTO.php';
/*
  CLASSE QUE CONTEM OS MÉTODOS FUNCIONAIS DA CLASSE FORUN
 */

/**
 * Description of forunDAO
 *
 * @author diogenes
 */
class ForunDAO {

    public $pdo = null;

    public function __construct() {
        $this->pdo = Conexao::obterConexao();
    }

    public function salvarForun(ForunDTO $dados) {
        try {

            $t = $dados->getTopico();
            $d = $dados->getDuvida();
            $ad = $dados->getAutorDuvida();
            $dt = $dados->getDataPublicacao();
            $sql = "INSERT INTO forun VALUES ('','$ad','$t','$d','$dt')";
            $consulta = $this->pdo->prepare($sql);
            $consulta->execute();
        } catch (PDOException $ex) {
            $ex->getMessage();
        }
    }

    public function SalvarRespostas(ForunDTO $dados) {
        try {

            $ar = $dados->getAutoResposta();
            $r = $dados->getRespostas();
            $id = $dados->getId();
            $h = $dados->getDataPublicacao();
            $sql = "INSERT INTO respostasForun VALUES ('','$id','$ar','$r','$h')";
            $consulta = $this->pdo->prepare($sql);
            $consulta->execute();
        } catch (PDOException $ex) {
            $ex->getMessage();
        }
    }

    public function listarForunsAtuais($idForun) {
        try {


            $sql = "SELECT forun.idForun, usuario.nome, forun.topico, forun.duvida, forun.dataPublicacao,usuario.id
FROM forun
JOIN usuario
ON(
forun.idAutor=usuario.id
)
AND forun.idForun='$idForun' ";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $consulta = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $consulta;
        } catch (PDOException $ex) {
            $ex->getMessage();
        }
    }

    public function listarForunsAntigos() {
        try {

            $sql = "SELECT forun.idForun, usuario.nome, forun.topico, forun.duvida, forun.dataPublicacao
FROM forun
JOIN usuario
ON(
forun.idAutor=usuario.id
)ORDER BY forun.dataPublicacao DESC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $consulta = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $consulta;
        } catch (PDOException $ex) {
            $ex->getMessage();
        }
    }

    public function listarForuns() {
        try {

            $sql = "SELECT * FROM forun JOIN usuario
ON(
forun.idAutor=usuario.id )";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $consulta = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $consulta;
        } catch (PDOException $ex) {
            $ex->getMessage();
        }
    }

    public function listarRespostas($idForun) {
        try {

            $sql = "SELECT usuario.nome, respostasForun.resposta, respostasForun.idAutorResp, respostasForun.idResp    
FROM respostasForun
JOIN usuario
JOIN forun
ON(
respostasForun.idAutorResp=usuario.id
AND respostasForun.idForun=forun.idForun)
AND forun.idForun='$idForun'ORDER BY hora";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $consulta = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $consulta;
        } catch (PDOException $ex) {
            $ex->getMessage();
        }
    }

    public function deletarForun($idForun) {
        try {

            $sql = "SET foreign_key_checks = 0;DELETE FROM forun WHERE idForun='$idForun'";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
        } catch (PDOException $ex) {
            $ex->getMessage();
        }
    }

    public function deletarResp($idResp) {
        try {

            $sql = "SET foreign_key_checks = 0;DELETE FROM respostasForun WHERE idResp='$idResp'";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
        } catch (PDOException $ex) {
            $ex->getMessage();
        }
    }

    public function converterData($data) {
        $dt = explode('-', $data);
        $diaPd = $dt[2] . '/' . $dt[1] . '/' . $dt[0];
        return $diaPd;
    }

}

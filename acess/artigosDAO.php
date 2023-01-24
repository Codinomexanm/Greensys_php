<?php

require_once 'conexao/conexao.php';
require_once '/opt/lampp/htdocs/greensys/transfer/artigosDTO.php';
/*
  AQUI ESTÃO OS MÉTODOS OPERACIONAIS DA CLASSE RESÍDUOS
 */

/**
 * Description of artigosDAO
 *
 * @author diogenes
 */
class artigosDAO {

    public $pdo = null;

    function __construct() {
        $this->pdo = Conexao::obterConexao();
    }

    public function postarArtigo(ArtigosDTO $dados) {
        try {


            $a = $dados->getAutor();
            $txt = $dados->getTexto();
            $tit = $dados->getTitulo();
            $d = $dados->getDataPub();
            $sql = "INSERT INTO artigos VALUES('','$a','$tit','$txt','$d')";
            $consulta = $this->pdo->prepare($sql);
            $consulta->execute();
        } catch (PDOException $ex) {
            $ex->getMessage();
        }
    }

    public function visualizarArtigos($id) {
        try {

            $sql = "SELECT usuario.id,  usuario.nome, artigos.dataPub, artigos.titulo, artigos.texto, artigos.idArtigo
FROM artigos
JOIN usuario
ON(
artigos.idAutor=usuario.id
)AND artigos.idArtigo='$id'";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $consulta = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $consulta;
        } catch (PDOException $ex) {
            $ex->getMessage();
        }
    }

    public function pesquisarArtigos($pesq) {
        try {

            $sql = "SELECT idArtigo, titulo FROM artigos WHERE titulo like '%{$pesq}%'";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $consulta = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $consulta;
        } catch (PDOException $ex) {
            $ex->getMessage();
        }
    }

    public function listarArtigos() {
        try {

            $sql = "SELECT idArtigo, titulo FROM artigos ORDER BY dataPub DESC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $consulta = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $consulta;
        } catch (PDOException $ex) {
            $ex->getMessage();
        }
    }

    public function listarArtigosAntigos() {
        try {

            $sql = "SELECT  usuario.nome, artigos.dataPub, artigos.titulo, artigos.texto, artigos.idArtigo
FROM artigos
JOIN usuario
ON(
artigos.idAutor=usuario.id
)ORDER BY artigos.dataPub DESC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $consulta = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $consulta;
        } catch (PDOException $ex) {
            $ex->getMessage();
        }
    }

    public function converterData($data) {
        $dt = explode('-', $data);
        $diaPd = $dt[2] . '/' . $dt[1] . '/' . $dt[0];
        return $diaPd;
    }

    public function deletarArtigo($idArtigo) {
        try {

            $sql = "SET foreign_key_checks = 0;DELETE FROM artigos WHERE idArtigo='$idArtigo'";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
        } catch (PDOException $ex) {
            $ex->getMessage();
        }
    }

    public function listarRespostas($idArt) {
        try {

            $sql = "SELECT usuario.nome, respostasArtigo.resposta, respostasArtigo.idAutor, respostasArtigo.idResp    
FROM respostasArtigo
JOIN usuario
JOIN artigos
ON(
respostasArtigo.idAutor=usuario.id
AND respostasArtigo.idArtigo=artigos.idArtigo)
AND artigos.idArtigo='$idArt'ORDER BY hora";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $consulta = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $consulta;
        } catch (PDOException $ex) {
            $ex->getMessage();
        }
    }

    public function SalvarRespostas(ArtigosDTO $dados) {
        try {

            $a = $dados->getAutor();
            $d = $dados->getDataPub();
            $r = $dados->getResposta();
            $id = $dados->getId();
            $sql = "INSERT INTO respostasArtigo VALUES ('','$a','$id','$r','$d')";
            $consulta = $this->pdo->prepare($sql);
            $consulta->execute();
        } catch (PDOException $ex) {
            $ex->getMessage();
        }
    }

    public function deletarResp($id) {
        try {


            $sql = "DELETE FROM respostasArtigo where idResp='$id'";
            $consulta = $this->pdo->prepare($sql);
            $consulta->execute();
        } catch (PDOException $ex) {
            $ex->getMessage();
        }
    }

}

<?php

/*
  MÉTODOS DE UTILIZACAO DA CLASSE SUGESTAO
 */
require_once 'conexao/conexao.php';
require_once '/opt/lampp/htdocs/greensys/transfer/sugestaoDTO.php';

/**
 * Description of sugestaoDAO
 *
 * @author diogenes
 */
class sugestaoDAO {

    public $pdo = null;

    function __construct() {
        $this->pdo = Conexao::obterConexao();
    }

    public function postarArtigo(SugestaoDTO $dados) {
        try {
            
        } catch (PDOException $ex) {
            $ex->getMessage();
        }
        $autor = $dados->getAutor();
        $sugest = $dados->getSugestao();
        $data = $dados->getData();
        $sql = "INSERT INTO sugestao VALUES('','$autor','$sugest', '$data')";
        $consulta = $this->pdo->prepare($sql);
        $consulta->execute();
    }

    public function listarSugestoes() {
        try {


            $sql = "SELECT sugestao.idSugestao, usuario.nome, sugestao.sugestao, sugestao.hora
FROM sugestao
JOIN usuario
ON(
usuario.id=sugestao.idAutor
)ORDER BY sugestao.hora DESC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $resutado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resutado;
        } catch (PDOException $ex) {
            $ex->getMessage();
        }
    }

    public function lerSugestoes($id) {
        try {


            $sql = "SELECT sugestao.idSugestao, usuario.nome, sugestao.sugestao, sugestao.hora
FROM sugestao
JOIN usuario
ON(
usuario.id=sugestao.idAutor
)
AND sugestao.idSugestao='$id'";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $resutado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resutado;
        } catch (PDOException $ex) {
            $ex->getMessage();
        }
    }

    public function excluirSugestoes($id) {
        try {
            $sql = "DELETE FROM sugestao WHERE idSugestao='$id'";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
        } catch (PDOException $ex) {
            $ex->getMessage();
        }
    }

}

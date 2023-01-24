<?php

include_once '/opt/lampp/htdocs/greensys/transfer/PontosDeColetaDTO.php';
require_once 'conexao/conexao.php';

/*
  PONTOSDECOLETADAO CONTÉM OS MÉTODOS DA APLICAÇÃO */

/**
 * Description of pontosDeColetaDAO
 *
 * @author diogenes
 */
class PontosDeColetaDAO {

    public $pdo = null;

    public function __construct() {
        $this->pdo = Conexao::obterConexao();
    }

    public function cadastrarPtCol(PontosDeColetaDTO $dados) {
        try {



            $l = $dados->getLocal();
            $e = $dados->getEstado();
            $c = $dados->getCidade();
            $tel = $dados->getTelefone();
            $tip = $dados->getTipoRes();
            $n = $dados->getNome();
            $sql = "INSERT INTO pontosColeta VALUES ('','$l','$e','$c','$tel','$tip','$n' )";
            $consulta = $this->pdo->prepare($sql);
            $consulta->execute();
        } catch (PDOException $ex) {
            $ex->getMessage();
        }
    }

    public function buscarPtCol() {
        try {



            $sql = " SELECT pontosColeta.local, pontosColeta.estado, tb_cidades.nomecidade, pontosColeta.telefone, pontosColeta.tipoRes,
          pontosColeta.nomeEstab, pontosColeta.idPtCol
FROM pontosColeta
JOIN tb_cidades
ON ( pontosColeta.cidade = tb_cidades.id ) ";
            $consulta = $this->pdo->prepare($sql);
            $consulta->execute();
            $resutado = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $resutado;
        } catch (PDOException $ex) {
            $ex->getMessage();
        }
    }

    public function buscarPtColAvancado($id) {
        try {


            $sql = "SELECT pontosColeta.local, pontosColeta.estado, tb_cidades.nomecidade, pontosColeta.telefone, pontosColeta.tipoRes,pontosColeta.nomeEstab
FROM pontosColeta
JOIN tb_cidades
JOIN contato
JOIN usuario
ON
(
contato.id_usr=usuario.id
    AND contato.estado=pontosColeta.estado
    AND contato.cidade=pontosColeta.cidade
    AND contato.cidade=tb_cidades.id
)
   AND usuario.id='{$id}'";//AND contato.cidade=tb_cidades.id
            $consulta = $this->pdo->prepare($sql);
            $consulta->execute();
            $resutado = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $resutado;
        } catch (PDOException $ex) {
            $ex->getMessage();
        }
    }

    public function BuscaComParam($tpesq, $pesquisa) {
        try {


            $sql = NULL;

            switch ($tpesq) {

                case "estado":
                    $sql.="SELECT pontosColeta.local, pontosColeta.estado, tb_cidades.nomecidade, pontosColeta.telefone, pontosColeta.tipoRes,
          pontosColeta.nomeEstab, pontosColeta.idPtCol 
FROM pontosColeta
JOIN tb_cidades
JOIN tb_estados
ON ( pontosColeta.cidade = tb_cidades.id)AND tb_estados.uf=pontosColeta.estado AND tb_estados.nome='{$pesquisa}'";

                    break;
                case "tresiduo":
                    $sql.="SELECT pontosColeta.local, pontosColeta.estado, tb_cidades.nomecidade, pontosColeta.telefone, pontosColeta.tipoRes,
          pontosColeta.nomeEstab
FROM pontosColeta
JOIN tb_cidades
ON ( pontosColeta.cidade = tb_cidades.id)
AND pontosColeta.tipoRes like '%{$pesquisa}%'";
                    break;
                case "cidade":
                    $sql.="SELECT pontosColeta.local, pontosColeta.estado, tb_cidades.nomecidade, pontosColeta.telefone, pontosColeta.tipoRes,
          pontosColeta.nomeEstab
FROM pontosColeta
JOIN tb_cidades 
ON ( pontosColeta.cidade = tb_cidades.id)
AND tb_cidades.nomecidade like '%{$pesquisa}%'";
            }
            $consulta = $this->pdo->prepare($sql);
            $consulta->execute();
            $resutado = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $resutado;
        } catch (PDOException $ex) {
            $ex->getMessage();
        }
    }

}

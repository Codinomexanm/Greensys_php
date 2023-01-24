<?php

include_once '/opt/lampp/htdocs/greensys/transfer/usuarioDTO.php';
require_once 'conexao/conexao.php';
/*
  USARIODAO, CONTÉM OS MÉTODOS DE MANIPUALÇÃO DE USUÁRIOS
 */

/**
 * Description of usuarioDAO
 *
 * @author diogenes
 */
class UsuarioDAO {

    public $pdo = null;

    public function __construct() {
        $this->pdo = Conexao::obterConexao();
    }

    public function Cadastrar(UsuarioDTO $usuarioDto) {
        try {

            $cidade = $usuarioDto->getCidade();
            $dtnasc = $usuarioDto->getDataNasc();
            $mail1 = $usuarioDto->getEmail1();
            $end = $usuarioDto->getEndereco();
            $estad = $usuarioDto->getEstado();
            $ident = $usuarioDto->getTipoPessoa();
            $logn = $usuarioDto->getLogin();
            $nomeusr = $usuarioDto->getNomeUsuario();
            $pass = $usuarioDto->getSenha();
            $sex = $usuarioDto->getSexo();
            $tel1 = $usuarioDto->getTelefone1();
            $tpess = $usuarioDto->getNumpessoa();
            $perfil = 1;


            $this->pdo->beginTransaction();
            $sql1 = "INSERT INTO usuario VALUES ('', '$nomeusr','$ident','$tpess','$sex','$dtnasc','$logn','$pass', $perfil)";
            $consulta1 = $this->pdo->prepare($sql1);
            $consulta1->execute();
            $id = $this->pdo->lastInsertId();

            $sql2 = "INSERT INTO contato VALUES ('$mail1','$tel1','$estad','$cidade','$end','$id')";
            $consulta2 = $this->pdo->prepare($sql2);
            $consulta2->execute();

            // $this->pdo->rollback();
            $this->pdo->commit();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    //metodo usado para apresentar listas de estados em operaçoes com jquery 
    public function listarEstados() {
        $sql = "SELECT uf FROM tb_estados";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $lista;
    }

    //metodo usado para apresentar listas de cidades em operaçoes com jquery 
    public function listarCidades($uf) {
        $uff = $uf;
        $sql = "SELECT tb_cidades.nomecidade, tb_cidades.id
FROM tb_cidades
JOIN tb_estados
ON(tb_cidades.estado=tb_estados.id )
AND tb_estados.uf='$uff'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $list = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $list;
    }

    public function listarUsr($id) {
        try {

            $sql = 'SELECT  usuario.nome, usuario.login, contato.email1, contato.telefone1
FROM usuario
JOIN contato
ON(contato.id_usr=usuario.id AND usuario.id=?)';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(1, $id);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function verificarExistLogin($login) {
        try {
            
        } catch (PDOException $ex) {
            $ex->getMessage();
        }
        $sql = 'SELECT * FROM usuario WHERE login=? ';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $login);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        return $usuario;
    }

    public function alterarTipoUsr($tipoUsr, $numUsr, $data, $sexo, $id) {
        try {


            $sql = "UPDATE usuario SET tipoPessoa =?,numpessoa=?, dataNasc=?, sexo=? WHERE id=?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(1, $tipoUsr);
            $stmt->bindParam(2, $numUsr);
            $stmt->bindParam(3, $data);
            $stmt->bindParam(4, $sexo);
            $stmt->bindParam(5, $id);
            $stmt->execute();
        } catch (PDOException $ex) {
            $ex->getMessage();
        }
    }

    public function alterarEstadoCidade($estado, $cidade, $endereco, $id) {
        try {


            $sql = "UPDATE contato SET estado=?, cidade=?, endereco=? WHERE id_usr=?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(1, $estado);
            $stmt->bindParam(2, $cidade);
            $stmt->bindParam(3, $endereco);
            $stmt->bindParam(4, $id);
            $stmt->execute();
        } catch (PDOException $ex) {
            $ex->getMessage();
        }
    }

    public function alterarSenha($senha, $id) {
        try {


            $sql = "UPDATE usuario SET senha='$senha' WHERE id='$id'";
            $consulta1 = $this->pdo->prepare($sql);
            $consulta1->execute();
        } catch (PDOException $ex) {
            $ex->getMessage();
        }
    }

    public function alterarDados(UsuarioDTO $usuarioDto) {
        try {


            $mail1 = $usuarioDto->getEmail1();
            $logn = $usuarioDto->getLogin();
            $nomeusr = $usuarioDto->getNomeUsuario();
            $tel1 = $usuarioDto->getTelefone1();
            $id = $usuarioDto->getId();

            $this->pdo->beginTransaction();
            $sql1 = "UPDATE usuario SET nome='$nomeusr', login='$logn' WHERE id='$id'";
            $consulta1 = $this->pdo->prepare($sql1);
            $consulta1->execute();

            $sql2 = "UPDATE contato SET email1='$mail1', telefone1='$tel1'WHERE id_usr='$id'";
            $consulta2 = $this->pdo->prepare($sql2);
            $consulta2->execute();
            $this->pdo->commit();
        } catch (PDOException $ex) {
            $ex->getMessage();
        }
    }
    public function listarNomeEstCid($id) {
        try {
             $sql = "SELECT tb_estados.nome, tb_cidades.nomecidade
FROM tb_estados
JOIN tb_cidades
JOIN usuario
JOIN contato
ON(
    tb_estados.id=tb_cidades.estado
    AND contato.estado=tb_estados.uf
    AND contato.cidade=tb_cidades.id
    AND usuario.id=contato.id_usr
)
AND usuario.id='$id'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $usuario = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $usuario;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
            
    }
    public function verificarDados(UsuarioDTO $dados) {
        
             try {
                 $tp=$dados->getTipoPessoa();
                 $np=$dados->getNumpessoa();
                 $dn=$dados->getDataNasc();
                 $l=$dados->getLogin();
             $sql = "SELECT id FROM usuario WHERE tipoPessoa='$tp' AND numpessoa='$np' AND "
                     . "dataNasc='$dn' AND login='$l'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        return $usuario;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
            
    
    }

}

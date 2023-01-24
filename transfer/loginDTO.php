<?php

require_once '../acess/conexao/conexao.php';

/**
 * CLASSE QUE CONTEM OS ATRIBUTOS E MÉTODOS DE LOGINDTO
 *
 * @author diogenes
 */
class LoginDTO {

    public $pdo = null;

    public function __construct() {
        $this->pdo = conexao::obterConexao();
    }

    //BUCA O USUÁRIO DO BANCO DE DADOS
    public function logar($usr, $pas) {
        $sql = 'SELECT * FROM usuario WHERE login=? AND senha=?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $usr);
        $stmt->bindValue(2, $pas);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        return $usuario;
    }

    //PEGA O ID DO USUÁRIO
    public function getId($usr, $pas) {
        $sql = 'SELECT id FROM usuario WHERE login=? AND senha=?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $usr);
        $stmt->bindValue(2, $pas);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        return $usuario;
    }

    //VERIFICA O PERFIL DO USUÁRIO, SE É ADMIN OU USUÁRIO NORMAL
    public function verificarPerfil($id) {
        $sql = 'SELECT perfil FROM usuario WHERE id=?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        return $usuario;
    }
    //PEGA O NOME DO USR
    public function getNomeUsr($id) {
        $sql = 'SELECT nome FROM usuario WHERE id=?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        return $usuario;
    }

}

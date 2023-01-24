<?php

/**
 * CLASSE QUE CONTEM OS ATRIBUTOS DE USUARIO E SEUS MÉTODOS
 *
 * @author diogenes
 */
class UsuarioDTO {

    private $id;
    private $nomeUsuario;
    private $tipoPessoa;
    private $numpessoa;
    private $sexo;
    private $dataNasc;
    private $login;
    private $senha;
    private $email1;
    private $telefone1;
    private $estado;
    private $cidade;
    private $endereco;

    public function getNumpessoa() {
        return $this->numpessoa;
    }

    public function setNumpessoa($numpessoa) {
        $this->numpessoa = $numpessoa;
    }

    public function getTipoPessoa() {
        return $this->tipoPessoa;
    }

    public function setTipoPessoa($tipoPessoa) {
        $this->tipoPessoa = $tipoPessoa;
    }

    public function getId() {
        return $this->id;
    }

    public function getNomeUsuario() {
        return $this->nomeUsuario;
    }

    public function getSexo() {
        return $this->sexo;
    }

    public function getDataNasc() {
        return $this->dataNasc;
    }

    public function getLogin() {
        return $this->login;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getEmail1() {
        return $this->email1;
    }

    public function getTelefone1() {
        return $this->telefone1;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getCidade() {
        return $this->cidade;
    }

    public function getEndereco() {
        return $this->endereco;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNomeUsuario($nomeUsuario) {
        $this->nomeUsuario = $nomeUsuario;
    }

    public function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    public function setDataNasc($dataNasc) {
        $this->dataNasc = $dataNasc;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function setEmail1($email1) {
        $this->email1 = $email1;
    }

    public function setEmail2($email2) {
        $this->email2 = $email2;
    }

    public function setTelefone1($telefone1) {
        $this->telefone1 = $telefone1;
    }

    public function setTelefone2($telefone2) {
        $this->telefone2 = $telefone2;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    public function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    public function conveterDataBR($dataNasc) {
        $data = explode('-', $dataNasc);
        $dataBr = $data[2] . '-' . $data[1] . '-' . $data[0];
        return $dataBr;
    }

    public function criptografarSenha($senha) {
        $criptografia = md5($senha);
        return $criptografia;
    }

}

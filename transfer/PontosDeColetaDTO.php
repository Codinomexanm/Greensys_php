<?php

/*
PONTOSDECOLETADTO, CONTÉM OS ATRIBUTOS E MÉTODOS BÁSICOS DA CLASSE PONTOS DE COLETA
  */

/**
 * Description of PontosDeColetaDTO
 *
 * @author diogenes
 */
class PontosDeColetaDTO {
    private  $nome;
    private  $local;
    private  $cidade;
    private  $estado;
    private  $tipoRes;
    private  $telefone;
    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

        public function getLocal() {
        return $this->local;
    }

    public function getCidade() {
        return $this->cidade;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getTipoRes() {
        return $this->tipoRes;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function setLocal($local) {
        $this->local = $local;
    }

    public function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function setTipoRes($tipoRes) {
        $this->tipoRes = $tipoRes;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }


}

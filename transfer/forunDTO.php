<?php

/*
 CLASSE FORUNDTO, CONTÉM ATRIBUTOS E MÉTODOS BÁSICOS DA CLASSE FORUN
 */

/**
 * Description of forunDTO
 *
 * @author diogenes
 */
class ForunDTO {
    private  $id;
    private  $AutorDuvida;
    private  $topico;
    private  $duvida;
    private  $dataPublicacao;
    private  $autoResposta;
    private  $respostas;
            
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

        public function getAutorDuvida() {
        return $this->AutorDuvida;
    }

    public function getTopico() {
        return $this->topico;
    }

    public function getDuvida() {
        return $this->duvida;
    }

    public function getDataPublicacao() {
        return $this->dataPublicacao;
    }

    public function getAutoResposta() {
        return $this->autoResposta;
    }

    public function getRespostas() {
        return $this->respostas;
    }

    public function setAutorDuvida($AutorDuvida) {
        $this->AutorDuvida = $AutorDuvida;
    }

    public function setTopico($topico) {
        $this->topico = $topico;
    }

    public function setDuvida($duvida) {
        $this->duvida = $duvida;
    }

    public function setDataPublicacao($dataPublicacao) {
        $this->dataPublicacao = $dataPublicacao;
    }

    public function setAutoResposta($autoResposta) {
        $this->autoResposta = $autoResposta;
    }

    public function setRespostas($respostas) {
        $this->respostas = $respostas;
    }


}

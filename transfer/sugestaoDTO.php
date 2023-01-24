<?php

/*
AQUI FICAM OS ATRIBUTOS E MÉTODOS BÁSICOS DA CLASSE SUGESTÃO
 */

/**
 * Description of sugestaoDTO
 *
 * @author diogenes
 */
class sugestaoDTO {
    private  $autor;
    private  $sugestao;
    private  $data;
    public function getData() {
        return $this->data;
    }

    public function setData($data) {
        $this->data = $data;
    }

        public function getAutor() {
        return $this->autor;
    }

    public function getSugestao() {
        return $this->sugestao;
    }

    public function setAutor($autor) {
        $this->autor = $autor;
    }

    public function setSugestao($sugestao) {
        $this->sugestao = $sugestao;
    }


}

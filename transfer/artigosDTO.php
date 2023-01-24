
<?php

/*
  AQUI ESTÃO OS ATRIBUTOS E MÉTODOS BÁSICOS DA CLASSE ARTIGO
 */

/**
 * Description of artigosDTO
 *
 * @author diogenes
 */
class ArtigosDTO {

    private  $id;
    private  $titulo;
    private  $texto;
    private  $autor;
    private  $dataPub;
    private      $resposta;
    public function getResposta() {
        return $this->resposta;
    }

    public function setResposta($resposta) {
        $this->resposta = $resposta;
    }

    
    public function getDataPub() {
        return $this->dataPub;
    }

    public function setDataPub($dataPub) {
        $this->dataPub = $dataPub;
    }

    public function getId() {
        return $this->id;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function getTexto() {
        return $this->texto;
    }

    public function getImagem() {
        return $this->imagem;
    }

    public function getAutor() {
        return $this->autor;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function setTexto($texto) {
        $this->texto = $texto;
    }

    public function setImagem($imagem) {
        $this->imagem = $imagem;
    }

    public function setAutor($autor) {
        $this->autor = $autor;
    }

}

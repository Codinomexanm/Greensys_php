<?php

/*CLASSE RESIDUOSDTO
 * ABRIGA TODOS OS MÉTODOS BÁSICOS (GETS E SETS) DA CLASSE RESIDUOS
 * E SEUS ATRIBUTOS
 */

/**
 * Description of residuosDTO
 *
 * @author diogenes
 */
class ResiduosDTO {
    private  $tipo;
    private  $agentes;
    private  $acao;
    private  $idUsr;
   
    public function getIdUsr() {
        return $this->idUsr;
    }

    public function setIdUsr($idUsr) {
        $this->idUsr = $idUsr;
    }

    
    public function getTipo() {
        return $this->tipo;
    }

    public function getAgentes() {
        return $this->agentes;
    }

    public function getAcao() {
        return $this->acao;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function setAgentes($agentes) {
        $this->agentes = $agentes;
    }

    public function setAcao($acao) {
        $this->acao = $acao;
    }


}

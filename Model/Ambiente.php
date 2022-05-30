<?php
class Ambiente{
    private $nomeAmb;
    private $idamb;
    private $descricaoAmb;
    
    public function getNomeAmb() {
        return $this->nomeAmb;
    }

    public function setNomeAmb($nomeAmb) {
        $this->nomeAmb = $nomeAmb;
    }

    public function setDescricaoAmb($descricaoAmb) {
        $this->descricaoAmb = $descricaoAmb;
    }

    public function getIdamb() {
        return $this->idamb;
    }

    public function setIdamb($idamb) {
        $this->idamb = $idamb;
    }


}
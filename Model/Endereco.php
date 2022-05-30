<?php

class Endereco {
    private $idEnd;
    private $cep;
    private $rua;
    private $bairro;
    private $cidade;
    private $casa;
    
    public function getIdEnd() {
        return $this->idEnd;
    }

    public function getCep() {
        return $this->cep;
    }

    public function getRua() {
        return $this->rua;
    }

    public function getBairro() {
        return $this->bairro;
    }

    public function getCidade() {
        return $this->cidade;
    }

    public function getCasa() {
        return $this->casa;
    }

    public function setIdEnd($idEnd) {
        $this->idEnd = $idEnd;
    }

    public function setCep($cep) {
        $this->cep = $cep;
    }

    public function setRua($rua) {
        $this->rua = $rua;
    }

    public function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    public function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    public function setCasa($casa) {
        $this->casa = $casa;
    }


}

<?php

class CentroEsportivo {

    private $idCen;
    private $cidade;
    private $diretor;
    private $telefone;
    private $email;

    public function getIdCen() {
        return $this->idCen;
    }

    public function setIdCen($idCen) {
        $this->idCen = $idCen;
    }

    public function getLocal() {
        return $this->local;
    }

    public function getCidade() {
        return $this->cidade;
    }

    public function getDiretor() {
        return $this->diretor;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setLocal($local) {
        $this->local = $local;
    }

    public function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    public function setDiretor($diretor) {
        $this->diretor = $diretor;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

}

<?php
class Modalidade{
    private $idMod;
    private $nome;
    private $descricao;
    
    public function getIdMod() {
        return $this->idMod;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setIdMod($idMod) {
        $this->idMod = $idMod;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }


}
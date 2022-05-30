<?php
class Turma{
    private $idtur;
    private $dias;
    private $turno;
    private $faixaEtaria;
    private $horario;
    
    public function getHorario() {
        return $this->horario;
    }

    public function setHorario($horario) {
        $this->horario = $horario;
    }

    public function getDias() {
        return $this->dias;
    }

    public function getTurno() {
        return $this->turno;
    }

    public function getFaixaEtaria() {
        return $this->faixaEtaria;
    }

    public function setDias($dias) {
        $this->dias = $dias;
    }

    public function setTurno($turno) {
        $this->turno = $turno;
    }

    public function setFaixaEtaria($faixaEtaria) {
        $this->faixaEtaria = $faixaEtaria;
    }

    public function getIdtur() {
        return $this->idtur;
    }

    public function setIdtur($idtur) {
        $this->idtur = $idtur;
    }



}
<?php
class Inscricao {
    private $idins;
    private $dataIns;
    private $horaIns;
    private $idusu;
    private $idtur;
    private $usuario;
    private $dias;
    private $turno;
    
    public function getDias() {
        return $this->dias;
    }

    public function getTurno() {
        return $this->turno;
    }

    public function setDias($dias) {
        $this->dias = $dias;
    }

    public function setTurno($turno) {
        $this->turno = $turno;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function getIdusu() {
        return $this->idusu;
    }

    public function getIdtur() {
        return $this->idtur;
    }

    public function setIdusu($idusu) {
        $this->idusu = $idusu;
    }

    public function setIdtur($idtur) {
        $this->idtur = $idtur;
    }
    
    public function getIdins() {
        return $this->idins;
    }

    public function setIdins($idins) {
        $this->idins = $idins;
    }

    public function getDataIns() {
        return $this->dataIns;
    }

    public function getHoraIns() {
        return $this->horaIns;
    }

    public function setDataIns($dataIns) {
        $this->dataIns = $dataIns;
    }

    public function setHoraIns($horaIns) {
        $this->horaIns = $horaIns;
    }




}
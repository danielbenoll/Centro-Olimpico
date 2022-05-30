<?php

require_once __DIR__ . '/../Model/DAO/CentroDAO.php';
require_once __DIR__ . '/../Model/DAO/ModalidadeDAO.php';
require_once __DIR__ . '/../Model/DAO/TurmaDAO.php';


class GerenciadorPesquisa {
    
    private $pesquisa;
    
    public function pesquisarCentros() {
        $centroDao = new CentroDAO();

        $centros = $centroDao->listarCentros();
        
        return $centros;
    }
    public function pesquisarModalidades() {
        $modalidadeDao = new ModalidadeDAO();

        $modalidades = $modalidadeDao->listarModalidades();
        
        return $modalidades;
    }
    public function pesquisarTurmas(){
        $turmaDao = new TurmaDAO();

        $turmas = $turmaDao->listarTurmas();
        
        return $turmas;
    }
}

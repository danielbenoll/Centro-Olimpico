<?php

require_once 'Conexao.php';
require_once __DIR__ . '\..\Turma.php';

class TurmaDAO {

    public function listarTodos() {
        $lista = array(1 => "Selecione o Centro Olímpico", 2 => "Centro Olimpico do Setor O", 3=> "Centro Olimpico de Ceilandia",);
        return $lista;
    }
    
    public function cadastrarTurma($turma) {
        try {
            $pdo = conexao::getInstance();
            $sql = "INSERT INTO turma(dias, turno, faixaEtaria, horario)"
                             . "VALUES (:dias, :turno, :faixaEtaria, :horario)";
            
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":dias", $turma->getDias());
            $stmt->bindValue(":turno", $turma->getTurno());
            $stmt->bindValue(":faixaEtaria", $turma->getFaixaEtaria());
            $stmt->bindValue(":horario", $turma->getHorario());
           
            return  $stmt->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
    
    public function pesquisarPorTurma($idtur) {
        try {
            $pdo = conexao::getInstance();
            $sql = "SELECT * FROM turma u WHERE u.idtur like :idtur ";
            $stmt = $pdo->prepare($sql);

            $stmt->bindValue(":idtur", $idtur . "%");
            $stmt->execute();

            $turmas = array();

            While ($turmaBanco = $stmt->fetch()) {
                $turma = new Turma();
                $turma->setIdtur($turmaBanco["idtur"]);
                $turma->setDias($turmaBanco["dias"]);
                $turma->setTurno($turmaBanco["turno"]);
                $turma->setFaixaEtaria($turmaBanco["faixaEtaria"]);
                $turma->setHorario($turmaBanco["horario"]);

                $turmas[] = $turma;
            }

            return $turmas;
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
        }
    }

    
    public function listarTurmas() {
        try {
            $pdo = conexao::getInstance();
            $sql = "SELECT * FROM bd_co.turma";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $turmas = array();

            While ($turmasBanco = $stmt->fetch()) {
                $turma = new Turma();
                $turma->setIdtur($turmasBanco["idtur"]);
                $turma->setDias($turmasBanco["dias"]);
                $turma->setTurno($turmasBanco["turno"]);
                $turma->setHorario($turmasBanco["horario"]);
                $turma->setFaixaEtaria($turmasBanco["faixaEtaria"]);
                
                $turmas[] = $turma;
            }

            return $turmas;
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    

    public function pesquisarPorCentro($centro) {
        try {
            $pdo = conexao::getInstance();
            $sql = "SELECT * FROM centroesportivo u WHERE u.cidade like :cidade ";
            $stmt = $pdo->prepare($sql);

            $stmt->bindValue(":cidade", $cidade . "%");
            $stmt->execute();

            $usuarios = array();

            While ($usuarioBanco = $stmt->fetch()) {
                $usuario = new Usuario();
                $usuario->setLogin($usuarioBanco["login"]);
                $usuario->setNome($usuarioBanco["nome"]);
                $usuario->setPerfil($usuarioBanco["perfil"]);
                $usuario->setId($usuarioBanco["id"]);

                $usuarios[] = $usuario;
            }

            return $usuarios;
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    public function excluirTurma($idtur) {
        try {
            $pdo = conexao::getInstance();
            $sql = "DELETE FROM turma WHERE idtur = :idtur";
            
            $stmt = $pdo->prepare($sql);

            $stmt->bindValue(":idtur", $idtur);
            
            return $stmt->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    } 
    
    public function recuperarTurmaPorID($idtur) {
        try {
            $pdo = conexao::getInstance();
            $sql = "SELECT * FROM turma c WHERE c.idtur = :idtur";
            $stmt = $pdo->prepare($sql);
            
            $stmt->bindValue(":idtur", $idtur);
            
            $stmt->execute();
            
            $turmaRecuperado = NULL;
           
            While ($turmaBanco = $stmt->fetch()) {
                $turma = new Turma();
                $turma->setIdtur($turmaBanco["idtur"]);
                $turma->setDias($turmaBanco["dias"]);
                $turma->setTurno($turmaBanco["turno"]);
                $turma->setFaixaEtaria($turmaBanco["faixaEtaria"]);
                $turma->setHorario($turmaBanco["horario"]);
                $turmaRecuperado = $turma;
            }
            
            return $turmaRecuperado;
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
        }
    }
    public function atualizarTurma($turma) {
        try {
            $pdo = conexao::getInstance();
            $sql = "UPDATE turma SET dias = :dias, turno = :turno, faixaEtaria=:faixaEtaria, horario=:horario WHERE idtur = :idtur";
            
            $stmt = $pdo->prepare($sql);
            
            $stmt->bindValue(":idtur", $turma->getIdtur());
            $stmt->bindValue(":dias", $turma->getDias());
            $stmt->bindValue(":turno", $turma->getTurno());
            $stmt->bindValue(":faixaEtaria", $turma->getFaixaEtaria());
            $stmt->bindValue(":horario", $turma->getHorario());           
            return $stmt->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
}

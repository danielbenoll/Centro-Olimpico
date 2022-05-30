<?php

require_once 'Conexao.php';
require_once __DIR__ . '\..\CentroEsportivo.php';

class CentroDAO {

    public function listarTodos() {
        $lista = array(1 => "Selecione o Centro Olímpico", 2 => "Centro Olimpico do Setor O", 3=> "Centro Olimpico de Ceilandia",);
        return $lista;
    }
    
    public function cadastrarCentroEsportivo($centro) {
        try {
            $pdo = conexao::getInstance();
            $sql = "INSERT INTO centroesportivo(cidade, diretor, telefone, email)"
                             . "VALUES (:cidade, :diretor, :telefone, :email)";
            
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":cidade", $centro->getCidade());
            $stmt->bindValue(":diretor", $centro->getDiretor());
            $stmt->bindValue(":telefone", $centro->getTelefone());
            $stmt->bindValue(":email", $centro->getEmail());
           
            return  $stmt->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
    
    public function excluirCentro($idCen) {
        try {
            $pdo = conexao::getInstance();
            $sql = "DELETE FROM centroesportivo WHERE idCen = :idCen";
            
            $stmt = $pdo->prepare($sql);

            $stmt->bindValue(":idCen", $idCen);
            
            return $stmt->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    } 
    
    public function listarCentros() {
        try {
            $pdo = conexao::getInstance();
            $sql = "SELECT * FROM bd_co.centroesportivo";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $centros = array();

            While ($centrosBanco = $stmt->fetch()) {
                $centro = new CentroEsportivo();
                $centro->setIdCen($centrosBanco["idCen"]);
                $centro->setCidade($centrosBanco["cidade"]);
                $centro->setDiretor($centrosBanco["diretor"]);
                $centro->setTelefone($centrosBanco["telefone"]);
                $centro->setEmail($centrosBanco["email"]);

                $centros[] = $centro;
            }

            return $centros;
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function pesquisarPorCentro($centro) {
        try {
            $pdo = conexao::getInstance();
            $sql = "SELECT * FROM centroesportivo u WHERE u.cidade like :cidade ";
            $stmt = $pdo->prepare($sql);

            $stmt->bindValue(":cidade", $centro . "%");
            $stmt->execute();

            $centros = array();

            While ($centroBanco = $stmt->fetch()) {
                $centro = new CentroEsportivo();
                $centro->setIdCen($centroBanco["idCen"]);
                $centro->setCidade($centroBanco["cidade"]);
                $centro->setDiretor($centroBanco["diretor"]);
                $centro->setTelefone($centroBanco["telefone"]);
                $centro->setEmail($centroBanco["email"]);

                $centros[] = $centro;
            }

            return $centros;
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    public function recuperarCentroPorID($idCen) {
        try {
            $pdo = conexao::getInstance();
            $sql = "SELECT * FROM centroesportivo c WHERE c.idCen = :idCen";
            $stmt = $pdo->prepare($sql);
            
            $stmt->bindValue(":idCen", $idCen);
            
            $stmt->execute();
            
            $centroRecuperado = NULL;
           
            While ($centroBanco = $stmt->fetch()) {
                $centro = new CentroEsportivo();
                $centro->setIdCen($centroBanco["idCen"]);
                $centro->setCidade($centroBanco["cidade"]);
                $centro->setDiretor($centroBanco["diretor"]);
                $centro->setTelefone($centroBanco["telefone"]);
                $centro->setEmail($centroBanco["email"]);
                $centroRecuperado = $centro;
            }
            
            return $centroRecuperado;
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
        }
    }
    public function atualizarCentro($centro) {
        try {
            $pdo = conexao::getInstance();
            $sql = "UPDATE centroesportivo SET cidade = :cidade, diretor = :diretor, email=:email, telefone=:telefone, idCen=:idCen WHERE idCen = :idCen";
            
            $stmt = $pdo->prepare($sql);

            $stmt->bindValue(":idCen", $centro->getIdCen());
            $stmt->bindValue(":cidade", $centro->getCidade());
            $stmt->bindValue(":diretor", $centro->getDiretor());
            $stmt->bindValue(":email", $centro->getEmail());
            $stmt->bindValue(":telefone", $centro->getTelefone());           
            
            /*
            $sql = "UPDATE endereco SET cep = :cep, rua = :rua,"
                    . "bairro=:bairro, cidade=:cidade, casa=:casa, idEnd=:idEnd WHERE idEnd = :idEnd";
            
            
            $stmt->bindValue(":cep", $usuario->getCep());
            $stmt->bindValue(":rua", $usuario->getRua());
            $stmt->bindValue(":bairro", $usuario->getBairro());
            $stmt->bindValue(":cidade", $usuario->getCidade());
            $stmt->bindValue(":casa", $usuario->getCasa());
            $stmt->bindValue(":idEnd", $usuario->getIdEnd());
            */
            return $stmt->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

}

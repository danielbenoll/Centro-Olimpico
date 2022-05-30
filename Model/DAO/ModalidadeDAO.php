<?php

require_once 'Conexao.php';
require_once __DIR__ . '\..\Modalidade.php';

class ModalidadeDAO {

    public function listarTodos() {
        $lista = array(1 => "Selecione o Centro Olímpico", 2 => "Centro Olimpico do Setor O", 3=> "Centro Olimpico de Ceilandia",);
        return $lista;
    }
    
    public function cadastrarModalidade($modalidade) {
        try {
            $pdo = conexao::getInstance();
            $sql = "INSERT INTO modalidade(nome, descricao)"
                             . "VALUES (:nome, :descricao)";
            
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":nome", $modalidade->getNome());
            $stmt->bindValue(":descricao", $modalidade->getDescricao());
            
            return  $stmt->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
    
    public function pesquisarPorModalidade($nome) {
        try {
            $pdo = conexao::getInstance();
            $sql = "SELECT * FROM modalidade u WHERE u.nome like :nome ";
            $stmt = $pdo->prepare($sql);

            $stmt->bindValue(":nome", $nome . "%");
            $stmt->execute();

            $modalidades = array();

            While ($modalidadeBanco = $stmt->fetch()) {
                $modalidade = new Modalidade();
                $modalidade->setIdMod($modalidadeBanco["idMod"]);
                $modalidade->setNome($modalidadeBanco["nome"]);
                $modalidade->setDescricao($modalidadeBanco["descricao"]);

                $modalidades[] = $modalidade;
            }

            return $modalidades;
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
        }
    }

    
    public function excluirModalidade($idMod) {
        try {
            $pdo = conexao::getInstance();
            $sql = "DELETE FROM modalidade WHERE idMod = :idMod";
            
            $stmt = $pdo->prepare($sql);

            $stmt->bindValue(":idMod", $idMod);
            
            return $stmt->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    } 
    
    public function atualizarModalidade($modalidade) {
        try {
            $pdo = conexao::getInstance();
            $sql = "UPDATE modalidade SET nome = :nome, descricao = :descricao WHERE idMod = :idMod";
            
            $stmt = $pdo->prepare($sql);
            
            $stmt->bindValue(":idMod", $modalidade->getIdMod());
            $stmt->bindValue(":nome", $modalidade->getNome());
            $stmt->bindValue(":descricao", $modalidade->getDescricao());
       
            return $stmt->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
    
    public function recuperarModalidadePorID($idMod) {
        try {
            $pdo = conexao::getInstance();
            $sql = "SELECT * FROM modalidade c WHERE c.idMod = :idMod";
            $stmt = $pdo->prepare($sql);
            
            $stmt->bindValue(":idMod", $idMod);
            
            $stmt->execute();
            
            $modalidadeRecuperado = NULL;
           
            While ($modalidadeBanco = $stmt->fetch()) {
                $modalidade = new Modalidade();
                $modalidade->setIdMod($modalidadeBanco["idMod"]);
                $modalidade->setNome($modalidadeBanco["nome"]);
                $modalidade->setDescricao($modalidadeBanco["descricao"]);
                $modalidadeRecuperado = $modalidade;
            }
            
            return $modalidadeRecuperado;
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    public function listarModalidades() {
        try {
            $pdo = conexao::getInstance();
            $sql = "SELECT * FROM bd_co.modalidade";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $modalidades = array();

            While ($modalidadesBanco = $stmt->fetch()) {
                $modalidade = new Modalidade();
                $modalidade->setIdMod($modalidadesBanco["idMod"]);
                $modalidade->setNome($modalidadesBanco["nome"]);
                $modalidade->setDescricao($modalidadesBanco["descricao"]);
                
                $modalidades[] = $modalidade;
            }

            return $modalidades;
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

}

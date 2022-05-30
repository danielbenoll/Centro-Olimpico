<?php

require_once 'Conexao.php';
require_once __DIR__ . '\..\Endereco.php';

class EnderecoDAO {

    public function listarTodos() {
        $lista = array(1 => "Selecione o Centro Olímpico", 2 => "Centro Olimpico do Setor O", 3=> "Centro Olimpico de Ceilandia",);
        return $lista;
    }
    
    public function cadastrarEndereco($endereco) {
        try {
            $pdo = conexao::getInstance();
            $sql = "INSERT INTO endereco(cep, rua, bairro, cidade, casa)"
                             . "VALUES (:cep, :rua, :bairro, :cidade, :casa)";
            
            $stmt = $pdo->prepare($sql);
            
            $stmt->bindValue(":cep", $endereco->getCep());
            $stmt->bindValue(":rua", $endereco->getRua());
            $stmt->bindValue(":bairro", $endereco->getBairro());
            $stmt->bindValue(":cidade", $endereco->getCidade());
            $stmt->bindValue(":casa", $endereco->getCasa());
            
            $stmt->execute();
            return $pdo->lastInsertId();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            die();
        }
    }
    
    public function atualizarEndereco($endereco) {
        try {
            $sql = "UPDATE endereco SET cep = :cep, rua = :rua,"
                    . "bairro=:bairro, cidade=:cidade, casa=:casa, idEnd=:idEnd WHERE idEnd = :idEnd";
            
            
            $stmt->bindValue(":cep", $usuario->getCep());
            $stmt->bindValue(":rua", $usuario->getRua());
            $stmt->bindValue(":bairro", $usuario->getBairro());
            $stmt->bindValue(":cidade", $usuario->getCidade());
            $stmt->bindValue(":casa", $usuario->getCasa());
            $stmt->bindValue(":idEnd", $usuario->getIdEnd());
            
            return $stmt->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
    
    public function listarEndereco() {
        try {
            $pdo = conexao::getInstance();
            $sql = "SELECT * FROM bd_co.endereco";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $enderecos = array();

            While ($enderecoBanco = $stmt->fetch()) {
                $endereco = new Endereco();
                $endereco->setIdEnd($enderecoBanco["idEnd"]);
                $endereco->setCep($enderecoBanco["cep"]);
                $endereco->setRua($enderecoBanco["rua"]);
                $endereco->setBairro($enderecoBanco["bairro"]);
                $endereco->setCidade($enderecoBanco["cidade"]);
                $endereco->setCasa($enderecoBanco["casa"]);
                
                $enderecos[] = $endereco;
            }

            return $enderecos;
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

<?php
require_once 'Conexao.php';
require_once __DIR__.'\..\Inscricao.php';
require_once __DIR__.'\..\Usuario.php';
require_once __DIR__.'\..\Turma.php';

class InscricaoDAO {
    
    public function cadastrarInscricao($inscricao) {
        try {
            $pdo = conexao::getInstance();
            $sql = "INSERT INTO inscricao(dataIns, horaIns, idins, id_usu, id_tur)"
                    . "VALUES (now(), now(), :idins, :id_usu, :id_tur)";
            
            $stmt = $pdo->prepare($sql);

            $stmt->bindValue(":idins", $inscricao->getHoraIns());
            $stmt->bindValue(":id_usu", $inscricao->getIdusu());
            $stmt->bindValue(":id_tur", $inscricao->getIdtur());
         
            
            return $stmt->execute();
            
            $id =$pdo->lastInsertId();
            echo " ultimo ID $id"; 
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            die();
        }
    }
   
    public function atualizarInscricao($inscricao) {
        try {
            $pdo = conexao::getInstance();
            $sql = "UPDATE INSCRICAO SET dataIns = :dataIns, horaIns = :horaIns, idIns=:idIns   WHERE idIns = :idIns";
            
            $stmt = $pdo->prepare($sql);

            $stmt->bindValue(":idIns", $inscricao->getIdIns());
            $stmt->bindValue(":dataIns", $inscricao->getDataIns());
            $stmt->bindValue(":horaIns", $inscricao->getHoraIns());

            return $stmt->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
    public function excluirInscricao($idIns) {
        try {
            $pdo = conexao::getInstance();
            $sql = "DELETE FROM inscricao WHERE idIns = :idIns";
            
            $stmt = $pdo->prepare($sql);

            $stmt->bindValue(":idIns", $idIns);
            
            return $stmt->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    } 
        
    public function listarInscricao() {
        try {
            $pdo = conexao::getInstance();
            $sql = "SELECT nome, idins, dataIns, idtur, dias, turno FROM inscricao i inner join usuario u on u.id=i.id_usu inner join turma t on t.idtur=i.id_tur";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $Inscricoes = array();
            
            
            
            While ($inscricaoBanco = $stmt->fetch()) {
                $inscricao = new Inscricao();
                $usuario= new Usuario();
                
                $inscricao->setDias($inscricaoBanco["dias"]);
                $inscricao->setTurno($inscricaoBanco["turno"]);
                
                
                $usuario->setNome($inscricaoBanco["nome"]);
                
                $inscricao->setUsuario($usuario);
                
                

                $inscricao->setIdtur($inscricaoBanco["idtur"]);
                $inscricao->setDataIns($inscricaoBanco["dataIns"]);
                $inscricao->setIdins($inscricaoBanco["idins"]);

                $Inscricoes[] = $inscricao;
            }
            return $Inscricoes;
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
        }
    }
    public function recuperarInscricaoPorID($idIns) {
        try {
            $pdo = conexao::getInstance();
            $sql = "SELECT * FROM inscricao u WHERE u.idIns = :idIns";
            $stmt = $pdo->prepare($sql);
            
            $stmt->bindValue(":idIns", $idIns);
            
            $stmt->execute();
            
            $usuarioRecuperado = NULL;
           
            While ($inscricaoBanco = $stmt->fetch()) {
                $inscricao = new Inscricao();
                $inscricao->setDataIns($inscricaoBanco["dataIns"]);
                $inscricao->setIdins($inscricaoBanco["idins"]);
                
                $inscricaoRecuperado = $inscricao;
            }
            
            return $inscricaoRecuperado;
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
        }
    }
        
   public function pesquisarPorInscricao($idins) {
        try {
            $pdo = conexao::getInstance();
            $sql = "SELECT nome, idins, dataIns, idtur, dias, turno FROM inscricao i inner join usuario u on u.id=i.id_usu inner join turma t on t.idtur=i.id_tur"
                    . " WHERE i.idins = :idins";
 
            $stmt = $pdo->prepare($sql);
           
            $stmt->bindValue(":idins", $idins. "%");
            $stmt->execute();
   
            $Inscricoes = array();
           
            While ($inscricaoBanco = $stmt->fetch()) {
                $inscricao = new Inscricao();
                $usuario= new Usuario();
                
                $inscricao->setDias($inscricaoBanco["dias"]);
                $inscricao->setTurno($inscricaoBanco["turno"]);
                
                $usuario->setNome($inscricaoBanco["nome"]);
                
                $inscricao->setUsuario($usuario);
                
                

                $inscricao->setIdtur($inscricaoBanco["idtur"]);
                $inscricao->setDataIns($inscricaoBanco["dataIns"]);
                $inscricao->setIdins($inscricaoBanco["idins"]);

                $Inscricoes[] = $inscricao;
            }
           
            return $Inscricoes;
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
            die();
        }
    }    
   
}
?>
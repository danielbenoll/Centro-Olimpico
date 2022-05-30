<?php
require_once 'conexao.php';
require_once 'Usuario';
class ClienteDAO {

    public function cadastrarUsuario(usuario $usuario) {

    }

    public function listarCliente() {
        try {
            $pdo = conexao::getInstance();
            $sql = "SELECT * FROM usuario";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $usuarios = array();
            
            While ($usuario = $stmt->fetch()) {
                $usuarios[] = $usuario;
            }
            
            return $Clientes;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    
    
    public function excluirCliente($idCliente) {

    }

}

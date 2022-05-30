<?php
require_once 'Conexao.php';
require_once __DIR__.'\..\Usuario.php';
require_once 'EnderecoDao.php';

class UsuarioDAO {
    
    public function cadastrarUsuario($usuario) {
        try {
            $pdo = conexao::getInstance();
            $enderecoDao= new EnderecoDAO();
            $sql = "INSERT INTO usuario(nome,   login, senha, email, telefone, dataNasc, cpf, genero, perfil, celular)"
                             . "VALUES (:nome, :login, :senha, :email, :telefone, :dataNasc, :cpf, :genero, :perfil, :celular)";
            
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":nome", $usuario->getNome());
            $stmt->bindValue(":login", $usuario->getLogin());
            $stmt->bindValue(":senha", $usuario->getSenha());
            $stmt->bindValue(":email", $usuario->getEmail());
            $stmt->bindValue(":telefone", $usuario->getTelefone());
            $stmt->bindValue(":celular", $usuario->getCelular());
            $stmt->bindValue(":dataNasc", $usuario->getDataNasc());
            $stmt->bindValue(":cpf", $usuario->getCpf());
            $stmt->bindValue(":genero", $usuario->getGenero());
            $stmt->bindValue(":perfil", $usuario->getPerfil());
            $stmt->execute();
           
            $idUsuario= $pdo->lastInsertId();
            $idEndereco= $enderecoDao->cadastrarEndereco($usuario->getEndereco());

            $sql = "INSERT INTO usuario_endereco(id_usuario, id_ende)"
                 . "VALUES (:id_usuario, :id_ende)";
            
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":id_usuario", $idUsuario);
            $stmt->bindValue(":id_ende", $idEndereco);

           
            
            return  $stmt->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            die();
        }
    }
     public function fazerLogin($login, $senha) {
         
        try {
            $pdo = Conexao::getInstance();
            $sql = "SELECT id, nome, login,perfil FROM usuario u
                    WHERE u.login = :login AND u.senha = :senha";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":login", $login);
            $stmt->bindValue(":senha", $senha);
            $stmt->execute();
           
            $usuarioFetch = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuarioFetch != NULL) {
                
                $usuario = new Usuario();
                
                $usuario->setNome($usuarioFetch['nome']);
                $usuario->setPerfil($usuarioFetch['perfil']);
                $usuario->setId($usuarioFetch['id']);
                return $usuario;
            }
        } catch (Exception $exc) {
            echo "erro" . $exc->getMessage();
        }
    }
    public function atualizarUsuario($usuario) {
        try {
            $pdo = conexao::getInstance();
            $sql = "UPDATE USUARIO SET nome = :nome, login = :login,"
                    . "perfil=:perfil, senha=:senha, email=:email, telefone=:telefone, dataNasc=:dataNasc, cpf=:cpf, genero=:genero, id=:id WHERE id = :id";
            
            $stmt = $pdo->prepare($sql);

            $stmt->bindValue(":id", $usuario->getId());
            $stmt->bindValue(":nome", $usuario->getNome());
            $stmt->bindValue(":login", $usuario->getLogin());
            $stmt->bindValue(":senha", $usuario->getSenha());
            $stmt->bindValue(":email", $usuario->getEmail());
            $stmt->bindValue(":telefone", $usuario->getTelefone());
            $stmt->bindValue(":dataNasc", $usuario->getDataNasc());
            $stmt->bindValue(":cpf", $usuario->getCpf());
            $stmt->bindValue(":genero", $usuario->getGenero());
            $stmt->bindValue(":perfil", $usuario->getPerfil());            
            
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
    public function excluirUsuario($idusuario) {
        try {
            $usuario = $this->recuperarUsuarioPorID($idusuario);
            
            $idUsuario = $usuario->getId();
            $endereco = $usuario->getEndereco();
            $idEndereco = $endereco->getIdEnd();
            
            
            //exclusao associacao
            $pdo = conexao::getInstance();
            $sql = "DELETE FROM usuario_endereco WHERE id_usuario = :id and "
                    . " id_ende =:id_ende";
             
            $stmt = $pdo->prepare($sql);

            $stmt->bindValue(":id", $idUsuario);
            $stmt->bindValue(":id_ende", $idEndereco);
 
            $stmt->execute(); 

            //exclusao endereco
            $sql = "DELETE FROM endereco WHERE idEnd = :idEndereco ";
            
            $stmt = $pdo->prepare($sql);

            $stmt->bindValue(":idEndereco", $idEndereco);
            
            $stmt->execute();
        
            //exclusao usuario
            $sql = "DELETE FROM usuario WHERE id = :idUsuario ";
            
            $stmt = $pdo->prepare($sql);

            $stmt->bindValue(":idUsuario", $idUsuario);
             
            
            return $stmt->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            die();
        }
    } 
        
    public function listarUsuario() {
        try {
            $pdo = conexao::getInstance();
            $sql = "SELECT * FROM usuario";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $usuarios = array();
           
            While ($usuarioBanco = $stmt->fetch()) {
                $usuario = new Usuario();
                $usuario->setLogin($usuarioBanco["login"]);
                $usuario->setNome($usuarioBanco["nome"]);
                $usuario->setPerfil($usuarioBanco["perfil"]);
                $usuario->setId($usuarioBanco["id"]);
                $usuario->setEmail($usuarioBanco["email"]);
                $usuario->setGenero($usuarioBanco["genero"]);

                $usuarios[] = $usuario;
            }
            
            return $usuarios;
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
        }
    }
    public function recuperarUsuarioPorID($id) {
        try {
            $pdo = conexao::getInstance();
            $sql = "SELECT * FROM usuario u "
                ." inner join usuario_endereco ue on u.id = ue.id_usuario "
                ."    inner join endereco e on ue.id_ende = e.idEnd "
                ."    where id = :id";
            $stmt = $pdo->prepare($sql);

            $stmt->bindValue(":id", $id);

            $stmt->execute();
                                    
            $usuarioRecuperado = NULL;
           
            While ($usuarioBanco = $stmt->fetch()) {
                $usuario = new Usuario();
                $usuario->setLogin($usuarioBanco["login"]);
                $usuario->setNome($usuarioBanco["nome"]);
                $usuario->setPerfil($usuarioBanco["perfil"]);
                $usuario->setId($usuarioBanco["id"]);
                $usuario->setsenha($usuarioBanco["senha"]);
                $usuario->setEmail($usuarioBanco["email"]);
                $usuario->setGenero($usuarioBanco["genero"]);
                $usuario->setTelefone($usuarioBanco["telefone"]);
                $usuario->setCelular($usuarioBanco["celular"]);
                $usuario->setDataNasc($usuarioBanco["dataNasc"]);
                $usuario->setCpf($usuarioBanco["cpf"]);
                
                $endereco = new Endereco();
                $endereco->setCep($usuarioBanco["cep"]);
                $endereco->setRua($usuarioBanco["rua"]);
                $endereco->setBairro($usuarioBanco["bairro"]);
                $endereco->setCidade($usuarioBanco["cidade"]);
                $endereco->setCasa($usuarioBanco["casa"]);
                $endereco->setIdEnd($usuarioBanco["id_ende"]);
                
                $usuario->setEndereco($endereco);
                $usuarioRecuperado = $usuario;
                
            }

            return $usuarioRecuperado;
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
        }
    }
        
   public function pesquisarPorNome($nome) {
        try {
            $pdo = conexao::getInstance();
            $sql = "SELECT * FROM usuario u WHERE u.nome like :nome ";
            $stmt = $pdo->prepare($sql);
            
            $stmt->bindValue(":nome", $nome."%");
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
?>
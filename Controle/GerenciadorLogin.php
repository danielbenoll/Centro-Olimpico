<?php

require_once __DIR__ . '/../Model/DAO/UsuarioDAO.php';

class GerenciadorLogin {

    private $usuario;

    const PAGINA_ENTRADA = "entrada.php";

    private function verificarUsuario($login, $senha) {
        $usuarioDao = new UsuarioDao();
        $retorno = FALSE;
        $usuario = $usuarioDao->fazerLogin($login, $senha);

        if ($usuario != null) {
            $this->usuario = $usuario;
            $retorno = TRUE;
        }

        return $retorno;
    }

    public function efetuarLogin($usuario, $senha) {

        if ($this->verificarUsuario($usuario, $senha)) {
            session_start();
            $_SESSION["usuario"] = $usuario;
            $_SESSION["nome"] = $this->usuario->getNome();
            $_SESSION["perfil"] = $this->usuario->getPerfil();
            $_SESSION["id"] = $this->usuario->getId();
            $_SESSION["usuario_logado"] = TRUE;
            if ($_SESSION["perfil"] == "administrador") {
                header("Location:../visao/entrada.php?msg=Login Efetuado com Sucesso!");
                exit();
            }else if ($_SESSION["perfil"] == "usuario") {

                header("Location:../visao/entradaUsuario.php?msg=Login Efetuado com Sucesso!");
                exit();
            }else if ($_SESSION["perfil"] == "professor") {

                header("Location:../visao/entradaProfessor.php?msg=Login Efetuado com Sucesso!");
                exit();
            }
        } else {
            header("Location:../visao/telaLogin.php?error=1&msg=Erro ao tentar logar, usuário não encontrado.");
            exit();
        }
    }

    public function efetuarLogOut() {
        session_start();
        $_SESSION = array();
        session_destroy();
        header("Location:../visao/telaLogin.php?msg=Logout efetuado com sucesso !");
    }

    public function verificarAcessoPerfil($perfil) {
        session_start();
        //Verifica se uma variavel de sessão foi criada e se perfil na sessao bate com o passado 
        if (!isset($_SESSION["perfil"]) || $_SESSION["perfil"] != $perfil) {
            header("Location:../visao/telaLogin.php?msg=Usuário sem Permissão de Acesso.");
        }
    }

    public function verificarSessao() {
        session_start();
        //Se não tiver criar uma variavel de sessao perfil significa que não foi logado ainda
        if (!isset($_SESSION["perfil"])) {
            header("Location:../visao/telaLogin.php?msg=Usuário sem Permissão de Acesso.");
        }
    }

    public function temUsuarioLogado() {
        session_start();
        if (isset($_SESSION["usuario"]) && $_SESSION["usuario"] != "") {
            return true;
        } else {
            return false;
        }
    }

}

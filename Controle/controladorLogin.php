<?php
require_once './GerenciadorLogin.php';
$controleLogin = new GerenciadorLogin();



if (isset($_GET['acao'])){
    $acao = $_GET['acao'];

    switch ($acao) {
        case 'logar':

            $login = $_POST["login"];
            $senha = $_POST["senha"];

            $usuario = $controleLogin->efetuarLogin($login, $senha);
            
            break;
            
        case 'logout':
            
            $controleLogin->efetuarLogOut();
            
            break;            
        default:
            break;
    }
}

?>

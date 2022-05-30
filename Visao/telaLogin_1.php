<?php
require_once '../Controle/GerenciadorLogin.php';
$gererenciadorLogin = new GerenciadorLogin();

$id = "";
$nome = "";
$login = "";
$senha = "";
$email = "";
$telefone = "";
$dataNasc = "";
$cpf = "";
$genero = "";


$acao = "inserir";
$botao = "Cadastrar";
$msg = "";
if (isset($_GET["msg"])) {
    $msg = $_GET["msg"];
}
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="stylesheet" href="../css/login_estilo.css">
        <link rel="stylesheet" type="text/css" href="../css/estiloPadrao.css">
        <link rel="stylesheet" type="text/css" href="/CentroOlimpico/materialize/css/materialize.min.css" media="screen,projection"/>
        <link rel="shortcut icon" href="/CentroOlimpico/pictures/modalidade2.png"> 
    </head>
    <body>
        <div class="navbar-fixed">
            <nav>
                <div class="nav-wrapper blue darken-4">
                    <a href="/CentroOlimpico/index.php" class="brand-logo "><img class="icon" src="/CentroOlimpico/pictures/jogos-olimpicos.png"></a>
                    <ul id="nav-mobile" class="right hide-on-med-and-down">
                        <li><a class="gray white-text" style="border-radius: 10px" href="/CentroOlimpico/index.php#locais">Locais & Modalidades</a></li>
                        <li><a class="gray white-text" style="border-radius: 10px" href="/CentroOlimpico/index.php#contato">Contato</a></li>
                        
                    </ul>
                </div>
            </nav>
        </div>

        <div class="con_form">
            <div class="toggle">
                <a href="telaCadastro.php" style="text-decoration:none" color="white">Criar Conta</a>
            </div>

            <div class="formulario">
                <h2>Iniciar sessão</h2>
                <form method="POST" action="../Controle/controladorLogin.php?acao=logar">
                    <input name="login" type="text" placeholder="Login" value="" required>
                    <input name="senha" type="password" placeholder="Senha" value="" required>
                    <input type="submit" value="Iniciar sessão">
                    
                    <!--
                    <div class="reset-password">
                        <a href="#">Esqueci minha senha?</a>
                    </div>
                    -->
                    
                </form>
            </div>
        </div>

    </div>
    <script src="/CentroOlimpico/materialize/js/jquery-3.2.1.min.js"></script>
    <script src="/CentroOlimpico/materialize/js/materialize.min.js"></script>
</body>
</html>

<div class="erro>"><center><?php
if (isset($_GET["msg"])) {
    echo"<div class='row'>";
    echo"<div class='col s12 m6'>";
      echo"<div class='card'>";
        echo"<div class='card-image'>";
          echo"<img src='images/sample-1.jpg'>";
          echo"<span class='card-title'>Card Title</span>";
          echo"<a class='btn-floating halfway-fab waves-effect waves-light red'><i class='material-icons'>add</i></a>";
        echo"</div>";
        echo"<div class='card-content'>";
          echo "" . $_GET["msg"];
        echo"</div>";
      echo"</div>";
    echo"</div>";
  echo"</div>";
    
}
?>
    </center></div>
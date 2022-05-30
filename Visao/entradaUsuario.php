<?php
require_once '../Controle/GerenciadorLogin.php';
$gererenciadorLogin = new GerenciadorLogin();
$gererenciadorLogin->verificarAcessoPerfil("usuario");
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Login</title>

        <link rel="stylesheet" type="text/css" href="../css/estiloPadrao.css">
        <link rel="stylesheet" type="text/css" href="/CentroOlimpico/materialize/css/materialize.min.css" media="screen,projection"/>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="shortcut icon" href="/CentroOlimpico/pictures/modalidade2.png"> 
    </head>
    <body class=" light-blue lighten-5" style="background: url(/CentroOlimpico/pictures/WallpaperFunny.jpg); background-size: 100%">
        <div class="navbar-fixed">
            <nav>
                <div class="nav-wrapper blue darken-4">
                    <a href="/CentroOlimpico/index.php" class="brand-logo "><img class="icon" src="../pictures/jogos-olimpicos.png"></a>
                    <ul id="nav-mobile" class="right hide-on-med-and-down">
                        <li><a class="gray white-text" style="border-radius: 10px" href="/CentroOlimpico/index.php#locais">Locais & Modalidades</a></li>
                        <li><a class="gray white-text" style="border-radius: 10px" href="/CentroOlimpico/index.php#contato">Contato</a></li>                       
                        <li><a class="dropdown-trigger" style="border-radius: 10px" href="#" data-target="dropdown2">Minha Conta<i class="material-icons right">account_circle</i></a></li>
                    </ul>
                </div>
            </nav>
        </div>
    <center>

        <div class="blue">
            <!-- Dropdown Trigger -->
            <a class='dropdown-trigger btn-large' href='../Visao/formInscricao.php' data-target='dropdown1'> Inscrever-se </a>
            <ul id='dropdown2' class='dropdown-content'>

                <li><a href="/CentroOlimpico/Controle/controladorUsuario.php?acao=alterar&id=<?= $_SESSION['id'] ?>">Alterar Informações</a></li>
                <li><a href="#">Numero de Inscrições</a></li>
                <li><a href="../Controle/controladorLogin.php?acao=logout">Logout</a></li>
            </ul>
            <!-- Dropdown Structure -->

        </div>

        <div class="col s9 gray container card-panel">
            <h5>Bem vindo(a) <?= $_SESSION["nome"] ?> á tela de Usuário </h5>
        </div>

    </center>
    <script src="/CentroOlimpico/materialize/js/jquery-3.2.1.min.js"></script>   
    <script src="/CentroOlimpico/materialize/js/materialize.min.js"></script>
    <script>
        $('.dropdown-trigger').dropdown();
        $('.sidenav').sidenav();
    </script>
</body>
</html>

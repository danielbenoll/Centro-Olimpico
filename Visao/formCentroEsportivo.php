<?php
require_once '../Controle/GerenciadorLogin.php';
$gererenciadorLogin = new GerenciadorLogin();
$gererenciadorLogin->verificarAcessoPerfil("administrador");

$idCen = "";
$cidade = "";
$diretor = "";
$telefone = "";
$email = "";

$acao = "inserir";
$botao = "Cadastrar";
$msg = "";
if (isset($centro)) {
    $idCen = $centro->getIdCen();
    $cidade = $centro->getCidade();
    $diretor = $centro->getDiretor();
    $telefone = $centro->getTelefone();
    $email = $centro->getEmail();

    $acao = "atualizar";
    $botao = "Atualizar";
}
if (isset($_GET["msg"])) {
    echo'<script>alert("' . $_GET["msg"] . '");</script>';
}
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Cadastro</title>

        <link rel="stylesheet" type="text/css" href="../css/estiloPadrao.css">
        <link rel="stylesheet" type="text/css" href="/CentroOlimpico/materialize/css/materialize.min.css" media="screen,projection"/>
        <link rel="shortcut icon" href="/CentroOlimpico/pictures/modalidade2.png">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>
    <body class=" light-blue lighten-5" style="background: url(/CentroOlimpico/pictures/WallpaperFunny.jpg); background-size: 100%">
        <div class="navbar-fixed">
            <nav>
                <div class="nav-wrapper blue darken-4">
                    <a href="/CentroOlimpico/index.php" class="brand-logo "><img class="icon" src="../pictures/jogos-olimpicos.png"></a>
                    <ul id="nav-mobile" class="right hide-on-med-and-down">
                        <li><a class="gray white-text" style="border-radius: 10px" href="/CentroOlimpico/index.php#locais">Locais & Modalidades</a></li>
                        <li><a class="gray white-text" style="border-radius: 10px" href="/CentroOlimpico/index.php#contato">Contato</a></li>                       
                        <li><a class="dropdown-trigger" style="border-radius: 10px" href="#" data-target="dropdown3">Minha Conta<i class="material-icons right">account_circle</i></a></li>
                    </ul>
                </div>
            </nav>
        </div>

    <center>

        <div class="blue">

            <!-- Dropdown Trigger -->
            <a class='dropdown-trigger btn-large' href='#' data-target='dropdown1'> Usuario </a>
            <a class='dropdown-trigger btn-large' href='#' data-target='dropdown2'> Inscrição </a>
            <a class='dropdown-trigger btn-large' href='#' data-target='dropdown4'> Centro Esportivo </a>
            <a class='dropdown-trigger btn-large' href='#' data-target='dropdown5'> Turma </a>
            <a class='dropdown-trigger btn-large' href='#' data-target='dropdown6'> Modalidade </a>
            <!--<a class='dropdown-trigger btn-large' href='#' data-target='dropdown2'>Inscricao</a>
            <!-- Dropdown Structure -->
            <ul id='dropdown1' class='dropdown-content'>
                <li><a href="/CentroOlimpico/Controle/controladorUsuario.php?acao=consultar">Consultar</a></li>
                <li><a href="/CentroOlimpico/Controle/controladorUsuario.php?acao=pesquisar">Listar</a></li>
                <li><a href="/CentroOlimpico/Controle/controladorUsuario.php?acao=cadastrar">Cadastrar</a></li>
            </ul>
            <ul id='dropdown2' class='dropdown-content'>
                <li><a href="../Controle/controladorInscricao.php?acao=consultar">Consultar</a></li>
                <li><a href="../Controle/controladorInscricao.php?acao=pesquisar">Listar</a></li>
            </ul>
            <ul id='dropdown4' class='dropdown-content'>
                <li><a href="/CentroOlimpico/Controle/controladorCentroEsportivo.php?acao=consultar">Consultar</a></li>
                <li><a href="/CentroOlimpico/Controle/controladorCentroEsportivo.php?acao=pesquisar">Listar</a></li>
                <li><a href="/CentroOlimpico/Controle/controladorCentroEsportivo.php?acao=cadastrar">Cadastrar</a></li>
            </ul>
            <ul id='dropdown5' class='dropdown-content'>
                <li><a href="/CentroOlimpico/Controle/controladorTurma.php?acao=consultar">Consultar</a></li>
                <li><a href="/CentroOlimpico/Controle/controladorTurma.php?acao=pesquisar">Listar</a></li>
                <li><a href="/CentroOlimpico/Controle/controladorTurma.php?acao=cadastrar">Cadastrar</a></li>
            </ul>
            <ul id='dropdown6' class='dropdown-content'>
                <li><a href="/CentroOlimpico/Controle/controladorModalidade.php?acao=consultar">Consultar</a></li>
                <li><a href="/CentroOlimpico/Controle/controladorModalidade.php?acao=pesquisar">Listar</a></li>
                <li><a href="/CentroOlimpico/Controle/controladorModalidade.php?acao=cadastrar">Cadastrar</a></li>
            </ul>
            <ul id='dropdown3' class='dropdown-content'>

                <li><a href="/CentroOlimpico/Controle/controladorUsuario.php?acao=editar&id=<?= $_SESSION['id'] ?>">Alterar Informações</a></li>
                <li><a href="../Controle/controladorLogin.php?acao=logout">Logout</a></li>
            </ul>
        </div>
    </center>



    <?= $msg ?>
    <div class="container">
        <div class="row">
            <div class="col s12 card-panel">

                <form name="formCentroEsportivo"
                      method="POST"
                      onsubmit="return validarFormulario();"
                      action="../Controle/controladorCentroEsportivo.php?acao=<?= $acao ?>">

                    <div class="black-text"><h4><legend><center>Cadastro Centro Esportivo</center></legend></h4></div>

                    <input class="idCen" name="idCen"
                           type="hidden"
                           value="<?= $idCen ?>">

                    <div class="input-field col s12">
                        <input type="text" name="cidade" id="cidade" class="autocomplete" value="<?= $cidade ?>" required maxlength="15">
                        <label for="autocomplete-input" class="black-text">Cidade</label>

                    </div>
                    <div class="input-field col s12">
                        <input type="text" name="diretor" id="nome" class="autocomplete" value="<?= $diretor ?>" required maxlength="15">
                        <label for="autocomplete-input" class="black-text">Diretor</label>
                    </div> 

                    <div class="input-field col s12">
                        <input type="text" name="telefone" id="telefone" class="autocomplete" value="<?= $telefone ?>" required maxlength="15">
                        <label for="autocomplete-input" class="black-text">Telefone</label>

                    </div> 
                    <div class="input-field col s12">
                        <input type="email" name="email" id="autocomplete-input" class="autocomplete" value="<?= $email ?>" required maxlength="30">
                        <label for="autocomplete-input" class="black-text">E-mail</label>
                        
                    </div> 
                    <br>
                    <br>

                    <center><button class="btn " type="submit" name="submit" value="<?= $botao ?>">Cadastrar</button></center>

                    <br>
                    </div> 
                    </div>  
                    </div>       

                    <script src="/CentroOlimpico/materialize/js/jquery-3.2.1.min.js"></script>
                    <script src="/CentroOlimpico/materialize/js/jquery.mask.min.js"></script>
                    <script src="/CentroOlimpico/materialize/js/materialize.min.js"></script> 
                    <script>
                          $(document).ready(function () {
                              $('.parallax').parallax();
                              $('.scrollspy').scrollSpy();
                              $('select').formSelect();
                              $("#cpf").mask("999.999.999-99");
                              $("#cep").mask("99.999-999");
                              $("#telefone").mask("(99) 9999-9999");
                              $("#celular").mask("(99) 99999-9999");
                              $('.dropdown-trigger').dropdown();
                          });
                    </script>
                    <script type="text/javascript">
                        $(document).ready(function () {
                            $("#formCentroEsportivo").submit(function (e) {
                                if (!validarFormulario()) {
                                    e.preventDefault();
                                }
                            });

                        });

                        function validarFormulario() {

                            var retorno = true;

                            if (document.getElementById("nome").value.length < 3) {
                                alert("Informe um nome de diretor válido.");
                                retorno = false;
                            }
                            if (document.getElementById("cidade").value.length < 3) {
                                alert("Informe uma cidade Válida.");
                                retorno = false;
                            }
                            if ($("#telefone").val().length < 13) {
                                alert("Informe um telefone válido");
                               retorno = false;
                            }

                            return retorno;
                        }

                    </script>
                    </body>
                    </html>

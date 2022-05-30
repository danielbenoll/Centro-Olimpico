<?php
require_once '../Controle/GerenciadorLogin.php';
$gererenciadorLogin = new GerenciadorLogin();
$gererenciadorLogin->verificarAcessoPerfil("administrador");

$gerenciadorPesquisar = new GerenciadorPesquisa();

$listaCentro = $gerenciadorPesquisar->pesquisarCentros();
$listaModalidade = $gerenciadorPesquisar->pesquisarModalidades();

$id_mod = "";
$id_cen = "";

$acao = "inserir";
$botao = "Cadastrar";
$msg = "";
if (isset($relacao)) {
    $id_mod = $relacao->getIdMod();
    $id_cen = $relacao->getIdCen();

    $acao = "atualizar";
    $botao = "Atualizar";
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
    <body class="light-blue lighten-5">
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

                <form name="formModalidade"
                      method="POST"
                      action="../Controle/controladorModalidade.php?acao=<?= $acao ?>">

                    <div class="black-text"><h4><legend><center>Cadastro de Modalidade</center></legend></h4></div>

                    <input class="idMod" name="idMod"
                           type="hidden"
                           value="<?= $idMod ?>">

                    <div class="input-field col s12">
                        <input type="text" name="nome" id="autocomplete-input" class="autocomplete" value="<?= $nome ?>" required maxlength="20">
                        <label for="autocomplete-input" class="black-text">Nome da Modalidade</label>

                    </div>
                    <div class="input-field col s12">
                        <input type="text" name="descricao" id="autocomplete-input" class="autocomplete" value="<?= $descricao ?>" required>
                        <label for="autocomplete-input" class="black-text">Descricao da Modalidade</label>
                    </div> 
                    
                    <label><input type='select' id='turma" + j[i].idTurma + "' name='turma' value='" +
                                j[i].idTurma + "'/><span>" + j[i].nome + "   -   " + j[i].dias + "   -   " + j[i].turno + "   -   " + j[i].horario + "</span></label>
                    
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
                    </body>
                    </html>

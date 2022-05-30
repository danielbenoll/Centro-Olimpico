<?php
require_once '../Controle/GerenciadorLogin.php';
$gererenciadorLogin = new GerenciadorLogin();
$gererenciadorLogin->verificarAcessoPerfil("administrador");

if (!isset($msg)) {
    
    $msg = " ";
    
}else{
    echo'<script>alert("' .$msg. '");</script>';
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Pesquisar</title>
        <link rel="stylesheet" type="text/css" href="../css/estiloPadrao.css">
        <link rel="stylesheet" type="text/css" href="/CentroOlimpico/materialize/css/materialize.min.css" media="screen,projection"/>
        <link rel="shortcut icon" href="/CentroOlimpico/pictures/modalidade2.png"> 
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <script>
            function remover(idtur, dias, turno, faixaEtaria, horario) {
                decisao = confirm("Você realmente deseja remover o Centro Esportivo " + idtur + " ?");

                if (decisao) {
                    form = document.getElementById("formPesquisaTurma");
                    form.action = "../Controle/controladorTurma.php?acao=excluir&idtur=" + idtur;
                    form.submit();
                }
            }
            function alterar(idtur) {
                form = document.getElementById("formPesquisaTurma");
                form.action = "../Controle/controladorTurma.php?acao=editar&idtur=" + idtur;
                form.submit();
            }

        </script>
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

        <div class="col s9 gray container">
            <form name="formPesquisaTurma" id="formPesquisaTurma" action="" method="POST">
                <div class="col s12 card-panel ">
                    <table class="striped ">
                        <thead>
                            <tr>
                                <th width="10%" >Numero da Turma</th>
                                <th>Dias</th>
                                <th>Turno</th>
                                <th>Horario</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($listaTurma as $turma) {
                                echo "<tr>";
                                echo "<td><center>" . $turma->getIdtur() . "</center></td>";
                                echo "<td>" . $turma->getDias() . "</td>";
                                echo "<td>" . $turma->getTurno() . "</td>";
                                echo "<td>" . $turma->getHorario() . "</td>";

                                echo "<td><button class='btn' onclick=\"javascript:remover(" . $turma->getIdtur() . ")\">"
                                . "Remover</button>"
                                . "<button class='btn' onclick=\"javascript:alterar(" . $turma->getIdtur() . ")\">"
                                . "Editar</button></td>";
                                echo "</tr>";
                            }
                            ?>

                        </tbody>   
                    </table>
                    <br>
                    <a href="/CentroOlimpico/visao/entrada.php">Voltar</a>
                </div>
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

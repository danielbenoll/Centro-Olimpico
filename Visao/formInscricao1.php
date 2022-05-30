<?php
require_once '../Controle/GerenciadorLogin.php';
require_once '../Model/DAO/CentroDAO.php';

$gererenciadorLogin = new GerenciadorLogin();
$gererenciadorLogin->verificarAcessoPerfil("usuario");

$centroDao = new CentroDAO();
$listaCentro = $centroDao->listarTodos();

$idIns = "";
$dataIns = "";
$horaIns = "";
$senha = "";


$acao = "inserir";
$botao = "Cadastrar";
$msg = "";
if (isset($inscricao)) {
    $idIns = $inscricao->getIdIns();
    $dataIns = $inscricao->getDataIns();
    $horaIns = $inscricao->getHoraIns();
    $acao = "atualizar";
    $botao = "Atualizar";
}

if (isset($_GET["msg"])) {
    $msg = $_GET["msg"];
}
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Entrada</title>

        <link rel="stylesheet" type="text/css" href="../css/estiloPadrao.css">
        <link rel="stylesheet" type="text/css" href="/CentroOlimpico/materialize/css/materialize.min.css" media="screen,projection"/>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="shortcut icon" href="/CentroOlimpico/pictures/modalidade2.png"> 
    </head>
    <body class=" light-blue lighten-5">
        <div class="navbar-fixed">
            <nav>
                <div class="nav-wrapper blue darken-4">
                    <a href="/CentroOlimpico/index.php" class="brand-logo "><img class="icon" src="../pictures/jogos-olimpicos.png"></a>
                    <ul id="nav-mobile" class="right hide-on-med-and-down">
                        <li><a class="gray white-text" style="border-radius: 10px" href="/CentroOlimpico/index.php#locais">Locais & Modalidades</a></li>
                        <li><a class="gray white-text" style="border-radius: 10px" href="/CentroOlimpico/index.php#contato">Contato</a></li>
                        <li><a class="gray white-text" style="border-radius: 10px" href="../Controle/controladorLogin.php?acao=logout" >Logout</a></li> 
                    </ul>
                </div>
            </nav>
        </div>

    <center>

        <div class="blue">
            <!-- Dropdown Trigger -->
            <a class='dropdown-trigger btn-large' href='../Visao/formInscricao.php' data-target='dropdown1'> Inscrever-se </a>

            <!-- Dropdown Structure -->

        </div>

        <div class="col s9 gray container">
            <!-- Teal page content  -->
        </div>

    </center>
    <center><?= $msg ?></center>
    <form id="formInscricao"
          name="formInscricao"
          method="POST"
          action="../Controle/controladorInscricao.php?acao=<?= $acao ?>">
    </form>


    <input class="idIns" name="idIns"
           type="hidden"
           value="<?= $idIns ?>"><br /><br />
    <div class="container">
        <div class="row">
            <div class="col s12 ">
                <div class="card-panel ">


                    <select name ="centroEspoertivo">
                        <?php
                        /*                        foreach ($listaCentro as $centro) {
                          echo "<option value=" . $centro->getId() . ">" . $centro->getCidade() . "</option>";
                          }

                         */
                        foreach ($listaCentro as $chave => $valor) {
                            echo "<option value=" . $chave . " onchange='carregarModalidade(this.)'>" . $valor . "</option>";
                        }
                        ?>
                        <?php
                        if (isset($_POST)) {
                            
                        }
                        ?>
                    </select>

                    <!--
                    <label for="dataIns"></label>
                    <input class="dataIns black-text" name="dataIns"
                           type="date"
                           placeholder="Data"
                           value="<?= $dataIns ?>"
                           required>
            
                    <label for="horaIns"></label>
                    <input class="horaIns white-text" name="horaIns"
                           type="time"
                           placeholder="Horas"
                           value="<?= $horaIns ?>"
                           required>    
                    -->

                    <br>
                    <br>


                    <input class="submit btn" name="submit"
                           type="submit"
                           value="<?= $botao ?>">
                    <br>
                    
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>   

</div>
<a href="/CentroOlimpico/visao/entradaUsuario.php">Entrada</a>
<script src="/CentroOlimpico/materialize/js/jquery-3.2.1.min.js"></script>
<script src="/CentroOlimpico/materialize/js/jquery.mask.min.js"></script>
<script src="/CentroOlimpico/materialize/js/materialize.min.js"></script> 
<script>
    $(document).ready(function () {
        $('.parallax').parallax();
        $('.scrollspy').scrollSpy();
        $('select').formSelect();
        $("#cpf").mask("000.000.000-00");
        $('.dropdown-trigger').dropdown();
    });
</script>
</body>
</html>

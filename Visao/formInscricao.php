<?php
require_once '../Controle/GerenciadorLogin.php';
require_once '../Controle/GerenciadorPesquisa.php';
require_once '../Controle/controladorCentroEsportivo.php';

$gererenciadorLogin = new GerenciadorLogin();
$gererenciadorLogin->verificarAcessoPerfil("usuario");

$gerenciadorPesquisar = new GerenciadorPesquisa();

/*
  $gerenciadorPesquisar->pesquisarCentro();

  $centroDao = new CentroDAO();
  $listaCentro = $centroDao->listarTodos();
 */

$listaCentro = $gerenciadorPesquisar->pesquisarCentros();
$listaModalidade = $gerenciadorPesquisar->pesquisarModalidades();
$listaTurma = $gerenciadorPesquisar->pesquisarTurmas();

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
    <body class=" light-blue lighten-5" style="background: url(/CentroOlimpico/pictures/WallpaperFunny.jpg); background-size: 100%">
        <?php
        if (isset($_GET["msg"])) {
            echo'<script>alert("' . $_GET["msg"] . '");</script>';
        }
        ?>
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
                <li><a href="../Controle/controladorLogin.php?acao=logout">Logout</a></li>
            </ul>
            <!-- Dropdown Structure -->

        </div>



    </center>

    <center><?= $msg ?></center>
    <form id="formInscricao"
          name="formInscricao"
          method="POST"
          action="../Controle/controladorInscricao.php?acao=<?= $acao ?>">



        <input class="idIns" name="idIns"
               type="hidden"
               value="<?= $idIns ?>"><br /><br />
        <div class="container">
            <div class="row">
                <div class="col s12 ">
                    <div class="card-panel ">

                        <label>Escolha o Centro Esportivo</label>
                        <select name ="centroEsportivo" id="centroEsportivo">
                            <?php
                            foreach ($listaCentro as $centro) {
                                echo "<option value=" . $centro->getIdCen() . ">" . $centro->getCidade() . "</option>";
                            }

                            /*
                              foreach ($listaCentro as $chave=> $valor) {
                              echo "<option value=" . $chave . " onchange='carregarModalidade(this.)'>" . $valor . "</option>";
                              }
                             * 
                             */
                            ?>
                        </select>

                        <div id="listaModalidades"></div>

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

                        <center>
                            <input class="submit btn" name="submit"
                                   type="submit"
                                   value="<?= $botao ?>">
                        </center>
                        <a href="/CentroOlimpico/visao/entradaUsuario.php">Entrada</a>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>   
    </form>
</div>
<script src="/CentroOlimpico/materialize/js/jquery-3.2.1.min.js"></script>
<script src="/CentroOlimpico/materialize/js/jquery.mask.min.js"></script>
<script src="/CentroOlimpico/materialize/js/materialize.min.js"></script>
<script src="/CentroOlimpico/materialize/js/jquery-3.2.1.min.js"></script>   
<script src="/CentroOlimpico/materialize/js/materialize.min.js"></script>
<script>
    $('.dropdown-trigger').dropdown();
    $('.sidenav').sidenav();
</script>
<script>
    $(document).ready(function () {
        $('.parallax').parallax();
        $('.scrollspy').scrollSpy();
        $('select').formSelect();
        $("#cpf").mask("000.000.000-00");
    });
</script>
<script>
    $(function () {
        $('#centroEsportivo').change(function () {

            if ($(this).val()) {
                $('#modalidade').hide();
                console.log("antes do JSON");
                $.getJSON('/CentroOlimpico/Visao/modalidade_post.php?search=', {centroEsportivo: $(this).val(), ajax: 'true'}, function (j) {
                    console.log(j);
                    var options = '';
                    options += "<label>Escolha a Modalidade</label><br><br>"
                    for (var i = 0; i < j.length; i++) {
                        options += "<label><input type='radio' id='turma" + j[i].idTurma + "' name='turma' value='" +
                                j[i].idTurma + "'/><span>" + j[i].nome + "   -   " + j[i].dias + "   -   " + j[i].turno + "   -   " + j[i].horario + "</span></label><br>";
                    }
                    //  $('#modalidade').show();
                    $('#listaModalidades').html(options);

                }).fail(function () {
                    console.log("error");
                });


            } else {
                $('centroEsportivo').html('<option value=""> Escolha o Centro Esportivo Primeiro </option>');
            }
        })
    });
</script>
</body>
</html>

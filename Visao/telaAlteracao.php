<?php
require_once '../Controle/GerenciadorLogin.php';
$gererenciadorLogin = new GerenciadorLogin();
$gererenciadorLogin->verificarAcessoPerfil("usuario");

$id = "";
$nome = "";
$login = "";
$senha = "";
$email = "";
$telefone = "";
$celular = "";
$dataNasc = "";
$cpf = "";
$genero = "";
$perfil = "";
$cep = "";
$bairro = "";
$rua = "";
$cidade = "";
$casa = "";

$acao = "inserir";
$botao = "Cadastrar";
$msg = "";
if (isset($usuario)) {
    $id = $usuario->getId();
    $nome = $usuario->getNome();
    $login = $usuario->getLogin();
    $senha = $usuario->getSenha();
    $email = $usuario->getEmail();
    $telefone = $usuario->getTelefone();
    $celular = $usuario->getCelular();
    $dataNasc = $usuario->getDataNasc();
    $cpf = $usuario->getCpf();
    $genero = $usuario->getGenero();
    $perfil = $usuario->getPerfil();
    $endereco = $usuario->getEndereco();
    $cep = $endereco->getCep();
    $bairro = $endereco->getBairro();
    $rua = $endereco->getRua();
    $cidade = $endereco->getCidade();
    $casa = $endereco->getCasa();
    $acao = "atualizar";
    $botao = "Atualizar";
}
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Tela Alteração</title>

        <link rel="stylesheet" type="text/css" href="../css/estiloPadrao.css">
        <link rel="stylesheet" type="text/css" href="/CentroOlimpico/materialize/css/materialize.min.css" media="screen,projection"/>
        <link rel="shortcut icon" href="/CentroOlimpico/pictures/modalidade2.png">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script type="text/javascript" >

            function limpa_formulário_cep() {
                //Limpa valores do formulário de cep.
                document.getElementById('rua').value = ("");
                document.getElementById('bairro').value = ("");
                document.getElementById('cidade').value = ("");
                document.getElementById('uf').value = ("");
                document.getElementById('ibge').value = ("");
            }

            function meu_callback(conteudo) {
                if (!("erro" in conteudo)) {
                    //Atualiza os campos com os valores.
                    document.getElementById('rua').value = (conteudo.logradouro);
                    document.getElementById('bairro').value = (conteudo.bairro);
                    document.getElementById('cidade').value = (conteudo.localidade);
                    document.getElementById('uf').value = (conteudo.uf);
                    document.getElementById('ibge').value = (conteudo.ibge);
                } //end if.
                else {
                    //CEP não Encontrado.
                    limpa_formulário_cep();
                    alert("CEP não encontrado.");
                }
            }

            function pesquisacep(valor) {

                //Nova variável "cep" somente com dígitos.
                var cep = valor.replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if (validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        document.getElementById('rua').value = "...";
                        document.getElementById('bairro').value = "...";
                        document.getElementById('cidade').value = "...";
                        document.getElementById('uf').value = "...";
                        document.getElementById('ibge').value = "...";

                        //Cria um elemento javascript.
                        var script = document.createElement('script');

                        //Sincroniza com o callback.
                        script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';

                        //Insere script no documento e carrega o conteúdo.
                        document.body.appendChild(script);

                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            }
            ;

        </script>
    </head>
    <body class="light-blue lighten-5">
        <form action="/CentroOlimpico/Controle/controladorUsuario.php?acao=pesquisarNome" method="POST">
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



            <?= $msg ?>
            <div class="container">
                <div class="row">
                    <div class="col s12 card-panel">

                        <form name="formUsuario"
                              method="POST"
                              action="../Controle/controladorUsuario.php?acao=<?= $acao ?>">

                            <div class="black-text"><h4><legend><center>Tela de Alteração</center></legend></h4></div>

                            <input class="id" name="id"
                                   type="hidden"
                                   value="<?= $id ?>"

                                   <input class="origem" name="origem"
                                   type="hidden"
                                   value="admCadastro">

                            <div class="input-field col s12">
                                <input type="text" name="nome" id="autocomplete-input" class="autocomplete" value="<?= $nome ?>" required maxlength="30">
                                <label for="autocomplete-input" class="black-text">Nome</label>
                            </div>

                            <div class="input-field col s12">
                                <input type="text" name="login" id="autocomplete-input" class="autocomplete" value="<?= $login ?>" required maxlength="15">
                                <label for="autocomplete-input" class="black-text">Login</label>
                            </div>

                            <div class="input-field col s12">
                                <input type="password" name="senha" id="autocomplete-input" class="autocomplete" value="<?= $senha ?>" required maxlength="20">
                                <label for="autocomplete-input" class="black-text">Senha</label>
                            </div>   

                            <div class="input-field col s12">
                                <input type="email" name="email" id="autocomplete-input" class="autocomplete" value="<?= $email ?>" required maxlength="30">
                                <label for="autocomplete-input" class="black-text">E-mail</label>
                            </div>

                            <div class="input-field col s12">
                                <input type="text" name="telefone" id="telefone" class="autocomplete" value="<?= $telefone ?>" required maxlength="15">
                                <label for="autocomplete-input" class="black-text">Telefone</label>
                            </div>

                            <div class="input-field col s12">
                                <input type="text" name="celular" id="celular" class="autocomplete" value="<?= $celular ?>" required maxlength="15">
                                <label for="autocomplete-input" class="black-text">Celular</label>
                            </div>

                            <div class="input-field col s12">
                                <input type="text" name="cep" id="cep" class="autocomplete" value="<?= $cep ?>" required maxlength="10" onblur="pesquisacep(this.value);">
                                <label for="autocomplete-input" class="black-text">CEP</label>
                            </div>

                            <div class="input-field col s12">
                                <input type="text" name="rua" id="rua" class="autocomplete" value="<?= $rua ?>" required maxlength="45" placeholder="Rua">
                                <label for="autocomplete-input" class="black-text"></label>
                            </div>

                            <div class="input-field col s12">
                                <input type="text" name="bairro" id="bairro" class="autocomplete" value="<?= $bairro ?>" required maxlength="30" placeholder="Bairro">
                                <label for="autocomplete-input" class="black-text"></label>
                            </div>

                            <div class="input-field col s12">
                                <input type="text" name="cidade" id="cidade" class="autocomplete" value="<?= $cidade ?>" required maxlength="30" placeholder="Cidade">
                                <label for="autocomplete-input" class="black-text"></label>
                            </div>

                            <label for="Estado"</label>
                            <input name="uf" type="hidden" id="uf" size="2" />

                            <label for="IBGE"</label>
                            <input name="ibge" type="hidden" id="ibge" size="8" />

                            <div class="input-field col s12">
                                <input type="text" name="casa" id="autocomplete-input" class="autocomplete" value="<?= $casa ?>" required maxlength="5">
                                <label for="autocomplete-input" class="black-text">Casa</label>
                            </div>

                            <div class="input-field col s12">
                                <input type="date" name="dataNasc" id="autocomplete-input" class="autocomplete" value="<?= $dataNasc ?>" required maxlength="10">
                                <label for="autocomplete-input" class="black-text">Data de Nascimento</label>
                            </div>

                            <div class="input-field col s12">
                                <input type="text" name="cpf" id="cpf" class="autocomplete" value="<?= $cpf ?>" required>
                                <label for="autocomplete-input" class="black-text">CPF</label>
                            </div>

                            <div class="input-field col s12">
                                <label for="genero"></label>
                                <select name="genero" >
                                    <option value="" disabled selected>Genêro</option>
                                    <option value="m" 
                                    <?php
                                    if ($genero == "m") {
                                        echo"selected";
                                    }
                                    ?>
                                            >Masculino</option>
                                    <option value="f"
                                    <?php
                                    if ($genero == "f") {
                                        echo"selected";
                                    }
                                    ?>
                                            >Feminino</option>
                                </select>
                            </div>


                            <div class="input-field col s12">
                                <label for="perfil"></label>
                                <select name="perfil" >
                                    <option value="" disabled selected>Perfil</option>
                                    <option value="administrador"
                                    <?php
                                    if ($perfil == "administrador") {
                                        echo"selected";
                                    }
                                    ?>
                                            >Administrador</option>
                                    <option value="usuario"
                                    <?php
                                    if ($perfil == "usuario") {
                                        echo "selected";
                                    }
                                    ?>
                                            >Usuário</option>
                                </select>
                            </div>


                            <br>
                            <br>

                            <center><button class="btn " type="submit" name="submit" value="<?= $botao ?>">Cadastrar</button></center>

                        </form>
                        <br>
                    </div>
                </div>
            </div>


            <script src="/CentroOlimpico/materialize/js/jquery-3.2.1.min.js"></script>
            <script src="/CentroOlimpico/materialize/js/jquery.mask.min.js"></script>
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
                    $("#cpf").mask("999.999.999-99");
                    $("#cep").mask("99.999-999");
                    $("#telefone").mask("(99) 9999-9999");
                    $("#celular").mask("(99) 99999-9999");
                    $('.dropdown-trigger').dropdown();
                });
            </script>
    </body>
</html>

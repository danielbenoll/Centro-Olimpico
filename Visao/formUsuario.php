<?php
require_once '../Controle/GerenciadorLogin.php';
$gererenciadorLogin = new GerenciadorLogin();
$gererenciadorLogin->verificarAcessoPerfil("administrador");

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

                <form name="formCadastro"
                      id="formCadastro"
                      method="POST"
                      onsubmit="return validarFormulario();"
                      action="../Controle/controladorUsuario.php?acao=<?= $acao ?>">

                    <div class="black-text"><h4><legend><center>Cadastro</center></legend></h4></div>

                    <input class="id" name="id"
                           type="hidden"
                           value="<?= $id ?>"

                           <input class="origem" name="origem"
                           type="hidden"
                           value="admCadastro">

                    <div class="input-field col s12">
                        <input type="text" name="nome" id="nome" class="autocomplete" value="<?= $nome ?>" required maxlength="30">
                        <label for="autocomplete-input" class="black-text">Nome</label>
                    </div>

                    <div class="input-field col s12">
                        <input type="text" name="login" id="autocomplete-input" class="autocomplete" value="<?= $login ?>" required maxlength="15">
                        <label for="autocomplete-input" class="black-text">Login</label>
                    </div>

                    <div class="input-field col s12">
                        <input type="password" name="senha" id="senha" class="autocomplete" value="<?= $senha ?>" required maxlength="20">
                        <label for="autocomplete-input" class="black-text">Senha</label>
                    </div>   

                    <div class="input-field col s12">
                        <input type="email" name="email" id="email" class="autocomplete" value="<?= $email ?>" required maxlength="30">
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
                        <input type="text" name="dataNasc" id="dataNasc" class="autocomplete" value="<?= $dataNasc ?>" required maxlength="10">
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

                    <center><button class="btn" type="submit" name="submit" value="<?= $botao ?>">Cadastrar</button></center>

                </form>
                <br>
            </div>
        </div>
    </div>


    <script src="/CentroOlimpico/materialize/js/jquery-3.2.1.min.js"></script>
    <script src="/CentroOlimpico/materialize/js/jquery.mask.min.js"></script>
    <script src="/CentroOlimpico/materialize/js/materialize.min.js"></script>
    <script src="/CentroOlimpico/materialize/js/jquery.cpfcnpj.min.js"></script> 
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
                                $("#dataNasc").mask("99/99/9999");
                            });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#formCadastro").submit(function (e) {
                if (!validarFormulario()) {
                    e.preventDefault();
                }
            });

        });

        function validarFormulario() {
            var erros = 0;

            if (document.getElementById("nome").value.length < 3) {
                alert("Informe um nome válido.");
                erros++;
            }

            if (document.getElementById("email").value.indexOf("@") < 0 || document.getElementById("email").value.indexOf(".") < 0) {
                alert("Informe um e-mail válido");
                erros++;
            }

            if ($("#cpf").val().length < 14) {
                alert("Informe um CPF válido");
                erros++;
            }

            if ($("#telefone").val().length < 13) {
                alert("Informe um telefone válido");
                erros++;
            }
            
            if ($("#celular").val().length < 13) {
                alert("Informe um celular válido");
                erros++;
            }

            if (!validarData(document.getElementById("dataNasc").value)) {
                alert("Informe uma data de nascimento válida.");
                erros++;
            }

            if (document.getElementById("senha").value.length < 8) {
                alert("Informe uma senha com no mínimo 8 caracteres.");
                erros++;

            } else {
                if (document.getElementById("senha").value != document.getElementById("senha2").value) {
                    alert("Senhas diferentes! Favor digitar senhas iguais!");
                    TestaCPF
                }
            }
            if(TestaCPF(document.getElementById("cpf").value )){
                alert("CPF formatado incorretamente !");
              erros++;  
            }
            
            if (erros === 0) {
                return true;
            } else {
                return false;
            }
        }

        function validarData(data) {
            var splitData = data.split("/");

            if (splitData.length === 3) {
                if (splitData[0] >= 01 && splitData[0] <= 31) {
                    if (splitData[1] >= 01 && splitData[1] <= 12) {
                        if (splitData[2] >= 1900 && splitData[2] <= 2012) {
                            return true;
                        } else {
                            return false;
                        }
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
        /**
        function TestaCPF(strCPF) {
            var Soma;
            var Resto;
            Soma = 0;
            if (strCPF == "00000000000") return false;

            for (i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
            Resto = (Soma * 10) % 11;

            if ((Resto == 10) || (Resto == 11))  Resto = 0;
            if (Resto != parseInt(strCPF.substring(9, 10)) ) return false;

            Soma = 0;
            for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
            Resto = (Soma * 10) % 11;

            if ((Resto == 10) || (Resto == 11))  Resto = 0;
            if (Resto != parseInt(strCPF.substring(10, 11) ) ) return false;
            return true;
        }
     */   
        $(document).ready(function validaCpf() {
            $('#cpf').cpfcnpj({
                mask: false,
                validate: 'cpf',
                event: 'click',
                handler: '.btn',
                ifValid: function (input) { input.removeClass("error"); return true},
                ifInvalid: function (input) { alert('Cpf invalido!'); return false();}
            });
        });
        
    </script>
</body>
</html>

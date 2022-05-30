<?php
require_once '../Controle/GerenciadorLogin.php';
$gererenciadorLogin = new GerenciadorLogin();

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
$cep= "";
$bairro= "";
$rua= "";
$cidade="";
$casa="";

$acao = "inserir";
$botao = "Cadastrar";
$msg = "";
if (isset($_GET["msg"])) {
    echo'<script>alert("'.$_GET["msg"].'");</script>';
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
                <a href="telaLogin.php" style="text-decoration:none" color="white">Voltar</a>
            </div>
            <div class="formulario">
                <h2>Crie sua conta</h2>
                <form  method="POST" id="formCadastro" name="formCadastro"  onsubmit="ValidaCpf" action="../Controle/controladorUsuario.php?acao=<?= $acao ?>">
                    <input class="id" name="id"
                           type="hidden"
                           value="<?= $id ?>">

                    <input class="origem" name="origem"
                           type="hidden"
                           value="autoCadastro">

                    <label for="nome"></label>
                    <input class="Nome de Usuário" name="nome"
                           id="nome"
                           type="text"
                           placeholder="Nome"
                           value="<?= $nome ?>"
                           required
                           maxlength="30">

                    <label for="login"></label>
                    <input class="login" name="login"
                           type="text"
                           placeholder="Login"
                           value="<?= $login ?>"
                           required
                           maxlength="15">    

                    <label for="senha"></label>            
                    <input class="senha" name="senha"
                           type="password"
                           id="senha"
                           placeholder="Senha"
                           value="<?= $senha ?>"
                           required
                           maxlength="20">

                    <label for="email"></label>    
                    <input class="email" name="email"
                           type="email"
                           id="email"
                           placeholder="Email"
                           value="<?= $email ?>"
                           required
                           maxlength="30">

                    <label for="telefone"></label>    
                    <input class="telefone" name="telefone"
                           id="telefone"
                           type="text"
                           placeholder="Telefone"
                           value="<?= $telefone ?>">
                    
                    <label for="celular"></label>    
                    <input class="celular" name="celular"
                           id="celular"
                           type="text"
                           placeholder="Celular"
                           value="<?= $celular ?>">

                    <label for="Cep"</label>
                    <input name="cep" 
                           type="text" 
                           id="cep"
                           placeholder="CEP"
                           value="<?= $cep ?>"
                           maxlength="10"
                           onblur="pesquisacep(this.value);" />
                    
                    <label for="Rua"</label>
                    <input name="rua" 
                           type="text"
                           value="<?= $rua ?>"
                           id="rua"
                           placeholder="Rua"/>
                    
                    <label for="Bairro"</label>
                    <input name="bairro" 
                           type="text"
                           value="<?= $bairro ?>"
                           id="bairro"
                           placeholder="Bairro"/>
                    
                    <label for="Cidade"</label>
                    <input name="cidade" 
                           type="text"
                           value="<?= $cidade ?>"
                           id="cidade"
                           placeholder="Cidade"/>
                    
                    <label for="Estado"</label>
                    <input name="uf" type="hidden" id="uf" size="2" />
                    
                    <label for="IBGE"</label>
                    <input name="ibge" type="hidden" id="ibge" size="8" />
                    
                    <label for="Casa"</label>
                    <input name="casa" 
                           type="text"
                           value="<?= $casa ?>"
                           id="casa"
                           placeholder="Casa"/>
                    
                    <label for="dataNasc">Data de Nascimento</label>
                    <input class="dataNasc white-text darken-2" name="dataNasc"
                           type="text"
                           id="dataNasc"
                           placeholder="Data de Nascimento"
                           value="<?= $dataNasc ?>"
                           required
                           >

                    <br>


                    <label for="cpf"></label>
                    <input id="cpf" class="cpf" name="cpf"
                           type="text"
                           placeholder="CPF"
                           value="<?= $cpf ?>"
                           required>

                    <label for="genero"></label>
                    <div class="input-field ">
                        <select name="genero">
                            <option value="" disabled selected >Genêro</option>
                            <option value="m">Masculino</option>
                            <option value="f">Feminino</option>
                        </select>

                    </div>


                    <br>
                    <br>


                    <input class="submit" name="submit"
                           type="submit"
                           value="<?= $botao ?>">

                    <label for="perfil"></label>
                    <input class="perfil" name="perfil" value="usuario" type="hidden">

                </form>
            </div>

        </div>
        <script src="/CentroOlimpico/materialize/js/jquery-3.2.1.min.js"></script>
        <script src="/CentroOlimpico/materialize/js/jquery.mask.min.js"></script> 
        <script src="/CentroOlimpico/materialize/js/materialize.min.js"></script>   
        <script src="/CentroOlimpico/materialize/js/jquery.cpfcnpj.min.js"></script> 
        <script>
                                   $(document).ready(function () {
                                       $('select').formSelect();
                                       $("#cpf").mask("999.999.999-99");
                                       $("#cep").mask("99.999-999");
                                       $("#telefone").mask("(99) 9999-9999");
                                       $("#celular").mask("(99) 99999-9999");
                                       $("#dataNasc").mask("99/99/9999");
                                   });
        </script>
        <script type="text/javascript">
        $(document).ready(function () {        
            $("#formCadastro").submit(function (e) {
                if(!validarFormulario()){
                    e.preventDefault();
                }
            });
            
        });
        
        function validarFormulario(){
            var erros = 0;
            
            if(document.getElementById("nome").value.length < 3){
                alert("Informe um nome válido.");
                erros++;
            }
            
            if(document.getElementById("email").value.indexOf("@") < 0 || document.getElementById("email").value.indexOf(".") < 0){
                alert("Informe um e-mail válido");
                erros++;
            }
            
            if($("#cpf").val().length < 14) {
                alert("Informe um CPF válido");
                erros++;
            }
            
            if($("#telefone").val().length < 13) {
                alert("Informe um telefone/celular válido");
                erros++;
            }
            
            if(!validarData(document.getElementById("dataNasc").value)){
                alert("Informe uma data de nascimento válida.");
                erros++;
            }
            
            if(document.getElementById("senha").value.length < 8){
                alert("Informe uma senha com no mínimo 8 caracteres.");       
                erros++;
                
            }else{
                if (document.getElementById("senha").value != document.getElementById("senha2").value){
                        alert("Senhas diferentes! Favor digitar senhas iguais!");
                        erros++;
                    }
            }

            if(erros === 0){
                return true;
            }else{
                return false;
            }
        }
               
        function validarData(data){
            var splitData = data.split("/");
            
            if(splitData.length === 3){
                if(splitData[0] >= 01 && splitData[0] <= 31){
                   if(splitData[1] >= 01 && splitData[1] <= 12){
                       if(splitData[2] >= 1900 && splitData[2] <= 2012){
                           return true;
                       }else{
                           return false;
                       }
                   }else{
                       return false;
                   } 
                }else{
                    return false;
                }      
            }else{
                return false;
            }
        }
        
        $(document).ready(function ValidaCpf() {
            $('#cpf').cpfcnpj({
                mask: false,
                validate: 'cpf',
                event: 'click',
                handler: '.submit',
                ifValid: function (input) { input.removeClass("error"); },
                ifInvalid: function (input) { alert('CPF invalido!'); }
            });
        });
        </script>
    </body>
</html>

<div class="erro>"><center><?php
        if (isset($_GET["msg"])) {
            echo "" . $_GET["msg"];
        }
        ?>
    </center></div>
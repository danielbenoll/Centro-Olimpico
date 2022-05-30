<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Cadastro de Usuários</title>
        
        <link href="../css/bootstrap-datepicker.css" rel="stylesheet"/>
        <link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
   
        
        <style type="text/css">
                        [type="radio"]:not(:checked), [type="radio"]:checked {
                             position: relative; 
                             opacity: 1; 
                        }
		</style>
</head>
<body>
    <div class="container">
        <table id="tableform">
            <tr>
                <td>
                    <div class="alert alert-info">
                        <strong>CADASTRO /</strong> Usuário
                    </div>
                </td>
            </tr> 
            <tr>
                <td>
                    <form action="../controller/cadastrarUsuarioController.php" enctype="multipart/form-data" method="post" name="cadUsuarios" method="post" onsubmit=" return validaCampo();
                        return false;"> 
                        <table> 
                            <tr>
                                <td> 

                                    <label  style="font-weight: bold;">&nbspNome:</label> 

                                </td>

                                <td>  
                                    <input type="text" name="nomeUsuario" class="form-control" autocomplete="off" autofocus placeholder="Digite Seu Nome" required size="50%">   <br>                  
                                </td>  

                            </tr>

                            <tr>
                                <td>
                                    <label  style="font-weight: bold;">&nbspCPF:</label> 
                                </td>

                                <td>  
                                    <input type="text" id="cpf" name="cpf" class="form-control" onBlur="ValidarCPF(cadastro.cpf);" autocomplete="off" autofocus placeholder="Digite Seu CPF" required size="50%">      <br>             
                                </td>                            
                            </tr>

                            <tr>
                                <td>
                                    <label  style="font-weight: bold;">&nbspEmail:</label> 
                                </td>

                                <td>  
                                    <input type="email" name="emailUsuario" class="form-control" autocomplete="off" autofocus placeholder="Digite Seu E-mail" required size="50%">   <br> 
                                </td>                            
                            </tr>


                            <tr>
                                <td>
                                    <label  style="font-weight: bold;">&nbspTelefone:</label> 
                                </td>

                                <td>  
                                    <input type="text" id="telefone" name="telefone" class="form-control" autocomplete="off" autofocus placeholder="Digite Seu Telefone" required size="50%">   <br> 
                                </td>                            
                            </tr>

                            <tr>
                                <td>
                                    <label  style="font-weight: bold;">&nbspLogin:</label> 
                                </td>

                                <td>
                                    <input type="text" name="loginUsuario" class="form-control" autocomplete="off" autofocus placeholder="Digite Seu Login" required size="50%">  <br>               
                                </td>                            
                            </tr>


                            <tr>
                                <td>
                                    <label  style="font-weight: bold;">&nbspSenha:</label> 
                                </td>

                                <td>
                                    <input type="password" name="senhaUsuario" class="form-control" id="senha1" autocomplete="off" autofocus placeholder="*******" required size="50%">                   
                                </td>    
                                <td>
                                    <button type="button" onclick="mostrarSenha()" class="btn btn-default"> Mostrar / Esconder </button>
                                    </form>

                                    <script>
                                        function mostrarSenha(){
                                        var tipo = document.getElementById("senha1");
                                        if (tipo.type == "password"){
                                        tipo.type = "text";
                                        } else{
                                        tipo.type = "password";
                                        }
                                        }
                                    </script>

                                </td>
                            <br>
                            </tr>

                            <tr>
                                <td>
                                    <br>
                                    <label  style="font-weight: bold;">&nbspEstado:</label> 
                                </td>

                                <td>
                                    <br>
                                    <select name="idEstado" id="idEstado" class="form-control" >
                                        <option value="">Escolha o Estado</option>
                                        <?php
                                        require '../dao/conexao/conexao2.php';
                                        $result_estado = "SELECT * FROM estado ORDER BY nomeEstado";
                                        $resultado_estado = mysqli_query($conn, $result_estado);
                                        while ($row_cat_estado = mysqli_fetch_assoc($resultado_estado)) {
                                            echo '<option value="' . $row_cat_estado['idEstado'] . '">' . $row_cat_estado['nomeEstado'] . '</option>';
                                        }
                                        ?>
                                </td>  

                            </tr>


                            <tr>
                                <td>
                                    <br>
                                    <label  style="font-weight: bold;">&nbspCidade:</label> 
                                </td>

                                <td>
                                    <br>
                                    <select name="idCidade" id="idCidade" class="form-control" >
                                        <span class="carregando"> Aguarde, A Escolha do Estado Primeiro </span>
                                        <option value="">Escolha a Cidade</option>
                                        
                                    </select>
                                </td>    

                            </tr>
                            <script src="../js/jquery/jquery-3.3.1.min.js"></script>
		
        <script type="text/javascript">
                $(function(){
                    $('#idEstado').change(function(){
                        if ($(this).val()) {
                            $('#idCidade').hide();
                            $('.carregando').show();
                            
                                $.getJSON('/siddf/view/cidades_post.php?search=', {idEstado: $(this).val(), ajax: 'true'}, function (j) {
                                console.log("sucesso");
                                var options = '<option value="">Escolha a Cidade</option>';
                                for (var i = 0; i < j.length; i++) {
                                    options += '<option value="' + j[i].idCidade + '">' + j[i].nomeCidade + '</option>';
                                }
                                
                                $('#idCidade').show();
                                $('#idCidade').html(options).show();
                                $('.carregando').hide();
                            }) .fail(function() {
                                console.log( "error" );
                                });
                        } else {
                            $('#idCidade').html('<option value=""> Escolha o Estado Primeiro </option>');
                        }
                    });
                });
            </script> 

                            <tr>
                                <td>
                                    <br>
                                    <label  style="font-weight: bold;">&nbspNível de Acesso: </label> 
                                </td>

                                <td>  
                                    <br>
                                    <select name="perfilusuario" class="form-control">
                                        <option> Selecione </option>
                                        <?php
                                        require '../dao/conexao/conexao2.php';
                                        $result_perfis = "SELECT * FROM perfilusuario";
                                        $resultado_perfis = mysqli_query($conn, $result_perfis);
                                        while ($row_perfis = mysqli_fetch_assoc($resultado_perfis)) {
                                            ?>

                                            <option value = 
                                                    "<?php echo $row_perfis ['idperfilUsuario']; ?>">  
                                                        <?php echo $row_perfis ['nomePerfil']; ?>
                                            </option> 

                                            <?php
                                        }
                                        ?>


                                    </select> 
                                </td>                            
                            </tr>


                            <tr>
                                <td class="default">&nbsp;</td>
                                <td class="default">
                                    <br>
                                    <br>
                                    <input type="submit" value="&#xf067; Cadastrar" id="cadastrar" name="botaoCadUsuario" class="btn btn-success" action="../controller/cadastrarUsuarioController.php">    
                                    <input type="reset" value="&#xf12d; Apagar"id="apagar" name="botaoApagarUsuario" class="btn btn-info">  
                                    <input type="button" id="voltar" name="btnVolta" value="&#xf0e2; Voltar" class="btn btn-light" onclick="javascript:window.history.back()"> 
                                </td>
                            </tr>
                        </table>
                    </form>
                </td>
            </tr>
        </table>        
    </div>
</body>
</html>

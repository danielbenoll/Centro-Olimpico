
<?php

if (isset($_GET['acao'])) {
    $acao = $_GET['acao'];

    switch ($acao) {
        case 'pesquisar':
            require_once __DIR__ . '/../Model/Usuario.php';
            require_once __DIR__ . '/../Model/DAO/UsuarioDAO.php';
            $usuarioDao = new UsuarioDAO();
            $listaUsuarios = $usuarioDao->listarUsuario();


            require '../Visao/pesquisaUsuario.php';

            break;
        
        case 'pesquisarNome':
            require_once __DIR__ . '/../Model/Usuario.php';
            require_once __DIR__ . '/../Model/DAO/UsuarioDAO.php';

            $nome = $_POST["nome"];
            $usuarioDao = new UsuarioDAO();
            $listaUsuarios = $usuarioDao->pesquisarPorNome($nome);


            require_once '../Visao/pesquisaUsuario.php';

            break;

        case 'consultar':
            require_once __DIR__ . '/../Model/Usuario.php';
            require_once __DIR__ . '/../Model/DAO/UsuarioDAO.php';

            header("Location:../Visao/consultaUsuario.php");

            break;
        
        case 'consultarInscricoes':
            require_once __DIR__ . '/../Model/Usuario.php';
            require_once __DIR__ . '/../Model/DAO/UsuarioDAO.php';

            header("Location:../Visao/consultaUsuario.php");

            break;

        case 'excluir':
            require_once __DIR__ . '/../Model/Usuario.php';
            require_once __DIR__ . '/../Model/DAO/UsuarioDAO.php';

            $id = $_GET["id"];

            $usuarioDao = new UsuarioDAO();

            $usuarioDao->excluirUsuario($id);
            $listaUsuarios = $usuarioDao->listarUsuario();
            $msg = " Usuário removido com sucesso. ";
            require '../Visao/pesquisaUsuario.php';

            break;

        case 'cadastrar':
            require_once __DIR__ . '/../Model/Usuario.php';
            require_once __DIR__ . '/../Model/DAO/UsuarioDAO.php';

            require "../Visao/formUsuario.php";

            break;

        case 'editar':
            require_once __DIR__ . '/../Model/Usuario.php';
            require_once __DIR__ . '/../Model/DAO/UsuarioDAO.php';

            $id = $_GET["id"];

            $usuarioDao = new UsuarioDAO();

            $usuario = $usuarioDao->recuperarUsuarioPorID($id);
            
            $msg = " Usuário alterado com sucesso. ";
            
            require "../Visao/formUsuario.php";

            break;
        
        case 'alterar':
            require_once __DIR__ . '/../Model/Usuario.php';
            require_once __DIR__ . '/../Model/DAO/UsuarioDAO.php';

            $id = $_GET["id"];

            $usuarioDao = new UsuarioDAO();

            $usuario = $usuarioDao->recuperarUsuarioPorID($id);

            require "../Visao/telaAlteracao.php";

            break;

        case 'inserir':
            require_once __DIR__ . '/../Model/Usuario.php';
            require_once __DIR__ . '/../Model/Endereco.php';
            require_once __DIR__ . '/../Model/DAO/UsuarioDAO.php';

            $id = $_POST["id"];
            $nome = $_POST["nome"];
            $login = $_POST["login"];
            $senha = $_POST["senha"];
            $email = $_POST["email"];
            $telefone = $_POST["telefone"];
            $celular = $_POST["celular"];
            $dataNasc = $_POST["dataNasc"];
            $cpf = $_POST["cpf"];
            $genero = $_POST["genero"];
            $perfil = $_POST["perfil"];
            $origem = $_POST["origem"];
            $cep = $_POST["cep"];
            $rua = $_POST["rua"];
            $bairro = $_POST["bairro"];
            $cidade = $_POST["cidade"];
            $casa = $_POST["casa"];
            
            
            $usuario = new Usuario();

            $usuario->setId($id);
            $usuario->setNome($nome);
            $usuario->setLogin($login);
            $usuario->setSenha($senha);
            $usuario->setEmail($email);
            $usuario->setTelefone($telefone);
            $usuario->setCelular($celular);
            $usuario->setDataNasc($dataNasc);
            $usuario->setCpf($cpf);
            $usuario->setGenero($genero);
            $usuario->setPerfil($perfil);
            
            $endereco= new Endereco();
            $endereco->setCep($cep);
            $endereco->setRua($rua);
            $endereco->setBairro($bairro);
            $endereco->setCidade($cidade);
            $endereco->setCasa($casa);

            $usuario->setEndereco($endereco);
            
            $usuarioDao = new UsuarioDAO();

            $usuarioDao->cadastrarUsuario($usuario);


            if ($origem == "autoCadastro") {
                header("Location:../Visao/telaLogin.php?msg=Usuário cadastrado com sucesso!");
            } else {
                header("Location:../Visao/formUsuario.php?msg=Usuário cadastrado com sucesso!");
            }
            break;

        case 'atualizar':
            require_once __DIR__ . '/../Model/Usuario.php';
            require_once __DIR__ . '/../Model/DAO/UsuarioDAO.php';

            $id = $_POST["id"];
            $nome = $_POST["nome"];
            $login = $_POST["login"];
            $senha = $_POST["senha"];
            $email = $_POST["email"];
            $telefone = $_POST["telefone"];
            $celular = $_POST["celular"];
            $dataNasc = $_POST["dataNasc"];
            $cpf = $_POST["cpf"];
            $genero = $_POST["genero"];
            $perfil = $_POST["perfil"];

            $usuario = new Usuario();

            $usuario->setId($id);
            $usuario->setNome($nome);
            $usuario->setLogin($login);
            $usuario->setSenha($senha);
            $usuario->setEmail($email);
            $usuario->setTelefone($telefone);
            $usuario->setCelular($celular);
            $usuario->setDataNasc($dataNasc);
            $usuario->setCpf($cpf);
            $usuario->setGenero($genero);
            $usuario->setPerfil($perfil);

            $usuarioDao = new UsuarioDAO();

            $usuarioDao->atualizarUsuario($usuario);

            $listaUsuarios = $usuarioDao->listarUsuario();

            $msg = "Usuário alterado com sucesso.";

            require '../Visao/pesquisaUsuario.php';
            
           // header("Location:../Visao/pesquisaUsuario.php?msg=Usuário alterado com sucesso!");
            
            break;
        default:
            break;
    }
}
?>
                    


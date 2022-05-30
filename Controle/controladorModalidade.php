
<?php


if (isset($_GET['acao'])) {
    $acao = $_GET['acao'];

    switch ($acao) {
        case 'pesquisar':
            require_once __DIR__ . '/../Model/Modalidade.php';
            require_once __DIR__ . '/../Model/DAO/ModalidadeDAO.php';
            $modalidadeDao = new ModalidadeDAO();
            $listaModalidade = $modalidadeDao->listarModalidades();


            require '../Visao/pesquisaModalidade.php';

            break;

        case 'pesquisarModalidade':
            require_once __DIR__ . '/../Model/Modalidade.php';
            require_once __DIR__ . '/../Model/DAO/ModalidadeDAO.php';

            $nome = $_POST["nome"];
            $nomeDao = new ModalidadeDAO();
            $listaModalidade = $nomeDao->pesquisarPorModalidade($nome);


            require_once '../Visao/pesquisaModalidade.php';

            break;

        case 'consultar':
            require_once __DIR__ . '/../Model/Turma.php';
            require_once __DIR__ . '/../Model/DAO/TurmaDAO.php';

            header("Location:../Visao/consultaModalidade.php");

            break;

        case 'excluir':
            require_once __DIR__ . '/../Model/Modalidade.php';
            require_once __DIR__ . '/../Model/DAO/ModalidadeDAO.php';

            $idMod = $_GET["idMod"];

            $modalidadeDao = new ModalidadeDAO();

            $modalidadeDao->excluirModalidade($idMod);
            $listaModalidade = $modalidadeDao->listarModalidades();
            $msg = " Modalidade removida com sucesso. ";
            require '../Visao/pesquisaModalidade.php';

            break;

        case 'cadastrar':
            require_once __DIR__ . '/../Model/Modalidade.php';
            require_once __DIR__ . '/../Model/DAO/ModalidadeDAO.php';

            require "../Visao/formModalidade.php";

            break;

        case 'editar':
            require_once __DIR__ . '/../Model/Modalidade.php';
            require_once __DIR__ . '/../Model/DAO/ModalidadeDAO.php';

            $idMod = $_GET["idMod"];

            $modalidadeDao = new ModalidadeDAO();

            $modalidade = $modalidadeDao->recuperarModalidadePorID($idMod);
            
            $msg="Modalidade alterada com sucesso!";
            
            require "../Visao/formModalidade.php";

            break;

        case 'inserir':
            require_once __DIR__ . '/../Model/Modalidade.php';
            require_once __DIR__ . '/../Model/DAO/ModalidadeDAO.php';

            $idMod = $_POST["idMod"];
            $nome = $_POST["nome"];
            $descricao = $_POST["descricao"];
            
            $modalidadeDao = new ModalidadeDAO();
            $modalidade= new Modalidade();
            
            $modalidade->setIdMod($idMod);
            $modalidade->setNome($nome);
            $modalidade->setDescricao($descricao);
                        
            $modalidadeDao->cadastrarModalidade($modalidade);
            
            header("Location:../Visao/formModalidade.php?msg=Modalidade cadastrada com sucesso!");
            
            break;

        case 'atualizar':
            require_once __DIR__ . '/../Model/Modalidade.php';
            require_once __DIR__ . '/../Model/DAO/ModalidadeDAO.php';

            $idMod = $_POST["idMod"];
            $nome = $_POST["nome"];
            $descricao = $_POST["descricao"];
            
            $modalidade = new Modalidade();

            $modalidade->setIdMod($idMod);
            $modalidade->setNome($nome);
            $modalidade->setDescricao($descricao);
            
            $modalidadeDao = new ModalidadeDAO();

            $modalidadeDao->atualizarModalidade($modalidade);

            $listaModalidade = $modalidadeDao->listarModalidades();

            $msg = "Modalidade alterada com sucesso.";

            require '../Visao/pesquisaModalidade.php';

            break;
        default:
            break;
    }
}
?>
                    


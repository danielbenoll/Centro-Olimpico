
<?php


if (isset($_GET['acao'])) {
    $acao = $_GET['acao'];

    switch ($acao) {
        case 'pesquisar':
            require_once __DIR__ . '/../Model/CentroEsportivo.php';
            require_once __DIR__ . '/../Model/DAO/centroDAO.php';
            $centroDao = new CentroDAO();
            $listaCentro = $centroDao->listarCentros();


            require '../Visao/pesquisaCentro.php';

            break;

        case 'pesquisarCidade':
            require_once __DIR__ . '/../Model/CentroEsportivo.php';
            require_once __DIR__ . '/../Model/DAO/CentroDAO.php';

            $centro = $_POST["centro"];
            $centroDao = new CentroDAO();
            $listaCentro = $centroDao->pesquisarPorCentro($centro);


            require_once '../Visao/pesquisaCentro.php';

            break;

        case 'consultar':
            require_once __DIR__ . '/../Model/CentroEsportivo.php';
            require_once __DIR__ . '/../Model/DAO/CentroDAO.php';

            header("Location:../Visao/consultaCentroEsportivo.php");

            break;

        case 'excluir':
            require_once __DIR__ . '/../Model/CentroEsportivo.php';
            require_once __DIR__ . '/../Model/DAO/CentroDAO.php';

            $idCen = $_GET["idCen"];

            $centroDao = new CentroDAO();

            $centroDao->excluirCentro($idCen);
            $listaCentro = $centroDao->listarCentros();
            $msg = " Centro Esportivo removido com sucesso. ";
            require '../Visao/pesquisaCentro.php';

            break;

        case 'cadastrar':
            require_once __DIR__ . '/../Model/CentroEsportivo.php';
            require_once __DIR__ . '/../Model/DAO/CentroDAO.php';

            require "../Visao/formCentroEsportivo.php";

            break;

        case 'editar':
            require_once __DIR__ . '/../Model/CentroEsportivo.php';
            require_once __DIR__ . '/../Model/DAO/CentroDAO.php';

            $idCen = $_GET["idCen"];

            $centroDao = new CentroDAO();

            $centro = $centroDao->recuperarCentroPorID($idCen);
            
            $msg="Centro Esportivo alterado com sucesso!";
            
            require "../Visao/formCentroEsportivo.php";

            break;

        case 'inserir':
            require_once __DIR__ . '/../Model/CentroEsportivo.php';
            require_once __DIR__ . '/../Model/DAO/CentroDAO.php';

            $idCen = $_POST["idCen"];
            $cidade = $_POST["cidade"];
            $diretor = $_POST["diretor"];
            $telefone = $_POST["telefone"];
            $email = $_POST["email"];
            
            $centroDao = new CentroDAO();
            $centro= new CentroEsportivo();
            
            $centro->setIdCen($idCen);
            $centro->setCidade($cidade);
            $centro->setDiretor($diretor);
            $centro->setTelefone($telefone);
            $centro->setEmail($email);
            
            
            $centroDao->cadastrarCentroEsportivo($centro);
            
            header("Location:../Visao/formCentroEsportivo.php?msg=Centro Esportivo cadastrado com sucesso!");
            
            break;

        case 'atualizar':
            require_once __DIR__ . '/../Model/CentroEsportivo.php';
            require_once __DIR__ . '/../Model/DAO/CentroDAO.php';

            $idCen = $_POST["idCen"];
            $cidade = $_POST["cidade"];
            $diretor = $_POST["diretor"];
            $email = $_POST["email"];
            $telefone = $_POST["telefone"];
            
            $centro = new CentroEsportivo();

            $centro->setIdCen($idCen);
            $centro->setCidade($cidade);
            $centro->setDiretor($diretor);
            $centro->setEmail($email);
            $centro->setTelefone($telefone);

            $centroDao = new CentroDAO();

            $centroDao->atualizarCentro($centro);

            $listaCentro = $centroDao->listarCentros();

            $msg = "Centro Esportivo alterado com sucesso.";

            require '../Visao/pesquisaCentro.php';

            break;
        default:
            break;
    }
}
?>
                    


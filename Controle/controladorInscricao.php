
<?php

if (isset($_GET['acao'])) {
    $acao = $_GET['acao'];

    switch ($acao) {
        case 'pesquisar':
            require_once __DIR__ . '/../Model/Inscricao.php';
            require_once __DIR__ . '/../Model/DAO/InscricaoDAO.php';
            $inscricaoDao = new InscricaoDAO();
            $listaInscricao = $inscricaoDao->listarInscricao();


            require '../Visao/pesquisaInscricao.php';

            break;

        case 'pesquisarInscricao':
            require_once __DIR__ . '/../Model/Inscricao.php';
            require_once __DIR__ . '/../Model/DAO/InscricaoDAO.php';

            $idins = $_POST["idins"];
            $inscricaoDao = new InscricaoDAO();
            $listaInscricao = $inscricaoDao->pesquisarPorInscricao($idins);


            require '../Visao/pesquisaInscricao.php';

            break;

        case 'consultar':
            require_once __DIR__ . '/../Model/Inscricao.php';
            require_once __DIR__ . '/../Model/DAO/InscricaoDAO.php';

            header("Location:../Visao/consultaInscricao.php");

            break;

        case 'excluir':
            require_once __DIR__ . '/../Model/Inscricao.php';
            require_once __DIR__ . '/../Model/DAO/InscricaoDAO.php';

            $idIns = $_GET["idIns"];

            $inscricaoDao = new InscricaoDAO();

            $inscricaoDao->excluirInscricao($idIns);
            $listaInscricao = $inscricaoDao->listarInscricao();
            $msg = " Inscrição removida com sucesso. ";
            require '../Visao/pesquisaInscricao.php';

            break;

        case 'cadastrar':
            require_once __DIR__ . '/../Model/Inscricao.php';
            require_once __DIR__ . '/../Model/DAO/InscricaoDAO.php';

            require '../Visao/formInscricao.php';

            break;

        case 'editar':
            require_once __DIR__ . '/../Model/Inscricao.php';
            require_once __DIR__ . '/../Model/DAO/InscricaoDAO.php';

            $idIns = $_GET["idIns"];

            $inscricaoDao = new InscricaoDAO();

            $inscricao = $inscricaoDao->recuperarInscricaoPorID($idIns);

            require '../Visao/pesquisaInscricao.php';

            break;

        case 'inserir':
            require_once __DIR__ . '/../Model/Inscricao.php';
            require_once __DIR__ . '/../Model/DAO/InscricaoDAO.php';

            session_start();
            $idIns = $_POST["idIns"];
            $idTur = $_POST["turma"];
            $dataIns = $_POST["dataIns"];
            $horaIns = $_POST["horaIns"];
            $idusu = $_SESSION['id'];

            $inscricao = new Inscricao();

            $inscricao->setIdIns($idIns);
            $inscricao->setIdtur($idTur);

            $inscricao->setIdusu($idusu);
            $inscricao->setDataIns($dataIns);
            $inscricao->setHoraIns($horaIns);


            $inscricaoDao = new InscricaoDAO();

            $inscricaoDao->cadastrarInscricao($inscricao);



            header("Location:../Visao/formInscricao.php?msg=Inscricao cadastrada com sucesso!");

            break;

        case 'atualizar':
            require_once __DIR__ . '/../Model/Inscricao.php';
            require_once __DIR__ . '/../Model/DAO/InscricaoDAO.php';

            $idIns = $_POST["idIns"];
            $dataIns = $_POST["dataIns"];
            $horaIns = $_POST["horaIns"];


            $inscricao = new Inscricao();

            $inscricao->setIdIns($idIns);
            $inscricao->setDataIns($dataIns);
            $inscricao->setHoraIns($horaIns);

            $inscricaoDao = new InscricaoDAO();

            $inscricaoDao->atualizarInscricao($inscricao);

            $listaInscricao = $inscricaoDao->listarInscricao();

            $msg = "Inscricao alterada com sucesso.";

            require '../Visao/pesquisaInscricao.php';

            break;
        default:
            break;
    }
}
?>
              

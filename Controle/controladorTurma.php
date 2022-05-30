
<?php


if (isset($_GET['acao'])) {
    $acao = $_GET['acao'];

    switch ($acao) {
        case 'pesquisar':
            require_once __DIR__ . '/../Model/Turma.php';
            require_once __DIR__ . '/../Model/DAO/TurmaDAO.php';
            $turmaDao = new TurmaDAO();
            $listaTurma = $turmaDao->listarTurmas();


            require '../Visao/pesquisaTurma.php';

            break;
        
        case 'relacionar':
            require_once __DIR__ . '/../Model/Turma.php';
            require_once __DIR__ . '/../Model/DAO/TurmaDAO.php';
            
            $turmaDao = new TurmaDAO();
            $listaTurma = $turmaDao->relacionarTurma();


            require '../Visao/pesquisaTurma.php';

            break;

        case 'pesquisarTurma':
            require_once __DIR__ . '/../Model/Turma.php';
            require_once __DIR__ . '/../Model/DAO/TurmaDAO.php';

            $idtur = $_POST["idtur"];
            $turmaDao = new TurmaDAO();
            $listaTurma = $turmaDao->pesquisarPorTurma($idtur);


            require_once '../Visao/pesquisaTurma.php';

            break;

        case 'consultar':
            require_once __DIR__ . '/../Model/Turma.php';
            require_once __DIR__ . '/../Model/DAO/TurmaDAO.php';

            header("Location:../Visao/consultaTurma.php");

            break;

        case 'excluir':
            require_once __DIR__ . '/../Model/Turma.php';
            require_once __DIR__ . '/../Model/DAO/TurmaDAO.php';

            $idtur = $_GET["idtur"];

            $turmaDao = new TurmaDAO();

            $turmaDao->excluirTurma($idtur);
            $listaTurma = $turmaDao->listarTurmas();
            $msg = " Turma removida com sucesso. ";
            require '../Visao/pesquisaTurma.php';

            break;

        case 'cadastrar':
            require_once __DIR__ . '/../Model/Turma.php';
            require_once __DIR__ . '/../Model/DAO/TurmaDAO.php';

            require "../Visao/formTurma.php";

            break;

        case 'editar':
            require_once __DIR__ . '/../Model/Turma.php';
            require_once __DIR__ . '/../Model/DAO/TurmaDAO.php';

            $idtur = $_GET["idtur"];

            $turmaDao = new TurmaDAO();

            $turma = $turmaDao->recuperarTurmaPorID($idtur);
            
            $msg="Turma alterada com sucesso!";
            
            require "../Visao/formTurma.php";

            break;

        case 'inserir':
            require_once __DIR__ . '/../Model/Turma.php';
            require_once __DIR__ . '/../Model/DAO/TurmaDAO.php';

            $idtur = $_POST["idtur"];
            $dias = $_POST["dias"];
            $turno = $_POST["turno"];
            $faixaEtaria = $_POST["faixaEtaria"];
            $horario = $_POST["horario"];
            
            $turmaDao = new TurmaDAO();
            $turma= new Turma();
            
            $turma->setIdtur($idtur);
            $turma->setDias($dias);
            $turma->setTurno($turno);
            $turma->setFaixaEtaria($faixaEtaria);
            $turma->setHorario($horario);
            
            
            $turmaDao->cadastrarTurma($turma);
            
            header("Location:../Visao/formTurma.php?msg=Turma cadastrada com sucesso!");
            
            break;

        case 'atualizar':
            require_once __DIR__ . '/../Model/Turma.php';
            require_once __DIR__ . '/../Model/DAO/TurmaDAO.php';

            $idtur = $_POST["idtur"];
            $dias = $_POST["dias"];
            $turno = $_POST["turno"];
            $faixaEtaria = $_POST["faixaEtaria"];
            $horario = $_POST["horario"];
            
            $turma = new Turma();

            $turma->setIdtur($idtur);
            $turma->setDias($dias);
            $turma->setTurno($turno);
            $turma->setFaixaEtaria($faixaEtaria);
            $turma->setHorario($horario);

            $turmaDao = new TurmaDAO();

            $turmaDao->atualizarTurma($turma);

            $listaTurma = $turmaDao->listarTurmas();

            $msg = "Turma alterada com sucesso.";

            require '../Visao/pesquisaTurma.php';

            break;
        default:
            break;
    }
}
?>
                    


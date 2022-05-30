<?php
require_once ("../Model/DAO/Conexao.php");
        
    $pdo= Conexao::getInstance();
    
    $centroEsportivo= $_REQUEST['centroEsportivo'];
    //$centroEsportivo= $_GET['centroEsportivo'];
    $result_sub_cat = "select * from turma t inner join modalidade m  on m.idMod= t.id_mod 	where t.id_cen=$centroEsportivo";
    
    foreach ($pdo->query($result_sub_cat) as $row_sub_cat){
        $modalidade_post[] = array(
            'idTurma' => $row_sub_cat['idtur'],
            'dias' => ($row_sub_cat['dias']),
            'turno' => ($row_sub_cat['turno']),
            'faixaEtaria' => ($row_sub_cat['faixaEtaria']),
            'horario' => ($row_sub_cat['horario']),
            'nome' => ($row_sub_cat['nome']),
            
        );
    }
    echo(json_encode($modalidade_post));
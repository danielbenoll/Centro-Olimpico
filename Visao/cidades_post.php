<?php
require_once("../dao/conexao/conexao.php"); 

        $conn= Conexao::getInstance();

        $idEstado= $_REQUEST['idEstado'];
	//$idEstado= $_GET['idEstado'];
	$result_sub_cat = "SELECT * FROM cidade WHERE Estado_idEstado = $idEstado ORDER BY nomeCidade";
	
        
        foreach ($conn->query($result_sub_cat) as $row_sub_cat) {
		$cidades_post[] = array(
			'idCidade'	=> $row_sub_cat['idCidade'],
			'nomeCidade' => ($row_sub_cat['nomeCidade']),
		);
        }
//	;
//	while ($row_sub_cat = mysqli_fetch_assoc($resultado_sub_cat) ) {
//		$cidades_post[] = array(
//			'idCidade'	=> $row_sub_cat['idCidade'],
//			'nomeCidade' => ($row_sub_cat['nomeCidade']),
//		);
//	}
//	
        //print_r($cidades_post);
	echo(json_encode($cidades_post));
?>


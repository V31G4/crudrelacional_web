<?php
    require_once('inc.connect.php');

    //echo $_POST;

    //(isset($_POST['acao']) and !empty($_POST['acao'])) ?$acao = $_POST['acao']:$erro = TRUE;
    (isset($_REQUEST['acao']) and !empty($_REQUEST['acao'])) ? $acao = $_REQUEST['acao'] : $erro = TRUE;

    (isset($_POST['id_consulta']) and !empty($_POST['id_consulta']))? $id_consulta = $_POST['id_consulta'] : $erro = TRUE;
    (isset($_POST['id_clinica']) and !empty($_POST['id_clinica']))? $id_clinica = $_POST['id_clinica'] : $erro = TRUE;

    //campos consulta
    (isset($_POST['paciente']) and !empty($_POST['paciente'])) ?$paciente = $_POST['paciente']:$erro = TRUE;
    (isset($_POST['medico']) and !empty($_POST['medico'])) ?$medico = $_POST['medico']:$erro = TRUE; 
    (isset($_POST['datasolicitacao']) and !empty($_POST['datasolicitacao'])) ?$datasolicitacao = $_POST['datasolicitacao']:$erro = TRUE;
    (isset($_POST['dataconsulta']) and !empty($_POST['dataconsulta'])) ?$dataconsulta = $_POST['dataconsulta']:$erro = TRUE;
    (isset($_POST['horarioconsulta']) and !empty($_POST['horarioconsulta'])) ?$horarioconsulta = $_POST['horarioconsulta']:$erro = TRUE;
    (isset($_POST['dataconfirmacao']) and !empty($_POST['dataconfirmacao'])) ?$dataconfirmacao = $_POST['dataconfirmacao']:$erro = TRUE;
    (isset($_POST['valor']) and !empty($_POST['valor'])) ?$valor = $_POST['valor']:$erro = TRUE;
    (isset($_POST['pagamento']) and !empty($_POST['pagamento'])) ?$pagamento = $_POST['pagamento']:$erro = TRUE;
    (isset($_POST['observacoes']) and !empty($_POST['observacoes'])) ?$observacoes = $_POST['observacoes']:$erro = TRUE;

    switch ($acao) {
		case 'insert':

            $query = 'INSERT INTO consultas (id_paciente, 
                                            id_medico,   
                                            data_solicitacao,    
                                            data_consulta,   
                                            horario_consulta,    
                                            data_confirmacao,
                                            id_clinica,
                                            valor,
                                            forma_pagamento,
                                            observacao) 
            VALUES("'.$paciente.'",
                   "'.$medico.'",
                   "'.$datasolicitacao.'",
                   "'.$dataconsulta.'",
                   "'.$horarioconsulta.'",
                   "'.$dataconfirmacao.'",
                   "'.$id_clinica.'",
                   "'.$valor.'",
                   "'.$pagamento.'",
                   "'.$observacoes.'")';
            
            $res1 = !mysqli_query($link, $query);

            if($res1){
                $msg='erro';
            }elseif($res2){
                $msg='erro';
            }else{
                $msg = 'cadastrado';
            }
            break;

		case 'update':

			$query = 'UPDATE consultas  SET id_paciente ="'.$paciente.'", 
                                            id_medico ="'.$medico.'", 
                                            data_solicitacao ="'.$datasolicitacao.'", 
                                            data_consulta ="'.$dataconsulta.'",
                                            horario_consulta ="'.$horarioconsulta.'", 
                                            data_confirmacao ="'.$dataconfirmacao.'",
                                            id_clinica ="'.$id_clinica.'",
                                            forma_pagamento ="'.$pagamento.'",
                                            valor ="'.$valor.'",
                                            observacao ="'.$observacoes.'"
                                            where id_consulta = '.$id_consulta;
            $res1 = !mysqli_query($link, $query);
             if($res1){
                $msg='erro';
            }elseif($res2){
                $msg='erro';
            }else{
                $msg = 'alterado';
            }

			break;

		case 'delete':
            (isset($_GET['id_consulta']) and !empty($_GET['id_consulta']))? $id_consulta = $_GET['id_consulta'] : $erro = TRUE;

            $query = 'DELETE FROM consultas
                      WHERE id_consulta = '.$id_consulta;
        
            $res = !mysqli_query($link, $query);

            if($res){
                $msg='erro';
            }else{
                $msg = 'deletado';
            }            
			break;
	}
    mysqli_close($link);
    header("location:index.php?pg=consulta&msg=".$msg);
    ?>


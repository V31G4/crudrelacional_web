<?php

    require_once('inc.connect.php');

	(isset($_POST['nome']) and !empty($_POST['nome'])) ?$nome = $_POST['nome']:$erro = TRUE;
    (isset($_POST['celular']) and !empty($_POST['celular'])) ?$celular = $_POST['celular']:$erro = TRUE;
    (isset($_POST['telefone']) and !empty($_POST['telefone'])) ?$telefone = $_POST['telefone']:$erro = TRUE;
    (isset($_POST['email']) and !empty($_POST['email'])) ?$email = $_POST['email']:$erro = TRUE;
    (isset($_POST['uf']) and !empty($_POST['uf'])) ?$uf = $_POST['uf']:$erro = TRUE;
	(isset($_REQUEST['acao']) and !empty($_REQUEST['acao'])) ? $acao = $_REQUEST['acao'] : $erro = TRUE;
	(isset($_REQUEST['id_paciente']) and !empty($_REQUEST['id_paciente']))? $id_paciente = $_REQUEST['id_paciente'] : $erro = TRUE;

	$data_agora = date("YmdHis");
	$dir = 'img/pacientes/';
		
	switch ($acao) {

		case 'insert':

			$query = 'INSERT INTO pacientes (nome, celular, telefone, email, uf) VALUES("'.$nome.'","'.$celular.'","'.$telefone.'","'.$email.'","'.$uf.'")';
            $erro = !mysqli_query($link, $query);
            if($erro){
				$msg='erro';
			}else{
				$msg = 'cadastrado';
			}
			break;

		case 'update':

			$query = 'UPDATE pacientes SET nome ="'.$nome.'", celular = "'.$celular.'",telefone = "'.$telefone.'",email = "'.$email.'",uf = "'.$uf.'" where id_paciente = '.$id_paciente;
			
			$erro = !mysqli_query($link, $query);
			if($erro){
				$msg='erro';
			}else{
				$msg = 'alterado';
			}
			break;

		case 'delete':
		
			(isset($_GET['id_paciente']) and !empty($_GET['id_paciente']))? $id_paciente = $_GET['id_paciente'] : $erro = TRUE;
            $query = 'DELETE FROM pacientes
                      WHERE id_paciente = '.$id_paciente;
            $res = !mysqli_query($link,$query);

            if($res){
                $msg='erro';
            }else{
                $msg = 'deletado';
            }            
			break;
	}

	mysqli_close($link);
	header("location:index.php?pg=paciente&msg=".$msg);

?>
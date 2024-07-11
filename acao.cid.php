<?php

    require_once('inc.connect.php');

	(isset($_POST['ds_cid']) and !empty($_POST['ds_cid'])) ?$ds_cid = $_POST['ds_cid']:$erro = TRUE;
    (isset($_POST['observacao']) and !empty($_POST['observacao'])) ?$observacao = $_POST['observacao']:$erro = TRUE;
	(isset($_REQUEST['acao']) and !empty($_REQUEST['acao'])) ? $acao = $_REQUEST['acao'] : $erro = TRUE;
	(isset($_REQUEST['id_cid']) and !empty($_REQUEST['id_cid']))? $id_cid = $_REQUEST['id_cid'] : $erro = TRUE;

	$data_agora = date("YmdHis");
		
	switch ($acao) {

		case 'insert':

			$query = 'INSERT INTO cid (ds_cid, observacao) VALUES("'.$ds_cid.'","'.$observacao.'")';
            $erro = !mysqli_query($link, $query);
            if($erro){
				$msg='erro';
			}else{
				$msg = 'cadastrado';
			}
			break;

		case 'update':

			$query = 'UPDATE cid SET ds_cid ="'.$ds_cid.'", observacao = "'.$observacao.'" where id_cid = '.$id_cid;
			
			$erro = !mysqli_query($link, $query);
			if($erro){
				$msg='erro';
			}else{
				$msg = 'alterado';
			}
			break;

		case 'delete':
		
			(isset($_GET['id_cid']) and !empty($_GET['id_cid']))? $id_cid = $_GET['id_cid'] : $erro = TRUE;
            $query = 'DELETE FROM cid
                      WHERE id_cid = '.$id_cid;
            $res = !mysqli_query($link,$query);

            if($res){
                $msg='erro';
            }else{
                $msg = 'deletado';
            }            
			break;
	}

	mysqli_close($link);
	header("location:index.php?pg=cid&msg=".$msg);

?>
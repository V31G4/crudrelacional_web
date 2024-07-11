<?php

$acao = 'insert';

if (isset($_REQUEST['id_update']) && !empty($_REQUEST['id_update'])) {
    $id_cid = intval($_REQUEST['id_update']);
} else {
    $id_cid = 0;
}

$ds_cid = '';
$observacao = '';

if ($id_cid > 0) {
    $acao = 'update';

    $query = 'SELECT ds_cid, observacao FROM cid WHERE id_cid = ' . $id_cid;
    $res = mysqli_query($link, $query);
    if ($res) {
        $rows = mysqli_num_rows($res);
        if ($rows > 0) {
            $linha = mysqli_fetch_assoc($res);
            $ds_cid = $linha['ds_cid'];
            $observacao = $linha['observacao'];
        }
    } else {
        echo "Erro na consulta: " . mysqli_error($link);
    }
}

$valor_botao = ($acao == 'insert') ? 'Cadastrar' : 'Alterar';

	echo '<form action="acao.cid.php" method="POST" enctype="multipart/form-data">
	<table class="table table-condensed table-striped table-bordered table-hover">
	<input type="hidden" name="acao" value="'.$acao.'">
	<input type="hidden" name="id_cid" value="'.$id_cid.'">    
	<tr>
	    <td colspan="2" align="center"><h4>'.$valor_botao.' CID</h4></td>
	</tr>
	<tr>
	    <td>Nome:</td>
	    <td><input type="text" name="ds_cid" value="'.$ds_cid.'" size="30"></td>
	</tr>
	<tr>
	    <td>Observação:</td>
	    <td><input type="text" name="observacao" value="'.$observacao.'" size="30"></td>
	</tr>
	</table>
	<input type="submit" name="cadastrar" class="btn btn-success" style="font-size: 1.5rem;" value="'.$valor_botao.' CID">
	</form>';
	?>
	<hr>
	<table class="table table-condensed table-striped table-bordered table-hover" border="1px">
	    <tr>
	        <td colspan="8" align="center"><h4>CIDs Cadastrados</h4></td>
	    </tr>
	    <tr align="center">
	        <td>Nome</td>
	        <td>Observação</td>
	        <td>Ações</td>
	    </tr>
	    <?php
	    $query = 'SELECT id_cid, ds_cid, observacao FROM cid ORDER BY ds_cid';
	    $res = mysqli_query($link, $query);
	    if ($res) {
	        $qtd = mysqli_num_rows($res);
	        if ($qtd > 0) {
	            while ($linha = mysqli_fetch_assoc($res)) {
	                echo '<tr>';
	                echo '<td>' . $linha['ds_cid'] . '</td>';
	                echo '<td>' . $linha['observacao'] . '</td>';
	                echo '<td><a href="index.php?pg=cid&id_update=' . $linha['id_cid'] . '" class="btn btn-primary"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
	                <a href="acao.cid.php?acao=delete&id_cid=' . $linha['id_cid'] . '" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></td>';
	                echo '</tr>';
	            }
	        } else {
	            echo '<tr align="center">
	            <td colspan="8">Nenhum registro para listar</td>
	            </tr>';
	        }
	    } else {
	        echo "Erro na consulta: " . mysqli_error($link);
	    }
    	?>
</table>
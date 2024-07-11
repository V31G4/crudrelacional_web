<?php

$acao='insert';

	if (isset($_REQUEST['id_update']) and !empty($_REQUEST['id_update'])) {
		$id_paciente = $_REQUEST['id_update'] ;
	}else{
		$id_paciente = 0;
	}

	$nome = '';
   	$celular = '';
   	$telefone = '';
   	$email = '';
	$uf = '';

	if ($id_paciente > 0) {

		$acao='update';

		$query='SELECT nome, celular, telefone, email, uf
							FROM pacientes
							where id_paciente ='.$id_paciente;
		$res = mysqli_query($link,$query);
	    $rows=mysqli_num_rows($res);

	   if ($rows > 0) {

		 $linha = mysqli_fetch_assoc($res);
		 $nome = $linha['nome'];
		 $celular = $linha['celular'];
		 $telefone = $linha['telefone'];
		 $email = $linha['email'];
		 $uf = $linha['uf'];
	   }   
	 }

	 if($acao=='insert'){
		 $valor_botao = 'Cadastrar';
	 }else if($acao=='update'){
		$valor_botao = 'Alterar';
	 }

	echo '<form action="acao.paciente.php" width="100%" method="POST" enctype="multipart/form-data">
	<table class="table table-condensed table-striped table-bordered table-hover">
	<input type="hidden" name="acao" value="'.$acao.'">
	<input type="hidden" name="id_paciente" value="'.$id_paciente.'">	
	<tr>
		<td colspan="2" align="center"><h4>'.$valor_botao.' Paciente</h4></td>
	</tr>
	<tr>
		<td>Nome:</td>
		<td><input type="text" name="nome" value="'.$nome.'" size="30"></td>
	</tr>
	<tr>
		<td>Celular:</td>
		<td><input type="text" name="celular" value="'.$celular.'" size="30"></td>
	</tr>
	
	<tr>
		<td>Telefone:</td>
		<td><input type="text" name="telefone" value="'.$telefone.'"  size="30"></td>
	</tr>

	<tr>
		<td>Email:</td>
		<td><input type="text" name="email" value="'.$email.'" size="30"></td>
	</tr>

	<tr>
		<td>UF:</td>
		<td><input type="text" name="uf" value="'.$uf.'" size="30"></td>
	</tr>
	</table>
	<input type="submit" name="cadastrar" class="btn btn-success" style="font-size: 1.5rem;" value="'.$valor_botao.' Paciente">
</form>';
?>
<hr>
<table class=" table table-condensed table striped table-bordered table-hover"border="1px">
		<tr>
			<td colspan="8" align="center"><h4>Pacientes Cadastrados</h4></td>
		</tr>
		<tr align="center">
			<td>Nome</td>
			<td>Celular</td>
			<td>Telefone</td>
			<td>Email</td>
			<td>UF</td>
			<td>Ações</td>
		</tr>
		<?php
			$query='SELECT p.id_paciente, p.nome, p.celular, p.telefone, p.email, p.uf
					FROM pacientes p 
					ORDER BY nome';
			$res = mysqli_query($link, $query);
			$qtd = mysqli_num_rows($res);

			if($qtd>0){
				while($linha = mysqli_fetch_assoc($res)){
					echo '<tr>';
					echo '<td>'.$linha['nome'].'</td>';
					echo '<td>'.$linha['celular'].'</td>';
					echo '<td>'.$linha['telefone'].'</td>';
					echo '<td>'.$linha['email'].'</td>';
					echo '<td>'.$linha['uf'].'</td>';
					echo '<td><a href="index.php?pg=paciente&id_update='.$linha['id_paciente'].'" class="btn btn-primary"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></a>
					<a href="acao.paciente.php?acao=delete&id_paciente='.$linha['id_paciente'].'" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></a></td>';
					echo '</tr>';
				}
			}else{
				echo '<tr align="center">
				<td colspan="8">Nenhum registro para listar</td>
				</tr>';
			}

		?>

	</table>
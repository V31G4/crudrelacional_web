<?php require_once('inc.connect.php'); 
	$acao='insert';
	
	if (isset($_REQUEST['id_update']) and !empty($_REQUEST['id_update'])) {
		$id_consulta = $_REQUEST['id_update'] ;
	}else{
		$id_consulta = 0;
	}

	$id_paciente = '';
	$id_medico = '';
	$data_contato = '';
	$data_solicitacao = '';
	$data_consulta = '';
	$horario_consulta = '';
	$data_confirmacao = '';
	$horario_confirmacao='';
	$forma_contato = '';
	$observacao = '';
	$forma_pagamento = '';
	$valor = '';
	$id_clinica = '';

	if ($id_consulta > 0) {
    $acao = 'update';
    $query = 'SELECT id_paciente, id_medico, data_solicitacao, data_consulta, horario_consulta, data_confirmacao, observacao, forma_pagamento, valor, id_clinica
              FROM consultas
              WHERE id_consulta =' . $id_consulta;
    $res = mysqli_query($link, $query);
    $rows = mysqli_num_rows($res);
    if ($rows > 0) {
        $linha = mysqli_fetch_assoc($res);
        $id_paciente = $linha['id_paciente'];
        $id_medico = $linha['id_medico'];
        $data_solicitacao = $linha['data_solicitacao'];
        $data_consulta = $linha['data_consulta'];
        $horario_consulta = $linha['horario_consulta'];
        $data_confirmacao = $linha['data_confirmacao'];
        $observacao = $linha['observacao'];
        $forma_pagamento = $linha['forma_pagamento'];
        $valor = $linha['valor'];
        $id_clinica = $linha['id_clinica'];
    }

    // Buscando da tabela endereco
    $query2 = 'SELECT nome, rua, numero, cep, bairro, cidade, estado
               FROM clinicas
               WHERE id_clinica =' . $id_clinica;

    $res2 = mysqli_query($link, $query2);
    $rows2 = mysqli_num_rows($res2);

    if ($rows2 > 0) {
        $linha2 = mysqli_fetch_assoc($res2);
        $nome = $linha2['nome'];
        $rua = $linha2['rua'];
        $numero = $linha2['numero'];
        $cep = $linha2['cep'];
        $bairro = $linha2['bairro'];
        $cidade = $linha2['cidade'];
        $estado = $linha2['estado'];
    }
}

if ($acao == 'insert') {
    $valor_botao = 'Cadastrar';
} elseif ($acao == 'update') {
    $valor_botao = 'Alterar';
}

?>
<form action="acao.consulta.php" method="POST">
	
	<table class="table table-condensed table-striped table-bordered table-hover">

		<?php
		echo '<input type="hidden" name="acao" value="'.$acao.'">
		<input type="hidden" name="id_consulta" value="'.$id_consulta.'">
		<input type="hidden" name="id_clinica" value="'.$id_clinica.'">
		<tr><td colspan="2" align="center"><h4>'.$valor_botao.' Consulta</h4></td></tr>';
		?>
		
		<tr>
		<td>Paciente:</td>
			<td>			
				<?php	
					$query='SELECT id_paciente, nome FROM pacientes';
					$res = mysqli_query($link,$query);
					$qtd = mysqli_num_rows($res);
					echo '<select name="paciente">';
					echo '<option>Selecione</option>';
					if($qtd>0){
						while($exibe = mysqli_fetch_assoc($res)){
							if($exibe['id_paciente']==$id_paciente){
								echo '<option selected value="'.$exibe['id_paciente'].'">'.$exibe['nome'].'</option>'; 
							}else{
								echo '<option value="'.$exibe['id_paciente'].'">'.$exibe['nome'].'</option>'; 
							}
						}
					}else{
						echo '<option>Nenhum Paciente Cadastrado</option>';
					}
					echo '</select>';
        			?>					
			</td>
		</tr>
		<tr>
			<td>Médico:</td>
			<td>
			    <select name="medico">
			        <option>Selecione</option>
			        <?php
			            $query = 'SELECT id_medico, nome FROM medicos';
			            $res = mysqli_query($link, $query);
			            $qtd = mysqli_num_rows($res);
			            if ($qtd > 0) {
			                while ($exibe = mysqli_fetch_assoc($res)) {
			                    if ($exibe['id_medico'] == $id_medico) {
			                        echo "<option selected value=\"" . $exibe["id_medico"] . "\">" . $exibe["nome"] . "</option>"; 
			                    } else {
			                        echo "<option value=\"" . $exibe["id_medico"] . "\">" . $exibe["nome"] . "</option>";     
			                    }
			                }
			            } else {
			                echo '<option>Nenhum Médico cadastrado</option>';
			            }
			        ?>					
			    </select>
			</td>
		</tr>
		<tr>
			<td>Data da Solicitação:</td>
			<td><input type="date" value="<?php echo $data_solicitacao?>" name="datasolicitacao"></td>
		</tr>				
        <tr>
			<td>Data da Consulta:</td>
			<td><input type="date" value="<?php echo $data_consulta?>" name="dataconsulta"></td>
		</tr>
		<tr>
			<td>Horário da Consulta</td>
			<td><input type="time" value="<?php echo $horario_consulta?>" name="horarioconsulta" size="30"></td>
		</tr>
        <tr>
		<td>Clínica:</td>
			<td>			
				<?php	
					$query='SELECT id_clinica, nome FROM clinicas';
					$res = mysqli_query($link,$query);
					$qtd = mysqli_num_rows($res);
					echo '<select name="id_clinica">';
					echo '<option>Selecione</option>';
					if($qtd>0){
						while($exibe = mysqli_fetch_assoc($res)){
							if($exibe['id_clinica']==$id_clinica){
								echo '<option selected value="'.$exibe['id_clinica'].'">'.$exibe['nome'].'</option>'; 
							}else{
								echo '<option value="'.$exibe['id_clinica'].'">'.$exibe['nome'].'</option>'; 
							}
						}
					}else{
						echo '<option>Nenhuma Clínica Cadastrada</option>';
					}
					echo '</select>';
        			?>					
			</td>
		<tr>
		    <td>Valor:</td>
		    <td><input type="text" name="valor" value="<?php echo $valor; ?>" size="30"></td>
		</tr>
		</tr>
        <td>Forma de Pagamento:</td>
            <td>
            <?php
            	if($forma_pagamento='dinheiro'){
            		echo '<input type="radio" name="pagamento" value="Dinheiro" checked>Dinheiro
            	<input type="radio" name="pagamento" value="Débito">Débito
            	<input type="radio" name="pagamento" value="Crédito">Crédito';
            	}elseif($forma_pagamento='debito'){
            	echo '<input type="radio" name="pagamento" value="Dinheiro" >Dinheiro
            	<input type="radio" name="pagamento" value="Débito" checked>Débito
            	<input type="radio" name="pagamento" value="Crédito">Crédito';
            	}else{
            		echo '<input type="radio" name="pagamento" value="Dinheiro" >Dinheiro
            	<input type="radio" name="pagamento" value="Débito" >Débito
            	<input type="radio" name="pagamento" value="Crédito checked">Crédito';
            	}
            ?>
            </td>
        <tr>
			<td>Observações:</td>
			<td><textarea class="form-control" name="observacoes" rows="5" id="comment"><?php echo $observacao?></textarea></td>				
		</tr>
     
	</table>
	
			
	<input type="submit" name="cadastrar" value="<?php echo $valor_botao?> Consulta" class="btn btn-success" style="font-size: 1.5rem;">
</form>
<hr>
<table class="table table-condensed table-striped table-bordered table-hover" border="1px">

		<tr>

			<td colspan="13" align="center"><h4>Consultas</h4></td>

		</tr>

		<tr align="center">

			<td>Nome Paciente</td>

			<td>Médico</td>

			<td>Data de Solicitação</td>

            <td>Data da Consulta</td>

            <td>Horário da Consulta</td>

            <td>Clínica</td>

            <td>Valor</td>

            <td>Forma de Pagamento</td>

            <td>Observações</td>

			<td>Ações</td>

		</tr>

		<tr>
			<?php
				$query='SELECT p.nome as nome_paciente, m.nome as nome_medico, cl.nome as nome_clinica, c.* FROM consultas c
						JOIN pacientes p ON p.id_paciente = c.id_paciente
						JOIN medicos m ON m.id_medico = c.id_medico
						JOIN clinicas cl ON cl.id_clinica = c.id_clinica
						ORDER BY data_consulta DESC';
				$res = mysqli_query($link, $query);

		
			$qtd = mysqli_num_rows($res);

			if($qtd>0){

				while($linha = mysqli_fetch_assoc($res)){

					echo '<tr>';
					echo '<td>'.$linha['nome_paciente'].'</td>';
					echo '<td>'.$linha['nome_medico'].'</td>';
					echo '<td>'.$linha['data_solicitacao'].'</td>';
					echo '<td>'.$linha['data_consulta'].'</td>';
					echo '<td>'.$linha['horario_consulta'].'</td>';
					echo '<td>'.$linha['nome_clinica'].'</td>';
					echo '<td>'.$linha['valor'].'</td>';
					echo '<td>'.$linha['forma_pagamento'].'</td>';
					echo '<td>'.$linha['observacao'].'</td>';
					echo '<td>
						<a href="index.php?pg=consulta&id_update='.$linha['id_consulta'].'" class="btn btn-primary">
							<span class="glyphicon glyphicon-pencil" aria-hidden="true">
						</a>
						<a href="acao.consulta.php?acao=delete&id_consulta='.$linha['id_consulta'].'" class="btn btn-danger">
							<span class="glyphicon glyphicon-trash" aria-hidden="true">
						</a>
						</td>';
					echo '</tr>';

				}
			}else{
				echo '<tr align="center">
				<td colspan="7">Nenhum registro para listar</td>
				</tr>';
			}

			?>
		</tr>
			</table>


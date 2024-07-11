<?php
$acao = 'insert';

if (isset($_REQUEST['id_update']) and !empty($_REQUEST['id_update'])) {
    $id_medico = $_REQUEST['id_update'];
} else {
    $id_medico = 0;
}

$nome = '';
$ie_ativo = '';
$ds_area_atuacao = '';
$ds_especialidade = '';

if ($id_medico > 0) {

    $acao = 'update';
    $query = 'SELECT m.nome, m.ie_ativo, m.ds_area_atuacao, GROUP_CONCAT(e.ds_especialidade) AS ds_especialidade
              FROM medicos m
              LEFT JOIN especialidade_medica em ON em.id_medico = m.id_medico
              LEFT JOIN especialidades e ON e.id_especialidade = em.id_especialidade
              WHERE m.id_medico = ' . $id_medico . '
              GROUP BY m.id_medico';
    $res = mysqli_query($link, $query);
    $rows = mysqli_num_rows($res);
    if ($rows > 0) {

        $linha = mysqli_fetch_assoc($res);
        $nome = $linha['nome'];
        $ie_ativo = $linha['ie_ativo'];
        $ds_area_atuacao = $linha['ds_area_atuacao'];
        $ds_especialidade = $linha['ds_especialidade'];
    }
}

if ($acao == 'insert') {
    $valor_botao = 'Cadastrar';
} else if ($acao == 'update') {
    $valor_botao = 'Alterar';
}

?>
<form action="acao.medico.php" method="POST">
    <table class="table table-condensed table-striped table-bordered table-hover">
        <input type="hidden" name="acao" value="<?php echo $acao; ?>">
        <input type="hidden" name="id_medico" value="<?php echo $id_medico; ?>">
        <tr>
            <td colspan="2" align="center"><h4><?php echo $valor_botao; ?> Médico</h4></td>
        </tr>
        <tr>
            <td>Nome:</td>
            <td><input type="text" name="nome" value="<?php echo $nome; ?>" size="30"></td>
        </tr>
        <tr>
            <td>Ativo</td>
            <td>
                <select name="ie_ativo">
                    <option value="">Selecione</option>
                    <option value="A" <?php echo ($ie_ativo == 'A') ? 'selected' : ''; ?>>Ativo</option>
                    <option value="I" <?php echo ($ie_ativo == 'I') ? 'selected' : ''; ?>>Inativo</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Área de Atuação:</td>
            <td><input type="text" name="ds_area_atuacao" value="<?php echo $ds_area_atuacao; ?>" size="30"></td>
        </tr>
        <tr>
            <td>Especialidade</td>
            <td>
                <select name="ds_especialidade">
                    <option value="">Selecione</option>
                    <?php
                    $query = 'SELECT id_especialidade, ds_especialidade FROM especialidades';
                    $res = mysqli_query($link, $query);
                    if ($res === false) {
                        echo "Erro na consulta: " . mysqli_error($link);
                    } else {
                        $qtd = mysqli_num_rows($res);
                        if ($qtd > 0) {
                            while ($exibe = mysqli_fetch_assoc($res)) {
                                $selected = ($exibe['ds_especialidade'] == $ds_especialidade) ? 'selected' : '';
                                echo '<option ' . $selected . ' value="' . $exibe['id_especialidade'] . '">' . $exibe['ds_especialidade'] . '</option>';
                            }
                        } else {
                            echo '<option>Nenhuma Especialidade Cadastrada</option>';
                        }
                    }
                    ?>
                </select>
            </td>
        </tr>
    </table>
    <input type="submit" name="cadastrar" value="<?php echo $valor_botao; ?> Médico" class="btn btn-success" style="font-size: 1.5rem;">
</form>

<hr>

<table class="table table-condensed table-striped table-bordered table-hover" border="1px">
    <tr>
        <td colspan="5" align="center"><h4>Médicos Cadastrados</h4></td>
    </tr>
    <tr align="center">
        <td>Nome</td>
        <td>Ativo</td>
        <td>Área de Atuação</td>
        <td>Especialidade</td>
        <td>Ações</td>
    </tr>

    <?php
    $query = 'SELECT m.id_medico, m.nome, m.ie_ativo, m.ds_area_atuacao, GROUP_CONCAT(e.ds_especialidade) AS ds_especialidade
              FROM medicos m 
              LEFT JOIN especialidade_medica em ON em.id_medico = m.id_medico
              LEFT JOIN especialidades e ON e.id_especialidade = em.id_especialidade
              GROUP BY m.id_medico';
    $res = mysqli_query($link, $query);
    $qtd = mysqli_num_rows($res);

    if ($qtd > 0) {
        while ($linha = mysqli_fetch_assoc($res)) {

            echo '<tr>';
            echo '<td>' . $linha['nome'] . '</td>';
            echo '<td>' . $linha['ie_ativo'] . '</td>';
            echo '<td>' . $linha['ds_area_atuacao'] . '</td>';
            echo '<td>' . $linha['ds_especialidade'] . '</td>';
            echo '<td>
                <a href="index.php?pg=medico&id_update=' . $linha['id_medico'] . '" class="btn btn-primary"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></a>
                <a href="acao.medico.php?acao=delete&id_medico=' . $linha['id_medico'] . '" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></a>';
            echo '</td>';
            echo '</tr>';
        }
    } else {
        echo '<tr align="center">
        <td colspan="5">Nenhum registro para listar</td>
        </tr>';
    }
    ?>

</table>

		
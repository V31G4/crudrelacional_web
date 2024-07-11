<?php
$acao = 'insert';

if (isset($_REQUEST['id_update']) and !empty($_REQUEST['id_update'])) {
    $id_especialidade = intval($_REQUEST['id_update']);
} else {
    $id_especialidade = 0;
}

$ds_especialidade = '';
$tipo_especialidade = '';
$ds_cid = '';
$ie_ativo = '';

if ($id_especialidade > 0) {
    $acao = 'update';
    $query = 'SELECT e.ds_especialidade, e.tipo_especialidade, c.ds_cid, e.ie_ativo
              FROM especialidades e
              JOIN especialidade_cid ec ON ec.id_especialidade = e.id_especialidade
              JOIN cid c ON c.id_cid = ec.id_cid
              WHERE e.id_especialidade =' . intval($id_especialidade);
    $res = mysqli_query($link, $query);
    if ($res) {
        $rows = mysqli_num_rows($res);
        if ($rows > 0) {
            $linha = mysqli_fetch_assoc($res);
            $ds_especialidade = $linha['ds_especialidade'];
            $tipo_especialidade = $linha['tipo_especialidade'];
            $ds_cid = $linha['ds_cid'];
            $ie_ativo = $linha['ie_ativo'];
        }
    } else {
        echo "Erro na consulta: " . mysqli_error($link);
    }
}

$valor_botao = ($acao == 'insert') ? 'Cadastrar' : 'Alterar';
?>

<form action="acao.especialidade.php" method="POST">
    <table class="table table-condensed table-striped table-bordered table-hover">
        <input type="hidden" name="acao" value="<?php echo $acao; ?>">
        <input type="hidden" name="id_especialidade" value="<?php echo $id_especialidade; ?>">
        <tr>
            <td colspan="2" align="center"><h4><?php echo $valor_botao; ?> Especialidade</h4></td>
        </tr>
        <tr>
            <td>Nome da Especialidade:</td>
            <td><input type="text" name="ds_especialidade" value="<?php echo $ds_especialidade; ?>" size="30"></td>
        </tr>
        <tr>
            <td>Tipo da Especialidade</td>
            <td><input type="text" name="tipo_especialidade" value="<?php echo $tipo_especialidade; ?>" size="30"></td>
        </tr>
        <tr>
            <tr>
    <td>CID</td>
    <td>
        <?php
        $query = 'SELECT id_cid, ds_cid FROM cid';
        $res = mysqli_query($link, $query);
        if ($res === false) {
            echo "Erro na consulta: " . mysqli_error($link);
        } else {
            $qtd = mysqli_num_rows($res);
            echo '<select name="id_cid">';
            echo '<option value="">Selecione</option>'; // Opção padrão "Selecione"
            if ($qtd > 0) {
                while ($exibe = mysqli_fetch_assoc($res)) {
                    echo '<option value="'.$exibe['id_cid'].'">'.$exibe['ds_cid'].'</option>';
                }
            } else {
                echo '<option>Nenhum CID Cadastrado</option>';
            }
            echo '</select>';
        }
        ?>
    </td>
</tr>
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
            <td colspan="2" align="left">
                <input type="submit" name="cadastrar" value="<?php echo $valor_botao; ?> Especialidade" class="btn btn-success" style="font-size: 1.5rem;">
            </td>
        </tr>
    </table>
</form>
<hr>

<table class="table table-condensed table-striped table-bordered table-hover" border="1px">
    <tr>
        <td colspan="7" align="center">
            <h4>Especialidades Cadastradas</h4>
        </td>
    </tr>
    <tr align="center">
        <td>Nome da Especialidade</td>
        <td>Tipo da Especialidade</td>
        <td>CID</td>
        <td>Ativo</td>
        <td>Ações</td>
    </tr>
    <tr>
        <?php
        $query='SELECT e.id_especialidade, e.ds_especialidade, e.tipo_especialidade, c.ds_cid, e.ie_ativo
                FROM especialidades e
                JOIN especialidade_cid ec ON ec.id_especialidade = e.id_especialidade
                JOIN cid c ON c.id_cid = ec.id_cid
                ORDER BY ds_especialidade';
        $res = mysqli_query($link, $query);
        $qtd = mysqli_num_rows($res);

        if ($qtd > 0) {
            while ($linha = mysqli_fetch_assoc($res)) {
                echo '<tr>';
                echo '<td>'.$linha['ds_especialidade'].'</td>';
                echo '<td>'.$linha['tipo_especialidade'].'</td>';
                echo '<td>'.$linha['ds_cid'].'</td>';
                echo '<td>'.$linha['ie_ativo'].'</td>';
                echo '<td><a href="index.php?pg=especialidade&id_update='.$linha['id_especialidade'].'" class="btn btn-primary"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                <a href="acao.especialidade.php?acao=delete&id_especialidade='.$linha['id_especialidade'].'" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></td>';
                echo '</tr>';
            }
        } else {
            echo '<tr align="center">
            <td colspan="7">Nenhum registro para listar</td>
            </tr>';
        }
        ?>
    </tr>
</table>
<?php
require_once('inc.connect.php');

if (isset($_POST['acao'])) {
    $acao = $_POST['acao'];
} elseif (isset($_GET['acao'])) {
    $acao = $_GET['acao'];
} else {
    $acao = '';
}

switch ($acao) {
    case 'insert':
        $nome = $_POST['nome'];
        $ie_ativo = $_POST['ie_ativo'];
        $ds_area_atuacao = $_POST['ds_area_atuacao'];
        $ds_especialidade = $_POST['ds_especialidade'];

        $query = 'INSERT INTO medicos (nome, ie_ativo, ds_area_atuacao) VALUES ("' . $nome . '", "' . $ie_ativo . '", "' . $ds_area_atuacao . '")';
        $res = mysqli_query($link, $query);
        if ($res) {
            $id_medico = mysqli_insert_id($link);
            $query2 = 'INSERT INTO especialidade_medica (id_medico, id_especialidade) VALUES (' . $id_medico . ', ' . $ds_especialidade . ')';
            $res2 = mysqli_query($link, $query2);
        }
        $msg = ($res && $res2) ? 'cadastrado' : 'erro';
        break;

    case 'update':
        $id_medico = $_POST['id_medico'];
        $nome = $_POST['nome'];
        $ie_ativo = $_POST['ie_ativo'];
        $ds_area_atuacao = $_POST['ds_area_atuacao'];
        $ds_especialidade = $_POST['ds_especialidade'];

        $query = 'UPDATE medicos SET nome = "' . $nome . '", ie_ativo = "' . $ie_ativo . '", ds_area_atuacao = "' . $ds_area_atuacao . '" WHERE id_medico = ' . $id_medico;
        $res = mysqli_query($link, $query);
        if ($res) {
            $query2 = 'UPDATE especialidade_medica SET id_especialidade = ' . $ds_especialidade . ' WHERE id_medico = ' . $id_medico;
            $res2 = mysqli_query($link, $query2);
        }
        $msg = ($res && $res2) ? 'alterado' : 'erro';
        break;

    case 'delete':
        if (isset($_GET['id_medico']) && !empty($_GET['id_medico'])) {
            $id_medico = $_GET['id_medico'];
            $query = 'DELETE FROM especialidade_medica WHERE id_medico = ' . $id_medico;
            $res = mysqli_query($link, $query);
            if ($res) {
                $query2 = 'DELETE FROM medicos WHERE id_medico = ' . $id_medico;
                $res2 = mysqli_query($link, $query2);
            }
            $msg = ($res && $res2) ? 'deletado' : 'erro';
        } else {
            $msg = 'erro';
        }
        break;

    default:
        $msg = 'erro';
        break;
}

mysqli_close($link);
header("location:index.php?pg=medico&msg=" . $msg);
?>

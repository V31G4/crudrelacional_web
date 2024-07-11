<?php
require_once('inc.connect.php');

$erro = false;

// Verificar se os campos necessários estão definidos
if (!isset($_POST['ds_especialidade'], $_POST['tipo_especialidade'], $_POST['id_cid'], $_POST['ie_ativo'], $_REQUEST['acao']) && !isset($_REQUEST['acao'])) {
    $erro = true;
} else {
    // Capturar os valores do formulário
    if (isset($_POST['ds_especialidade'])) {
        $ds_especialidade = $_POST['ds_especialidade'];
    }
    if (isset($_POST['tipo_especialidade'])) {
        $tipo_especialidade = $_POST['tipo_especialidade'];
    }
    if (isset($_POST['id_cid'])) {
        $id_cid = $_POST['id_cid'];
    }
    if (isset($_POST['ie_ativo'])) {
        $ie_ativo = $_POST['ie_ativo'];
    }
    $acao = $_REQUEST['acao'];

    // Se a ação for 'update' ou 'delete', precisamos verificar se o ID da especialidade está definido
    if (in_array($acao, ['update', 'delete'])) {
        if (isset($_POST['id_especialidade']) && !empty($_POST['id_especialidade'])) {
            $id_especialidade = intval($_POST['id_especialidade']);
        } elseif (isset($_GET['id_especialidade']) && !empty($_GET['id_especialidade'])) {
            $id_especialidade = intval($_GET['id_especialidade']);
        } else {
            $erro = true;
        }
    }
}

if (!$erro) {
    // Realizar ações com base na operação
    switch ($acao) {
        case 'insert':
            // Inserir a especialidade
            $query_insert = 'INSERT INTO especialidades (ds_especialidade, tipo_especialidade, ie_ativo) VALUES (?, ?, ?)';
            $stmt_insert = mysqli_prepare($link, $query_insert);
            mysqli_stmt_bind_param($stmt_insert, 'sss', $ds_especialidade, $tipo_especialidade, $ie_ativo);
            $erro = !mysqli_stmt_execute($stmt_insert);

            if (!$erro) {
                // Obter o ID da especialidade recém-inserida
                $id_especialidade = mysqli_insert_id($link);
                
                // Inserir o relacionamento na tabela especialidade_cid
                $query_relacionamento = 'INSERT INTO especialidade_cid (id_especialidade, id_cid) VALUES (?, ?)';
                $stmt_relacionamento = mysqli_prepare($link, $query_relacionamento);
                mysqli_stmt_bind_param($stmt_relacionamento, 'ii', $id_especialidade, $id_cid);
                $erro = !mysqli_stmt_execute($stmt_relacionamento);
            }

            $msg = $erro ? 'Erro ao cadastrar especialidade' : 'Especialidade cadastrada com sucesso';
            break;

        case 'update':
            // Atualizar a especialidade
            $query_update = 'UPDATE especialidades SET ds_especialidade = ?, tipo_especialidade = ?, ie_ativo = ? WHERE id_especialidade = ?';
            $stmt_update = mysqli_prepare($link, $query_update);
            mysqli_stmt_bind_param($stmt_update, 'sssi', $ds_especialidade, $tipo_especialidade, $ie_ativo, $id_especialidade);
            $erro = !mysqli_stmt_execute($stmt_update);
            $msg = $erro ? 'Erro ao atualizar especialidade' : 'Especialidade atualizada com sucesso';
            break;

        case 'delete':
            if (isset($id_especialidade)) {
                // Excluir da tabela especialidade_cid
                $query_relacionamento = 'DELETE FROM especialidade_cid WHERE id_especialidade = ?';
                $stmt_relacionamento = mysqli_prepare($link, $query_relacionamento);
                mysqli_stmt_bind_param($stmt_relacionamento, 'i', $id_especialidade);
                $erro_relacionamento = !mysqli_stmt_execute($stmt_relacionamento);

                // Excluir da tabela especialidades
                $query = 'DELETE FROM especialidades WHERE id_especialidade = ?';
                $stmt = mysqli_prepare($link, $query);
                mysqli_stmt_bind_param($stmt, 'i', $id_especialidade);
                $erro = !mysqli_stmt_execute($stmt);

                $erro = $erro || $erro_relacionamento;
                $msg = $erro ? 'Erro ao deletar especialidade' : 'Especialidade deletada com sucesso';
            } else {
                $erro = true;
                $msg = 'ID da especialidade não fornecido';
            }
            break;

        default:
            $erro = true;
            $msg = 'Ação inválida';
            break;
    }
}

mysqli_close($link);
header("location:index.php?pg=especialidade&msg=" . $msg);
?>

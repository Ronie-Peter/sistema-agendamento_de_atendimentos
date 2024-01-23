<?php
    /* Iniciando conexão com banco de dados */
    include_once "conexao.php";
    /* Iniciando sessão */
    session_start();
    
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    /* Conversão - data/hora do formato brasileiro para o formato do Banco de Dados */
    $data_start_conv = date("Y-m-d H:i:s", strtotime($dados['start']));
    $data_end_conv = date("Y-m-d H:i:s", strtotime($dados['end']));
    /* Cria um statement de atualização do MySQL, prepara para execução e atribui os parâmetros coletados no formulário corretamente */
    $query = "UPDATE events SET title=?, color=?, start=?, end=?, responsible=?, status=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sssssii", $dados['title'], $dados['color'], $data_start_conv, $data_end_conv, $dados['responsible'], $dados['status'], $dados['id']);
    /* Executa o statement de atualização do MySQL e emite um alerta na tela para função realizada com sucesso ou erro */
    if ($stmt->execute()) 
    {
        $retorna = ['sit' => true, 'msg' => '<div class="alert alert-success" role="alert">Solicitação editada com sucesso! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'];
        $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Solicitação editada com sucesso! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
    } else {
        $retorna = ['sit' => false, 'msg' => '<div class="alert alert-danger" role="alert">Erro ao editar solicitação. <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'];
    }
    
    header('Content-Type: application/json');
    echo json_encode($retorna);
    /* Encerrando conexão com banco de dados */
    mysqli_close($conn);
?>
<?php
    
    // Definição dos horários de início e fim desejados
    $startTime = strtotime('07:30');
    $endTime = strtotime('12:00');

    $availableTimes = []; // Array para armazenar os horários disponíveis

    // Geração dos horários de 45 minutos entre 07:30 e 12:00
    while ($startTime < $endTime) {
        $endTimeSlot = strtotime('+45 minutes', $startTime);
        $timeSlot = [
            'start' => date('H:i', $startTime),
            'end' => date('H:i', $endTimeSlot)
        ];
        array_push($availableTimes, $timeSlot);
        $startTime = $endTimeSlot;
    }

    /* Iniciando conexão com banco de dados */
    include_once "conexao.php";
    /* Iniciando sessão */
    session_start();
    /* Coleta os dados do evento que o modal captura e envia */
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    /* Conversão - data/hora do formato brasileiro para o formato do Banco de Dados */
    $data_start_conv = date("Y-m-d H:i:s", strtotime($dados['start']));
    // Adiciona 45 minutos ao tempo de início para obter o tempo de término
    $data_end_conv = date("Y-m-d H:i:s", strtotime($dados['start'] . ' +45 minutes'));
    /* Define o fuso horário para o fuso de Brasília - DF */
    date_default_timezone_set('America/Sao_Paulo');
    
    /* Tratamento de erro - impede horarios iguais data do fim do evento menor que a data de inicio criar um evento para antes da data atual */
    if($data_end_conv > $data_start_conv && $data_start_conv > date('Y-m-d H:i:s') && $data_end_conv > date('Y-m-d H:i:s')){
        /* Cria um statement de criação do MySQL, prepara para execução e atribui os parâmetros coletados no formulário corretamente */
        $query = "INSERT INTO events (title, color, start, end, description, status, dataCadastro) VALUES (?, '#FFD700', ?, ?, ?, false, now())";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ssss", $dados['title'], $data_start_conv, $data_end_conv, $dados['description']);
        /* Executa o statement de criação do MySQL e emite um alerta na tela para função realizada com sucesso ou erro */
        if ($stmt->execute()) 
        {
            $retorna = ['sit' => true, 'msg' => '<div class="alert alert-success" role="alert">Solicitação criada com sucesso! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'];
            $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Solicitação criada com sucesso! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
        } else {
            $retorna = ['sit' => false, 'msg' => '<div class="alert alert-danger" role="alert">Erro na criação da solicitação. <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'];
        }

        
    } else {
        $retorna = ['sit' => false, 'msg' => '<div class="alert alert-danger" role="alert">Erro na criação da solicitação. Início e fim não podem ser a mesma data e hora ou anteriores à data e hora atual. <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'];
    }

    header('Content-Type: application/json');
    echo json_encode($retorna);
    /* Encerrando conexão com banco de dados */
    mysqli_close($conn);
?>
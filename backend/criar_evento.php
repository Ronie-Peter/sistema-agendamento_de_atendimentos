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

// Validando o e-mail
if (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
    $retorna = [
        'sit' => false,
        'msg' => '<div class="alert alert-danger" role="alert">O e-mail inserido não é válido. Por favor, insira um e-mail válido.</div>'
    ];
    header('Content-Type: application/json');
    echo json_encode($retorna);
    exit; // Encerra a execução se o e-mail não for válido
}

/* Conversão - data/hora do formato brasileiro para o formato do Banco de Dados */

$dataHoraAgendamento = $dados['date'] . ' ' . $dados['start'];

$data_start_conv = date("Y-m-d H:i:s", strtotime($dataHoraAgendamento));
// Adiciona 45 minutos ao tempo de início para obter o tempo de término
$data_end_conv = date("Y-m-d H:i:s", strtotime($dataHoraAgendamento . ' +45 minutes'));
// Define o fuso horário para o fuso de Brasília - DF
date_default_timezone_set('America/Sao_Paulo');

// Verifica se a data do agendamento é um sábado ou domingo
$diaDaSemana = date('N', strtotime($dados['date'])); // Obtém o dia da semana (1 para segunda-feira, 7 para domingo)

if ($diaDaSemana >= 6) { // Se for sábado (6) ou domingo (7)
    $retorna = [
        'sit' => false,
        'msg' => '<div class="alert alert-danger" role="alert">O agendamento não é permitido para sábado ou domingo.</div>'
    ];
} elseif ($data_start_conv > date('Y-m-d H:i:s')) {
    // Verifica se o agendamento é para o mesmo dia e horário é futuro
    if (
        ($data_start_conv > date('Y-m-d')) ||
        ($data_start_conv == date('Y-m-d') && date('H:i', strtotime($dados['start'])) > date('H:i'))
    ) {
        // Verifica se o horário está disponível
        $checkConsultaDisponibilidade = "SELECT * FROM events WHERE ((start <= ? AND end >= ?) OR (start >= ? AND start < ?))";
        $checkStmt = mysqli_prepare($conn, $checkConsultaDisponibilidade);
        mysqli_stmt_bind_param($checkStmt, "ssss", $data_start_conv, $data_start_conv, $data_start_conv, $data_end_conv);
        mysqli_stmt_execute($checkStmt);
        mysqli_stmt_store_result($checkStmt);

        if (mysqli_stmt_num_rows($checkStmt) > 0) {
            $retorna = [
                'sit' => false,
                'msg' => '<div class="alert alert-danger" role="alert">Horário indisponível. Reserve um horário diferente.</div>'
            ];
        } else {
            // Cria um statement de criação do MySQL, prepara para execução e atribui os parâmetros coletados no formulário corretamente
            $query = "INSERT INTO events (title, color, start, end, responsible, status, ordinance, term, phone, email, dataCadastro) VALUES (?, '#FFD700', ?, ?, ?, false, ?, ?, ?, ?, now())";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "ssssssss", $dados['title'], $data_start_conv, $data_end_conv, $dados['responsible'], $dados['ordinance'], $dados['term'], $dados['phone'], $dados['email']);
            // Executa o statement de criação do MySQL e emite um alerta na tela para função realizada com sucesso ou erro

            if ($stmt->execute()) {
                $retorna = [
                    'sit' => true,
                    'msg' => '<div class="alert alert-success" role="alert">Atendimento agendado com sucesso!</div>'
                ];
                $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Atendimento agendado com sucesso!</div>';
            } else {
                $retorna = [
                    'sit' => false,
                    'msg' => '<div class="alert alert-danger" role="alert">Ocorreu um erro desconhecido. Tente novamente mais tarde.</div>'
                ];
            }
        }
    } else {
        $retorna = [
            'sit' => false,
            'msg' => '<div class="alert alert-danger" role="alert">Ocorreu um erro no agendamento! Não é possível realizar agendamentos em datas e/ou horários passados.</div>'
        ];
    }
} else {
    $retorna = [
        'sit' => false,
        'msg' => '<div class="alert alert-danger" role="alert">Ocorreu um erro no agendamento! Não é possível realizar agendamentos em datas e/ou horários passados.</div>'
    ];
}

header('Content-Type: application/json');
echo json_encode($retorna);
// Encerrando conexão com banco de dados
mysqli_close($conn);
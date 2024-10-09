<?php
/* Iniciando conexão com banco de dados */
include './backend/conexao.php';
/* Iniciando sessão */
session_start();
/* Verificação de login | se não existe o redireciona a página de login */
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <title>Administração - Agendamento Jurídico - HCE</title>
    <!-- Required meta tags -->
    <meta charset='utf-8' />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <!-- FullCalendar CSS -->
    <link href='./css/core.css' rel='stylesheet' />
    <link href='./css/daygrid.css' rel='stylesheet' />
    <link href='./css/daygrid.css' rel='stylesheet' />
    <link href='./css/list.css' rel='stylesheet' />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha384-v0uzdbpdPuz1ivz9/7x5XM7zBRRK/q0f9bMLbzpI1hxEw4XNKjpb4Qx5t5Bq9EX3" crossorigin="anonymous">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <!-- Ícone UFAC -->
    <link rel="shortcut icon" type="image/x-icon"
        href="https://sistemas.ufac.br/home/wp-content/themes/sistemas/staticIndex/imagens/logo_ufac.gif">
    <!-- Formatação personalizada usando CSS -->
    <link href='./css/personalizado.css' rel='stylesheet'>
</head>

<body>
    <!-- Embrulha os objetos do website para que interajam corretamente -->
    <div class="wrapper">
        <nav id="sidebar">
            <div class="sidebar-header">
                <img id="logo" src="resources/ufac.png" alt="logo">
                <br>
                <h3><strong>Agendamento Jurídico</strong></h3>
            </div>

            <ul class="list-unstyled components">
                <p style="text-align: center;">Assessoria Jurídica | HCE</p>
                <li>
                    <a href="./"><i class="fa fa-home"></i> Página Inicial</a>
                </li>

                <!-- <li class="active">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i
                            class="fa fa-map"></i> Espaços</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="index_aut.php?cod=1"> Áreas para eventos/convenções</a>
                        </li>

                        <li>
                            <a href="index_aut.php?cod=2"> Áreas para esportes</a>
                        </li>

                        <li>
                            <a href="index_aut.php?cod=3"> Laboratórios</a>
                        </li>
                    </ul>
                </li> -->

                <li>
                    <a href="informacao.php"><i class="fas fa-info-circle"></i> Informações</a>
                </li>

                <li id="logout">
                    <a href="./backend/logout.php"><i class="fas fa-sign-out-alt"></i> Sair</a>
                </li>
            </ul>
        </nav>

        <div id="content">
            <!-- Chama os alertas de alterações no banco de dados -->
            <?php
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            ?>
            <!-- Barra contendo o botão que expande/retrai o menu sidebar -->
            <!-- <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-primary"><i class="fas fa-bars"></i>
                        Menu</button>
                </div>
            </nav> -->
            <!-- Carregamento do calendário -->
            <div style="text-align: center;">
                <p>
                <h1><strong>Assessoramento :: Encarregados de IPM</strong></h1>
                </p>
            </div>
            <div id='calendar'></div>
            <!-- Rodapé da pagina -->
            <footer class="main-footer p-4 mt-5">
                <div class="container">
                    <div class="text-center">
                        Version <a href="https://github.com/Bezerha/Projeto-Agendamento"> 2.3.5 </a> &copy; 2022 NIEAD
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!-- Modal de visualização dos detalhes do evento -->
    <div class="modal fade" id="visualizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <!-- Título do modal -->
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detalhes da solicitação</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Visualização dos detalhes do evento -->
                <div class="modal-body">
                    <div class="visevent">
                        <dl class="row">
                            <dt class="col-sm-3">Categoria:</dt>
                            <dd class="col-sm-9" id="title"></dd>

                            <dt class="col-sm-3">Data da reserva:</dt>
                            <dd class="col-sm-9" id="date"></dd>

                            <dt class="col-sm-3">Hora da reserva:</dt>
                            <dd class="col-sm-9" id="start"></dd>

                            <dt class="col-sm-3">Responsável:</dt>
                            <dd class="col-sm-9" id="responsible"></dd>

                            <dt class="col-sm-3">Telefone:</dt>
                            <dd class="col-sm-9" id="phone"></dd>

                            <dt class="col-sm-3">E-mail:</dt>
                            <dd class="col-sm-9" id="email"></dd>
                        </dl>

                        <button class="btn btn-warning btn-canc-vis">Ver solicitação</button>
                    </div>
                    <!-- Formulário de aprovação do evento -->
                    <div class="formedit">
                        <span id="msg-edit"></span>
                        <form id="editevent" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" id="id">

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Categoria</label>
                                <div class="col-sm-10">
                                    <input type="text" name="title" class="form-control" id="title" placeholder="" disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Data da reserva</label>
                                <div class="col-sm-10">
                                    <input type="text" name="date" class="form-control" id="date" placeholder="" disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Horário</label>
                                <div class="col-sm-10">
                                    <input type="text" name="start" class="form-control" id="start" placeholder="" disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Responsável</label>
                                <div class="col-sm-10">
                                    <input type="text" name="responsible" class="form-control" id="responsible" placeholder="" disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Portaria</label>
                                <div class="col-sm-10">
                                    <input type="text" name="ordinance" class="form-control" id="ordinance" placeholder="" disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Data limite</label>
                                <div class="col-sm-10">
                                    <input type="text" name="term" class="form-control" id="term" placeholder="" disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Telefone</label>
                                <div class="col-sm-10">
                                    <input type="text" name="telefone" class="form-control" id="telefone" placeholder="" disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">E-mail</label>
                                <div class="col-sm-10">
                                    <input type="text" name="email" class="form-control" id="email" placeholder="" disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Solicitação aprovada: </label>
                                <div class="col-sm-10">
                                    <br>
                                    <input type="hidden" name="status" id="status" value="0">
                                    <input type="checkbox" name="status" id="status" value="1">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="button" class="btn btn-primary btn-canc-edit">Retornar</button>
                                    <button type="submit" name="AddEvent" id="AddEvent" value="AddEvent"
                                        class="btn btn-success">Aprovar</button>
                                    <a href="" id="recusar_evento" class="btn btn-danger">Recusar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Formulário de criação do evento -->
    <div class="modal fade" id="cadastrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <!-- Título do modal -->
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Solicitar espaço</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Formulário de criação do evento -->
                <div class="modal-body">
                    <span id="msg-add"></span>
                    <form id="addevent" method="POST" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Categoria</label>
                            <div class="col-sm-10">
                                <select name="title" class="form-control" id="title" required="required">
                                    <option value="" disabled selected hidden>Selecione uma categoria para atendimento
                                    </option>

                                    <optgroup label="Categoria do Atendimento">
                                        <option value="IPM">IPM</option>
                                        <!-- <option value="Demais">Demais</option> -->
                                        <!-- <option value="Sindicância">Sindicância</option> -->
                                    </optgroup>
                                </select>
                            </div>
                        </div>

                        <!-- <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Início da reserva: </label>
                                <div class="col-sm-10">
                                    <input type="datetime-local" name="start" class="form-control" id="start" required="required">
                                </div>
                            </div> -->

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Data da reserva</label>
                            <div class="col-sm-10">
                                <input type="date" name="date" class="form-control" id="date-reservation"
                                    required="required">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Hora da reserva</label>
                            <div class="col-sm-10">
                                <select name="start" class="form-control" id="start" required="required">
                                    <!-- <option value="" disabled selected hidden>Selecione um horário...</option> -->
                                    <!-- Opções de horários dentro do intervalo -->
                                    <option value="07:30">07:30</option>
                                    <option value="08:15">08:15</option>
                                    <option value="09:00">09:00</option>
                                    <option value="09:45">09:45</option>
                                    <option value="10:30">10:30</option>
                                    <option value="11:15">11:15</option>
                                    <!-- Adicione outras opções de horários conforme necessário -->
                                </select>
                            </div>
                        </div>

                        <!-- <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Fim da reserva: </label>
                                <div class="col-sm-10">
                                    <input type="datetime-local" name="end" class="form-control" id="end" required="required">
                                </div>
                            </div> -->

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Responsável</label>
                            <div class="col-sm-10">
                                <input type="text" name="responsible" class="form-control" id="responsible"
                                    placeholder="Nome do encarregado" pattern="[a-zA-ZÀ-ú\s]+"
                                    title="Apenas letras maiúsculas e minúsculas, espaços e caracteres acentuados."
                                    required="required">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Portaria</label>
                            <div class="col-sm-10">
                                <input type="text" name="ordinance" class="form-control" id="ordinance"
                                    placeholder="Objeto da Portaria" required="required" style="width: 100%;">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Data limite</label>
                            <div class="col-sm-10">
                                <input type="date" name="term" class="form-control" id="term"
                                    placeholder="Data de vencimento do procedimento" required="required">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Telefone</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="input-group-prepend" style="width: 100%;">
                                        <input type="text" class="form-control" id="telefone" name="telefone"
                                            maxlength="15" placeholder="(xx) xxxxx-xxxx">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">E-mail</label>
                            <div class="col-sm-10">
                                <input type="email" name="email" class="form-control" id="email"
                                    placeholder="Ex.: sissaj@hotmail.com" required="required">
                                <small id="emailHelp" class="form-text text-muted">Digite um e-mail válido.</small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" name="AddEvent" id="AddEvent" value="AddEvent"
                                    class="btn btn-success">Solicitar</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- FullCalendar Scripts -->
                <script src='./js/core.js'></script>
                <script src='./js/interaction.js'></script>
                <script src='./js/daygrid.js'></script>
                <script src='./js/timegrid.js'></script>
                <script src='./js/list.js'></script>
                <script src='./js/locales-all.js'></script>
                <!-- JQuery Script -->
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                <!-- Popper Script -->
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
                    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
                    crossorigin="anonymous"></script>
                <!-- Bootstrap Script -->
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
                    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
                    crossorigin="anonymous"></script>
                <!-- JQuerry Scroller Script -->
                <script
                    src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
                <!-- FontAwesome Scripts -->
                <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"
                    integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ"
                    crossorigin="anonymous"></script>
                <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"
                    integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY"
                    crossorigin="anonymous"></script>
                <!-- Scripts personalizados -->
                <script src="js/personalizado.js"></script>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        /* Instruções javascript - carregamento personalizado do calendário */
                        var calendarEl = document.getElementById('calendar');
                        var calendar = new FullCalendar.Calendar(calendarEl, {
                            locale: 'pt-br',
                            plugins: ['interaction', 'dayGrid', 'list', 'timegrid'],
                            header: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'dayGridMonth,listYear'
                            },
                            selectable: true,
                            eventLimit: true,
                            /* Filtragem da escolha de visualização dos eventos */
                            <?php
                            if (!isset($_GET['cod']) or $_GET['cod'] > 3) {
                                ?> events: './backend/listar_eventos.php',
                            <?php
                            } elseif ($_GET['cod'] == 1) {
                                ?> events: './backend/listar_eventos-1.php',
                            <?php
                            } elseif ($_GET['cod'] == 2) {
                                ?> events: './backend/listar_eventos-2.php',
                            <?php
                            } elseif ($_GET['cod'] == 3) {
                                ?> events: './backend/listar_eventos-3.php',
                            <?php
                            }
                            ?>
                /* Tratamento de erros */
                extraParams: function () {
                                return {
                                    cachebuster: new Date().valueOf()
                                };
                            },
                            /* Instruções javascript - tratamento e recebimento das informações do banco de dados do evento */
                            select: function (info) {
                                var selectedDate = info.start; // A data de início da seleção
                                var formattedDate = formatDate(selectedDate);


                                $('#cadastrar #start').val(info.start.toLocaleString());
                                $('#cadastrar #end').val(info.end.toLocaleString());
                                $('#date-reservation').val(formattedDate);
                                $('#term').val(formattedDate);
                                $('#cadastrar').modal('show');
                            },
                            eventClick: function (info) {
                                info.jsEvent.preventDefault();
                                var formattedTerm = formatDate(new Date(info.event.extendedProps.term));                                
                                $("#recusar_evento").attr("href", "./backend/cancelar_evento.php?id=" + info.event.id);
                                $('#visualizar #id').text(info.event.id);
                                $('#visualizar #id').val(info.event.id);
                                $('#visualizar #title').text(info.event.title);
                                $('#visualizar #title').val(info.event.title);
                                $('#visualizar #date').text(info.event.start.toLocaleDateString());
                                $('#visualizar #date').val(info.event.start.toLocaleDateString());
                                $('#visualizar #start').text(info.event.start.toLocaleTimeString());
                                $('#visualizar #start').val(info.event.start.toLocaleTimeString());
                                $('#visualizar #responsible').text(info.event.extendedProps.responsible);
                                $('#visualizar #responsible').val(info.event.extendedProps.responsible);
                                $('#visualizar #ordinance').text(info.event.extendedProps.ordinance);
                                $('#visualizar #ordinance').val(info.event.extendedProps.ordinance);
                                $('#visualizar #term').text(formattedTerm);
                                $('#visualizar #term').val(formattedTerm);
                                $('#visualizar #telefone').text(info.event.extendedProps.phone);
                                $('#visualizar #telefone').val(info.event.extendedProps.phone);
                                $('#visualizar #phone').text(info.event.extendedProps.phone || 'N/A');
                                $('#visualizar #email').text(info.event.extendedProps.email || 'N/A');
                                $('#visualizar #email').val(info.event.extendedProps.email || 'N/A');
                                $('#visualizar #color').val(info.event.backgroundColor);
                                $('#visualizar').modal('show');

                                var selectedDate = info.start; // A data de início da seleção
                                var formattedDate = formatDate(selectedDate);
                            },
                        });
                        /* Renderização do calendario */
                        calendar.render();
                    });

                    function formatDate(date) {
                        console.log(date)
                        var day = date.getDate();
                        var month = date.getMonth() + 1; // Lembre-se de adicionar 1, pois os meses começam de 0
                        var year = date.getFullYear();
                        console.log(day)

                        // Adiciona um zero à esquerda se o dia ou mês for menor que 10
                        day = day < 10 ? '0' + day : day;
                        month = month < 10 ? '0' + month : month;

                        return year + '-' + month + '-' + day;
                    }
                </script>
</body>

<script>
    document.getElementById('telefone').addEventListener('input', function (e) {
        let telefone = e.target.value;

        // Remove tudo que não for dígito
        telefone = telefone.replace(/\D/g, '');

        // Verifica o comprimento da string para aplicar o formato
        if (telefone.length > 10) {
            // Formata com DDD e número no formato (xx) xxxxx-xxxx
            telefone = telefone.replace(/^(\d{2})(\d{5})(\d{4}).*/, '($1) $2-$3');
        } else if (telefone.length > 5) {
            // Formata com DDD e número no formato (xx) xxxx-xxxx
            telefone = telefone.replace(/^(\d{2})(\d{4})(\d{0,4}).*/, '($1) $2-$3');
        } else if (telefone.length > 2) {
            // Formata com DDD (xx) xxxx ou (xx) xxxxx
            telefone = telefone.replace(/^(\d{2})(\d{0,5})/, '($1) $2');
        } else {
            // Formata com DDD (xx
            telefone = telefone.replace(/^(\d{0,2})/, '($1');
        }

        // Atualiza o valor do campo com a máscara aplicada
        e.target.value = telefone;
    });

</script>

</html>

<?php
/* Encerrando conexão com banco de dados */
mysqli_close($conn);
?>
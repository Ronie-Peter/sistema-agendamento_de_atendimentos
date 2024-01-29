<!DOCTYPE html>
<html lang="pt-BR">

<head>
        <title>Agendamento Jurídico - HCE</title>
        <!-- Required meta tags -->
        <meta charset='utf-8' />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <!-- FullCalendar CSS -->
        <link href='./css/core.css' rel='stylesheet' />
        <link href='./css/daygrid.css' rel='stylesheet' />
        <link href='./css/daygrid.css' rel='stylesheet' />
        <link href='./css/list.css' rel='stylesheet' />
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <!-- Scrollbar Custom CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
        <!-- Ícone UFAC -->
        <link rel="shortcut icon" type="image/x-icon" href="https://sistemas.ufac.br/home/wp-content/themes/sistemas/staticIndex/imagens/logo_ufac.gif">
        <!-- Formatação personalizada usando CSS -->
        <link href='./css/personalizado.css' rel='stylesheet'>
    </head>

    <body class="d-flex flex-column">
        <!-- Embrulha os objetos do website para que interajam corretamente -->
        <div class="wrapper">
            <!-- Menu sidebar -->
            <nav id="sidebar">
                <!-- Título do menu lateral -->
                <div class="sidebar-header">
                    <img id="logo" src="resources/ufac.png" alt="logo">
                    <br>
                    <h3><strong>Agendamento Jurídico</strong></h3>
                </div>
                <!-- SubMenu contendo os filtros de visaalização da pagina -->
                <ul class="list-unstyled components">
                    <p style="text-align: center;">Assessoria Jurídica | HCE</p>
                    <li>
                        <a href="index.php"><i class="fa fa-home"></i> Página Inicial</a>
                    </li>
                    <li>
                        <a href="informacao.php"><i class="fas fa-info-circle"></i> Informações</a>
                    </li>
                    <li>
                        <a href="materiais.php"><i class="fa fa-book fa-fw"></i> Materiais</a>
                    </li>
                    <li>
                        <a href="login.php"><i class="fa fa-user"></i> Login</a>
                    </li>
                </ul>
            </nav>

            <div id="content">
                <!-- Barra contendo o botão que expande/retrai o menu sidebar -->
                <!-- <nav class="navbar navbar-expand-lg">
                    <div class="container-fluid">
                        <button type="button" id="sidebarCollapse" class="btn btn-primary"><i class="fas fa-bars"></i> Menu</button>
                    </div>
                </nav> -->
                <!-- Informações sobre o website -->
                <div class="container px-5 my-5">
                    <div class="row gx-5 align-items-left">
                        <div class="col-lg-10" id='calendar'>
                            <h2 class="fw-bolder"><strong>Assessoria de Apoio para Assuntos Jurídicos</strong></h2>
                            <p class="lead fw-normal text-muted mb-0">Página em construção...</p>
                            <!-- <p class="lead fw-normal text-muted mb-0">Solicitações com aprovação pendente estão no calendário em cor <span style="color: #FFD700">amarela</span> e as aprovadas estão em <span style="color: #00D100">verde</span>.</p> -->
                            <br>
                            <h4 class="fw-bolder">Contatos</h4>
                            <p class="lead fw-normal text-muted mb-0">Página em construção...</p>
                            <!-- <p class="lead fw-normal text-muted mb-0"><a href="https://github.com/Bezerha">github.com/Bezerha</a></p>
                            <p class="lead fw-normal text-muted mb-0"><a href="https://github.com/vyctor922">github.com/vyctor922</a></p>
                            <p class="lead fw-normal text-muted mb-0"><a href="https://github.com/fredtavares2018">github.com/fredtavares2018</a></p> -->
                            <br>
                            <!-- <h4 class="fw-bolder">Versão:</h4>
                            <p class="lead fw-normal text-muted mb-0">2.3.5</p> -->
                        </div>
                    </div>
                </div>
                <!-- Rodapé da pagina -->
                <footer class="main-footer p-4 mt-5">
                    <div class="container">
                        <div class="text-center">
                            <span>Hospital Central do Exército<br>
                            <span>&copy; <span id="currentYear"></span> Divisão de Tecnologia da Informação e Comunicação</span>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <!-- JQuery Script -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <!-- Popper Script -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <!-- Bootstrap Script -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <!-- JQuerry Scroller Script -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
        <!-- FontAwesome Scripts -->
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
        <!-- Script personalizado -->
        <script src="js/personalizado.js"></script>
        <!-- Instrução JavaScript para atualizar ano vigente no footer -->
        <script>
            const yearElement = document.getElementById('currentYear');
            const currentYear = new Date().getFullYear();
            yearElement.textContent = ` ${currentYear}`;
        </script>
    </body>

</html>
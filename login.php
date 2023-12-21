<?php
    /* Iniciando conexão com banco de dados */
    require_once "./backend/conexao.php";
    /* Iniciando sessão */
    session_start();
    /* Verificação de login - se existe o redireciona a página de usuário autenticado */
    if(isset($_SESSION['usuario']))
    {
        header('Location: index_aut.php');
    }
    /* Encerrando conexão com banco de dados */
    mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="pt-BR">

    <head>
        <title>Login - Sistema de Agendamentos</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <!-- Ícone UFAC -->
        <link rel="shortcut icon" type="image/x-icon" href="https://sistemas.ufac.br/home/wp-content/themes/sistemas/staticIndex/imagens/logo_ufac.gif">
        <!-- Formatação personalizada usando CSS -->
        <link rel="stylesheet" href="./css/personalizado.css">
    </head>

    <body class="body-login">
        <!-- Encapsula os objetos dentro de uma área do website e os separa em sub áreas para que interajam corretamente -->
        <div class="area">
            <div class="area-logo">
                <a href="./">
                    <i class="fas fa-arrow-left area-btn-voltar" style="color: white"></i>
                </a>

                <img src="resources/ufac.png" id="img-logo-login" alt="logo">
            </div>

            <div class="area-login">
                <img src="resources/logo-user.png" id="img-user" alt="usuario">
                <!-- Formulário de login -->
                <form action="./backend/logar.php" method="post" class="formulario-login">
                    <div class="col">
                        <label for="">Email</label>
                        <input type="text" name="usuario" class="form-control" placeholder="Email" required="required">

                        <label for="">Senha</label>
                        <input type="password" name="senha" class="form-control" placeholder="Senha" required="required">
                        <!-- Verificação de erros -->
                        <?php
                            if (isset($_GET['erro'])) 
                            {
                                if ($_GET['erro'] == 1) 
                                {
                        ?>
                        <div class="alert alert-danger mt-3 alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Erro!</strong> Email ou Senha inválidos.
                        </div>
                        <?php
                                }
                            }
                        ?>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary mt-5"> Entrar <i class="fas fa-sign-in-alt"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- JQuery Script -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <!-- Popper Script -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <!-- Bootstrap Script -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <!-- FontAwesome Scripts -->
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    </body>

</html>
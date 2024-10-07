$(document).ready(function () {
    /* Instruções javascript - funcionamento do botão que expande/recolhe o menu sidebar */
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });
});

$(document).ready(function () {
    /* Instruções javascript - tratamento e envio das informações de cadastro do evento para o banco de dados */
    $("#addevent").on("submit", function (event) {
        event.preventDefault();
        $.ajax({
            method: "POST",
            url: "./backend/criar_evento.php",
            data: new FormData(this),
            contentType: false,
            processData: false,
            /* Instruções javascript - Alertas de alterações no banco de dados */
            success: function (retorna) {
                if (retorna['sit']) {
                    location.reload();
                } else {
                    $("#msg-add").html(retorna['msg']);
                }
            }
        })
    });
    /* Instruções javascript - funcionamento dos botões que expandem/retraem o modal de aprovação/visaulização do evento */
    $('.btn-canc-vis').on("click", function () {
        $('.visevent').slideToggle();
        $('.formedit').slideToggle();
    })
    $('.btn-canc-edit').on("click", function () {
        $('.formedit').slideToggle();
        $('.visevent').slideToggle();
    })
    /* Instruções javascript - tratamento e envio das informações de edição do evento para o banco de dados */
    $("#editevent").on("submit", function (event) {
        event.preventDefault();
        $.ajax({
            method: "POST",
            url: "./backend/aceitar_evento.php",
            data: new FormData(this),
            contentType: false,
            processData: false,
            /* Instruções javascript - Alertas de alterações no banco de dados */
            success: function (retorna) {
                if (retorna['sit']) {
                    location.reload();
                } else {
                    $("#msg-edit").html(retorna['msg']);
                }
            }
        })
    });
    /* Instruções javascript - definição de limite de tempo para os alertas */
    $(".alert").fadeTo(4000, 300).slideUp(300, function () {
        $(".alert").alert('close');
    });
});
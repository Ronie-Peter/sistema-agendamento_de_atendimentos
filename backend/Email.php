<?php


require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Email {

    public function enviar() {
        
        $mail = new PHPMailer();

        try {
            // Configurações do servidor
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com'; // SMTP do provedor de e-mail
            $mail->SMTPAuth   = true;
            $mail->Username   = 'agenda.hce.saj@gmail.com'; // Seu e-mail
            $mail->Password   = 'eplg seok kuht qtqz'; // Sua senha
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // TLS recomendado
            $mail->Port       = 587; // Porta SMTP

            // Configurações do e-mail
            $mail->setFrom('agenda.hce.saj@gmail.com', 'Agenda - Assessoria Jurídica');
            $mail->addAddress('assjhce@gmail.com', 'Agenda - Assessoria Jurídica');

            // Conteúdo do e-mail
            $mail->isHTML(true);
            $mail->Subject = 'Agenda - Assessoria Jurídica';
            $mail->Body    =  $this->bodyEmail();
        

            // Enviar e-mail
            $mail->send();
            //echo 'E-mail enviado com sucesso!';
        } catch (Exception $e) {
            //echo "Erro ao enviar o e-mail: {$mail->ErrorInfo}";
        }
        
    }

    public function bodyEmail() {

        $categoria = $_POST['title'];
        $datareserva = $_POST['date'];
        $horareserva = $_POST['start'];
        $responsavel = $_POST['responsible'];
        $portaria = $_POST['ordinance'];
        $datalimite = $_POST['term'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];

        $data_envio = date('d/m/Y');
        $hora_envio = date('H:i:s');

        return "
        <style type='text/css'>
            body {
            margin:0px;
            font-family:Verdane;
            font-size:12px;
            color: #666666;
            }
  
            a {
            color: #666666;
            text-decoration: none;
            }
  
            a:hover {
            color: #FF0000;
            text-decoration: none;
            }
        </style>
    
            <html>
                <table width='510' border='1' cellpadding='1' cellspacing='1' bgcolor='#CCCCCC'>
                    <tr>
                        <td>
                            <tr>
                            <td width='500'>Categoria: $categoria</td>
                            </tr>
                    
                            <tr>
                            <td width='320'>Data da reserva: $datareserva</td>
                            </tr>
                    
                            <tr>
                            <td width='320'>Hora da reserva: $horareserva</td>
                            </tr>
                    
                            <tr>
                            <td width='320'>Responsável: $responsavel</td>
                            </tr>
                    
                            <tr>
                            <td width='320'>Portaria: $portaria</td>
                            </tr>

                            <tr>
                            <td width='320'>Data limite: $datalimite</td>
                            </tr>

                            <tr>
                            <td width='320'>Telefone: $telefone</td>
                            </tr>

                            <tr>
                            <td width='320'>E-mail: $email</td>
                            </tr>
                        </td>
                </tr>
                <tr>
                    <td>Este e-mail foi enviado em <b>$data_envio</b> às <b>$hora_envio</b></td>
                </tr>
                </table>
            </html>";

    }

}

?>
<?php
/* FRED SERVER 
    $host = 'localhost';
    $user = 'root';
    $password = 'fred123456';
    $db_name = 'projetodois';
    $port = 21022;
*/
/* SERVER LOCAL */
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $db_name = 'projetodois';
    $port = 3306;

    $conn = mysqli_connect($host, $user, $password, $db_name, $port);

    if (mysqli_connect_errno()) {
        printf("Falha de conexão: %s\n", mysqli_connect_error());
        exit();
    }
?>
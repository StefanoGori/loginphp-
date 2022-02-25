<?php 
function db()
{
    $username="root";
    $password="";
    $servername="localhost";
    $db="es8php";


    $conn = new mysqli($servername, $username, $password, $db);

        if($conn->connect_error)
        {
            die("Connessione fallita: " . $conn->connect_error);

        }

        return $conn;
}

?>
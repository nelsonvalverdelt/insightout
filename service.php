<?php
date_default_timezone_set('America/Lima');

$date = date('m-d-Y');
$time = date('H:i:s');

$name = $_POST['name'];
$email = $_POST['email'];
$message = nl2br($_POST['message']);
$serverName = "io-server.database.windows.net";
$connectionOptions = array(
    "Database" => "insightout",
    "Uid" => "io",
    "PWD" => "@Developer19"
);
//Establishes the connection
$conn = sqlsrv_connect($serverName, $connectionOptions);

if($conn)
{
    $sql = "EXEC INSERT_CONTACT_SP @NAME = ?, @EMAIL = ?, @MESSAGE = ?";
    
    $statement = sqlsrv_prepare($conn, $sql, array(&$name, &$email, &$message));   
    if($statement){
        echo json_encode(TRUE);
    }else{
        echo json_encode("Internal Server");
    }
}else{
    echo json_encode("Internal Server");
}



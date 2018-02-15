<?php
date_default_timezone_set('America/Lima');

$date = date('m-d-Y');
$time = date('H:i:s');

$serverName = "io-server.database.windows.net";
$connectionOptions = array(
    "Database" => "insightout",
    "Uid" => "io",
    "PWD" => "@Developer19"
);
//Establishes the connection
$conn = sqlsrv_connect($serverName, $connectionOptions);

// Set up the proc params array - be sure to pass the param by reference
$params = array(
    array(&$_POST['name'], SQLSRV_PARAM_OUT),
    array(&$_POST['email'], SQLSRV_PARAM_OUT),
    array(&$_POST['message'], SQLSRV_PARAM_OUT)
    );

if($conn)
{
    $sql = "EXEC INSERT_CONTACT_SP @NAME = ?, @EMAIL = ?, @MESSAGE = ?";
    
    $statement = sqlsrv_prepare($conn, $sql, $params);   
    if($statement){
        echo json_encode(TRUE);
    }else{
        echo json_encode("Internal Server");
    }
}else{
    echo json_encode("Internal Server");
}



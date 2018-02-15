<?php
date_default_timezone_set('America/Lima');

$date = date('m-d-Y');
$time = date('H:i:s');

if( isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message']) ){
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

 // Set up the proc params array - be sure to pass the param by reference
$params = array(
    array(&$name, SQLSRV_PARAM_OUT),
    array(&$email, SQLSRV_PARAM_OUT),
    array(&$message, SQLSRV_PARAM_OUT)
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
  
}

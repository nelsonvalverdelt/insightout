<?php
/*
include '../config.php';
*/
$serverName = "io-server.database.windows.net";

$connectionOptions = array(
    "Database" => "insightout",
    "Uid" => "io",
    "PWD" => "@Developer19"
);
$conn = sqlsrv_connect($serverName, $connectionOptions);
 

// Set up the proc params array - be sure to pass the param by reference
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

$params = array(
    array($name, SQLSRV_PARAM_IN),
    array($email, SQLSRV_PARAM_IN),
    array($message, SQLSRV_PARAM_IN)
    );

if($conn)
{
    $statement = sqlsrv_query($conn, "{CALL INSERT_CONTACT_SP(?,?,?)}", $params);  
    
    sqlsrv_free_stmt($statement);
    sqlsrv_close($conn);

    if($statement){
        echo json_encode(TRUE);
    }
}else{
    echo json_encode("Internal Server");
}



?>
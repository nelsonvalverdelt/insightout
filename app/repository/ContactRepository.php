<?php

include '../config.php';

$conn = GetConnection();

print($conn);

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

    if($statement){
        echo json_encode(TRUE);
    }else{
        echo json_encode("Internal Server");
    }
}else{
    echo json_encode("Internal Server");
}

sqlsrv_free_stmt($statement);
sqlsrv_close($conn);

?>
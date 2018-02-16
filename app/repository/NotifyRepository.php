<?php

include '../config.php';

$conn = GetConnection();

$email = $_POST['email'];

$params = array(
    array($email, SQLSRV_PARAM_IN)
    );

if($conn)
{
    $statement = sqlsrv_query($conn, "{CALL INSERT_NOTIFY_SP(?)}", $params);  
    
    if($statement){
        echo json_encode(TRUE);
    }
}else{
    echo json_encode("Internal Server");
}
sqlsrv_free_stmt($statement);
sqlsrv_close($conn);



?>
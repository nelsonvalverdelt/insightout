<?php

date_default_timezone_set('America/Lima');

$date = date('m-d-Y');
$time = date('H:i:s');

function GetConnection()
{

    $serverName = "io-server.database.windows.net";

    $connectionOptions = array(
        "Database" => "insightout",
        "Uid" => "io",
        "PWD" => "@Developer19"
    );
    return sqlsrv_connect($serverName, $connectionOptions);

}
?>

<?php

$db_host = "mukadcr.database.windows.net";
$db_name = "mukadcr";
$db_user = "mukadcr";
$db_pass = "Murilodomingues1";
$dsn = "Driver={SQL Server};Server=$db_host;Port=1433;Database=$db_name;";

if(!$db = odbc_connect($dsn, $db_user, $db_pass)){

	echo "ERRO AO CONECTAR AO BANCO DE DADOS";
	exit();
}
?>
<?php
/////////postgres
/*$host = "asutpdb.vgok.ru";
$user = "asutp"; //asutp 
$pass = 'OHfGLn5YpS'; // OHfGLn5YpS
$db = "DB_ASUTP";
$con = pg_connect("host=$host dbname=$db user=$user password=$pass")
        or die("Could not connect to server fail\n");
if (!$con)
{
    die('Error: Could not connect: ' . pg_last_error());
}*/
/////////postgres

/*user = "user2";
$pass = "pass";
$data_source = "wonder";
// Some examples show "Driver={FreeTDS};" but this will not work
$dsn = "Driver=FreeTDS;ServerName=$data_source;";
$cx = odbc_connect($dsn, $user, $pass);
// Get the error message
if ($cx === false)
{
	throw new ErrorExcpetion(odbc_errormsg());
}*/
$db = new SQLite3("src/db");
if (!$db) exit("Не удалось подключиься к базе данных!"); 
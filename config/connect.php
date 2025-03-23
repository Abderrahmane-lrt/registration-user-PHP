<?php

$dsn = 'mysql:host=localhost;dbname=login';
$username = 'root';
$password = '';

try 
{
    $conn = new PDO( $dsn, $username, $password );

} catch ( PDOException $e) {
    die( 'error '.$e->getMessage() );
}

?>
<?php

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'tradematic';

$db = false;

function getMysqlConnection() {
    global $db;
    global $host;
    global $user;
    global $password;
    global $database;

    if ($db)
        return $db;

    $db = new PDO('mysql:host=' . $host . ';dbname=' . $database . ';charset=utf8', $user, $password, array(PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    return $db;
}

function executeQuery($query) {
    global $db;
    try {
        $stmt = $db->query($query);
    } catch (PDOException $ex) {
        die($ex);
    }
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function selectAllData($pixel_id) {
    $result_array = executeQuery("select `index` from exelate_data where pixel_id = " . $pixel_id);
    return $result_array;
}

?>
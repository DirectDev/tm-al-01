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

function selectAVGOfPixelId($pixel_id) {
    $result_array = executeQuery("select AVG(`index`)as avg from exelate_data where pixel_id = " . $pixel_id);
    return $result_array[0]['avg'];
}

function selectMINOfPixelId($pixel_id) {
    $result_array = executeQuery("select MIN(`index`) as min from exelate_data where pixel_id = " . $pixel_id);
    return $result_array[0]['min'];
}

function selectMAXOfPixelId($pixel_id) {
    $result_array = executeQuery("select MAX(`index`) as max from exelate_data where pixel_id = " . $pixel_id);
    return $result_array[0]['max'];
}

function selectCountOfPixelId($pixel_id) {
    $result_array = executeQuery("select COUNT(`index`) as count from exelate_data where pixel_id = " . $pixel_id);
    return $result_array[0]['count'];
}

function selectFirstQuartileOfPixelId($pixel_id) {
    return selectMaxOfPercentageOfPixelId($pixel_id, 0.25);
}

function selectMedianeOfPixelId($pixel_id) {
    return selectMaxOfPercentageOfPixelId($pixel_id, 0.5);
}

function selectThirdQuartileOfPixelId($pixel_id) {
    return selectMaxOfPercentageOfPixelId($pixel_id, 0.75);
}

function selectCentile10OfPixelId($pixel_id) {
    return selectMaxOfPercentageOfPixelId($pixel_id, 0.1);
}

function selectCentile90OfPixelId($pixel_id) {
    return selectMaxOfPercentageOfPixelId($pixel_id, 0.9);
}

function selectCentile95OfPixelId($pixel_id) {
    return selectMaxOfPercentageOfPixelId($pixel_id, 0.95);
}

function selectMaxOfPercentageOfPixelId($pixel_id, $percentage) {

    if ($percentage > 1 or $percentage < 0)
        return false;

    $count = selectCountOfPixelId($pixel_id);
    $count = round($count * $percentage, 0);

    if ($count <= 0)
        return false;

    $result_array = executeQuery("select `index` as index_max "
            . " from exelate_data "
            . " where pixel_id = " . $pixel_id
            . " order by `index` ASC"
            . " limit " . $count);
    $filtered_array = array();
    foreach ($result_array as $array) {
        $filtered_array[] = $array['index_max'];
    }
    return max($filtered_array);
}

function selectDataOfPixelId($pixel_id, $category_name, $subcategory_name) {

    $result_array = executeQuery("
        select es.id, `index` , es.name as segment_name, essc.name as subcategory_name, esc.name as category_name
        from exelate_data ed
        inner join exelate_segment es on es.id = ed.segment_id
        inner join exelate_segment_subcategory essc on essc.id = es.segment_subcategory_id
        inner join exelate_segment_category esc on esc.id = essc.segment_category_id
        where ed.pixel_id = " . $pixel_id . " 
        and esc.name = '" . $category_name . "'
        and essc.name = '" . $subcategory_name . "'");

    return $result_array;
}

?>
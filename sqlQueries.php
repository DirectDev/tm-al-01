<?php

namespace Tradematic;

use PDO;

class SqlQueries {

    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    private $database = 'tradematic';
    private $db = false;

    public function __construct() {
        $this->getMysqlConnection();
        $this->createOutputTable();
    }

    private function getMysqlConnection() {
        if (!$this->db)
            $this->db = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->database . ';charset=utf8', $this->user, $this->password, array(PDO::ATTR_EMULATE_PREPARES => false,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }

    private function executeQuery($query) {
        try {
            $stmt = $this->db->query($query);
        } catch (PDOException $ex) {
            die($ex);
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectAllData($pixel_id) {
        $result_array = $this->executeQuery("select `index` from exelate_data where pixel_id = " . $pixel_id);
        return $result_array;
    }

    public function selectPixelName($pixel_id) {
        $result_array = $this->executeQuery("select `name` from exelate_pixel where id = " . $pixel_id);
        if (count($result_array))
            return $result_array[0]["name"];
    }

    public function selectAVGOfPixelId($pixel_id) {
        $result_array = $this->executeQuery("select AVG(`index`)as avg from exelate_data where pixel_id = " . $pixel_id);
        return $result_array[0]['avg'];
    }

    public function selectMINOfPixelId($pixel_id) {
        $result_array = $this->executeQuery("select MIN(`index`) as min from exelate_data where pixel_id = " . $pixel_id);
        return $result_array[0]['min'];
    }

    public function selectMAXOfPixelId($pixel_id) {
        $result_array = $this->executeQuery("select MAX(`index`) as max from exelate_data where pixel_id = " . $pixel_id);
        return $result_array[0]['max'];
    }

    public function selectCountOfPixelId($pixel_id) {
        $result_array = $this->executeQuery("select COUNT(`index`) as count from exelate_data where pixel_id = " . $pixel_id);
        return $result_array[0]['count'];
    }

    public function selectFirstQuartileOfPixelId($pixel_id) {
        return $this->selectMaxOfPercentageOfPixelId($pixel_id, 0.25);
    }

    public function selectMedianeOfPixelId($pixel_id) {
        return $this->selectMaxOfPercentageOfPixelId($pixel_id, 0.5);
    }

    public function selectThirdQuartileOfPixelId($pixel_id) {
        return $this->selectMaxOfPercentageOfPixelId($pixel_id, 0.75);
    }

    public function selectCentile10OfPixelId($pixel_id) {
        return $this->selectMaxOfPercentageOfPixelId($pixel_id, 0.1);
    }

    public function selectCentile90OfPixelId($pixel_id) {
        return $this->selectMaxOfPercentageOfPixelId($pixel_id, 0.9);
    }

    public function selectCentile95OfPixelId($pixel_id) {
        return $this->selectMaxOfPercentageOfPixelId($pixel_id, 0.95);
    }

    public function selectMaxOfPercentageOfPixelId($pixel_id, $percentage) {

        if ($percentage > 1 or $percentage < 0)
            return false;

        $count = $this->selectCountOfPixelId($pixel_id);
        $count = round($count * $percentage, 0);

        if ($count <= 0)
            return false;

        $result_array = $this->executeQuery("select `index` as index_max "
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

    public function selectDataOfPixelId($pixel_id, $category_name, $subcategory_name) {

        $result_array = $this->executeQuery("
        select es.id, `index` , es.name as segment_name, essc.name as subcategory_name, esc.name as category_name, es.fr as fr
        from exelate_data ed
        inner join exelate_segment es on es.id = ed.segment_id
        inner join exelate_segment_subcategory essc on essc.id = es.segment_subcategory_id
        inner join exelate_segment_category esc on esc.id = essc.segment_category_id
        where ed.pixel_id = " . $pixel_id . " 
        and esc.name = '" . $category_name . "'
        and essc.name = '" . $subcategory_name . "'");

        return $result_array;
    }

    public function selectIndexDataByFrOfPixelId($pixel_id, $category_name, $subcategory_name, $fr) {

        $result_array = $this->executeQuery("
        select es.id, `index` , es.name as segment_name, essc.name as subcategory_name, esc.name as category_name, es.fr as fr
        from exelate_data ed
        inner join exelate_segment es on es.id = ed.segment_id
        inner join exelate_segment_subcategory essc on essc.id = es.segment_subcategory_id
        inner join exelate_segment_category esc on esc.id = essc.segment_category_id
        where ed.pixel_id = " . $pixel_id . " 
        and esc.name = '" . $category_name . "'
        and essc.name = '" . $subcategory_name . "'
        and es.fr like '%" . $fr . "%'
        limit 1");

        if (count($result_array))
            return $result_array[0]['index'];
    }

    public function createOutputTable() {
        $this->executeQuery("create table if not exists `tradematic`.`exelate_data_output_version`( `id` int NOT NULL AUTO_INCREMENT , `pixel_id` int , `filename` varchar(55) , `timestamp` timestamp , PRIMARY KEY (`id`))  ;");
    }

    public function addFileToHistory($pixel_id, $filename) {
        $this->executeQuery("insert into `exelate_data_output_version`(`id`,`pixel_id`,`filename`) 
            values ( NULL," . $pixel_id . ",'" . $filename . "')");
    }

}

?>
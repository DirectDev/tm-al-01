<?php

include 'sqlQueries.php';
include 'Workbook.php';
include '/PHPExcel/Classes/PHPExcel.php';
if (!defined('PHPEXCEL_ROOT')) {
    /**
     * @ignore
     */
    define('PHPEXCEL_ROOT', dirname(__FILE__) . '/../../');
    require(PHPEXCEL_ROOT . 'PHPExcel/Autoloader.php');
}

set_time_limit(120);

$file = 'file/';
if (!file_exists($file))
    die('file does not exist');

new Workbook(1, $file);
new Workbook(2, $file);
new Workbook(3, $file);
new Workbook(4, $file);
new Workbook(5, $file);
new Workbook(6, $file);
new Workbook(7, $file);
new Workbook(8, $file);
new Workbook(9, $file);

var_dump('fin des exports');

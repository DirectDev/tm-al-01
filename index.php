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
var_dump(PHPEXCEL_ROOT . 'PHPExcel/Autoloader.php');


//getMysqlConnection();

$sql = new Tradematic\SqlQueries();
var_dump($sql->selectAVGOfPixelId(1));

//$res = selectFirstQuartileOfPixelId(1);
//var_dump($res);
////foreach ($res as $data) {
////    var_dump($data);
////    
////}
//$res = selectMedianeOfPixelId(1);
//var_dump($res);
//
//$res = selectThirdQuartileOfPixelId(1);
//var_dump($res);
//
//$res = selectCentile10OfPixelId(1);
//var_dump($res);
//$res = selectCentile90OfPixelId(1);
//var_dump($res);
//$res = selectCentile95OfPixelId(1);
//var_dump($res);
//
//$res = selectDataOfPixelId(1, 'Demographic', 'Age') ;
//var_dump($res);

$workbook = new Workbook(1); 
//$excel = new PHPExcel();

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


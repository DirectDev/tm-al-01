<?php

include 'sql.php';

getMysqlConnection();

$res = selectFirstQuartileOfPixelId(1);
var_dump($res);
//foreach ($res as $data) {
//    var_dump($data);
//    
//}
$res = selectMedianeOfPixelId(1);
var_dump($res);

$res = selectThirdQuartileOfPixelId(1);
var_dump($res);

$res = selectCentile10OfPixelId(1);
var_dump($res);
$res = selectCentile90OfPixelId(1);
var_dump($res);
$res = selectCentile95OfPixelId(1);
var_dump($res);

$res = selectDataOfPixelId(1, 'Demographic', 'Age') ;
var_dump($res);


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


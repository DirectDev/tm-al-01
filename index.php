<?php

include 'sql.php';

getMysqlConnection();

$res = selectAllData(1);
foreach ($res as $data) {
    var_dump($data);
    
}

var_dump($res);

cleanUpDB();

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


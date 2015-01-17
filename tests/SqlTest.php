<?php

include '/../sql.php';

class SqlTest extends PHPUnit_Framework_TestCase {

    public function testSelectFirstQuartileOfPixelId() {
        getMysqlConnection();
        $this->assertNotEquals(selectFirstQuartileOfPixelId(1), false);
        $this->assertEquals(selectFirstQuartileOfPixelId(1), 1.30);
    }

    public function testSelectMedianeOfPixelId() {
        getMysqlConnection();
        $this->assertNotEquals(selectMedianeOfPixelId(1), false);
        $this->assertEquals(selectMedianeOfPixelId(1), 1.51);
    }

    public function testSelectThirdQuartileOfPixelId() {
        getMysqlConnection();
        $this->assertNotEquals(selectThirdQuartileOfPixelId(1), false);
        $this->assertEquals(selectThirdQuartileOfPixelId(1), 1.78);
    }

    public function testCentile10OfPixelId() {
        getMysqlConnection();
        $this->assertNotEquals(selectCentile10OfPixelId(1), false);
        $this->assertEquals(selectCentile10OfPixelId(1), 1.04);
    }

    public function testCentile90OfPixelId() {
        getMysqlConnection();
        $this->assertNotEquals(selectCentile90OfPixelId(1), false);
        $this->assertEquals(selectCentile90OfPixelId(1), 2.07);
    }

    public function testCentile95OfPixelId() {
        getMysqlConnection();
        $this->assertNotEquals(selectCentile95OfPixelId(1), false);
        $this->assertEquals(selectCentile95OfPixelId(1), 2.37);
    }

}

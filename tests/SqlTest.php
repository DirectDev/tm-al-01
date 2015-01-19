<?php

include '/../sqlQueries.php';

use Tradematic\SqlQueries;

class SqlTest extends PHPUnit_Framework_TestCase {

    private $sqlQueries;

    public function __construct() {
        $this->sqlQueries = new SqlQueries();
    }

    public function testSelectFirstQuartileOfPixelId() {
        $this->assertNotEquals($this->sqlQueries->selectFirstQuartileOfPixelId(1), false);
        $this->assertEquals($this->sqlQueries->selectFirstQuartileOfPixelId(1), 1.30);
    }

    public function testSelectMedianeOfPixelId() {
        $this->assertNotEquals($this->sqlQueries->selectMedianeOfPixelId(1), false);
        $this->assertEquals($this->sqlQueries->selectMedianeOfPixelId(1), 1.51);
    }

    public function testSelectThirdQuartileOfPixelId() {
        $this->assertNotEquals($this->sqlQueries->selectThirdQuartileOfPixelId(1), false);
        $this->assertEquals($this->sqlQueries->selectThirdQuartileOfPixelId(1), 1.78);
    }

    public function testCentile10OfPixelId() {
        $this->assertNotEquals($this->sqlQueries->selectCentile10OfPixelId(1), false);
        $this->assertEquals($this->sqlQueries->selectCentile10OfPixelId(1), 1.04);
    }

    public function testCentile90OfPixelId() {
        $this->assertNotEquals($this->sqlQueries->selectCentile90OfPixelId(1), false);
        $this->assertEquals($this->sqlQueries->selectCentile90OfPixelId(1), 2.07);
    }

    public function testCentile95OfPixelId() {
        $this->assertNotEquals($this->sqlQueries->selectCentile95OfPixelId(1), false);
        $this->assertEquals($this->sqlQueries->selectCentile95OfPixelId(1), 2.37);
    }

    public function testSelectDataOfPixelId() {
        $this->assertNotEquals($this->sqlQueries->selectDataOfPixelId(1, 'Demographic', 'Age'), false);
        $this->assertEquals(count($this->sqlQueries->selectDataOfPixelId(1, 'Demographic', 'Age')), 12);
    }

}

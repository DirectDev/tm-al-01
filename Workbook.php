<?php

use Tradematic\SqlQueries;

class Workbook {

    private $workbook;
    private $name = 'obj_writer.xlsx';
    private $activeWorksheet;
    private $sqlQueries;
    private $pixel_id;

    public function __construct($pixel_id) {
        $this->pixel_id = $pixel_id;
        $this->sqlQueries = new SqlQueries();
        $this->create();
    }

    public function create() {
        $this->openTemplate();
        $this->writeFirstWorksheet();
//        $this->writeSecondWorksheet();
//        $this->writeThirdWorksheet();
//        $this->writeFourthWorksheet();
        $this->saveFile();
    }

    private function openTemplate() { // a tester avec version xlsx
        $this->workbook = PHPExcel_IOFactory::load('template.xls');
    }

    private function writeFirstWorksheet() {
        $this->activeWorksheet = $this->workbook->setActiveSheetIndex(0);

        $value = $this->sqlQueries->selectCountOfPixelId(1);
        $this->fillCell('C', 9, $value);
        
        $this->fillCell('C', 9, $this->sqlQueries->selectAVGOfPixelId($this->pixel_id));
        $this->fillCell('C', 10, $this->sqlQueries->selectMINOfPixelId($this->pixel_id));
        $this->fillCell('C', 11, $this->sqlQueries->selectMAXOfPixelId($this->pixel_id));
        
        $this->fillCell('F', 9, $this->sqlQueries->selectFirstQuartileOfPixelId($this->pixel_id));
        $this->fillCell('F', 10, $this->sqlQueries->selectMedianeOfPixelId($this->pixel_id));
        $this->fillCell('F', 11, $this->sqlQueries->selectThirdQuartileOfPixelId($this->pixel_id));
        
        $this->fillCell('I', 9, $this->sqlQueries->selectCentile10OfPixelId($this->pixel_id));
        $this->fillCell('I', 10, $this->sqlQueries->selectMedianeOfPixelId($this->pixel_id));
        $this->fillCell('I', 11, $this->sqlQueries->selectCentile90OfPixelId($this->pixel_id));
        $this->fillCell('I', 12, $this->sqlQueries->selectCentile95OfPixelId($this->pixel_id));

//        $this->workbook->removeSheetByIndex(0);
//        $this->workbook->addSheet(new PHPExcel_Worksheet($this->workbook, 'SUMMARY'), 0);
    }

    private function writeSecondWorksheet() {
        $this->workbook->addSheet(new PHPExcel_Worksheet($this->workbook, 'DEMOGRAPHIC'), 1);
    }

    private function writeThirdWorksheet() {
        $this->workbook->addSheet(new PHPExcel_Worksheet($this->workbook, 'INTERETS'), 2);
    }

    private function writeFourthWorksheet() {
        $this->workbook->addSheet(new PHPExcel_Worksheet($this->workbook, 'INTENTIONS'), 3);
    }

    private function saveFile() {
        $objWriter = new PHPExcel_Writer_Excel2007($this->workbook);
        $objWriter->save($this->name);
        var_dump('fin');
    }

    private function fillCell($column, $row, $value, $color = null) {
        $this->activeWorksheet->setCellValue($column . $row, $value);
        $color = PHPExcel_Style_Color::COLOR_RED;
        if ($color) {
            $this->activeWorksheet->getStyle($column . $row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
//            $this->activeWorksheet->getStyle($column . $row)->getFill()->getStartColor()->setARGB($color);
            $this->activeWorksheet->getStyle($column . $row)->getFont()->getColor()->setARGB($color);
        }
    }

}

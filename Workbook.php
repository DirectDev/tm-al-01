<?php

use Tradematic\SqlQueries;

class Workbook {

    private $workbook;
    private $name = 'obj_writer.xlsx';
    private $activeWorksheet;
    private $sqlQueries;
    private $pixel_id;
    private $category;
    private $subcategory;
    private $centile10;
    private $mediane;
    private $centile90;

    public function __construct($pixel_id, $path = null) {
        $this->pixel_id = $pixel_id;
        $this->sqlQueries = new SqlQueries();
        if ($path)
            $this->name = $path;
        $this->name .= 'Tradelab-advertiser_id-' . $this->sqlQueries->selectPixelName($pixel_id) . '-' . date('Y-m-d-H-i') . '.xlsx';
        $this->create();
    }

    public function create() {
        $this->openTemplate();
        $this->writeFirstWorksheet();
        $this->writeSecondWorksheet();
        $this->writeThirdWorksheet();
        $this->writeFourthWorksheet();
        $this->saveFile();
    }

    private function openTemplate() { // a tester avec version xlsx
        $this->workbook = PHPExcel_IOFactory::load('template.xls');
    }

    private function writeFirstWorksheet() {
        $this->activeWorksheet = $this->workbook->setActiveSheetIndex(0);

        $this->centile10 = $this->sqlQueries->selectCentile10OfPixelId($this->pixel_id);
        $this->mediane = $this->sqlQueries->selectMedianeOfPixelId($this->pixel_id);
        $this->centile90 = $this->sqlQueries->selectCentile90OfPixelId($this->pixel_id);

        $this->fillCell('C', 9, $this->sqlQueries->selectAVGOfPixelId($this->pixel_id), false);
        $this->fillCell('C', 10, $this->sqlQueries->selectMINOfPixelId($this->pixel_id), false);
        $this->fillCell('C', 11, $this->sqlQueries->selectMAXOfPixelId($this->pixel_id), false);

        $this->fillCell('F', 9, $this->sqlQueries->selectFirstQuartileOfPixelId($this->pixel_id), false);
        $this->fillCell('F', 10, $this->mediane, false);
        $this->fillCell('F', 11, $this->sqlQueries->selectThirdQuartileOfPixelId($this->pixel_id, false));

        $this->fillCell('I', 9, $this->centile10, false);
        $this->fillCell('I', 10, $this->mediane, false);
        $this->fillCell('I', 11, $this->centile90, false);
        $this->fillCell('I', 12, $this->sqlQueries->selectCentile95OfPixelId($this->pixel_id), false);
    }

    private function writeSecondWorksheet() {

        $this->activeWorksheet = $this->workbook->setActiveSheetIndex(1);

        $this->category = 'Demographic';
        $this->subcategory = 'Male Age';

        $this->fillCell('C', 8, $this->getIndexForFr('Hommes - 18-19'));
        $this->fillCell('C', 9, $this->getIndexForFr('Hommes - 20'));
        $this->fillCell('C', 10, $this->getIndexForFr('Hommes - 25'));
        $this->fillCell('C', 11, $this->getIndexForFr('Hommes - 30'));
        $this->fillCell('C', 12, $this->getIndexForFr('Hommes - 35'));
        $this->fillCell('C', 13, $this->getIndexForFr('Hommes - 40'));
        $this->fillCell('C', 14, $this->getIndexForFr('Hommes - 45'));
        $this->fillCell('C', 15, $this->getIndexForFr('Hommes - 50'));
        $this->fillCell('C', 16, $this->getIndexForFr('Hommes - 55'));
        $this->fillCell('C', 17, $this->getIndexForFr('Hommes - 60'));
        $this->fillCell('C', 18, $this->getIndexForFr('Hommes - 65'));
        $this->fillCell('C', 19, $this->getIndexForFr('Hommes - 70'));

        $this->subcategory = 'Female Age';
        $this->fillCell('D', 8, $this->getIndexForFr('Femmes - 18-19'));
        $this->fillCell('D', 9, $this->getIndexForFr('Femmes - 20'));
        $this->fillCell('D', 10, $this->getIndexForFr('Femmes - 25'));
        $this->fillCell('D', 11, $this->getIndexForFr('Femmes - 30'));
        $this->fillCell('D', 12, $this->getIndexForFr('Femmes - 35'));
        $this->fillCell('D', 13, $this->getIndexForFr('Femmes - 40'));
        $this->fillCell('D', 14, $this->getIndexForFr('Femmes - 45'));
        $this->fillCell('D', 15, $this->getIndexForFr('Femmes - 50'));
        $this->fillCell('D', 16, $this->getIndexForFr('Femmes - 55'));
        $this->fillCell('D', 17, $this->getIndexForFr('Femmes - 60'));
        $this->fillCell('D', 18, $this->getIndexForFr('Femmes - 65'));
        $this->fillCell('D', 19, $this->getIndexForFr('Femmes - 70'));

        $this->subcategory = 'Gender';
        $this->fillCell('C', 21, $this->getIndexForFr('Homme'));
        $this->fillCell('D', 21, $this->getIndexForFr('Femme'));

        $this->subcategory = 'Age';
        $this->fillRowsFromData(23, 'C', 'D');

        $this->subcategory = 'Career';
        $this->fillRowsFromData(9, 'G', 'H');

        $this->subcategory = 'Income Level';
        $this->fillRowsFromData(28, 'G', 'H');

        $this->subcategory = 'Household';
        $this->fillRowsFromData(9, 'J', 'K');

        $this->subcategory = 'Urbanicity';
        $this->fillRowsFromData(16, 'J', 'K');
    }

    private function writeThirdWorksheet() {
        $this->activeWorksheet = $this->workbook->setActiveSheetIndex(2);
        $this->category = 'Interest';

        $this->subcategory = 'Beauty and Style';
        $this->fillRowsFromData(5, 'B', 'C', true);

        $this->subcategory = 'Diet and Fitness';
        $this->fillRowsFromData(9, 'B', 'C', true);

        $this->subcategory = 'Entertainment';
        $this->fillRowsFromData(12, 'B', 'C', true);

        $this->subcategory = 'Events';
        $this->fillRowsFromData(22, 'B', 'C', true);

        $this->subcategory = 'General Interest';
        $this->fillRowsFromData(30, 'B', 'C', true);

        $this->subcategory = 'Home Improvement';
        $this->fillRowsFromData(5, 'E', 'F', true);

        $this->subcategory = 'Hobbies';
        $this->fillRowsFromData(11, 'E', 'F', true);

        $this->subcategory = 'Parenting';
        $this->fillRowsFromData(21, 'E', 'F', true);

        $this->subcategory = 'Politics';
        $this->fillRowsFromData(27, 'E', 'F', true);

        $this->subcategory = 'Automotive Owners';
        $this->fillRowsFromData(29, 'E', 'F', true);

        $this->subcategory = 'Sports';
        $this->fillRowsFromData(35, 'E', 'F', true);

        $this->subcategory = 'Pets';
        $this->fillRowsFromData(38, 'E', 'F', true);

        $this->subcategory = 'Finance';
        $this->fillRowsFromData(40, 'E', 'F', true);

        $this->subcategory = 'Tech - Enthusiasts';
        $this->fillRowsFromData(7, 'H', 'I', true);
    }

    private function writeFourthWorksheet() {
        $this->activeWorksheet = $this->workbook->setActiveSheetIndex(3);
        $this->category = 'Intent';

        $this->subcategory = 'Auto - Buyers';
        $this->fillRowsFromData(7, 'B', 'C', true, true);

        $this->subcategory = 'Shopping';
        $this->fillRowsFromData(7, 'E', 'F', true, true);

        $this->subcategory = 'Travel';
        $this->fillRowsFromData(7, 'H', 'I', true, true);

        $this->subcategory = 'Finance and Insurance';
        $this->fillRowsFromData(7, 'K', 'L', true, true);

        $this->subcategory = 'CPG';
        $this->fillRowsFromData(12, 'K', 'L', true, true);

        $this->subcategory = 'Services';
        $this->fillRowsFromData(19, 'K', 'L', true, true);
    }

    private function saveFile() {
        $objWriter = new PHPExcel_Writer_Excel2007($this->workbook);
        $objWriter->save($this->name);
        $this->sqlQueries->addFileToHistory($this->pixel_id, $this->name);
    }

    private function fillCell($column, $row, $value, $color = false) {
        $this->activeWorksheet->setCellValue($column . $row, $value);
        if ($color) {
            $this->activeWorksheet->getStyle($column . $row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
            $this->activeWorksheet->getStyle($column . $row)->getFill()->getStartColor()->setARGB($color);
//            $this->activeWorksheet->getStyle($column . $row)->getFont()->getColor()->setARGB($color);
        }
    }

    private function getIndexForFr($fr) {
        return $this->sqlQueries->selectIndexDataByFrOfPixelId($this->pixel_id, $this->category, $this->subcategory, $fr);
    }

    private function fillRowsFromData($start_row, $title_column, $index_column, $color = false, $border = false) {
        $array = $this->sqlQueries->selectDataOfPixelId($this->pixel_id, $this->category, $this->subcategory);
        $row = $start_row;
        foreach ($array as $line) {
            if ($color !== false)
                $color = $this->getColor($line['index']);
            $this->fillCell($title_column, $row, $line['fr'], $color);
            $this->fillCell($index_column, $row, $line['index']);
            $row++;
        }

        if (!$border)
            return;

        $cells = $title_column . $start_row . ':' . $index_column . ($row - 1);
        $this->activeWorksheet->getStyle($cells)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
        $this->activeWorksheet->getStyle($cells)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
        $this->activeWorksheet->getStyle($cells)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
        $this->activeWorksheet->getStyle($cells)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
    }

    private function getColor($index) {
        if ($index >= $this->centile90)
            return PHPExcel_Style_Color::COLOR_GREEN;
        if ($index >= $this->mediane)
            return PHPExcel_Style_Color::COLOR_YELLOW;
        return PHPExcel_Style_Color::COLOR_RED;
    }

}

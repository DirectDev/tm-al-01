<?php

use Tradematic\SqlQueries;

class Workbook {

    private $workbook;
    private $name;
    private $activeWorksheet;
    private $sqlQueries;
    private $pixel_id;
    private $category;
    private $subcategory;
    private $centile10;
    private $mediane;
    private $centile90;
    private $actual_row;
    private $colors;

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
        $this->activeWorksheet = $this->workbook->setActiveSheetIndex(0);
        $this->saveFile();
    }

    private function openTemplate() { // a tester avec version xlsx
        $this->workbook = PHPExcel_IOFactory::load('template.xlsx');
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


        $this->colors = array(
            $this->centile10 => "255,00,00",
            $this->mediane => "255,255,00",
            $this->centile90 => "00, 255, 00",
            $this->centile90 => "00, 255, 00",
        );
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
        $this->fillRowsFromData(23, 'C', 'D', true, true);

        $this->subcategory = 'Career';
        $this->actual_row = 7;
        $this->fillRowsFromData($this->actual_row, 'G', 'H', true, true);

        $this->subcategory = 'Income Level';
        $this->fillRowsFromData($this->actual_row, 'G', 'H', true, true);

        $this->subcategory = 'Household';
        $this->actual_row = 7;
        $this->fillRowsFromData($this->actual_row, 'J', 'K', true, true);

        $this->subcategory = 'Urbanicity';
        $this->fillRowsFromData($this->actual_row, 'J', 'K', true, true);
    }

    private function writeThirdWorksheet() {
        $this->activeWorksheet = $this->workbook->setActiveSheetIndex(2);
        $this->category = 'Interest';

        $this->subcategory = 'Beauty and Style';
        $this->actual_row = 5;
        $this->fillRowsFromData($this->actual_row, 'B', 'C', true, true);

        $this->subcategory = 'Diet and Fitness';
        $this->fillRowsFromData($this->actual_row, 'B', 'C', true, true);

        $this->subcategory = 'Entertainment';
        $this->fillRowsFromData($this->actual_row, 'B', 'C', true, true);

        $this->subcategory = 'Events';
        $this->fillRowsFromData($this->actual_row, 'B', 'C', true, true);

        $this->subcategory = 'General Interest';
        $this->fillRowsFromData($this->actual_row, 'B', 'C', true, true);

        $this->subcategory = 'Home Improvement';
        $this->actual_row = 5;
        $this->fillRowsFromData($this->actual_row, 'E', 'F', true, true);

        $this->subcategory = 'Hobbies';
        $this->fillRowsFromData($this->actual_row, 'E', 'F', true, true);

        $this->subcategory = 'Parenting';
        $this->fillRowsFromData($this->actual_row, 'E', 'F', true, true);

        $this->subcategory = 'Politics';
        $this->fillRowsFromData($this->actual_row, 'E', 'F', true, true);

        $this->subcategory = 'Automotive Owners';
        $this->fillRowsFromData($this->actual_row, 'E', 'F', true, true);

        $this->subcategory = 'Sports';
        $this->fillRowsFromData($this->actual_row, 'E', 'F', true, true);

        $this->subcategory = 'Pets';
        $this->fillRowsFromData($this->actual_row, 'E', 'F', true, true);

        $this->subcategory = 'Finance';
        $this->fillRowsFromData($this->actual_row, 'E', 'F', true, true);

        $this->subcategory = 'Tech - Enthusiasts';
        $this->actual_row = 7;
        $this->fillRowsFromData($this->actual_row, 'H', 'I', true, true);
    }

    private function writeFourthWorksheet() {
        $this->activeWorksheet = $this->workbook->setActiveSheetIndex(3);
        $this->category = 'Intent';

        $this->subcategory = 'Auto - Buyers';
        $this->actual_row = 7;
        $this->fillRowsFromData($this->actual_row, 'B', 'C', true, true);

        $this->subcategory = 'Shopping';
        $this->actual_row = 7;
        $this->fillRowsFromData($this->actual_row, 'E', 'F', true, true);

        $this->subcategory = 'Travel';
        $this->actual_row = 7;
        $this->fillRowsFromData($this->actual_row, 'H', 'I', true, true);

        $this->subcategory = 'Finance and Insurance';
        $this->actual_row = 7;
        $this->fillRowsFromData($this->actual_row, 'K', 'L', true, true);

        $this->subcategory = 'CPG';
        $this->fillRowsFromData($this->actual_row, 'K', 'L', true, true);

        $this->subcategory = 'Services';
        $this->fillRowsFromData($this->actual_row, 'K', 'L', true, true);
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
            $this->activeWorksheet->getStyle($column . $row)->getFill()->getStartColor()->setRGB($color);
        }
    }

    private function getIndexForFr($fr) {
        return $this->sqlQueries->selectIndexDataByFrOfPixelId($this->pixel_id, $this->category, $this->subcategory, $fr);
    }

    private function fillRowsFromData($start_row, $title_column, $index_column, $color = false, $border = false) {
        $array = $this->sqlQueries->selectDataOfPixelId($this->pixel_id, $this->category, $this->subcategory);
        if (!count($array))
            return;
        $row = $start_row;
        foreach ($array as $line) {
            if ($color !== false)
                $color = $this->getColor($line['index']);
            $this->fillCell($title_column, $row, $line['fr'], 'F2F2F2');
            $this->fillCell($index_column, $row, $line['index'], $color);
            $row++;
        }

        $this->actual_row = ($row + 1);

        if (!$border)
            return;

        $cells = $title_column . $start_row . ':' . $index_column . ($row - 1);
        $this->activeWorksheet->getStyle($cells)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
        $this->activeWorksheet->getStyle($cells)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
        $this->activeWorksheet->getStyle($cells)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
        $this->activeWorksheet->getStyle($cells)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);

        return;
    }

    private function getColor($index) {
        if ($index > $this->centile10)
            return $this->getColorCode($index);
        return 'FF0000';
    }

    private function getColorCode($var) {

        $colors_keys = array_keys($this->colors);
        $colors_RGB = array_values($this->colors);
        $dest_color = null;
        $count = sizeof($this->colors) - 1;

        for ($i = 0; $i < $count; $i++) {

            if ($var >= $colors_keys[$i] && $var < $colors_keys[$i + 1]) {

                $rgb1 = explode(",", $colors_RGB[$i]);
                $rgb2 = explode(",", $colors_RGB[$i + 1]);

                for ($j = 0; $j < 3; $j++) {

                    $c = (max($rgb1[$j], $rgb2[$j]) - min($rgb1[$j], $rgb2[$j])) / (max($colors_keys[$i], $colors_keys[$i + 1]) - min($colors_keys[$i], $colors_keys[$i + 1]));
                    if ($rgb1[$j] < $rgb2[$j]) {
                        $dest_color .= round(max($rgb1[$j], $rgb2[$j]) - ((max($colors_keys[$i], $colors_keys[$i + 1]) - $var) * $c));
                    } else {
                        $dest_color .= round(min($rgb1[$j], $rgb2[$j]) + ((max($colors_keys[$i], $colors_keys[$i + 1]) - $var) * $c));
                    }
                    if ($j != 2) {
                        $dest_color.=",";
                    }
                }
            }
        }
        if ($var <= $colors_keys[0]) {
            $dest_color = $colors_RGB[0];
        }
        if ($var >= $colors_keys[sizeof($this->colors) - 1]) {
            $dest_color = $colors_RGB[sizeof($this->colors) - 1];
        }

        return $this->convertColor($dest_color);
    }

    private function convertColor($color) {
        $hex_RGB = null;
        if (!is_array($color)) {
            $color = explode(",", $color);
        }

        foreach ($color as $value) {
            $hex_value = dechex($value);
            if (strlen($hex_value) < 2) {
                $hex_value = "0" . $hex_value;
            }
            $hex_RGB.=$hex_value;
        }

        return $hex_RGB;
    }

}

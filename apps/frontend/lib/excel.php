<?php

/**
 * Description of excel
 *
 * @author Furqan
 */
require 'PHPExcel.php';

class excel extends PHPExcel {

    protected $headings = array();
    protected $dataArray = array();
    protected $filename = array();
    protected $Title = array();
    protected $UploadDicrectoryPath = array();

    function __construct($UploadDicrectoryPath = null) {
        parent::__construct();
        if (!$UploadDicrectoryPath)
            $this->UploadDicrectoryPath = sfConfig::get('sf_upload_dir');
        else {
            $this->UploadDicrectoryPath = $UploadDicrectoryPath;
        }
    }

    /**
     * Set File name for Exported Excel File 
     * 
     * @param String Excel_File_Name 
     * 
     */
    public function setFileName($filename) {
        $this->filename = $filename;
    }

    /**
     * Set File name for Exported Excel File 
     * 
     * 
     * @return Returns File name of Exported Excel File 
     */
    public function getFileName() {
        return $this->filename;
    }

    /**
     * Set Array of data using which Exported Excel File 
     * 
     * @param Array Array_of_Data_Export
     * 
     */
    public function setDataArray($dataArray) {
        $this->dataArray = $dataArray;
    }

    /**
     * get Array of data using which Exported Excel File 
     * 
     * @return Array Array_of_Data_Export 
     */
    public function getDataArray() {
        return $this->dataArray;
    }

    /**
     * Set Title of Exported Excel File 
     * 
     * @param String $Title_of_exported_file
     * 
     */
    public function setSheetTitle($Title) {
        $this->Title = $Title;
    }

    /**
     * getTitle of Exported Excel File 
     * 
     * @return String $Title_of_exported_file 
     * 
     */
    public function getSheetTitle() {
        return $this->Title;
    }

    /**
     * Set Headings of Exported Excel File 
     * 
     * @param Array Array_of_Headings_for_excel_file
     * 
     */
    public function setHeadings($headings) {
        $this->headings = $headings;
    }

    /**
     *  Get Headings of Exported Excel File 
     * 
     * @return Array Array_of_Headings_for_excel_file
     * 
     * 
     */

    /**
     * Set Upload Path for excel Handler
     * 
     * @param String   Upload Path 
     */
    public function setUploadDicrectoryPath($UploadDicrectoryPath = null) {
        $this->UploadDicrectoryPath = $UploadDicrectoryPath;
    }

    /**
     * Get Upload Path for excel Handler
     * 
     * @return String
     */
    public function getUploadDicrectoryPath() {
        return $this->UploadDicrectoryPath;
    }

    public function getHeadings() {
        return $this->headings;
    }

    /**
     *  Extract headings from the DataArray Provided for Excel file
     * 
     * @return Array Array_of_Headings_for_excel_file
     * 
     * 
     */
    public function extractHeadings($using_index = 0) {
        return $this->headings = array_keys($this->dataArray[$using_index]);
    }

    /**
     *  Set Data Type of a Element
     *  @param AnyType $element_of_dataArray
     * 
     *  @return PHPExcel_Cell_DataType $Provided_Element_Suited_Data_Type
     */
    function SetDataTypeExcel($element, $dataType = PHPExcel_Cell_DataType::TYPE_STRING) {

        if (is_numeric($element)) {
            $dataType = PHPExcel_Cell_DataType::TYPE_NUMERIC;
        }
        return $dataType;
    }

    /**
     *  Generates the content of the excel file
     * 
     * @param Boolean $addFilters
     * @param Array $FiltersApplied
     * 
     */
    function createExcel($addFilters = FALSE, $Filters = array()) {
        $this->getActiveSheetIndex();
        $this->getActiveSheet()->setTitle($this->getSheetTitle());
        $ThisStyleSheet = $this->getActiveSheet();
        $styleArray = array(
//            'font' => array(
//                'bold' => true,
//            ),
//            'alignment' => array(
//                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
//            ),
//            'borders' => array(
//                'top' => array(
//                    'style' => PHPExcel_Style_Border::BORDER_THIN,
//                ),
//            ),
//            'fill' => array(
//                'type' => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
//                'rotation' => 90,
//                'startcolor' => array(
//                    'argb' => 'FFA0A0A0',
//                ),
//                'endcolor' => array(
//                    'argb' => 'FFFFFFFF',
//                ),
//            ),
        );
        $styleArrayFilters = array(
//            'font' => array(
//                'bold' => true,
//            ),
//            'alignment' => array(
//                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
//            ),
//            'borders' => array(
//                'top' => array(
//                    'style' => PHPExcel_Style_Border::BORDER_THIN,
//                ),
//            ),
//            'fill' => array(
//                'type' => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
//                'rotation' => 90,
//                'startcolor' => array(
//                    'argb' => '1639292',
//                ),
//                'endcolor' => array(
//                    'argb' => 'FFFFFFFF',
//                ),
//            ),
        );
        $headingRow = 1;

        $ThisStyleSheet->getStyleByColumnAndRow(0, $headingRow)->applyFromArray($styleArrayFilters);
        $ThisStyleSheet->getColumnDimensionByColumn(0)->setWidth(40);
        $ThisStyleSheet->setCellValueExplicitByColumnAndRow(0, $headingRow, 'Report Date');
        $ThisStyleSheet->getColumnDimensionByColumn(1)->setWidth(40);
        $ThisStyleSheet->setCellValueExplicitByColumnAndRow(1, $headingRow, date('Y-m-d'));
        $headingRow++;
        if ($addFilters) {
            $ThisStyleSheet->getStyleByColumnAndRow(0, $headingRow)->applyFromArray($styleArrayFilters);
            $ThisStyleSheet->getColumnDimensionByColumn(0)->setWidth(40);
            $ThisStyleSheet->setCellValueExplicitByColumnAndRow(0, $headingRow, 'Filters Applied');
            $headingRow++;
            foreach ($Filters as $key => $Filter) {
                $headingRow++;
                $ThisStyleSheet->getStyleByColumnAndRow(0, $headingRow - 1)->applyFromArray($styleArrayFilters);
                $ThisStyleSheet->getColumnDimensionByColumn(0)->setWidth(40);
                $ThisStyleSheet->setCellValueExplicitByColumnAndRow(0, $headingRow - 1, $key);

                $ThisStyleSheet->getColumnDimensionByColumn(1)->setWidth(40);
                $ThisStyleSheet->setCellValueExplicitByColumnAndRow(1, $headingRow - 1, implode('  |  ', $Filter));
            }
        }
        $headingRow++;
        foreach ($this->headings as $key => $heading) {

            $ThisStyleSheet->getStyleByColumnAndRow($key, $headingRow)->applyFromArray($styleArray);
            $ThisStyleSheet->getColumnDimensionByColumn($key)->setWidth(40);
            $ThisStyleSheet->setCellValueExplicitByColumnAndRow($key, $headingRow, ucfirst($heading));
        }
        $headingRow++;
        $j = 0;
        foreach ($this->dataArray as $dataRow) {
            $i = 0;
            foreach ($dataRow as $element) {
                $dataType = $this->SetDataTypeExcel($element);
                $ThisStyleSheet->setCellValueExplicitByColumnAndRow($i, ($j + ($headingRow)), $element, $dataType);
                $i++;
            }
            $j++;
        }
    }

    /**
     *  Save the excel file to a specific Location provided
     * 
     */
    public function SaveFile() {
        $path = sfConfig::get('sf_upload_dir') . '/' . $this->filename;
        $dirs = explode('/', $this->filename);
        $IamAtThisDirectory = $this->getUploadDicrectoryPath();
        $dirsCount = count($dirs);
        foreach ($dirs as $key => $dir) {
            if ($key != ($dirsCount - 1)) {
                $IamAtThisDirectory .=('/' . $dir);
                $IamAtThisDirectory = str_replace('//', '/', $IamAtThisDirectory);
                if (!is_dir($IamAtThisDirectory)) {
                    mkdir($IamAtThisDirectory, 0777, TRUE);
                }
            }
        }
        $path = str_replace('//', '/', $path);
        $objWriter = PHPExcel_IOFactory::createWriter($this, 'Excel2007');
        $objWriter->save($path);
        $this->disconnectWorksheets();
        
    }

    /**
     * CSV File Downloader of CSV Handler
     * 
     * @param String XLS_File_Name_with_its_dicrectory_name 
     */
    function DownloadXLSX($file_name_with_directory, $file_name) {
        $file_url = $this->getUploadDicrectoryPath() . $file_name_with_directory;
        exit;
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=$file_name");
        header("Content-Transfer-Encoding: binary ");

        readfile($file_url);
        return;
    }

    /**
     * CSV Deleter of XLS Handler
     * 
     * @param String CSV_File_Name_with_its_dicrectory_name 
     * @return Boolean
     */
    function DeleteFile($file_path) {
//        return unlink($this->getUploadDicrectoryPath() . $file_path);
    }

}

?>

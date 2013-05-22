<?php

/**
 * Description of csvHandler
 *
 * @author Furqan
 */
class csvHandler {

    /**
     * Upload Dicrectory Path for CSV Handler
     * 
     */
    protected $UploadDicrectoryPath;

    /**
     * constructor of CSV Handler
     * 
     */
    function __construct($UploadDicrectoryPath = null) {
        if (!$UploadDicrectoryPath)
            $this->UploadDicrectoryPath = sfConfig::get('sf_upload_dir');
        else {
            $this->UploadDicrectoryPath = $UploadDicrectoryPath;
        }
    }

    /**
     * Set Upload Path for CSV Handler
     * 
     * @param String   Upload Path 
     */
    public function setUploadDicrectoryPath($UploadDicrectoryPath = null) {
        $this->UploadDicrectoryPath = $UploadDicrectoryPath;
    }

    /**
     * Get Upload Path for CSV Handler
     * 
     * @return String
     */
    public function getUploadDicrectoryPath() {
        return $this->UploadDicrectoryPath;
    }

    /**
     * CSV Creator of CSV Handler
     * 
     * @param Array $Array_to_export_CSV 
     * @param String CSV_File_Name 
     * 
     * @return Boolean
     */

    /**
     * 
     * @param array $array
     * @param String $filename
     * @param BOOLEAN $isHeadingDynamic
     * @param Int $DynamicHeadingIndex
     * @param BOOLEAN $showAppliedFilters
     * @param Array $filters
     * 
     * @return none
     */
    function CreateCSV(array &$array, $filename, $isHeadingDynamic = false, $DynamicHeadingIndex = 0, $showAppliedFilters = FALSE, $filters = array()) {

        if (count($array) == 0) {
            return null;
        }
        ob_start();
        $df = fopen($this->getUploadDicrectoryPath() . $filename, 'w');
        fputcsv($df, array('Report Date', ' - ' . date('Y-m-d') . ' - '));
        if ($showAppliedFilters) {
            fputcsv($df, array('Filters Applied'));
            foreach ($filters as $key => $filter) {
                fputcsv($df, array($key, implode(' | ', $filter)));
            }
        }

        if ($isHeadingDynamic) {
            fputcsv($df, array_keys($array[$DynamicHeadingIndex]));
        } else {
            fputcsv($df, array_keys(reset($array)));
        }

        foreach ($array as $row) {
            fputcsv($df, $row);
        }
        fclose($df);
        return ob_get_clean();
    }

    /**
     * CSV File Downloader of CSV Handler
     * 
     * @param String CSV_File_Name_with_its_dicrectory_name 
     */
    function DownloadCSV($file_name_with_directory, $file_name = '') {

        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary");
        header("Content-disposition: attachment; filename=\"" . $file_name . "\"");
        $file_url = $this->getUploadDicrectoryPath() . $file_name_with_directory;
        readfile($file_url);
        return;
    }

    /**
     * CSV Deleter of CSV Handler
     * 
     * @param String CSV_File_Name_with_its_dicrectory_name 
     * @return Boolean
     */
    function DeleteFile($file_path) {
        return unlink($this->getUploadDicrectoryPath() . $file_path);
    }

}

?>

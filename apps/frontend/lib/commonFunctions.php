<?php

/**
 * Description of commonFunctions
 * 
 * @author Furqan
 */
class commonFunctions {

    /**
     * constructor of commonFunctions()
     * 
     */
    function __construct() {
        
    }

    /**
     * Sort multiDiamention Array Related to a specfic Key(Array Index)
     * 
     * @param Array $Array_to_Sort()
     * @param String $Key_To_Sort_Array_With()
     * 
     * @return Array Sorted_Array()
     */
    static function aasort(&$array, $key) {
        $sorter = array();
        $ret = array();
        reset($array);
        foreach ($array as $ii => $va) {
            $sorter[$ii] = $va[$key];
        }
        asort($sorter);
        foreach ($sorter as $ii => $va) {
            $ret[$ii] = $array[$ii];
        }
        return $array = $ret;
    }

    /**
     * Sort multiDiamention Array Related to a specfic Key(Array Index)
     * 
     * @param Array $Array_to_Sort()
     * @param String $Key_To_Sort_Array_With()
     * 
     * @return Array Sorted_Array()
     */
    static function arsort(&$array, $key) {
        $sorter = array();
        $ret = array();
        reset($array);
        foreach ($array as $ii => $va) {
            $sorter[$ii] = $va[$key];
        }
        arsort($sorter);
        foreach ($sorter as $ii => $va) {
            $ret[$ii] = $array[$ii];
        }
        return $array = $ret;
    }

}

?>

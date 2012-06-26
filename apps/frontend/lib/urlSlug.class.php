<?php

class urlSlug {

    static public function slugify($text) {
        // replace all non letters or digits by -
        $text = preg_replace('/\W+/', '-', $text);
// 
//    // trim and lowercase
        $text = strtolower(trim($text, '-'));



        return $text;
    }

    static public function read_phone($number) {
        $string = preg_replace('/[^0-9]/', '', $number);

        # Remove +1 from phone
        if (substr($number, 0, 1) == '1')
            $number = substr($number, 1);
        $count = strlen($string);
        if ($count >= 10) {
            $areacode = substr($string, 0, 3);
            $exchange = substr($string, 3, 3);
            $number = substr($string, 6, 4);
            $extension = substr($string, 10, 5);
            $string = '(' . $areacode . ') ' . $exchange . '-' . $number;
        } else {
            $exchange = substr($string, 0, 3);
            $number = substr($string, 3, 4);
            $extension = substr($string, 7, 5);
            $string = $exchange . '-' . $number;
        }

        if ($extension != '')
            $string .= ' ext ' . $extension;
        if (preg_replace('/[^0-9]/', '', $string) == '')
            $string = NULL;

        return $string;
    }

}

?>

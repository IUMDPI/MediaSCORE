<?php

class minutesToHour {

   static public function ConvertMinutes2Hours($Minutes) {
        if ($Minutes < 0) {
            $Min = Abs($Minutes);
        } else {
            $Min = $Minutes;
        }
        $iHours = Floor($Min / 60);
        $Minutes = ($Min - ($iHours * 60)) / 100;
        $tHours = $iHours + $Minutes;
        if ($Minutes < 0) {
            $tHours = $tHours * (-1);
        }
        $aHours = explode(".", $tHours);
        $iHours = $aHours[0];
        if (empty($aHours[1])) {
            $aHours[1] = "00";
        }
        $Minutes = $aHours[1];
        if (strlen($Minutes) < 2) {
            $Minutes = $Minutes . "0";
        }
        $tHours = $iHours . ":" . $Minutes;
        return $tHours;
    }

}

?>

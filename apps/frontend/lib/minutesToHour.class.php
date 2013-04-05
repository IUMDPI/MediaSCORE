<?php

class minutesToHour {

    static public function ConvertMinutes2Hours($Minutes) {


        $seconds = $Minutes * 60;


        $hoursPerDay = 24;
        $SecondsPerHour = 3600;
        $SecondsPerMinute = 60;
        $MinutesPerHour = 60;

        $hh = intval($seconds / $SecondsPerHour);
        $mm = intval($seconds / $SecondsPerMinute) % $MinutesPerHour;
        $ss = $seconds % $SecondsPerMinute;

        if ($mm <= 9)
            $mm = '0' . $mm;
        if ($ss <= 9)
            $ss = '0' . $ss;
        return $hh . ':' . $mm . ':' . $ss;
    }

    static function ConvertHoursToMin($time) {
        $duration = explode(':', $time);

        $SecondsPerHour = 3600;
        $SecondsPerMinute = 60;
        $hrs_to_second = (int) $duration[0] * (int) $SecondsPerHour;
        $min_to_second = (int) $duration[1] * (int) $SecondsPerMinute;
        $sec = (int) $duration[2];

        return $total_duration_in_seconds = $hrs_to_second + $min_to_second + $sec;
    }

    static public function oldFunctions($Minutes) {
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


        //other
        $seconds = $Minutes * 60;

        $hoursPerDay = 24;
        $SecondsPerHour = 3600;
        $SecondsPerMinute = 60;
        $MinutesPerHour = 60;

        $hh = intval($seconds / $SecondsPerHour);
        $mm = intval($seconds / $SecondsPerMinute) % $MinutesPerHour;
        $ss = $seconds % $SecondsPerMinute;
    }

}

?>

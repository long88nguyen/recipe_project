<?php

use App\Enums\Constant;
use Carbon\Carbon;
Class FormatHelper
{
    public static function convertToMinute($strTime)
    {
        $explodeTime = explode(":", $strTime);
        if (count($explodeTime) < 2)
            return 0;
        $hour = $explodeTime[0];
        $minutes = $explodeTime[1];

        return $totalMinutes = $hour * 60 + $minutes;
    }

    public static function timeDiff($startTime, $endTime)
    {
        $arrStartTime = explode(':', $startTime);
        $arrEndTime = explode(':', $endTime);
        $minStartTime = $startTime != "" ? (intval($arrStartTime[0]) * 60 + intval($arrStartTime[1])) : 0;
        $minEndTime = $endTime != "" ? (intval($arrEndTime[0]) * 60 + intval($arrEndTime[1])) : 0;
        $resultMinutes = abs($minEndTime - $minStartTime);
        if (!$resultMinutes) {
            return "";
        }
        $result = sprintf('%02d', floor($resultMinutes / 60)) . ':' . sprintf('%02d', $resultMinutes % 60);
        return $result;
    }

    public static function timePlus($startTime, $endTime)
    {
        $arrStartTime = explode(':', $startTime);
        $arrEndTime = explode(':', $endTime);
        $minStartTime = $startTime != "" ? (intval($arrStartTime[0]) * 60 + intval($arrStartTime[1])) : 0;
        $minEndTime = $endTime != "" ? (intval($arrEndTime[0]) * 60 + intval($arrEndTime[1])) : 0;
        $resultMinutes = abs($minStartTime + $minEndTime);
        if (!$resultMinutes) {
            return "";
        }
        $result = sprintf('%02d', floor($resultMinutes / 60)) . ':' . sprintf('%02d', $resultMinutes % 60);
        return $result;
    }

    public static function convertMinToHHMM($min)
    {
        $hours = floor($min / 60);
        $minutes = ($min % 60);

        if (strlen($hours) == 1) {
            $hours = '0' . $hours;
        }

        if (strlen($minutes) == 1) {
            $minutes = '0' . $minutes;
        }

        $str = $hours . ':' . $minutes;
        return $str;
    }

    public static function convertSecToHHMM($sec)
    {
        return static::convertMinToHHMM($sec/60);
    }


    public static function convertHHMMSSToSec($strTime)
    {
        $explodeTime = explode(":", $strTime);
        if (count($explodeTime) < 2 || count($explodeTime) < 3) {
            return 0;
        }
        $hour = intval($explodeTime[0]);
        $minutes = intval($explodeTime[1]);
        $seconds = intval($explodeTime[2]);

        return $hour * 3600 + $minutes * 60 + $seconds;
    }

    public static function escape_like($string)
    {
        $search = array('%', '_', '\u');
        $replace = array('\%', '\_', '/u');
        return str_replace($search, $replace, $string);
    }

}

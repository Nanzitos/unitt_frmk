<?php

/**
 * Created by PhpStorm.
 * User: Alvaro
 * Date: 17/01/2017
 * Time: 14:28
 */
class ExcelHelper
{
    public static function readXls($filename)
    {
        $ret = \Excel::load($filename)->get();

        return $ret;
    }
}
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function my_items($obj, $id, $val)
{
    if (!empty($obj)) {

        $x = count($obj);
        $items[0] = '-';

        foreach ($obj as $row) {
            $items[$row->$id] = $row->$val;
        }
        return $items;
    }
    return array(0 => '');
}

function my_number_format($number, $decimal = 0, $zero = "0")
{
    //return $number < 0 ? "(".number_format(abs($number),0,',','.').")" : number_format($number,0,',','.');
    if ($number < 0) $str = "(" . number_format(abs($number), $decimal, ',', '.') . ")";
    if ($number == 0) $str = $zero;
    if ($number > 0) $str = number_format($number, $decimal, ',', '.');
    return $str;
}

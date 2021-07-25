<?php
namespace Lzhy\Cloudmarket\Tool;

class Utils
{
    public static function gStr($len = 10, $type = 3)
    {
        $str = '';
        if ($type === 1 || $type === 3) {
            $str .= 1234567890;
        }
        if ($type === 2 || $type === 3) {
            $str .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        }
        $_round = '';
        for ($i = 0; $i < $len; $i++) {
            $_round .= $str[rand(0, strlen($str) - 1)];
        }

        return $_round;
    }
}
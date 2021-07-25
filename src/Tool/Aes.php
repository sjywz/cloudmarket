<?php
namespace Lzhy\Cloudmarket\Tool;

class Aes
{
    private static function _pkcs5Pad($text,$blockSize)
    {
        $pad = $blockSize - (strlen($text) % $blockSize);
        return $text.str_repeat(chr($pad),$pad);
    }

    private static function _pkcs5Unpad($text)
    {
        $end  = substr($text, -1);
        $last = ord($end);
        $len  = strlen($text) - $last;
        if(substr($text,$len) == str_repeat($end,$last)){
            return substr($text,0,$len);
        }
        return false;
    }

    public static function decrypt($str,$key,$method = 'aes-128-cbc',$options = 2)
    {
        $iv = substr($str,0,16);
        $ciphertext = substr($str,16);
        $result = openssl_decrypt($ciphertext,$method,$key,$options,$iv);
        if($result){
            return self::_pkcs5Unpad($result);
        }
        return false;
    }

    public static function encrypt($str,$key,$method = 'aes-128-cbc',$options = 2)
    {
        $ivlen = openssl_cipher_iv_length($method);
        $iv = Utils::gStr($ivlen);
        $str = self::_pkcs5Pad($str,$ivlen);
        $result = openssl_encrypt($str,$method,$key,$options,$iv);
        return $iv.$result;
    }
}
<?php
namespace Lzhy\Cloudmarket\Traits;

use Lzhy\Cloudmarket\Tool\Aes;

trait Hce
{
    public function decrypt($str,$key,$method = 'aes-128-cbc',$options = 2)
    {
        $password = substr(sha1(sha1($key,true),true),0,16);
        return Aes::decrypt($str,$password,$method,$options);
    }

    public function encrypt($str,$key,$method = 'aes-128-cbc',$options = 2)
    {
        $password = substr(sha1(sha1($key,true),true),0,16);
        return Aes::encrypt($str,$password,$method,$options);
    }

    public static function pddParam($param)
    {
        foreach($param as $k => $v){
            if(in_array($k,['mobilePhone','email','authToken']) && $v){
                $_v = str_replace(' ','+',urldecode($v));
                $param[$k] = $_v;
            }
        }
        return $param;
    }
}
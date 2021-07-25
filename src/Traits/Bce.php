<?php
namespace Lzhy\Cloudmarket\Traits;

trait Bce
{
    public function getHeaderField($key)
    {
        $server = $_SERVER;
        foreach ($server as $k => $v){
            if(strtolower($k) === strtolower($key)){
                return $v;
            }
        }
        return null;
    }
}
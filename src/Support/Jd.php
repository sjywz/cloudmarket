<?php
namespace Lzhy\Cloudmarket\Support;

class Jd extends Cloud
{
    protected $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function input($parse = false)
    {
        $input = array_merge($_GET,$_POST);
        if($parse){
            $input = $this->parseInput($input);
        }
        return $input;
    }

    public function parseInput($input)
    {
        return $input;
    }

    public function response($data)
    {
        exit(json_decode($data));
    }

    public function checkSign()
    {
        $param = $this->input();
        $token = $param['token'] ?? '';
        unset($param['token']);
        ksort($param);
        $param['key'] = $this->token;
        $sign = md5(urldecode(http_build_query($param)));
        return $sign == $token;
    }
}
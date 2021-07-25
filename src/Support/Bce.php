<?php
namespace Lzhy\Cloudmarket\Support;

class Bce extends Cloud
{
    protected $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function input($parse = false)
    {
        $input = $_GET;
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

    }

    public function checkSign()
    {
        $param = $this->input();
        $mktDate = $param['headers']['http_x_mkt_request_date'] ?? '';

        $verifytoken = $param['token'];
        unset($param['token']);
        ksort($param);
        $param['x-mkt-request-date'] = $mktDate;
        $param['key'] = $this->token;
        $signStr = urldecode(http_build_query($param));
        $sign = md5($signStr);
        return $verifytoken == $sign;
    }
}
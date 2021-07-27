<?php
namespace Lzhy\Cloudmarket\Support;

use Lzhy\Cloudmarket\Tool\Unify;
use Lzhy\Cloudmarket\Traits\Bce as TraitsBce;

class Bce extends Cloud
{
    use TraitsBce;

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

    public function parseInput($input,$unify = false)
    {
        if($unify){
            $input = Unify::tranform($input);
        }
        return $input;
    }

    public function response($data)
    {
        $requestId = $this->getHeaderField('http_x_mkt_request_id');
        header('Content-Type: application/json');
        header('x-mkt-request-id: '.$requestId);
        exit(json_encode($data));
    }

    public function checkSign()
    {
        $param = $this->input();
        $mktDate = $this->getHeaderField('http_x_mkt_request_date');
        if(empty($mktDate)){
            return false;
        }
        if(empty($param['token'])){
            return false;
        }

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
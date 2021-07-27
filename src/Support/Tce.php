<?php
namespace Lzhy\Cloudmarket\Support;

use Lzhy\Cloudmarket\Tool\Unify;

class Tce extends Cloud
{
    protected $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function input($parse = false)
    {
        $rawInput = file_get_contents('php://input');
        $input = json_decode($rawInput,true);
        if(!is_array($input)){
            $input = json_decode($input,true);
        }
        if($input){
            $input = array_merge($_GET,$input);
        }
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
        exit(json_encode($data));
    }

    public function checkSign()
    {
        $param = $this->input();
        if(empty($param['signature']) || empty($param['timestamp']) || empty($param['eventId'])){
            return false;
        }

        $signature = $param['signature'];
        $timestamp = $param['timestamp'];
        $eventId = $param['eventId'];
        $timestamp = (string)$timestamp;
        $eventId = (string)$eventId;
        $params = array($this->token, $timestamp, $eventId);
        sort($params, SORT_STRING);
        $str = implode('', $params);
        $requestSignature = hash('sha256', $str);
        return $signature === $requestSignature;
    }
}